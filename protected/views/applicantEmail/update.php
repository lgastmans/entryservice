<?php
/* @var $this ApplicantEmailController */
/* @var $model ApplicantEmail */
?>

<?php
/*
$this->breadcrumbs=array(
	'Applicant Emails'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List ApplicantEmail', 'url'=>array('index')),
	array('label'=>'Create ApplicantEmail', 'url'=>array('create')),
	array('label'=>'View ApplicantEmail', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage ApplicantEmail', 'url'=>array('admin')),
);
*/
?>

<?php

	$this->renderPartial('_form', array('model'=>$model));
?>
