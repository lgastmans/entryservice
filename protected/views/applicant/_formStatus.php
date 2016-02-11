
<div id="applicantStatusDialog"></div>

<?php
    $this->widget( 'ext.EUpdateDialog.EUpdateDialog' );
?>

<style>
	.nRed {
		color: red;
		font-weight:bold;
	}
	.nNormal {
		color: black;
		font-weight:normal;
	}
	.grid-view .table th{
		line-height: 12px !important;
	}
	.grid-view .table th > .sort-link {
	  font-size: 11px !important;
	}
</style>

<?php

$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'applicant-status-grid',
	'type' => TbHtml::GRID_TYPE_CONDENSED, //'striped',
	'dataProvider' => $model->search($applicant_id),
	'template' => "{items}",
	'columns'=>array(
		/*
		 * @property string $Email
		 * @property string $IsPrimary
		*/
		array(
			'name'=>'current_status',
			'header'=>'Status',
			'value'=>'$data->status->Description',
		),
		array(
			'name'=>'StartedOn',
			'header' => 'Started',
			'value'=>'Yii::app()->dateFormatter->formatDateTime($data->StartedOn, "long", null)',
		),
		array(
			'name'=>'CompletedOn',
			'header' => 'Completed',
			'value'=>'Yii::app()->dateFormatter->formatDateTime($data->CompletedOn, "long", null)',
		),
		'NewsAndNotes',
		/*
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'StatusID',
			'headerHtmlOptions' => array('style' => 'width: 150px'),
			'editable' => array(
				'type' => 'select',
				//'model' => $model,
				'attribute' => 'StatusID',
				'url' => $this->createUrl('applicantStatus/editable'),
				'placement' => 'right',
				'source' => CHtml::listData(Status::model()->findAll(), 'ID', 'Description')
			)
		),
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'StartedOn',
			'header' => 'Started',
			'sortable'=>true,
			'headerHtmlOptions' => array('style' => 'width: 100px'),
			'editable' => array(
				'type' => 'date',
				'format' => 'yyyy-mm-dd',
				'viewformat' => 'd M yyyy', //dd-mm-yyyy',
				'url' => $this->createUrl('applicantStatus/editable'),
				'placement' => 'bottom',
				'inputclass' => 'span3',
			)
		),
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'CompletedOn',
			'header' => 'Completed',
			'sortable'=>true,
			'headerHtmlOptions' => array('style' => 'width: 100px'),
			'editable' => array(
				'type' => 'date',
				'format' => 'yyyy-mm-dd',
				'viewformat' => 'd M yyyy',
				'url' => $this->createUrl('applicantStatus/editable'),
				'placement' => 'bottom',
				'inputclass' => 'span3'
			)
		),
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'NewsAndNotes',
			'header' => 'N & N',
			'headerHtmlOptions' => array('style' => 'width: 60px'),
			'editable' => array(
				'attribute' => 'NewsAndNotes',
				'url' => $this->createUrl('applicantStatus/editable'),
			)
		),
		*/
		array(
			'name'=>'DurationPeriod',
			'header' => 'Duration',
			'value'=>'($data->DurationPeriod=="None")?" ":$data->Duration." ".$data->DurationPeriod',
		),
		/*
		array(
		    'name' => '',
		    'type' => 'raw',
		    'value' => '$data->notification',
			'cssClassExpression' => '$data->notification <=0 ? "nRed" : "nNormal"',
			//'rowCssClassExpression'=>'$data->notification <= 0?"row-open":"row-closed"',
		),
		*/

		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{update}{delete}',
			'buttons'=>array(
		        'update' => array(
                    'label'=>'Edit',
                    'icon'=>'icon-edit',
                    'url'=>'Yii::app()->createUrl("applicantStatus/editStatus", array("applicant_id"=>$data->primaryKey,"asDialog"=>1,"gridId"=>$this->grid->id))',
                    'click'=>'function(){
                        $("#status-cru-frame").attr("src",$(this).attr("href"));
                        $("#status-cru-dialog").dialog("open");
                        return false;
                    }',
		        ),
				'delete' => array(
						'label'=>'delete status',
						'icon'=>'remove',
						'url'=>'Yii::app()->createUrl("applicantStatus/delete", array("id"=>$data->ID))',
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
    'id'=>'status-cru-dialog',
    'options'=>array(
        'title'=>'Status Details',
        'autoOpen'=>false,
        'modal'=>false,
        'width'=>600,
        'height'=>650,
    ),
));
?>
<iframe id="status-cru-frame" width="100%" height="100%"></iframe>
<?php $this->endWidget(); ?>


