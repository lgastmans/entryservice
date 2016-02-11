<?php

/**
 * This is the model class for table "milestone_category".
 *
 * The followings are the available columns in table 'milestone_category':
 * @property integer $ID
 * @property integer $StatusID
 * @property string $Description
 * @property integer $Position
 *
 * The followings are the available model relations:
 * @property Milestone[] $milestones
 */
class MilestoneCategory extends CActiveRecord
{
	public $status_fs; // fs - filter & sort

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MilestoneCategory the static model class
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
		return 'milestone_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('StatusID, Description, Position', 'required'),
			array('StatusID, Position', 'numerical', 'integerOnly'=>true),
			array('Description', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('status_fs, ID, StatusID, Description, Position', 'safe', 'on'=>'search'),
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
			'milestones' => array(self::HAS_MANY, 'Milestone', 'MilestoneCategoryID'),
			'milestoneCategory' => array(self::BELONGS_TO, 'MilestoneCategory', 'MilestoneCategoryID'),
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
			'StatusID' => 'Status',
			'status_fs' => 'Status',
			'Description' => 'Description',
			'Position' => 'Position',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($status=false)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		if ($status!==false) {
			$criteria->condition='StatusID=:StatusID';
			$criteria->params=array('StatusID'=>$status);
		}

		if (isset($_GET['dropDownStatus'])) {
			$criteria->condition='StatusID=:StatusID';
			$criteria->params=array('StatusID'=>$_GET['dropDownStatus']);
			$criteria->order='Position ASC';
		}

		$criteria->compare('ID',$this->ID);
		$criteria->compare('StatusID',$this->StatusID);
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('Position',$this->Position);
		//$criteria->order = 'Position ASC';

		$criteria->with = array( 'status' );
		$criteria->compare('status.Description', $this->status_fs, true );

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
		        'attributes'=>array(
		            'status_fs'=>array(
		                'asc'=>'status.Description',
		                'desc'=>'status.Description DESC',
		            ),
		            '*',
		        ),
			    'defaultOrder'=>'status.Description ASC',			
		    ),
		));
	}
}