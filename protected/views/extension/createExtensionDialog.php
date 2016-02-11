<?php 

$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'applicantExtensionDialog',
                'options'=>array(
                    'title'=>Yii::t('extension','Add Extension Details'),
                    'autoOpen'=>true,
                    'modal'=>'true',
                    'width'=>'auto',
                    'height'=>'auto',
                    'close' => "js:function(e) {
                    	jQuery('body').undelegate('#applicantExtensionDialog', 'click');
                    	jQuery('#applicantExtensionDialog').empty();
                    }",
                ),
                ));

echo $this->renderPartial('_extensionDialog', array('model'=>$model)); 

$this->endWidget('zii.widgets.jui.CJuiDialog');


?>

