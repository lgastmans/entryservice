<?php

class InterviewController extends Controller
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
				'actions'=>array('admin','delete','addInterview','viewInterview','editInterview'),
				'users'=>Yii::app()->getModule('user')->getAdmins(), //array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionViewInterview($id,$asDialog) {

	 	if (Yii::app()->request->isAjaxRequest)
	    {
	        //outputProcessing = true because including css-files ...
	        $this->renderPartial('view', array('model'=>$this->loadModel($id),),false,true);

	        //js-code to open the dialog    
	        if (!empty($_GET['asDialog']))
	            echo CHtml::script('$("#dlg-interview-view").dialog("open")');
	        Yii::app()->end();
	    }
	    else
	        $this->render('view', array(
	           'model'=>$this->loadModel($id),
	         ));
    }

	public function actionEditInterview($applicant_id) {

        $model=$this->loadModel($applicant_id);
        
        // Ajax Validation enabled
        //$this->performAjaxValidation($model);

        // Flag to know if we will render the form 
        // or try to add new 
		$flag=true;

        if(isset($_POST['Interview']))
        {
        	$flag=false;
            $model->attributes=$_POST['Interview'];

            if ($model->save()) {
                //Close the dialog, reset the iframe and update the grid
                echo CHtml::script("window.parent.$('#interview-dialog').dialog('close');window.parent.$('#interview-frame').attr('src','');window.parent.$.fn.yiiGridView.update('{$_GET['gridId']}');");
                Yii::app()->end();
            }
            else {
            	print_r($model->getErrors());
            }
        }

	    if (!empty($_GET['asDialog']))
	        $this->layout = '//layouts/iframe';
	 
	    $this->render('create',array(
	        'model'=>$model,
	    ));
    }

	public function actionAddInterview() {

        $model=new Interview;
        
        // Ajax Validation enabled
        //$this->performAjaxValidation($model);

        // Flag to know if we will render the form 
        // or try to add new 
		$flag=true;

        if(isset($_POST['Interview']))
        {
        	$flag=false;
            $model->attributes=$_POST['Interview'];

            if ($model->save()) {
                //Close the dialog, reset the iframe and update the grid
                echo CHtml::script("window.parent.$('#interview-dialog').dialog('close');window.parent.$('#interview-frame').attr('src','');window.parent.$.fn.yiiGridView.update('{$_GET['gridId']}');");
                Yii::app()->end();
            }
            else {
            	echo "OOPS";
            	print_r($model->getErrors());
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
		$model=new Interview;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Interview'])) {
			$model->attributes=$_POST['Interview'];
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->ApplicantID));
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

		if (isset($_POST['Interview'])) {
			$model->attributes=$_POST['Interview'];
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->ApplicantID));
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
		$dataProvider=new CActiveDataProvider('Interview');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Interview('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Interview'])) {
			$model->attributes=$_GET['Interview'];
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Interview the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Interview::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Interview $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='interview-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}