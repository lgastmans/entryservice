<?php

/**
 * This is the model class for table "applicant".
 *
 * The followings are the available columns in table 'applicant':
 * @property integer $ID
 * @property string $Name
 * @property string $Surname
 * @property string $AVName
 * @property string $BirthPlace
 * @property string $BirthDate
 * @property string $Photo
 * @property string $Sex
 * @property string $MaritalStatus
 * @property integer $ResServiceNum
 * @property string $Notes
 * @property string $HomeAddress
 * @property integer $NationalityID
 * @property integer $PassportID
 * @property integer $VisaID
 * @property integer $IndiaID
 * @property string $Spouse
 * @property integer $SpouseStatusID
 * @property integer $IsArchived
 *
 * The followings are the available model relations:
 * @property Absence[] $absences
 * @property Address[] $addresses
 * @property Nationality $nationality
 * @property Passport $passport
 * @property Visa $visa
 * @property IndianID $india
 * @property ApplicantMilestones[] $applicantMilestones
 * @property ApplicantReminders[] $applicantReminders
 * @property Children[] $childrens
 * @property Contact[] $contacts
 * @property Details[] $details
 * @property Extension[] $extensions
 */
class Applicant extends CActiveRecord
{
	public $nationality_fs; // fs - filter & sort
	public $status_fs;
	public $full_name;
	public $DOB;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Applicant the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'applicant';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Name, Surname, NationalityID', 'required'),
			array('ResServiceNum, NationalityID, PassportID, VisaID, IndiaID, SpouseStatusID', 'numerical', 'integerOnly'=>true),

			array('PassportID', 'default', 'setOnEmpty' => true, 'value' => null),
			array('VisaID', 'default', 'setOnEmpty' => true, 'value' => null),
			array('IndiaID', 'default', 'setOnEmpty' => true, 'value' => null),
			array('AVName', 'default', 'setOnEmpty' => true, 'value' => null),

			array('Name, Surname, AVName, BirthPlace, Spouse', 'length', 'max'=>64),
			array('Photo', 'length', 'max'=>128),
			array('Sex', 'length', 'max'=>1),
			array('MaritalStatus', 'length', 'max'=>8),

			array('Notes, HomeAddress, BirthDate', 'safe'),

			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('nationality_fs, status_fs, full_name, DOB, ID, Name, Surname, AVName,BirthPlace, BirthDate, Photo, Sex, MaritalStatus, ResServiceNum, Notes, HomeAddress, NationalityID, PassportID, VisaID, IndiaID, Spouse, SpouseStatusID, IsArchived', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'absences' => array(self::HAS_MANY, 'Absence', 'ApplicantID'),
			'addresses' => array(self::HAS_MANY, 'Address', 'ApplicantID'),
			'nationality' => array(self::BELONGS_TO, 'Nationality', 'NationalityID'),
			'passport' => array(self::BELONGS_TO, 'Passport', 'PassportID'),
			'visa' => array(self::BELONGS_TO, 'Visa', 'VisaID'),
			'india' => array(self::BELONGS_TO, 'IndianID', 'IndiaID'),
			'applicantMilestones' => array(self::HAS_MANY, 'ApplicantMilestones', 'ApplicantID'),
			'applicantReminders' => array(self::HAS_MANY, 'ApplicantReminders', 'ApplicantID'),
			'applicantEmails' => array(self::HAS_MANY, 'ApplicantEmail', 'ApplicantID'),
			'applicantPhones' => array(self::HAS_MANY, 'ApplicantPhone', 'ApplicantID'),
			'applicantStatus' => array(self::HAS_MANY, 'ApplicantStatus', 'ApplicantID'),
			'childrens' => array(self::HAS_MANY, 'Children', 'ApplicantID'),
			'contacts' => array(self::HAS_MANY, 'Contact', 'ApplicantID'),
			'details' => array(self::HAS_MANY, 'Details', 'ApplicantID'),
			'extensions' => array(self::HAS_MANY, 'Extension', 'ApplicantID'),
		);
	}

	public function behaviors() {
		return array(
		   'ERememberFiltersBehavior' => array(
		       'class' => 'application.components.ERememberFiltersBehavior',
		       'defaults'=>array(),           /* optional line */
		       'defaultStickOnClear'=>false   /* optional line */
		   ),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'nationality_fs' => 'Nationality',
			'status_fs' => 'Status',
			'full_name' => 'Name',
			'DOB' => 'Age',
			'ID' => 'ID',
			'Name' => 'Name',
			'Surname' => 'Surname',
			'AVName' => 'AV Name',
			'BirthPlace' => 'Birth Place',
			'BirthDate' => 'Birth Date',
			'Photo' => 'Photo',
			'Sex' => 'Sex',
			'MaritalStatus' => 'Marital Status',
			'ResServiceNum' => 'RS No.',
			'Notes' => 'Notes',
			'HomeAddress' => 'Home Address',
			'NationalityID' => 'Nationality',
			'PassportID' => 'Passport',
			'VisaID' => 'Visa',
			'IndiaID' => 'India',
			'Spouse' => 'Partner/Spouse Name',
			'SpouseStatusID' => 'Partner/Spouse Status',
			'IsArchived' => 'Archived',
		);
	}
    

    protected function afterFind()
    {
        // convert to display format
        $this->BirthDate = Yii::app()->dateFormatter->format('dd-MM-yyyy', $this->BirthDate);

        parent::afterFind();
    }

    protected function afterSave()
    {
        // convert to display format
        $this->BirthDate = Yii::app()->dateFormatter->format('dd-MM-yyyy', $this->BirthDate);

        parent::afterFind();
    }

    protected function beforeSave()
    {
    	if (($this->BirthDate == "") || ($this->BirthDate == '1970-01-01')) {
    	    $this->BirthDate = null;
    	}

        return parent::beforeSave();
    }

    protected function afterValidate ()
    {
    	if (($this->BirthDate == "") || ($this->BirthDate == '1970-01-01')) {
    	    $this->BirthDate = null;
    	}

    	parent::afterValidate();
    }

    protected function beforeValidate ()
    {
        $this->BirthDate = strtotime($this->BirthDate);
        $this->BirthDate = date('Y-m-d', $this->BirthDate);

        return parent::beforeValidate ();
    }


	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($showArchived=false)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		if (isset($_SESSION['adminFilterData'])) {
			//$this->full_name 		=$_SESSION['adminFilterData']['full_name'];
			$this->Name 			=$_SESSION['adminFilterData']['Name'];
			$this->Surname	 		=$_SESSION['adminFilterData']['Surname'];
			$this->AVName 			=$_SESSION['adminFilterData']['AVName'];
			$this->status_fs 		=$_SESSION['adminFilterData']['status_fs'];
			$this->BirthDate  		=$_SESSION['adminFilterData']['BirthDate'];
			$this->Sex 				=$_SESSION['adminFilterData']['Sex'];
			$this->MaritalStatus	=$_SESSION['adminFilterData']['MaritalStatus'];
			$this->ResServiceNum	=$_SESSION['adminFilterData']['ResServiceNum'];
			$this->nationality_fs	=$_SESSION['adminFilterData']['nationality_fs'];
		}

		$srchBirthDate='';
		if (isset($this->BirthDate)) {
			$arr = explode('-', $this->BirthDate);
			if ((isset($arr)) && (count($arr)==3))
				$srchBirthDate = $arr[2]."-".$arr[1]."-".$arr[0];
			else
				$srchBirthDate='';
		}



		$criteria->compare('ID',$this->ID);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Surname',$this->Surname,true);
		$criteria->compare('AVName',$this->AVName,true);
		$criteria->compare('BirthPlace',$this->BirthPlace,true);
		//$criteria->compare('BirthDate',$this->BirthDate,true);
		$criteria->compare('BirthDate',$srchBirthDate,true);
		//$criteria->compare('Photo',$this->Photo,true);
		$criteria->compare('Sex',$this->Sex,true);
		$criteria->compare('MaritalStatus',$this->MaritalStatus,true);
		$criteria->compare('ResServiceNum',$this->ResServiceNum);
		//$criteria->compare('Notes',$this->Notes,true);
		//$criteria->compare('HomeAddress',$this->HomeAddress,true);
		$criteria->compare('NationalityID',$this->NationalityID);
		$criteria->compare('PassportID',$this->PassportID);
		$criteria->compare('VisaID',$this->VisaID);
		$criteria->compare('IndiaID',$this->IndiaID);
		$criteria->compare('Spouse',$this->Spouse,true);
		$criteria->compare('SpouseStatusID',$this->SpouseStatusID,true);

		if (isset($_GET['showArchived'])) {
			if ($_GET['showArchived']=='Active')
				$criteria->addCondition('IsArchived=false');
			elseif ($_GET['showArchived']=='Archived')
				$criteria->addCondition('IsArchived=true');
		}
		else
			$criteria->addCondition('IsArchived=false');

		/*
		if (isset($this->full_name)) {
			$criteria->addCondition('((Name LIKE "%'.$this->full_name.'%") OR (Surname LIKE "%'.$this->full_name.'%") OR (CONCAT(Name," ",Surname) LIKE "%'.$this->full_name.'%"))');
		}
		*/

        if (isset($this->DOB)) { 
            if (!empty($this->DOB)) {
                $this->DOB = trim($this->DOB);
    
                if (strpos($this->DOB,'<')!==false) {
                    $var = preg_replace("/[^0-9,.]/", "", $this->DOB);
                    $criteria->addCondition("TIMESTAMPDIFF(YEAR,BirthDate,CURDATE()) <= ".$var);
                }
                elseif (strpos($this->DOB,'>')!==false) {
                    $var = preg_replace("/[^0-9,.]/", "", $this->DOB);
                    $criteria->addCondition("TIMESTAMPDIFF(YEAR,BirthDate,CURDATE()) >= ".$var);
                }
                else {
                    $var = preg_replace("/[^0-9,.]/", "", $this->DOB);
                    $criteria->addCondition("TIMESTAMPDIFF(YEAR,BirthDate,CURDATE()) = ".$var);
                }
            }
        }

		$criteria->with = array( 'applicantStatus', 'nationality' );
		$criteria->compare( 'nationality.Nationality', $this->nationality_fs, true );

		if (isset($this->status_fs) && ($this->status_fs <> '')) {
			// $criteria->compare('applicantStatus.StatusID', $this->status_fs);
			$criteria->addCondition("(applicantStatus.StatusID=".$this->status_fs.") AND (applicantStatus.CompletedOn IS NULL)");
			$criteria->together=true;
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
		        'attributes'=>array(
		            'nationality_fs'=>array(
		                'asc'=>'nationality.Nationality',
		                'desc'=>'nationality.Nationality DESC',
		            ),
		            /*
					'full_name'=>array(
						'asc'=>'Name',
						'desc'=>'Name DESC',
					),
					*/
		            /*
		            'status_fs'=>array(
		                'asc'=>'CurrentStatus',
		                'desc'=>'CurrentStatus DESC',
		            ),
		            */
		            '*',
		        ),
			    'defaultOrder'=>'t.Name, t.Surname ASC',
		    ),
		));
	}

	public function getAge()
	{
		$from = new DateTime($this->BirthDate);
		$to   = new DateTime('today');
		return $from->diff($to)->y;
	}

	public function getFullName()
	{
		return $this->Name." ".$this->Surname;
	}

	public function getCurrentStatus()
	{
		return ApplicantStatus::model()->getCurrentStatus($this->ID);
	}

	public function getCurrentAddress()
	{
		return false;
	}

	public function getApplicantQRCode()
	{
		$str = "MECARD:N:".$this->FullName.";";

		$res = ApplicantPhone::model()->find('ApplicantID=:ApplicantID AND IsPrimary="Y"', array('ApplicantID'=>$this->ID));
		if (isset($res))
			$str .= "TEL:".$res->Number.";";

		$res = ApplicantEmail::model()->find('ApplicantID=:ApplicantID AND IsPrimary="Y"', array('ApplicantID'=>$this->ID));
		if (isset($res))
			$str .= "EMAIL:".$res->Email.";";


		return $str;
	}

}
