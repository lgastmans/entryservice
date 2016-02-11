<?php
/* @var $this ExtensionController */
/* @var $model Extension */
?>

<?php
$this->breadcrumbs=array(
	'Extensions'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List Extension', 'url'=>array('index')),
	array('label'=>'Create Extension', 'url'=>array('create')),
	array('label'=>'Update Extension', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete Extension', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Extension', 'url'=>array('admin')),
);
?>

<h1>View Extension #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'ID',
		'ApplicantID',
		'StatusID',
		'ExtendedOn',
		'ExtendedFor',
		'ExtendedPeriod',
	),
)); ?>