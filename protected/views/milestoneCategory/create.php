<?php
/* @var $this MilestoneCategoryController */
/* @var $model MilestoneCategory */
?>

<?php
$this->breadcrumbs=array(
	'Milestone Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label' => 'actions'),
	TbHtml::menuDivider(),
	//array('label'=>'List MilestoneCategory', 'url'=>array('index')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<h1>Create Milestone Category</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>