<?php
/* @var $this ApplicantRemindersController */
/* @var $model ApplicantReminders */

$this->breadcrumbs=array(
	'Applicant Reminders'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List ApplicantReminders', 'url'=>array('index')),
	array('label'=>'Create ApplicantReminders', 'url'=>array('create')),
	array('label'=>'Update ApplicantReminders', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete ApplicantReminders', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ApplicantReminders', 'url'=>array('admin')),
);
?>

<h1>View ApplicantReminders #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'ApplicantID',
		'ApplicantMilestoneID',
		'Status',
		'Description',
		'EmailMessage',
		'RepeatInterval',
		'RepeatPeriod',
		'EmailApplicant',
		'EmailTeam',
		'EmailES',
		'DateRecorded',
	),
)); ?>
