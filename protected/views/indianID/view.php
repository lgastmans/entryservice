<?php
/* @var $this IndianIDController */
/* @var $model IndianID */
?>

<?php
$this->breadcrumbs=array(
	'Indian Ids'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List IndianID', 'url'=>array('index')),
	array('label'=>'Create IndianID', 'url'=>array('create')),
	array('label'=>'Update IndianID', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete IndianID', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage IndianID', 'url'=>array('admin')),
);
?>

<h1>View IndianID #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'ID',
		'TypeID',
		'Number',
		'IssuedDate',
		'ValidTill',
	),
)); ?>