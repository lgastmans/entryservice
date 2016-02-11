<?php
/* @var $this MilestoneController */
/* @var $model Milestone */
/* @var $form TbActiveForm */
?>

<div class="form">
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', 
        array(
        	'id'=>'milestone-form',
        	// Please note: When you enable ajax validation, make sure the corresponding
        	// controller action is handling ajax validation correctly.
        	// There is a call to performAjaxValidation() commented in generated controller code.
        	// See class documentation of CActiveForm for details on this.
        	'enableAjaxValidation'=>false,
            'layout' => 'horizontal',
            //'layout' => TbHtml::FORM_LAYOUTHORIZONTAL,
        )); 
    ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

            <?php //echo $form->textFieldControlGroup($model,'MilestoneCategoryID',array('span'=>5)); ?>
            <?php 
                echo $form->dropDownListControlGroup($model, 'MilestoneCategoryID',
                    CHtml::listData(MilestoneCategory::model()->findAll(), 'ID', 'Description'),
                    array('empty' => 'Select Category...')
                ); 
            ?>

            <?php echo $form->textFieldControlGroup($model,'Description',array('span'=>5,'maxlength'=>128)); ?>

            <?php echo $form->textFieldControlGroup($model,'TimelineInterval',array('span'=>1)); ?>

            <?php //echo $form->textFieldControlGroup($model,'TimelinePeriod',array('span'=>5,'maxlength'=>6)); ?>
            <?php 
                echo $form->dropDownListControlGroup($model, 'TimelinePeriod',
                    array('Days'=>'Days', 'Weeks'=>'Weeks', 'Months'=>'Months', 'Years'=>'Years'),
                    array('empty' => 'Select Period...')
                ); 
            ?>

            <?php //echo $form->textFieldControlGroup($model,'SendEmail',array('span'=>5,'maxlength'=>1)); ?>
            <?php echo $form->checkBoxControlGroup($model, 'SendEmail', array('disabled' => false)); ?>

            <div class="control-group ">
                <label class="control-label" for="Milestone_EmailText">Email Text</label>
                <div class="controls">
                    <?php
                        $this->widget('yiiwheels.widgets.redactor.WhRedactor', array(
                            'model'     => $model,
                            'attribute' => 'EmailText',
                        ));
                    ?>
                </div>
            </div>

            <?php //echo $form->textFieldControlGroup($model,'ColorIndicator',array('span'=>5,'maxlength'=>16)); ?>
<?php
/*
            <div class="control-group ">
                <label class="control-label" for="Milestone_ColorIndicator">Color Indicator</label>
                <div class="controls">
                    <?php
                        $this->widget('ext.colorpicker.ColorPicker', array(
                            'model' => $model,
                            'attribute' => 'ColorIndicator',
                            'options' => array( // Optional
                                'pickerDefault' => "ccc", // Configuration Object for JS
                            ),
                        ));
                    ?>
                </div>
            </div>
*/
?>
            <?php //echo $form->textFieldControlGroup($model,'Alert',array('span'=>5)); ?>
            <?php echo $form->checkBoxControlGroup($model, 'Alert', array('disabled' => false)); ?>

            <?php echo $form->textFieldControlGroup($model,'AlertInterval',array('span'=>1)); ?>

            <?php //echo $form->textFieldControlGroup($model,'AlertPeriod',array('span'=>5,'maxlength'=>6)); ?>
            <?php 
                echo $form->dropDownListControlGroup($model, 'AlertPeriod',
                    array('Days'=>'Days', 'Weeks'=>'Weeks', 'Months'=>'Months', 'Years'=>'Years'),
                    array('empty' => 'Select Period...')
                ); 
            ?>

            <?php //echo $form->textFieldControlGroup($model,'RepeatAlert',array('span'=>5)); ?>
            <?php echo $form->checkBoxControlGroup($model, 'RepeatAlert'); ?>

            <?php //echo $form->textFieldControlGroup($model,'IsAlerted',array('span'=>5)); ?>

            <?php //echo $form->textFieldControlGroup($model,'IsActive',array('span'=>5,'maxlength'=>1)); ?>
            <?php echo $form->checkBoxControlGroup($model, 'IsActive'); ?>

            <?php //echo $form->textFieldControlGroup($model,'IsDefault',array('span'=>5)); ?>
            <?php echo $form->checkBoxControlGroup($model, 'IsDefault'); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->