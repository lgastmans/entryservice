<?php
/* @var $this AbsenceController */
/* @var $model Absence */
/* @var $form TbActiveForm */
?>

<div class="form">

<?php 
    $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'absence-form',
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
                echo $form->dropDownListControlGroup($model, 'StatusID',
                    CHtml::listData(
                        Status::model()->findAll(array(
                            'select'=>'*',
                            //'join'=>'LEFT JOIN objetivo_indicador oi ON (t.id_indicador = oi.id_indicador)',
                            'condition'=>'t.ID IN ( SELECT StatusID FROM applicant_status WHERE applicantID = :applicantID AND CompletedOn IS NULL)',
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
                <label class="control-label" for="Absence_AbsentOn">Absent On</label>
                <div class="controls">
                    <?php
                    $this->widget(
                        'ext.jui.EJuiDateTimePicker',
                        array(
                            'model'     => $model,
                            'attribute' => 'AbsentOn',
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
                <label class="control-label" for="Absence_AbsentTill">Absent Till</label>
                <div class="controls">
                    <?php
                    $this->widget(
                        'ext.jui.EJuiDateTimePicker',
                        array(
                            'model'     => $model,
                            'attribute' => 'AbsentTill',
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

            <?php echo $form->hiddenField($model,'ApplicantID',array('value'=>$_GET['applicant_id'])); ?>

    <div class="row buttons">
        <?php
            echo CHtml::ajaxSubmitButton(
                    Yii::t('absence','Save'),
                    CHtml::normalizeUrl(array('absence/addnew','render'=>false)),
                    array(
                        'success'=>'js: function(data) {
                            $.fn.yiiGridView.update("applicant-absence-grid", {data: $(this).serialize()});
                            $("#applicantAbsenceDialog").dialog("close");
                        }',
                        'failure'=>'js: function(data) {
                            alert("crap");
                        }',
                    ),
                    array('id'=>'closeApplicantAbsenceDialog')
            ); 
        ?>
    </div>

 
<?php $this->endWidget(); ?>
 
</div>