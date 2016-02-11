<?php 

$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'applicantChildrenDialog',
                'options'=>array(
                    'title'=>Yii::t('applicantChildren','Add Children Details'),
                    'autoOpen'=>true,
                    'modal'=>'true',
                    'width'=>'auto',
                    'height'=>'auto',
                    'close' => "js:function(e) {
                    	jQuery('body').undelegate('#applicantChildrenDialog', 'click');
                    	jQuery('#applicantChildrenDialog').empty();
                    }",
                ),
                ));

echo $this->renderPartial('_childrenDialog', array('model'=>$model)); 

$this->endWidget('zii.widgets.jui.CJuiDialog');


?>

