<?php

/**
 * This is the model class for table "applicant_phone".
 *
 * The followings are the available columns in table 'applicant_phone':
 * @property integer $ID
 * @property integer $ApplicantID
 * @property string $ContactType
 * @property string $Number
 * @property string $IsPrimary
 *
 * The followings are the available model relations:
 * @property Applicant $applicant
 */
class ApplicantPhone extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ApplicantPhone the static model class
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
		return 'applicant_phone';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ApplicantID, ContactType, Number, IsPrimary', 'required'),
			array('ApplicantID', 'numerical', 'integerOnly'=>true),
			array('ContactType', 'length', 'max'=>4),
			array('Number', 'length', 'max'=>32),
			array('IsPrimary', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, ApplicantID, ContactType, Number, IsPrimary', 'safe', 'on'=>'search'),
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
			'ContactType' => 'Contact Type',
			'Number' => 'Number',
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
		$criteria->compare('ContactType',$this->ContactType,true);
		$criteria->compare('Number',$this->Number,true);
		$criteria->compare('IsPrimary',$this->IsPrimary,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
		        'attributes'=>array(
		            '*',
		        ),
			    'defaultOrder'=>'IsPrimary ASC',
		    ),
		));
	}

	public function getPrimaryPhone($applicantID) {
		$res = '';
		if (isset($applicantID)) {
			$data = $this->find("ApplicantID=:ID AND IsPrimary=:val",array("ID"=>$applicantID,"val"=>'Y'));
			if ($data)
				$res = $data->Number;
		}
		return $res;
	}
}