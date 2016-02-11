<?php
/*
echo CHtml::ajaxButton(
    Yii::t('phone','Add'),
    $this->createUrl('applicantPhone/addnew&applicant_id='.$applicant_id),
    array(
        //'update'=>'#personChildDialog'
        'update'=>'#applicantPhoneDialog'
    ),
    array('id'=>'showApplicantPhoneDialog')
);
*/
?>

<div id="applicantPhoneDialog"></div>

<?php

//$this->widget('yiiwheels.widgets.grid.WhGridView',array(
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'applicant-phone-grid',
	//'fixedHeader' => false,
	//'responsiveTable' => true,
	'type' => TbHtml::GRID_TYPE_CONDENSED, //'striped',
	'dataProvider' => $model->search($applicant_id),
	'template' => "{items}",
	//'filter'=>$model,
	'columns'=>array(
		/*
		 * @property string $ContactType ('Cell', 'Home', 'Work')
		 * @property string $Number
		 * @property string $IsPrimary
		*/
    'ContactType',
    'Number',
    array(
      'name'=>'IsPrimary',
      'value'=>'($data->IsPrimary=="Y")?"Yes":"No"',
    ),
    /*
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'ContactType',
			'headerHtmlOptions' => array('style' => 'width: 100px'),
			'editable' => array(
				'attribute' => 'ContactType',
				'placement' => 'bottom',
				'type' => 'select',
				'url' => $this->createUrl('applicantPhone/editable'),
				'source' => array('Cell'=>'Cell', 'Home'=>'Home', 'Work'=>'Work'),
			)
		),
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'Number',
			'headerHtmlOptions' => array('style' => 'width: 100px'),
			'editable' => array(
				'attribute' => 'Number',
				'url' => $this->createUrl('applicantPhone/editable'),
			)
		),
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'IsPrimary',
			'headerHtmlOptions' => array('style' => 'width: 100px'),
			'editable' => array(
				'type' => 'select',
				'url' => $this->createUrl('applicantPhone/editable'),
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
          'url'=>'Yii::app()->createUrl("applicantPhone/editPhone", array("id"=>$data->primaryKey,"asDialog"=>1,"gridId"=>$this->grid->id))',
          'click'=>'function(){
              $("#phone-cru-frame").attr("src",$(this).attr("href"));
              $("#phone-cru-dialog").dialog("open");
              return false;
          }',
        ),
				'delete' => array(
						'label'=>'delete phone',
						'icon'=>'remove',
						'url'=>'Yii::app()->createUrl("applicantPhone/delete", array("id"=>$data->ID))',
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
    'id'=>'phone-cru-dialog',
    'options'=>array(
        'title'=>'Phone Details',
        'autoOpen'=>false,
        'modal'=>false,
        'width'=>600,
        'height'=>475,
    ),
));
?>
<iframe id="phone-cru-frame" width="100%" height="100%"></iframe>
<?php $this->endWidget(); ?>
