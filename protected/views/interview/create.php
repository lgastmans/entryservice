<?php
/* @var $this InterviewController */
/* @var $model Interview */
?>

<?php
$this->breadcrumbs=array(
	'Interviews'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Interview', 'url'=>array('index')),
	array('label'=>'Manage Interview', 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>