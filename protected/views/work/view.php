<?php
/* @var $this WorkController */
/* @var $model Work */
?>

<?php
$this->breadcrumbs=array(
	'Works'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List Work', 'url'=>array('index')),
	array('label'=>'Create Work', 'url'=>array('create')),
	array('label'=>'Update Work', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete Work', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Work', 'url'=>array('admin')),
);
?>

<h1>View Work #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'ID',
		'ApplicantID',
		'Place',
		'FromDate',
		'ToDate',
		'Notes',
	),
)); ?>