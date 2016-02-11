<?php
	if (isset($model->PassportID)) {
		
	    echo "<div class='passport-buttons'>";

	    echo CHtml::ajaxButton(
	        Yii::t('ppDel','Delete'),
	        CController::createUrl('applicant/deletePassport',array('id'=>$model->PassportID)),
	        array(
	            //'onclick'=>'$("#personChildDialog").dialog("open"); return false;',
	            //'update'=>'#applicantPassportDialog',
	            'success'=>'function(data) { 
	            	$(".passport-buttons").empty();
	            	$(".passport-detailview").empty();
	            	$(".passport-detailview").html(data);
	            }'
	        ),
	        array('id'=>'delApplicantPassport')
	    );
	    

	    echo CHtml::ajaxButton(
	        Yii::t('ppUpdate','Update'),
	        CController::createUrl('applicant/updatePassport',array('id'=>$model->PassportID)),
	        array(
	          	'update'=>'#applicantPassportDialog',  
	        ),
	        array('id'=>'showApplicantPassportDialog')
	    );
		
	    echo "</div>";
		echo "<div class='passport-detailview'>";

			$this->widget(
				'yiiwheels.widgets.detail.WhDetailView',
				array(
					'data' => array(
						'PassportNumber' => $model->passport->PassportNumber,
						'IssuedDate' => $model->passport->IssuedDate,
						'ValidTill' => $model->passport->ValidTill,
						'IssuedBy' => $model->passport->IssuedBy,
					),
					'attributes' => array(
						array('name' => 'PassportNumber'),
						array('name' => 'IssuedDate'),
						array('name' => 'ValidTill'),
						array('name' => 'IssuedBy'),
					),
					'htmlOptions' => array(
						'style'=>'width:450px;',
						'id' => 'passportDetailView',
					),
				)
			);

		echo "</div>";
		
	}
	else{
		if (!($model->isNewRecord)) {
			//TbHTML::ajaxLink
			echo "<div class='passport-detailview'>";

		    echo CHtml::ajaxButton(
		        Yii::t('passport','Add Passport Details'),
		        CController::createUrl('applicant/addpassport', array('applicant_id'=>$model->ID)),
		        
		        array(
		            'update'=>'#applicantPassportDialog',
		        ),
		        array('id'=>'showApplicantPassportDialog')
		    );

		    echo "</div>";
		}
	}

	echo "<div id=\"applicantPassportDialog\"></div>";
?>