<?php
/* @var $this ApplicantStatusController */
/* @var $model ApplicantStatus */
?>

<?php
$this->breadcrumbs=array(
	'Applicant Statuses'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List ApplicantStatus', 'url'=>array('index')),
	array('label'=>'Create ApplicantStatus', 'url'=>array('create')),
	array('label'=>'Update ApplicantStatus', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete ApplicantStatus', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ApplicantStatus', 'url'=>array('admin')),
);
?>

<h1>View ApplicantStatus #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'ID',
		'ApplicantID',
		'StatusID',
		'StartedOn',
		'CompletedOn',
		'Color',
		'Duration',
		'DurationPeriod',
	),
)); ?>