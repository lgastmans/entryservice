<?php
/* @var $this ExtensionController */
/* @var $model Extension */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'extension-form',
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

      <?php 
          echo $form->dropDownListControlGroup($model, 'StatusID',
              CHtml::listData(
                  Status::model()->findAll(
                    array(
                      'select'=>'*',
                      // 'condition'=>'t.ID IN ( SELECT StatusID FROM extension WHERE ID = :applicantID)',
                      // 'params'=>array(':applicantID'=>$_GET['extension_id']),
                      )
                  ),
                  'ID', 'Description'),
              array(
                  'id' => 'selExtension',
                  'empty' => 'Select Extension...',
              )
          ); 

      ?>


        <div class="control-group ">
            <label class="control-label" for="Extension_ExtendedOn">Extended On</label>
            <div class="controls">
                <?php
                  $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                      'model'=> $model,
                      'attribute'=>'ExtendedOn',
                      'name'=>'datepicker-ExtendedOn',    
                      //'value'=>date('d-m-Y'),
                      'options'=>array(
                          'showButtonPanel'=>true,
                          'yearRange'=>'-50:+25',
                          'changeMonth'=>true,
                          'changeYear'=>true,
                          'dateFormat'=>'dd-mm-yy',
                          'showAnim'=>'fadeIn',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                      ),
                      'htmlOptions'=>array(
                          'style'=>''
                      ),
                  ));
                ?>
            </div>
        </div>

        <?php echo $form->textFieldControlGroup($model,'ExtendedFor',array('span'=>2)); ?>

        <?php 
            echo $form->dropDownListControlGroup($model, 'ExtendedPeriod',
                array('Days'=>'Days', 'Weeks'=>'Weeks', 'Months'=>'Months', 'Years'=>'Years'),
                array('empty' => 'Select Period...')
            ); 
        ?>

        <div class="form-actions">
          <?php 
            echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
  		        'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
  		        'size'=>TbHtml::BUTTON_SIZE_LARGE,
  		      )); 
          ?>
        </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->