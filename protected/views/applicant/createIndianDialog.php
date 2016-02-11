<?php 

$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'applicantIndianDialog',
                'options'=>array(
                    'title'=>Yii::t('applicantIndian','Add Indian ID Details'),
                    'autoOpen'=>true,
                    'modal'=>'true',
                    'width'=>'auto',
                    'height'=>'auto',
                    'close' => "js:function(e) {
                    	jQuery('body').undelegate('#applicantIndianDialog', 'click');
                    	jQuery('#applicantIndianDialog').empty();
                    }",
                ),
                ));

echo $this->renderPartial('_indianDialog', array('model'=>$model)); 

$this->endWidget('zii.widgets.jui.CJuiDialog');


?>

