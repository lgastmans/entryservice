<?php
/* @var $this ApplicantMilestonesController */
/* @var $model ApplicantMilestones */
/* @var $form TbActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'applicant-milestones-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
    'layout' => 'horizontal',
));

    $today = new DateTime();
    $today = $today->format('Y-m-d');

?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

            <?php 
                if (isset($_GET['applicant_id'])) {
                    echo $form->hiddenField($model,'ApplicantID',array('value'=>$_GET['applicant_id']));

                    echo $form->dropDownListControlGroup($model, 'MilestoneCategoryID',
                        CHtml::listData(MilestoneCategory::model()->findAll(), 'ID', 'Description'),
                        array('empty' => 'Select Category...')
                    ); 
                }
            ?>

            <?php //echo $form->textFieldControlGroup($model,'Status',array('span'=>5,'maxlength'=>9)); ?>
            <?php 
                echo $form->dropDownListControlGroup($model, 'Status',
                    array('Pending'=>'Pending', 'Completed'=>'Completed', 'Cancelled'=>'Cancelled', 'NA'=>'NA', 'Extended'=>'Extended'),
                    array('empty' => 'Select Status...')
                ); 
            ?>
            
            <?php 
                if (isset($_GET['applicant_id']))
                    echo $form->textFieldControlGroup($model,'DateCreated',array('span'=>4, 'value'=>$today, 'readonly'=>true)); 
                else
                    echo $form->textFieldControlGroup($model,'DateCreated',array('span'=>4, 'readonly'=>true)); 
            ?>

            <?php //echo $form->textFieldControlGroup($model,'DateStarted',array('span'=>5)); ?>
            <div class="control-group ">
                <label class="control-label" for="ApplicantMilestones_DateStarted">Started</label>
                <div class="controls">
                    <?php
                    $this->widget(
                        'ext.jui.EJuiDateTimePicker',
                        array(
                            'model'     => $model,
                            'attribute' => 'DateStarted',
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

            <?php //echo $form->textFieldControlGroup($model,'DateCompleted',array('span'=>5)); ?>
            <div class="control-group ">
                <label class="control-label" for="ApplicantMilestones_DateCompleted">Completed</label>
                <div class="controls">
                    <?php
                    $this->widget(
                        'ext.jui.EJuiDateTimePicker',
                        array(
                            'model'     => $model,
                            'attribute' => 'DateCompleted',
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

            <?php 
                if (isset($_GET['applicant_id']))
                    echo $form->textFieldControlGroup($model,'Description',array('span'=>5,'maxlength'=>128)); 
                else
                    echo $form->textFieldControlGroup($model,'Description',array('span'=>5,'maxlength'=>128, 'readonly'=>true)); 
            ?>

            <?php echo $form->textAreaControlGroup($model,'Remarks',array('rows'=>3,'span'=>8)); ?>

            <div>
                <div style="float: left; width:200px;">
                    <?php echo $form->textFieldControlGroup($model,'TimelineInterval',array('span'=>1)); ?>
                </div>
                <div style="float: right; margin-right:250px;">
                    <?php 
                        echo $form->dropDownListControlGroup($model, 'TimelinePeriod',
                            array('Days'=>'Days', 'Weeks'=>'Weeks', 'Months'=>'Months', 'Years'=>'Years'),
                            array('empty' => 'Select Period...', 'label'=>'Period')
                        ); 
                    ?>
                </div>
            </div>
            <div style="clear:both;"></div>

            <?php echo $form->checkBoxControlGroup($model,'Alert',array('span'=>5)); ?>

            <div>
                <div style="float: left; width:200px;">
                    <?php echo $form->textFieldControlGroup($model,'AlertInterval',array('span'=>1)); ?>
                </div>
                <div style="float: right; margin-right:250px;">
                    <?php 
                        echo $form->dropDownListControlGroup($model, 'AlertPeriod',
                            array('Days'=>'Days', 'Weeks'=>'Weeks', 'Months'=>'Months', 'Years'=>'Years'),
                            array('empty' => 'Select Period...', 'label'=>'Period')
                        ); 
                    ?>
                </div>
            </div>
            <div style="clear:both;"></div>

            <?php echo $form->checkBoxControlGroup($model,'RepeatAlert',array('span'=>5)); ?>

            <?php //echo $form->textFieldControlGroup($model,'IsAlerted',array('span'=>5)); ?>

            <?php echo $form->checkBoxControlGroup($model,'SendEmail',array('span'=>5,'maxlength'=>1)); ?>

            <?php echo $form->checkBoxControlGroup($model,'IsActive',array('span'=>5,'maxlength'=>1)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->