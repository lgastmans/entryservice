<?php 
/*
echo CHtml::ajaxButton(
    Yii::t('Work','Add'),
    $this->createUrl('work/addnew&applicant_id='.$applicant_id),
    array(
        //'update'=>'#personChildDialog'
        'update'=>'#applicantWorkDialog'
    ),
    array('id'=>'showApplicantWorkDialog')
);
*/
?>

<div id="applicantWorkDialog"></div>

<?php

$this->widget('bootstrap.widgets.TbGridView',array(
//$this->widget('yiiwheels.widgets.grid.WhGridView',array(
	'id'=>'applicant-work-grid',
//	'fixedHeader' => false,
	'type' => TbHtml::GRID_TYPE_CONDENSED, //'striped',
	'dataProvider' => $model->search($applicant_id),
//	'responsiveTable' => true,
	'template' => "{items}",
	//'filter'=>$model,
	'columns'=>array(
		//'community.Name',
		array(
			'name'=>'Place',
			'header'=>'Place',
			'value'=>'$data->Place',
		),
		array(
			'name'=>'FromDate',
			'header' => 'From',
			'value'=>'Yii::app()->dateFormatter->format("dd-MM-yyyy", $data->FromDate)',
		),
		array(
			'name'=>'ToDate',
			'header' => 'To',
			'value'=>'Yii::app()->dateFormatter->format("dd-MM-yyyy", $data->ToDate)',
		),


		/*
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'Place',
			'headerHtmlOptions' => array('style' => 'width: 100px'),
			'editable' => array(
				'attribute' => 'Place',
				'placement' => 'right',
				'type' => 'text',
				'url' => $this->createUrl('work/editable'),
			)
		),		
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'FromDate',
			'sortable'=>true,
			'editable' => array(
				'type' => 'date',
				'format' => 'yyyy-mm-dd',
				'viewformat' => 'dd-mm-yyyy',
				'url' => $this->createUrl('work/editable'),
				'placement' => 'bottom',
				'inputclass' => 'span3'
			)
		),
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'ToDate',
			'sortable'=>true,
			'editable' => array(
				'type' => 'date',
				'format' => 'yyyy-mm-dd',
				'viewformat' => 'dd-mm-yyyy',
				'url' => $this->createUrl('work/editable'),
				'placement' => 'bottom',
				'inputclass' => 'span3'
			)
		),
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'Notes',
			'headerHtmlOptions' => array('style' => 'width: 100px'),
			'editable' => array(
				'inputclass' => 'span3',
				'placement' => 'bottom',
				'type' => 'textarea',
				'url' => $this->createUrl('work/editable')
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
                    'url'=>'Yii::app()->createUrl("work/editWork", array("work_id"=>$data->primaryKey,"asDialog"=>1,"gridId"=>$this->grid->id))',
                    'click'=>'function(){
                        $("#work-cru-frame").attr("src",$(this).attr("href"));
                        $("#work-cru-dialog").dialog("open");
                        return false;
                    }',
		        ),
				'delete' => array(
					'label'=>'delete work',
					'icon'=>'remove',
					'url'=>'Yii::app()->createUrl("work/delete", array("id"=>$data->ID))',
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
    'id'=>'work-cru-dialog',
    'options'=>array(
        'title'=>'Work Details',
        'autoOpen'=>false,
        'modal'=>false,
        'width'=>600,
        'height'=>650,
    ),
));
?>
<iframe id="work-cru-frame" width="100%" height="100%"></iframe>
<?php $this->endWidget(); ?>