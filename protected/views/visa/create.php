<?php
/* @var $this VisaController */
/* @var $model Visa */
?>

<?php
$this->breadcrumbs=array(
	'Visas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Visa', 'url'=>array('index')),
	array('label'=>'Manage Visa', 'url'=>array('admin')),
);
?>

<h1>Create Visa</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>