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
require_once('classes/Race.php');
require_once('classes/User.php');
require_once('classes/Boat.php');
require_once('classes/Entry.php');

$id = false;
if (array_key_exists('id', $_GET)) {
	$id = $_GET['id'];
	if (!is_numeric($id)) {
		$id = false;
	} else {
		$id = intval($id);
	}
}
$race = new Race($id);

if (array_key_exists('seriesid', $_GET) && is_numeric($_GET['seriesid'])) {
	$race->seriesid = intval($_GET['seriesid']);
}

$showlinks = false;
if ($id && getAccessLevel() >= User::ADMIN_ACCESS) {
	$showlinks = true;
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
			<a href="http://www.berkeleyyc.org"><img src="http://www.berkeleyyc.org/sites/default/files/byc_site_logo.jpg" alt="Home"></a>
		<h1>Race Results</h1>
		</div>
		<?php require_once('nav.inc.php'); ?>
		<div id="raceview">Select View:
			<a href="race.php?id=<?php echo $id; ?>">Normal</a> or <span class="selected">Cheat Sheet</span>
		</div>
		<?php $entry = new Entry();
		require_once('cheatsheet.inc.php'); ?>
	</body>
</html>
