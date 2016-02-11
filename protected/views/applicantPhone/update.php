<?php
/* @var $this ApplicantPhoneController */
/* @var $model ApplicantPhone */
?>

<?php
/*
$this->breadcrumbs=array(
	'Applicant Phones'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List ApplicantPhone', 'url'=>array('index')),
	array('label'=>'Create ApplicantPhone', 'url'=>array('create')),
	array('label'=>'View ApplicantPhone', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage ApplicantPhone', 'url'=>array('admin')),
);
*/
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>