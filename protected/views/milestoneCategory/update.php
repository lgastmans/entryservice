<?php
/* @var $this MilestoneCategoryController */
/* @var $model MilestoneCategory */
?>

<?php
$this->breadcrumbs=array(
	'Milestone Categories'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label' => 'actions'),
	TbHtml::menuDivider(),
//	array('label'=>'List MilestoneCategory', 'url'=>array('index')),
	array('label'=>'Create', 'url'=>array('create')),
	array('label'=>'View', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

    <h1>Update Milestone Category </h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>