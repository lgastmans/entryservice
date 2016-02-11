<?php

//Yii::app()->clientScript->registerCoreScript('jquery');


    Yii::app()->clientScript->registerScript('sel_status', "
        $('#selStatus').change(function() {
            //alert(this.value);
            $.fn.yiiGridView.update('applicant-milestones-grid', {
                    data: $(this).serialize()
            });            
            return false;
        });
    ");


$data1 = array('ALL'=>'All');
//$data2 = CHtml::listData(MilestoneCategory::model()->findAll(array('order'=>'Position ASC')), 'ID', 'Description');
//$data2 = CHtml::listData(Status::model()->findAll(array('order'=>'ProcessPosition', 'condition'=>'IsProcess=?', 'params'=>array(1))), 'ID', 'Description');
$data2 = CHtml::listData(Status::model()->findAll(array('order'=>'ProcessPosition')), 'ID', 'Description');
$data = $data1 + $data2;
//$select = current($data);
//$select = key($data);
$select = $statusInfo['current']['StatusID'];

//print_r($statusInfo);

                   
/*
    STATUS DROPDOWN
*/

echo CHtml::dropDownList(
    'dropDownStatus',   
    $select,            
    $data,              
    array(
        'style'=>'margin-bottom:10px;',
        'id'=>'selStatus',
    )
);


/*
    ADD MILESTONE BUTTON
*/
$url = $this->createUrl("applicantMilestones/addMilestone", array("applicant_id"=>$applicant_id,"asDialog"=>1,"gridId"=>'applicant-milestones-grid'));
echo CHtml::ajaxButton(
    Yii::t('milestone','Add Milestone'),
    $url,
    array(
        'success'=>'function(){
                        $("#cru-frame").attr("src", "'.$url.'");
                        $("#cru-dialog").dialog("open");  
                        return false;
                    }',
        'update'=>'#cru-frame'

    ),
    array(
        //'id'=>'showApplicantMilestoneDialog',
        'style'=>'margin-bottom:10px;margin-left:20px;',
    )
);
?>
<div id="applicantMilestoneDialog"></div>


<?php

$this->widget('bootstrap.widgets.TbGridView',array(
    'id'=>'applicant-milestones-grid',
    'type' => TbHtml::GRID_TYPE_CONDENSED, //'striped',
    'dataProvider' => $model->search($applicant_id),
    //'template' => "{items}",
    'columns'=>array(
        'Status',
        'Description',
        array(
            'name'=> 'category',
            'value'=> '$data->milestone_category->Description',
        ),
        array(
            'name' => 'DateStarted',
            'type' => 'raw',
            'value' => 'Yii::app()->dateFormatter->formatDateTime($data->DateStarted, "long", null)'
        ),
        array(
            'name' => 'DateCompleted',
            'type' => 'raw',
            'value' => '($data->DateCompleted!=="0000-00-00")?Yii::app()->dateFormatter->formatDateTime($data->DateCompleted, "long", null):""'
        ),
        array(
            'name'=>'Timeline',
            'value'=>'$data->TimelineInterval." ".$data->TimelinePeriod',
        ),
        array(
            'name'=>'reminder',
            'header'=>'',
            'type'=>'raw',
            'value'=>'(applicantMilestones::getHasReminderLabel($data->ID));',
        ),

        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{view} {edit} {reminder}',
            'buttons'=>array(

                'view'=> array(
                    'label'=>'View milestone details',
                    'url'=>'Yii::app()->createUrl("applicantMilestones/viewMilestone", array("id"=>$data->ID,"asDialog"=>1))',
                    'options'=>array(  
                        'ajax'=>array(
                            'type'=>'POST',
                            // ajax post will use 'url' specified above 
                            'url'=>"js:$(this).attr('href')", 
                            'update'=>'#id_view',
                        ),
                    ),
                ),

                'edit'=> array(
                    'label'=>'Edit milestone details',
                    'icon'=>'icon-edit',
                    'url'=>'Yii::app()->createUrl("applicantMilestones/editMilestone", array("id"=>$data->primaryKey,"asDialog"=>1,"gridId"=>$this->grid->id))',
                    'click'=>'function(){
                        $("#cru-frame").attr("src",$(this).attr("href"));
                        $("#cru-dialog").dialog("open");  
                        return false;
                    }',
                ),

                'reminder' => array(
                    'label'=>'Set / View Reminder for this Milestone',
                    'icon'=>getIcon(),
                    'url'=>'(applicantMilestones::getHasReminder($data->ID)) ? 
                        Yii::app()->createUrl("applicantReminders/editReminder", array("milestoneID"=>$data->ID,"asDialog"=>1,"gridId"=>$this->grid->id,"applicantID"=>$data->ApplicantID)) :
                        Yii::app()->createUrl("applicantReminders/createReminder", array("milestoneID"=>$data->ID,"asDialog"=>1,"gridId"=>$this->grid->id,"applicantID"=>$data->ApplicantID))
                    ',
                    'click'=>'function(){
                        //alert($(this).attr("href"));
                        $("#reminder-frame").attr("src",$(this).attr("href"));
                        $("#reminder-dialog").dialog("open");  
                        return false;
                    }',
                ),
            ),
        ),
                
    ),
)); 

function getIcon() {
    return 'icon-bell';
    //return 'icon-star';
    //return 'icon-star-empty';
}

/*
    the VIEW dialog
*/
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( 
    'id'=>'dlg-address-view',
    'options'=>array(
        'title'=>'Milestone Details',
        'autoOpen'=>false, //important!
        'modal'=>false,
        'width'=>750,
        'height'=>600,
    ),
));
?>
<div id="id_view"></div>
<?php $this->endWidget(); ?>



<?php
/*
    the EDIT dialog
*/
// add the (closed) dialog for the iframe
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'cru-dialog',
    'options'=>array(
        'title'=>'Milestone Details',
        'autoOpen'=>false,
        'modal'=>false,
        'width'=>900,
        'height'=>600,
    ),
));
?>
<iframe id="cru-frame" width="100%" height="100%"></iframe>
<?php $this->endWidget(); ?>



<?php
/*
    the REMINDER dialog
*/
// add the (closed) dialog for the iframe
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'reminder-dialog',
    'options'=>array(
        'title'=>'Reminder',
        'autoOpen'=>false,
        'modal'=>false,
        'width'=>900,
        'height'=>620,
    ),
));
?>
<iframe id="reminder-frame" width="100%" height="100%"></iframe>
<?php $this->endWidget(); ?>