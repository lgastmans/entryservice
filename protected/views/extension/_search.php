<?php
/* @var $this ExtensionController */
/* @var $model Extension */
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

                    <?php echo $form->textFieldControlGroup($model,'ExtendedOn',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'ExtendedFor',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'ExtendedPeriod',array('span'=>5,'maxlength'=>6)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->