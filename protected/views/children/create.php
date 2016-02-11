<?php
/* @var $this ChildrenController */
/* @var $model Children */
?>

<?php
$this->breadcrumbs=array(
	'Childrens'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Children', 'url'=>array('index')),
	array('label'=>'Manage Children', 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
