<?php
/* @var $this MeetingController */
/* @var $model Meeting */
?>

<?php
$this->breadcrumbs=array(
	'Meetings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label' => 'actions'),
	TbHtml::menuDivider(),
//	array('label'=>'List Meeting', 'url'=>array('index')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<h1>Create Meeting</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>