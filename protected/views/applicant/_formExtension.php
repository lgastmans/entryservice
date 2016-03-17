<div id="applicantExtensionDialog"></div>

<?php

$this->widget('bootstrap.widgets.TbGridView',array(
//$this->widget('yiiwheels.widgets.grid.WhGridView',array(
	'id'=>'applicant-extension-grid',
//	'fixedHeader' => false,
	'type' => TbHtml::GRID_TYPE_CONDENSED, //'striped',
	'dataProvider' => $model->search($applicant_id),
//	'responsiveTable' => true,
	'template' => "{items}",
	//'filter'=>$model,
	'columns'=>array(

		array(
			//'name'=>'current_status',
			'name'=>'StatusID',
			'header'=>'Status',
			'value'=>'$data->status->Description',
		),
		array(
			'name'=>'ExtendedOn',
			'header' => 'Started',
			'value'=>'Yii::app()->dateFormatter->format("dd-MM-yyyy", $data->ExtendedOn)',
		),
		array(
			'name'=>'ExtendedPeriod',
			'header'=>'Period',
			'value'=>'$data->ExtendedFor." ".$data->ExtendedPeriod',
		),
		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{update}{delete}',
			'buttons'=>array(
		        'update' => array(
                    'label'=>'Edit',
                    'icon'=>'icon-edit',
                    'url'=>'Yii::app()->createUrl("extension/editExtension", array("applicant_id"=>$data->primaryKey,"asDialog"=>1,"gridId"=>$this->grid->id))',
                    'click'=>'function(){
                        $("#extension-cru-frame").attr("src",$(this).attr("href"));
                        $("#extension-cru-dialog").dialog("open");
                        return false;
                    }',
		        ),
				'delete' => array(
					'label'=>'delete extension',
					'icon'=>'remove',
					'url'=>'Yii::app()->createUrl("extension/delete", array("id"=>$data->ID))',
					// 'options'=>array(
					// 	'class'=>'btn btn-small',
					// ),
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
    'id'=>'extension-cru-dialog',
    'options'=>array(
        'title'=>'Extension Details',
        'autoOpen'=>false,
        'modal'=>false,
        'width'=>600,
        'height'=>650,
    ),
));
?>
<iframe id="extension-cru-frame" width="100%" height="100%"></iframe>
<?php $this->endWidget(); ?>