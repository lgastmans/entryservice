<?php
/* @var $this CommunityController */
/* @var $model Community */
?>

<?php
$this->breadcrumbs=array(
	'Communities'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label' => 'actions'),
	TbHtml::menuDivider(),
	//array('label'=>'List Community', 'url'=>array('index')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<h1>Create Community</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>