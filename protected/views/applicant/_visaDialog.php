<?php
/* @var $this VisaController */
/* @var $model Visa */
/* @var $form TbActiveForm */
?>

<div class="form">

<?php 
    $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'visa-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation'=>false,
    )); 
    
?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

            <?php //echo $form->textFieldControlGroup($model,'VisaType',array('span'=>5,'maxlength'=>9)); ?>
            <?php echo $form->dropDownListControlGroup($model,'VisaType',
                array('Visa'=>'Visa', 'Student'=>'Student', 'Entry'=>'Entry', 'Business'=>'Business', 'Tourist'=>'Tourist', 'PIO'=>'PIO', 'OCI'=>'OCI', 'RP'=>'Residential Permit', 'Stay Visa'=>'Stay Visa', 'Other'=>'Other')
                ); 
            ?>


            <?php echo $form->textFieldControlGroup($model,'Number',array('span'=>5,'maxlength'=>16)); ?>

            <?php //echo $form->textFieldControlGroup($model,'IssuedDate',array('span'=>5)); ?>
            <div class="control-group ">
                <label class="control-label" for="Applicant_IssuedDate">Date of issue</label>
                <div class="controls">
                    <?php
                      $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                          'model'=> $model,
                          'attribute'=>'IssuedDate',
                          'name'=>'datepicker-visaIssuedDate',    
                          //'value'=>date('d-m-Y'),
                          'options'=>array(
                              'showButtonPanel'=>true,
                              'yearRange'=>'-50:+0',
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
                            'attribute' => 'IssuedDate',
                            'pluginOptions' => array(
                                'format' => 'yyyy-mm-dd'
                            )
                        )
                    );
                    */
                    ?>
                </div>
            </div>        

            <?php //echo $form->textFieldControlGroup($model,'ValidTill',array('span'=>5)); ?>
            <div class="control-group ">
                <label class="control-label" for="Applicant_ValidTill">Valid till</label>
                <div class="controls">
                    <?php
                      $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                          'model'=> $model,
                          'attribute'=>'ValidTill',
                          'name'=>'datepicker-visaValidTill',    
                          //'value'=>date('d-m-Y'),
                          'options'=>array(
                              'showButtonPanel'=>true,
                              'yearRange'=>'-0:+50',
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
                            'attribute' => 'ValidTill',
                            'pluginOptions' => array(
                                'format' => 'yyyy-mm-dd'
                            )
                        )
                    );
                    */
                    ?>
                </div>
            </div>        

        <div class="form-actions">
        <?php 
            //ajaxButton( string $label, mixed $url, array $ajaxOptions = array(), array $htmlOptions = array() )            
            /*
            echo TbHtml::ajaxButton(
                    $model->isNewRecord ? 'Create' : 'Save',
                    array('applicant/addPassport'),
                    array(
                        'dataType'=>'json',
                        'type'=>'post',
                        'success'=>'function(response) {
                            $("#applicantPassportDialog").dialog("close");
                        }',
                        'failure'=>'function(response) {
                            alert("error");
                        }',
                    ),
                    array(
                        'id'=>'closeApplicantPassportDialog',
                        'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
                        'size'=>TbHtml::BUTTON_SIZE_SMALL,
                    )
                );
            /*
            echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',
                array(
                    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
                    'size'=>TbHtml::BUTTON_SIZE_LARGE,
                )
            );
            */ 
        ?>
        </div>
 
    <div class="row buttons">
        <?php
            if (isset($_GET['id']))
                $url = CController::createUrl('applicant/updateVisa',array('id'=>$_GET['id']));
            else
                $url = CController::createUrl('applicant/addVisa',array('applicant_id'=>$_GET['applicant_id']));

            echo CHtml::ajaxSubmitButton(
                    Yii::t('applicant','Save'),
                    $url,
                    array(
                        'success'=>'js: function(data,ui) {
                            $("#applicantVisaDialog").dialog("close");

                            var arr = JSON.parse(data);

                            $("#Applicant_VisaID").val(arr.id);

                            var str = arr.view;
                            arr.view = str.replace("Not set", "");

                            $(".visa-detailview").html(arr.view);
                        }',
                        'failure'=>'js: function(data) {
                            alert("error");
                        }',
                    ),
                    array('id'=>'closeApplicantVisaDialog')
            ); 
        ?>
    </div>

 
<?php $this->endWidget(); ?>
 
</div>
