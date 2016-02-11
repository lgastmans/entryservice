<?php
/* @var $this StatisticsCategoryController */
/* @var $model StatisticsCategory */
?>

<?php
$this->breadcrumbs=array(
	'Statistics Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label' => 'actions'),
	TbHtml::menuDivider(),
	//array('label'=>'List StatisticsCategory', 'url'=>array('index')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<h1>Create Statistics Category</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>