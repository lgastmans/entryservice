<?php
/* @var $this ApplicantController */
/* @var $model Applicant */
?>

<?php
$this->breadcrumbs=array(
	'Applicants'=>array('index'),
	$model->Name=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label' => 'actions'),
	TbHtml::menuDivider(),
//	array('label'=>'List Applicant', 'url'=>array('index')),
	array('label'=>'Create', 'url'=>array('create')),
	array('label'=>'View', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage', 'url'=>array('admin')),
);

Yii::app()->clientScript->registerScript('updateJSFuncs', "
	function updateStatus(applicant_id) {
		$.ajax({
			method: 'POST',
			url: '".Yii::app()->createUrl('applicantStatus/currentStatus')."',
			data: { ApplicantID: applicant_id }
		})
		.done(function( msg ) {
			var obj = jQuery.parseJSON(msg);
			$('#infoStatus').html('<b>Status</b> '+obj.current.Description);
			$('#infoPeriod').html(obj.current.StatusPeriod);
		});
		
	}
", CClientScript::POS_END);


	$statusInfo = ApplicantStatus::model()->statusInformation($model->ID);
//print_r($statusInfo);
	$infoAge = '<b>Age</b> '.$model->Age.'<br>';
	$infoStatus = '<b>Status</b> '.$statusInfo['current']['Description'];
	$infoPeriod = $statusInfo['current']['StatusPeriod'];

?>

<link href='http://fonts.googleapis.com/css?family=Oswald:400,700,300' rel='stylesheet' type='text/css'>
<style>
	h1 {
		font-family: 'Oswald', Arial, serif;
		font-weight: 700;
	}
</style>

<div>
	<div style="float: left;">
		<h1>
			<?php 
				echo $model->FullName; 
				if (!empty($model->AVName))
					echo " ( $model->AVName )";
			?>
		</h1>

		<br>

		<div>
			<div id="infoAge"><?php echo $infoAge; ?></div>
			<div id="infoStatus"><?php echo $infoStatus; ?></div>
			<div id="infoPeriod"><?php echo $infoPeriod; ?></div>
		</div>

	</div>
	<div style="float: right;padding-right:100px;">
		<?php
			$applicant_info = $model->ApplicantQRCode;

			$this->widget('application.extensions.qrcode.QRCodeGenerator',array(
			    'data' => $applicant_info,
			    //'data' => "MECARD:N:Luk Gastmans;ADR:Auroville 605101;TEL:9047375310;EMAIL:lgastmans@gmail.com;URL:worktree.in;",
			    //'filePath'=> 'protected/uploads',
			    //'fileUrl'=>'../../protected/uploads',
			    'filename' => $model->ID.".png",
			    'subfolderVar' => false,
			    'matrixPointSize' => 5,
			    'displayImage'=>true, // default to true, if set to false display a URL path
			    'errorCorrectionLevel'=>'L', // available parameter is L,M,Q,H
			    'matrixPointSize'=>4, // 1 to 10 only
			));

		?>
	</div>
</div>
<div style="clear:both;"></div>

<?php
	/*
	echo TbHtml::stackedProgressBar(array(
		array('color' => TbHtml::PROGRESS_COLOR_SUCCESS, 'width' => 35),
	));
	*/
?>

<p style="margin-top:25px;"></p>

<?php

	$this->widget('bootstrap.widgets.TbTabs', array(
	    'tabs'=>array(
	        array(
	            'active'=>true,
	            'label'=>'Applicant',
	            'content'=>$this->renderPartial("_form",
	            	array(
	            		'model' => $model,
	            		'modelAddress' => $modelAddress,
	            		'modelChildren' => $modelChildren,
	            		'modelContact' => $modelContact,
						'modelEmail'=>$modelEmail,
						'modelPhone'=>$modelPhone,
						'modelStatus'=>$modelStatus,
	            	),
	            true),
	        ),
	        array(
	            'label'=>'Details',
	            'content'=>$this->renderPartial("_applicantDetails",
	            	array(
	            		'model' => $model,
						'modelMilestones' => $modelMilestones,
	            		'modelStatus' => $modelStatus,
	            		'modelExtension' => $modelExtension,
	            		'modelAbsence' => $modelAbsence,
	            		'modelWork'=> $modelWork,
	            		'modelStatistics'=>$modelStatistics,
	            	),
	            true),
	        ),
	        array(
	            'label'=>'Milestones',
	            'content'=>$this->renderPartial("_applicantMilestones",
	            	array(
	            		'applicant_id'=>$model->ID,
	            		'model' => $modelMilestones,
	            		'statusInfo' => $statusInfo,
	            	),
	            true),
	        ),
			array(
	            'label'=>'Interviews',
	            'content'=>$this->renderPartial("_applicantInterviews",
	            	array(
	            		'applicant_id'=>$model->ID,
	            		'model' => $modelInterview,
	            	),
	            true),
	        ),
	        array(
	            'label'=>'Delete',
	            'content'=>$this->renderPartial("_applicantDelete",
	            	array(
	            		'applicant_id'=>$model->ID,
	            		'model' => $model,
	            	),
	            true),
	        ),
	    ),
	));

?>

<?php //$this->renderPartial('_form', array('model'=>$model)); ?>
