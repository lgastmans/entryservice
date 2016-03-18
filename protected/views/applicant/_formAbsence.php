<div id="applicantAbsenceDialog"></div>

<?php

$this->widget('bootstrap.widgets.TbGridView',array(
//$this->widget('yiiwheels.widgets.grid.WhGridView',array(
	'id'=>'applicant-absence-grid',
//	'fixedHeader' => false,
	'type' => TbHtml::GRID_TYPE_CONDENSED, //'striped',
	'dataProvider' => $model->search($applicant_id),
//	'responsiveTable' => true,
	'template' => "{items}",
	//'filter'=>$model,
	'columns'=>array(
		//'community.Name',
		array(
			'name'=>'StatusID',
			'header'=>'Status',
			'value'=>'$data->status->Description',
		),
		array(
			'name'=>'AbsentOn',
			'header' => 'From',
			'value'=>'Yii::app()->dateFormatter->format("dd-MM-yyyy", $data->AbsentOn)',
		),
		array(
			'name'=>'AbsentTill',
			'header' => 'To',
			'value'=>'Yii::app()->dateFormatter->format("dd-MM-yyyy", $data->AbsentTill)',
		),

		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{update}{delete}',
			'buttons'=>array(
		        'update' => array(
                    'label'=>'Edit',
                    'icon'=>'icon-edit',
                    'url'=>'Yii::app()->createUrl("absence/editAbsence", array("absence_id"=>$data->primaryKey,"asDialog"=>1,"gridId"=>$this->grid->id))',
                    'click'=>'function(){
                        $("#absence-cru-frame").attr("src",$(this).attr("href"));
                        $("#absence-cru-dialog").dialog("open");
                        return false;
                    }',
		        ),
				'delete' => array(
					'label'=>'delete absence',
					'icon'=>'remove',
					'url'=>'Yii::app()->createUrl("absence/delete", array("id"=>$data->ID))',
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
    'id'=>'absence-cru-dialog',
    'options'=>array(
        'title'=>'Absence Details',
        'autoOpen'=>false,
        'modal'=>false,
        'width'=>600,
        'height'=>650,
    ),
));
?>
<iframe id="absence-cru-frame" width="100%" height="100%"></iframe>
<?php $this->endWidget(); ?>