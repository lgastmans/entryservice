<?php
/* @var $this MeetingController */
/* @var $model Meeting */
/* @var $form TbActiveForm */
?>

<div class="form">

<?php
    $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    	'id'=>'meeting-form',
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

            <?php //echo $form->textFieldControlGroup($model,'Category',array('span'=>5,'maxlength'=>8)); ?>

            <div class="control-group ">
                <label class="control-label" for="Meeting_Category">Category</label>
                <div class="controls">
                    <?php echo ZHtml::enumDropDownList($model,'Category'); ?>
                </div>
            </div>

            <?php //echo $form->textFieldControlGroup($model,'MeetingDate',array('span'=>5)); ?>
            <div class="control-group ">
                <label class="control-label" for="Meeting_MeetingDate">On</label>
                <div class="controls">
                    <?php
                    $this->widget('yiiwheels.widgets.datepicker.WhDatePicker',
                        array(
                            'model'     => $model,
                            'attribute' => 'MeetingDate',
                            'pluginOptions' => array(
                                'format' => 'yyyy-mm-dd'
                            )
                        )
                    );
                    ?>
                </div>
            </div>

            <?php echo $form->textFieldControlGroup($model,'Title',array('span'=>4,'maxlength'=>128)); ?>


            <?php 
                echo $form->dropDownListControlGroup($model, 'meetingMembers',
                    CHtml::listData(Member::model()->findAll(), 'ID', 'Name'),
                    array('multiple' => true, 'size'=>5)
                ); 
            ?>

            <?php
                /*
                echo ":".count($model->meetingMembers).": members attended:<br>"; 

                foreach ($model->meetingMembers as $member) {
                    echo $member->ID." ".$member->Name." ".$member->Surname." ";
                }

                $dp = Member::model()->search(true); //true => only active members
                $iterator = $dp->getData();
                $members = array();
                foreach ($iterator as $row) {
                    $members[$row->ID] = $row->Name;
                }
                */

                /*
                $this->widget('yiiwheels.widgets.multiselect.WhMultiSelect', array(
                    'name' => 'meetingMembers',
                    'data' => array('One','Two','Three'),
                ));
                */
            ?>

            <?php //echo $form->textAreaControlGroup($model,'Content',array('rows'=>6,'span'=>8)); ?>

            <div class="control-group ">
                <label class="control-label" for="Meeting_Content">Content</label>
                <div class="controls">
                    <?php
                        $this->widget('yiiwheels.widgets.redactor.WhRedactor', array(
                            'model'     => $model,
                            'attribute' => 'Content',
                        ));
                    ?>
                </div>
            </div>

        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->