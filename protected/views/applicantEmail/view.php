<?php
/* @var $this ApplicantEmailController */
/* @var $model ApplicantEmail */
?>

<?php
$this->breadcrumbs=array(
	'Applicant Emails'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List ApplicantEmail', 'url'=>array('index')),
	array('label'=>'Create ApplicantEmail', 'url'=>array('create')),
	array('label'=>'Update ApplicantEmail', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete ApplicantEmail', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ApplicantEmail', 'url'=>array('admin')),
);
?>

<h1>View ApplicantEmail #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'ID',
		'ApplicantID',
		'Email',
		'IsPrimary',
	),
)); ?>