<?php

/**
 * This is the model class for table "meeting".
 *
 * The followings are the available columns in table 'meeting':
 * @property integer $ID
 * @property string $Category
 * @property string $Title
 * @property string $MeetingDate
 * @property string $Content
 *
 * The followings are the available model relations:
 * @property MeetingMember[] $meetingMembers
 */
class Meeting extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Meeting the static model class
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
		return 'meeting';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Category, Title, MeetingDate, Content', 'required'),
			array('Category', 'length', 'max'=>8),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, Category, Title, MeetingDate, Content', 'safe', 'on'=>'search'),
		);
	}

    public function getNames()
    {
            $out=CHtml::listData($this->meetingMembers,'ID','Name');

            return implode(',', $out);
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			//'meetingMembers' => array(self::HAS_MANY, 'MeetingMember', 'meetingID'),
			'meetingMembers'=>array(self::MANY_MANY, 'Member', 'meeting_member(meetingID, memberID)'),
			//'members' => array(self::HAS_MANY, 'Members', 'meetingID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'Category' => 'Category',
			'Title' => 'Title',
			'MeetingDate' => 'Meeting Date',
			'meetingMembers' => 'Attended By',
			'Content' => 'Content',
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
		$criteria->compare('Category',$this->Category,true);
		$criteria->compare('Title',$this->Title,true);
		$criteria->compare('MeetingDate',$this->MeetingDate,true);
		$criteria->compare('Content',$this->Content,true);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}