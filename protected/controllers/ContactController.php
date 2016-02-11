<?php

class ContactController extends Controller
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
				'actions'=>array('admin','delete','editable','editContact','addContact','addnew'),
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

			$model = new Contact;

			$model=$this->loadModel($id);

	        if ($_POST['name']=='Category')
	        	$model->Category = $_POST['value'];
	        elseif ($_POST['name']=='Relationship')
	        	$model->Relationship = $_POST['value'];
	        elseif ($_POST['name']=='Name')
	        	$model->Name = $_POST['value'];
	        elseif ($_POST['name']=='Surname')
	        	$model->Surname = $_POST['value'];
	        elseif ($_POST['name']=='Email')
	        	$model->Email = $_POST['value'];
	        elseif ($_POST['name']=='Phone')
	        	$model->Phone = $_POST['value'];

	        $model->update();
		}

		return true;
	}

	public function actionEditContact($id,$asDialog,$category)
	{
	    $model=$this->loadModel($id);

	    // Uncomment the following line if AJAX validation is needed
	    // $this->performAjaxValidation($model);

	    if(isset($_POST['Contact']))
	    {
	        $model->attributes=$_POST['Contact'];
	        if($model->save())
	            if (!empty($_GET['asDialog']))
	            {
	                //Close the dialog, reset the iframe and update the grid
									if ($category=='contact_person')
										echo CHtml::script("window.parent.$('#contact-cru-dialog').dialog('close');window.parent.$('#contact-cru-frame').attr('src','');window.parent.$.fn.yiiGridView.update('{$_GET['gridId']}');");
									else
										echo CHtml::script("window.parent.$('#emergency-cru-dialog').dialog('close');window.parent.$('#emergency-cru-frame').attr('src','');window.parent.$.fn.yiiGridView.update('{$_GET['gridId']}');");
	                Yii::app()->end();
	            }
	            else
		            $this->redirect(array('view','id'=>$model->ID));
	    }

	    if (!empty($_GET['asDialog']))
	        $this->layout = '//layouts/iframe';

	    $this->render('update',array(
	        'model'=>$model,
	    ));
	}

	public function actionAddContact($asDialog,$category)
	{
		$model=new Contact;

		if(isset($_POST['Contact']))
		{
			$model->attributes=$_POST['Contact'];

			if($model->save())
				if (!empty($_GET['asDialog']))
				{
					//Close the dialog, reset the iframe and update the grid
					if ($category=='contact_person')
						echo CHtml::script("window.parent.$('#contact-cru-dialog').dialog('close');window.parent.$('#contact-cru-frame').attr('src','');window.parent.$.fn.yiiGridView.update('{$_GET['gridId']}');");
					else
						echo CHtml::script("window.parent.$('#emergency-cru-dialog').dialog('close');window.parent.$('#emergency-cru-frame').attr('src','');window.parent.$.fn.yiiGridView.update('{$_GET['gridId']}');");
					Yii::app()->end();
				}
		}

		if (!empty($_GET['asDialog']))
			$this->layout = '//layouts/iframe';

		$this->render('create',array(
			'model'=>$model, 'category'=>$category,
		));
	}

	public function actionAddnew() {

        $model=new Contact;

        // Ajax Validation enabled
        $this->performAjaxValidation($model);

        // Flag to know if we will render the form
        // or try to add new
		$flag=true;

        if(isset($_POST['Contact']))
        {
            $flag=false;
            $model->attributes=$_POST['Contact'];

            if($model->save()) {
				//print_r($model->attributes);
				echo "Applicant contact saved";
            }
        }

        if($flag) {
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
            $this->renderPartial('createContactDialog', array('model'=>$model,), false, true);

            Yii::app()->end();
        }
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
		$model=new Contact;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Contact'])) {
			$model->attributes=$_POST['Contact'];
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

		if (isset($_POST['Contact'])) {
			$model->attributes=$_POST['Contact'];
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
		$dataProvider=new CActiveDataProvider('Contact');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Contact('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Contact'])) {
			$model->attributes=$_GET['Contact'];
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Contact the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Contact::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Contact $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='contact-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
