<?php
	if (isset($model->VisaID)) {
		
	    echo "<div class='visa-buttons'>";

	    echo CHtml::ajaxButton(
	        Yii::t('visaDel','Delete'),
	        CController::createUrl('applicant/deleteVisa',array('id'=>$model->VisaID)),
	        array(
	            //'onclick'=>'$("#personChildDialog").dialog("open"); return false;',
	            //'update'=>'#applicantPassportDialog',
	            'success'=>'function(data) { 
	            	$(".visa-buttons").empty();
	            	$(".visa-detailview").empty();
	            	$(".visa-detailview").html(data);
	            	$("#Applicant_VisaID").val(null);
	            }'
	        ),
	        array('id'=>'delApplicantVisa')
	    );
	    

	    echo CHtml::ajaxButton(
	        Yii::t('visaUpdate','Update'),
	        CController::createUrl('applicant/updateVisa',array('id'=>$model->VisaID)),
	        array(
	          	'update'=>'#applicantVisaDialog',  
	        ),
	        array('id'=>'showApplicantVisaDialog')
	    );
		
	    echo "</div>";
		echo "<div class='visa-detailview'>";

			$this->widget(
				'yiiwheels.widgets.detail.WhDetailView',
				array(
					'data' => array(
						'VisaType' => $model->visa->VisaType,
						'Number' => $model->visa->Number,
						'IssuedDate' => $model->visa->IssuedDate,
						'ValidTill' => $model->visa->ValidTill,
					),
					'attributes' => array(
						array('name' => 'VisaType'),
						array('name' => 'Number'),
						array('name' => 'IssuedDate'),
						array('name' => 'ValidTill'),
					),
					'htmlOptions' => array(
						'style'=>'width:450px;',
						'id' => 'visaDetailView',
					),
				)
			);

		echo "</div>";

	}
	else{
		if (!($model->isNewRecord)) {
			//TbHTML::ajaxLink
			echo "<div class='visa-detailview'>";

		    echo CHtml::ajaxButton(
		        Yii::t('visa','Add Visa Details'),
		        CController::createUrl('applicant/addvisa', array('applicant_id'=>$model->ID)),
		        array(
		            'update'=>'#applicantVisaDialog',
		        ),
		        array('id'=>'showApplicantVisaDialog')
		    );

		    echo "</div>";
		}
	}

	echo "<div id=\"applicantVisaDialog\"></div>";
?>