<?php

/**
 * This is the model class for table "series".
 *
 * The followings are the available columns in table 'series':
 * @property string $id
 * @property string $typeid
 * @property string $name
 * @property string $defaultMethod
 * @property double $defaultParam1
 * @property double $defaultParam2
 *
 * The followings are the available model relations:
 * @property Races[] $races
 * @property Seriestypes $type
 */
class Series extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'series';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('typeid', 'required'),
			array('defaultParam1, defaultParam2', 'numerical'),
			array('typeid', 'length', 'max'=>10),
			array('name', 'length', 'max'=>40),
			array('defaultMethod', 'length', 'max'=>3),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, typeid, name, defaultMethod, defaultParam1, defaultParam2', 'safe', 'on'=>'search'),
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
			'races' => array(self::HAS_MANY, 'Races', 'seriesid', 'order'=>'racedate DESC'),
			'type' => array(self::BELONGS_TO, 'Seriestypes', 'typeid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'typeid' => 'Typeid',
			'name' => 'Name',
			'defaultMethod' => 'Default Method',
			'defaultParam1' => 'Default Param1',
			'defaultParam2' => 'Default Param2',
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
		$criteria->compare('typeid',$this->typeid,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('defaultMethod',$this->defaultMethod,true);
		$criteria->compare('defaultParam1',$this->defaultParam1);
		$criteria->compare('defaultParam2',$this->defaultParam2);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Series the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
