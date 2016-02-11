<?php

/**
 * This is the model class for table "indianID".
 *
 * The followings are the available columns in table 'indianID':
 * @property integer $ID
 * @property string $TypeID
 * @property string $Number
 * @property string $IssuedDate
 * @property string $ValidTill
 * @property integer $StateID
 *
 * The followings are the available model relations:
 * @property Applicant[] $applicants
 */
class IndianID extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return IndianID the static model class
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
		return 'indianID';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TypeID, Number, IssuedDate, ValidTill', 'required'),
			array('StateID', 'numerical', 'integerOnly'=>true),
			array('TypeID', 'length', 'max'=>20),
			array('Number', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, TypeID, Number, IssuedDate, ValidTill, StateID', 'safe', 'on'=>'search'),
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
			'applicants' => array(self::HAS_MANY, 'Applicant', 'IndiaID'),
			'state' => array(self::HAS_MANY, 'State', 'StateID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'TypeID' => 'Type',
			'Number' => 'Number',
			'IssuedDate' => 'Issued Date',
			'ValidTill' => 'Valid Till',
			'StateID' => 'State',
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
		$criteria->compare('TypeID',$this->TypeID,true);
		$criteria->compare('Number',$this->Number,true);
		$criteria->compare('IssuedDate',$this->IssuedDate,true);
		$criteria->compare('ValidTill',$this->ValidTill,true);
		$criteria->compare('StateID',$this->StateID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getState() 
	{
		return State::model()->FindByPk($this->StateID)->StateName;
	}
}
