<?php
/* @var $this VisaController */
/* @var $data Visa */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID),array('view','id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('VisaType')); ?>:</b>
	<?php echo CHtml::encode($data->VisaType); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Number')); ?>:</b>
	<?php echo CHtml::encode($data->Number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IssuedDate')); ?>:</b>
	<?php echo CHtml::encode($data->IssuedDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ValidTill')); ?>:</b>
	<?php echo CHtml::encode($data->ValidTill); ?>
	<br />


</div>