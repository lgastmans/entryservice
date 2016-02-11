<?php
/* @var $this ApplicantPhoneController */
/* @var $model ApplicantPhone */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'applicant-phone-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

            <?php //echo $form->textFieldControlGroup($model,'ApplicantID',array('span'=>5)); ?>
            <?php
              if ($model->isNewRecord)
                echo $form->hiddenField($model,'ApplicantID',array('value'=>$_GET['applicant_id']));
            ?>

            <?php //echo $form->textFieldControlGroup($model,'ContactType',array('span'=>5,'maxlength'=>4)); ?>
            <?php echo $form->dropDownListControlGroup($model,'ContactType', array('Cell'=>'Cell', 'Home'=>'Home', 'Work'=>'Work')); ?>

            <?php echo $form->textFieldControlGroup($model,'Number',array('span'=>3,'maxlength'=>32)); ?>

            <?php //echo $form->textFieldControlGroup($model,'IsPrimary',array('span'=>5,'maxlength'=>1)); ?>
            <?php echo $form->dropDownListControlGroup($model,'IsPrimary', array('Y'=>'Yes', 'N'=>'No')); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
