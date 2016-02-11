<?php
/* @var $this ApplicantStatisticsController */
/* @var $model ApplicantStatistics */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'ID',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'ApplicantID',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'CategoryID',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'AnswerID',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'DateRecorded',array('span'=>5)); ?>

                    <?php echo $form->textAreaControlGroup($model,'Notes',array('rows'=>6,'span'=>8)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->