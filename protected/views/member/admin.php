<?php
/* @var $this MemberController */
/* @var $model Member */


$this->breadcrumbs=array(
	'Members'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label' => 'actions'),
	TbHtml::menuDivider(),
//	array('label'=>'List Member', 'url'=>array('index')), 
	array('label'=>'Create', 'url'=>array('create')),
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#member-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<div>
	<div style="float: left;">
		<h1>Manage Members</h1>
	</div>
	<div style="float: right;">
		<?php
		echo TbHtml::buttonDropdown(
			'Action',
			array(
				array('label' => 'Create', 'url' => array('create')),
			),
			array( 'color' => TbHtml::BUTTON_COLOR_INVERSE)
		);
		?>
	</div>
</div>
<div style="clear:both;"></div>

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

//$this->widget('yiiwheels.widgets.grid.WhGridView', array(
$this->widget('bootstrap.widgets.TbGridView',array(
	'id' => 'member-grid',
//	'fixedHeader' => true,
//	'headerOffset' => 40,
	'type' => TbHtml::GRID_TYPE_CONDENSED, //'striped',
	'dataProvider' => $model->search(),
//	'responsiveTable' => true,
	'template' => "{items}",
	'filter'=>$model,
	'columns' => array(
		//'ID',
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'Name',
			'sortable'=>true,
			'headerHtmlOptions' => array('class' => 'span2'),
			'editable' => array(
				'url' => $this->createUrl('member/editable'),
				'placement' => 'bottom',
				'inputclass' => 'span2'
			)
		),
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'Surname',
			'sortable'=>true,
			'editable' => array(
				'url' => $this->createUrl('member/editable'),
				'placement' => 'bottom',
				'inputclass' => 'span3'
			)
		),
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'Email',
			'sortable'=>true,
			'editable' => array(
				'url' => $this->createUrl('member/editable'),
				'placement' => 'bottom',
				'inputclass' => 'span3'
			)
		),
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'Phone',
			'sortable'=>true,
			'headerHtmlOptions' => array('class' => 'span2'),
			'editable' => array(
				'url' => $this->createUrl('member/editable'),
				'placement' => 'bottom',
				'inputclass' => 'span3'
			)
		),
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'FromDate',
		    //'value' => 'Yii::app()->dateFormatter->formatDateTime($data->FromDate, "long", null)',
			'headerHtmlOptions' => array('style' => 'width: 100px'),
			'editable' => array(
				'type' => 'date',
				'format' => 'yyyy-mm-dd',
				'viewformat' => 'dd-mm-yyyy',
				'url' => $this->createUrl('member/editable'),
				'placement' => 'bottom',
			)
		),
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'ToDate',
		    //'value' => 'Yii::app()->dateFormatter->formatDateTime($data->FromDate, "long", null)',
			'headerHtmlOptions' => array('style' => 'width: 100px'),
			'editable' => array(
				'type' => 'date',
				'format' => 'yyyy-mm-dd',
				'viewformat' => 'dd-mm-yyyy',
				'url' => $this->createUrl('member/editable'),
				'placement' => 'bottom',
			)
		),
		array(
		    'name' => 'ReceiveEmail',
		    'type' => 'raw',
		    'value' => '($data->ReceiveEmail)?"Yes":"No"',
		),
		/* 
		array(
		    'name' => 'FromDate',
		    'type' => 'raw',
		    'value' => 'Yii::app()->dateFormatter->formatDateTime($data->FromDate, "long", null)'
		),
		array(
		    'name' => 'ToDate',
		    'type' => 'raw',
		    'value' => 'Yii::app()->dateFormatter->formatDateTime($data->ToDate, "long", null)'
		),
		*/

		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
));
?>