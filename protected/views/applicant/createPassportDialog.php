<?php 

$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'applicantPassportDialog',
                'options'=>array(
                    'title'=>Yii::t('applicantPassport','Add Passport Details'),
                    'autoOpen'=>true,
                    'modal'=>'true',
                    'width'=>'auto',
                    'height'=>'auto',
                    'close' => "js:function(e) {
                    	jQuery('body').undelegate('#applicantPassportDialog', 'click');
                    	jQuery('#applicantPassportDialog').empty();
                    }",
                ),
                ));

echo $this->renderPartial('_passportDialog', array('model'=>$model)); 

$this->endWidget('zii.widgets.jui.CJuiDialog');


?>

