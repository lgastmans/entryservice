<?php
/* @var $this ExtensionController */
/* @var $model Extension */
?>

<?php
$this->breadcrumbs=array(
	'Extensions'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Extension', 'url'=>array('index')),
	array('label'=>'Create Extension', 'url'=>array('create')),
	array('label'=>'View Extension', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage Extension', 'url'=>array('admin')),
);
?>

    

<?php $this->renderPartial('_form', array('model'=>$model)); ?>