<?php

/**
 * This is the model class for table "applicant_email".
 *
 * The followings are the available columns in table 'applicant_email':
 * @property integer $ID
 * @property integer $ApplicantID
 * @property string $Email
 * @property string $IsPrimary
 *
 * The followings are the available model relations:
 * @property Applicant $applicant
 */
class ApplicantEmail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ApplicantEmail the static model class
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
		return 'applicant_email';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Email', 'required'),
			array('ApplicantID', 'numerical', 'integerOnly'=>true),
			array('Email', 'length', 'max'=>64),
			array('IsPrimary', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, ApplicantID, Email, IsPrimary', 'safe', 'on'=>'search'),
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
			'Email' => 'Email',
			'IsPrimary' => 'Is Primary',
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
		$criteria->compare('Email',$this->Email,true);
		$criteria->compare('IsPrimary',$this->IsPrimary,false);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getPrimaryEmail($applicantID) {
		$res = '';
		if (isset($applicantID)) {
			$data = $this->find("ApplicantID=:ID AND IsPrimary=:val",array("ID"=>$applicantID,"val"=>'Y'));
			if ($data)
				$res = $data->Email;
		}
		return $res;
	}
}