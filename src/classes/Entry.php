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
require_once(dirname(__FILE__).'/SQLiteModel.php');
require_once(dirname(__FILE__).'/Race.php');
require_once(dirname(__FILE__).'/Boat.php');

/**
 * Description of Entry
 *
 * @author rfgunion
 */
class Entry extends SQLiteModel {
	protected $table = 'entries';
	protected $columns = array(
		'id',
		'raceid',
		'boatid',
		'phrf',
		'finish',
		'spinnaker',
		'rollerFurling',
		'corrected',
		'tcf',
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
		return parent::__get($name);
	}

	public function save() {
		if (!array_key_exists('raceid', $this->data)
			|| !array_key_exists('boatid', $this->data)
			|| !array_key_exists('phrf', $this->data)
			|| !array_key_exists('finish', $this->data)) {
			return false;
		}
		return parent::save();
	}
}
