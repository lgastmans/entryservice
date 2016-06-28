<?php
/* @var $this ApplicantController */
/* @var $model Applicant */
?>

<?php
$this->breadcrumbs=array(
	'Applicants'=>array('index'),
	$model->Name,
);

$this->menu=array(
	array('label' => 'actions'),
	TbHtml::menuDivider(),
//	array('label'=>'List Applicant', 'url'=>array('index')),
	array('label'=>'Create', 'url'=>array('create')),
	array('label'=>'Update', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage', 'url'=>array('admin')),
);

/*
	Applicant's age
*/
//$from = new DateTime($model->BirthDate);
//$to   = new DateTime('today');
//$DOB  = $from->diff($to)->y;
?>

<style>
	.table.detail-view th, .table.detail-view td {
	  line-height: 12px !important;
	}
</style>

<div>
	<div style="float: left;margin-bottom:70px;">

		<h3><?php echo $model->FullName." ( ".$model->ResServiceNum." )"; ?></h3>

		<div>
			<div style="float: left;width:200px;">
				<b>Status</b>: <?php echo ApplicantStatus::model()->getCurrentStatus($model->ID);?>
				<br>
				<b>Nationality</b>: <?php echo $model->nationality->Nationality; ?>
			</div>
			<div style="float: right;">
				<?php
					echo ApplicantPhone::model()->getPrimaryPhone($model->ID);
					echo "<br>";
					echo TbHtml::icon(TbHtml::ICON_ENVELOPE)." ".ApplicantEmail::model()->getPrimaryEmail($model->ID);
					echo "<br>";
				?>
			</div>
		</div>

	</div>

	<div style="float: right;">
		<?php
			if ($model->Photo!='')
				echo "<img src='".Yii::app()->request->baseUrl."/images/applicants/".$model->Photo."' width='100'/>";
			/*
			else
				echo TbHtml::icon(TbHtml::ICON_CAMERA);
			*/
		?>
		<?php
			/*
			$applicant_info = $model->ApplicantQRCode;

			$this->widget('application.extensions.qrcode.QRCodeGenerator',array(
			    'data' => $applicant_info,
			    //'data' => "MECARD:N:Luk Gastmans;ADR:Auroville 605101;TEL:9047375310;EMAIL:lgastmans@gmail.com;URL:worktree.in;",
			    //'filePath'=> 'protected/uploads',
			    //'fileUrl'=>'protected/uploads',
			    'filename' => $model->ID.".png",
			    'subfolderVar' => false,
			    'matrixPointSize' => 5,
			    'displayImage'=>true, // default to true, if set to false display a URL path
			    'errorCorrectionLevel'=>'L', // available parameter is L,M,Q,H
			    'matrixPointSize'=>4, // 1 to 10 only
			));
			*/
		?>
	</div>

</div>
<div style="clear:both;"></div>



<div>
	<div style="float: left;width:350px;">
		<?php
			foreach ($model->contacts as $row) {
				echo "<b>".$row->Category.":</b><br> ".$row->Relationship." ".$row->Name." ".$row->Surname."<br>".$row->Address."<br><br>";
			}

		?>
	</div>
	<div style="float: right;width:350px;">
		<?php

			$this->widget('zii.widgets.CDetailView',array(
			    'htmlOptions' => array(
			        'class' => 'table detail-view table-striped table-condensed table-hover',
			    ),
			    'data'=>$model,
			    'attributes'=>array(
					'BirthPlace',
					array(
						'name'=>'BirthDate',
						'value'=>Yii::app()->dateFormatter->formatDateTime($model->BirthDate, "long", null),
					),
					array(
						'name'=>'Age',
						'value'=>$model->DOB,
					),
					array(
						'name'=>'Sex',
						'value'=>($model->Sex=='M') ? "Male" : "Female",
					),
					'MaritalStatus',
					'Spouse',
				),
			)); 
		?>


		<?php

			if ($model->nationality->Nationality=="India") {

				echo "<span class='label label-success'>Identification</span>";

				$this->widget('zii.widgets.CDetailView',array(
				    'htmlOptions' => array(
				        'class' => 'table detail-view table-striped table-condensed table-hover',
				    ),
				    'data'=>$model,
				    'attributes'=>array(
						'IndiaID',
					),
				)); 
			}
			else {
				//$modelPassport = Passport::model()->
				echo "<span class='label label-success'>Passport</span>";

				$this->widget('zii.widgets.CDetailView',array(
				    'htmlOptions' => array(
				        'class' => 'table detail-view table-striped table-condensed table-hover',
				    ),
				    'data'=>$model,
				    'attributes'=>array(
						'passport.PassportNumber',
						'passport.IssuedDate',
						'passport.ValidTill',
					),
				)); 

				echo "<span class='label label-success'>Visa</span>";

				$this->widget('zii.widgets.CDetailView',array(
				    'htmlOptions' => array(
				        'class' => 'table detail-view table-striped table-condensed table-hover',
				    ),
				    'data'=>$model,
				    'attributes'=>array(
						'visa.VisaType',
						'visa.Number',
						'visa.IssuedDate',
						'visa.ValidTill',
					),
				)); 
			}
		?>
	</div>
</div>
<div style="clear:both;"></div>

