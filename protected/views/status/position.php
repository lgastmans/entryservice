<?php
/* @var $this StatusController */
/* @var $model Status */
/* @var $form CActiveForm */
?>
<?php
$this->breadcrumbs=array(
	'Status'=>array('index'),
	'Position',
);

$this->menu=array(
	array('label' => 'actions'),
	TbHtml::menuDivider(),
	//array('label'=>'List Team', 'url'=>array('index')),
	array('label'=>'Manage', 'url'=>array('admin')),
);
?>

<h1>Position Statuses</h1>

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
 
        $('#status-grid table.items tbody').sortable({
            forcePlaceholderSize: true,
            forceHelperSize: true,
            items: 'tr',
            update : function () {
                serial = $('#status-grid table.items tbody').sortable('serialize', {key: 'items[]', attribute: 'class'});
                $.ajax({
                    'url': '" . $this->createUrl('//status/sort') . "',
                    'type': 'post',
                    'data': serial,
                    'success': function(data){
                    	//alert('success');
                    	$.fn.yiiGridView.update('status-grid');
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
?>

<?php 
/*
$this->widget('bootstrap.widgets.TbHeroUnit', array(
	'heading' => 'Position Team',
	'content' => '<p>Drag and drop a row to position it.</p>',
));
*/

echo TbHtml::badge('Drag and drop to change the position.', array('color' => TbHtml::BADGE_COLOR_INFO)); 
echo "<br><br>";

$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'status-grid',
	'afterAjaxUpdate' => 'installSortable',
	'enableSorting' => false,
	'dataProvider'=>$model->search(true),
	'rowCssClassExpression'=>'"items[]_{$data->ID}"',
//	'filter'=>$model,
	'columns'=>array(
		'Description',
	),
)); ?>