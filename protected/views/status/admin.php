<?php
/* @var $this StatusController */
/* @var $model Status */


$this->breadcrumbs=array(
	'Statuses'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label' => 'actions'),
	TbHtml::menuDivider(),
//	array('label'=>'List Status', 'url'=>array('index')),
	array('label'=>'Create', 'url'=>array('create')),
	array('label'=>'Position', 'url'=>array('position')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#status-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Statuses</h1>
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

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'status-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'ID',
		'Description',
		array(
			'name'=>'DurationPeriod',
			'value'=>'$data->Duration." ".$data->DurationPeriod',
		),
		array(
			'name' => 'IsProcess',
      'type' => 'text',
      'value' => '($data->IsProcess)?"Yes":"No"',
      'header' => 'NC Process',
			'htmlOptions'=>array('width'=>'75px'),
			'filter' => array('0'=>'No','1'=>'Yes'),
    ),
		array(
			'name'=>'ProcessPosition',
			'value'=>'$data->ProcessPosition', //'($data->IsProcess)?$data->ProcessPosition:""',
			'htmlOptions'=>array('width'=>'50px'),
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
