<?php
/* @var $this SettingsController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Settings',
);

$this->menu=array(
	array('label'=>'Create Settings','url'=>array('create')),
	array('label'=>'Manage Settings','url'=>array('admin')),
);
?>

<h1>Settings</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>