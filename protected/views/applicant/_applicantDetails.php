<div style="width: 100%; display: table;">
    <div style="display: table-row">

<div style="width: 500px; display: table-cell;">

      <?php 

        $this->widget('yiiwheels.widgets.box.WhBox', array(
            'title' => 'Status History',
            'headerIcon' => TbHtml::ICON_INFO_SIGN,
            'content' => $this->renderPartial("_formStatus", array('applicant_id'=>$model->ID, 'model' => $modelStatus),true),
            'htmlOptions' => array('style'=>'width:500px;'),
            'headerButtons' => array(
              TbHtml::button('Add', array(
                'color' => TbHtml::BUTTON_COLOR_INFO,
                //'icon' => 'plus',
                'onclick'=>"{addStatus();}",
              )),
            ),
        ));

      ?>
</div>

<div style="display: table-cell; padding-left:35px;">
    <div>

      <?php 

        $this->widget('yiiwheels.widgets.box.WhBox', array(
            'title' => 'Extensions',
            'headerIcon' => TbHtml::ICON_INFO_SIGN,
            'content' => $this->renderPartial("_formExtension", array('applicant_id'=>$model->ID, 'model' => $modelExtension),true),
            'htmlOptions' => array('style'=>'width:500px;'),
            'headerButtons' => array(
              TbHtml::button('Add', array(
                'color' => TbHtml::BUTTON_COLOR_INFO,
                //'icon' => 'plus',
                'onclick'=>"{addExtension();}",
              )),
            ),
        ));

        $this->widget('yiiwheels.widgets.box.WhBox', array(
            'title' => 'Absences',
            'headerIcon' => TbHtml::ICON_INFO_SIGN,
            'content' => $this->renderPartial("_formAbsence", array('applicant_id'=>$model->ID, 'model' => $modelAbsence),true),
            'htmlOptions' => array('style'=>'width:500px;'),
            'headerButtons' => array(
              TbHtml::button('Add', array(
                'color' => TbHtml::BUTTON_COLOR_INFO,
                //'icon' => 'plus',
                'onclick'=>"{addAbsence();}",
              )),
            ),
        ));

        /*
        $this->widget('yiiwheels.widgets.box.WhBox', array(
            'title' => 'Milestones',
            'headerIcon' => TbHtml::ICON_INFO_SIGN,
            'content' => $this->renderPartial("_formMilestones", array('applicant_id'=>$model->ID, 'model' => $modelMilestones),true),
            'htmlOptions' => array('style'=>'width:500px;'),
            'headerButtons' => array(
              TbHtml::button('Add', array(
                'color' => TbHtml::BUTTON_COLOR_INFO,
                //'icon' => 'plus',
                'onclick'=>"{addMilestone();}",
              )),
            ),
        ));
        */
      ?>

    </div>
</div>


    </div>  <!-- display: table-row -->
</div>  <!-- display: table -->


<script>

  function addStatus()
  {
    $.ajax({
      type: "get",
      url: '<?php echo $this->createUrl('applicantStatus/addnew');?>',
      data: { applicant_id: <?php echo $model->ID;?>, asDialog: 1, gridId: 'applicant-status-grid' }
    })
    .done(function( msg ) {
      $("#status-cru-frame").attr("src",'<?php echo $this->createUrl('applicantStatus/addnew',array('applicant_id'=>$model->ID, 'asDialog'=>1, 'gridId'=>'applicant-status-grid'));?>');
      $("#status-cru-dialog").dialog("open");
    });
    return false;
  }

  function addExtension()
  {
    
    $.ajax({
      type: "get",
      url: '<?php echo $this->createUrl('extension/addnew');?>',
      data: { applicant_id: <?php echo $model->ID;?>, asDialog: 1, gridId: 'applicant-extension-grid' }
    })
    .done(function( msg ) {
      $("#extension-cru-frame").attr("src",'<?php echo $this->createUrl('extension/addnew',array('applicant_id'=>$model->ID, 'asDialog'=>1, 'gridId'=>'applicant-extension-grid'));?>');
      $("#extension-cru-dialog").dialog("open");
    });
    return false;
  }

  function addAbsence()
  {
    alert('under development');
    // $.ajax({
    //   type: "get",
    //   url: '<?php echo $this->createUrl('applicantStatus/addnew');?>',
    //   data: { applicant_id: <?php echo $model->ID;?>, asDialog: 1, gridId: 'applicant-status-grid' }
    // })
    // .done(function( msg ) {
    //   $("#status-cru-frame").attr("src",'<?php echo $this->createUrl('applicantStatus/addnew',array('applicant_id'=>$model->ID, 'asDialog'=>1, 'gridId'=>'applicant-status-grid'));?>');
    //   $("#status-cru-dialog").dialog("open");
    // });
    // return false;
  }

</script>