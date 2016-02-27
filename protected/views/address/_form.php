<?php
/* @var $this AddressController */
/* @var $model Address */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'address-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

            <?php //echo $form->textFieldControlGroup($model,'ApplicantID',array('span'=>5)); ?>
            <?php
              if ($model->isNewRecord)
                echo $form->hiddenField($model,'ApplicantID',array('value'=>$_GET['applicant_id']));
            ?>

            <?php //echo $form->textFieldControlGroup($model,'CommunityID',array('span'=>5)); ?>
            <?php
                echo $form->dropDownListControlGroup($model, 'CommunityID',
                    CHtml::listData(Community::model()->findAll(), 'ID', 'Name'),
                    array('empty' => 'Select Community...')
                );
            ?>

            <?php echo $form->dropDownListControlGroup($model,'Status',
                        array('Living with Steward'=>'Living with Steward', 'Steward'=>'Steward', 'House-sitting'=>'House-sitting', 'NC Accomodation'=>'NC Accomodation', 'Staff Accomodation'=>'Staff Accomodation', 'Renting'=>'Renting', 'Guest House'=>'Guest House')
                    );
            ?>

            <div class="control-group ">
                <label class="control-label" for="Address_FromDate">From</label>
                <div class="controls">
                    <?php
                      $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                          'model'=> $model,
                          'attribute'=>'FromDate',
                          'name'=>'datepicker-addressFromDate',    
                          //'value'=>date('d-m-Y'),
                          'options'=>array(
                              'showButtonPanel'=>true,
                              'changeMonth'=>true,
                              'changeYear'=>true,
                              'dateFormat'=>'dd-mm-yy',
                              'showAnim'=>'fadeIn',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                          ),
                          'htmlOptions'=>array(
                              'style'=>''
                          ),
                      ));
                    /*
                    $this->widget('yiiwheels.widgets.datepicker.WhDatePicker',
                        array(
                            'model'     => $model,
                            'attribute' => 'FromDate',
                            'pluginOptions' => array(
                                'format' => 'yyyy-mm-dd'
                            )
                        )
                    );
                    */
                    ?>
                </div>
            </div>
            <div class="control-group ">
                <label class="control-label" for="Address_ToDate">To</label>
                <div class="controls">
                    <?php
                       $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                          'model'=> $model,
                          'attribute'=>'ToDate',
                          'name'=>'datepicker-addressToDate',    
                          //'value'=>date('d-m-Y'),
                          'options'=>array(
                              'showButtonPanel'=>true,
                              'changeMonth'=>true,
                              'changeYear'=>true,
                              'dateFormat'=>'dd-mm-yy',
                              'showAnim'=>'fadeIn',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                          ),
                          'htmlOptions'=>array(
                              'style'=>''
                          ),
                      ));
                    /*
                    $this->widget('yiiwheels.widgets.datepicker.WhDatePicker',
                        array(
                            'model'     => $model,
                            'attribute' => 'ToDate',
                            'pluginOptions' => array(
                                'format' => 'yyyy-mm-dd'
                            )
                        )
                    );
                    */
                    ?>
                </div>
            </div>

<?php /*
            <div class="control-group ">
                <label class="control-label" for="Address_FromDate">From</label>
                <div class="controls">
                    <?php
                    $this->widget(
                        'ext.jui.EJuiDateTimePicker',
                        array(
                            'model'     => $model,
                            'attribute' => 'FromDate',
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

            <div class="control-group ">
                <label class="control-label" for="Address_ToDate">To</label>
                <div class="controls">
                    <?php
                    $this->widget(
                        'ext.jui.EJuiDateTimePicker',
                        array(
                            'model'     => $model,
                            'attribute' => 'ToDate',
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
*/?>
        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
