<?php
/* @var $this ApplicantStatisticsController */
/* @var $model ApplicantStatistics */
/* @var $form TbActiveForm */
?>

<div class="form">

<?php 
    $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'statistics-form',
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
                echo $form->dropDownListControlGroup($model, 'CategoryID',
                    CHtml::listData(
                        StatisticsCategory::model()->findAll(array('order'=>'Category',)), 'ID', 'Category'),
                    array(
                        'id' => 'selCategory',
                        'empty' => 'Select Category...',
                    )
                ); 

            ?>

            <?php 
                echo $form->dropDownListControlGroup($model, 'AnswerID',
                    CHtml::listData(
                        StatisticsAnswer::model()->findAll(array('order'=>'Answer',)), 'ID', 'Answer'),
                    array(
                        'id' => 'selAnswer',
                        'empty' => 'Select Answer...',
                    )
                ); 

            ?>

            <div class="control-group ">
                <label class="control-label" for="ApplicantStatistics_DateRecorded">Recorded On</label>
                <div class="controls">
                    <?php
                    $this->widget(
                        'ext.jui.EJuiDateTimePicker',
                        array(
                            'model'     => $model,
                            'attribute' => 'DateRecorded',
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


            <?php echo $form->hiddenField($model,'ApplicantID',array('value'=>$_GET['applicant_id'])); ?>

    <div class="row buttons">
        <?php
            echo CHtml::ajaxSubmitButton(
                    Yii::t('statistics','Save'),
                    CHtml::normalizeUrl(array('applicantStatistics/addnew','render'=>false)),
                    array(
                        'success'=>'js: function(data) {
                            $.fn.yiiGridView.update("applicant-statistics-grid", {data: $(this).serialize()});
                            $("#applicantStatisticsDialog").dialog("close");
                        }',
                        'failure'=>'js: function(data) {
                            alert("crap");
                        }',
                    ),
                    array('id'=>'closeApplicantStatisticsDialog')
            ); 
        ?>
    </div>

 
<?php $this->endWidget(); ?>
 
</div>