<?php
/*
echo CHtml::ajaxButton(
    Yii::t('contact','Add'),
    $this->createUrl('contact/addnew&applicant_id='.$applicant_id),
    array(
        //'update'=>'#personChildDialog'
        'update'=>'#applicantContactDialog'
    ),
    array('id'=>'showApplicantContactDialog')
);
*/
?>

<div id="applicantContactDialog"></div>

<?php

//$this->widget('yiiwheels.widgets.grid.WhGridView',array(
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'applicant-contact-grid',
//	'fixedHeader' => false,
	'type' => TbHtml::GRID_TYPE_CONDENSED, //'striped',
	'dataProvider' => $model->search($applicant_id,'Contact Person'),
//	'responsiveTable' => true,
	'template' => "{items}",
	//'filter'=>$model,
	'columns'=>array(
		/*
		* @property string $Category ('Self','Emergency','Home','Contact Person')
		* @property string $Relationship ('Partner', 'Family', 'Friend')
		* @property string $Name
		* @property string $Surname
		* @property string $Address
		* @property integer $CountryID
		*/
    'FullName',
    'Email',
    //'Phone',
    array(
    	'header'=>'Phone/Cell',
    	'value'=>'((!empty($data->Phone))?$data->Phone:"")." ".((!empty($data->Cell))?$data->Cell:"")',
    ),
    /*
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'Category',
			'headerHtmlOptions' => array('style' => 'width: 100px'),
			'editable' => array(
				'attribute' => 'Category',
				'placement' => 'bottom',
				'type' => 'select',
				'url' => $this->createUrl('contact/editable'),
				'source' => array('Self'=>'Self','Emergency'=>'Emergency','Home'=>'Home','Contact Person'=>'Contact Person'),
			)
		),
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'Relationship',
			'headerHtmlOptions' => array('style' => 'width: 100px'),
			'editable' => array(
				'attribute' => 'Relationship',
				'placement' => 'bottom',
				'type' => 'select',
				'url' => $this->createUrl('contact/editable'),
				'source' => array('None'=>'None', 'Partner'=>'Partner', 'Family'=>'Family', 'Friend'=>'Friend'),
			)
		),
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'Name',
			'headerHtmlOptions' => array('style' => 'width: 100px'),
			'editable' => array(
				'attribute' => 'Name',
				'url' => $this->createUrl('contact/editable'),
			)
		),
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'Surname',
			'headerHtmlOptions' => array('style' => 'width: 100px'),
			'editable' => array(
				'attribute' => 'Surname',
				'url' => $this->createUrl('contact/editable'),
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
                    'url'=>'Yii::app()->createUrl("contact/editContact", array("id"=>$data->primaryKey,"asDialog"=>1,"gridId"=>$this->grid->id,"category"=>"contact_person"))',
                    'click'=>'function(){
                        $("#contact-cru-frame").attr("src",$(this).attr("href"));
                        $("#contact-cru-dialog").dialog("open");
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
    'id'=>'contact-cru-dialog',
    'options'=>array(
        'title'=>'Mentor / Contact Details',
        'autoOpen'=>false,
        'modal'=>false,
        'width'=>600,
        'height'=>675,
    ),
));
?>
<iframe id="contact-cru-frame" width="100%" height="100%"></iframe>
<?php $this->endWidget(); ?>
