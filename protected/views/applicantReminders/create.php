<?php
/* @var $this ApplicantRemindersController */
/* @var $model ApplicantReminders */

$this->breadcrumbs=array(
	'Applicant Reminders'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ApplicantReminders', 'url'=>array('index')),
	array('label'=>'Manage ApplicantReminders', 'url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>