<?php

/**
 * This is the model class for table "applicant_statistics".
 *
 * The followings are the available columns in table 'applicant_statistics':
 * @property integer $ID
 * @property integer $ApplicantID
 * @property integer $CategoryID
 * @property integer $AnswerID
 * @property string $DateRecorded
 * @property string $Notes
 *
 * The followings are the available model relations:
 * @property Applicant $applicant
 */
class ApplicantStatistics extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ApplicantStatistics the static model class
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
		return 'applicant_statistics';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ApplicantID, CategoryID, AnswerID, DateRecorded', 'required'),
			array('ApplicantID, CategoryID, AnswerID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, ApplicantID, CategoryID, AnswerID, DateRecorded, Notes', 'safe', 'on'=>'search'),
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
			//'stat_category' => array(self::BELONGS_TO, 'StatisticsCategory', 'CategoryID'),
			//'stat_answer' => array(self::BELONGS_TO, 'StatisticsAnswer', 'AnswerID'),
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
			'CategoryID' => 'Category',
			'AnswerID' => 'Answer',
			'DateRecorded' => 'Date Recorded',
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
		$criteria->compare('CategoryID',$this->CategoryID);
		$criteria->compare('AnswerID',$this->AnswerID);
		$criteria->compare('DateRecorded',$this->DateRecorded,true);
		$criteria->compare('Notes',$this->Notes,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}