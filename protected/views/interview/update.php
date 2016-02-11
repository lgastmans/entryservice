<?php
/* @var $this InterviewController */
/* @var $model Interview */
?>

<?php
$this->breadcrumbs=array(
	'Interviews'=>array('index'),
	$model->Title=>array('view','id'=>$model->ApplicantID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Interview', 'url'=>array('index')),
	array('label'=>'Create Interview', 'url'=>array('create')),
	array('label'=>'View Interview', 'url'=>array('view', 'id'=>$model->ApplicantID)),
	array('label'=>'Manage Interview', 'url'=>array('admin')),
);
?>

<?php print_r($_GET);die();?>

<h1>Update Interview <?php echo $model->ApplicantID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>