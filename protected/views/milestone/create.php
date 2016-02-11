<?php
/* @var $this MilestoneController */
/* @var $model Milestone */
?>

<?php
$this->breadcrumbs=array(
	'Milestones'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label' => 'actions'),
	TbHtml::menuDivider(),
//	array('label'=>'List Milestone', 'url'=>array('index')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<h1>Create Milestone</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>