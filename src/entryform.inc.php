<?php
require_once('classes/Boat.php');
require_once('classes/Entry.php');

$boat = new Boat();
$allboats = $boat->findAll('', 'name ASC');

function fixFinishTimeFormat($newentry) {
	$finish = $newentry->finish;
	if (!$finish) return;
	$hour = $minute = $second = 0;
	if (preg_match('/\d{6}/', $finish)) {
		$hour = substr($finish, 0, 2);
		$minute = substr($finish, 2, 2);
		$second = substr($finish, 4, 2);
		// TODO: be more flexible on time format (javascript?)
		$finish = sprintf('%02d:%02d:%02d', $hour, $minute, $second);
	} else {
		return;
	}
	$race = $newentry->race;
	$newentry->finish = $race->racedate.' '.$finish;
	$tstart = strtotime($race->racedate.' 13:00:00');
	$tend = strtotime($newentry->finish);
	$tcf = 800/(550+$newentry->phrf);
	$tcfspin = empty($newentry->spinnaker) ? 0.04*$tcf : 0;
	$tcffurl = empty($newentry->rollerFurling) ? 0 : 0.02*$tcf;
	$newentry->tcf = $tcf - $tcfspin - $tcffurl;
	$newentry->corrected = $newentry->tcf*($tend - $tstart);
}

if (array_key_exists('newentry_submit', $_POST)) {
	$postedentry = $_POST['newentry'];
	$newentry = new Entry($postedentry);
	// checkbox values won't come through quite right
	$newentry->spinnaker = array_key_exists('spinnaker', $postedentry);
	$newentry->rollerFurling = array_key_exists('rollerFurling', $postedentry);
	fixFinishTimeFormat($newentry);
	if ($newentry->save()) {
		// Punt complex javascript by just reloading the page
		header('Location: race.php?id='.$_GET['id'].'&edit=true');
		exit();
	}
} elseif (array_key_exists('id', $_GET)) {
	$newentry = new Entry($_GET['id']);
} else {
	$newentry = new Entry();
}
?>
<!--
Copyright (C) 2014 rfgunion.

This library is free software; you can redistribute it and/or
modify it under the terms of the GNU Lesser General Public
License as published by the Free Software Foundation; either
version 2.1 of the License, or (at your option) any later version.

This library is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
Lesser General Public License for more details.

You should have received a copy of the GNU Lesser General Public
License along with this library; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
MA 02110-1301  USA
-->
<script type="text/javascript" src="js/entryform.js"></script>

<?php
foreach ($allboats as $b) {
	echo '<span style="display:none" id="boat_'.$b->id.'">'.$b->name.'$$'.$b->sail.'$$'.$b->model.'$$'.$b->phrf.'$$'.$b->rollerFurling.'</span>';
}

/* Columns to display inputs for:
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
<th>(blank for the submit button)</th>
 */
?>
<tr>
<form id="newentry_form" method="post">
	<input type="hidden" name="newentry[raceid]" value="<?php echo $_GET['id']; ?>">
	<td></td>
	<td><select id="newentryboat" name="newentry[boatid]" value="<?php echo $newentry->boatid; ?>" onchange="boat_onChange()">
			<option value="0"></option>
			<?php foreach ($allboats as $b) {
				echo "<option value=\"{$b->id}\">{$b->sail} - {$b->name}</option>";
			} ?>
		</select>
	</td>
	<td><select id="newentrysail" name="newentry[boatid]" value="<?php echo $newentry->boatid; ?>">
			<option value="0"></option>
			<?php function sortboatsbysail($a, $b) {
				if (is_numeric($a->sail) && is_numeric($b->sail)) {
					$x = intval($a->sail);
					$y = intval($b->sail);
					if ($x = $y) return 0;
					return $x < $y ? -1 : 1;
				}
				if ($a->sail == $b->sail) return 0;
				return $a->sail < $b->sail ? -1 : 1;
			}
			usort($allboats, 'sortboatsbysail');
			foreach ($allboats as $b) {
				echo "<option value=\"{$b->id}\">{$b->sail} - {$b->name}</option>";
			} ?>
		</select>
	</td>
	<td><div id="newentrytype"></div></td>
	<td><input type="number" name="newentry[phrf]" id="phrf" value="<?php echo $newentry->phrf; ?>"></td>
	<td><input type="checkbox" name="newentry[spinnaker]" id="spinnaker" value="<?php echo $newentry->spinnaker; ?>"</td>
	<td><input type="checkbox" name="newentry[rollerFurling]" id="rollerFurling" value="<?php echo $newentry->rollerFurling; ?>"</td>
	<td><input type="text" name="newentry[finish]" id="finish" value="<?php echo $newentry->finish; ?>"></td>
	<td><div id="elapsed"></div></td>
	<td><div id="corrected"></div></td>
	<td><input type="submit" name="newentry_submit" id="newentry_submit" value="Add"></td>
</form>
</tr>
