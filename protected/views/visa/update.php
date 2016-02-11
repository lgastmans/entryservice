<?php
/* @var $this VisaController */
/* @var $model Visa */
?>

<?php
$this->breadcrumbs=array(
	'Visas'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Visa', 'url'=>array('index')),
	array('label'=>'Create Visa', 'url'=>array('create')),
	array('label'=>'View Visa', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage Visa', 'url'=>array('admin')),
);
?>

    <h1>Update Visa <?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>