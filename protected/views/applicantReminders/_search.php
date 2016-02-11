<?php
/* @var $this ApplicantRemindersController */
/* @var $model ApplicantReminders */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID'); ?>
		<?php echo $form->textField($model,'ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ApplicantID'); ?>
		<?php echo $form->textField($model,'ApplicantID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ApplicantMilestoneID'); ?>
		<?php echo $form->textField($model,'ApplicantMilestoneID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Status'); ?>
		<?php echo $form->textField($model,'Status',array('size'=>9,'maxlength'=>9)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Description'); ?>
		<?php echo $form->textField($model,'Description',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'EmailMessage'); ?>
		<?php echo $form->textArea($model,'EmailMessage',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RepeatInterval'); ?>
		<?php echo $form->textField($model,'RepeatInterval'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RepeatPeriod'); ?>
		<?php echo $form->textField($model,'RepeatPeriod',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'EmailApplicant'); ?>
		<?php echo $form->textField($model,'EmailApplicant',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'EmailTeam'); ?>
		<?php echo $form->textField($model,'EmailTeam',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'EmailES'); ?>
		<?php echo $form->textField($model,'EmailES',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DateRecorded'); ?>
		<?php echo $form->textField($model,'DateRecorded'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->