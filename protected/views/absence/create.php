<?php
/* @var $this AbsenceController */
/* @var $model Absence */
?>

<?php
$this->breadcrumbs=array(
	'Absences'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Absence', 'url'=>array('index')),
	array('label'=>'Manage Absence', 'url'=>array('admin')),
);
?>

<h1>Create Absence</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>