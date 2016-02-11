<?php
/* @var $this PassportController */
/* @var $model Passport */
?>

<?php
$this->breadcrumbs=array(
	'Passports'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Passport', 'url'=>array('index')),
	array('label'=>'Create Passport', 'url'=>array('create')),
	array('label'=>'View Passport', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage Passport', 'url'=>array('admin')),
);
?>

    <h1>Update Passport <?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>