<?php
/* @var $this MilestoneController */
/* @var $model Milestone */


$this->breadcrumbs=array(
	'Milestones'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label' => 'actions'),
	TbHtml::menuDivider(),
//	array('label'=>'List Milestone', 'url'=>array('index')),
	array('label'=>'Create', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#milestone-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Milestones</h1>
<!--
<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
        &lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>
-->
<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php 
//$this->widget('yiiwheels.widgets.grid.WhGridView',array(
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'milestone-grid',
//	'fixedHeader' => true,
//	'headerOffset' => 40,
	'type' => 'striped',
	'dataProvider' => $model->search(),
//	'responsiveTable' => true,
	'template' => "{items}",
	'filter'=>$model,
	'columns'=>array(
		//'ID',
		//'MilestoneCategoryID',
		//'Description',
		array(
			'name' => 'Description',
			'htmlOptions'=>array('width'=>'200px'),
		),
		//'TimelineInterval',
		//'TimelinePeriod',
		//'SendEmail',
		array(
			'name'=>'TimelinePeriod',
			'value'=>'$data->TimelineInterval." ".$data->TimelinePeriod',
		),
		array(
			'name'=>'category_fs', 
			'value'=>'$data->milestoneCategory->Description',
		),
		/*
		array(
           	'name'=>'milestoneCategory.Description',
			'type'=>'text',
        ),
		*/
		/*
		'ColorIndicator',
		'Alert',
		'AlertInterval',
		'AlertPeriod',
		'RepeatAlert',
		'IsAlerted',
		*/
 		array(
 			'name' => 'IsActive',
            'type' => 'text',
            'value' => '($data->IsActive)?"Yes":"No"',
            'header' => 'Active',
			'htmlOptions'=>array('width'=>'50px'),
        ),
 		array(
 			'name' => 'IsDefault',
            'type' => 'text',
            'value' => '($data->IsDefault)?"Yes":"No"',
            'header' => 'Add',
			'htmlOptions'=>array('width'=>'50px'),
        ),
		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>