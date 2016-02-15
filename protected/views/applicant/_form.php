<?php
/* @var $this ApplicantController */
/* @var $model Applicant */
/* @var $form TbActiveForm */
?>


<div class="form">

<?php

    $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    	'id'=>'applicant-form',
    	// Please note: When you enable ajax validation, make sure the corresponding
    	// controller action is handling ajax validation correctly.
    	// There is a call to performAjaxValidation() commented in generated controller code.
    	// See class documentation of CActiveForm for details on this.
    	'enableAjaxValidation'=>false,
      //'layout'=>'horizontal',
      'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));

    Yii::app()->clientScript->registerScript('sel_nat', "
        $('#selNationality').change(function() {
            //$('.india-form').toggle();
            //$('.foreign-form').toggle();

            if (this.value==105) // India
            {
                $('.india-form').show();
                $('.foreign-form').hide();
            }
            else {
                $('.india-form').hide();
                $('.foreign-form').show();
            }

            return false;
        });
    ");

    if ($model->isNewRecord) {
        $nat_india_visible = "none";
        $nat_foreign_visible = "none";
    }
    else {
        $nat_india_visible = ($model->nationality->Nationality=="India") ? "visible" : "none";
        $nat_foreign_visible = ($model->nationality->Nationality!=="India") ? "visible" : "none";
    }

?>

<div style="width: 100%; display: table;">
    <div style="display: table-row">

<div style="width: 500px; display: table-cell;">


    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

            <?php echo $form->textFieldControlGroup($model,'Name',array('span'=>4,'maxlength'=>64)); ?>

            <?php echo $form->textFieldControlGroup($model,'Surname',array('span'=>4,'maxlength'=>64)); ?>

            <?php echo $form->textFieldControlGroup($model,'BirthPlace',array('span'=>4,'maxlength'=>64)); ?>

            <?php //echo $form->dateFieldControlGroup($model,'BirthDate',array('span'=>2)); ?>
            <div class="control-group ">
                <label class="control-label" for="Applicant_BirthDate">Date of Birth</label>
                <div class="controls">
                    <?php

                    $this->widget('yiiwheels.widgets.datepicker.WhDatePicker',
                        array(
                          'model'     => $model,
                          'attribute' => 'BirthDate',
                          'pluginOptions' => array(
                            'format' => 'yyyy-mm-dd'
                            //'format' => 'dd/mm/yyyy',
                          )
                        )
                    );

                    ?>
                </div>
            </div>

            <?php //echo $form->textFieldControlGroup($model,'Photo',array('span'=>5,'maxlength'=>128)); ?>
            <?php
            if ($model->isNewRecord) {
                echo $form->fileFieldControlGroup($model, 'Photo');
            }
            else {
                if ($model->Photo!='') {
                    echo "<div><img src='".Yii::app()->request->baseUrl."/images/applicants/".$model->Photo."' width='100'/>
                        <label><input type='checkbox' name='Applicant[delimg]' >delete</label></div>";
                }
                else {
                    echo $form->fileFieldControlGroup($model, 'Photo');
                }
            }
            ?>

            <?php echo $form->dropDownListControlGroup($model,'Sex',
                array('M'=>'Male','F'=>'Female'));
            ?>


            <?php echo $form->dropDownListControlGroup($model,'MaritalStatus',
                array('Single'=>'Single','Couple'=>'Couple')
                );
            ?>

            <?php echo $form->textFieldControlGroup($model,'Spouse',array('span'=>4,'maxlength'=>64)); ?>

            <?php
                echo $form->dropDownListControlGroup($model, 'SpouseStatusID',
                    CHtml::listData(Status::model()->findAll(), 'ID', 'Description'),
                    array('empty' => 'Select Status...')
                );
            ?>

            <?php echo $form->textFieldControlGroup($model,'ResServiceNum',array('span'=>4)); ?>

            <?php echo $form->textAreaControlGroup($model,'Notes',array('rows'=>3,'span'=>4)); ?>

            <?php echo $form->textAreaControlGroup($model,'HomeAddress',array('rows'=>3,'span'=>4)); ?>

            <?php
                echo $form->dropDownListControlGroup($model, 'NationalityID',
                    CHtml::listData(Nationality::model()->findAll(array('order'=>'Nationality')), 'ID', 'Nationality'),
                    array(
                        'empty' => 'Select nationality...',
                        'id'=>'selNationality',
                    )
                );
            ?>

            <!-- INDIAN ID DETAILS -->

            <div class="india-form" style="display:<?php echo $nat_india_visible;?>">
                <?php

                    $this->widget('yiiwheels.widgets.box.WhBox', array(
                        'title' => 'Indian ID Details',
                        'headerIcon' => TbHtml::ICON_INFO_SIGN,
                        'content' => $this->renderPartial("_formIndian", array('model' => $model),true),
                        'htmlOptions' => array('style'=>'width:470px;'),
                    ));

                ?>
            </div>
            <?php echo $form->hiddenField($model, 'IndiaID'); ?>

            <!-- FOREIGNER PASSPORT & VISA DETAILS -->

            <div class="foreign-form" style="display:<?php echo $nat_foreign_visible;?>">
                <?php

                    $this->widget('yiiwheels.widgets.box.WhBox', array(
                        'title' => 'Passport Details',
                        'headerIcon' => TbHtml::ICON_INFO_SIGN,
                        'content' => $this->renderPartial("_formPassport", array('model' => $model),true),
                        'htmlOptions' => array('style'=>'width:470px;'),
                    ));

                    $this->widget('yiiwheels.widgets.box.WhBox', array(
                        'title' => 'Visa Details',
                        'headerIcon' => TbHtml::ICON_INFO_SIGN,
                        'content' => $this->renderPartial("_formVisa", array('model' => $model),true),
                        'htmlOptions' => array('style'=>'width:470px;'),
                    ));
                ?>
            </div>
            <?php echo $form->hiddenField($model, 'PassportID'); ?>
            <?php echo $form->hiddenField($model, 'VisaID'); ?>

</div>

<div style="display: table-cell; padding-left:35px;">
    <div>

        <?php
            if (! $model->isNewRecord) {

                $this->widget('yiiwheels.widgets.box.WhBox', array(
                    'title' => 'Email',
                    'headerIcon' => TbHtml::ICON_INFO_SIGN,
                    'content' => $this->renderPartial("_formEmail", array('applicant_id'=>$model->ID, 'model' => $modelEmail),true),
                    'htmlOptions' => array('style'=>'width:460px;'),
                    'headerButtons' => array(
                      TbHtml::button('Add', array(
                        'color' => TbHtml::BUTTON_COLOR_INFO,
                        //'icon' => 'plus',
                        'onclick'=>"{addEmail();}",
                      )),
                    ),
                ));

                $this->widget('yiiwheels.widgets.box.WhBox', array(
                    'title' => 'Phone',
                    'headerIcon' => TbHtml::ICON_INFO_SIGN,
                    'content' => $this->renderPartial("_formPhone", array('applicant_id'=>$model->ID, 'model' => $modelPhone),true),
                    'htmlOptions' => array('style'=>'width:460px;'),
                    'headerButtons' => array(
                      TbHtml::button('Add', array(
                        'color' => TbHtml::BUTTON_COLOR_INFO,
                        //'icon' => 'plus',
                        'onclick'=>"{addPhone();}",
                      )),
                    ),
                ));

                $this->widget('yiiwheels.widgets.box.WhBox', array(
                    'title' => 'Address',
                    'headerIcon' => TbHtml::ICON_INFO_SIGN,
                    'content' => $this->renderPartial("_formAddress", array('applicant_id'=>$model->ID, 'model' => $modelAddress),true),
                    'htmlOptions' => array('style'=>'width:460px;'),
                    'headerButtons' => array(
                      TbHtml::button('Add', array(
                        'color' => TbHtml::BUTTON_COLOR_INFO,
                        //'icon' => 'plus',
                        'onclick'=>"{addAddress();}",
                      )),
                    ),
                ));

                $this->widget('yiiwheels.widgets.box.WhBox', array(
                    'title' => 'Children',
                    'headerIcon' => TbHtml::ICON_INFO_SIGN,
                    'content' => $this->renderPartial("_formChildren", array('applicant_id'=>$model->ID, 'model' => $modelChildren),true),
                    'htmlOptions' => array('style'=>'width:460px;'),
                    'headerButtons' => array(
                      TbHtml::button('Add', array(
                        'color' => TbHtml::BUTTON_COLOR_INFO,
                        //'icon' => 'plus',
                        'onclick'=>"{addChildren();}",
                      )),
                    ),
                ));

                $this->widget('yiiwheels.widgets.box.WhBox', array(
                    'title' => 'Contact Person',
                    'headerIcon' => TbHtml::ICON_INFO_SIGN,
                    'content' => $this->renderPartial("_formContact", array('applicant_id'=>$model->ID, 'model' => $modelContact),true),
                    'htmlOptions' => array('style'=>'width:460px;'),
                    'headerButtons' => array(
                      TbHtml::button('Add', array(
                        'color' => TbHtml::BUTTON_COLOR_INFO,
                        //'icon' => 'plus',
                        'onclick'=>"{addContactPerson();}",
                      )),
                    ),
                ));

                $this->widget('yiiwheels.widgets.box.WhBox', array(
                    'title' => 'Emergency Contact',
                    'headerIcon' => TbHtml::ICON_INFO_SIGN,
                    'content' => $this->renderPartial("_formEmergency", array('applicant_id'=>$model->ID, 'model' => $modelContact),true),
                    'htmlOptions' => array('style'=>'width:460px;'),
                    'headerButtons' => array(
                      TbHtml::button('Add', array(
                        'color' => TbHtml::BUTTON_COLOR_INFO,
                        //'icon' => 'plus',
                        'onclick'=>"{addEmergency();}",
                      )),
                    ),
                ));

            }
        ?>

    </div>
</div>


    </div>  <!-- display: table-row -->
</div>  <!-- display: table -->


        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->




<script>
  function addEmail()
  {
    $.ajax({
      type: "get",
      url: '<?php echo $this->createUrl('applicantEmail/addEmail');?>',
      data: { applicant_id: <?php echo $model->ID;?>, asDialog: 1, gridId: 'applicant-email-grid' }
    })
    .done(function( msg ) {
      $("#email-cru-frame").attr("src",'<?php echo $this->createUrl('applicantEmail/addEmail',array('applicant_id'=>$model->ID, 'asDialog'=>1, 'gridId'=>'applicant-email-grid'));?>');
      $("#email-cru-dialog").dialog("open");
    });
    return false;
  }

  function addPhone()
  {
    $.ajax({
      type: "get",
      url: '<?php echo $this->createUrl('applicantPhone/addPhone');?>',
      data: { applicant_id: <?php echo $model->ID;?>, asDialog: 1, gridId: 'applicant-phone-grid' }
    })
    .done(function( msg ) {
      $("#phone-cru-frame").attr("src",'<?php echo $this->createUrl('applicantPhone/addPhone',array('applicant_id'=>$model->ID, 'asDialog'=>1, 'gridId'=>'applicant-phone-grid'));?>');
      $("#phone-cru-dialog").dialog("open");
    });
    return false;
  }

  function addAddress()
  {
    $.ajax({
      type: "get",
      url: '<?php echo $this->createUrl('address/addAddress');?>',
      data: { applicant_id: <?php echo $model->ID;?>, asDialog: 1, gridId: 'applicant-address-grid' }
    })
    .done(function( msg ) {
      $("#address-cru-frame").attr("src",'<?php echo $this->createUrl('address/addAddress',array('applicant_id'=>$model->ID, 'asDialog'=>1, 'gridId'=>'applicant-address-grid'));?>');
      $("#address-cru-dialog").dialog("open");
    });
    return false;
  }

  function addChildren()
  {
    $.ajax({
      type: "get",
      url: '<?php echo $this->createUrl('children/addChild');?>',
      data: { applicant_id: <?php echo $model->ID;?>, asDialog: 1, gridId: 'applicant-children-grid' }
    })
    .done(function( msg ) {
      $("#children-cru-frame").attr("src",'<?php echo $this->createUrl('children/addChild',array('applicant_id'=>$model->ID, 'asDialog'=>1, 'gridId'=>'applicant-children-grid'));?>');
      $("#children-cru-dialog").dialog("open");
    });
    return false;
  }

  function addContactPerson()
  {
    $.ajax({
      type: "get",
      url: '<?php echo $this->createUrl('contact/addContact');?>',
      data: { applicant_id: <?php echo $model->ID;?>, asDialog: 1, gridId: 'applicant-contact-grid', category: 'contact_person' }
    })
    .done(function( msg ) {
      $("#contact-cru-frame").attr("src",'<?php echo $this->createUrl('contact/addContact',array('applicant_id'=>$model->ID, 'asDialog'=>1, 'gridId'=>'applicant-contact-grid', 'category'=>'contact_person'));?>');
      $("#contact-cru-dialog").dialog("open");
    });
    return false;
  }

  function addEmergency()
  {
    $.ajax({
      type: "get",
      url: '<?php echo $this->createUrl('contact/addContact');?>',
      data: { applicant_id: <?php echo $model->ID;?>, asDialog: 1, gridId: 'applicant-emergency-grid', category: 'emergency' }
    })
    .done(function( msg ) {
      $("#emergency-cru-frame").attr("src",'<?php echo $this->createUrl('contact/addContact',array('applicant_id'=>$model->ID, 'asDialog'=>1, 'gridId'=>'applicant-emergency-grid', 'category'=>'emergency'));?>');
      $("#emergency-cru-dialog").dialog("open");
    });
    return false;
  }

</script>
