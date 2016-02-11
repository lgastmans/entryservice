<?php 

$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'applicantAddressDialog',
                'options'=>array(
                    'title'=>Yii::t('applicantAddress','Add Address Details'),
                    'autoOpen'=>true,
                    'modal'=>'true',
                    'width'=>'600',
                    'height'=>'550',
                    'close' => "js:function(e) {
                    	jQuery('body').undelegate('#applicantAddressDialog', 'click');
                    	jQuery('#applicantAddressDialog').empty();
                    }",
                ),
                ));

echo $this->renderPartial('_addressDialog', array('model'=>$model)); 

$this->endWidget('zii.widgets.jui.CJuiDialog');


?>

