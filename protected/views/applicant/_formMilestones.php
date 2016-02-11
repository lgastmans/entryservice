
<div id="applicantMilestoneDialog"></div>

<?php
    $this->widget( 'ext.EUpdateDialog.EUpdateDialog' );
?>

<style>
	.nRed {
		color: red;
		font-weight:bold;
	}
	.nNormal {
		color: black;
		font-weight:normal;
	}
	.grid-view .table th{
		line-height: 12px !important;
	}
	.grid-view .table th > .sort-link {
	  font-size: 11px !important;
	}
</style>

<?php

        $this->widget('bootstrap.widgets.TbGridView',array(
          'id'=>'applicant-milestones-grid',
          'dataProvider'=>$model->search($applicant_id),
          //'filter'=>$modelMilestones,
          'columns'=>array(
             // * @property integer $MilestoneCategoryID
             // * @property integer $ApplicantID
             // * @property string $Status
             // * @property string $DateCreated
             // * @property string $DateStarted
             // * @property string $DateCompleted
             // * @property string $Description            
            'Description',
            array(
              'name' => 'DateStarted',
              'type' => 'raw',
              'value' => 'Yii::app()->dateFormatter->formatDateTime($data->DateStarted, "long", null)'
            ),
            'Status',
            array(
              'name' => 'DateCompleted',
              'type' => 'raw',
              'value' => 'Yii::app()->dateFormatter->formatDateTime($data->DateCompleted, "long", null)'
            ),

            
			array(
				'class'=>'bootstrap.widgets.TbButtonColumn',
				'template'=>'{update}{delete}',
				'buttons'=>array(
			        'update' => array(
	                    'label'=>'Edit',
	                    'icon'=>'icon-edit',
	                    'url'=>'Yii::app()->createUrl("applicantMilestones/editMilestone", array("id"=>$data->primaryKey,"asDialog"=>1,"gridId"=>$this->grid->id))',
	                    'click'=>'function(){
	                        $("#milestone-cru-frame").attr("src",$(this).attr("href"));
	                        $("#milestone-cru-dialog").dialog("open");
	                        return false;
	                    }',
			        ),
					'delete' => array(
							'label'=>'delete milestone',
							'icon'=>'remove',
							'url'=>'Yii::app()->createUrl("applicantMilestones/delete", array("id"=>$data->ID))',
					),
				),
			),


          ),
        )); 


?>

<?php
/*
    the EDIT dialog
*/
// add the (closed) dialog for the iframe
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'milestone-cru-dialog',
    'options'=>array(
        'title'=>'Milestone Details',
        'autoOpen'=>false,
        'modal'=>false,
        'width'=>600,
        'height'=>650,
    ),
));
?>
<iframe id="milestone-cru-frame" width="100%" height="100%"></iframe>
<?php $this->endWidget(); ?>


