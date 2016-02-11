<?php
/* @var $this ChildrenController */
/* @var $model Children */
/* @var $form TbActiveForm */
?>

<div class="form">

<?php
    $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'children-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation'=>false,
    ));

?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

            <?php echo $form->textFieldControlGroup($model,'Name',array('span'=>5,'maxlength'=>64)); ?>

            <?php echo $form->textFieldControlGroup($model,'Surname',array('span'=>5,'maxlength'=>64)); ?>

            <?php
                echo $form->dropDownListControlGroup($model, 'SchoolID',
                    CHtml::listData(School::model()->findAll(), 'ID', 'Name'),
                    array('empty' => 'Select School...')
                );
            ?>

            <?php echo $form->textFieldControlGroup($model,'PassportNumber',array('span'=>5,'maxlength'=>32)); ?>

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
            <?php //echo $form->textFieldControlGroup($model,'IssuedDate',array('span'=>5)); ?>
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
            <?php echo $form->hiddenField($model,'ApplicantID',array('value'=>$_GET['applicant_id'])); ?>

    <div class="row buttons">
        <?php
            echo CHtml::ajaxSubmitButton(
                    Yii::t('children','Save'),
                    CHtml::normalizeUrl(array('children/addnew','render'=>false)),
                    array(
                        'success'=>'js: function(data) {
                            $.fn.yiiGridView.update("applicant-children-grid", {data: $(this).serialize()});
                            $("#applicantChildrenDialog").dialog("close");
                        }',
                        'failure'=>'js: function(data) {
                            alert("crap");
                        }',
                    ),
                    array('id'=>'closeApplicantChildrenDialog')
            );
        ?>
    </div>


<?php $this->endWidget(); ?>

</div>
