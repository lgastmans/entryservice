<?php
/* @var $this ApplicantMilestonesController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Applicant Milestones',
);

$this->menu=array(
	array('label'=>'Create ApplicantMilestones','url'=>array('create')),
	array('label'=>'Manage ApplicantMilestones','url'=>array('admin')),
);
?>

<h1>Applicant Milestones</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>