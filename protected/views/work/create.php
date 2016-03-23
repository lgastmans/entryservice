<?php
/* @var $this WorkController */
/* @var $model Work */
?>

<?php
$this->breadcrumbs=array(
	'Works'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Work', 'url'=>array('index')),
	array('label'=>'Manage Work', 'url'=>array('admin')),
);
?>


<?php $this->renderPartial('_form', array('model'=>$model)); ?>