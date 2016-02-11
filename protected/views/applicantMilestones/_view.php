<?php
/* @var $this ApplicantMilestonesController */
/* @var $data ApplicantMilestones */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID),array('view','id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ApplicantID')); ?>:</b>
	<?php echo CHtml::encode($data->ApplicantID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Status')); ?>:</b>
	<?php echo CHtml::encode($data->Status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DateCreated')); ?>:</b>
	<?php echo CHtml::encode($data->DateCreated); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DateStarted')); ?>:</b>
	<?php echo CHtml::encode($data->DateStarted); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DateCompleted')); ?>:</b>
	<?php echo CHtml::encode($data->DateCompleted); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Description')); ?>:</b>
	<?php echo CHtml::encode($data->Description); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Remarks')); ?>:</b>
	<?php echo CHtml::encode($data->Remarks); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TimelineInterval')); ?>:</b>
	<?php echo CHtml::encode($data->TimelineInterval); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TimelinePeriod')); ?>:</b>
	<?php echo CHtml::encode($data->TimelinePeriod); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Alert')); ?>:</b>
	<?php echo CHtml::encode($data->Alert); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('AlertInterval')); ?>:</b>
	<?php echo CHtml::encode($data->AlertInterval); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('AlertPeriod')); ?>:</b>
	<?php echo CHtml::encode($data->AlertPeriod); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RepeatAlert')); ?>:</b>
	<?php echo CHtml::encode($data->RepeatAlert); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IsAlerted')); ?>:</b>
	<?php echo CHtml::encode($data->IsAlerted); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SendEmail')); ?>:</b>
	<?php echo CHtml::encode($data->SendEmail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IsActive')); ?>:</b>
	<?php echo CHtml::encode($data->IsActive); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ColorIndicator')); ?>:</b>
	<?php echo CHtml::encode($data->ColorIndicator); ?>
	<br />

	*/ ?>

</div>