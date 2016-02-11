<?php
/* @var $this VisaController */
/* @var $model Visa */
?>

<?php
$this->breadcrumbs=array(
	'Visas'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List Visa', 'url'=>array('index')),
	array('label'=>'Create Visa', 'url'=>array('create')),
	array('label'=>'Update Visa', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete Visa', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Visa', 'url'=>array('admin')),
);
?>

<h1>View Visa #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'ID',
		'VisaType',
		'Number',
		'IssuedDate',
		'ValidTill',
	),
)); ?>