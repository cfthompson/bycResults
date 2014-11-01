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

/**
 * Configuration settings for the BYC results program.
 * Simply a collection of properties.
 *
 * @author rfgunion
 */
class Config {
	public $dbfilename;
	public $hostname;
	public $username;
	public $password;
	public $database;
	public $user_timeout;

	public function __construct() {
		// Fill in your settings here
		$this->dbfilename = dirname(__FILE__).'/../data/bycresults.db';
		$this->hostname = 'localhost';
		$this->username = 'byc';
		$this->password = 'byc@1939';
		$this->database = 'sailresults';
		$this->user_timeout = '36000'; // 10 hours
	}
}
