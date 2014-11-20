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

$edit = ($id === false);
if (array_key_exists('edit', $_GET) && getAccessLevel() >= User::ADMIN_ACCESS) {
	$edit = !!($_GET['edit']);
}

$showlinks = false;
if ($id && getAccessLevel() >= User::ADMIN_ACCESS && !$edit) {
	$showlinks = true;
}

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Berkeley YC Results Program</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<?php if ($edit) { ?>
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/raceform.js"></script>
		<?php } ?>
    </head>
    <body>
		<div id="header">
		<img src="http://www.berkeleyyc.org/sites/default/files/byc_site_logo.jpg" alt="Home">
		<h1>Race Results</h1>
		</div>
		<?php require_once('nav.inc.php'); ?>
		<div id="raceview">Select View:
			<span class="selected">Normal</span> or <a href="cheatsheet.php?id=<?php echo $id; ?>">Cheat Sheet</a>
		</div>
		<?php if ($edit) {
			require_once('raceform.inc.php');
		} else { ?>
		<?php if ($showlinks) { ?>
		<h3><a href="race.php?edit=true&id=<?php echo $race->id; ?>">Race Info:</a></h3>
		<?php } else { ?>
		<h3>Race Info:</h3>
		<?php } ?>
		<table id="race">
			<tr>
				<th>Date:</th>
				<td><?php echo $race->racedate; ?></td>
				<th>Series:</th>
				<td><?php echo $race->series->name; ?></td>
			</tr>
			<tr>
				<th>RC Boat:</th>
				<td><?php echo $race->rcboat; ?></td>
				<th>RC Skipper:</th>
				<td><?php echo $race->rcskipper; ?></td>
			</tr>
			<tr>
				<th>Prepared By:</th>
				<td><?php echo $race->preparer; ?></td>
				<th># Boats:</th>
				<td><?php echo count($race->entries); ?></td>
			</tr>
			<?php foreach ($race->divisions as $d) { ?>
			<tr>
				<th colspan="4"><?php echo $d->name; ?> Division:</th>
			</tr>
			<tr>
				<th>Start:</th>
				<td><?php echo $d->starttime; ?></td>
				<th>Course/Distance:</th>
				<td><?php echo $d->course.' / '.$d->distance; ?></td>
			</tr>
			<?php if ($d->description) { ?>
			<tr>
				<th>Description:</th>
				<td colspan="3"><?php echo $d->description; ?></td>
			</tr>
			<?php } ?>
			<?php } ?>
		</table>
		<?php $entry = new Entry();
		require_once('entrylist.inc.php'); ?>
		<?php } ?>
	</body>
</html>
