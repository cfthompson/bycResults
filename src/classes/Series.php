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
require_once(dirname(__FILE__).'/SeriesType.php');
require_once(dirname(__FILE__).'/Race.php');

/**
 * Description of Series
 *
 * @author rfgunion
 */
class Series extends Model {
	public $table = 'series';
	public $columns = array(
		'id',
		'typeid',
		'name',
		'defaultMethod',
		'defaultParam1',
		'defaultParam2',
	);

	public function __get($name) {
		if ($name == 'type') {
			if (!array_key_exists('type', $this->data)) {
				$this->data['type'] = new SeriesType($this->typeid);
			}
			return $this->data['type'];
		}
		if ($name == 'races') {
			if (!array_key_exists('races', $this->data)) {
				$race = new Race();
				$this->data['races'] = $race->findAll('seriesid='.$this->id, 'racedate DESC');
			}
		}
		return parent::__get($name);
	}

	public function __set($name, $val) {
		if (in_array($name, array( 'defaultParam1', 'defaultParam2',)) && empty($val)) {
			$this->data[$name] = null;
			return;
		}
		if ($name == 'type') {
			$this->data['type'] = new SeriesType($this->typeid);
			return;
		}
		parent::__set($name, $val);
		if ($name == 'typeid') {
			$this->data['type'] = new SeriesType($this->data['typeid']);
			return;
		}
	}

}
