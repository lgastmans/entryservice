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
			$info="Not Set";
			if (isset($model->india->TypeID)) {
				$info = $model->india->TypeID." ".$model->india->Number;
			}
	?>
	
		<b>ID</b>: <?php echo $IDType;?>

	<?php
		} else {
			$ppInfo = "<b>Passport</b>: Not Set";
			if (isset($model->passport)) {
				$ppInfo = "<b>Passport</b>: ".$model->passport->PassportNumber.", valid till ".$model->passport->ValidTill;
			}

			$vInfo = "<b>Visa</b>: Not Set";
			if (isset($model->visa)) {
				$vInfo = "<b>Visa</b>: ".$model->visa->VisaType.", valid till ".$model->visa->ValidTill;
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

		foreach ($arr->getData() as $address)
			echo "<b>RES</b>: ".$address['community']['Name'].", from ".$address['FromDate']." to ".$address['ToDate']."<br>";
	?>
</div>


<!-- WORK -->
<br>
<div>
	<?php 
		$arr = Work::model()->search($model->ID);
		//print_r($arr);

		foreach ($arr->getData() as $work)
			echo "<b>WORK</b>: ".$work['Place'].", from ".$work['FromDate']." to ".$work['ToDate']."<br>";
	?>
</div>