<?php
/* @var $this InterviewController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Interviews',
);

$this->menu=array(
	array('label'=>'Create Interview','url'=>array('create')),
	array('label'=>'Manage Interview','url'=>array('admin')),
);
?>

<h1>Interviews</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>