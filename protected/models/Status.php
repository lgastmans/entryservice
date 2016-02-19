<?php

/**
 * This is the model class for table "status".
 *
 * The followings are the available columns in table 'status':
 * @property integer $ID
 * @property string $Description
 * @property integer $Duration
 * @property string $DurationPeriod
 * @property integer $IsProcess
 * @property integer $ProcessPosition
 *
 * The followings are the available model relations:
 * @property MilestoneCategory[] $milestoneCategories
 * @property MilestoneCategory[] $milestoneCategories1
 */
class Status extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Status the static model class
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
		return 'status';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Description, IsProcess', 'required'),
			array('Duration, IsProcess, ProcessPosition', 'numerical', 'integerOnly'=>true),
			array('Description', 'length', 'max'=>64),
			array('DurationPeriod', 'length', 'max'=>6),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, Description, Duration, DurationPeriod, IsProcess, ProcessPosition', 'safe', 'on'=>'search'),
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
			'milestoneCategories' => array(self::HAS_MANY, 'MilestoneCategory', 'StatusID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'Description' => 'Description',
			'Duration' => 'Duration',
			'DurationPeriod' => 'Duration Period',
			'IsProcess' => 'This status is part of the newcomer process',
			'ProcessPosition' => 'Status position',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($filter_process=false)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		if ($filter_process) {
			$criteria->condition='IsProcess=:IsProcess';
			$criteria->params=array('IsProcess'=>true);
			$criteria->order='ProcessPosition ASC';
		}
		// else
		// 	$criteria->order='Description ASC';

		$criteria->compare('ID',$this->ID);
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('Duration',$this->Duration);
		$criteria->compare('DurationPeriod',$this->DurationPeriod,true);
		$criteria->compare('IsProcess',$this->IsProcess,true);
		$criteria->compare('ProcessPosition',$this->ProcessPosition,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'Description ASC',
			),
		));
	}

}
