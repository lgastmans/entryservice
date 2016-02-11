<?php
/* @var $this ApplicantEmailController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Applicant Emails',
);

$this->menu=array(
	array('label'=>'Create ApplicantEmail','url'=>array('create')),
	array('label'=>'Manage ApplicantEmail','url'=>array('admin')),
);
?>

<h1>Applicant Emails</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>