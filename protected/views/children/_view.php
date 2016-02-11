<?php
/* @var $this ChildrenController */
/* @var $data Children */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID),array('view','id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ApplicantID')); ?>:</b>
	<?php echo CHtml::encode($data->ApplicantID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Name')); ?>:</b>
	<?php echo CHtml::encode($data->Name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Surname')); ?>:</b>
	<?php echo CHtml::encode($data->Surname); ?>
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

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('BirthDate')); ?>:</b>
	<?php echo CHtml::encode($data->BirthDate); ?>
	<br />

	*/ ?>

</div>