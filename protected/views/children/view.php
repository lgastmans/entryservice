<?php
/* @var $this ChildrenController */
/* @var $model Children */
?>

<?php
$this->breadcrumbs=array(
	'Childrens'=>array('index'),
	$model->Name,
);

$this->menu=array(
	array('label'=>'List Children', 'url'=>array('index')),
	array('label'=>'Create Children', 'url'=>array('create')),
	array('label'=>'Update Children', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete Children', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Children', 'url'=>array('admin')),
);
?>

<h1>View Children #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'ID',
		'ApplicantID',
		'Name',
		'Surname',
		'PassportNumber',
		'IssuedDate',
		'ValidTill',
		'BirthDate',
	),
)); ?>