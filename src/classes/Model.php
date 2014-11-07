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

require_once('Config.php');

/**
 * Base class of model classes.  Provides very basic database connectivity
 *
 * @author rfgunion
 */
class Model {

	private static $conn = false;

	protected static function db() {
		if (Model::$conn === false) {
			$cfg = new Config();
			Model::$conn = new mysqli($cfg->hostname, $cfg->username, $cfg->password, $cfg->database);
			if (Model::$conn->connect_error) {
				die('Connect error.  Please check configuration and database connectivity');
			}
		}
		return Model::$conn;
	}

	protected $table = '';
	protected $columns = array();
	protected $data = array();

	public function __construct($idOrRow=false) {
		if (is_numeric($idOrRow)) {
			$this->find($idOrRow);
		} else if (is_array($idOrRow)) {
			foreach ($this->columns as $col) {
				if (array_key_exists($col, $idOrRow))
					$this->$col = $idOrRow[$col];
			}
		}
	}

	public function __set($name, $val) {
		if (!in_array($name, $this->columns)) {
			return;
		}
		$this->data[$name] = $this->escape($val);
	}

	public function __get($name) {
		if (array_key_exists($name, $this->data)) {
			return $this->data[$name];
		}
		return false;
	}

	public function __isset($name) {
		return array_key_exists($name, $this->data);
	}

	protected function query($sql) {
		$conn = Model::db();
		$result = $conn->query($sql);
		return $result;
	}

	protected function escape($str) {
		$conn = Model::db();
		return $conn->real_escape_string($str);
	}

	public function save() {
		$conn = Model::db();
		if ($this->id == 0) return $this->saveNew();
		$sets = array();
		foreach ($this->columns as $col) {
			if ($col == 'id') continue;
			if (!array_key_exists($col, $this->data)) continue;
			$sets[] = "$col='{$this->data[$col]}'";
		}
		$sql = "UPDATE {$this->table} SET ".implode(', ', $sets)." WHERE id={$this->data['id']}";
		$conn->query($sql);
		return $conn->errno == 0;
	}

	public function saveNew() {
		$conn = Model::db();
		$cols = array();
		$vals = array();
		foreach ($this->columns as $col) {
			if ($col == 'id') continue;
			if (!array_key_exists($col, $this->data)) continue;
			$cols[] = "`$col`";
			$vals[] = "'{$this->data[$col]}'";
		}
		$sql = "INSERT INTO {$this->table} (".implode(', ', $cols).") VALUES (".implode(', ', $vals).")";
		$conn->query($sql);
		$this->id = $conn->insert_id;
		return $conn->errno == 0;
	}

	public function find($id) {
		if (!is_numeric($id)) {
			return false;
		}
		$conn = Model::db();
		$sql = "SELECT * FROM {$this->table} WHERE id=$id";
		$result = $conn->query($sql);
		if (!$result) return false;
		$row = $result->fetch_assoc();
		foreach ($this->columns as $col) {
			$this->$col = $row[$col];
		}
		$result->close();
		return true;
	}

	public function findAll($where='', $orderby='') {
		$conn = Model::db();
		$sql = "SELECT * FROM {$this->table}";
		if (!empty($where)) $sql .= " WHERE $where";
		if (!empty($orderby)) $sql .= " ORDER BY $orderby";
		$result = $conn->query($sql);
		if (!$result) return array();
		$ref = new ReflectionClass($this);
		$objs = array();
		foreach ($result as $row) {
			$objs[] = $ref->newInstanceArgs([$row]);
		}
		return $objs;
	}
}
