<?php

/**
 * This is the model class for table "applicant_reminders".
 *
 * The followings are the available columns in table 'applicant_reminders':
 * @property integer $ID
 * @property integer $ApplicantID
 * @property integer $ApplicantMilestoneID
 * @property string $Status
 * @property string $Description
 * @property string $EmailMessage
 * @property integer $RepeatInterval
 * @property string $RepeatPeriod
 * @property string $EmailApplicant
 * @property string $EmailTeam
 * @property string $EmailES
 * @property string $DateRecorded
 *
 * The followings are the available model relations:
 * @property ApplicantMilestones $applicantMilestone
 * @property Applicant $applicant
 */
class ApplicantReminders extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ApplicantReminders the static model class
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
		return 'applicant_reminders';
	}

	public function getHasReminder() {
        return  "pfrt";
    }


	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ApplicantID, ApplicantMilestoneID, Status, Description, EmailMessage, RepeatInterval, RepeatPeriod, EmailApplicant, EmailTeam, EmailES', 'required'),
			array('ApplicantID, ApplicantMilestoneID, RepeatInterval', 'numerical', 'integerOnly'=>true),
			array('Status', 'length', 'max'=>9),
			array('Description', 'length', 'max'=>64),
			array('RepeatPeriod', 'length', 'max'=>6),
			array('EmailApplicant, EmailTeam, EmailES', 'length', 'max'=>1),
			array('DateRecorded', 'default', 'setOnEmpty' => true, 'value' => null),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, ApplicantID, ApplicantMilestoneID, Status, Description, EmailMessage, RepeatInterval, RepeatPeriod, EmailApplicant, EmailTeam, EmailES, DateRecorded', 'safe', 'on'=>'search'),
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
			'applicantMilestone' => array(self::BELONGS_TO, 'ApplicantMilestones', 'ApplicantMilestoneID'),
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
			'ApplicantID' => 'Applicant ID',
			'ApplicantMilestoneID' => 'Applicant Milestone ID',
			'Status' => 'Status',
			'Description' => 'Description',
			'EmailMessage' => 'Email Message',
			'RepeatInterval' => 'Repeat Interval',
			'RepeatPeriod' => 'Repeat Period',
			'EmailApplicant' => 'Email Applicant',
			'EmailTeam' => 'Email Team',
			'EmailES' => 'Email ES',
			'DateRecorded' => 'Date Recorded',
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
		$criteria->compare('ApplicantID',$this->ApplicantID);
		$criteria->compare('ApplicantMilestoneID',$this->ApplicantMilestoneID);
		$criteria->compare('Status',$this->Status,true);
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('EmailMessage',$this->EmailMessage,true);
		$criteria->compare('RepeatInterval',$this->RepeatInterval);
		$criteria->compare('RepeatPeriod',$this->RepeatPeriod,true);
		$criteria->compare('EmailApplicant',$this->EmailApplicant,true);
		$criteria->compare('EmailTeam',$this->EmailTeam,true);
		$criteria->compare('EmailES',$this->EmailES,true);
		$criteria->compare('DateRecorded',$this->DateRecorded,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}