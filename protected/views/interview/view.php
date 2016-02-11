<?php
/* @var $this InterviewController */
/* @var $model Interview */
?>

<?php
$this->breadcrumbs=array(
	'Interviews'=>array('index'),
	$model->Title,
);

$this->menu=array(
	array('label'=>'List Interview', 'url'=>array('index')),
	array('label'=>'Create Interview', 'url'=>array('create')),
	array('label'=>'Update Interview', 'url'=>array('update', 'id'=>$model->ApplicantID)),
	array('label'=>'Delete Interview', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ApplicantID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Interview', 'url'=>array('admin')),
);

$res = Applicant::model()->findByPk($model->ApplicantID);

?>

<h3><?php echo $res->Name." ".$res->Surname ?></h3>

<?php 

$this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		//'ApplicantID',
		//'DateInterviewed',
		array(
		    'name' => 'DateInterviewed',
		    'type' => 'raw',
		    'value' =>Yii::app()->dateFormatter->formatDateTime($model->DateInterviewed, "long", null),
		),		
		'Title',
		'Present',
		//'Interview',
	),
)); 

?>

<div style="margin-left:50px;margin-right:50px">
	<?php
		echo $model->Interview;
	?>
</div>