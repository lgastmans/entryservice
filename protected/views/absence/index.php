<?php
/* @var $this AbsenceController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Absences',
);

$this->menu=array(
	array('label'=>'Create Absence','url'=>array('create')),
	array('label'=>'Manage Absence','url'=>array('admin')),
);
?>

<h1>Absences</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>