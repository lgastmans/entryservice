<?php
/* @var $this StatusController */
/* @var $data Status */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID),array('view','id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Description')); ?>:</b>
	<?php echo CHtml::encode($data->Description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Duration')); ?>:</b>
	<?php echo CHtml::encode($data->Duration); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DurationPeriod')); ?>:</b>
	<?php echo CHtml::encode($data->DurationPeriod); ?>
	<br />


</div>