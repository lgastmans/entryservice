<?php
/* @var $this ApplicantStatisticsController */
/* @var $model ApplicantStatistics */
?>

<?php
$this->breadcrumbs=array(
	'Applicant Statistics'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List ApplicantStatistics', 'url'=>array('index')),
	array('label'=>'Create ApplicantStatistics', 'url'=>array('create')),
	array('label'=>'Update ApplicantStatistics', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete ApplicantStatistics', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ApplicantStatistics', 'url'=>array('admin')),
);
?>

<h1>View ApplicantStatistics #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'ID',
		'ApplicantID',
		'CategoryID',
		'AnswerID',
		'DateRecorded',
		'Notes',
	),
)); ?>