<?php
/* @var $this ApplicantStatisticsController */
/* @var $data ApplicantStatistics */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID),array('view','id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ApplicantID')); ?>:</b>
	<?php echo CHtml::encode($data->ApplicantID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CategoryID')); ?>:</b>
	<?php echo CHtml::encode($data->CategoryID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('AnswerID')); ?>:</b>
	<?php echo CHtml::encode($data->AnswerID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DateRecorded')); ?>:</b>
	<?php echo CHtml::encode($data->DateRecorded); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Notes')); ?>:</b>
	<?php echo CHtml::encode($data->Notes); ?>
	<br />


</div>