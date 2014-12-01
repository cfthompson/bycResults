<?php

/**
 * This is the model class for table "entries".
 *
 * The followings are the available columns in table 'entries':
 * @property string $id
 * @property string $raceid
 * @property string $boatid
 * @property string $divisionid
 * @property integer $phrf
 * @property string $finish
 * @property integer $spinnaker
 * @property integer $rollerFurling
 * @property double $tcf
 * @property string $corrected
 * @property string $status
 *
 * The followings are the available model relations:
 * @property Races $race
 * @property Boats $boat
 * @property Divisions $division
 */
class Entries extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'entries';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('raceid, boatid, divisionid, phrf', 'required'),
			array('phrf', 'numerical', 'integerOnly'=>true),
			array('spinnaker, rollerFurling', 'boolean'),
			array('tcf', 'numerical'),
			array('raceid, boatid', 'length', 'max'=>10),
			array('divisionid', 'length', 'max'=>11),
			array('status', 'length', 'max'=>3),
			array('finish, corrected', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, raceid, boatid, divisionid, phrf, finish, spinnaker, rollerFurling, tcf, corrected, status', 'safe', 'on'=>'search'),
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
			'boat' => array(self::BELONGS_TO, 'Boats', 'boatid'),
			'division' => array(self::BELONGS_TO, 'Divisions', 'divisionid'),
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
			'boatid' => 'Boatid',
			'divisionid' => 'Divisionid',
			'phrf' => 'Phrf',
			'finish' => 'Finish',
			'spinnaker' => 'Spinnaker',
			'rollerFurling' => 'Roller Furling',
			'tcf' => 'Tcf',
			'corrected' => 'Corrected',
			'status' => 'Status',
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
		$criteria->compare('boatid',$this->boatid,true);
		$criteria->compare('divisionid',$this->divisionid,true);
		$criteria->compare('phrf',$this->phrf);
		$criteria->compare('finish',$this->finish,true);
		$criteria->compare('spinnaker',$this->spinnaker);
		$criteria->compare('rollerFurling',$this->rollerFurling);
		$criteria->compare('tcf',$this->tcf);
		$criteria->compare('corrected',$this->corrected,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	protected function calcTCF($force=false) {
		if ($this->status)
			return; // DNF or DSQ: no tcf
		if (!$this->race)
			return; // can't calculate without a race
		if ($this->race->method !== 'TOT')
			return; // no tcf for time-on-distance
		if ($force || !$this->tcf) {
			$tcf = $this->race->param1/($this->race->param2+$this->phrf);
			$spincredit = $this->spinnaker ? 0 : 0.04*$tcf;
			$rfcredit = $this->rollerFurling ? 0.02*$tcf : 0;
			$this->tcf = $tcf - $spincredit - $rfcredit;
		}
	}

	protected function timeToSeconds($timestr) {
		$h = substr($timestr, 0, 2);
		$m = substr($timestr, 3, 2);
		$s = substr($timestr, 6, 2);
		$seconds = ($h * 3600) + ($m * 60) + $s;
		return $seconds;
	}

	public function phrfAsSailed() {
		if ($this->race->method !== 'TOD')
			return $this->phrf;
		if ($this->status)
			return $this->phrf;
		$phrf = $this->phrf;
		if (!$this->spinnaker) $phrf += 18;
		if ($this->rollerFurling) $phrf += 12;
		return $phrf;
	}

	protected function calcCorrected($force=false) {
		if ($this->status)
			return;
		if (!$this->race)
			return;
		if ($force || !$this->corrected) {
			$this->calcTCF($force);
			$starttime = $this->timeToSeconds($this->division->starttime);
			$finishtime = $this->timeToSeconds($this->finish);
			$elapsed = $finishtime - $starttime;
			if ($this->race->method === 'TOT')
				$corrected = $elapsed * $this->tcf;
			else {
				$corrected = $elapsed - ($this->division->distance * $this->phrfAsSailed());
			}
			$h = intval($corrected/3600);
			$corrected -= $h*3600;
			$m = intval($corrected/60);
			$corrected -= $m*60;
			$s = $corrected;
			$this->corrected = sprintf("%d:%02d:%.02f", $h, $m, $s);
		}
	}

	public function save($runValidation = true, $attributes = null) {
		$this->calcCorrected(true);
		return parent::save($runValidation, $attributes);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Entries the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
