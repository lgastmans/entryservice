<?php
/*
echo CHtml::ajaxButton(
    Yii::t('address','Add'),
    $this->createUrl('address/addnew&applicant_id='.$applicant_id),
    array(
        //'update'=>'#personChildDialog'
        'update'=>'#applicantAddressDialog'
    ),
    array('id'=>'showApplicantAddressDialog')
);
*/
?>

<div id="applicantAddressDialog"></div>

<?php

//$this->widget('yiiwheels.widgets.grid.WhGridView',array(
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'applicant-address-grid',
//	'fixedHeader' => false,
	'type' => TbHtml::GRID_TYPE_CONDENSED, //'striped',
	'dataProvider' => $model->search($applicant_id),
//	'responsiveTable' => true,
	'template' => "{items}",
	//'filter'=>$model,
	'columns'=>array(
    array(
      'name'=>'Community',
      'value'=>'$data->community->Name',
    ),
    array(
      'name'=>'FromDate',
      'value'=>'Yii::app()->dateFormatter->format("dd-MM-yyyy", $data->FromDate)',
      //'value' => 'Yii::app()->dateFormatter->formatDateTime($data->FromDate, "long", null)',
    ),
    array(
      'name'=>'ToDate',
      'value'=>'Yii::app()->dateFormatter->format("dd-MM-yyyy", $data->ToDate)',
      //'value'=>'Yii::app()->dateFormatter->formatDateTime($data->ToDate, "long", null)',
    ),
    'Status',

    /*
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'Community',
			'headerHtmlOptions' => array('style' => 'width: 100px'),
			'editable' => array(
				'type' => 'select',
				//'model' => $model,
				'attribute' => 'CommunityID',
				'url' => $this->createUrl('address/editable'),
				'source' => CHtml::listData(Community::model()->findAll(), 'ID', 'Name')
			)
		),
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'FromDate',
			'headerHtmlOptions' => array('style' => 'width: 80px'),
			'sortable'=>true,
			'editable' => array(
				'type' => 'date',
				'format' => 'yyyy-mm-dd',
				'viewformat' => 'd M yyyy',
				'url' => $this->createUrl('address/editable'),
				'placement' => 'bottom',
				'inputclass' => 'span3'
			)
		),
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'ToDate',
			'headerHtmlOptions' => array('style' => 'width: 80px'),
			'sortable'=>true,
			'editable' => array(
				'type' => 'date',
				'format' => 'yyyy-mm-dd',
				'viewformat' => 'd M yyyy',
				'url' => $this->createUrl('address/editable'),
				'placement' => 'bottom',
				'inputclass' => 'span3'
			)
		),
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'Status',
			'headerHtmlOptions' => array('style' => 'width: 100px'),
			'editable' => array(
				'attribute' => 'Status',
				'placement' => 'bottom',
				'type' => 'select',
				'url' => $this->createUrl('address/editable'),
				'source' => array('Living with Steward'=>'Living with Steward', 'Steward'=>'Steward', 'House-sitting'=>'House-sitting', 'NC Accomodation'=>'NC Accomodation', 'Staff Accomodation'=>'Staff Accomodation', 'Renting'=>'Renting', 'Guest House'=>'Guest House'),
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
                    'url'=>'Yii::app()->createUrl("address/editAddress", array("id"=>$data->primaryKey,"asDialog"=>1,"gridId"=>$this->grid->id))',
                    'click'=>'function(){
                        $("#address-cru-frame").attr("src",$(this).attr("href"));
                        $("#address-cru-dialog").dialog("open");
                        return false;
                    }',
		        ),
				'delete' => array(
						'label'=>'delete address',
						'icon'=>'remove',
						'url'=>'Yii::app()->createUrl("address/delete", array("id"=>$data->ID))',
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
    'id'=>'address-cru-dialog',
    'options'=>array(
        'title'=>'Address Details',
        'autoOpen'=>false,
        'modal'=>false,
        'width'=>600,
        'height'=>570,
    ),
));
?>
<iframe id="address-cru-frame" width="100%" height="100%"></iframe>
<?php $this->endWidget(); ?>
