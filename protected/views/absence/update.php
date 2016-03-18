<?php
/* @var $this AbsenceController */
/* @var $model Absence */
?>

<?php
$this->breadcrumbs=array(
	'Absences'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Absence', 'url'=>array('index')),
	array('label'=>'Create Absence', 'url'=>array('create')),
	array('label'=>'View Absence', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage Absence', 'url'=>array('admin')),
);
?>

    

<?php $this->renderPartial('_form', array('model'=>$model)); ?>