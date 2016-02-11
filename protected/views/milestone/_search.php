<?php
/* @var $this MilestoneController */
/* @var $model Milestone */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'ID',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'MilestoneCategoryID',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'Description',array('span'=>5,'maxlength'=>128)); ?>

                    <?php echo $form->textFieldControlGroup($model,'TimelineInterval',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'TimelinePeriod',array('span'=>5,'maxlength'=>6)); ?>

                    <?php echo $form->textFieldControlGroup($model,'SendEmail',array('span'=>5,'maxlength'=>1)); ?>

                    <?php echo $form->textFieldControlGroup($model,'Alert',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'AlertInterval',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'AlertPeriod',array('span'=>5,'maxlength'=>6)); ?>

                    <?php echo $form->textFieldControlGroup($model,'RepeatAlert',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'IsAlerted',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'IsActive',array('span'=>5,'maxlength'=>1)); ?>

                    <?php echo $form->textFieldControlGroup($model,'IsDefault',array('span'=>5)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->