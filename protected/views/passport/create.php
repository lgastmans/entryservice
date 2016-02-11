<?php
/* @var $this PassportController */
/* @var $model Passport */
?>

<?php
$this->breadcrumbs=array(
	'Passports'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Passport', 'url'=>array('index')),
	array('label'=>'Manage Passport', 'url'=>array('admin')),
);
?>

<h1>Create Passport</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>