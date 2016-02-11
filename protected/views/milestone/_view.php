<?php
/* @var $this MilestoneController */
/* @var $data Milestone */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID),array('view','id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MilestoneCategoryID')); ?>:</b>
	<?php echo CHtml::encode($data->MilestoneCategoryID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Description')); ?>:</b>
	<?php echo CHtml::encode($data->Description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TimelineInterval')); ?>:</b>
	<?php echo CHtml::encode($data->TimelineInterval); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TimelinePeriod')); ?>:</b>
	<?php echo CHtml::encode($data->TimelinePeriod); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SendEmail')); ?>:</b>
	<?php echo CHtml::encode($data->SendEmail); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('ColorIndicator')); ?>:</b>
	<?php echo CHtml::encode($data->ColorIndicator); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('IsActive')); ?>:</b>
	<?php echo CHtml::encode($data->IsActive); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IsDefault')); ?>:</b>
	<?php echo CHtml::encode($data->IsDefault); ?>
	<br />

	*/ ?>

</div>