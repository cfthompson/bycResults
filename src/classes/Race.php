<?php

/*
 * Copyright (C) 2014 rfgunion.
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301  USA
 */
require_once(dirname(__FILE__).'/Model.php');
require_once(dirname(__FILE__).'/Series.php');
require_once(dirname(__FILE__).'/Entry.php');
require_once(dirname(__FILE__).'/Division.php');
require_once(dirname(__FILE__).'/DivisionType.php');

/**
 * Description of Race
 *
 * @author rfgunion
 */
class Race extends Model {
	protected $table = 'races';
	protected $columns = array(
		'id',
		'seriesid',
		'racedate',
		'rcboat',
		'rcskipper',
		'preparer',
	);

	public function __get($name) {
		if ($name == 'entries') {
			if (!array_key_exists('entries', $this->data)) {
				if ($this->id) {
					$entry = new Entry();
					$this->data['entries'] = $entry->findAll('raceid='.$this->id, 'corrected');
				} else {
					$this->data['entries'] = array();
				}
			}
			return $this->data['entries'];
		}
		if ($name == 'series') {
			if (!array_key_exists('series', $this->data)) {
				$this->data['series'] = new Series($this->seriesid);
			}
			return $this->data['series'];
		}
		if ($name == 'divisions') {
			if (!array_key_exists('divisions', $this->data)) {
				$this->data['divisions'] = array();
				if ($this->id) {
					$div = new Division();
					foreach ($div->findAll('raceid='.$this->id) as $d) {
						$this->data['divisions'][$d->id] = $d;
					}
				}
			}
			return $this->data['divisions'];
		}
		return parent::__get($name);
	}

	public function __set($name, $val) {
		if ($name == 'racedate') {
			$racedate = strtotime($val);
			$this->data['racedate'] = strftime('%Y-%m-%d', $racedate);
			return;
		}
		if ($name == 'entries') {
			// $val must be an array of either Entry instances or arrays
			$this->data['entries'] = array();
			foreach ($val as $entry) {
				if (is_a($entry, 'Entry')) {
					$this->data['entries'][] = $entry;
				} else { // array
					$this->data['entries'][] = new Entry($entry);
				}
			}
			return;
		}
		if ($name == 'series') {
			$this->data['series'] = new Series($this->seriesid);
			return;
		}
		if ($name == 'seriesid') {
			$this->data['seriesid'] = $val;
			$this->data['series'] = new Series($this->seriesid);
			return;
		}
		if ($name == 'divisions') {
			$this->data['divisions'] = $val;
			return;
		}
		parent::__set($name, $val);
	}

	public function save() {
		if (empty($this->racedate))
			return false;
		if (!$this->seriesid)
			return false;
		if (!parent::save()) {
			return false;
		}
		$result = true;
		foreach ($this->divisions as $d) {
			if (!$d->save())
				$result = false;
		}
		return $result;
	}

	public function saveNew() {
		if (!parent::saveNew()) {
			return false;
		}

		if (!array_key_exists('divisions', $this->data)) {
			$this->data['divisions'] = array();
			$dtype = new DivisionType();
			$dtypes = $dtype->findAll('seriestypeid='.$this->series->typeid);
			foreach ($dtypes as $dt) {
				$d = new Division(array(
					'raceid'=>$this->id,
					'starttime'=>$dt->defaultstarttime,
					'name'=>$dt->name,
					'minphrf'=>$dt->minphrf,
					'maxphrf'=>$dt->maxphrf,
					'minlength'=>$dt->minlength,
					'maxlength'=>$dt->maxlength,
				));
				if ($d->saveNew()) {
					$this->data['divisions'][$d->id] = $d;
				}
			}
		}
		return true;
	}
}
