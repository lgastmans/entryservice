<?php
/* @var $this ApplicantMilestonesController */
/* @var $model ApplicantMilestones */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'ID',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'ApplicantID',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'Status',array('span'=>5,'maxlength'=>9)); ?>

                    <?php echo $form->textFieldControlGroup($model,'DateCreated',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'DateStarted',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'DateCompleted',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'Description',array('span'=>5,'maxlength'=>128)); ?>

                    <?php echo $form->textAreaControlGroup($model,'Remarks',array('rows'=>6,'span'=>8)); ?>

                    <?php echo $form->textFieldControlGroup($model,'TimelineInterval',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'TimelinePeriod',array('span'=>5,'maxlength'=>6)); ?>

                    <?php echo $form->textFieldControlGroup($model,'Alert',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'AlertInterval',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'AlertPeriod',array('span'=>5,'maxlength'=>6)); ?>

                    <?php echo $form->textFieldControlGroup($model,'RepeatAlert',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'IsAlerted',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'SendEmail',array('span'=>5,'maxlength'=>1)); ?>

                    <?php echo $form->textFieldControlGroup($model,'IsActive',array('span'=>5,'maxlength'=>1)); ?>

                    <?php echo $form->textFieldControlGroup($model,'ColorIndicator',array('span'=>5,'maxlength'=>16)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->