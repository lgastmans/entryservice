<?php
/* @var $this ApplicantStatusController */
/* @var $model ApplicantStatus */


$this->breadcrumbs=array(
	'Applicant Statuses'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ApplicantStatus', 'url'=>array('index')),
	array('label'=>'Create ApplicantStatus', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#applicant-status-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Applicant Statuses</h1>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
        &lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'applicant-status-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID',
		'ApplicantID',
		'StatusID',
		'IsCurrent',
		'StartedOn',
		'CompletedOn',
		'Color',
		/*
		'Duration',
		'DurationPeriod',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>