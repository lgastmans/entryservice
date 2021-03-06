<?php

class ApplicantStatusController extends Controller
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
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','editable','addnew','editStatus','currentStatus','statusInformation'),
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

			$model = new ApplicantStatus;

			$model=$this->loadModel($id);

	        if ($_POST['name']=='StatusID')
	        	$model->StatusID = $_POST['value'];
	        elseif ($_POST['name']=='StartedOn')
	        	$model->StartedOn = $_POST['value'];
	        elseif ($_POST['name']=='CompletedOn')
	        	$model->CompletedOn = $_POST['value'];
	        elseif ($_POST['name']=='NewsAndNotes')
	        	$model->NewsAndNotes = $_POST['value'];

	        $model->update();
		}

		return true;
	}

	public function actionCurrentStatus($ApplicantID) {
		$data = array();

		if (isset($ApplicantID)) {
			$data = ApplicantStatus::model()->statusInformation($ApplicantID);
		}
		
		echo json_encode($data);
	}

	public function actionStatusInformation($applicant_id, $status_id=NULL) {
		$data = ApplicantStatus::model()->statusInformation($applicant_id, $status_id);

		echo json_encode($data); //"status information";
	}

	public function actionEditStatus($applicant_id,$asDialog)
	{
	    $model=$this->loadModel($applicant_id);

	    // Uncomment the following line if AJAX validation is needed
	    // $this->performAjaxValidation($model);

	    if(isset($_POST['ApplicantStatus']))
	    {

	        $model->attributes=$_POST['ApplicantStatus'];

			$sql= "
				UPDATE applicant_status
				SET IsCurrent = 0
				WHERE (ApplicantID = ".$model->ApplicantID.")";

			$connection=Yii::app()->db;
			$command=$connection->createCommand($sql)->execute();	        

	        if($model->save())
	            if (!empty($_GET['asDialog']))
	            {
	                //Close the dialog, reset the iframe and update the grid
	                echo CHtml::script("window.parent.$('#status-cru-dialog').dialog('close');window.parent.$('#status-cru-frame').attr('src','');window.parent.$.fn.yiiGridView.update('{$_GET['gridId']}');window.parent.updateStatus(".$model->ApplicantID.");");
	                Yii::app()->end();
	            }
	            else
		            $this->redirect(array('view','_id'=>$model->ID));
	    }

	    if (!empty($_GET['asDialog']))
	        $this->layout = '//layouts/iframe';

	    $this->render('update',array(
	        'model'=>$model,
	    ));
	}

	public function actionAddnew() {

		$model=new ApplicantStatus;

		if(isset($_POST['ApplicantStatus']))
		{
			$model->attributes=$_POST['ApplicantStatus'];

			if ($model->IsCurrent==1) {
				$sql= "
					UPDATE applicant_status
					SET IsCurrent = 0
					WHERE (ApplicantID = ".$model->ApplicantID.")";

				$connection=Yii::app()->db;
				$command=$connection->createCommand($sql)->execute();
			}

			if($model->save())
				if (!empty($_GET['asDialog']))
				{
					//Close the dialog, reset the iframe and update the grid
					echo CHtml::script("window.parent.$('#status-cru-dialog').dialog('close');window.parent.$('#status-cru-frame').attr('src','');window.parent.$.fn.yiiGridView.update('{$_GET['gridId']}');window.parent.updateStatus(".$model->ApplicantID.");");
					Yii::app()->end();
				}
		}
		
		if (!empty($_GET['asDialog']))
			$this->layout = '//layouts/iframe';

		$this->render('create',array(
			'model'=>$model,
		));
    }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
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
		$model=new ApplicantStatus;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['ApplicantStatus'])) {
			$model->attributes=$_POST['ApplicantStatus'];
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->ID));
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

		if (isset($_POST['ApplicantStatus'])) {
			$model->attributes=$_POST['ApplicantStatus'];
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->ID));
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
		$dataProvider=new CActiveDataProvider('ApplicantStatus');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ApplicantStatus('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['ApplicantStatus'])) {
			$model->attributes=$_GET['ApplicantStatus'];
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ApplicantStatus the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ApplicantStatus::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ApplicantStatus $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='applicant-status-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
