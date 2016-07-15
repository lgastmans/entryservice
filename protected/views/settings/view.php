<?php
/* @var $this SettingsController */
/* @var $model Settings */
?>

<?php
$this->breadcrumbs=array(
	'Settings'=>array('index'),
	$model->ID,
);

$this->menu=array(
	//array('label'=>'List Settings', 'url'=>array('index')),
	//array('label'=>'Create Settings', 'url'=>array('create')),
	array('label'=>'Update Settings', 'url'=>array('update', 'id'=>$model->ID)),
	//array('label'=>'Delete Settings', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage Settings', 'url'=>array('admin')),
);
?>

<h1>Settings</h1>

<?php
	echo TbHtml::ajaxButton(
        'Check for Updates',
        array('settings/checkUpdates'),
        array(
	        'dataType'=>'json',
	        'type'=>'post',
					'url' => CController::createUrl('settings/checkUpdates'),
					//'data' => '',
			'success'=>"js:function(data) {
				var obj = jQuery.parseJSON(data);
				//$('#update-output').html('output:' + obj.output + ', result: ' + obj.result);
				console.log(obj);
			}",
        ),
        array(
	        'id'=>'btn-update',
	        'color'=>TbHtml::BUTTON_COLOR_DEFAULT,
	        'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
        )
    );
?>

<span id="update-output"></span>
<br><br>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		//'ID',
		'email',
	),
)); ?>