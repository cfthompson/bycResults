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
require_once('classes/Config.php');
require_once('classes/User.php');

session_start('byc');

function getAccessLevel() {
	if (!array_key_exists('bycuserid', $_SESSION)) {
		return User::NO_ACCESS;
	}
	$config = new Config();
	$tlimit = time() - $config->user_timeout;
	$user = new User($_SESSION['bycuserid']);
	$tstamp = strtotime($user->tstamp);
	if ($tstamp >= $tlimit) {
		return $user->level;
	}
	return User::NO_ACCESS;
}

function login($uid, $pw) {
	$user = new User();
	if (!$user->findUser($uid, $pw)) {
		return User::NO_ACCESS;
	}
	$now = new DateTime();
	$user->tstamp = $now->format('Y-m-d H:M:S');
	$user->save();
	return $user->level;
}

?>