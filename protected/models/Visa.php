<?php

/**
 * This is the model class for table "visa".
 *
 * The followings are the available columns in table 'visa':
 * @property integer $ID
 * @property string $VisaType
 * @property string $Number
 * @property string $IssuedDate
 * @property string $ValidTill
 *
 * The followings are the available model relations:
 * @property Applicant[] $applicants
 */
class Visa extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Visa the static model class
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
		return 'visa';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('VisaType', 'required'),
			array('VisaType', 'length', 'max'=>9),
			array('Number', 'length', 'max'=>16),
			array('IssuedDate, ValidTill', 'safe'),
			array('IssuedDate, ValidTill', 'default', 'setOnEmpty'=>true, 'value'=>null ),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, VisaType, Number, IssuedDate, ValidTill', 'safe', 'on'=>'search'),
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
			'applicants' => array(self::HAS_MANY, 'Applicant', 'VisaID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'VisaType' => 'Visa Type',
			'Number' => 'Number',
			'IssuedDate' => 'Issued Date',
			'ValidTill' => 'Valid Till',
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

    protected function beforeValidate ()
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
		$criteria->compare('VisaType',$this->VisaType,true);
		$criteria->compare('Number',$this->Number,true);
		$criteria->compare('IssuedDate',$this->IssuedDate,true);
		$criteria->compare('ValidTill',$this->ValidTill,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}