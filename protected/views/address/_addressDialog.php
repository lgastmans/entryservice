<?php
/* @var $this AddressController */
/* @var $model Address */
/* @var $form TbActiveForm */
?>

<div class="form">

<?php
    $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'address-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation'=>false,
    ));

?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

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
        $this->widget('yiiwheels.widgets.datepicker.WhDatePicker',
            array(
                'model'     => $model,
                'attribute' => 'FromDate',
                'pluginOptions' => array(
                    'format' => 'yyyy-mm-dd'
                )
            )
        );
        ?>
    </div>
</div>
<div class="control-group ">
    <label class="control-label" for="Address_ToDate">From</label>
    <div class="controls">
        <?php
        $this->widget('yiiwheels.widgets.datepicker.WhDatePicker',
            array(
                'model'     => $model,
                'attribute' => 'ToDate',
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


            <?php echo $form->hiddenField($model,'ApplicantID',array('value'=>$_GET['applicant_id'])); ?>

    <div class="row buttons">
        <?php
            echo CHtml::ajaxSubmitButton(
                    Yii::t('address','Save'),
                    CHtml::normalizeUrl(array('address/addnew','render'=>false)),
                    array(
                        'success'=>'js: function(data) {
                            $.fn.yiiGridView.update("applicant-address-grid", {data: $(this).serialize()});
                            $("#applicantAddressDialog").dialog("close");
                        }',
                        'failure'=>'js: function(data) {
                            alert("crap");
                        }',
                    ),
                    array('id'=>'closeApplicantAddressDialog')
            );
        ?>
    </div>


<?php $this->endWidget(); ?>

</div>
