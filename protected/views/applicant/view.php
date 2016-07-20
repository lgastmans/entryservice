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

<?php
	echo TbHtml::linkButton(
		'Export to PDF',
		array(
			'submit'=>CController::createUrl('applicant/viewPdf', array('ID'=>$model->ID)),
			'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
			'id'=>'btnPDF'
		)
	); 
?>

<div>
	<div style="float: left;margin-bottom:70px;">

		<h3><?php echo $model->FullName." (".$model->AVName.")"; ?></h3>

		<div>
			<div style="float: left;width:200px;">
				<b>Status</b>: <?php echo ApplicantStatus::model()->getCurrentStatus($model->ID);?>
				<br>
				<b>Nationality</b>: <?php echo $model->nationality->Nationality; ?>
				<br>
				<b>RS No.</b>: <?php echo $model->ResServiceNum; ?>
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
	</div>

</div>
<div style="clear:both;"></div>


<!-- INDIA ID / PASSPORT / VISA -->

<div>
	<?php
		if ($model->nationality->Nationality=="India") {
			$info="ID : Not Set";
			if (isset($model->india->TypeID)) {
				$info = $model->india->TypeID." ".$model->india->Number;
			}
	?>
	
		<b>ID</b>: <?php echo $info;?>

	<?php
		} else {
			$ppInfo = "<b>Passport</b>: Not Set";
			if (isset($model->passport)) {
				if (isset($model->passport->ValidTill))
					$ppInfo = "<b>Passport</b>: ".$model->passport->PassportNumber.", valid till ".$model->passport->ValidTill;
				else
					$ppInfo = "<b>Passport</b>: ".$model->passport->PassportNumber;
			}

			$vInfo = "<b>Visa</b>: Not Set";
			if (isset($model->visa)) {
				if (isset($model->visa->ValidTill))
					$vInfo = "<b>Visa</b>: ".$model->visa->VisaType.", valid till ".$model->visa->ValidTill;
				else
					$vInfo = "<b>Visa</b>: ".$model->visa->VisaType;
			}
	?>

		<?php echo $ppInfo."<br>".$vInfo; ?>

	<?php
		}
	?>
</div>


<!-- ADDRESSES -->
<br>
<div>
	<?php 
		$arr = Address::model()->search($model->ID);
		//print_r($arr);

		foreach ($arr->getData() as $address) {
			$str = "<b>RES</b>: ".$address['community']['Name'];

			if (isset($address['FromDate']))
				$str .= ", from ".$address['FromDate'];

			if (isset($address['ToDate']))
				$str .= " to ".$address['ToDate'];

			$str .= "<br>";

			echo $str;
		}
	?>
</div>


<!-- WORK -->
<br>
<div>
	<?php 
		$arr = Work::model()->search($model->ID);
		//print_r($arr);

		foreach ($arr->getData() as $work) {
			$str = "<b>WORK</b>: ".$work['Place'];

			if (isset($work['FromDate']))
				$str .= ", from ".$work['FromDate'];

			if (isset($work['ToDate']))
				$str .= " to ".$work['ToDate'];

			$str .= "<br>";

			echo $str;
		}
	?>
</div>