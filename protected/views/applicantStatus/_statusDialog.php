<?php
/* @var $this ApplicantStatusController */
/* @var $model ApplicantStatus */
/* @var $form TbActiveForm */
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

    /*
    Yii::app()->clientScript->registerScript('sel_status', "
        $('#selStatus').change(function() {
            alert(this.value);
            return false;
        });
    ");
    */
?>

    <p class="help-block">Fields with <span class="required">*</span> EDIT are required.</p>

    <?php echo $form->errorSummary($model); ?>

            <?php
                echo $form->dropDownListControlGroup($model, 'StatusID',
                    CHtml::listData(
                        Status::model()->findAll(array(
                            'select'=>'*',
                            //'join'=>'LEFT JOIN objetivo_indicador oi ON (t.id_indicador = oi.id_indicador)',
                            'condition'=>'t.ID NOT IN ( SELECT StatusID FROM applicant_status WHERE applicantID = :applicantID )',
                            'params'=>array(':applicantID'=>$_GET['applicant_id']),
                            )
                        ),
                        'ID', 'Description'),
                    array(
                        'id' => 'selStatus',
                        'empty' => 'Select Status...',
                    )
                );
            ?>

            <div class="control-group ">
                <label class="control-label" for="ApplicantStatus_StartedOn">Started On</label>
                <div class="controls">
                    <?php
                    $this->widget('yiiwheels.widgets.datepicker.WhDatePicker',
                        array(
                            'model'     => $model,
                            'attribute' => 'StartedOn',
                            'pluginOptions' => array(
                                'format' => 'yyyy-mm-dd'
                            )
                        )
                    );
                    ?>
                </div>
            </div>
            <div class="control-group ">
                <label class="control-label" for="ApplicantStatus_CompletedOn">Completed On</label>
                <div class="controls">
                    <?php
                    $this->widget('yiiwheels.widgets.datepicker.WhDatePicker',
                        array(
                            'model'     => $model,
                            'attribute' => 'CompletedOn',
                            'pluginOptions' => array(
                                'format' => 'yyyy-mm-dd'
                            )
                        )
                    );
                    ?>
                </div>
            </div>

<?php /*
            <div class="control-group ">
                <label class="control-label" for="ApplicantStatus_StartedOn">Started On</label>
                <div class="controls">
                    <?php
                    $this->widget(
                        'ext.jui.EJuiDateTimePicker',
                        array(
                            'model'     => $model,
                            'attribute' => 'StartedOn',
                            'language'=> 'en', //Yii::app()->language,
                            'mode'    => 'date',//'datetime' or 'time' ('datetime' default)
                            'options'   => array(
                                'dateFormat' => 'yy-mm-dd',
                            ),
                        )
                    );
                    ?>
                </div>
            </div>

            <div class="control-group ">
                <label class="control-label" for="ApplicantStatus_CompletedOn">Completed On</label>
                <div class="controls">
                    <?php
                    $this->widget(
                        'ext.jui.EJuiDateTimePicker',
                        array(
                            'model'     => $model,
                            'attribute' => 'CompletedOn',
                            'language'=> 'en', //Yii::app()->language,
                            'mode'    => 'date',//'datetime' or 'time' ('datetime' default)
                            'options'   => array(
                                'dateFormat' => 'yy-mm-dd',
                            ),
                        )
                    );
                    ?>
                </div>
            </div>
*/?>
            <?php echo $form->textFieldControlGroup($model,'NewsAndNotes',array('span'=>2)); ?>

            <?php echo $form->hiddenField($model,'Duration'); ?>
            <?php echo $form->hiddenField($model,'DurationPeriod'); ?>

            <?php echo $form->hiddenField($model,'ApplicantID',array('value'=>$_GET['applicant_id'])); ?>

    <div class="row buttons">
        <?php
            echo CHtml::ajaxSubmitButton(
                    Yii::t('status','Save'),
                    CHtml::normalizeUrl(array('applicantStatus/addnew','render'=>false)),
                    array(
                        'success'=>'js: function(data) {
                            $.fn.yiiGridView.update("applicant-status-grid", {data: $(this).serialize()});
                            $("#applicantStatusDialog").dialog("close");
                        }',
                        'failure'=>'js: function(data) {
                            alert("crap");
                        }',
                    ),
                    array('id'=>'closeApplicantStatusDialog')
            );
        ?>
    </div>


<?php $this->endWidget(); ?>

</div>
