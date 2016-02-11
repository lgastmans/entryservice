<?php
/* @var $this AbsenceController */
/* @var $data Absence */
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('AbsentOn')); ?>:</b>
	<?php echo CHtml::encode($data->AbsentOn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('AbsentTill')); ?>:</b>
	<?php echo CHtml::encode($data->AbsentTill); ?>
	<br />


</div>