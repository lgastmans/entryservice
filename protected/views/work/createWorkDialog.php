<?php 

$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'applicantWorkDialog',
                'options'=>array(
                    'title'=>Yii::t('work','Add Work Details'),
                    'autoOpen'=>true,
                    'modal'=>'true',
                    'width'=>'auto',
                    'height'=>'auto',
                    'close' => "js:function(e) {
                    	jQuery('body').undelegate('#applicantWorkDialog', 'click');
                    	jQuery('#applicantWorkDialog').empty();
                    }",
                ),
                ));

echo $this->renderPartial('_workDialog', array('model'=>$model)); 

$this->endWidget('zii.widgets.jui.CJuiDialog');


?>

