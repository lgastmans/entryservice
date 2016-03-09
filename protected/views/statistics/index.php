<?php
/* @var $this StatisticsController */

$this->breadcrumbs=array(
	'Statistics',
);
?>


<?php
	$criteria=new CDbCriteria;
	$criteria->select='ID, Description';
	$criteria->order='Description ASC';
	//$criteria->condition='((CompletedOn IS NULL) OR (YEAR(CompletedOn) = 0))';
	//$criteria->params=array(':applicantID'=>$applicant_id);
	$data = Status::model()->findAll($criteria);
	$statuses = array();
	if ($data) {
		foreach ($data as $item) {
			$statuses[$item->ID] = $item->Description;
		}
	}

	echo TbHtml::dropDownList('inputStatus', '', $statuses);

	echo TbHtml::textField('inputYear', date('Y'), array('placeholder' => 'Year', 'size' => TbHtml::INPUT_SIZE_SMALL));

	echo TbHtml::dropDownList('inputChart', '', array('B'=>'BarChart','P'=>'PieChart'));

	echo "&nbsp;";

	echo TbHtml::ajaxButton(
        'Refresh',
        array('statistics/processData'),
        array(
	        'dataType'=>'json',
	        'type'=>'post',
			'url' => CController::createUrl('statistics/processData'),
			'data' => 'js:{"status": $("#inputStatus").val(), "year": $("#inputYear").val() }',
			'success'=>"js:function(data){
				console.log('data: '+data);
				if (data.length>1) {
					if ($('#inputChart').val()=='B')
		        		var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
		        	else
		        		var chart = new google.visualization.PieChart(document.getElementById('chart_div'));

		        	var data = google.visualization.arrayToDataTable(data);

					var options = {
						title: '',
						legend: 'left',
						is3D: true,
					};

		        	chart.draw(data, options);
		        }
		        else {
		        	$('#chart_div').html('no data');
		        }

			}",
        ),
        array(
	        'id'=>'someID',
	        'color'=>TbHtml::BUTTON_COLOR_DEFAULT,
	        'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
        )
    );

	/*
		Nationalities
	*/
	$sql= "
		SELECT n.Nationality, COUNT( a.ID ) AS total
		FROM (applicant a, nationality n)
		LEFT JOIN applicant_status apps ON (apps.ApplicantID = a.ID) 
		WHERE (a.NationalityID = n.ID) AND ((YEAR(apps.StartedOn)=".date('Y').") AND (apps.StatusID=".key($statuses)."))
		GROUP BY a.NationalityID
		ORDER BY n.Nationality";
	$sql= "
SELECT n.Nationality, COUNT( a.ID ) AS total
		FROM (applicant a, nationality n)
		LEFT JOIN applicant_status apps ON (apps.ApplicantID = a.ID) 
		WHERE (a.NationalityID = n.ID) AND ((YEAR(apps.StartedOn)=2013) AND (apps.StatusID=7))
		GROUP BY a.NationalityID
		ORDER BY n.Nationality";

	$connection=Yii::app()->db;
	$command=$connection->createCommand($sql);
	$dataReader=$command->query();

	$data = array();
	$data[] = array('Nationality', 'Quantity', array('role'=>'style'));


	while(($row=$dataReader->read())!==false) {
		$data[] = array($row['Nationality']." (".$row['total'].")", intval($row['total']), 'stroke-color: #0050FF; stroke-opacity: 0.6; stroke-width: 2; fill-color: #76A7FA; fill-opacity: 0.2');
	}

?>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<script type="text/javascript">

	google.load("visualization", "1", {packages:["corechart"]});

	google.setOnLoadCallback(drawChart);

	function drawChart(data) {
		//if (typeof data !== 'undefined' && data !== null)
		//if (data.length>1) {
			var chart = new google.visualization.BarChart(document.getElementById('chart_div'));

			var data = google.visualization.arrayToDataTable(<?php echo json_encode($data); ?>);

			var options = {
				colorAxis: {colors: ['yellow', 'red']},
				title: "",
				legend: 'left',
				is3D: true,
			};

			chart.draw(data, options);
		//}
		//else {
		//	$('#chart_div').html('no data');
		//}
	}

</script>

<div id="chart_div" style="width: 900px; height: 500px;"></div>