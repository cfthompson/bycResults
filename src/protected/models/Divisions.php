<?php

/**
 * This is the model class for table "divisions".
 *
 * The followings are the available columns in table 'divisions':
 * @property string $id
 * @property string $raceid
 * @property string $typeid
 * @property string $starttime
 * @property string $courseid
 * @property double $distance
 * @property integer $minphrf
 * @property integer $maxphrf
 * @property integer $minlength
 * @property integer $maxlength
 * @property string $name
 *
 * The followings are the available model relations:
 * @property Races $race
 * @property Divisiontypes $type
 * @property Courses $course
 * @property Entries[] $entries
 */
class Divisions extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'divisions';
	}

	public function __get($name) {
		if ($name == 'description') {
			$desc = '';
			if (!is_null($this->minphrf)) {
				$desc .= 'PHRF '.$this->minphrf;
				if (!is_null($this->maxphrf)) {
					$desc .= ' to '.$this->maxphrf;
				} else {
					$desc .= ' and above';
				}
			} else if (!is_null($this->maxphrf)) {
				$desc .= 'PHRF '.$this->maxphrf.' and below';
			}
			if (!is_null($this->minlength)) {
				if (!empty($desc)) $desc .= '; ';
				$desc .= 'Length '.$this->minlength;
				if (!is_null($this->maxlength)) {
					$desc .= ' to '.$this->maxlength;
				} else {
					$desc .= ' and above';
				}
			} else if (!is_null($this->maxlength)) {
				if (!empty($desc)) $desc .= '; ';
				$desc .= 'Length '.$this->maxlength.' and below';
			}
			return $desc;
		}
		return parent::__get($name);
	}

/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('raceid, typeid, starttime, courseid, distance', 'required'),
			array('minphrf, maxphrf, minlength, maxlength', 'numerical', 'integerOnly'=>true),
			array('distance', 'numerical'),
			array('raceid, courseid', 'length', 'max'=>11),
			array('typeid', 'length', 'max'=>10),
			array('name', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, raceid, typeid, starttime, courseid, distance, minphrf, maxphrf, minlength, maxlength, name', 'safe', 'on'=>'search'),
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
			'race' => array(self::BELONGS_TO, 'Races', 'raceid'),
			'type' => array(self::BELONGS_TO, 'Divisiontypes', 'typeid'),
			'course' => array(self::BELONGS_TO, 'Courses', 'courseid'),
			'entries' => array(self::HAS_MANY, 'Entries', 'divisionid', 'order'=>'entries.status, entries.corrected'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'raceid' => 'Raceid',
			'typeid' => 'Typeid',
			'starttime' => 'Starttime',
			'courseid' => 'Course',
			'distance' => 'Distance',
			'minphrf' => 'Minphrf',
			'maxphrf' => 'Maxphrf',
			'minlength' => 'Minlength',
			'maxlength' => 'Maxlength',
			'name' => 'Name',
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
		$criteria->compare('raceid',$this->raceid,true);
		$criteria->compare('typeid',$this->typeid,true);
		$criteria->compare('starttime',$this->starttime,true);
		$criteria->compare('courseid',$this->courseid,true);
		$criteria->compare('distance',$this->distance);
		$criteria->compare('minphrf',$this->minphrf);
		$criteria->compare('maxphrf',$this->maxphrf);
		$criteria->compare('minlength',$this->minlength);
		$criteria->compare('maxlength',$this->maxlength);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Divisions the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
