<?php

/**
 * This is the model class for table "passport".
 *
 * The followings are the available columns in table 'passport':
 * @property integer $ID
 * @property string $PassportNumber
 * @property string $IssuedDate
 * @property string $ValidTill
 * @property string $IssuedBy
 *
 * The followings are the available model relations:
 * @property Applicant[] $applicants
 */
class Passport extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Passport the static model class
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
		return 'passport';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PassportNumber', 'required'),
			array('PassportNumber, IssuedBy', 'length', 'max'=>32),
			array('IssuedDate, ValidTill', 'safe'),
			array('IssuedDate, ValidTill', 'default', 'setOnEmpty'=>true, 'value'=>null ),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, PassportNumber, IssuedDate, ValidTill, IssuedBy', 'safe', 'on'=>'search'),
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
			'applicants' => array(self::HAS_MANY, 'Applicant', 'PassportID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'PassportNumber' => 'Passport Number',
			'IssuedDate' => 'Issued Date',
			'ValidTill' => 'Valid Till',
			'IssuedBy' => 'Issued By',
		);
	}

    protected function afterFind()
    {
        // convert to display format
        $this->IssuedDate = Yii::app()->dateFormatter->format('dd-MM-yyyy', $this->IssuedDate);
        $this->ValidTill = Yii::app()->dateFormatter->format('dd-MM-yyyy', $this->ValidTill);

        parent::afterFind();
    }

    protected function afterSave()
    {
        // convert to display format
        $this->IssuedDate = Yii::app()->dateFormatter->format('dd-MM-yyyy', $this->IssuedDate);
        $this->ValidTill = Yii::app()->dateFormatter->format('dd-MM-yyyy', $this->ValidTill);

        parent::afterSave();
    }

    protected function beforeValidate()
    {
        if (empty($this->IssuedDate)) {
        	$this->IssuedDate = null;
        } else {
        	$this->IssuedDate = strtotime($this->IssuedDate);
        	$this->IssuedDate = date('Y-m-d', $this->IssuedDate);
        }

		if (empty($this->ValidTill)) {
			$this->ValidTill = null;
		} else {
        	$this->ValidTill = strtotime($this->ValidTill);
        	$this->ValidTill = date('Y-m-d', $this->ValidTill);
        }

        return parent::beforeValidate();
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
		$criteria->compare('PassportNumber',$this->PassportNumber,true);
		$criteria->compare('IssuedDate',$this->IssuedDate,true);
		$criteria->compare('ValidTill',$this->ValidTill,true);
		$criteria->compare('IssuedBy',$this->IssuedBy,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
