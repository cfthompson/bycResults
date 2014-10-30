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
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Berkeley YC Results Program</title>
		<link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
		<h1>Berkeley Yacht Club Results</h1>
		<?php require_once('nav.inc.php'); ?>
		<?php require_once('raceform.inc.php'); ?>

		<table id="entries">
			<tr>
				<th>Number</th>
				<th>Boat</th>
				<th>Sail Number</th>
				<th>Type</th>
				<th>PHRF</th>
				<th>Spinnaker?</th>
				<th>Roller Furling?</th>
				<th>Finish Time</th>
				<th>Elapsed</th>
				<th>Corrected</th>
			</tr>
			<?php $i = 1;
			foreach ($race->entries as $entry) {
				echo '<tr>
					<td>'.$i.'</td>
					<td>'.$
			}
		</table>
	</body>
</html>
