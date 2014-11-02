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

function strtohms($secs) {
	$hr = fmod($secs, 3600);
	$h = ($secs - $hr)/3600;
	$mr = fmod($hr, 60);
	$m = ($hr - $mr)/60;
	$s = $mr;
	$result = sprintf('%02d:%02d:%02d', $h, $m, $s);
	return $result;
}

$id = false;
if (array_key_exists('id', $_GET)) {
	$id = $_GET['id'];
	if (!is_numeric($id)) {
		$id = false;
	} else {
		$id = intval($id);
	}
}
$edit = false;
if (array_key_exists('edit', $_GET)) {
	$edit = boolval($_GET['edit']);
}

$race = new Race($id);


?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Berkeley YC Results Program</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<script type="text/javascript" src="js/jquery.js"></script>
    </head>
    <body>
		<h1>Berkeley Yacht Club Results</h1>
		<?php require_once('nav.inc.php'); ?>
		<?php if (!$id) {
			require_once('raceform.inc.php');
		} else { ?>
		<table id="race">
			<tr>
				<th>Date</th>
				<th>Type</th>
			</tr>
			<tr>
				<td><?php echo $race->racedate; ?></td>
				<td><?php echo $race->type; ?></td>
			</tr>
		</table>

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
				<th>TCF</th>
				<th>Corrected</th>
				<th>Ahead of Next</th>
			</tr>
			<?php $i = 1;
			if ($edit) { 
				require_once('entryform.inc.php');
			}

			$tstart = strtotime($race->racedate.' 13:00:00');
			foreach ($race->entries as $entry) {
				$tend = strtotime($entry->finish);
				$telapsed = $tend - $tstart;
				$elapsed = strtohms($telapsed);
				$corrected = strtohms($entry->corrected);
				$tcf = sprintf('%.02f', $entry->tcf);
				$gap = 'n/a';
				if (count($race->entries) > $i) {
					$othercorr = $race->entries[$i]->corrected;
					$secs = $othercorr - $entry->corrected;
					$gap = strtohms($secs);
				}
				echo '<tr>
					<td>'.$i.'</td>
					<td>'.$entry->name.'</td>
					<td>'.$entry->sail.'</td>
					<td>'.$entry->model.'</td>
					<td>'.$entry->phrf.'</td>
					<td>'.$entry->spinnaker.'</td>
					<td>'.$entry->rollerFurling.'</td>
					<td>'.$entry->finish.'</td>
					<td>'.$elapsed.'</td>
					<td>'.$tcf.'</td>
					<td>'.$corrected.'</td>
					<td>'.$gap.'</td>
				</tr>';
				++$i;
			}?>
		</table>
		<?php } ?>
	</body>
</html>
