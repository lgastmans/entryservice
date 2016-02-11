<?php
/* @var $this StatisticsCategoryController */
/* @var $model StatisticsCategory */
?>

<?php
$this->breadcrumbs=array(
	'Statistics Categories'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label' => 'actions'),
	TbHtml::menuDivider(),
	//array('label'=>'List StatisticsCategory', 'url'=>array('index')),
	array('label'=>'Create', 'url'=>array('create')),
	array('label'=>'View', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

    <h1>Update Statistics Category</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>