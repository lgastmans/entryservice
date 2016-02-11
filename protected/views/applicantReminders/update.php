<?php
/* @var $this ApplicantRemindersController */
/* @var $model ApplicantReminders */

$this->breadcrumbs=array(
	'Applicant Reminders'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List ApplicantReminders', 'url'=>array('index')),
	array('label'=>'Create ApplicantReminders', 'url'=>array('create')),
	array('label'=>'View ApplicantReminders', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage ApplicantReminders', 'url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>