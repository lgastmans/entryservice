<?php
/* @var $this ApplicantMilestonesController */
/* @var $model ApplicantMilestones */
?>

<?php
$this->breadcrumbs=array(
	'Applicant Milestones'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List ApplicantMilestones', 'url'=>array('index')),
	array('label'=>'Create ApplicantMilestones', 'url'=>array('create')),
	array('label'=>'View ApplicantMilestones', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage ApplicantMilestones', 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>