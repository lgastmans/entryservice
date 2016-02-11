<?php
/* @var $this ApplicantStatisticsController */
/* @var $model ApplicantStatistics */
?>

<?php
$this->breadcrumbs=array(
	'Applicant Statistics'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List ApplicantStatistics', 'url'=>array('index')),
	array('label'=>'Create ApplicantStatistics', 'url'=>array('create')),
	array('label'=>'View ApplicantStatistics', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage ApplicantStatistics', 'url'=>array('admin')),
);
?>

    <h1>Update ApplicantStatistics <?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>