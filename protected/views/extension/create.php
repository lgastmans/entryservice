<?php
/* @var $this ExtensionController */
/* @var $model Extension */
?>

<?php
$this->breadcrumbs=array(
	'Extensions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Extension', 'url'=>array('index')),
	array('label'=>'Manage Extension', 'url'=>array('admin')),
);
?>


<?php $this->renderPartial('_form', array('model'=>$model)); ?>