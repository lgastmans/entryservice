<?php
/* @var $this ExtensionController */
/* @var $model Extension */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'extension-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

            <?php echo $form->textFieldControlGroup($model,'ApplicantID',array('span'=>5)); ?>

            <?php echo $form->textFieldControlGroup($model,'StatusID',array('span'=>5)); ?>

            <?php echo $form->textFieldControlGroup($model,'ExtendedOn',array('span'=>5)); ?>

            <?php echo $form->textFieldControlGroup($model,'ExtendedFor',array('span'=>5)); ?>

            <?php echo $form->textFieldControlGroup($model,'ExtendedPeriod',array('span'=>5,'maxlength'=>6)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->