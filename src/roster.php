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
require_once('classes/User.php');
if (getAccessLevel() < User::ADMIN_ACCESS) {
	header('Location: index.php');
	exit();
}

require_once('classes/Boat.php');
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
		<h1>Race Results: Roster</h1>
		</div>
		<?php require_once('nav.inc.php'); ?>

		<table id="roster">
			<tr>
				<th>Sail Number</th>
				<th>Name</th>
				<th>Type</th>
				<th>PHRF</th>
				<th>Length</th>
				<th>Roller Furling?</th>
				<th>Skipper</th>
				<th>Email</th>
				<th>Phone</th>
			</tr>
			<?php $boat = new Boat();
			foreach($boat->findAll() as $b) {
				echo '<tr>
				<td class="val">'.$b->sail.'</td>
				<td class="link"><a href="boat.php?id='.$b->id.'">'.$b->name.'</a></td>
				<td class="val">'.$b->model.'</td>
				<td class="val">'.$b->phrf.'</td>
				<td class="val">'.$b->length.'</td>
				<td class="val">'.$b->rollerFurling.'</td>
				<td class="val">'.$b->skipper.'</td>
				<td class="val">'.$b->email.'</td>
				<td class="val">'.$b->phone.'</td>
				</tr>';
			} ?>
		</table>
	</body>
</html>
