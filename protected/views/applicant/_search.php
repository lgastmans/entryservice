<?php
/* @var $this ApplicantController */
/* @var $model Applicant */
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

                    <?php echo $form->textFieldControlGroup($model,'BirthPlace',array('span'=>5,'maxlength'=>64)); ?>

                    <?php echo $form->textFieldControlGroup($model,'BirthDate',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'Photo',array('span'=>5,'maxlength'=>128)); ?>

                    <?php echo $form->textFieldControlGroup($model,'Sex',array('span'=>5,'maxlength'=>1)); ?>

                    <?php echo $form->textFieldControlGroup($model,'MaritalStatus',array('span'=>5,'maxlength'=>8)); ?>

                    <?php echo $form->textFieldControlGroup($model,'ResServiceNum',array('span'=>5)); ?>

                    <?php echo $form->textAreaControlGroup($model,'Notes',array('rows'=>6,'span'=>8)); ?>

                    <?php echo $form->textFieldControlGroup($model,'NationalityID',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'PassportID',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'VisaID',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'IndiaID',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'Spouse',array('span'=>5,'maxlength'=>64)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->