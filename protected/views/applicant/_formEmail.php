
<div id="applicantEmailDialog"></div>

<?php
    $this->widget( 'ext.EUpdateDialog.EUpdateDialog' );
?>

<?php

$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'applicant-email-grid',
	//'fixedHeader' => false,
	//'responsiveTable' => true,
	'type' => TbHtml::GRID_TYPE_CONDENSED, //'striped',
	'dataProvider' => $model->search($applicant_id),
	'template' => "{items}",
	//'filter'=>$model,
	'columns'=>array(
		/*
		 * @property string $Email
		 * @property string $IsPrimary
		*/
    'Email',
    array(
      'name'=>'IsPrimary',
      'value'=>'($data->IsPrimary=="Y")?"Yes":"No"',
    ),
    /*
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'Email',
			'headerHtmlOptions' => array('style' => 'width: 200px'),
			'editable' => array(
				'attribute' => 'Email',
				'url' => $this->createUrl('applicantEmail/editable'),
			)
		),
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'IsPrimary',
			//'headerHtmlOptions' => array('style' => 'width: 60px'),
			'editable' => array(
				'type' => 'select',
				'url' => $this->createUrl('applicantEmail/editable'),
				'source' => array('Y'=>'Yes','N'=>'No'),
				'placement' => 'bottom',
			)
		),
    */

		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{update}{delete}',
			'buttons'=>array(
		        'update' => array(
                    'label'=>'Edit',
                    'icon'=>'icon-edit',
                    'url'=>'Yii::app()->createUrl("applicantEmail/editEmail", array("id"=>$data->primaryKey,"asDialog"=>1,"gridId"=>$this->grid->id))',
                    'click'=>'function(){
                        $("#email-cru-frame").attr("src",$(this).attr("href"));
                        $("#email-cru-dialog").dialog("open");
                        return false;
                    }',
		        ),
				'delete' => array(
						'label'=>'delete email',
						'icon'=>'remove',
						'url'=>'Yii::app()->createUrl("applicantEmail/delete", array("id"=>$data->ID))',
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
    'id'=>'email-cru-dialog',
    'options'=>array(
        'title'=>'Email Details',
        'autoOpen'=>false,
        'modal'=>false,
        'width'=>600,
        'height'=>350,
    ),
));
?>
<iframe id="email-cru-frame" width="100%" height="100%"></iframe>
<?php $this->endWidget(); ?>
