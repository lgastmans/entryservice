<?php
/* @var $this ApplicantController */
/* @var $model Applicant */


$this->breadcrumbs=array(
	'Applicants'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label' => 'actions'),
	TbHtml::menuDivider(),
//	array('label'=>'List Applicant', 'url'=>array('index')),
	array('label'=>'Create', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#applicant-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

?>

<div>
	<div style="float: left;">
		<h1>Manage Applicants</h1>
	</div>
	<div style="float: right;">
		<?php
		/*
		echo TbHtml::buttonDropdown(
			'Action',
			array(
				array('label' => 'Create', 'url' => array('create')),
			),
			array( 'color' => TbHtml::BUTTON_COLOR_INVERSE)
		);
		*/
		?>
	</div>
</div>
<div style="clear:both;"></div>

<!--
<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
        &lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>
-->
<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'applicant-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'ID',
		//'Name',
		array(
			'name'=>'full_name',
			'type'=>'raw',
			'value' => 'CHtml::link(CHtml::encode($data["FullName"]), array("applicant/update","id"=>$data["ID"]))',
		),
    array(
    	'name'=>'status_fs',
    	'header'=>'Status',
    	'filter'=>CHtml::listData(Status::model()->findAll(), 'ID', 'Description'),
        'value'=> 'ApplicantStatus::model()->getCurrentStatus($data->ID);',
    ),
		//'BirthPlace',
		array(
			'name'=>'BirthDate',
			//'value'=>'Yii::app()->dateFormatter->formatDateTime($data->BirthDate, "long", null)',
			'value'=>'Yii::app()->dateFormatter->format("dd-MM-yyyy", $data->BirthDate)',
		),
		array(
			'header'=>'Age',
			'value'=> '$data->DOB',
		),
		//'Photo',
		array(
			'name'=>'Sex',
			'value'=>'($data->Sex=="M")?"Male":"Female"',
			'filter'=>array('M'=>'Male', 'F'=>'Female'),
		),
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'MaritalStatus',
			'headerHtmlOptions' => array('style' => 'width: 100px'),
			'filter' => array('Single'=>'Single','Couple'=>'Couple'),
			'editable' => array(
				'placement' => 'bottom',
				'type' => 'select',
				'url' => $this->createUrl('applicant/editable'),
				'source' => array('Single'=>'Single','Couple'=>'Couple'),
			)
		),
		//'ResServiceNum',
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'ResServiceNum',
			'sortable'=>true,
			'headerHtmlOptions' => array('class' => 'span2'),
			'editable' => array(
				'placement' => 'bottom',
				'url' => $this->createUrl('applicant/editable'),
				'placement' => 'right',
				'inputclass' => 'span2'
			)
		),
		//'Notes',
		//'NationalityID',
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'nationality_fs',
			'headerHtmlOptions' => array('style' => 'width: 100px'),
			//'filter'=>false,
			'editable' => array(
				'placement' => 'bottom',
				'type' => 'select',
				//'model' => $model,
				'attribute' => 'NationalityID',
				'url' => $this->createUrl('applicant/editable'),
				'source' => CHtml::listData(Nationality::model()->findAll(), 'ID', 'Nationality')
			)
		),
		/*
		array(
			'class' => 'yiiwheels.widgets.editable.WhEditableColumn',
			'name' => 'nationality.Nationality',
			'headerHtmlOptions' => array('style' => 'width: 100px'),
			'editable' => array(
				'type' => 'select',
				//'model' => $model,
				'attribute' => 'NationalityID',
				'url' => $this->createUrl('applicant/editable'),
				'source' => CHtml::listData(Nationality::model()->findAll(), 'ID', 'Nationality')
			)
		),
		*/

		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{view} {update} {delete}',
            'buttons'=>array(
                'view'=> array(
                    'label'=>'View applicant details',
                    'url'=>'Yii::app()->createUrl("applicant/viewApplicant", array("id"=>$data->ID,"asDialog"=>1))',
                    'options'=>array(
                        'ajax'=>array(
                            'type'=>'POST',
                            // ajax post will use 'url' specified above
                            'url'=>"js:$(this).attr('href')",
                            'update'=>'#id_view',
                        ),
                    ),
                ),
            ),
		),
	),
));

/*
    the VIEW dialog
*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'dlg-applicant-view',
    'options'=>array(
        'title'=>'Applicant Details',
        'autoOpen'=>false, //important!
        'modal'=>false,
        'width'=>750,
        'height'=>600,
    ),
));

?>

<div id="id_view"></div>

<?php $this->endWidget(); ?>
