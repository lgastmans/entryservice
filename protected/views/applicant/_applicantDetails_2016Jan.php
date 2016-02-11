<?php
  $currentStatus = ApplicantStatus::model()->getCurrentStatus($model->ID);

  $data = Status::model()->findAll(array(
    'select'=>'*',
    //'join'=>'LEFT JOIN objetivo_indicador oi ON (t.id_indicador = oi.id_indicador)',
    'condition'=>'t.ID IN ( SELECT StatusID FROM applicant_status WHERE applicantID = :applicantID )',
    'params'=>array(':applicantID'=>$model->ID),
    'order'=>'ProcessPosition ASC',
    )
  );

  $statuses = array();
  $initStatus = 0;

  foreach ($data as $row) {

    if ($row->Description==$currentStatus)
      $initStatus = $row->ID;

    array_push($statuses,
      array(
        'label'=>$row->Description,
        'class'=>($row->Description==$currentStatus)?'active':'',
        'onclick'=>'setStatus('.$row->ID.');return false;'
      )
    );

  }

  $statusInformation = ApplicantStatus::model()->StatusInformation($model->ID,$initStatus);


Yii::app()->clientScript->registerScript('selStatus', "

  function setStatus(statusID) {

    $.ajax({
      type: 'GET',
      url: '".Yii::app()->createUrl('applicantStatus/statusInformation')."',
      data: { applicant_id: ".$model->ID.", status_id: statusID }
    })
    .done(function( data ) {
      var obj = jQuery.parseJSON( data );

      $('#description').text(obj.current.Description);
      $('#started_on').text(obj.current.StartedOn);
      $('#is_completed').text(obj.current.IsCompleted);
      $('#completed_on').text(obj.current.CompletedOn);

      console.log( 'data > ' + data );
    });

    $.fn.yiiGridView.update('applicant-milestones-grid', {
      //data: $(this).serialize()
      data: 'statusID='+statusID
    });

    return false;
  }
", CClientScript::POS_END);

?>

<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700|Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
<style>
  .infoHeader {
    font-family: 'PT Sans', sans-serif;
    font-size: 24pt;
  }
  .infoText {
    font-family: 'Open Sans Condensed', sans-serif;
    font-size: 12pt;
    line-height:18pt;
  }
</style>


<div>
  <div style="float:left;width:250px;background-color:#e2e2e2;height:150px;padding:20px 0 0 20px;">
    <div style="align:center">
    <?php
      echo TbHtml::button('New Status',
        array(
          'color' => TbHtml::BUTTON_COLOR_DEFAULT,
          'size' => TbHtml::BUTTON_SIZE_LARGE,
        )
      );
    ?>
    </div>
  </div>

  <div style="float:left;margin-left:20px;background-color:#e2e2e2;height:150px;width:725px;padding-top:20px;padding-left:20px;">

    <fieldset>
      <legend><div id="description" class="infoHeader"><?php echo $currentStatus;?></div></legend>
      <div class="infoText">
        <div style="float:left;width:100px;"><b>Started On: </b></div>
        <div id="started_on"></div>
      </div>
      <div style="clear:both;"></div>
      <div class="infoText">
        <div style="float:left;width:100px;"><b>Completed: </b></div>
        <div id="is_completed"></div>
      </div>
    </fieldset>

  </div>

</div>
<div style="clear:both;"></div>

<div>
  <div style="float:left;width:250px;background-color:#e2e2e2;height:600px;padding:20px 0 0 20px;">
    <?php
      echo TbHtml::buttonGroup(
        $statuses,
        array(
          'vertical' => true,
          'toggle' => TbHtml::BUTTON_TOGGLE_RADIO,
          'color' => TbHtml::BUTTON_COLOR_INFO,
          'size' => TbHtml::BUTTON_SIZE_LARGE
        )
      );
    ?>
  </div>
  <div style="float:left;margin-top:20px;margin-left:20px;">
    <?php
      $this->widget('bootstrap.widgets.TbGridView',array(
          'id'=>'applicant-milestones-grid',
          'type' => TbHtml::GRID_TYPE_CONDENSED,
          'dataProvider' => $modelMilestones->search($model->ID,$initStatus),
          'template' => "{items}",

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
                          'icon'=>'icon-bell',
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
    ?>
  </div>
</div>
<div style="clear:both;"></div>
