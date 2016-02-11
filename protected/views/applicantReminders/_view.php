<?php
/* @var $this ApplicantRemindersController */
/* @var $data ApplicantReminders */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ApplicantID')); ?>:</b>
	<?php echo CHtml::encode($data->ApplicantID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ApplicantMilestoneID')); ?>:</b>
	<?php echo CHtml::encode($data->ApplicantMilestoneID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Status')); ?>:</b>
	<?php echo CHtml::encode($data->Status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Description')); ?>:</b>
	<?php echo CHtml::encode($data->Description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EmailMessage')); ?>:</b>
	<?php echo CHtml::encode($data->EmailMessage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RepeatInterval')); ?>:</b>
	<?php echo CHtml::encode($data->RepeatInterval); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('RepeatPeriod')); ?>:</b>
	<?php echo CHtml::encode($data->RepeatPeriod); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EmailApplicant')); ?>:</b>
	<?php echo CHtml::encode($data->EmailApplicant); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EmailTeam')); ?>:</b>
	<?php echo CHtml::encode($data->EmailTeam); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EmailES')); ?>:</b>
	<?php echo CHtml::encode($data->EmailES); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DateRecorded')); ?>:</b>
	<?php echo CHtml::encode($data->DateRecorded); ?>
	<br />

	*/ ?>

</div>