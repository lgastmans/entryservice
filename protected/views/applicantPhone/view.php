<?php
/* @var $this ApplicantPhoneController */
/* @var $model ApplicantPhone */
?>

<?php
$this->breadcrumbs=array(
	'Applicant Phones'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List ApplicantPhone', 'url'=>array('index')),
	array('label'=>'Create ApplicantPhone', 'url'=>array('create')),
	array('label'=>'Update ApplicantPhone', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete ApplicantPhone', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ApplicantPhone', 'url'=>array('admin')),
);
?>

<h1>View ApplicantPhone #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'ID',
		'ApplicantID',
		'ContactType',
		'Number',
		'IsPrimary',
	),
)); ?>