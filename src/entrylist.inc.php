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

// @variable $edit true for edit mode, false for readonly
// @variable $race a Race object
$entry = new Entry();

function strtohms($secs) {
	$hr = fmod($secs, 3600);
	$h = ($secs - $hr)/3600;
	$mr = fmod($hr, 60);
	$m = ($hr - $mr)/60;
	$s = $mr;
	$result = sprintf('%02d:%02d:%02d', $h, $m, $s);
	return $result;
}

?>

<h3>Race Results:</h3>
<table id="entries">
	<tr>
		<th>Place</th>
		<th>Division</th>
		<th>Sail #</th>
		<th>Boat</th>
		<th>Type</th>
		<th>PHRF</th>
		<th>Spin?</th>
		<th>Roll Furl?</th>
		<th>Finish</th>
		<th>Elapsed</th>
		<th>TCF</th>
		<th>Corrected</th>
		<th>Ahead of Next</th>
	</tr>
	<?php $i = 1;
	if ($edit) { 
		require_once('entryform.inc.php');
	}
	
	foreach ($race->divisions as $division) {
		$entries = $entry->findAll('raceid='.$race->id.' AND divisionid='.$division->id, 'corrected');
		$tstart = strtotime($race->racedate.' '.$division->starttime);
		foreach ($entries as $entry) {
			$tend = strtotime($race->racedate.' '.$entry->finish);
			$telapsed = $tend - $tstart;
			$elapsed = strtohms($telapsed);
			$gap = 'n/a';
			if (count($entries) > $i) {
				$tcorrected = strtotime($race->racedate.' '.$entry->corrected);
				$tothercorr = strtotime($race->racedate.' '.$entries[$i]->corrected);
				$secs = $tothercorr - $tcorrected;
				$gap = strtohms($secs);
			}
			echo '<tr>
				<td>'.$i.'</td>
				<td>'.$division->name.'</td>
				<td>'.$entry->sail.'</td>
				<td>'.$entry->name.'</td>
				<td>'.$entry->model.'</td>
				<td>'.$entry->phrf.'</td>
				<td>'.$entry->spinnaker.'</td>
				<td>'.$entry->rollerFurling.'</td>
				<td>'.$entry->finish.'</td>
				<td>'.$elapsed.'</td>
				<td>'.sprintf('%.02f', $entry->tcf).'</td>
				<td>'.$entry->corrected.'</td>
				<td>'.$gap.'</td>
			</tr>';
			++$i;
		}
	}?>
</table>
