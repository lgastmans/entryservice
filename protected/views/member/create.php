<?php
/* @var $this MemberController */
/* @var $model Member */
?>

<?php
$this->breadcrumbs=array(
	'Members'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label' => 'actions'),
	TbHtml::menuDivider(),
//	array('label'=>'List Member', 'url'=>array('index')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>


<div>
	<div style="float: left;">
		<h1>Create Member</h1>
	</div>
	<div style="float: right;">
		<?php
		echo TbHtml::buttonDropdown(
			'Action',
			array(
				array('label'=>'Manage', 'url'=>array('admin')),
			),
			array( 'color' => TbHtml::BUTTON_COLOR_INVERSE)
		);
		?>
	</div>
</div>
<div style="clear:both;"></div>


<?php $this->renderPartial('_form', array('model'=>$model)); ?>