<?php

class ListsController extends Controller
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
		
		$data = array();

		if (isset($_POST['data'])) {
			$vals = json_decode($_POST['data']);

			Yii::app()->session['lists_filter'] = $vals[0];
			Yii::app()->session['lists_applicantStatus'] = $vals[1];
			Yii::app()->session['lists_dateFrom'] = $vals[2];
			Yii::app()->session['lists_dateTo'] = $vals[3];
			Yii::app()->session['lists_milestoneStatus'] = $vals[4];

			$milestones = $vals[5];
			Yii::app()->session['lists_milestones'] = $vals[5];
		}

		echo json_encode("done");
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