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
require_once('Model.php');

/**
 * Description of Division
 *
 * @author rfgunion
 */
class Division extends Model {
	public $table = 'divisions';
	public $columns = array(
		'id',
		'raceid',
		'typeid',
		'starttime',
		'course',
		'distance',
		'name',
		'minphrf',
		'maxphrf',
		'minlength',
		'maxlength',
	);

	public function __set($name, $val) {
		if (in_array($name, array(
			'course',
			'distance',
			'minphrf',
			'maxphrf',
			'minlength',
			'maxlength',
		))) {
			if (empty($val)) {
				$this->data[$name] = null;
				return;
			}
		}
		parent::__set($name, $val);
	}

	public function __get($name) {
		if ($name == 'description') {
			if (!array_key_exists('description', $this->data)) {
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
				$this->data['description'] = $desc;
			}
			return $this->data['description'];
		}
		return parent::__get($name);
	}
}
