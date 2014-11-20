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
// @variable $entry an Entry object

function strtohms($secs) {
	$hr = fmod($secs, 3600);
	$h = ($secs - $hr)/3600;
	$mr = fmod($hr, 60);
	$m = ($hr - $mr)/60;
	$s = $mr;
	$result = sprintf('%02d:%02d:%02d', $h, $m, $s);
	return $result;
}

$showlinks = false;
if ($race->id && getAccessLevel() >= User::ADMIN_ACCESS && !$edit) {
	$showlinks = true;
}

$allentries = $race->entries;
?>

<?php if ($showlinks) { ?>
<h3><a href="entries.php?edit=true&raceid=<?php echo $race->id; ?>">Boats:</a></h3>
<?php } else { ?>
<h3><?php echo count($allentries); ?> Boats:</h3>
<?php } ?>
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
	if ($edit && !$entry->id) { 
		require_once('entryform.inc.php');
	}
	
	foreach ($race->divisions as $division) {
		$entries = $division->entries;
		//$entries = $entry->findAll('raceid='.$race->id.' AND divisionid='.$division->id, 'status, corrected');
		$tstart = strtotime($race->racedate.' '.$division->starttime);
		// Find # boats that actually finished
		$finishers = 0;
		foreach ($entries as $e) {
			if ($e->status) break;
			++$finishers;
		}
		foreach ($entries as $e) {
			if ($edit && $entry->id && ($e->id === $entry->id)) {
				require_once('entryform.inc.php');
				++$i;
				continue;
			}
			$link = '';
			$lend = '';
			if ($edit) {
				$link = '<a href="entries.php?edit=true&raceid='.$raceid.'&entryid='.$e->id.'">';
				$lend = '</a>';
			}
			if ($e->status) {
				echo '<tr>
					<td></td>
					<td>'.$division->name.'</td>
					<td>'.$link.$e->sail.$lend.'</td>
					<td>'.$link.$e->name.$lend.'</td>
					<td>'.$e->model.'</td>
					<td>'.$e->phrf.'</td>
					<td>'.($e->spinnaker ? 'Y' : 'N').'</td>
					<td>'.($e->rollerFurling ? 'Y' : 'N').'</td>
					<td>'.$e->status.'</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>';
				continue;
			}
			$tend = strtotime($race->racedate.' '.$e->finish);
			$telapsed = $tend - $tstart;
			$elapsed = strtohms($telapsed);
			$gap = 'n/a';
			if ($finishers > $i) {
				$tcorrected = strtotime($race->racedate.' '.$e->corrected);
				$tothercorr = strtotime($race->racedate.' '.$entries[$i]->corrected);
				$secs = $tothercorr - $tcorrected;
				$gap = strtohms($secs);
			}
			echo '<tr>
				<td>'.$link.$i.$lend.'</td>
				<td>'.$division->name.'</td>
				<td>'.$link.$e->sail.$lend.'</td>
				<td>'.$link.$e->name.$lend.'</td>
				<td>'.$e->model.'</td>
				<td>'.$e->phrf.'</td>
				<td>'.($e->spinnaker ? 'Y' : 'N').'</td>
				<td>'.($e->rollerFurling ? 'Y' : 'N').'</td>
				<td>'.$e->finish.'</td>
				<td>'.$elapsed.'</td>
				<td>'.sprintf('%.02f', $e->tcf).'</td>
				<td>'.$e->corrected.'</td>
				<td>'.$gap.'</td>
			</tr>';
			++$i;
		}
	}?>
</table>
