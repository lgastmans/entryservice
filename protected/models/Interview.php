<?php

/**
 * This is the model class for table "interview".
 *
 * The followings are the available columns in table 'interview':
 * @property integer $ID
 * @property integer $ApplicantID
 * @property string $DateInterviewed
 * @property string $Title
 * @property string $Present
 * @property string $Interview
 *
 * The followings are the available model relations:
 * @property Applicant $applicant
 */
class Interview extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Interview the static model class
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
		return 'interview';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ApplicantID, DateInterviewed, Present', 'required'),
			array('ApplicantID', 'numerical', 'integerOnly'=>true),
			array('Present', 'length', 'max'=>128),
			array('Title', 'length', 'max'=>128),
			array('Interview', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, ApplicantID, DateInterviewed, Title, Present, Interview', 'safe', 'on'=>'search'),
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
			'DateInterviewed' => 'Date Interviewed',
			'Title' => 'Title',
			'Present' => 'Present',
			'Interview' => 'Interview',
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
		$criteria->compare('DateInterviewed',$this->DateInterviewed,true);
		$criteria->compare('Title',$this->Title,true);
		$criteria->compare('Present',$this->Present);
		$criteria->compare('Interview',$this->Interview,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}