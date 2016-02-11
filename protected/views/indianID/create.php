<?php
/* @var $this IndianIDController */
/* @var $model IndianID */
?>

<?php
$this->breadcrumbs=array(
	'Indian Ids'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List IndianID', 'url'=>array('index')),
	array('label'=>'Manage IndianID', 'url'=>array('admin')),
);
?>

<h1>Create IndianID</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>