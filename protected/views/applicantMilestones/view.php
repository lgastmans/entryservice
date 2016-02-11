<?php
/* @var $this ApplicantMilestonesController */
/* @var $model ApplicantMilestones */
?>

<?php
$this->breadcrumbs=array(
	'Applicant Milestones'=>array('index'),
	$model->ID,
);


$this->menu=array(
	array('label'=>'List ApplicantMilestones', 'url'=>array('index')),
	array('label'=>'Create ApplicantMilestones', 'url'=>array('create')),
	array('label'=>'Update ApplicantMilestones', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete ApplicantMilestones', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ApplicantMilestones', 'url'=>array('admin')),
);

?>

<?php $this->widget('yiiwheels.widgets.detail.WhDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
//		'ID',
//		'ApplicantID',
		'Description',
		'Status',

		array(
		    'name' => 'DateCreated',
		    'type' => 'raw',
		    'value' =>Yii::app()->dateFormatter->formatDateTime($model->DateCreated, "long", null),
		),
		array(
		    'name' => 'DateStarted',
		    'type' => 'raw',
		    'value' =>(is_null($model->DateStarted) || ($model->DateStarted='0000-00-00'))?'Not set':Yii::app()->dateFormatter->formatDateTime($model->DateStarted, "long", null),
		),
		array(
		    'name' => 'DateCompleted',
		    'type' => 'raw',
		    'value' =>(is_null($model->DateCompleted) || ($model->DateStarted='0000-00-00'))?'Not set':Yii::app()->dateFormatter->formatDateTime($model->DateCompleted, "long", null),
		),

		'Remarks',

		array(
			'name'=>'Timeline',
			'type'=>'raw',
			'value'=>$model->TimelineInterval." ".$model->TimelinePeriod,
		),

		array(
			'name'=>'Alert',
			'type'=>'raw',
			'value'=>($model->Alert)?'On, within '.$model->AlertInterval.' '.$model->AlertPeriod:'Off',
		),
		
		array(
			'name'=>'Repeat',
			'type'=>'raw',
			'value'=>($model->RepeatAlert)?"On":"Off",
			)
	),
)); ?>