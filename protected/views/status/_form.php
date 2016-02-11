<?php
/* @var $this StatusController */
/* @var $model Status */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'status-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

            <?php echo $form->textFieldControlGroup($model,'Description',array('span'=>5,'maxlength'=>64)); ?>

            <?php echo $form->textFieldControlGroup($model,'Duration',array('span'=>2)); ?>

            <?php //echo $form->textFieldControlGroup($model,'DurationPeriod',array('span'=>5,'maxlength'=>6)); ?>
            <?php 
                echo $form->dropDownListControlGroup($model, 'DurationPeriod',
                    array('None'=>'None', 'Days'=>'Days', 'Weeks'=>'Weeks', 'Months'=>'Months', 'Years'=>'Years'),
                    array('empty' => 'Select Duration...')
                ); 
            ?>

            <?php echo $form->checkBoxControlGroup($model, 'IsProcess'); ?>

            <?php echo $form->textFieldControlGroup($model,'ProcessPosition',array('span'=>2)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->