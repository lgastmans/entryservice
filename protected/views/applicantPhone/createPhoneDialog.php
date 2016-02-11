<?php 

$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'applicantPhoneDialog',
                'options'=>array(
                    'title'=>Yii::t('applicantPhone','Add Phone Details'),
                    'autoOpen'=>true,
                    'modal'=>'true',
                    'width'=>'auto',
                    'height'=>'auto',
                    'close' => "js:function(e) {
                    	jQuery('body').undelegate('#applicantPhoneDialog', 'click');
                    	jQuery('#applicantPhoneDialog').empty();
                    }",
                ),
                ));

echo $this->renderPartial('_phoneDialog', array('model'=>$model)); 

$this->endWidget('zii.widgets.jui.CJuiDialog');


?>

