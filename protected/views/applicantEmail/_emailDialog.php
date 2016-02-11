<?php
/* @var $this ApplicantEmailController */
/* @var $model ApplicantEmail */
/* @var $form TbActiveForm */
?>

<div class="form">

<?php 
    $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'applicant-email-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation'=>false,
    )); 
    
?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

            <?php echo $form->emailFieldControlGroup($model,'Email',array('span'=>5,'maxlength'=>64)); ?>

            <?php //echo $form->textFieldControlGroup($model,'IsPrimary',array('span'=>5,'maxlength'=>1)); ?>
            <?php echo $form->dropDownListControlGroup($model,'IsPrimary', array('Y'=>'Yes', 'N'=>'No')); ?>

            <?php echo $form->hiddenField($model,'ApplicantID',array('value'=>$_GET['applicant_id'])); ?>

    <div class="row buttons">
        <?php
            echo CHtml::ajaxSubmitButton(
                    Yii::t('email','Save'),
                    CHtml::normalizeUrl(array('applicantEmail/addnew','render'=>false)),
                    array(
                        'success'=>'js: function(data) {
                            $.fn.yiiGridView.update("applicant-email-grid", {data: $(this).serialize()});
                            $("#applicantEmailDialog").dialog("close");
                        }',
                        'failure'=>'js: function(data) {
                            alert("crap");
                        }',
                    ),
                    array('id'=>'closeApplicantEmailDialog')
            ); 
        ?>
    </div>

 
<?php $this->endWidget(); ?>
 
</div>