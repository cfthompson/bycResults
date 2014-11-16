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
require_once('classes/Boat.php');

if (getAccessLevel() < User::ADMIN_ACCESS) {
	header('Location: index.php');
	exit();
}

$id = false;
if (array_key_exists('id', $_GET) && is_numeric($_GET['id'])) {
	$id = intval($_GET['id']);
}
$boat = new Boat($id);

$msg = array();
$msg['top'] = '';
if (array_key_exists('submit', $_POST)) {
	$boat = new Boat($_POST['boat']);
	if (!$boat->save()) {
		$msg['top'] = "Failed to save boat.  Please try again.";
	} else {
		header('Location: roster.php');
		exit();
	}
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Berkeley YC Results Program</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<script type="text/javascript" src="js/jquery.js"></script>
    </head>
    <body>
		<div id="header">
		<img src="http://www.berkeleyyc.org/sites/default/files/byc_site_logo.jpg" alt="Home">
		</div>
		<h1>Berkeley Yacht Club Results</h1>
		<?php require_once('nav.inc.php'); ?>

		<form id="boatform" method="post">
			<?php if ($boat->id) { ?>
			<input type="hidden" name="boat[id]" value="<?php echo $boat->id; ?>">
			<?php } ?>
			<div id="top" class="errormsg"><?php echo $msg['top']; ?></div>
			<table id="boattable">
				<tr>
					<th>Sail #:</th>
					<td><input type="text" name="boat[sail]" value="<?php echo $boat->sail; ?>"></td>
				</tr>
				<tr>
					<th>Name:</th>
					<td><input type="text" name="boat[name]" value="<?php echo $boat->name; ?>"></td>
				</tr>
				<tr>
					<th>Model:</th>
					<td><input type="text" name="boat[model]" value="<?php echo $boat->model; ?>"></td>
				</tr>
				<tr>
					<th>PHRF:</th>
					<td><input type="number" name="boat[phrf]" value="<?php echo $boat->phrf; ?>"></td>
				</tr>
				<tr>
					<th>Length:</th>
					<td><input type="number" name="boat[length]" value="<?php echo $boat->length; ?>"></td>
				</tr>
				<tr>
					<th>Roller Furling?</th>
					<td><input type="checkbox" name="boat[rollerFurling]" value="<?php echo $boat->rollerFurling; ?>"></td>
				</tr>
				<tr>
					<th>Skipper:</th>
					<td><input type="text" name="boat[skipper]" value="<?php echo $boat->skipper; ?>"></td>
				</tr>
				<tr>
					<th>Email:</th>
					<td><input type="text" name="boat[email]" value="<?php echo $boat->email; ?>"></td>
				</tr>
				<tr>
					<th>Phone #:</th>
					<td><input type="text" name="boat[phone]" value="<?php echo $boat->phone; ?>"></td>
				</tr>
				<tr>
					<th></th>
					<td><input type="submit" name="submit" value="Submit"></td>
				</tr>
			</table>
		</form>
	</body>
</html>
