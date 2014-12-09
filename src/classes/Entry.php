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
require_once(dirname(__FILE__).'/Race.php');
require_once(dirname(__FILE__).'/Boat.php');
require_once(dirname(__FILE__).'/Division.php');

/**
 * Description of Entry
 *
 * @author rfgunion
 */
class Entry extends Model {
	protected $table = 'entries';
	protected $columns = array(
		'id',
		'raceid',
		'boatid',
		'divisionid',
		'phrf',
		'finish',
		'spinnaker',
		'rollerFurling',
		'tcf',
		'corrected',
		'status',
	);
	protected $boatcolumns = array(
		'name',
		'sail',
		'model',
	);
	protected $racecolumns = array(
		'racedate',
		'type',
	);

	public function __set($name, $val) {
		if ($name == 'race') {
			$this->data['race'] = $val;
			return;
		}
		parent::__set($name, $val);
	}

	public function __get($name) {
		if ($name == 'boat' && $this->boatid) {
			if (!array_key_exists('boat', $this->data))
				$this->data['boat'] = new Boat($this->boatid);
			return $this->data['boat'];
		}
		if ($name == 'race' && $this->raceid) {
			if (!array_key_exists('race', $this->data))
				$this->data['race'] = new Race($this->raceid);
			return $this->data['race'];
		}
		if (in_array($name, $this->boatcolumns) && $this->boatid) {
			if (!array_key_exists('boat', $this->data)) {
				$this->data['boat'] = new Boat($this->boatid);
			}
			return $this->boat->$name;
		} elseif (in_array($name, $this->racecolumns) && $this->raceid) {
			if (!array_key_exists('race', $this->data)) {
				$this->data['race'] = new Race($this->raceid);
			}
			return $this->race->$name;
		}
		if ($name == 'division' && $this->divisionid) {
			if (!array_key_exists('division', $this->data)) {
				$this->data['division'] = new Division($this->divisionid);
			}
			return $this->data['division'];
		}
		if ($name == 'tcf') {
			if ($this->status) return false;
			$this->calcTCF();
			return $this->data['tcf'];
		}
		if ($name == 'corrected') {
			if ($this->status) return false;
			$this->calcCorrected();
			return $this->data['corrected'];
		}
		if ($name == 'phrfAsSailed') {
			if ($this->race->method !== 'TOD')
				return $this->phrf;
			if ($this->status)
				return $this->phrf;
			$phrf = $this->phrf;
			if (!$this->spinnaker) $phrf += 18;
			if ($this->rollerFurling) $phrf += 12;
			return $phrf;
		}

		return parent::__get($name);
	}

	protected function calcTCF($force=false) {
		if ($this->status)
			return; // DNF or DSQ: no tcf
		if (!$this->race)
			return; // can't calculate without a race
		if ($this->race->method !== 'TOT')
			return; // no tcf for time-on-time
		if ($force || !array_key_exists('tcf', $this->data)) {
			$tcf = $this->race->param1/($this->race->param2+$this->phrf);
			$spincredit = $this->spinnaker ? 0 : 0.04*$tcf;
			$rfcredit = $this->rollerFurling ? 0.02*$tcf : 0;
			$this->data['tcf'] = $tcf - $spincredit - $rfcredit;
		}
	}

	protected function timeToSeconds($timestr) {
		$h = substr($timestr, 0, 2);
		$m = substr($timestr, 3, 2);
		$s = substr($timestr, 6, 2);
		$seconds = ($h * 3600) + ($m * 60) + $s;
		return $seconds;
	}

	protected function calcCorrected($force=false) {
		if ($this->status)
			return;
		if (!$this->race)
			return;
		if ($force || !array_key_exists('corrected', $this->data)) {
			$this->calcTCF($force);
			$starttime = $this->timeToSeconds($this->division->starttime);
			$finishtime = $this->timeToSeconds($this->finish);
			$elapsed = $finishtime - $starttime;
			if ($this->race->method === 'TOT')
				$corrected = $elapsed * $this->data['tcf'];
			else {
				$corrected = $elapsed - ($this->division->distance * $this->phrfAsSailed);
			}
			$h = intval($corrected/3600);
			$corrected -= $h*3600;
			$m = intval($corrected/60);
			$corrected -= $m*60;
			$s = $corrected;
			$this->data['corrected'] = sprintf("%d:%02d:%.02f", $h, $m, $s);
		}
	}

	public function save($forceRecalc = false) {
		if (!array_key_exists('raceid', $this->data)
			|| !array_key_exists('boatid', $this->data)
			|| !array_key_exists('divisionid', $this->data)
			|| !array_key_exists('phrf', $this->data)
			|| !array_key_exists('finish', $this->data)) {
			return false;
		}
		$this->calcCorrected($forceRecalc);
		return parent::save();
	}
}
