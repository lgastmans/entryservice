<?php

/**
 * This is the model class for table "absence".
 *
 * The followings are the available columns in table 'absence':
 * @property integer $ID
 * @property integer $ApplicantID
 * @property integer $StatusID
 * @property string $AbsentOn
 * @property string $AbsentTill
 *
 * The followings are the available model relations:
 * @property Applicant $applicant
 */
class Absence extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Absence the static model class
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
		return 'absence';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ApplicantID, StatusID, AbsentOn, AbsentTill', 'required'),
			array('ApplicantID, StatusID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, ApplicantID, StatusID, AbsentOn, AbsentTill', 'safe', 'on'=>'search'),
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
			'AbsentOn' => 'Absent On',
			'AbsentTill' => 'Absent Till',
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
		$criteria->compare('AbsentOn',$this->AbsentOn,true);
		$criteria->compare('AbsentTill',$this->AbsentTill);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    protected function afterFind()
    {
        // convert to display format
        $this->AbsentOn = Yii::app()->dateFormatter->format('dd-MM-yyyy', $this->AbsentOn);
        $this->AbsentTill = Yii::app()->dateFormatter->format('dd-MM-yyyy', $this->AbsentTill);

        parent::afterFind();
    }

    protected function beforeValidate ()
    {
        $this->AbsentOn = strtotime($this->AbsentOn);
        $this->AbsentOn = date('Y-m-d', $this->AbsentOn);

        $this->AbsentTill = strtotime($this->AbsentTill);
        $this->AbsentTill = date('Y-m-d', $this->AbsentTill);

        return parent::beforeValidate ();
    }

    protected function beforeSave()
    {
    	if (($this->AbsentOn == "") || ($this->AbsentOn == '1970-01-01')) {
    	    $this->AbsentOn = null;
	    }
    	if (($this->AbsentTill == "") || ($this->AbsentTill == '1970-01-01')) {
    	    $this->AbsentTill = null;
	    }

	    return parent::beforeSave();
    }	
}