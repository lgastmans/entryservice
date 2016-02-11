<?php
/* @var $this MemberController */
/* @var $model Member */
?>

<?php
$this->breadcrumbs=array(
	'Members'=>array('index'),
	$model->Name=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label' => 'actions'),
	TbHtml::menuDivider(),
//	array('label'=>'List Member', 'url'=>array('index')),
	array('label'=>'Create', 'url'=>array('create')),
	array('label'=>'View', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

   

<div>
	<div style="float: left;">
		<h1>Update <?php echo $model->Name." ".$model->Surname; ?></h1>
	</div>
	<div style="float: right;">
		<?php
		echo TbHtml::buttonDropdown(
			'Action',
			array(
				array('label'=>'Create', 'url'=>array('create')),
				array('label'=>'View', 'url'=>array('view', 'id'=>$model->ID)),
				array('label'=>'Manage', 'url'=>array('admin')),
			),
			array( 'color' => TbHtml::BUTTON_COLOR_INVERSE)
		);
		?>
	</div>
</div>
<div style="clear:both;"></div>



<?php $this->renderPartial('_form', array('model'=>$model)); ?>