<?php

/**
 * This is the model class for table "children".
 *
 * The followings are the available columns in table 'children':
 * @property integer $ID
 * @property integer $ApplicantID
 * @property integer $SchoolID
 * @property string $Name
 * @property string $Surname
 * @property string $PassportNumber
 * @property string $IssuedDate
 * @property string $ValidTill
 * @property string $BirthDate
 *
 * The followings are the available model relations:
 * @property Applicant $applicant
 */
class Children extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Children the static model class
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
		return 'children';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ApplicantID, Name', 'required'),
			array('ApplicantID, SchoolID', 'numerical', 'integerOnly'=>true),
			array('Name, Surname', 'length', 'max'=>64),
			array('PassportNumber', 'length', 'max'=>32),
			array('IssuedDate, ValidTill, BirthDate', 'default', 'setOnEmpty' => true, 'value' => null),

			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, ApplicantID, SchoolID, Name, Surname, PassportNumber, IssuedDate, ValidTill, BirthDate, School', 'safe', 'on'=>'search'),
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
			'Name' => 'Name',
			'Surname' => 'Surname',
			'PassportNumber' => 'Passport Number',
			'IssuedDate' => 'Issued Date',
			'ValidTill' => 'Valid Till',
			'BirthDate' => 'Birth Date',
			'SchoolID' => 'School',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($id=NULL)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		if (isset($id)) {
			$criteria->condition='ApplicantID=:ApplicantID';
			$criteria->params=array('ApplicantID'=>$id);
		}

		$criteria->compare('ID',$this->ID);
		$criteria->compare('ApplicantID',$this->ApplicantID);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Surname',$this->Surname,true);
		$criteria->compare('PassportNumber',$this->PassportNumber,true);
		$criteria->compare('IssuedDate',$this->IssuedDate,true);
		$criteria->compare('ValidTill',$this->ValidTill,true);
		$criteria->compare('BirthDate',$this->BirthDate,true);
		$criteria->compare('SchoolID',$this->SchoolID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
		        'attributes'=>array(
		            '*',
		        ),
			    'defaultOrder'=>'Name ASC',
		    ),
		));
	}
}
