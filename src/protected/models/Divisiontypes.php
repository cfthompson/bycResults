<?php

/**
 * This is the model class for table "divisiontypes".
 *
 * The followings are the available columns in table 'divisiontypes':
 * @property string $id
 * @property string $seriestypeid
 * @property string $defaultstarttime
 * @property string $name
 * @property integer $minphrf
 * @property integer $maxphrf
 * @property integer $minlength
 * @property integer $maxlength
 *
 * The followings are the available model relations:
 * @property Divisions[] $divisions
 * @property Seriestypes $seriestype
 */
class Divisiontypes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'divisiontypes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('seriestypeid, defaultstarttime', 'required'),
			array('minphrf, maxphrf, minlength, maxlength', 'numerical', 'integerOnly'=>true),
			array('seriestypeid', 'length', 'max'=>11),
			array('name', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, seriestypeid, defaultstarttime, name, minphrf, maxphrf, minlength, maxlength', 'safe', 'on'=>'search'),
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
			'divisions' => array(self::HAS_MANY, 'Divisions', 'typeid'),
			'seriestype' => array(self::BELONGS_TO, 'Seriestypes', 'seriestypeid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'seriestypeid' => 'Seriestypeid',
			'defaultstarttime' => 'Defaultstarttime',
			'name' => 'Name',
			'minphrf' => 'Minphrf',
			'maxphrf' => 'Maxphrf',
			'minlength' => 'Minlength',
			'maxlength' => 'Maxlength',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('seriestypeid',$this->seriestypeid,true);
		$criteria->compare('defaultstarttime',$this->defaultstarttime,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('minphrf',$this->minphrf);
		$criteria->compare('maxphrf',$this->maxphrf);
		$criteria->compare('minlength',$this->minlength);
		$criteria->compare('maxlength',$this->maxlength);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Divisiontypes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
