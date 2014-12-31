<?php

/**
 * This is the model class for table "boats".
 *
 * The followings are the available columns in table 'boats':
 * @property string $id
 * @property string $timestamp
 * @property string $sail
 * @property string $name
 * @property string $model
 * @property integer $phrf
 * @property integer $FridayNightClass
 * @property integer $rollerFurling
 * @property string $skipper
 * @property string $email
 * @property string $phone
 * @property integer $length
 *
 * The followings are the available model relations:
 * @property Entries[] $entries
 */
class Boats extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'boats';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sail, name, phrf, length', 'required'),
			array('phrf, FridayNightClass, rollerFurling, length', 'numerical', 'integerOnly'=>true),
			array('sail', 'length', 'max'=>40),
			array('name, model, skipper, email, phone', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, timestamp, sail, name, model, phrf, FridayNightClass, rollerFurling, skipper, email, phone, length', 'safe', 'on'=>'search'),
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
			'entries' => array(self::HAS_MANY, 'Entries', 'boatid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'timestamp' => 'Timestamp',
			'sail' => 'Sail #',
			'name' => 'Name',
			'model' => 'Type',
			'phrf' => 'PHRF',
			'FridayNightClass' => 'Friday Night Class',
			'rollerFurling' => 'Roller Furling?',
			'skipper' => 'Skipper',
			'email' => 'Email',
			'phone' => 'Phone',
			'length' => 'Length',
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
		$criteria->compare('timestamp',$this->timestamp,true);
		$criteria->compare('sail',$this->sail,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('model',$this->model,true);
		$criteria->compare('phrf',$this->phrf);
		$criteria->compare('FridayNightClass',$this->FridayNightClass);
		$criteria->compare('rollerFurling',$this->rollerFurling);
		$criteria->compare('skipper',$this->skipper,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('length',$this->length);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>false,
			'sort'=>array(
				'defaultOrder'=>'name',
			),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Boats the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
