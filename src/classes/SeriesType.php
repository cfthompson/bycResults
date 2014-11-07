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
require_once(dirname(__FILE__).'/DivisionType.php');

/**
 * Description of SeriesType
 *
 * @author rfgunion
 */
class SeriesType extends Model {
	public $table = 'seriestypes';
	public $columns = array(
		'id',
		'name',
	);

	public function __get($name) {
		if ($name == 'divisions') {
			if ($this->id) {
				if (!array_key_exists('divisions', $this->data)) {
					$d = new DivisionType();
					$this->data['divisions'] = $d->findAll('seriestypeid='.$this->id);
				}
			} else {
				$this->data['divisions'] = array();
			}
			return $this->data['divisions'];
		}
		return parent::__get($name);
	}

	public function __set($name, $val) {
		if ($name == 'divisions') {
			$this->data['divisions'] = $val;
			return;
		}
		parent::__set($name, $val);
	}
}
