<?php
/* @var $this ChildrenController */
/* @var $model Children */
?>

<?php
/*
$this->breadcrumbs=array(
	'Childrens'=>array('index'),
	$model->Name=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Children', 'url'=>array('index')),
	array('label'=>'Create Children', 'url'=>array('create')),
	array('label'=>'View Children', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage Children', 'url'=>array('admin')),
);
*/
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>