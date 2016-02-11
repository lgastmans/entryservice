<?php
/* @var $this StatisticsController */

$this->breadcrumbs=array(
	'Statistics',
);


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
				//var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
      			//chart.draw(datachart,options);

				//var table = $('#myChart');   
				//console.log(table);
				//table.draw();
				
				$('#chart1').update;

				
			}",
        ),
        array(
	        'id'=>'someID',
	        'color'=>TbHtml::BUTTON_COLOR_DEFAULT,
	        'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
        )
    );

	//$tmp = $this->processData();
	//$data = json_decode($tmp);

	/*
		Nationalities
	*/
	$sql= "
		SELECT n.Nationality, COUNT( a.ID ) AS total
		FROM (applicant a, nationality n)
		LEFT JOIN applicant_status apps ON (apps.ApplicantID = a.ID) 
		WHERE (a.NationalityID = n.ID) AND ((YEAR(apps.StartedOn)=2014) AND (apps.StatusID=3))
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

<div id='chart1'>
<?php
    $this->widget('yiiwheels.widgets.google.WhVisualizationChart', 
    	array(
    		'id' => 'myChart',
    		'visualization' => 'BarChart',
    		'data' => $data,
            'options' => array(
            	'title' => 'Nationalities that started their Newcomer period this year',
				'legend' => 'left',
				'is3D' => true,
				'width'=> 600,
				'height'=> 600,
            ),
            'htmlOptions' => array(
            	'id' => 'chart1',
            )
        )
    );

?>
</div>