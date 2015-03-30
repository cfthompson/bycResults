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
<table id="entries-cheatsheet">
	<tr>
		<th>Place</th>
		<th>Boat</th>
		<th>Ahead of Next</th>
	</tr>
	<?php
	$division_counter = 0;
	if (count($race->divisions) > 1) {
		$division_counter = 1;
	}
	foreach ($race->divisions as $division) {
		$entries = $division->entries;
		$tstart = strtotime($race->racedate.' '.$division->starttime);
		// Find # boats that actually finished
		$finishers = 0;
		foreach ($entries as $e) {
			if ($e->status) break;
			++$finishers;
		}

		if (count($race->divisions) > 1) {
			if (!empty($division->name)) {
				echo '<tr class="division_header divisioncounter_'.$division_counter.'"><td colspan="3">"'.$division->name.'" Division:</td></tr>';
			} else {
				echo '<tr class="division_header divisioncounter_'.$division_counter.'"><td colspan="3">Division '.$division_counter.':</td></tr>';
			}
		}
		
		$i = 1;
		foreach ($entries as $e) {
			if ($e->status) {
				echo '<tr class="divisioncounter_'.$division_counter.'">
					<td>'.$e->status.'</td>
					<td>'.$e->boat->name.'</td>
					<td></td>
				</tr>';
				++$i;
				continue;
			}
			$tend = strtotime($race->racedate.' '.$e->finish);
			$telapsed = $tend - $tstart;
			$elapsed = $this->strtohms($telapsed);
			$gap = '';
			if ($finishers > $i) {
				$tcorrected = strtotime($race->racedate.' '.$e->corrected);
				$tothercorr = strtotime($race->racedate.' '.$entries[$i]->corrected);
				$secs = $tothercorr - $tcorrected;
				$gap = $this->strtohms($secs);
			}
			echo '<tr class="divisioncounter_'.$division_counter.'">
				<td>'.$i.'</td>
				<td>'.$e->boat->name.'</td>
				<td>'.$gap.'</td>
			</tr>';
			++$i;
		}
		++$division_counter;
	}?>
</table>
