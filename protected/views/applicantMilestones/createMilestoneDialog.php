<?php 

$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'applicantMilestoneDialog',
                'options'=>array(
                    'title'=>Yii::t('applicantMilestone','New Milestone'),
                    'autoOpen'=>true,
                    'modal'=>'true',
                    'width'=>'auto',
                    'height'=>'600',
                    'close' => "js:function(e) {
                    	jQuery('body').undelegate('#applicantMilestoneDialog', 'click');
                    	jQuery('#applicantMilestoneDialog').empty();
                    }",
                ),
                ));

echo $this->renderPartial('_milestoneDialog', array('model'=>$model)); 

$this->endWidget('zii.widgets.jui.CJuiDialog');

?>

