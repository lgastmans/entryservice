<?php

/**
 * This is the model class for table "nationality".
 *
 * The followings are the available columns in table 'nationality':
 * @property integer $ID
 * @property string $Code
 * @property string $Nationality
 * @property string $Currency
 * @property string $Capital
 * @property string $Continent
 *
 * The followings are the available model relations:
 * @property Applicant[] $applicants
 */
class Nationality extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Nationality the static model class
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
		return 'nationality';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Code', 'length', 'max'=>2),
			array('Nationality', 'length', 'max'=>45),
			array('Currency', 'length', 'max'=>3),
			array('Capital', 'length', 'max'=>30),
			array('Continent', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, Code, Nationality, Currency, Capital, Continent', 'safe', 'on'=>'search'),
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
			'applicants' => array(self::HAS_MANY, 'Applicant', 'NationalityID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'Code' => 'Code',
			'Nationality' => 'Nationality',
			'Currency' => 'Currency',
			'Capital' => 'Capital',
			'Continent' => 'Continent',
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
		$criteria->compare('Code',$this->Code,true);
		$criteria->compare('Nationality',$this->Nationality,true);
		$criteria->compare('Currency',$this->Currency,true);
		$criteria->compare('Capital',$this->Capital,true);
		$criteria->compare('Continent',$this->Continent,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}