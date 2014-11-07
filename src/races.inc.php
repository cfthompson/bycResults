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

// @variable: $s Series
$race = new Race();
$races = $race->findAll('seriesid='.$s->id, 'racedate DESC');

?>
<table id="races">
	<tr>
		<th>Date</th>
		<th># Boats</th>
		<?php if (getAccessLevel() >= User::ADMIN_ACCESS) {
			echo '<th>Edit</th>';
		} ?>
	</tr>
	<?php foreach ($races as $race) {
		echo '<tr>
		<td><a href="race.php?id='.$race->id.'">'.$race->racedate.'</a></td>
		<td>'.count($race->entries).'</td>
		';
		if (getAccessLevel() >= User::ADMIN_ACCESS) {
			echo '<td><a href="race.php?id='.$race->id.'&edit=true">Edit</a></td>';
		}
		echo '</tr>';
	} ?>
</table>
