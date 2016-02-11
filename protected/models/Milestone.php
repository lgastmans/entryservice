<?php

/**
 * This is the model class for table "milestone".
 *
 * The followings are the available columns in table 'milestone':
 * @property integer $ID
 * @property integer $MilestoneCategoryID
 * @property string $Description
 * @property integer $TimelineInterval
 * @property string $TimelinePeriod
 * @property integer $SendEmail
 * @property string $EmailText
 * @property integer $Alert
 * @property integer $AlertInterval
 * @property string $AlertPeriod
 * @property integer $RepeatAlert
 * @property integer $IsAlerted
 * @property integer $IsActive
 * @property integer $IsDefault
 *
 * The followings are the available model relations:
 * @property MilestoneCategory $milestoneCategory
 */
class Milestone extends CActiveRecord
{
	public $category_fs; // fs - filter & sort

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Milestone the static model class
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
		return 'milestone';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('MilestoneCategoryID, Description, TimelineInterval, TimelinePeriod, SendEmail, Alert, AlertInterval, AlertPeriod, RepeatAlert, IsActive, IsDefault', 'required'),
			array('MilestoneCategoryID, TimelineInterval, Alert, AlertInterval, RepeatAlert, IsAlerted, IsDefault, SendEmail, IsActive', 'numerical', 'integerOnly'=>true),
			array('Description', 'length', 'max'=>128),
			array('TimelinePeriod, AlertPeriod', 'length', 'max'=>6),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('category_fs, ID, MilestoneCategoryID, Description, TimelineInterval, TimelinePeriod, SendEmail, EmailText, Alert, AlertInterval, AlertPeriod, RepeatAlert, IsAlerted, IsActive, IsDefault', 'safe', 'on'=>'search'),
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
			'milestoneCategory' => array(self::BELONGS_TO, 'MilestoneCategory', 'MilestoneCategoryID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'MilestoneCategoryID' => 'Milestone Category',
			'category_fs' => 'Category',
			'Description' => 'Description',
			'TimelineInterval' => 'Timeline Interval',
			'TimelinePeriod' => 'Timeline Period',
			'SendEmail' => 'Send email reminder to Entry Service',
			'EmailText' => 'Email Text',
			'Alert' => 'Display an alert when timeline has been passed',
			'AlertInterval' => 'Alert Interval',
			'AlertPeriod' => 'Alert Period',
			'RepeatAlert' => 'Repeat Alert',
			'IsAlerted' => 'Is Alerted',
			'IsActive' => 'This milestone is active',
			'IsDefault' => 'Add this milestone to newly created applicants',
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
		$criteria->compare('MilestoneCategoryID',$this->MilestoneCategoryID);
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('TimelineInterval',$this->TimelineInterval);
		$criteria->compare('TimelinePeriod',$this->TimelinePeriod,true);
		$criteria->compare('SendEmail',$this->SendEmail,true);
		$criteria->compare('EmailText',$this->EmailText,true);
		$criteria->compare('Alert',$this->Alert);
		$criteria->compare('AlertInterval',$this->AlertInterval);
		$criteria->compare('AlertPeriod',$this->AlertPeriod,true);
		$criteria->compare('RepeatAlert',$this->RepeatAlert);
		$criteria->compare('IsAlerted',$this->IsAlerted);
		$criteria->compare('IsActive',$this->IsActive,true);
		$criteria->compare('IsDefault',$this->IsDefault);

		$criteria->with = array( 'milestoneCategory' );
		$criteria->compare( 'milestoneCategory.Description', $this->category_fs, true );

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
		        'attributes'=>array(
		            'category_fs'=>array(
		                'asc'=>'milestoneCategory.Description',
		                'desc'=>'milestoneCategory.Description DESC',
		            ),
		            '*',
		        ),
			    'defaultOrder'=>'t.Description ASC',			
		    ),
		));
	}
}