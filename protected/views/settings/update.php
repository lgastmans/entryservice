<?php
/* @var $this SettingsController */
/* @var $model Settings */
?>

<?php
$this->breadcrumbs=array(
	'Settings'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

/*
$this->menu=array(
	array('label'=>'List Settings', 'url'=>array('index')),
	array('label'=>'Create Settings', 'url'=>array('create')),
	array('label'=>'View Settings', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage Settings', 'url'=>array('admin')),
);
*/
?>

<h1>Settings</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>