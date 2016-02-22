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


	$statusInfo = ApplicantStatus::model()->statusInformation($model->ID);

//print_r($statusInfo);

	$info = '<b>Age</b> '.$model->DOB.'<br>';
	$dtStartedOn = new DateTime($statusInfo['current']['StartedOn']);
	$dtStartedOn = $dtStartedOn->format('j M, Y');
	if (isset($statusInfo['current']['CompletedOn'])) {
		$dtCompletedOn = new DateTime($statusInfo['current']['CompletedOn']);
		$dtCompletedOn = $dtCompletedOn->format('j M, Y');
	}

	if ($statusInfo['current']['IsSet']) {

		if ($statusInfo['current']['DaysCompleted'] < 0) {
			$str = $statusInfo['current']['Description']. ' status overdue by '.abs($statusInfo['current']['DaysCompleted']).' days';
			echo TbHtml::blockAlert(TbHtml::ALERT_COLOR_ERROR, $str);
			$str = '';
		}
		elseif ($statusInfo['current']['ExtensionsTotalDays'] > 0)
			$str = ', extended by <b>'.$statusInfo['current']['ExtensionsTotalDays'].'</b> days';
		else
			$str = '';

		if ($statusInfo['current']['DaysTotal']=='None')
			$info .= 'Currently <b>'.$statusInfo['current']['Description'].'</b><br>'.
				'Started on <b>'.$dtStartedOn.'</b>'.$str;
		else
			$info .= 'Currently <b>'.$statusInfo['current']['Description'].'</b><br>'.
				'Started on <b>'.$dtStartedOn.'</b>, completes on <b>'.$dtCompletedOn.'</b>'.$str;
	}
	else
		$info .= 'Status Not Set';


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
		<h1><?php echo $model->FullName; ?></h1>
		<br>
		<?php echo TbHtml::well($info); ?>
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
					/*
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
					*/
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
