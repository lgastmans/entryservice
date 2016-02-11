<?php
	$this->widget('bootstrap.widgets.TbGridView',array(
		'id'=>'applicant-emergency-grid',
		'type' => TbHtml::GRID_TYPE_CONDENSED, //'striped',
		'dataProvider' => $model->search($applicant_id,'Emergency'),
		'template' => "{items}",
		'columns'=>array(
	    'FullName',
	    'Email',
	    'Phone',
			array(
				'class'=>'bootstrap.widgets.TbButtonColumn',
				'template'=>'{update}{delete}',
				'buttons'=>array(
	        'update' => array(
	            'label'=>'Edit',
	            'icon'=>'icon-edit',
	            'url'=>'Yii::app()->createUrl("contact/editContact", array("id"=>$data->primaryKey,"asDialog"=>1,"gridId"=>$this->grid->id,"category"=>"emergency"))',
	            'click'=>'function(){
	                $("#emergency-cru-frame").attr("src",$(this).attr("href"));
	                $("#emergency-cru-dialog").dialog("open");
	                return false;
	            }',
	        ),
					'delete' => array(
							'label'=>'delete contact',
							'icon'=>'remove',
							'url'=>'Yii::app()->createUrl("contact/delete", array("id"=>$data->ID))',
					),
				),
			),

		),
	));
?>

<?php
/*
    the EDIT dialog
*/
// add the (closed) dialog for the iframe
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'emergency-cru-dialog',
    'options'=>array(
        'title'=>'Emergency Contact',
        'autoOpen'=>false,
        'modal'=>false,
        'width'=>600,
        'height'=>675,
    ),
));
?>
<iframe id="emergency-cru-frame" width="100%" height="100%"></iframe>
<?php $this->endWidget(); ?>
