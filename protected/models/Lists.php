<?php

/**
 * This is the model class for table "applicant".
 *
 * The followings are the available columns in table 'applicant':
 * @property integer $ID
 * @property string $Name
 * @property string $Surname
 * @property string $BirthPlace
 * @property string $BirthDate
 * @property string $Photo
 * @property string $Sex
 * @property string $MaritalStatus
 * @property integer $ResServiceNum
 * @property string $Notes
 * @property integer $NationalityID
 * @property integer $PassportID
 * @property integer $VisaID
 * @property integer $IndiaID
 * @property string $Spouse
 *
 * The followings are the available model relations:
 * @property Absence[] $absences
 * @property Address[] $addresses
 * @property Nationality $nationality
 * @property Passport $passport
 * @property Visa $visa
 * @property IndianID $india
 * @property ApplicantEmail[] $applicantEmails
 * @property ApplicantMilestones[] $applicantMilestones
 * @property ApplicantPhone[] $applicantPhones
 * @property ApplicantReminders[] $applicantReminders
 * @property ApplicantStatistics[] $applicantStatistics
 * @property ApplicantStatus[] $applicantStatuses
 * @property Children[] $childrens
 * @property Contact[] $contacts
 * @property Details[] $details
 * @property Extension[] $extensions
 * @property Interview[] $interviews
 */
class Lists extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Lists the static model class
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
			array('Name, Surname, BirthPlace, BirthDate, Photo, Sex, MaritalStatus, Notes, NationalityID', 'required'),
			array('ResServiceNum, NationalityID, PassportID, VisaID, IndiaID', 'numerical', 'integerOnly'=>true),
			array('Name, Surname, BirthPlace, Spouse', 'length', 'max'=>64),
			array('Photo', 'length', 'max'=>128),
			array('Sex', 'length', 'max'=>1),
			array('MaritalStatus', 'length', 'max'=>9),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, Name, Surname, BirthPlace, BirthDate, Photo, Sex, MaritalStatus, ResServiceNum, Notes, NationalityID, PassportID, VisaID, IndiaID, Spouse', 'safe', 'on'=>'search'),
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
			'applicantEmails' => array(self::HAS_MANY, 'ApplicantEmail', 'ApplicantID'),
			'applicantMilestones' => array(self::HAS_MANY, 'ApplicantMilestones', 'ApplicantID'),
			'applicantPhones' => array(self::HAS_MANY, 'ApplicantPhone', 'ApplicantID'),
			'applicantReminders' => array(self::HAS_MANY, 'ApplicantReminders', 'ApplicantID'),
			'applicantStatistics' => array(self::HAS_MANY, 'ApplicantStatistics', 'ApplicantID'),
			'applicantStatuses' => array(self::HAS_MANY, 'ApplicantStatus', 'ApplicantID'),
			'childrens' => array(self::HAS_MANY, 'Children', 'ApplicantID'),
			'contacts' => array(self::HAS_MANY, 'Contact', 'ApplicantID'),
			'details' => array(self::HAS_MANY, 'Details', 'ApplicantID'),
			'extensions' => array(self::HAS_MANY, 'Extension', 'ApplicantID'),
			'interviews' => array(self::HAS_MANY, 'Interview', 'ApplicantID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'Name' => 'Name',
			'Surname' => 'Surname',
			'BirthPlace' => 'Birth Place',
			'BirthDate' => 'Birth Date',
			'Photo' => 'Photo',
			'Sex' => 'Sex',
			'MaritalStatus' => 'Marital Status',
			'ResServiceNum' => 'Res Service Num',
			'Notes' => 'Notes',
			'NationalityID' => 'Nationality',
			'PassportID' => 'Passport',
			'VisaID' => 'Visa',
			'IndiaID' => 'India',
			'Spouse' => 'Spouse',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID',$this->ID);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Surname',$this->Surname,true);
		$criteria->compare('BirthPlace',$this->BirthPlace,true);
		$criteria->compare('BirthDate',$this->BirthDate,true);
		$criteria->compare('Photo',$this->Photo,true);
		$criteria->compare('Sex',$this->Sex,true);
		$criteria->compare('MaritalStatus',$this->MaritalStatus,true);
		$criteria->compare('ResServiceNum',$this->ResServiceNum);
		$criteria->compare('Notes',$this->Notes,true);
		$criteria->compare('NationalityID',$this->NationalityID);
		$criteria->compare('PassportID',$this->PassportID);
		$criteria->compare('VisaID',$this->VisaID);
		$criteria->compare('IndiaID',$this->IndiaID);
		$criteria->compare('Spouse',$this->Spouse,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function listData() {

		$from = '';
		$where = '';

		$filter = '';
		if (isset(Yii::app()->session['lists_filter']))
			$filter = Yii::app()->session['lists_filter'];

		$applicantStatus = '';
		if (isset(Yii::app()->session['lists_applicantStatus'])) {
			$applicantStatus = Yii::app()->session['lists_applicantStatus'];
			if ($applicantStatus!='ALL') {
				$from = ", applicant_status aps";
				$where = "AND (aps.ApplicantID = a.ID) AND (aps.StatusID = ".$applicantStatus.")";
			}
		}

		$dateFrom = '';
		$dateTo = '';
		if ((isset(Yii::app()->session['lists_dateFrom'])) && (Yii::app()->session['lists_dateFrom']!='')) {
			$dateFrom = date("Y-m-d", strtotime(Yii::app()->session['lists_dateFrom']));
			$dateTo = date("Y-m-d", strtotime(Yii::app()->session['lists_dateTo']));

			if ($from=='') {
				$from = ", applicant_status aps";
				$where = "AND (aps.ApplicantID = a.ID) AND (aps.StartedOn BETWEEN '".$dateFrom."' AND '".$dateTo."')";
			}
			else {
				$where .= "AND (aps.StartedOn BETWEEN '".$dateFrom."' AND '".$dateTo."')";
			}
		}


		$milestoneStatus = '';
		if (isset(Yii::app()->session['lists_milestoneStatus']))
			$milestoneStatus = Yii::app()->session['lists_milestoneStatus'];

		$sql= "
			SELECT a.ID, a.Name, a.Surname, a.ResServiceNum, n.Nationality
			FROM (applicant a, nationality n".$from.")
			WHERE ((a.Name LIKE '%".$filter."%') OR (a.Surname LIKE '%".$filter."%'))
				AND (a.NationalityID = n.ID)
				".$where."
			ORDER BY Name, Surname";

		$connection=Yii::app()->db;
		$command=$connection->createCommand($sql);
		$dataReader=$command->query();

		$data = array();

		while(($row=$dataReader->read())!==false) {
			$data[] = array(
				"ID"=>$row['ID'], 
				"Name"=>$row['Name'],
				"Surname"=>$row['Surname'],
				"ResServiceNum"=>$row['ResServiceNum'],
				"Nationality"=>$row['Nationality']
			);
		}

		$dataProvider = new CArrayDataProvider($data, array(
		    'keyField'=>'ID',
		    'sort'=>array(
		        'attributes'=>array(
		             'ID', 'Name', 'Surname', 'ResServiceNum', 'Nationality'
		        ),
		        'defaultOrder'=>array(
 				   'Name'=>CSort::SORT_ASC,
				),
		    ),
		    'pagination'=>array(
		        'pageSize'=>10,
		    ),
		));
		
		return $dataProvider;
	}
}