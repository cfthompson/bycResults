<?php
/*
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
*/

// @variable: $entry an Entry object
// @variable: $raceid the $_GET parameter for the race id
// @variable: $race a Race object
$boat = new Boat();
$allboats = $boat->findAll('', 'ABS(sail)');

function fixFinishTimeFormat($entry) {
	$finish = $entry->finish;
	if (!$finish) return;
	$hour = $minute = $second = 0;
	if (preg_match('/\d{6}/', $finish)) {
		$hour = substr($finish, 0, 2);
		$minute = substr($finish, 2, 2);
		$second = substr($finish, 4, 2);
		// TODO: be more flexible on time format (javascript?)
		$entry->finish = sprintf('%02d:%02d:%02d', $hour, $minute, $second);
	} else if (strcasecmp($finish, 'dnf') == 0 || strcasecmp($finish, 'dsq') == 0) {
		$entry->status = strtoupper($finish);
	}
}

function parseEntryForm() {
	global $entry;
	$postedentry = $_POST['entry'];
	$entry = new Entry($postedentry);
	// checkbox values won't come through quite right
	$entry->spinnaker = array_key_exists('spinnaker', $postedentry) ? 1 : 0;
	$entry->rollerFurling = array_key_exists('rollerFurling', $postedentry) ? 1 : 0;
	fixFinishTimeFormat($entry);
	if ($entry->save()) {
		// Punt complex javascript by just reloading the page
		echo '<script type="text/javascript">window.location.replace("entries.php?raceid='.$_GET['raceid'].'&edit=true");</script>';
		exit();
	}
}

if (array_key_exists('entry_submit', $_POST)) {
	parseEntryForm();
}
else if (array_key_exists('entry_delete', $_POST)) {
	$entry->delete();
	echo '<script type="text/javascript">window.location.replace("entries.php?raceid='.$_GET['raceid'].'&edit=true");</script>';
	exit();
}

/* Columns to display inputs for:
<th>Place</th>
<th>Division</th>
<th>Sail Number</th>
<th>Boat</th>
<th>Type</th>
<th>PHRF</th>
<th>Spinnaker?</th>
<th>Roller Furling?</th>
<th>Finish Time</th>
<th>Elapsed</th>
<th>TCF</th>		<- Only for TOT
<th>Corrected</th>
<th>Ahead of Next</th>
 */
?>
<tr>

<span style="display:none" id="method"><?php echo $race->method; ?></span>
<span style="display:none" id="param1"><?php echo $race->param1; ?></span>
<span style="display:none" id="param2"><?php echo $race->param2; ?></span>

<?php foreach ($allboats as $b) {
	echo '<span style="display:none" id="boat_'.$b->id.'">'.$b->name.'$$'.$b->sail.'$$'.$b->model.'$$'.$b->phrf.'$$'.$b->length.'$$'.$b->rollerFurling.'</span>';
} 
foreach ($race->divisions as $d) {
	$str = implode('$$', array(
		$d->name,
		$d->starttime,
		$d->distance,
		$d->minphrf,
		$d->maxphrf,
		$d->minlength,
		$d->maxlength,
	));
	echo '<span style="display:none" class="division" id="division_'.$d->id.'">'.$str.'</span>';
} ?>
<form id="entry_form" method="post">
	<input type="hidden" name="entry[raceid]" value="<?php echo $raceid; ?>">
	<?php if ($entry->id) { ?>
		<input type="hidden" name="entry[id]" value="<?php echo $entry->id; ?>">
	<?php } ?>
	<td><input type="submit" name="entry_submit" id="entry_submit" value="<?php echo ($entry->id) ? 'Submit' : 'Add'; ?>">
		<?php if ($entry->id) { ?>
		<input type="submit" name="entry_delete" value="Delete">
		<?php } ?>
	</td>
	<td>
		<span id="division"></span><input type="hidden" name="entry[divisionid]" id="divisionid" value="<?php echo $entry->divisionid; ?>">
	</td>
	<td><select id="entrysail" name="entry[boatid]">
			<option value="0"></option>
			<?php foreach ($allboats as $b) {
				$sel = ($b->id === $entry->boatid) ? 'selected' : '';
				echo "<option $sel value=\"{$b->id}\">{$b->sail} - {$b->name}</option>";
			} ?>
		</select>
	</td>
	<td><select id="entryboat" name="entry[boatid]">
			<option value="0"></option>
			<?php function sortboatsbyname($a, $b) {
				if ($a->name == $b->name) return 0;
				return $a->name < $b->name ? -1 : 1;
			}
			usort($allboats, 'sortboatsbyname');
			foreach ($allboats as $b) {
				$sel = ($b->id === $entry->boatid) ? 'selected' : '';
				echo "<option $sel value=\"{$b->id}\">{$b->sail} - {$b->name}</option>";
			} ?>
		</select>
	</td>
	<td><div id="entrytype"></div></td>
	<td><input type="number" length="4" maxlength="4" class="calcinput" name="entry[phrf]" id="phrf" value="<?php echo $entry->phrf; ?>"></td>
	<td><input type="checkbox" class="calcinput" name="entry[spinnaker]" id="spinnaker" <?php echo $entry->spinnaker ? 'checked' : ''; ?>></td>
	<td><input type="checkbox" class="calcinput" name="entry[rollerFurling]" id="rollerFurling" <?php echo $entry->rollerFurling ? 'checked' : ''; ?>></td>
	<td><input type="text" class="calcinput" name="entry[finish]" id="finish" value="<?php echo $entry->status ? $entry->status : $entry->finish; ?>"></td>
	<td><div id="elapsed"></div></td>
	<?php if ($race->method === 'TOT') { ?>
	<td><div id="tcf"></div></td>
	<?php } ?>
	<td><div id="corrected"></div></td>
	<td><div id="gap"></div></td>
</form>
</tr>