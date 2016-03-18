<?php

/**
 * This is the model class for table "applicant_milestones".
 *
 * The followings are the available columns in table 'applicant_milestones':
 * @property integer $ID
 * @property integer $MilestoneCategoryID
 * @property integer $ApplicantID
 * @property string $Status
 * @property string $DateCreated
 * @property string $DateStarted
 * @property string $DateCompleted
 * @property string $Description
 * @property string $Remarks
 * @property integer $TimelineInterval
 * @property string $TimelinePeriod
 * @property integer $Alert
 * @property integer $AlertInterval
 * @property string $AlertPeriod
 * @property integer $RepeatAlert
 * @property integer $IsAlerted
 * @property string $SendEmail
 * @property string $EmailText
 * @property string $IsActive
 * @property string $ColorIndicator
 *
 * The followings are the available model relations:
 * @property Applicant $applicant
 */
class ApplicantMilestones extends CActiveRecord
{
	public $HasReminder;

	public function getHasReminderLabel($milestoneID) {
		$res = ApplicantReminders::model()->find('ApplicantMilestoneID=:val', array('val'=>$milestoneID));

		if ($res)
			if (is_null($res->DateRecorded))
				return TbHtml::labelTb('Reminder', array('color' => TbHtml::LABEL_COLOR_WARNING));
			else {
				$dt = Yii::app()->dateFormatter->formatDateTime($res->DateRecorded, "long", null);
				return TbHtml::labelTb($dt, array('color' => TbHtml::LABEL_COLOR_SUCCESS));
			}
		else
			return TbHtml::labelTb('None');
	}

	public function getHasReminder($milestoneID) {
		$res = ApplicantReminders::model()->find('ApplicantMilestoneID=:val', array('val'=>$milestoneID));

		if ($res)
			return true;
		else
			return false;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ApplicantMilestones the static model class
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
		return 'applicant_milestones';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ApplicantID, MilestoneCategoryID, Status, DateCreated, Description, TimelineInterval, TimelinePeriod, Alert, AlertInterval, AlertPeriod', 'required'),
			array('ApplicantID, TimelineInterval, Alert, AlertInterval, RepeatAlert, IsAlerted', 'numerical', 'integerOnly'=>true),
			array('Status', 'length', 'max'=>9),
			array('Description', 'length', 'max'=>128),
			array('TimelinePeriod, AlertPeriod', 'length', 'max'=>6),
			array('SendEmail, IsActive', 'length', 'max'=>1),
			array('ColorIndicator', 'length', 'max'=>16),
			array('DateStarted, DateCompleted, Remarks', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, ApplicantID, MilestoneCategoryID, Status, DateCreated, DateStarted, DateCompleted, Description, Remarks, TimelineInterval, TimelinePeriod, Alert, AlertInterval, AlertPeriod, RepeatAlert, IsAlerted, SendEmail, EmailText, IsActive, ColorIndicator', 'safe', 'on'=>'search'),
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
			'milestone_category' => array(self::BELONGS_TO, 'MilestoneCategory', 'MilestoneCategoryID'),
			//'applicantReminders' => array(self::HAS_MANY, 'ApplicantReminders', 'ApplicantMilestoneID'),
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
			'MilestoneCategoryID' => 'Category',
			'Status' => 'Status',
			'DateCreated' => 'Date Created',
			'DateStarted' => 'Date Started',
			'DateCompleted' => 'Date Completed',
			'Description' => 'Description',
			'Remarks' => 'Remarks',
			'TimelineInterval' => 'Timeline Interval',
			'TimelinePeriod' => 'Timeline Period',
			'Alert' => 'Alert',
			'AlertInterval' => 'Alert Interval',
			'AlertPeriod' => 'Alert Period',
			'RepeatAlert' => 'Repeat Alert',
			'IsAlerted' => 'Is Alerted',
			'SendEmail' => 'Send Email',
			'EmailText' => 'Email Text',
			'IsActive' => 'Is Active',
			'ColorIndicator' => 'Color Indicator',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($id=NULL,$initStatus=NULL)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$conditions=array();
		$params1=array();
		$params2=array();

		if (isset($id)) {
			$conditions[]='ApplicantID=:ApplicantID';
			$params1=array('ApplicantID'=>$id);
		}

		// if ((isset($_GET['dropDownStatus'])) && ($_GET['dropDownStatus']!=='ALL')) {
    //   $criteria->with = 'milestone_category';
		//
    //   $conditions[]='milestone_category.StatusID=:StatusID';
    //   $params2=array('StatusID'=>$_GET['dropDownStatus']);
    // }
		if ((isset($_GET['statusID'])) && ($_GET['statusID']!=='ALL')) {
			$criteria->with = 'milestone_category';

			$conditions[]='milestone_category.StatusID=:StatusID';
			$params2=array('StatusID'=>$_GET['statusID']);
		}
		elseif (isset($initStatus)) {
			$criteria->with = 'milestone_category';

			$conditions[]='milestone_category.StatusID=:StatusID';
			$params2=array('StatusID'=>$initStatus);
		}

  		$criteria->condition=implode(' AND ', $conditions);
		$criteria->params=array_merge($params1, $params2);

		$criteria->compare('ID',$this->ID);
		$criteria->compare('ApplicantID',$this->ApplicantID);
		$criteria->compare('MilestoneCategoryID',$this->MilestoneCategoryID,false);
		$criteria->compare('Status',$this->Status,true);
		$criteria->compare('DateCreated',$this->DateCreated,true);
		$criteria->compare('DateStarted',$this->DateStarted,true);
		$criteria->compare('DateCompleted',$this->DateCompleted,true);
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('Remarks',$this->Remarks,true);
		$criteria->compare('TimelineInterval',$this->TimelineInterval);
		$criteria->compare('TimelinePeriod',$this->TimelinePeriod,true);
		$criteria->compare('Alert',$this->Alert);
		$criteria->compare('AlertInterval',$this->AlertInterval);
		$criteria->compare('AlertPeriod',$this->AlertPeriod,true);
		$criteria->compare('RepeatAlert',$this->RepeatAlert);
		$criteria->compare('IsAlerted',$this->IsAlerted);
		$criteria->compare('SendEmail',$this->SendEmail,true);
		$criteria->compare('EmailText',$this->EmailText,true);
		$criteria->compare('IsActive',$this->IsActive,true);
		$criteria->compare('ColorIndicator',$this->ColorIndicator,true);
		//$criteria->compare('HasReminder',$this->getHasReminder(),false);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize' => 15,),
		));
	}

    protected function afterFind()
    {
        // convert to display format
        $this->DateStarted = Yii::app()->dateFormatter->format('dd-MM-yyyy', $this->DateStarted);
        $this->DateCompleted = Yii::app()->dateFormatter->format('dd-MM-yyyy', $this->DateCompleted);

        parent::afterFind();
    }

    protected function beforeValidate ()
    {
        $this->DateStarted = strtotime($this->DateStarted);
        $this->DateStarted = date('Y-m-d', $this->DateStarted);

        $this->DateCompleted = strtotime($this->DateCompleted);
        $this->DateCompleted = date('Y-m-d', $this->DateCompleted);

        return parent::beforeValidate ();
    }

    protected function beforeSave()
    {
    	if (($this->DateStarted == "") || ($this->DateStarted == '1970-01-01')) {
    	    $this->DateStarted = null;
	    }
    	if (($this->DateCompleted == "") || ($this->DateCompleted == '1970-01-01')) {
    	    $this->DateCompleted = null;
	    }

	    return parent::beforeSave();
    }	
    
	public function overdueMilestones() {
		$info = array();

		/*
			get the current status
		*/
		$criteria=new CDbCriteria;
		$criteria->select='*';  // only select the 'title' column
		$criteria->condition="
			((DateStarted IS NOT NULL) AND (YEAR(DateStarted) != 0))
			AND (Status IN ('Pending','Extended'))
			AND (IsActive) AND (Alert)
		";
		//$criteria->params=array(':applicantID'=>$applicant_id);
		$criteria->with=array('applicant');

		$data = $this->findAll($criteria);

		if ($data) {
			foreach ($data as $item) {
				$total_days = $this->CalcDurationInDays($item->TimelineInterval, $item->TimelinePeriod);

				$status = $this->CalcDaysCompleted($item->DateStarted, $total_days);

				if ($status['interval'] < 0) {
					$dateStarted = new DateTime($item->DateStarted);
					$dateStarted = $dateStarted->format('j M Y');

					$info[$item->ID]['ID'] = $item->applicant->ID;
					$info[$item->ID]['Name'] = $item->applicant->Name." ".$item->applicant->Surname;
					$info[$item->ID]['Status'] = $item->Status;
					$info[$item->ID]['Description'] = $item->Description;
					$info[$item->ID]['DateStarted'] = $dateStarted;
					$info[$item->ID]['TimelineInterval'] = $item->TimelineInterval. " ".$item->TimelinePeriod;
				}
			}
		}

		$dataProvider=new CArrayDataProvider($info, array(
		    'id'=>'applicant_milestones',
		    'keyField'=>'ID',
		    'sort'=>array(
		        'attributes'=>array(
		             'ID', 'Name', 'Status', 'Description', 'DateStarted', 'TimelineInterval',
		        ),
		        'defaultOrder'=>array(
 				   'Status'=>CSort::SORT_DESC,
				),
		    ),
		    'pagination'=>array(
		        'pageSize'=>10,
		    ),
		));

		return $dataProvider;

	}

	private function CalcDurationInDays($duration, $period) {
		$days = 1;

		if ($period=='Years')
			$days = 364;
		else if ($period=='Months')
			$days = 30;
		else if ($period=='Weeks')
			$days = 7;
		else if ($period=='Days')
			$days = 1;

		return $duration * $days;
	}

	private function CalcDaysCompleted($started_on, $total_days) {
		$dateToday = new DateTime("now");

		$add = "P".$total_days."D";

		$dateCompletion = new DateTime($started_on);

		$dateCompletion->add(new DateInterval($add));

		$interval = $dateToday->diff($dateCompletion);

		$arr['interval'] = $interval->format('%R%a');
		$arr['on'] = $dateCompletion->format('j M Y');

		return $arr;
	}

}
