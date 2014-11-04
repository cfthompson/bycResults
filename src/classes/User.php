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

/**
 * Description of User
 *
 * @author rfgunion
 */
class User extends Model {
	const NO_ACCESS = 0;
	const USER_ACCESS = 1;
	const ADMIN_ACCESS = 100;

	protected $table = 'users';
	protected $columns = array(
		'id',
		'uid',
		'fname',
		'lname',
		'email',
		'phone',
		'level',
		'tstamp',
		'passwd',
	);

	/* SQLite version: 
	public function findUser($uid, $pw) {
		$hash = crypt($pw, '$2y$12ienvhe.xhzieahdkfleyir');
		$where = "uid='$uid' AND passwd='$hash'";
		$users =  $this->findAll($where);
		if (!$users || empty($users)) return false;
		$this->data = $users[0]->data;
		return true;
	}
	 * 
	 */

	/* MySQL version: */
	public function findUser($uid, $pw) {
		$where = "uid='$uid' AND passwd=PASSWORD('$pw')";
		$users = $this->findAll($where);
		if (!$users || empty($users)) return false;
		$this->data = $users[0]->data;
		return true;
	}
}
