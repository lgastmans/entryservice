<?php
/* @var $this ApplicantRemindersController */
/* @var $model ApplicantReminders */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'applicant-reminders-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
    'layout' => 'horizontal',
)); ?>

<?php
//    echo $_GET['applicantID'].":".$_GET['milestoneID'];
?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

	<?php echo $form->hiddenField($model,'ApplicantID',array('value'=>$_GET['applicantID'])); ?>
	<?php echo $form->hiddenField($model,'ApplicantMilestoneID',array('value'=>$_GET['milestoneID'])); ?>

    <?php 
        echo $form->dropDownListControlGroup($model, 'Status',
            array('Active'=>'Active', 'Completed'=>'Completed', 'Cancelled'=>'Cancelled'),
            array('empty' => 'Select Status...')
        ); 
    ?>

    <?php echo $form->textFieldControlGroup($model,'Description',array('span'=>6,'maxlength'=>64)); ?>

	<?php echo $form->textAreaControlGroup($model,'EmailMessage',array('rows'=>3,'span'=>8)); ?>

    <div>
        <div style="float: left; width:200px;">
            <?php echo $form->textFieldControlGroup($model,'RepeatInterval',array('span'=>1)); ?>
        </div>
        <div style="float: right; margin-right:250px;">
            <?php 
                echo $form->dropDownListControlGroup($model, 'RepeatPeriod',
                    array('Days'=>'Days', 'Weeks'=>'Weeks', 'Months'=>'Months', 'Years'=>'Years'),
                    array('empty' => 'Select Period...', 'label'=>'Period')
                ); 
            ?>
        </div>
    </div>
    <div style="clear:both;"></div>

	<?php echo $form->checkBoxControlGroup($model,'EmailApplicant',array('span'=>5)); ?>

	<?php echo $form->checkBoxControlGroup($model,'EmailTeam',array('span'=>5)); ?>

	<?php echo $form->checkBoxControlGroup($model,'EmailES',array('span'=>5)); ?>

    <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->