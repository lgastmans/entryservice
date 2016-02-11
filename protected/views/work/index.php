<?php
/* @var $this WorkController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Works',
);

$this->menu=array(
	array('label'=>'Create Work','url'=>array('create')),
	array('label'=>'Manage Work','url'=>array('admin')),
);
?>

<h1>Works</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>