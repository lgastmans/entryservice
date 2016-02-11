<?php
/* @var $this ContactController */
/* @var $model Contact */
/* @var $form TbActiveForm */

?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'contact-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
    'layout'=>'horizontal',
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

            <?php
              if ($model->isNewRecord)
                echo $form->hiddenField($model,'ApplicantID',array('value'=>$_GET['applicant_id']));
            ?>

            <?php
              if ($_GET['category']=='contact_person')
                echo $form->hiddenField($model,'Category',array('value'=>'Contact Person'));
              else
                echo $form->hiddenField($model,'Category',array('value'=>'Emergency'));
            ?>

            <?php //echo $form->dropDownListControlGroup($model,'Category', array('Self'=>'Self','Emergency'=>'Emergency','Home'=>'Home','Contact Person'=>'Contact Person')); ?>

            <?php //echo $form->textFieldControlGroup($model,'Relationship',array('span'=>5,'maxlength'=>7)); ?>
            <?php 
                if ($_GET['category']=='emergency')
                    echo $form->dropDownListControlGroup($model,'Relationship', array('None'=>'None', 'Partner'=>'Partner', 'Family'=>'Family', 'Friend'=>'Friend')); 
            ?>

            <?php echo $form->textFieldControlGroup($model,'Name',array('span'=>5,'maxlength'=>64)); ?>

            <?php echo $form->textFieldControlGroup($model,'Surname',array('span'=>5,'maxlength'=>64)); ?>

            <?php
              if ($_GET['category'] == 'contact_person') {

                echo $form->dropDownListControlGroup($model, 'CountryID',
                    CHtml::listData(Community::model()->findAll(), 'ID', 'Name'),
                    array('label'=>'Community', 'empty' => 'Select Community...')
                );
              }
              else {

                echo $form->textFieldControlGroup($model,'Address',array('span'=>5,'maxlength'=>128));

                echo $form->dropDownListControlGroup($model, 'CountryID',
                    CHtml::listData(Nationality::model()->findAll(array('order'=>'Nationality')), 'ID', 'Nationality'),
                    array(
                        'empty' => 'Select country...',
                        'id'=>'selCountry',
                    )
                );
              }
            ?>

            <?php echo $form->textFieldControlGroup($model,'Email',array('span'=>5,'maxlength'=>64)); ?>

            <?php echo $form->textFieldControlGroup($model,'Phone',array('span'=>5,'maxlength'=>64)); ?>

            <?php echo $form->textFieldControlGroup($model,'Cell',array('span'=>5,'maxlength'=>64)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
