<?php
/* @var $this MemberController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Members',
);

$this->menu=array(
	array('label' => 'actions'),
	TbHtml::menuDivider(),
	array('label'=>'Create','url'=>array('create')),
	array('label'=>'Manage','url'=>array('admin')),
);
?>

<div>
	<div style="float: left;">
		<h1>Members</h1>
	</div>
	<div style="float: right;">
		<?php
		echo TbHtml::buttonDropdown(
			'Action',
			array(
				array('label'=>'Create','url'=>array('create')),
				array('label'=>'Manage','url'=>array('admin')),
			),
			array( 'color' => TbHtml::BUTTON_COLOR_INVERSE)
		);
		?>
	</div>
</div>
<div style="clear:both;"></div>



<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>