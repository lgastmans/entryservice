<?php
/* @var $this ApplicantRemindersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Applicant Reminders',
);

$this->menu=array(
	array('label'=>'Create ApplicantReminders', 'url'=>array('create')),
	array('label'=>'Manage ApplicantReminders', 'url'=>array('admin')),
);
?>

<h1>Applicant Reminders</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
