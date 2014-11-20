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
if ($race->id && getAccessLevel() >= User::ADMIN_ACCESS) {
	$showlinks = true;
}
?>

<?php if ($showlinks) { ?>
<h3><a href="entries.php?edit=true&raceid=<?php echo $race->id; ?>"><?php echo count($race->entries); ?> Boats:</a></h3>
<?php } else { ?>
<h3><?php echo count($race->entries); ?> Boats:</h3>
<?php } ?>
<table id="entries">
	<tr>
		<th>Division</th>
		<th>Place</th>
		<th>Boat</th>
		<th>Ahead of Next</th>
	</tr>
	<?php $i = 1;
	foreach ($race->divisions as $division) {
		$entries = $entry->findAll('raceid='.$race->id.' AND divisionid='.$division->id, 'corrected');
		$tstart = strtotime($race->racedate.' '.$division->starttime);
		foreach ($entries as $e) {
			$tend = strtotime($race->racedate.' '.$e->finish);
			$telapsed = $tend - $tstart;
			$elapsed = strtohms($telapsed);
			$gap = 'n/a';
			if (count($entries) > $i) {
				$tcorrected = strtotime($race->racedate.' '.$e->corrected);
				$tothercorr = strtotime($race->racedate.' '.$entries[$i]->corrected);
				$secs = $tothercorr - $tcorrected;
				$gap = strtohms($secs);
			}
			echo '<tr>
				<td>'.$division->name.'</td>
				<td>'.$i.'</td>
				<td>'.$e->name.'</td>
				<td>'.$gap.'</td>
			</tr>';
			++$i;
		}
	}?>
</table>
