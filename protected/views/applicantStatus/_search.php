<?php
/* @var $this ApplicantStatusController */
/* @var $model ApplicantStatus */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'ID',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'ApplicantID',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'StatusID',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'StartedOn',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'CompletedOn',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'Color',array('span'=>5,'maxlength'=>10)); ?>

                    <?php echo $form->textFieldControlGroup($model,'Duration',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'DurationPeriod',array('span'=>5,'maxlength'=>6)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->