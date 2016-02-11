<?php
/* @var $this VisaController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Visas',
);

$this->menu=array(
	array('label'=>'Create Visa','url'=>array('create')),
	array('label'=>'Manage Visa','url'=>array('admin')),
);
?>

<h1>Visas</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>