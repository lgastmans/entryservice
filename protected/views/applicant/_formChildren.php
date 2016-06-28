<?php
/*
echo CHtml::ajaxButton(
    Yii::t('children','Add'),
    $this->createUrl('children/addnew&applicant_id='.$applicant_id),
    array(
        //'update'=>'#personChildDialog'
        'update'=>'#applicantChildrenDialog'
    ),
    array('id'=>'showApplicantChildrenDialog')
);
*/
?>

<div id="applicantChildrenDialog"></div>

<?php

//$this->widget('yiiwheels.widgets.grid.WhGridView',array(
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'applicant-children-grid',
//	'fixedHeader' => false,
	'type' => TbHtml::GRID_TYPE_CONDENSED, //'striped',
	'dataProvider' => $model->search($applicant_id),
//	'responsiveTable' => true,
	'template' => "{items}",
	//'filter'=>$model,
	'columns'=>array(
		/*
		$Name
		$Surname
		$PassportNumber
		$IssuedDate
		$ValidTill
		$BirthDate
		*/
    	'Name',
    	'Surname',
    	'Sex',
	    array(
	      'name'=>'BirthDate',
	      'value'=>'Yii::app()->dateFormatter->format("dd-MM-yyyy", $data->BirthDate)',
	    ),
    /*
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'Name',
			'headerHtmlOptions' => array('style' => 'width: 100px'),
			'editable' => array(
				'attribute' => 'Name',
				'url' => $this->createUrl('children/editable'),
			)
		),
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'Surname',
			'headerHtmlOptions' => array('style' => 'width: 100px'),
			'editable' => array(
				'attribute' => 'Surname',
				'url' => $this->createUrl('children/editable'),
			)
		),
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'BirthDate',
			'sortable'=>true,
			'editable' => array(
				'type' => 'date',
				'format' => 'yyyy-mm-dd',
				'viewformat' => 'dd-mm-yyyy',
				'url' => $this->createUrl('children/editable'),
				'placement' => 'bottom',
				'inputclass' => 'span3'
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
                    'url'=>'Yii::app()->createUrl("children/editChildren", array("id"=>$data->primaryKey,"asDialog"=>1,"gridId"=>$this->grid->id))',
                    'click'=>'function(){
                        $("#children-cru-frame").attr("src",$(this).attr("href"));
                        $("#children-cru-dialog").dialog("open");
                        return false;
                    }',
		        ),
				'delete' => array(
						'label'=>'delete child',
						'icon'=>'remove',
						'url'=>'Yii::app()->createUrl("children/delete", array("id"=>$data->ID))',
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
    'id'=>'children-cru-dialog',
    'options'=>array(
        'title'=>'Children Details',
        'autoOpen'=>false,
        'modal'=>false,
        'width'=>600,
        'height'=>700,
    ),
));
?>
<iframe id="children-cru-frame" width="100%" height="100%"></iframe>
<?php $this->endWidget(); ?>
