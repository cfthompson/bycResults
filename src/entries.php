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
require_once('classes/Boat.php');
require_once('classes/Entry.php');

if (!array_key_exists('raceid', $_GET) || !is_numeric($_GET['raceid'])) {
	header('Location: index.php');
	exit();
}
$edit = false;
if (array_key_exists('edit', $_GET) && getAccessLevel()>= User::ADMIN_ACCESS) {
	$edit = !!$_GET['edit'];
}

$raceid = intval($_GET['raceid']);
$race = new Race($raceid);
$boat = new Boat();
$allboats = $boat->findAll();

require_once('classes/Entry.php');

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Berkeley YC Results Program</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/entryform.js"></script>
		<?php if ($edit) { ?>
		<script type="text/javascript" src="js/raceform.js"></script>
		<?php } ?>
    </head>
    <body>
		<div id="header">
		<img src="http://www.berkeleyyc.org/sites/default/files/byc_site_logo.jpg" alt="Home">
		</div>
		<h1>Berkeley Yacht Club Results</h1>
		<?php require_once('nav.inc.php'); ?>
		<?php require_once('entrylist.inc.php'); ?>
	</body>
</html>
