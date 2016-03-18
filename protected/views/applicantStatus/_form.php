<?php
/* @var $this ApplicantStatusController */
/* @var $model ApplicantStatus */
/* @var $form TbActiveForm */
?>
<?php

    Yii::app()->clientScript->registerScript('statusJSFuncs', "
        $('#selectStatusID').change(function() {
            $.ajax({
                type: 'POST',
                url: '".Yii::app()->createUrl('status/statusInfo')."',
                data: { status_id: this.value }
            })
            .done(function( msg ) {
                var obj = JSON.parse(msg);
                $('#fieldDuration').val(obj.Duration);
                $('#fieldPeriod').val(obj.DurationPeriod);
            });

            $('#fieldDuration').val(this.value);

        });
    ", CClientScript::POS_END);

?>

<div class="form">

<?php 
    $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    	'id'=>'applicant-status-form',
    	// Please note: When you enable ajax validation, make sure the corresponding
    	// controller action is handling ajax validation correctly.
    	// There is a call to performAjaxValidation() commented in generated controller code.
    	// See class documentation of CActiveForm for details on this.
    	'enableAjaxValidation'=>false,
    )); 

?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php
      if ($model->isNewRecord)
        echo $form->hiddenField($model,'ApplicantID',array('value'=>$_GET['applicant_id']));
    ?>


            <?php
                echo $form->dropDownListControlGroup($model, 'StatusID',
                    CHtml::listData(
                        Status::model()->findAll(array(
                            'select'=>'*',
                            'condition'=>'t.ID NOT IN ( SELECT StatusID FROM applicant_status WHERE applicantID = :applicantID )',
                            'params'=>array(':applicantID'=>$_GET['applicant_id']),
                            )
                        ),
                        'ID', 'Description'),
                    array(
                        'id' => 'selectStatusID',
                        'empty' => 'Select Status...',
                    )
                );
            ?>

            <div class="control-group ">
                <label class="control-label" for="ApplicantStatus_StartedOn">Started On</label>
                <div class="controls">
                    <?php
                      $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                          'model'=> $model,
                          'attribute'=>'StartedOn',
                          'name'=>'dpStatus-StartedOn',    
                          //'value'=>date('d-m-Y'),
                          'options'=>array(
                              'showButtonPanel'=>true,
                              'yearRange'=>'-50:+25',
                              'changeMonth'=>true,
                              'changeYear'=>true,
                              'dateFormat'=>'dd-mm-yy',
                              'showAnim'=>'fadeIn',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                          ),
                          'htmlOptions'=>array(
                              'style'=>''
                          ),
                      ));

                    /*
                    $this->widget('yiiwheels.widgets.datepicker.WhDatePicker',
                        array(
                            'model'     => $model,
                            'attribute' => 'StartedOn',
                            'pluginOptions' => array(
                                'format' => 'yyyy-mm-dd'
                            )
                        )
                    );
                    */
                    ?>
                </div>
            </div>
            <div class="control-group ">
                <label class="control-label" for="ApplicantStatus_CompletedOn">Completed On</label>
                <div class="controls">
                    <?php
                      $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                          'model'=> $model,
                          'attribute'=>'CompletedOn',
                          'name'=>'datepicker-CompletedOn',    
                          //'value'=>date('d-m-Y'),
                          'options'=>array(
                              'showButtonPanel'=>true,
                              'changeMonth'=>true,
                              'changeYear'=>true,
                              'dateFormat'=>'dd-mm-yy',
                              'showAnim'=>'fadeIn',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                          ),
                          'htmlOptions'=>array(
                              'style'=>''
                          ),
                      ));
                    /*
                    $this->widget('yiiwheels.widgets.datepicker.WhDatePicker',
                        array(
                            'model'     => $model,
                            'attribute' => 'CompletedOn',
                            'pluginOptions' => array(
                                'format' => 'yyyy-mm-dd'
                            )
                        )
                    );
                    */
                    ?>
                </div>
            </div>

            <?php echo $form->textFieldControlGroup($model,'NewsAndNotes',array('span'=>2)); ?>

            <?php //echo $form->textFieldControlGroup($model,'Color',array('span'=>5,'maxlength'=>10)); ?>

            <?php 
                echo $form->textFieldControlGroup($model,'Duration',
                    array(
                        'id'=>'fieldDuration',
                        'span'=>2
                    )
                ); 
            ?>

            <?php //echo $form->textFieldControlGroup($model,'DurationPeriod',array('span'=>5,'maxlength'=>6)); ?>
            <?php 
                echo $form->dropDownListControlGroup($model, 'DurationPeriod',
                    array('None'=>'None', 'Days'=>'Days', 'Weeks'=>'Weeks', 'Months'=>'Months', 'Years'=>'Years'),
                    array(
                        'id'=>'fieldPeriod',
                        'empty' => 'Select Duration...'
                    )
                ); 
            ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
