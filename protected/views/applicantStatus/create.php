<?php
/* @var $this ApplicantStatusController */
/* @var $model ApplicantStatus */
?>

<?php
$this->breadcrumbs=array(
	'Applicant Statuses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ApplicantStatus', 'url'=>array('index')),
	array('label'=>'Manage ApplicantStatus', 'url'=>array('admin')),
);
?>

<!-- <h1>Create ApplicantStatus</h1> -->

<?php $this->renderPartial('_form', array('model'=>$model)); ?>