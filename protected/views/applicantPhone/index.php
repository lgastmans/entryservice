<?php
/* @var $this ApplicantPhoneController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Applicant Phones',
);

$this->menu=array(
	array('label'=>'Create ApplicantPhone','url'=>array('create')),
	array('label'=>'Manage ApplicantPhone','url'=>array('admin')),
);
?>

<h1>Applicant Phones</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>