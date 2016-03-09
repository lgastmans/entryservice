<?php
/* @var $this SiteController */

	$this->pageTitle=Yii::app()->name;

	$today = new DateTime();
?>

<h3><?php echo $today->format('l, d M Y');?></h3>

<br><br>

<?php
	if(!Yii::app()->user->isGuest) {

		$modelApplicantStatus = new ApplicantStatus;

		/*
			Current Status Totals
		*/
		$arr = $modelApplicantStatus->StatusTotals;
		
		$data = array();
		$data[] = array('Status', 'Quantity', array('role'=>'style'));

		if (isset($arr)) {
			foreach ($arr as $row) {
				$data[] = array($row['Status']." (".intval($row['Total']).")", intval($row['Total']), 'stroke-color: #0050FF; stroke-opacity: 0.6; stroke-width: 2; fill-color: #76A7FA; fill-opacity: 0.2');
			}
		}


		/*
			Status Errors
		*/
		//$arr = $modelApplicantStatus->StatusErrors;


?>

		<script type="text/javascript" src="https://www.google.com/jsapi"></script>

		<script type="text/javascript">

			google.load("visualization", "1", {packages:["corechart"]});

			google.setOnLoadCallback(drawChart);

			function drawChart(data) {
				
				//var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
				var chart = new google.visualization.PieChart(document.getElementById('chart_div'));

				var data = google.visualization.arrayToDataTable(<?php echo json_encode($data); ?>);

				var options = {
					width:700,
					colorAxis: {colors: ['yellow', 'red']},
					title: "",
					legend: 'right',
					is3D: true,
				};

				chart.draw(data, options);
			}

		</script>

		<h3>Current Status Totals</h3>
		<div id="chart_div" style="width: 700px; height: 600px;"></div>


		<div id="status-errors" style="width: 700px; height: 600px;">
		<h3>Applicants that have Status History errors</h3>
			<?php

				$this->widget('bootstrap.widgets.TbGridView',array(
					'id'=>'status-errors-grid',
					'type' => TbHtml::GRID_TYPE_CONDENSED,
					'dataProvider'=>$modelApplicantStatus->StatusErrors,
					//'filter'=>$model,
					'columns'=>array(
						//'ApplicantID',
						array(
							'name'=>'Fullname',
							'type'=>'raw',
							'value' => 'CHtml::link(CHtml::encode($data["Fullname"]), array("applicant/update","id"=>$data["ApplicantID"]))',
						),
						//'Fullname',
						//'Total',
					),
				)); 


			?>

		</div>

<?php

	}

?>


