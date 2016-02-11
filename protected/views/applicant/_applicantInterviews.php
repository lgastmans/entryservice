<?php

/*
    ADD INTERVIEW BUTTON
*/
$url = $this->createUrl("interview/addInterview", array("applicant_id"=>$applicant_id,"asDialog"=>1,"gridId"=>'applicant-interviews-grid'));
echo CHtml::ajaxButton(
    Yii::t('interview','Add Interview'),
    $url,
    array(
        'success'=>'function(){
                        $("#interview-frame").attr("src", "'.$url.'");
                        $("#interview-dialog").dialog("open");  
                        return false;
                    }',
        'update'=>'#interview-frame'

    ),
    array(
        //'id'=>'showApplicantMilestoneDialog',
        'style'=>'margin-bottom:10px;margin-left:20px;',
    )
);
?>
<div id="applicantInterviewDialog"></div>

<?php
$this->widget('bootstrap.widgets.TbGridView',array(
//$this->widget('yiiwheels.widgets.grid.WhGridView',array(
    'id'=>'applicant-interviews-grid',
//    'fixedHeader' => false,
    'type' => TbHtml::GRID_TYPE_CONDENSED, //'striped',
    'dataProvider'=>$model->search($applicant_id),
//    'responsiveTable' => true,
    'template' => "{items}",
    'columns'=>array(
        //'ApplicantID',
        //'DateInterviewed',
        array(
          'name' => 'DateInterviewed',
          'type' => 'raw',
          'value' => 'Yii::app()->dateFormatter->formatDateTime($data->DateInterviewed, "long", null)'
        ),
        'Title',
        'Present',
        //'Interview',
        array(
            'name'=>'Interview',
            'type'=>'html',
            'value'=>'$data->Interview',
        ),

        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{view} {update} {delete}',
            'buttons'=>array(
                'view' => array(
                    'label'=>'View interview details',
                    'url'=>'Yii::app()->createUrl("interview/viewInterview", array("id"=>$data->ID,"asDialog"=>1))',
                    'options'=>array(  
                        'ajax'=>array(
                            'type'=>'POST',
                            // ajax post will use 'url' specified above 
                            'url'=>"js:$(this).attr('href')", 
                            'update'=>'#view_interview',
                        ),
                    ),
                ),
                'update'=> array(
                    'label'=>'Edit interview details',
                    'icon'=>TbHtml::ICON_EDIT,
                    'url'=>'Yii::app()->createUrl("interview/editInterview", array("applicant_id"=>$data->ID,"asDialog"=>1,"gridId"=>$this->grid->id))',
                    'click'=>'function(){
                        $("#interview-frame").attr("src",$(this).attr("href"));
                        $("#interview-dialog").dialog("open");  
                        return false;
                    }',
                ),
                'delete' => array(
                        'label'=>'delete interview',
                        'icon'=>TbHtml::ICON_REMOVE,
                        'url'=>'Yii::app()->createUrl("interview/delete", array("id"=>$data->ID))',
                ),
            ),
        ),
    ),
));
?>

<?php
/*
    the VIEW dialog
*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( 
    'id'=>'dlg-interview-view',
    'options'=>array(
        'title'=>'Interview Details',
        'autoOpen'=>false, //important!
        'modal'=>false,
        'width'=>750,
        'height'=>600,
    ),
));
?>
<div id="view_interview"></div>
<?php $this->endWidget(); ?>

<?php
/*
    the EDIT dialog
*/
// add the (closed) dialog for the iframe
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'interview-dialog',
    'options'=>array(
        'title'=>'Interview Details',
        'autoOpen'=>false,
        'modal'=>false,
        'width'=>900,
        'height'=>600,
    ),
));
?>
<iframe id="interview-frame" width="100%" height="100%"></iframe>
<?php $this->endWidget(); ?>