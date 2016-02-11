<?php 

$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'applicantContactDialog',
                'options'=>array(
                    'title'=>Yii::t('applicantContact','Add Contact Details'),
                    'autoOpen'=>true,
                    'modal'=>'true',
                    'width'=>'auto',
                    'height'=>'auto',
                    'close' => "js:function(e) {
                    	jQuery('body').undelegate('#applicantContactDialog', 'click');
                    	jQuery('#applicantContactDialog').empty();
                    }",
                ),
                ));

echo $this->renderPartial('_contactDialog', array('model'=>$model)); 

$this->endWidget('zii.widgets.jui.CJuiDialog');


?>

