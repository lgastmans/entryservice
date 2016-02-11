<?php
/* @var $this ChildrenController */
/* @var $model Children */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'children-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

            <?php
              if ($model->isNewRecord)
                echo $form->hiddenField($model,'ApplicantID',array('value'=>$_GET['applicant_id']));
            ?>

            <?php echo $form->textFieldControlGroup($model,'Name',array('span'=>4,'maxlength'=>64)); ?>

            <?php echo $form->textFieldControlGroup($model,'Surname',array('span'=>4,'maxlength'=>64)); ?>

            <?php
                echo $form->dropDownListControlGroup($model, 'SchoolID',
                    CHtml::listData(School::model()->findAll(), 'ID', 'Name'),
                    array('empty' => 'Select School...')
                );
            ?>

            <?php echo $form->textFieldControlGroup($model,'PassportNumber',array('span'=>3,'maxlength'=>32)); ?>

            <div class="control-group ">
                <label class="control-label" for="Children_IssuedDate">Issued On</label>
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

            <div class="control-group ">
                <label class="control-label" for="Children_ValidTill">Valid Till</label>
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

            <div class="control-group ">
                <label class="control-label" for="Children_BirthDate">Birth Date</label>
                <div class="controls">
                    <?php
                    $this->widget('yiiwheels.widgets.datepicker.WhDatePicker',
                        array(
                            'model'     => $model,
                            'attribute' => 'BirthDate',
                            'pluginOptions' => array(
                                'format' => 'yyyy-mm-dd'
                            )
                        )
                    );
                    ?>
                </div>
            </div>

<?php /*
            <div class="control-group ">
                <label class="control-label" for="Children_IssuedDate">Issued On</label>
                <div class="controls">
                    <?php
                    $this->widget(
                        'ext.jui.EJuiDateTimePicker',
                        array(
                            'model'     => $model,
                            'attribute' => 'IssuedDate',
                            'language'=> 'en', //Yii::app()->language,
                            'mode'    => 'date',//'datetime' or 'time' ('datetime' default)
                            'options'   => array(
                                'dateFormat' => 'yy-mm-dd',
                            ),
                        )
                    );
                    ?>
                </div>
            </div>

            <?php //echo $form->textFieldControlGroup($model,'ValidTill',array('span'=>5)); ?>
            <div class="control-group ">
                <label class="control-label" for="Children_ValidTill">Valid Till</label>
                <div class="controls">
                    <?php
                    $this->widget(
                        'ext.jui.EJuiDateTimePicker',
                        array(
                            'model'     => $model,
                            'attribute' => 'ValidTill',
                            'language'=> 'en', //Yii::app()->language,
                            'mode'    => 'date',//'datetime' or 'time' ('datetime' default)
                            'options'   => array(
                                'dateFormat' => 'yy-mm-dd',
                            ),
                        )
                    );
                    ?>
                </div>
            </div>

            <?php //echo $form->textFieldControlGroup($model,'BirthDate',array('span'=>5)); ?>
            <div class="control-group ">
                <label class="control-label" for="Children_BirthDate">Date of birth</label>
                <div class="controls">
                    <?php
                    $this->widget(
                        'ext.jui.EJuiDateTimePicker',
                        array(
                            'model'     => $model,
                            'attribute' => 'BirthDate',
                            'language'=> 'en', //Yii::app()->language,
                            'mode'    => 'date',//'datetime' or 'time' ('datetime' default)
                            'options'   => array(
                                'dateFormat' => 'yy-mm-dd',
                            ),
                        )
                    );
                    ?>
                </div>
            </div>
*/ ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
