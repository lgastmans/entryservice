<?php
/* @var $this ApplicantStatisticsController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Applicant Statistics',
);

$this->menu=array(
	array('label'=>'Create ApplicantStatistics','url'=>array('create')),
	array('label'=>'Manage ApplicantStatistics','url'=>array('admin')),
);
?>

<h1>Applicant Statistics</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>