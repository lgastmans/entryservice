<?php

/**
 * This is the model class for table "work".
 *
 * The followings are the available columns in table 'work':
 * @property integer $ID
 * @property integer $ApplicantID
 * @property string $Place
 * @property string $FromDate
 * @property string $ToDate
 * @property string $Notes
 */
class Work extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Work the static model class
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
		return 'work';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ApplicantID, Place', 'required'),
			array('ApplicantID', 'numerical', 'integerOnly'=>true),
			array('Place', 'length', 'max'=>64),
			array('Notes, FromDate, ToDate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, ApplicantID, Place, FromDate, ToDate, Notes', 'safe', 'on'=>'search'),
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
			'Place' => 'Place',
			'FromDate' => 'From Date',
			'ToDate' => 'To Date',
			'Notes' => 'Notes',
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
		$criteria->compare('Place',$this->Place,true);
		$criteria->compare('FromDate',$this->FromDate,true);
		$criteria->compare('ToDate',$this->ToDate,true);
		$criteria->compare('Notes',$this->Notes,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
		        'attributes'=>array(
		            '*',
		        ),
			    'defaultOrder'=>'FromDate ASC',			
		    ),
		));
	}

    protected function afterFind()
    {
        // convert to display format
        $this->FromDate = Yii::app()->dateFormatter->format('dd-MM-yyyy', $this->FromDate);
        $this->ToDate = Yii::app()->dateFormatter->format('dd-MM-yyyy', $this->ToDate);

        parent::afterFind();
    }

    protected function beforeValidate ()
    {
        $this->FromDate = strtotime($this->FromDate);
        $this->FromDate = date('Y-m-d', $this->FromDate);

        $this->ToDate = strtotime($this->ToDate);
        $this->ToDate = date('Y-m-d', $this->ToDate);

        return parent::beforeValidate ();
    }

    protected function beforeSave()
    {
    	if (($this->FromDate == "") || ($this->FromDate == '1970-01-01')) {
    	    $this->FromDate = null;
	    }
    	if (($this->ToDate == "") || ($this->ToDate == '1970-01-01')) {
    	    $this->ToDate = null;
	    }

	    return parent::beforeSave();
    }	
}