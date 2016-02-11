<?php 

$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'applicantAbsenceDialog',
                'options'=>array(
                    'title'=>Yii::t('absence','Add Absence Details'),
                    'autoOpen'=>true,
                    'modal'=>'true',
                    'width'=>'auto',
                    'height'=>'auto',
                    'close' => "js:function(e) {
                        console.log('RES:'+e.responseText);
                    	jQuery('body').undelegate('#applicantAbsenceDialog', 'click');
                    	jQuery('#applicantAbsenceDialog').empty();
                    }",
                ),
                ));

echo $this->renderPartial('_absenceDialog', array('model'=>$model)); 

$this->endWidget('zii.widgets.jui.CJuiDialog');


?>

