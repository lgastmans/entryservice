<?php
/* @var $this InterviewController */
/* @var $model Interview */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'interview-form',
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
            
            <?php //echo $form->textFieldControlGroup($model,'DateInterviewed',array('span'=>5)); ?>
            <div class="control-group ">
                <label class="control-label" for="Interview_DateInterviewed">On</label>
                <div class="controls">
                    <?php
                    $this->widget('yiiwheels.widgets.datepicker.WhDatePicker',
                        array(
                            'model'     => $model,
                            'attribute' => 'DateInterviewed',
                            'pluginOptions' => array(
                                'format' => 'yyyy-mm-dd'
                            )
                        )
                    );
                    ?>
                </div>
            </div>

            <?php echo $form->textFieldControlGroup($model,'Title',array('span'=>5,'maxlength'=>128)); ?>

            <?php echo $form->textFieldControlGroup($model,'Present',array('span'=>5)); ?>

            <?php //echo $form->textAreaControlGroup($model,'Interview',array('rows'=>6,'span'=>8)); ?>
            <div class="control-group ">
                <label class="control-label" for="Interview_Interview">Content</label>
                <div class="controls">
                    <?php
                        $this->widget('yiiwheels.widgets.redactor.WhRedactor', array(
                            'model'     => $model,
                            'attribute' => 'Interview',
                        ));
                    ?>
                </div>
            </div>

        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->