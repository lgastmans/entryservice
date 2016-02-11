<?php
/* @var $this ApplicantController */
/* @var $model Applicant */
?>

<?php
$this->breadcrumbs=array(
	'Applicants'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label' => 'actions'),
	TbHtml::menuDivider(),
//	array('label'=>'List Applicant', 'url'=>array('index')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<h1>Create Applicant</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>