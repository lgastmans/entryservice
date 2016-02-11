<?php
/* @var $this StatisticsAnswerController */
/* @var $data StatisticsAnswer */
?>

<div class="view">

	<?php /*
   	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID),array('view','id'=>$data->ID)); ?>
	<br />
	*/ ?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('Answer')); ?>:</b>
	<?php echo CHtml::encode($data->Answer); ?>
	<br />


</div>