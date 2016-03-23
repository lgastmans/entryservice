<?php
/* @var $this WorkController */
/* @var $model Work */
?>

<?php
$this->breadcrumbs=array(
	'Works'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Work', 'url'=>array('index')),
	array('label'=>'Create Work', 'url'=>array('create')),
	array('label'=>'View Work', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage Work', 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>