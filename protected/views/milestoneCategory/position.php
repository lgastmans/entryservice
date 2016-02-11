<?php
/* @var $this TeamController */
/* @var $model Team */
/* @var $form CActiveForm */
?>
<?php
$this->breadcrumbs=array(
	'Teams'=>array('index'),
	'Position',
);

$this->menu=array(
	array('label' => 'actions'),
	TbHtml::menuDivider(),
	//array('label'=>'List Team', 'url'=>array('index')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<h1>Position Milestone Categories</h1>

<?php
	Yii::app()->clientScript->registerScriptFile('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js');
	
    $str_js = "
 		
 	function installSortable() {
        var fixHelper = function(e, ui) {
            ui.children().each(function() {
                $(this).width($(this).width());
            });
            return ui;
        };
 
        $('#milestone-category-grid table.items tbody').sortable({
            forcePlaceholderSize: true,
            forceHelperSize: true,
            items: 'tr',
            update : function () {
                serial = $('#milestone-category-grid table.items tbody').sortable('serialize', {key: 'items[]', attribute: 'class'});
                $.ajax({
                    'url': '" . $this->createUrl('//milestoneCategory/sort') . "',
                    'type': 'post',
                    'data': serial,
                    'success': function(data){
                    	$.fn.yiiGridView.update('milestone-category-grid');
                    },
                    'error': function(request, status, error){
                        alert('Unable to set the sort order at this time.  Please try again in a few minutes.');
                    }
                });
            },
            helper: fixHelper
        }).disableSelection();
    }
	installSortable();
    ";
 
    Yii::app()->clientScript->registerScript('sortable-project', $str_js);

    Yii::app()->clientScript->registerScript('sel_status', "
        $('#selStatus').change(function() {
            //alert(this.value);
            $.fn.yiiGridView.update('milestone-category-grid', {
                    data: $(this).serialize()
            });            
            return false;
        });
    ");
?>

<?php 
/*
$this->widget('bootstrap.widgets.TbHeroUnit', array(
	'heading' => 'Position Team',
	'content' => '<p>Drag and drop a row to position it.</p>',
));
*/

echo TbHtml::badge('Drag and drop to change the position order.', array('color' => TbHtml::BADGE_COLOR_INFO)); 

echo "<br><br>";

$data = CHtml::listData(Status::model()->findAll('IsProcess=?',array(1)), 'ID', 'Description');
//$select = current($data);
$select = key($data);

echo CHtml::dropDownList(
    'dropDownStatus',   // A name for the dropdownList
    $select,            // selected item from the $data
    $data,              // an array of the type $key => $value (the possible values of you dropdownlist)
    array(
        'style'=>'margin-bottom:10px;',
        'id'=>'selStatus',
        /*
        'ajax' => array(
            'type'=>'POST',
            'url'=>CController::createUrl('milestoneCategory/updateAjax'),
            'data'=>'js:jQuery(this).serialize()',
            'success'=>'function(response) {
                oData = response.split("|");
                arr = $.parseJSON(oData[1]);
                $.fn.yiiGridView.update("milestone-category-grid", {data: $(this).serialize()});
             }',
        )
        */
    )
);

$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'milestone-category-grid',
	'afterAjaxUpdate' => 'installSortable',
	'enableSorting' => false,
	'dataProvider'=>$model->search($select),
	'rowCssClassExpression'=>'"items[]_{$data->ID}"',
//	'filter'=>$model,
	'columns'=>array(
		'Description',
	),
)); ?>