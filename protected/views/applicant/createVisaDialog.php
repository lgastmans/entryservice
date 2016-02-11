<?php 

$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'applicantVisaDialog',
                'options'=>array(
                    'title'=>Yii::t('applicantVisa','Add Visa Details'),
                    'autoOpen'=>true,
                    'modal'=>'true',
                    'width'=>'auto',
                    'height'=>'auto',
                    'close' => "js:function(e) {
                    	jQuery('body').undelegate('#applicantVisaDialog', 'click');
                    	jQuery('#applicantVisaDialog').empty();
                    }",
                ),
                ));

echo $this->renderPartial('_visaDialog', array('model'=>$model)); 

$this->endWidget('zii.widgets.jui.CJuiDialog');


?>

