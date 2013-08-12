
<div id="centerMain">
            <?= form_open('ClientParent/generateworksheets', array('id' => 'formGenerateWorksheets')) ?>
                <fieldset class="icon-presentation-categories no-margin">
                    <legend>Manage Worksheets</legend>
                    
                    <div class="formRow">
                        <label for="inputPresentationCategory">Student Name</label>
                        <?= $this->form_field_generator->getInputFormField('inputPresentationCategory', $value = 'Should hjgfagjfsdafsafsa') ?>
                    </div>

                    <div class="formRow">
                        <label for="textareaPresentationCategoryDescription">Subject</label>
                        <?= $this->form_field_generator->getInputFormField('inputPresentationCategory', $value = 'Choose a subject') ?>
                    </div>

                    <div class="formRow">
                        <label for="textareaPresentationCategoryOptions">Number of weeks</label>
                        <?= $this->form_field_generator->getInputFormField('inputPresentationCategory', $value = 'Can generate worksheets for few weeks, if you are travelling') ?>
                    </div>
                </fieldset>

                <div class="buttons">
                    <span>
                        <button type="submit" name="submit" id="submitGenerate" class="button-small-green button-add"><span>Generate</span></button>
                    </span>
                </div>
            <?= form_close() ?>
</div>