<?php

class MeetingController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('admin','create','update','editable'),
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


	public function actionEditable() {
		
		if (isset($_POST['pk'])) {
			
			$id = $_POST['pk'];

			$model = new Meeting;

			$model=$this->loadModel($id);

	        if ($_POST['name']=='Title')
	        	$model->Title = $_POST['value'];
	        
	        $model->update();
		}
		
		return true;
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->layout = 'column1';
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Meeting;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Meeting'])) {
			$model->attributes=$_POST['Meeting'];
			if ($model->save()) {
				/*
					save the meeting members MANY_MANY relationship
				*/
				foreach ($_POST['Meeting']['meetingMembers'] as $memberId) {
	                $meetingMember = new MeetingMember;
	                $meetingMember->meetingID = $model->ID;
	                $meetingMember->memberID = $memberId;
	                if (!$meetingMember->save()) print_r($meetingMember->errors);
	            }
				//$this->redirect(array('view','id'=>$model->ID));
				$this->redirect(array('admin'));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Meeting'])) {
			$model->attributes=$_POST['Meeting'];
			if ($model->save()) {
				/*
					remove all related MANY-MANY relationships
				*/
			    $criteria=new CDbCriteria;
			    $criteria->condition='meetingID=:meetingID';
			    $criteria->params=array(':meetingID'=>$model->ID);
			    MeetingMember::model()->deleteAll($criteria);

			    /*
			    	save the meeting members MANY_MANY relationship
			    */
				foreach ($_POST['Meeting']['meetingMembers'] as $memberId) {
	                $meetingMember = new MeetingMember;
	                $meetingMember->meetingID = $model->ID;
	                $meetingMember->memberID = $memberId;
	                if (!$meetingMember->save()) print_r($meetingMember->errors);
	            }

				//$this->redirect(array('view','id'=>$model->ID));
				$this->redirect(array('admin'));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if (Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax'])) {
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
			}
		} else {
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Meeting');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Meeting('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Meeting'])) {
			$model->attributes=$_GET['Meeting'];
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Meeting the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Meeting::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}

		/*
			the following part added for the MANY-MANY relationship
		*/
		/*
		$criteria=new CDbCriteria;
		$criteria->condition='meetingID=:meetingID';
		$criteria->select = 'meetingID';
		$criteria->params=array(':meetingID'=>$_GET['id']);
		$meetingMembers = MeetingMember::model()->findAll($criteria);		

		$members = array();
		foreach ($meetingMembers as $member) {
		    $members[] = $member->memberID;
		}

		$model->meetingMembers = $members;
		*/

		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Meeting $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='meeting-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}