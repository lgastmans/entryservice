<?php 

$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'applicantStatisticsDialog',
                'options'=>array(
                    'title'=>Yii::t('statistics','Add Statistics Details'),
                    'autoOpen'=>true,
                    'modal'=>'true',
                    'width'=>'auto',
                    'height'=>'auto',
                    'close' => "js:function(e) {
                    	jQuery('body').undelegate('#applicantStatisticsDialog', 'click');
                    	jQuery('#applicantStatisticsDialog').empty();
                    }",
                ),
                ));

echo $this->renderPartial('_statisticsDialog', array('model'=>$model)); 

$this->endWidget('zii.widgets.jui.CJuiDialog');


?>

