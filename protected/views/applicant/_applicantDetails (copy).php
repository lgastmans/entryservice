<?php
/* @var $this ApplicantController */
/* @var $model Applicant */
/* @var $form TbActiveForm */
?>


<?php
            $this->widget('yiiwheels.widgets.box.WhBox', array(
                'title' => 'Status',
                'headerIcon' => TbHtml::ICON_INFO_SIGN,
                /*
                'headerButtons' => array(
                    TbHtml::buttonGroup(
                        array(
                            array('label' => 'Add', 'url' => $this->createUrl('applicantStatus/addnew&applicant_id='.$model->ID)),
                        )
                    ),
                    '&nbsp;&nbsp;',
                ),
                */
                'content' => $this->renderPartial("_formStatus", array('applicant_id'=>$model->ID, 'model' => $modelStatus),true),
                'htmlOptions' => array('style'=>'width:970px;'),
            ));
            
            $this->widget('yiiwheels.widgets.box.WhBox', array(
                'title' => 'Extensions',
                'headerIcon' => TbHtml::ICON_INFO_SIGN,
                'content' => $this->renderPartial("_formExtension", array('applicant_id'=>$model->ID, 'model' => $modelExtension),true),
                'htmlOptions' => array('style'=>'width:970px;'),
            ));

            $this->widget('yiiwheels.widgets.box.WhBox', array(
                'title' => 'Absences',
                'headerIcon' => TbHtml::ICON_INFO_SIGN,
                'content' => $this->renderPartial("_formAbsence", array('applicant_id'=>$model->ID, 'model' => $modelAbsence),true),
                'htmlOptions' => array('style'=>'width:970px;'),
            ));

            $this->widget('yiiwheels.widgets.box.WhBox', array(
                'title' => 'Work',
                'headerIcon' => TbHtml::ICON_INFO_SIGN,
                'content' => $this->renderPartial("_formWork", array('applicant_id'=>$model->ID, 'model' => $modelWork),true),
                'htmlOptions' => array('style'=>'width:970px;'),
            ));

            $this->widget('yiiwheels.widgets.box.WhBox', array(
                'title' => 'Statistics',
                'headerIcon' => TbHtml::ICON_INFO_SIGN,
                'content' => $this->renderPartial("_formStatistics", array('applicant_id'=>$model->ID, 'model' => $modelStatistics),true),                'htmlOptions' => array('style'=>'width:970px;'),
            ));

        ?>
