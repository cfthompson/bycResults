<?php

/**
 * This is the model class for table "races".
 *
 * The followings are the available columns in table 'races':
 * @property string $id
 * @property string $seriesid
 * @property string $racedate
 * @property string $rcboat
 * @property string $rcskipper
 * @property string $preparer
 * @property string $method
 * @property double $param1
 * @property double $param2
 *
 * The followings are the available model relations:
 * @property Divisions[] $divisions
 * @property Entries[] $entries
 * @property Series $series
 */
class Races extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'races';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('seriesid, racedate', 'required'),
			array('param1, param2', 'numerical'),
			array('seriesid', 'length', 'max'=>11),
			array('rcboat, rcskipper, preparer', 'length', 'max'=>30),
			array('method', 'length', 'max'=>3),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, seriesid, racedate, rcboat, rcskipper, preparer, method, param1, param2', 'safe', 'on'=>'search'),
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
			'divisions' => array(self::HAS_MANY, 'Divisions', 'raceid', 'order'=>'divisions.starttime'),
			'entries' => array(self::HAS_MANY, 'Entries', 'raceid', 'order'=>'entries.divisionid, entries.corrected'),
			'series' => array(self::BELONGS_TO, 'Series', 'seriesid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'seriesid' => 'Series',
			'racedate' => 'Date',
			'rcboat' => 'RC Boat',
			'rcskipper' => 'RC Skipper',
			'preparer' => 'Prepared by',
			'method' => 'Method',
			'param1' => 'Parameter 1',
			'param2' => 'Parameter 2',
		);
	}

	/**
	 * Override of CActiveRecord::save
	 */
	public function save($performValidation=true, $attributes=NULL) {
		$isNew = $this->isNewRecord;
		if (!parent::save($performValidation, $attributes)) {
			return false;
		}
		if ($isNew) {
			
		}
		return true;
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
		$criteria->compare('seriesid',$this->seriesid,true);
		$criteria->compare('racedate',$this->racedate,true);
		$criteria->compare('rcboat',$this->rcboat,true);
		$criteria->compare('rcskipper',$this->rcskipper,true);
		$criteria->compare('preparer',$this->preparer,true);
		$criteria->compare('method',$this->method,true);
		$criteria->compare('param1',$this->param1);
		$criteria->compare('param2',$this->param2);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Races the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
