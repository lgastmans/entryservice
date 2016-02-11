<?php
/* @var $this ExtensionController */
/* @var $data Extension */
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('ExtendedOn')); ?>:</b>
	<?php echo CHtml::encode($data->ExtendedOn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ExtendedFor')); ?>:</b>
	<?php echo CHtml::encode($data->ExtendedFor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ExtendedPeriod')); ?>:</b>
	<?php echo CHtml::encode($data->ExtendedPeriod); ?>
	<br />


</div>