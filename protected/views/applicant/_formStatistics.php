<?php 
	echo CHtml::ajaxButton(
	    Yii::t('statistics','Add'),
	    $this->createUrl('applicantStatistics/addnew&applicant_id='.$applicant_id),
	    array(
	        //'update'=>'#personChildDialog'
	        'update'=>'#applicantStatisticsDialog'
	    ),
	    array('id'=>'showApplicantStatisticsDialog')
	);
?>

<div id="applicantStatisticsDialog"></div>

<style>
	.nRed {
		color: red;
		font-weight:bold;
	}
	.nNormal {
		color: black;
		font-weight:normal;
	}

</style>

<?php

$this->widget('yiiwheels.widgets.grid.WhGridView',array(
	'id'=>'applicant-statistics-grid',
	'fixedHeader' => false,
	'type' => TbHtml::GRID_TYPE_CONDENSED, //'striped',
	'dataProvider' => $model->search($applicant_id),
	'responsiveTable' => true,
	'template' => "{items}",
	'columns'=>array(
		/*
		 * @property string $Email
		 * @property string $IsPrimary
		*/
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'CategoryID',
			'headerHtmlOptions' => array('style' => 'width: 200px'),
			'editable' => array(
				'type' => 'select',
				//'model' => $model,
				'attribute' => 'CategoryID',
				'url' => $this->createUrl('applicantStatistics/editable'),
				'source' => CHtml::listData(StatisticsCategory::model()->findAll(), 'ID', 'Category')
			)
		),
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'AnswerID',
			'sortable'=>true,
			'editable' => array(
				'type' => 'select',
				//'model' => $model,
				'attribute' => 'AnswerID',
				'url' => $this->createUrl('applicantStatistics/editable'),
				'source' => CHtml::listData(StatisticsAnswer::model()->findAll(), 'ID', 'Answer')
			)
		),
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'DateRecorded',
			'sortable'=>true,
			'editable' => array(
				'type' => 'date',
				'format' => 'yyyy-mm-dd',
				'viewformat' => 'd M yyyy',
				'url' => $this->createUrl('applicantStatistics/editable'),
				'placement' => 'bottom',
				'inputclass' => 'span3'
			)
		),
		

		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{delete}',
			'buttons'=>array(
				'delete' => array(
						'label'=>'delete statistic',
						'icon'=>'remove',
						'url'=>'Yii::app()->createUrl("applicantStatistics/delete", array("id"=>$data->ID))',
						'options'=>array(
							'class'=>'btn btn-small',
					),
				),
			),
		),
				
	),
)); 

?>