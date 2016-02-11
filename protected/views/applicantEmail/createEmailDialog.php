<?php 

$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'applicantEmailDialog',
                'options'=>array(
                    'title'=>Yii::t('applicantEmail','Add Email Details'),
                    'autoOpen'=>true,
                    'modal'=>'true',
                    'width'=>'auto',
                    'height'=>'auto',
                    'close' => "js:function(e) {
                    	jQuery('body').undelegate('#applicantEmailDialog', 'click');
                    	jQuery('#applicantEmailDialog').empty();
                    }",
                ),
                ));

echo $this->renderPartial('_emailDialog', array('model'=>$model)); 

$this->endWidget('zii.widgets.jui.CJuiDialog');


?>

