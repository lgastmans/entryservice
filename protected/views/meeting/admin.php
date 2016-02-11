<?php
/* @var $this MeetingController */
/* @var $model Meeting */


$this->breadcrumbs=array(
	'Meetings'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label' => 'actions'),
	TbHtml::menuDivider(),
//	array('label'=>'List Meeting', 'url'=>array('index')),
	array('label'=>'Create', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#meeting-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Meetings</h1>

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
	'id'=>'meeting-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'ID',
		'Category',
		//'MeetingDate',
		array(
		    'name' => 'MeetingDate',
		    'type' => 'raw',
		    'value' => 'Yii::app()->dateFormatter->formatDateTime($data->MeetingDate, "long", null)'
		),
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'Title',
			'sortable'=>true,
			'editable' => array(
				'url' => $this->createUrl('meeting/editable'),
				'placement' => 'right',
				'inputclass' => 'span3'
			)
		),
		//'Content',
		array(
           	'name'=>'meetingMembers.Name',
			//'label'=>'Attended',
			'type'=>'text',
			'value'=>'$data->getNames()',
        ),

		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>