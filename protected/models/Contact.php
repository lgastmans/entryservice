<?php

/**
 * This is the model class for table "contact".
 *
 * The followings are the available columns in table 'contact':
 * @property integer $ID
 * @property integer $ApplicantID
 * @property string $Category
 * @property string $Relationship
 * @property string $Name
 * @property string $Surname
 * @property string $Address
 * @property integer $CountryID
 * @property string $Email
 * @property string $Phone
 * @property string $Cell
 *
 * The followings are the available model relations:
 * @property Applicant $applicant
 * @property ContactEmail[] $contactEmails
 * @property ContactPhone[] $contactPhones
 */
class Contact extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Contact the static model class
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
		return 'contact';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ApplicantID', 'required'),
			array('ApplicantID, CountryID', 'numerical', 'integerOnly'=>true),
			array('Category', 'length', 'max'=>14),
			array('Relationship', 'length', 'max'=>7),
			array('Name, Surname, Email, Phone, Cell', 'length', 'max'=>64),
			array('Address', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, ApplicantID, Category, Relationship, Name, Surname, Address, CountryID, Email, Phone, Cell', 'safe', 'on'=>'search'),
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
			'applicant' => array(self::BELONGS_TO, 'Applicant', 'ApplicantID'),
			'contactEmails' => array(self::HAS_MANY, 'ContactEmail', 'ContactID'),
			'contactPhones' => array(self::HAS_MANY, 'ContactPhone', 'ContactID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'ApplicantID' => 'Applicant',
			'Category' => 'Category',
			'Relationship' => 'Relationship',
			'Name' => 'Name',
			'Surname' => 'Surname',
			'Address' => 'Address',
			'CountryID' => 'Country',
			'Email' => 'Email',
			'Phone' => 'Phone',
			'Cell' => 'Cell',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($id=NULL,$category=NULL)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		if (isset($id)) {
			if (isset($category))
				$criteria->condition='ApplicantID=:ApplicantID AND Category="'.$category.'"';
			else
				$criteria->condition='ApplicantID=:ApplicantID';
			$criteria->params=array('ApplicantID'=>$id);
		}

		$criteria->compare('ID',$this->ID);
		$criteria->compare('ApplicantID',$this->ApplicantID);
		$criteria->compare('Category',$this->Category,true);
		$criteria->compare('Relationship',$this->Relationship,true);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Surname',$this->Surname,true);
		$criteria->compare('Address',$this->Address,true);
		$criteria->compare('CountryID',$this->CountryID);
		$criteria->compare('Email',$this->Email);
		$criteria->compare('Phone',$this->Phone);
		$criteria->compare('Cell',$this->Cell);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getContactDetails($ApplicantID) {
		$res = array();

		if (isset($applicantID)) {

			$data = $this->find("ApplicantID=:ID AND Category=:cat",array("ID"=>$applicantID,"cat"=>'Self'));
			if ($data) {
				$res['Self']['Address'] = $data->Address;
			}

			$data = $this->find("ApplicantID=:ID AND Category=:cat",array("ID"=>$applicantID,"cat"=>'Emergency'));
			if ($data) {
				$res['Emergency']['Relationship'] = $data->Relationship;
				$res['Emergency']['Name'] = $data->Name;
				$res['Emergency']['Surname'] = $data->Surname;
				$res['Emergency']['Address'] = $data->Address;
				$res['Emergency']['Email'] = $data->Email;
				$res['Emergency']['Phone'] = $data->Phone;
				$res['Emergency']['Cell'] = $data->Cell;
			}

			$data = $this->find("ApplicantID=:ID AND Category=:cat",array("ID"=>$applicantID,"cat"=>'Contact Person'));
			if ($data) {
				$res['Emergency']['Relationship'] = $data->Relationship;
				$res['Emergency']['Name'] = $data->Name;
				$res['Emergency']['Surname'] = $data->Surname;
				$res['Emergency']['Address'] = $data->Address;
				$res['Emergency']['Email'] = $data->Email;
				$res['Emergency']['Cell'] = $data->Cell;
			}
		}

		return $res;
	}

	public function getFullName()
	{
		return $this->Name." ".$this->Surname;
	}

}
