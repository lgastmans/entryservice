<?php
	if (isset($model->IndiaID)) {
		
	    echo "<div class='indian-buttons'>";

	    echo CHtml::ajaxButton(
	        Yii::t('indDel','Delete'),
	        CController::createUrl('applicant/deleteIndian',array('id'=>$model->IndiaID)),
	        array(
	            'success'=>'function(data) { 
	            	$(".indian-buttons").empty();
	            	$(".indian-detailview").empty();
	            	$(".indian-detailview").html(data);
	            }'
	        ),
	        array('id'=>'delApplicantIndian')
	    );
	    
	    echo CHtml::ajaxButton(
	        Yii::t('indUpdate','Update'),
	        CController::createUrl('applicant/updateIndian',array('id'=>$model->IndiaID)),
	        array(
	          	'update'=>'#applicantIndianDialog',  
	        ),
	        array('id'=>'showApplicantIndianDialog')
	    );
		
	    echo "</div>";
		echo "<div class='indian-detailview'>";

			$this->widget(
				'yiiwheels.widgets.detail.WhDetailView',
				array(
					'data' => array(
						'TypeID' => $model->india->TypeID,
						'Number' => $model->india->Number,
						'IssuedDate' => (is_null($model->india->IssuedDate)? "" : $model->india->IssuedDate),
						'ValidTill' => (is_null($model->india->ValidTill)? "" : $model->india->ValidTill),
						'StateID' => $model->india->State,
					),
					'attributes' => array(
						array('name' => 'TypeID'),
						array('name' => 'Number'),
						array('name' => 'IssuedDate'),
						array('name' => 'ValidTill'),
						array('name' => 'StateID'),
					),
					'htmlOptions' => array(
						'style'=>'width:450px;',
						'id' => 'indianDetailView',
					),
				)
			);

		echo "</div>";
		
	}
	else{
		if (!($model->isNewRecord)) {
			//TbHTML::ajaxLink
			echo "<div class='indian-detailview'>";

		    echo CHtml::ajaxButton(
		        Yii::t('indian','Add Indian ID Details'),
		        CController::createUrl('applicant/addIndian', array('applicant_id'=>$model->ID)),
		        //$this->createUrl('applicant/addpassport&applicant_id='.$model->ID),
		        array(
		            'update'=>'#applicantIndianDialog',
		        ),
		        array('id'=>'showApplicantIndianDialog')
		    );

		    echo "</div>";
		}
	}

	echo "<div id=\"applicantIndianDialog\"></div>";
?>