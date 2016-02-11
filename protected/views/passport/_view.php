<?php
/* @var $this PassportController */
/* @var $data Passport */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID),array('view','id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PassportNumber')); ?>:</b>
	<?php echo CHtml::encode($data->PassportNumber); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IssuedDate')); ?>:</b>
	<?php echo CHtml::encode($data->IssuedDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ValidTill')); ?>:</b>
	<?php echo CHtml::encode($data->ValidTill); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IssuedBy')); ?>:</b>
	<?php echo CHtml::encode($data->IssuedBy); ?>
	<br />


</div>