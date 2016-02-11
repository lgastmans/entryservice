<?php
/* @var $this PassportController */
/* @var $model Passport */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'ID',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'PassportNumber',array('span'=>5,'maxlength'=>32)); ?>

                    <?php echo $form->textFieldControlGroup($model,'IssuedDate',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'ValidTill',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'IssuedBy',array('span'=>5,'maxlength'=>32)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->