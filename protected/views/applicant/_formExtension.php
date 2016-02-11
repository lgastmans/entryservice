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
		//'community.Name',
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'StatusID',
			'headerHtmlOptions' => array('style' => 'width: 100px'),
			'editable' => array(
				'type' => 'select',
				//'model' => $model,
				'attribute' => 'StatusID',
				'url' => $this->createUrl('extension/editable'),
				'source' => CHtml::listData(Status::model()->findAll(), 'ID', 'Description')
			)
		),
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'ExtendedOn',
			'sortable'=>true,
			'editable' => array(
				'type' => 'date',
				'format' => 'yyyy-mm-dd',
				'viewformat' => 'd M yyyy', //dd-mm-yyyy',
				'url' => $this->createUrl('extension/editable'),
				'placement' => 'bottom',
				'inputclass' => 'span3'
			)
		),
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'ExtendedFor',
			'headerHtmlOptions' => array('style' => 'width: 40px'),
			'editable' => array(
				'attribute' => 'ExtendedFor',
				'url' => $this->createUrl('extension/editable'),
			)
		),
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'ExtendedPeriod',
			'headerHtmlOptions' => array('style' => 'width: 100px'),
			'editable' => array(
				'type' => 'select',
				'url' => $this->createUrl('extension/editable'),
				'source' => array('Days'=>'Days','Weeks'=>'Weeks','Months'=>'Months','Years'=>'Years'), 
				'placement' => 'bottom',
			)
		),
		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{delete}',
			'buttons'=>array(
				'delete' => array(
						'label'=>'delete extension',
						'icon'=>'remove',
						'url'=>'Yii::app()->createUrl("extension/delete", array("id"=>$data->ID))',
						'options'=>array(
							'class'=>'btn btn-small',
					),
				),
			),
		),
				
	),
)); 

?>