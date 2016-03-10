<?php

/**
 * This is the model class for table "applicant_status".
 *
 * The followings are the available columns in table 'applicant_status':
 * @property integer $ID
 * @property integer $ApplicantID
 * @property integer $StatusID
 * @property string $StartedOn
 * @property integer $IsCompleted
 * @property string $CompletedOn
 * @property string $Color
 * @property integer $Duration
 * @property string $DurationPeriod
 * @property string $NewsAndNotes
 *
 * The followings are the available model relations:
 * @property Status $status
 * @property Applicant $applicant
 */
class ApplicantStatus extends CActiveRecord
{
	public $current_status;
	public $Total;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ApplicantStatus the static model class
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
		return 'applicant_status';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ApplicantID, StatusID, StartedOn', 'required'),
			array('ApplicantID, StatusID, Duration', 'numerical', 'integerOnly'=>true),
			array('Color', 'length', 'max'=>10),
			array('DurationPeriod', 'length', 'max'=>6),
			array('CompletedOn', 'safe'),
			array('StartedOn, CompletedOn, NewsAndNotes', 'default', 'setOnEmpty' => true, 'value' => null),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('current_status, ID, ApplicantID, StatusID, StartedOn, IsCompleted, CompletedOn, NewsAndNotes, Color, Duration, DurationPeriod', 'safe', 'on'=>'search'),
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
			'status' => array(self::BELONGS_TO, 'Status', 'StatusID'),
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
			'current_status' => 'Status',
			'StatusID' => 'Status',
			'StartedOn' => 'Started On',
			'IsCompleted' => 'Completed',
			'CompletedOn' => 'Completed On',
			'Color' => 'Color',
			'Duration' => 'Duration',
			'DurationPeriod' => 'Duration Period',
			'NewsAndNotes' => 'N&N No.'
		);
	}
    
    protected function afterFind()
    {
        // convert to display format
        $this->StartedOn = Yii::app()->dateFormatter->format('dd-MM-yyyy', $this->StartedOn);
        $this->CompletedOn = Yii::app()->dateFormatter->format('dd-MM-yyyy', $this->CompletedOn);

        parent::afterFind();
    }

    protected function beforeValidate ()
    {
        $this->StartedOn = strtotime($this->StartedOn);
        $this->StartedOn = date('Y-m-d', $this->StartedOn);

        $this->CompletedOn = strtotime($this->CompletedOn);
        $this->CompletedOn = date('Y-m-d', $this->CompletedOn);

        return parent::beforeValidate ();
    }

    protected function beforeSave()
    {
    	if (($this->CompletedOn == "") || ($this->CompletedOn == '1970-01-01')) {
    	    $this->CompletedOn = null;
	    }

	    return parent::beforeSave();
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
		$criteria->compare('current_status',$this->ID);
		$criteria->compare('ApplicantID',$this->ApplicantID);
		$criteria->compare('StatusID',$this->StatusID);
		$criteria->compare('StartedOn',$this->StartedOn,true);
		$criteria->compare('IsCompleted',$this->IsCompleted,true);
		$criteria->compare('CompletedOn',$this->CompletedOn,true);
		$criteria->compare('Color',$this->Color,true);
		$criteria->compare('Duration',$this->Duration);
		$criteria->compare('DurationPeriod',$this->DurationPeriod,true);
		$criteria->compare('NewsAndNotes',$this->NewsAndNotes,true);

		$criteria->with = array( 'status' );
		$criteria->compare( 'status.Description', $this->current_status, true );

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
		        'attributes'=>array(
		            'current_status'=>array(
		                'asc'=>'status.Description',
		                'desc'=>'status.Description DESC',
		            ),
		            '*',
		        ),
			    'defaultOrder'=>'CompletedOn ASC',
		    ),
		));
	}

	public function getNotification() {
		$ret = '';

		if ((isset($this->DurationPeriod)) && (!(empty($this->DurationPeriod)))) {

			if (is_null($this->CompletedOn) || ($this->CompletedOn=='0000-00-00')) {

				$extensions = Extension::model()->statusExtensions($this->ApplicantID, $this->StatusID);
				$extension_days=0;
				if (!empty($extensions)) {
					foreach ($extensions as $row)
						$extension_days += $this->CalcDurationInDays($row['ExtendedFor'], $row['ExtendedPeriod']);
				}

				$total_days = $this->CalcDurationInDays($this->Duration, $this->DurationPeriod);
				$total_days += $extension_days;

				$info_completed = $this->CalcDaysCompleted($this->StartedOn, $total_days);

				if ($info_completed['interval'] < 0)
					$ret = $info_completed['interval']." days overdue";
				else
					$ret = $info_completed['interval']." days left";

			}
		}

		return $ret;
	}

	public function getCurrentStatus($applicant_id) {
		/*
			get the current status
		*/
		$criteria=new CDbCriteria;
		$criteria->select='*';
		$criteria->condition='(applicantID=:applicantID) AND ((CompletedOn IS NULL) OR (YEAR(CompletedOn) = 0))';
		$criteria->params=array(':applicantID'=>$applicant_id);
		$criteria->with=array('status');

		$data = $this->find($criteria);

		$res = 'not set';
		if ($data) {
			$res = $data->status->Description;
		}

		return $res;
	}

	public function getStatusErrors()
	{
		// SELECT ApplicantID, COUNT( ID ) AS Total
		// FROM `applicant_status`
		// WHERE CompletedOn IS NULL
		// GROUP BY ApplicantID
		// HAVING Total >1
		// LIMIT 0 , 30

		$arr=array();

		$sql = "
			SELECT ast.ApplicantID, CONCAT(app.Name, ' ', app.Surname) AS Fullname, COUNT( ast.ID ) AS Total
			FROM applicant_status ast
			INNER JOIN applicant app ON (app.ID=ast.ApplicantID)
			WHERE (ast.CompletedOn IS NULL) AND (app.IsArchived=FALSE)
			GROUP BY ast.ApplicantID
			HAVING Total > 1
			ORDER BY Fullname";

		$connection=Yii::app()->db;
		$command=$connection->createCommand($sql);
		$dataReader=$command->query();

		while(($row=$dataReader->read())!==false) {
			$arr[] = array(
				'ApplicantID'=>$row['ApplicantID'],
				'Fullname'=>$row['Fullname'],
				'Total'=>$row['Total']
			);
		}


		$dataProvider=new CArrayDataProvider($arr, array(
		    'id'=>'applicant_status',
		    'keyField'=>'ApplicantID',
		    'sort'=>array(
		        'attributes'=>array(
		             'ApplicantID', 'Fullname', 'Total',
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

		//return $arr;
	}

	public function getStatusTotals()
	{
		$arr=array();

		//SELECT s.Description AS Status, apps.StatusID, COUNT(apps.ID) 
		//FROM `applicant_status` apps
		//INNER JOIN `status` s ON (s.ID = apps.StatusID)
		//WHERE (CompletedOn IS NULL)
		//GROUP BY StatusID

		$sql= "
			SELECT s.Description AS Status, apps.StatusID, COUNT(apps.ID) AS Total
			FROM `applicant_status` apps
			INNER JOIN `status` s ON (s.ID = apps.StatusID)
			INNER JOIN `applicant` a ON (a.ID = apps.ApplicantID)
			WHERE (CompletedOn IS NULL) AND (a.IsArchived=FALSE)
			GROUP BY StatusID
			ORDER BY s.Description";

		$connection=Yii::app()->db;
		$command=$connection->createCommand($sql);
		$dataReader=$command->query();

		while(($row=$dataReader->read())!==false) {
			$arr[] = array(
				'Status'=>$row['Status'],
				'Total' =>$row['Total']
			);
		}

		return $arr;
	}

	public function statusInformation($applicant_id, $status_id=NULL) {

		$info = array();

		/*
			get the information of a specified status
			of the given applicant
		*/
		if (isset($status_id)) {

			$criteria=new CDbCriteria;
			$criteria->select='*';  // only select the 'title' column
			$criteria->condition='(ApplicantID=:applicantID) AND (StatusID=:status_id)';
			$criteria->params=array(':applicantID'=>$applicant_id,'status_id'=>$status_id);
			$criteria->with=array('status');

			$data = $this->find($criteria);

			if ($data) {
				/*
					Check for possible extensions...
				*/
				$extensions = Extension::model()->statusExtensions($applicant_id, $data->StatusID);
				$extension_days=0;
				if (!empty($extensions)) {
					foreach ($extensions as $row)
						$extension_days += $this->CalcDurationInDays($row['ExtendedFor'], $row['ExtendedPeriod']);
				}

				$info['current']['Description'] = $data->status->Description;
				$info['current']['StartedOn'] = Yii::app()->dateFormatter->formatDateTime($data->StartedOn, "long", null);

				$total_days = $this->CalcDurationInDays($data->Duration, $data->DurationPeriod);
				$total_days += $extension_days;

				$info['current']['ExtensionsTotalDays'] = $extension_days;
				$info['current']['DaysTotal'] = $total_days;

				$info_completed = $this->CalcDaysCompleted($data->StartedOn, $total_days);

				$info['current']['DaysCompleted'] = $info_completed['interval'];
				$info['current']['IsCompleted'] = ($data->IsCompleted)?"Yes, ".Yii::app()->dateFormatter->formatDateTime($data->CompletedOn, "long", null):"No";
				$info['current']['CompletedOn'] = $info_completed['on'];

			}

			return $info;
		}

		/*
			OR

			get the information of all the statuses
			of the given applicant

			get the current status
		*/
		$criteria=new CDbCriteria;
		$criteria->select='*';  // only select the 'title' column
		//$criteria->condition='(applicantID=:applicantID) AND ((CompletedOn IS NULL) OR (YEAR(CompletedOn) = 0))';
		//$criteria->condition='(applicantID=:applicantID) AND (IsCompleted = 0)';
		$criteria->condition='(applicantID=:applicantID) AND (CompletedOn IS NULL)';
		$criteria->params=array(':applicantID'=>$applicant_id);
		$criteria->with=array('status');

		$data = $this->find($criteria);

		if ($data) {
			/*
				Check for possible extensions...
			*/
			$extensions = Extension::model()->statusExtensions($applicant_id, $data->StatusID);
			$extension_days=0;
			if (!empty($extensions)) {
				foreach ($extensions as $row)
					$extension_days += $this->CalcDurationInDays($row['ExtendedFor'], $row['ExtendedPeriod']);
			}

			$info['current']['IsSet'] = true;
			$info['current']['StatusID'] = $data->StatusID;
			$info['current']['Description'] = $data->status->Description;
			$info['current']['StartedOn'] = $data->StartedOn;

			if ($data->DurationPeriod=='None') {
				$info['current']['ExtensionsTotalDays'] = 0;
				$info['current']['DaysTotal'] = 'None';
				$info['current']['DaysCompleted'] = 0;
				$info['current']['CompletedOn'] = '';
			}
			else {
				$total_days = $this->CalcDurationInDays($data->Duration, $data->DurationPeriod);
				$total_days += $extension_days;

				$info['current']['ExtensionsTotalDays'] = $extension_days;
				$info['current']['DaysTotal'] = $total_days;

				$info_completed = $this->CalcDaysCompleted($data->StartedOn, $total_days);

				$info['current']['DaysCompleted'] = $info_completed['interval'];
				$info['current']['CompletedOn'] = $info_completed['on'];
			}
		}
		else {
			$info['current']['IsSet'] = false;
			$info['current']['StatusID'] = 0;
			$info['current']['Description'] = 'Status Not Set';
			$info['current']['StartedOn'] = '';
			$info['current']['ExtensionsTotalDays'] = 0;
			$info['current']['DaysTotal'] = 0;
			$info['current']['DaysCompleted'] = 0;
		}

		/*
			get completed statuses
		*/
		$criteria=new CDbCriteria;
		$criteria->select='*';
		//$criteria->condition='applicantID=:applicantID AND CompletedOn IS NOT NULL';
		$criteria->condition='applicantID=:applicantID AND IsCompleted = 1';
		$criteria->params=array(':applicantID'=>$applicant_id);
		$criteria->order='status.ProcessPosition ASC';
		$criteria->with=array('status');

		$data = $this->findAll($criteria);

		$days_completed = 0;
		$tmp = array('Description'=>'Unknown','CompletedOn'=>NULL);

		if ($data) {
			foreach ($data as $row) {
				$info['completed'][$row->status->ProcessPosition]['Description'] = $row->status->Description;
				$info['completed'][$row->status->ProcessPosition]['StartedOn'] = $row->StartedOn;
				$info['completed'][$row->status->ProcessPosition]['CompletedOn'] = $row->CompletedOn;

				$tmp['Description'] = $row->status->Description;
				$tmp['CompletedOn'] = $row->CompletedOn;

				if ($row->status->IsProcess) {
					$days_completed = $this->CalcDurationInDays($row->status->Duration, $row->status->DurationPeriod);
				}
			}
		}
		$info['days_completed'] = $days_completed;

		if ($info['current']['IsSet'] == false) {
			$info['current']['Description'] = $tmp['Description'];
			$info['current']['StartedOn'] = $tmp['CompletedOn'];
		}


		// /*
		// 	get passport details
		// */
		// $criteria=new CDbCriteria;
		// $criteria->select='*';
		// $criteria->condition='applicantID=:applicantID';
		// $criteria->params=array(':applicantID'=>$applicant_id);
		// $criteria->with=array('passport');

		// $data = $this->findAll($criteria);
		// foreach ($data as $row) {
		// 	$info['passport'] = $row;
		// }

		// /*
		// 	get visa details
		// */
		// $criteria=new CDbCriteria;
		// $criteria->select='*';
		// $criteria->condition='applicantID=:applicantID';
		// $criteria->params=array(':applicantID'=>$applicant_id);
		// $criteria->with=array('visa');

		// $data = $this->findAll($criteria);
		// foreach ($data as $row) {
		// 	$info['visa'] = $row;
		// }

		return $info;
	}

	public function overdueStatuses() {
		$info = array();

		/*
			get the current status
		*/
		$criteria=new CDbCriteria;
		$criteria->select='*';  // only select the 'title' column
		//$criteria->condition='((CompletedOn IS NULL) OR (YEAR(CompletedOn) = 0))';
		$criteria->condition='(IsCompleted = 0)';
		//$criteria->params=array(':applicantID'=>$applicant_id);
		$criteria->with=array('applicant');

		$data = $this->findAll($criteria);

		if ($data) {
			foreach ($data as $item) {
				$total_days = $this->CalcDurationInDays($item->Duration, $item->DurationPeriod);

				$info_completed = $this->CalcDaysCompleted($item->StartedOn, $total_days);

				if ($info_completed['interval'] < 0) {
					$info[$item->applicant->ID]['ID'] = $item->applicant->ID;
					$info[$item->applicant->ID]['Name'] = $item->applicant->Name." ".$item->applicant->Surname;
					$info[$item->applicant->ID]['Status'] = $item->status->Description;
					$info[$item->applicant->ID]['CompletionDate'] = $info_completed['on'];
					$info[$item->applicant->ID]['DaysOverdue'] = abs($info_completed['interval']);
				}
			}
		}

		$dataProvider=new CArrayDataProvider($info, array(
		    'id'=>'applicant_status',
		    'keyField'=>'ID',
		    'sort'=>array(
		        'attributes'=>array(
		             'ID', 'Name' //, 'Status', 'CompletionDate', 'DaysOverdue',
		        ),
		        'defaultOrder'=>array(
 				   'Name'=>CSort::SORT_ASC,
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
