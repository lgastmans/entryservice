<?php 

$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'applicantStatusDialog',
                'options'=>array(
                    'title'=>Yii::t('applicantStatus','Add Status Details'),
                    'autoOpen'=>true,
                    'modal'=>'true',
                    'width'=>'500',
                    'height'=>'500',
                    'close' => "js:function(e) {
                    	jQuery('body').undelegate('#applicantStatusDialog', 'click');
                    	jQuery('#applicantStatusDialog').empty();
                    }",
                ),
                ));

echo $this->renderPartial('_statusDialog', array('model'=>$model)); 

$this->endWidget('zii.widgets.jui.CJuiDialog');


?>

