<?php

/**
 * This is the model class for table "meeting_member".
 *
 * The followings are the available columns in table 'meeting_member':
 * @property integer $meetingID
 * @property integer $memberID
 *
 * The followings are the available model relations:
 * @property Meeting $meeting
 * @property Member $member
 */
class MeetingMember extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MeetingMember the static model class
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
		return 'meeting_member';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('meetingID, memberID', 'required'),
			array('meetingID, memberID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('meetingID, memberID', 'safe', 'on'=>'search'),
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
			'meeting' => array(self::BELONGS_TO, 'Meeting', 'meetingID'),
			'member' => array(self::BELONGS_TO, 'Member', 'memberID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'meetingID' => 'Meeting',
			'memberID' => 'Member',
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

		$criteria->compare('meetingID',$this->meetingID);
		$criteria->compare('memberID',$this->memberID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}