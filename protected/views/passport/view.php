<?php
/* @var $this PassportController */
/* @var $model Passport */
?>

<?php
$this->breadcrumbs=array(
	'Passports'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List Passport', 'url'=>array('index')),
	array('label'=>'Create Passport', 'url'=>array('create')),
	array('label'=>'Update Passport', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete Passport', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Passport', 'url'=>array('admin')),
);
?>

<h1>View Passport #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'ID',
		'PassportNumber',
		'IssuedDate',
		'ValidTill',
		'IssuedBy',
	),
)); ?>