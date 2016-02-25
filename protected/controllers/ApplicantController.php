<?php

class ApplicantController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

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
/*
	public function actions()
	{
	  return array(
	    'view' => 'application.actions.CreateAction',
	  );
	}

	public function setFlash( $key, $value, $defaultValue = null )
	{
	  Yii::app()->user->setFlash( $key, $value, $defaultValue );
	}
*/
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
				'actions'=>array('create','update','admin','editable','import',
					'addPassport', 'deletePassport', 'updatePassport',
					'addVisa', 'deleteVisa', 'updateVisa',
					'addIndian', 'deleteIndian', 'updateIndian',
					'viewApplicant','archiveApplicant',),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete',
				),
				'users'=>Yii::app()->getModule('user')->getAdmins(), //array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionArchiveApplicant($id){

		$model=$this->loadModel($id);

		if ($model) {

			$model->IsArchived=!$model->IsArchived;
			if ($model->save())
				echo "saved";
			/*
			if ($model->save()) {
				$this->redirect(array('admin'));
			}
			*/
		}

		return false;
	}

	public function actionViewApplicant($id,$asDialog) {

		if (Yii::app()->request->isAjaxRequest)
	    {
	        //outputProcessing = true because including css-files ...
	        $this->renderPartial('view', array('model'=>$this->loadModel($id),),false,true);

	        //js-code to open the dialog
	        if (!empty($_GET['asDialog']))
	            echo CHtml::script('$("#dlg-applicant-view").dialog("open")');
	        Yii::app()->end();
	    }
	    else
	        $this->render('view', array(
	           'model'=>$this->loadModel($id),
	         ));
  }

	public function actionEditable() {

		if (isset($_POST['pk'])) {

			$id = $_POST['pk'];

			//$model = new Member;

			$model=$this->loadModel($id);

			//Name
	        if ($_POST['name']=='Name')
	        	$model->Name = $_POST['value'];
	        //Surname
	        elseif ($_POST['name']=='Surname')
	        	$model->Surname = $_POST['value'];
	        //BirthDate
	        elseif ($_POST['name']=='BirthDate')
	        	$model->BirthDate = $_POST['value'];
	        //Sex
	        elseif ($_POST['name']=='Sex')
	        	$model->Sex = $_POST['value'];
	        //MaritalStatus
	        elseif ($_POST['name']=='MaritalStatus')
	        	$model->MaritalStatus = $_POST['value'];
	        //ResServiceNum
	        elseif ($_POST['name']=='ResServiceNum')
	        	$model->ResServiceNum = $_POST['value'];
	        //NationalityID
	        elseif ($_POST['name']=='NationalityID')
	        	$model->NationalityID = $_POST['value'];

	        $model->update();
		}

		return true;
	}

	public function actionAddPassport($applicant_id) {

        $model = new Passport;

        // Ajax Validation enabled
        $this->performAjaxValidation($model);

        // Flag to know if we will render the form
        // or try to add new
		$flag=true;
		$id=0;
        if(isset($_POST['Passport']))
        {
            $flag=false;
            $model->attributes=$_POST['Passport'];

            if($model->save()) {
				$id = $model->ID;

				$applicant=Applicant::model()->FindByPk($applicant_id);
				$applicant->PassportID = $id;
				$applicant->save();

				$arr['view'] = $this->renderPartial("_formPassportUpdate", array('model' => $model),true,false);
				$arr['id'] = $id;

		        echo json_encode($arr);
            }
        }

        if($flag) {
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
            $this->renderPartial('createPassportDialog', array('model'=>$model),false,true);

            Yii::app()->end();
        }

    }

    public function actionUpdatePassport($id) {
    	$model = Passport::model()->findByPk($id);

		$flag=true;

        if(isset($_POST['Passport']))
        {
            $flag=false;
            $model->attributes=$_POST['Passport'];

            if($model->save()) {
				$arr['view'] = $this->renderPartial("_formPassportUpdate", array('model' => $model),true,false);
				$arr['id'] = $id;

		        echo json_encode($arr);
            }
        }

        if($flag) {
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
            $this->renderPartial('createPassportDialog', array('model'=>$model,'id'=>$id),false,true);
        }
    }

    public function actionDeletePassport($id) {
    	$passport = Passport::model()->findByPk($id);

		if ($passport) {
    		$passport->delete();
    		echo "Passport details deleted successfully.";
    	}
    	else
    		echo "not found";
    }

	public function actionAddVisa($applicant_id) {

        $model = new Visa;

        // Ajax Validation enabled
        $this->performAjaxValidation($model);

        // Flag to know if we will render the form
        // or try to add new
		$flag=true;
		$id=0;
        if(isset($_POST['Visa']))
        {
            $flag=false;
            $model->attributes=$_POST['Visa'];

            if($model->save()) {
				$id = $model->ID;

				$applicant=Applicant::model()->FindByPk($applicant_id);
				$applicant->VisaID = $id;
				$applicant->save();

				$arr['view'] = $this->renderPartial("_formVisaUpdate", array('model' => $model),true,false);
				$arr['id'] = $id;

		        echo json_encode($arr);
            }
        }

        if($flag) {
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
            $this->renderPartial('createVisaDialog', array('model'=>$model),false,true);

            Yii::app()->end();
        }

    }

    public function actionUpdateVisa($id) {
    	$model = Visa::model()->findByPk($id);

		$flag=true;

        if(isset($_POST['Visa']))
        {
            $flag=false;
            $model->attributes=$_POST['Visa'];

            if($model->save()) {
				$arr['view'] = $this->renderPartial("_formVisaUpdate", array('model' => $model),true,false);
				$arr['id'] = $id;

		        echo json_encode($arr);
            }
        }

        if($flag) {
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
            $this->renderPartial('createVisaDialog', array('model'=>$model,'id'=>$id),false,true);
        }
    }

    public function actionDeleteVisa($id) {
    	$visa = Visa::model()->findByPk($id);

		if ($visa) {
    		$visa->delete();
    		echo "Visa details deleted successfully.";
    	}
    	else
    		echo "not found";
    }

	public function actionAddIndian($applicant_id) {

        $model = new IndianID;

        // Ajax Validation enabled
        $this->performAjaxValidation($model);

        // Flag to know if we will render the form
        // or try to add new
		$flag=true;
		$id=0;
        if(isset($_POST['IndianID']))
        {
            $flag=false;
            $model->attributes=$_POST['IndianID'];

            if($model->save()) {
				$id = $model->ID;

				$applicant=Applicant::model()->FindByPk($applicant_id);
				$applicant->IndiaID = $id;
				$applicant->save();

				$arr['view'] = $this->renderPartial("_formIndianUpdate", array('model' => $model),true,false);
				$arr['id'] = $id;

		        echo json_encode($arr);
            }
        }

        if($flag) {
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
            $this->renderPartial('createIndianDialog', array('model'=>$model),false,true);

            Yii::app()->end();
        }

    }

    public function actionUpdateIndian($id) {
    	$model = IndianID::model()->findByPk($id);

		$flag=true;

        if(isset($_POST['IndianID']))
        {
            $flag=false;
            $model->attributes=$_POST['IndianID'];

            if($model->save()) {
				$arr['view'] = $this->renderPartial("_formIndianUpdate", array('model' => $model),true,false);
				$arr['id'] = $id;

		        echo json_encode($arr);
            }
        }

        if($flag) {
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
            $this->renderPartial('createIndianDialog', array('model'=>$model,'id'=>$id),false,true);
        }
    }

    public function actionDeleteIndian($id) {
    	$indian = IndianID::model()->findByPk($id);

		if ($indian) {
    		$indian->delete();
    		echo "Indian ID details deleted successfully.";
    	}
    	else
    		echo "not found";
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
		$model=new Applicant;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Applicant'])) {

			$model->attributes=$_POST['Applicant'];

			//$model->Password = sha1($model->Password);

			if ($model->save()) {
				//$this->redirect(array('view','id'=>$model->ID));

				/*
					add default milestones
				*/
				$this->insertDefaultMilestones($model->ID);

				$this->redirect(array('update','id'=>$model->ID));
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

		$modelAddress = new Address;
		$modelChildren = new Children;
		$modelContact = new Contact;
		$modelEmail = new ApplicantEmail;
		$modelPhone = new ApplicantPhone;
		$modelStatus = new ApplicantStatus;
		$modelExtension = new Extension;
		$modelAbsence = new Absence;
		$modelWork = new Work;
		$modelStatistics = new ApplicantStatistics;
		$modelMilestones = new ApplicantMilestones;
		$modelInterview = new Interview;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Applicant'])) {

			$model->attributes=$_POST['Applicant'];
			
			if (array_key_exists("delimg",$_POST['Applicant'])) {
				@unlink(getcwd()."/images/applicants/".$model->Photo);
				$model->Photo='';
			}
			else {
				$photo = CUploadedFile::getInstance($model,'Photo');

				if (isset($photo)) {
					$model->Photo = $photo->name;
				}
			}


			if ($model->save()) {
				if (isset($photo))
					$photo->saveAs(Yii::getPathOfAlias('webroot').'/images/applicants/'.$photo->name);
				//$this->redirect(array('view','id'=>$model->ID));
				$this->redirect(array('admin'));
			}
		}

		$this->render('update',array(
			'model'=>$model,
			'modelAddress'=>$modelAddress,
			'modelChildren'=>$modelChildren,
			'modelContact'=>$modelContact,
			'modelEmail'=>$modelEmail,
			'modelPhone'=>$modelPhone,
			'modelStatus'=>$modelStatus,
			'modelExtension'=>$modelExtension,
			'modelAbsence'=>$modelAbsence,
			'modelWork'=>$modelWork,
			'modelStatistics'=>$modelStatistics,
			'modelMilestones'=>$modelMilestones,
			'modelInterview'=>$modelInterview,
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
		$dataProvider=new CActiveDataProvider('Applicant');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function insertDefaultMilestones($applicantID) {

		$res = array();

		$today = new DateTime();

		$modelMilestone = Milestone::model()->FindAll('IsDefault=?',array(true));

		foreach ($modelMilestone as $row) {

			$modelApplicantMilestone = new ApplicantMilestones;

			$modelApplicantMilestone->ApplicantID = $applicantID;
			$modelApplicantMilestone->MilestoneCategoryID = $row->MilestoneCategoryID;
			$modelApplicantMilestone->Status = 'Pending';
			$modelApplicantMilestone->DateCreated = $today->format('Y-m-d');
			$modelApplicantMilestone->DateStarted = NULL;
			$modelApplicantMilestone->DateCompleted = NULL;
			$modelApplicantMilestone->Description = $row->Description;
			$modelApplicantMilestone->Remarks = '';
			$modelApplicantMilestone->TimelineInterval = $row->TimelineInterval;
			$modelApplicantMilestone->TimelinePeriod = $row->TimelinePeriod;
			$modelApplicantMilestone->Alert = $row->Alert;
			$modelApplicantMilestone->AlertInterval = $row->AlertInterval;
			$modelApplicantMilestone->AlertPeriod = $row->AlertPeriod;
			$modelApplicantMilestone->RepeatAlert = $row->RepeatAlert;
			$modelApplicantMilestone->IsAlerted = 0;
			$modelApplicantMilestone->SendEmail = ($row->SendEmail) ? 'Y' : 'N';
			$modelApplicantMilestone->EmailText = $row->EmailText;
			$modelApplicantMilestone->IsActive = 'Y';

			if (!($modelApplicantMilestone->Save()))
				$res[] = $modelApplicantMilestone->getErrors();
		}

		return $res;
	}


	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Applicant('search');
		
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Applicant'])) {
		 	//$model->attributes=$_GET['Applicant'];
		 	$_SESSION['adminFilterData']=$_GET['Applicant'];
		}

		$this->render('admin',array(
			//$this->layout = 'applicant',
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Applicant the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Applicant::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Applicant $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='applicant-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}


	public function actionImport() {

		$model=new Applicant;

		$result = array();

		if (isset($_POST['Applicant']['fileField'])) {

			$handle = fopen($_FILES['Applicant']['tmp_name']['fileField'], 'r');

			$count=0;
			$total=0;
			while (!(feof($handle))) {

				$row = fgetcsv($handle,1000,"\t");
				//print_r($row);die();

				$total++;

				if (empty($row[2])) {

					continue;
				}

				$modelApplicant = Applicant::model()->find('Name = :name AND Surname = :surname', array('name'=>$row[2],'surname'=>$row[3]));
				if (isset($modelApplicant)) {
					$result['skipped'][] = $modelApplicant->Name." ".$modelApplicant->Surname;
					continue;
				}

				$DOB = DateTime::createFromFormat('d/m/Y', $row[4]);
				if ($DOB===FALSE)
					$DOB = new DateTime();
				$DOB = $DOB->format('Y-m-d');

				$maritalStatus = 'Single';
				if (($row[10]!='') && ($row[10]='C'))
					$maritalStatus = 'Married';

				$NatID=105;
				$modelNationality=Nationality::model()->find('Nationality LIKE :nat', array('nat'=>$row[7]."%"));
				if (isset($modelNationality))
					$NatID = $modelNationality->ID;

				$modelApplicant = new Applicant;
				$modelApplicant->Name = $row[2];
				$modelApplicant->Surname = $row[3];
				$modelApplicant->BirthPlace = '';
				$modelApplicant->BirthDate = $DOB;
				$modelApplicant->Photo = '';
				$modelApplicant->Sex = $row[6];
				$modelApplicant->MaritalStatus = $maritalStatus;
				$modelApplicant->ResServiceNum = intval($row[1]);
				$modelApplicant->Notes = $row[24];
				$modelApplicant->NationalityID = $NatID;
				$modelApplicant->Spouse = $row[11];

				if ($modelApplicant->save()) {
					$result['inserted'] = $count++;

					/*
						DEFAULT MILESTONES
					*/
					$this->insertDefaultMilestones($modelApplicant->ID);

					/*
						EMAIL
					*/
					if (!empty($row[14])) {
						$modelEmail = new ApplicantEmail;
						$modelEmail->ApplicantID = $modelApplicant->ID;
						$modelEmail->Email = $row[14];
						$modelEmail->IsPrimary = 'Y';
						if (!($modelEmail->Save()))
							$result['errors']['email'] = $modelEmail->getErrors();
					}

					/*
						CELL
					*/
					if (!empty($row[15])) {
						$modelPhone = new ApplicantPhone;
						$modelPhone->ApplicantID = $modelApplicant->ID;
						$modelPhone->ContactType = 'Cell';
						$modelPhone->Number = $row[15];
						$modelPhone->IsPrimary = 'Y';
						if (!($modelPhone->Save()))
							$result['errors']['phone-cell'] = $modelPhone->getErrors();
					}

					/*
						LANDLINE
					*/
					if (!empty($row[16])) {
						$modelPhone = new ApplicantPhone;
						$modelPhone->ApplicantID = $modelApplicant->ID;
						$modelPhone->ContactType = 'Home';
						$modelPhone->Number = $row[16];
						$modelPhone->IsPrimary = 'N';
						if (!($modelPhone->Save()))
							$result['errors']['phone-landline'] = $modelPhone->getErrors();
					}

					/*
						ADDRESS
					*/
					if (!empty($row[17])) {
						$today = new DateTime();

						$addressStatus = 'House-sitting';
						if (!empty($row[18])) {
							if (strtolower($row[18])=='living with steward')
								$addressStatus = 'Living with Steward';
							elseif (strtolower($row[18])=='steward')
								$addressStatus = 'Steward';
							elseif (strtolower($row[18])=='house-sitting')
								$addressStatus = 'House-sitting';
							elseif (strtolower($row[18])=='guest house -renting')
								$addressStatus = 'Guest House';
							elseif (strtolower($row[18])=='nc acc.')
								$addressStatus = 'NC Accomodation';
							elseif (strtolower($row[18])=='staff acc. ')
								$addressStatus = 'Staff Accomodation';
						}

						$modelCommunity = Community::model()->find('Name LIKE :name', array('name'=>$row[17]));
						if (isset($modelCommunity)) {

							$modelAddress = new Address;
							$modelAddress->ApplicantID = $modelApplicant->ID;
							$modelAddress->CommunityID = $modelCommunity->ID;
							$modelAddress->FromDate = $today->format('Y-m-d');
							$modelAddress->ToDate = $today->format('Y-m-d');
							$modelAddress->Status = $addressStatus;
							if (!($modelAddress->Save()))
								$result['errors']['address'] = $modelAddress->getErrors();
						}
					}

					/*
						WORK
					*/
					if (!empty($row[19])) {
						$today = new DateTime();

						$modelWork = new Work;
						$modelWork->ApplicantID = $modelApplicant->ID;
						$modelWork->Place = $row[19];
						$modelWork->FromDate = $today->format('Y-m-d');
						$modelWork->ToDate = $today->format('Y-m-d');
						$modelWork->Notes = '';
						if (!($modelWork->Save()))
							$result['errors']['work'] = $modelWork->getErrors();
					}

					/*
						STATUS
					*/
					if (!empty($row[0])) {
						$dtStartedOn = DateTime::createFromFormat('d/m/Y', $row[21]);
						if ($dtStartedOn===FALSE)
							$dtStartedOn = new DateTime();
						$dtStartedOn = $dtStartedOn->format('Y-m-d');

						$statusID = 2; // Pre-Newcomer
						if ($row[0]=='Ann. AV')
							$statusID = 7;
						elseif ($row[0]=='AV')
							$statusID = 6;
						elseif ($row[0]=='LEFT AV')
							$statusID = 9;
						elseif ($row[0]=='NC')
							$statusID = 3;
						elseif ($row[0]=='RAV')
							$statusID = 8;

						$status = Status::model()->FindByPk($statusID);

						$modelStatus = new ApplicantStatus;
						$modelStatus->ApplicantID = $modelApplicant->ID;
						$modelStatus->StatusID = $statusID;
						$modelStatus->StartedOn = $dtStartedOn;
						$modelStatus->CompletedOn = NULL;
						$modelStatus->Duration = $status->Duration;
						$modelStatus->DurationPeriod = $status->DurationPeriod;

						if (!($modelStatus->Save()))
							$result['errors']['status'] = $modelStatus->getErrors();
					}

				}
				else
					$result['errors']['applicant'] = $modelApplicant->getErrors();

			}

			$result['result'] = 'Successfully processed '.$total.' row(s), and inserted '.$count.' new entries';

			fclose($handle);

		}

		$this->render('import',array('model'=>$model,'result'=>$result));

	}
	
}
