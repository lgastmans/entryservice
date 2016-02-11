<?php
/* @var $this ApplicantStatisticsController */
/* @var $model ApplicantStatistics */
?>

<?php
$this->breadcrumbs=array(
	'Applicant Statistics'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ApplicantStatistics', 'url'=>array('index')),
	array('label'=>'Manage ApplicantStatistics', 'url'=>array('admin')),
);
?>

<h1>Create ApplicantStatistics</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>