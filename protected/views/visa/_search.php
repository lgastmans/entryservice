<?php
/* @var $this VisaController */
/* @var $model Visa */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'ID',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'VisaType',array('span'=>5,'maxlength'=>9)); ?>

                    <?php echo $form->textFieldControlGroup($model,'Number',array('span'=>5,'maxlength'=>16)); ?>

                    <?php echo $form->textFieldControlGroup($model,'IssuedDate',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'ValidTill',array('span'=>5)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->