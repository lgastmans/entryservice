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
            <?php echo $form->textFieldControlGroup($model,'NewsAndNotes',array('span'=>2)); ?>

            <?php //echo $form->textFieldControlGroup($model,'Color',array('span'=>5,'maxlength'=>10)); ?>

            <?php echo $form->textFieldControlGroup($model,'Duration',array('span'=>2)); ?>

            <?php //echo $form->textFieldControlGroup($model,'DurationPeriod',array('span'=>5,'maxlength'=>6)); ?>
            <?php 
                echo $form->dropDownListControlGroup($model, 'DurationPeriod',
                    array('None'=>'None', 'Days'=>'Days', 'Weeks'=>'Weeks', 'Months'=>'Months', 'Years'=>'Years'),
                    array('empty' => 'Select Duration...')
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
