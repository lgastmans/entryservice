<?php
/* @var $this MeetingController */
/* @var $model Meeting */
?>

<?php
$this->breadcrumbs=array(
	'Meetings'=>array('index'),
	$model->ID,
);

$this->menu=array(
//	array('label'=>'List Meeting', 'url'=>array('index')),
	array('label' => 'actions'),
	TbHtml::menuDivider(),
	array('label'=>'Create', 'url'=>array('create')),
	array('label'=>'Update', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->Title; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		//'ID',
		'Category',
		'Title',
		'MeetingDate',
		/*
		array(
			'name'=>'Content',
			'type'=>'html',
			//'value'=>'Content'
		),
		*/
	),
)); 
?>


<div id="well well">
	<?php
		
		echo $model->Content;

	?>
</div>


