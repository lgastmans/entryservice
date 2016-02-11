<?php
/* @var $this PassportController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Passports',
);

$this->menu=array(
	array('label'=>'Create Passport','url'=>array('create')),
	array('label'=>'Manage Passport','url'=>array('admin')),
);
?>

<h1>Passports</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>