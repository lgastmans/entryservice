<?php
/* @var $this SchoolController */
/* @var $model School */
?>

<?php
$this->breadcrumbs=array(
	'Schools'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label' => 'actions'),
	TbHtml::menuDivider(),
	array('label'=>'List', 'url'=>array('index')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<h2>Create School</h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>