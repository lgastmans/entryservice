<?php
/* @var $this MilestoneController */
/* @var $model Milestone */
?>

<?php
$this->breadcrumbs=array(
	'Milestones'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label' => 'actions'),
	TbHtml::menuDivider(),
	//array('label'=>'List Milestone', 'url'=>array('index')),
	array('label'=>'Create', 'url'=>array('create')),
	array('label'=>'Update', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<h1>View Milestone</h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'ID',
		'MilestoneCategoryID',
		'Description',
		'TimelineInterval',
		'TimelinePeriod',
		'SendEmail',
		'Alert',
		'AlertInterval',
		'AlertPeriod',
		'RepeatAlert',
		'IsAlerted',
		'IsActive',
		'IsDefault',
	),
)); ?>