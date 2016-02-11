<?php
/* @var $this ApplicantStatusController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Applicant Statuses',
);

$this->menu=array(
	array('label'=>'Create ApplicantStatus','url'=>array('create')),
	array('label'=>'Manage ApplicantStatus','url'=>array('admin')),
);
?>

<h1>Applicant Statuses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>