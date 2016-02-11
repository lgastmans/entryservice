<?php
/* @var $this StatisticsAnswerController */
/* @var $model StatisticsAnswer */
?>

<?php
$this->breadcrumbs=array(
	'Statistics Answers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label' => 'actions'),
	TbHtml::menuDivider(),
	//array('label'=>'List StatisticsAnswer', 'url'=>array('index')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<h1>Create Statistics Answer</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>