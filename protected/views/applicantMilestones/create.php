<?php
/* @var $this ApplicantMilestonesController */
/* @var $model ApplicantMilestones */
?>

<?php
$this->breadcrumbs=array(
	'Applicant Milestones'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ApplicantMilestones', 'url'=>array('index')),
	array('label'=>'Manage ApplicantMilestones', 'url'=>array('admin')),
);
?>

<h1>Create ApplicantMilestones</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>