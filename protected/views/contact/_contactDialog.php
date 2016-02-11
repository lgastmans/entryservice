<?php
/* @var $this ContactController */
/* @var $model Contact */
/* @var $form TbActiveForm */
?>

<div class="form">

<?php 
    $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'contact-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation'=>false,
        'layout'=>'horizontal',
    )); 
    
?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

            <?php echo $form->dropDownListControlGroup($model,'Category', array('Self'=>'Self','Emergency'=>'Emergency','Home'=>'Home','Contact Person'=>'Contact Person')); ?>

            <?php echo $form->dropDownListControlGroup($model,'Relationship', array('None'=>'None', 'Partner'=>'Partner', 'Family'=>'Family', 'Friend'=>'Friend')); ?>

            <?php echo $form->textFieldControlGroup($model,'Name',array('span'=>5,'maxlength'=>64)); ?>

            <?php echo $form->textFieldControlGroup($model,'Surname',array('span'=>5,'maxlength'=>64)); ?>

            <?php echo $form->textFieldControlGroup($model,'Address',array('span'=>5,'maxlength'=>128)); ?>

            <?php 
                echo $form->dropDownListControlGroup($model, 'CountryID',
                    CHtml::listData(Nationality::model()->findAll(array('order'=>'Nationality')), 'ID', 'Nationality'),
                    array(
                        'empty' => 'Select country...', 
                        'id'=>'selCountry',
                    )
                ); 
            ?>

            <?php echo $form->textFieldControlGroup($model,'Email',array('span'=>5,'maxlength'=>64)); ?>

            <?php echo $form->textFieldControlGroup($model,'Phone',array('span'=>5,'maxlength'=>64)); ?>

            <?php echo $form->hiddenField($model,'ApplicantID',array('value'=>$_GET['applicant_id'])); ?>

    <div class="row buttons">
        <?php
            echo CHtml::ajaxSubmitButton(
                    Yii::t('contact','Save'),
                    CHtml::normalizeUrl(array('contact/addnew','render'=>false)),
                    array(
                        'success'=>'js: function(data) {
                            $.fn.yiiGridView.update("applicant-contact-grid", {data: $(this).serialize()});
                            $("#applicantContactDialog").dialog("close");
                        }',
                        'failure'=>'js: function(data) {
                            alert("crap");
                        }',
                    ),
                    array('id'=>'closeApplicantContactDialog')
            ); 
        ?>
    </div>

 
<?php $this->endWidget(); ?>
 
</div>
