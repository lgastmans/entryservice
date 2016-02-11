<?php
/* @var $this ChildrenController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Childrens',
);

$this->menu=array(
	array('label'=>'Create Children','url'=>array('create')),
	array('label'=>'Manage Children','url'=>array('admin')),
);
?>

<h1>Childrens</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>