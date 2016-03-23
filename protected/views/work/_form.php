<?php
/* @var $this WorkController */
/* @var $model Work */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'work-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

        <?php
            if ($model->isNewRecord)
                echo $form->hiddenField($model,'ApplicantID',array('value'=>$_GET['applicant_id']));
        ?>

        <?php echo $form->textFieldControlGroup($model,'Place',array('span'=>5,'maxlength'=>64)); ?>

        <?php echo $form->textFieldControlGroup($model,'Notes',array('rows'=>5,'span'=>8)); ?>

            <div class="control-group ">
                <label class="control-label" for="Work_FromDate">From</label>
                <div class="controls">
                    <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                            'model'=> $model,
                            'attribute'=>'FromDate',
                            'name'=>'datepicker-FromDate',    
                            //'value'=>date('d-m-Y'),
                            'options'=>array(
                                'showButtonPanel'=>true,
                                'yearRange'=>'-50:+25',
                                'changeMonth'=>true,
                                'changeYear'=>true,
                                'dateFormat'=>'dd-mm-yy',
                                //'showAnim'=>'fadeIn',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                            ),
                            'htmlOptions'=>array(
                                'style'=>''
                            ),
                        ));
                    ?>
                </div>
            </div>

            <div class="control-group ">
                <label class="control-label" for="Work_ToDate">To</label>
                <div class="controls">
                    <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                            'model'=> $model,
                            'attribute'=>'ToDate',
                            'name'=>'datepicker-ToDate',    
                            //'value'=>date('d-m-Y'),
                            'options'=>array(
                                'showButtonPanel'=>true,
                                'yearRange'=>'-50:+25',
                                'changeMonth'=>true,
                                'changeYear'=>true,
                                'dateFormat'=>'dd-mm-yy',
                                //'showAnim'=>'fadeIn',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                            ),
                            'htmlOptions'=>array(
                                'style'=>''
                            ),
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