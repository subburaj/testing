subbu

<?php
    $urlFormSubmit = 'ClientParent/saveworksheetresults/' . $student_id . '/' . $subject_id . '/' . $worksheet_date;
    $urlFormCancel = 'ClientParent/worksheetresults/' . $student_id;

    $attr_button_cancel = array(
        'id'    => 'cancelWorksheetResults',
        'class' => 'button button-small-gray button-cancel',
        'title' => 'Cancel worksheet results'
    );

    $attr_button_submit = array(
        'id'    => 'submitWorksheetResults',
        'class' => 'button button-medium-green button-save',
        'title' => 'Save worksheet results'
    );

?>

<?= form_open($urlFormSubmit, array('id' => 'formWorksheetResults')) ?>
    <fieldset class="no-margin">
        <!-- <legend>Worksheet Results</legend>-->
whattodo
        <?= $results_table ?>
    </fieldset>

    <div class="buttons">
        <span class="buttons">
            <?= anchor($urlFormCancel, '<span>Cancel</span>', $attr_button_cancel) ?>
            <?= anchor('', '<span>Save Results</span>', $attr_button_submit) ?>
        </span>
    </div>

    <!-- Save results confirmation -->
    <div id="dialog-confirm" title="Save results ?">
        <p>
            dfasdfasd ck ck ck ckck ckckkc the worksheet results for sure ?
        </p>
    </div>
<?= form_close() ?>

<!-- jQuery Tools -->
<script type="text/javascript" src="<?= base_url() . 'static/js/jqueryTools/jquery.tools.min.js' ?>"></script>

<script type="text/javascript">
    $(function() {
        // Setting up the confirmation dialog
        $("#dialog-confirm").dialog({
            autoOpen: false,
            resizable: false,
            height:220,
            width:500,
            modal: true,
            buttons: {
                'No': function() {
                    $(this).dialog('close');
                },
                'Yes': function() {
                    $('#formWorksheetResults').submit();
                    $(this).dialog('close');
                    return false;
                }
            }
        });

        // Setting up tooltips behavior for the questions & answers
        $(".tooltip-trigger").tooltip({
            relative: true,
            predelay: 400,
            delay: 0
        });

        // Setting up the right/wrong/skipped buttons' behavior
        function setButtonOn($button) {
            if ($button.hasClass('button-ws-right-on') || $button.hasClass('button-ws-wrong-on') || $button.hasClass('button-ws-skipped-on'))
                return;

            $table_cell = $button.closest('td');
            $table_cell.find('input:checkbox.ws-checkbox').removeAttr('checked');

            $buttonRight = $table_cell.find('a.button-ws-right-on');
            $buttonRight.removeClass('button-ws-right-on').addClass('button-ws-right-off');

            $buttonWrong = $table_cell.find('a.button-ws-wrong-on');
            $buttonWrong.removeClass('button-ws-wrong-on').addClass('button-ws-wrong-off');

            $buttonSkipped = $table_cell.find('a.button-ws-skipped-on');
            $buttonSkipped.removeClass('button-ws-skipped-on').addClass('button-ws-skipped-off');

            if ($button.hasClass('button-ws-right-off')) {
                $button.removeClass('button-ws-right-off').addClass('button-ws-right-on');
                $table_cell.find('input:checkbox.ws-checkbox-right').attr('checked', 'checked');
            }

            if ($button.hasClass('button-ws-wrong-off')) {
                $button.removeClass('button-ws-wrong-off').addClass('button-ws-wrong-on');
                $table_cell.find('input:checkbox.ws-checkbox-wrong').attr('checked', 'checked');
            }

            if ($button.hasClass('button-ws-skipped-off')) {
                $button.removeClass('button-ws-skipped-off').addClass('button-ws-skipped-on');
                $table_cell.find('input:checkbox.ws-checkbox-skipped').attr('checked', 'checked');
            }
        }

        // Handling the tri-state right/wrong/skipped type button's behavior
        $('.button-ws').click(function() {
            setButtonOn($(this));

            return false;
        });

        // Show confirmation dialog when trying to save the results
        $('#submitWorksheetResults').live('click', function() {
            $('#dialog-confirm').dialog('open');
            return false;
        });

        // Handle form submittal
        $('#formWorksheetResults').submit(function() {
            var $form = $(this);

            $.ajax({
               url: $form.attr('action'),
               data: $form.serialize(),
               dataType: 'json',
               type: 'post',
               success: function(ajaxData) {
                   if (ajaxData.success == 'yes') {
                       $('#content-wrapper').html(ajaxData.results);

                       humanMsg.displayMsg(ajaxData.message);

                       // Redirecting to the worksheets scheduling page of the student
                       // $(window.location).attr('href', $SITE_URL + '/<?= $urlFormCancel ?>');
                   }
                   else {
                       humanMsg.displayMsg(errorMessage(ajaxData.message));
                   }
               }
            });

            return false;
        });
    });
</script>