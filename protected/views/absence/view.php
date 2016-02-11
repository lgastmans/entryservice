<?php
/* @var $this AbsenceController */
/* @var $model Absence */
?>

<?php
$this->breadcrumbs=array(
	'Absences'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List Absence', 'url'=>array('index')),
	array('label'=>'Create Absence', 'url'=>array('create')),
	array('label'=>'Update Absence', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete Absence', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Absence', 'url'=>array('admin')),
);
?>

<h1>View Absence #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'ID',
		'ApplicantID',
		'StatusID',
		'AbsentOn',
		'AbsentTill',
	),
)); ?>