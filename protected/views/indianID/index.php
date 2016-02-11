<?php
/* @var $this IndianIDController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Indian Ids',
);

$this->menu=array(
	array('label'=>'Create IndianID','url'=>array('create')),
	array('label'=>'Manage IndianID','url'=>array('admin')),
);
?>

<h1>Indian Ids</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>