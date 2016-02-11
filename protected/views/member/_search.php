<?php
/* @var $this MemberController */
/* @var $model Member */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'ID',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'Name',array('span'=>5,'maxlength'=>64)); ?>

                    <?php echo $form->textFieldControlGroup($model,'Surname',array('span'=>5,'maxlength'=>64)); ?>

                    <?php echo $form->textFieldControlGroup($model,'FromDate',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'ToDate',array('span'=>5)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->