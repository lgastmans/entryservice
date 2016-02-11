<?php
/* @var $this MeetingController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Meetings',
);

$this->menu=array(
	array('label' => 'actions'),
	TbHtml::menuDivider(),
	array('label'=>'Create','url'=>array('create')),
	array('label'=>'Manage','url'=>array('admin')),
);
?>

<h1>Meetings</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>