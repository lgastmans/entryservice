<?php
/* @var $this MemberController */
/* @var $model Member */
?>

<?php
$this->breadcrumbs=array(
	'Members'=>array('index'),
	$model->Name,
);

$this->menu=array(
	array('label'=>'List Member', 'url'=>array('index')),
	array('label'=>'Create Member', 'url'=>array('create')),
	array('label'=>'Update Member', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete Member', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Member', 'url'=>array('admin')),
);
?>

<div>
	<div style="float: left;">
		<h1><?php echo $model->Name." ".$model->Surname; ?></h1>
	</div>
	<div style="float: right;">
		<?php
		echo TbHtml::buttonDropdown(
			'Action',
			array(
				array('label'=>'Create Member', 'url'=>array('create')),
				array('label'=>'Update Member', 'url'=>array('update', 'id'=>$model->ID)),
				array('label'=>'Delete Member', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
				array('label'=>'Manage Member', 'url'=>array('admin')),
			),
			array( 'color' => TbHtml::BUTTON_COLOR_INVERSE)
		);
		?>
	</div>
</div>
<div style="clear:both;"></div>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'ID',
		'Name',
		'Surname',
		'FromDate',
		'ToDate',
	),
)); ?>