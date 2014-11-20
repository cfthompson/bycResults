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
require_once('auth.php');

$msg = '';
$msg_uid = '';
$msg_pw = '';
function parseLoginForm() {
	global $msg, $msg_uid, $msg_pw;
	if (!array_key_exists('login', $_POST)) {
		$msg = 'Please enter username and password';
		return;
	}

	$login = $_POST['login'];
	if (!array_key_exists('uid', $login)) {
		$msg_uid = 'Username cannot be blank';
		return;
	}
	if (!array_key_exists('pw', $login)) {
		$msg_uid = 'Password cannot be blank';
		return;
	}

	$user = new User();
	if (!$user->findUser($login['uid'], $login['pw'])) {
		$msg = 'Login failed, please try again';
		return;
	}

	$user->tstamp = strftime('%F %T');
	if (!$user->save()) {
		$msg = 'Unable to save updated timestamp.  Please check server configuration.';
		return;
	}

	$_SESSION['bycuserid'] = $user->id;
	header('Location: index.php');
	exit();
}

if (array_key_exists('submit', $_POST)) {
	parseLoginForm();
}

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Berkeley YC Results Program</title>
		<link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
		<div id="header">
		<img src="http://www.berkeleyyc.org/sites/default/files/byc_site_logo.jpg" alt="Home">
		<h1>Berkeley Yacht Club Race Results: Login</h1>
		</div>
		<?php require_once('nav.inc.php'); ?>
		<div class="errormsg"><?php echo $msg; ?></div>
		<form id="loginform" method="post">
		<table id="login">
			<tr>
				<th>Username:</th>
				<td><input type="text" name="login[uid]" id="uid"></td>
				<td><div class="errormsg"><?php echo $msg_uid; ?></div></td>
			</tr>
			<tr>
				<th>Password:</th>
				<td><input type="password" name="login[pw]" id="pw"></td>
				<td><div class="errormsg"><?php echo $msg_pw; ?></div></td>
			</tr>
			<tr>
				<th></th>
				<td><input type="submit" name="submit" id="submit" value="Login"></td>
			</tr>
		</table>
		</form>
	</body>
</html>
