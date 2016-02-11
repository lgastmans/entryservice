<?php
/* @var $this ApplicantPhoneController */
/* @var $model ApplicantPhone */
?>

<?php
$this->breadcrumbs=array(
	'Applicant Phones'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ApplicantPhone', 'url'=>array('index')),
	array('label'=>'Manage ApplicantPhone', 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
