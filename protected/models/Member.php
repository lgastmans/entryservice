<?php

/**
 * This is the model class for table "member".
 *
 * The followings are the available columns in table 'member':
 * @property integer $ID
 * @property string $Name
 * @property string $Surname
 * @property string $Email
 * @property string $Phone
 * @property string $FromDate
 * @property string $ToDate
 * @property integer $ReceiveEmail
 *
 * The followings are the available model relations:
 * @property MeetingMember[] $meetingMembers
 */
class Member extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Member the static model class
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
		return 'member';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('Name, Surname, FromDate, ToDate', 'required'),
			array('Name, Surname, FromDate', 'required'),
			array('Name, Surname', 'length', 'max'=>64),
			array('Email', 'length', 'max'=>32),
			array('Phone', 'length', 'max'=>16),
			array('ToDate', 'default', 'setOnEmpty' => true, 'value' => null),
			array('ReceiveEmail', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, Name, Surname, Email, Phone, FromDate, ToDate, ReceiveEmail', 'safe', 'on'=>'search'),
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
			'meetingMembers' => array(self::HAS_MANY, 'MeetingMember', 'memberID'),
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
			'Email' => 'Email',
			'Phone' => 'Phone',
			'FromDate' => 'From',
			'ToDate' => 'To',
			'ReceiveEmail' => 'Receive email notifications',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($active=false)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		if ($active!==false) {
			$criteria->addCondition('ToDate IS NULL');
		}

		$criteria->compare('ID',$this->ID);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Surname',$this->Surname,true);
		$criteria->compare('Email',$this->Email,true);
		$criteria->compare('Phone',$this->Phone,true);
		$criteria->compare('FromDate',$this->FromDate,true);
		$criteria->compare('ToDate',$this->ToDate,true);
		$criteria->compare('ReceiveEmail',$this->ReceiveEmail,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}