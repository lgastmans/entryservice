<?php
/* @var $this IndianIDController */
/* @var $model IndianID */
?>

<?php
$this->breadcrumbs=array(
	'Indian Ids'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List IndianID', 'url'=>array('index')),
	array('label'=>'Create IndianID', 'url'=>array('create')),
	array('label'=>'View IndianID', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage IndianID', 'url'=>array('admin')),
);
?>

    <h1>Update IndianID <?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>