<?php

class StatisticsController extends Controller
{

	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array(), //array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','index','view','processData'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete'),
				'users'=>Yii::app()->getModule('user')->getAdmins(), //array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionProcessData() {
		$year = date('Y');
		if (isset($_POST['year']))
			$year = $_POST['year'];

		$status = 0;
		if (isset($_POST['status']))
			$status = $_POST['status'];

		$sql= "
			SELECT n.Nationality, COUNT( a.ID ) AS total
			FROM (applicant a, nationality n)
			LEFT JOIN applicant_status apps ON (apps.ApplicantID = a.ID) 
			WHERE (a.NationalityID = n.ID) AND ((YEAR(apps.StartedOn)=".$year.") AND (apps.StatusID=".$status."))
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

		echo json_encode($data);
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}