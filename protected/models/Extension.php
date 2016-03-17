<?php

/**
 * This is the model class for table "extension".
 *
 * The followings are the available columns in table 'extension':
 * @property integer $ID
 * @property integer $ApplicantID
 * @property integer $StatusID
 * @property string $ExtendedOn
 * @property integer $ExtendedFor
 * @property string $ExtendedPeriod
 *
 * The followings are the available model relations:
 * @property Applicant $applicant
 */
class Extension extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Extension the static model class
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
		return 'extension';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ApplicantID, StatusID, ExtendedOn, ExtendedFor, ExtendedPeriod', 'required'),
			array('ApplicantID, StatusID, ExtendedFor', 'numerical', 'integerOnly'=>true),
			array('ExtendedPeriod', 'length', 'max'=>6),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, ApplicantID, StatusID, ExtendedOn, ExtendedFor, ExtendedPeriod', 'safe', 'on'=>'search'),
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
			'status' => array(self::BELONGS_TO, 'Status', 'StatusID'),
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
			'StatusID' => 'Status',
			'ExtendedOn' => 'Extended On',
			'ExtendedFor' => 'Extended For',
			'ExtendedPeriod' => 'Extended Period',
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
		$criteria->compare('StatusID',$this->StatusID);
		$criteria->compare('ExtendedOn',$this->ExtendedOn,true);
		$criteria->compare('ExtendedFor',$this->ExtendedFor);
		$criteria->compare('ExtendedPeriod',$this->ExtendedPeriod,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    protected function afterFind()
    {
        // convert to display format
        $this->ExtendedOn = Yii::app()->dateFormatter->format('dd-MM-yyyy', $this->ExtendedOn);

        parent::afterFind();
    }

    protected function beforeValidate ()
    {
        $this->ExtendedOn = strtotime($this->ExtendedOn);
        $this->ExtendedOn = date('Y-m-d', $this->ExtendedOn);

        return parent::beforeValidate ();
    }

    protected function beforeSave()
    {
    	if (($this->ExtendedOn == "") || ($this->ExtendedOn == '1970-01-01')) {
    	    $this->ExtendedOn = null;
	    }

	    return parent::beforeSave();
    }

	public function statusExtensions($applicant_id, $status_id) {
		$info = array();

		$criteria=new CDbCriteria;
		$criteria->select='*';
		$criteria->condition='applicantID=:applicantID AND StatusID=:statusID';
		$criteria->params=array(':applicantID'=>$applicant_id, ':statusID'=>$status_id);

		$data = $this->findAll($criteria);

		$i=0;
		foreach ($data as $row) {
			$info[$i]['ExtendedFor'] = $row->ExtendedFor;
			$info[$i]['ExtendedPeriod'] = $row->ExtendedPeriod;
			$i++;
		}

		return $info;
	}

}