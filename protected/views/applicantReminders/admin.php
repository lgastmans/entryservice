<?php
/* @var $this ApplicantRemindersController */
/* @var $model ApplicantReminders */

$this->breadcrumbs=array(
	'Applicant Reminders'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ApplicantReminders', 'url'=>array('index')),
	array('label'=>'Create ApplicantReminders', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('applicant-reminders-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Applicant Reminders</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'applicant-reminders-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID',
		'ApplicantID',
		'ApplicantMilestoneID',
		'Status',
		'Description',
		'EmailMessage',
		/*
		'RepeatInterval',
		'RepeatPeriod',
		'EmailApplicant',
		'EmailTeam',
		'EmailES',
		'DateRecorded',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
