<?php
/* @var $this InterviewController */
/* @var $data Interview */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('ApplicantID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ApplicantID),array('view','id'=>$data->ApplicantID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DateInterviewed')); ?>:</b>
	<?php echo CHtml::encode($data->DateInterviewed); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Title')); ?>:</b>
	<?php echo CHtml::encode($data->Title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Present')); ?>:</b>
	<?php echo CHtml::encode($data->Present); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Interview')); ?>:</b>
	<?php echo CHtml::encode($data->Interview); ?>
	<br />


</div>