<?php
/* @var $this ExtensionController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Extensions',
);

$this->menu=array(
	array('label'=>'Create Extension','url'=>array('create')),
	array('label'=>'Manage Extension','url'=>array('admin')),
);
?>

<h1>Extensions</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>