<?php
/* @var $this IndianIDController */
/* @var $model IndianID */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'indian-id-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

            <?php //echo $form->textFieldControlGroup($model,'TypeID',array('span'=>5,'maxlength'=>20)); ?>
            <?php echo $form->dropDownListControlGroup($model,'TypeID', array(
                    'Voter ID'=>'Voter ID',
                    'Driver License' => 'Driver License',
                    'Transfer Certificate' => 'Transfer Certificate',
                    'Birth Certificate' => 'Birth Certificate',
                    'Passport' => 'Passport',
                    'Ration Card' => 'Ration Card',
                    'Aadhaar' => 'Aadhar',
                    )
                ); 
            ?>

            <?php echo $form->textFieldControlGroup($model,'Number',array('span'=>5,'maxlength'=>32)); ?>

            <?php //echo $form->textFieldControlGroup($model,'IssuedDate',array('span'=>5)); ?>
            <div class="control-group ">
                <label class="control-label" for="Applicant_IssuedDate">Issued On</label>
                <div class="controls">
                    <?php
                    $this->widget('yiiwheels.widgets.datepicker.WhDatePicker',
                        array(
                            'model'     => $model,
                            'attribute' => 'IssuedDate',
                            'pluginOptions' => array(
                                'format' => 'yyyy-mm-dd'
                            )
                        )
                    );
                    ?>
                </div>
            </div>        

            <?php //echo $form->textFieldControlGroup($model,'ValidTill',array('span'=>5)); ?>
            <div class="control-group ">
                <label class="control-label" for="Applicant_ValidTill">Valid till</label>
                <div class="controls">
                    <?php
                    $this->widget('yiiwheels.widgets.datepicker.WhDatePicker',
                        array(
                            'model'     => $model,
                            'attribute' => 'ValidTill',
                            'pluginOptions' => array(
                                'format' => 'yyyy-mm-dd'
                            )
                        )
                    );
                    ?>
                </div>
            </div>        

            <?php 
                echo $form->dropDownListControlGroup($model, 'StateID',
                    CHtml::listData(State::model()->findAll(array('order'=>'StateName')), 'StateID', 'StateName'),
                    array(
                        'empty' => 'Select state...', 
                        'id'=>'selState',
                    )
                ); 
            ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->