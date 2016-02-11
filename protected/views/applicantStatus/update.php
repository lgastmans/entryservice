<?php
/* @var $this ApplicantStatusController */
/* @var $model ApplicantStatus */
?>

<?php
/*
$this->breadcrumbs=array(
	'Applicant Statuses'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List ApplicantStatus', 'url'=>array('index')),
	array('label'=>'Create ApplicantStatus', 'url'=>array('create')),
	array('label'=>'View ApplicantStatus', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage ApplicantStatus', 'url'=>array('admin')),
);
*/
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>