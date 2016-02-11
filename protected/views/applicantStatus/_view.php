<?php
/* @var $this ApplicantStatusController */
/* @var $data ApplicantStatus */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID),array('view','id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ApplicantID')); ?>:</b>
	<?php echo CHtml::encode($data->ApplicantID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('StatusID')); ?>:</b>
	<?php echo CHtml::encode($data->StatusID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('StartedOn')); ?>:</b>
	<?php echo CHtml::encode($data->StartedOn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CompletedOn')); ?>:</b>
	<?php echo CHtml::encode($data->CompletedOn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Color')); ?>:</b>
	<?php echo CHtml::encode($data->Color); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Duration')); ?>:</b>
	<?php echo CHtml::encode($data->Duration); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('DurationPeriod')); ?>:</b>
	<?php echo CHtml::encode($data->DurationPeriod); ?>
	<br />

	*/ ?>

</div>