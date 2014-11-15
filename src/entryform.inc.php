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
// @variable: $race a Race object
$boat = new Boat();
$allboats = $boat->findAll();

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
	}
}

function parseEntryForm() {
	global $entry;
	$postedentry = $_POST['entry'];
	$entry = new Entry($postedentry);
	// checkbox values won't come through quite right
	$entry->spinnaker = array_key_exists('spinnaker', $postedentry);
	$entry->rollerFurling = array_key_exists('rollerFurling', $postedentry);
	fixFinishTimeFormat($entry);
	if ($entry->save()) {
		// Punt complex javascript by just reloading the page
		header('Location: entries.php?raceid='.$_GET['raceid'].'&edit=true');
	}
}

$entry = new Entry();
if (array_key_exists('entry_submit', $_POST)) {
	parseEntryForm();
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
<th>TCF</th>
<th>Corrected</th>
<th>Ahead of Next</th>
 */
?>
<tr>
<?php foreach ($allboats as $b) {
	echo '<span style="display:none" id="boat_'.$b->id.'">'.$b->name.'$$'.$b->sail.'$$'.$b->model.'$$'.$b->phrf.'$$'.$b->length.'$$'.$b->rollerFurling.'</span>';
} 
foreach ($race->divisions as $d) {
	echo '<span style="display:none" class="division" id="division_'.$d->id.'">'.$d->name.'$$'.$d->starttime.'$$'.$d->minphrf.'$$'.$d->maxphrf.'$$'.$d->minlength.'$$'.$d->maxlength.'</span>';
} ?>
<form id="entry_form" method="post">
	<input type="hidden" name="entry[raceid]" value="<?php echo $raceid; ?>">
	<td><input type="submit" name="entry_submit" id="entry_submit" value="Add"></td>
	<td><span id="division"></span><input type="hidden" name="entry[divisionid]" id="divisionid" value="<?php echo $entry->divisionid; ?>"></td>
	<td><select id="entrysail" name="entry[boatid]" value="<?php echo $entry->boatid; ?>">
			<option value="0"></option>
			<?php foreach ($allboats as $b) {
				echo "<option value=\"{$b->id}\">{$b->sail} - {$b->name}</option>";
			} ?>
		</select>
	</td>
	<td><select id="entryboat" name="entry[boatid]" value="<?php echo $entry->boatid; ?>">
			<option value="0"></option>
			<?php function sortboatsbyname($a, $b) {
				if ($a->name == $b->name) return 0;
				return $a->name < $b->name ? -1 : 1;
			}
			usort($allboats, 'sortboatsbyname');
			foreach ($allboats as $b) {
				echo "<option value=\"{$b->id}\">{$b->sail} - {$b->name}</option>";
			} ?>
		</select>
	</td>
	<td><div id="entrytype"></div></td>
	<td><input type="number" length="4" maxlength="4" class="calcinput" name="entry[phrf]" id="phrf" value="<?php echo $entry->phrf; ?>"></td>
	<td><input type="checkbox" class="calcinput" name="entry[spinnaker]" id="spinnaker" <?php echo $entry->spinnaker ? 'checked' : ''; ?>></td>
	<td><input type="checkbox" class="calcinput" name="entry[rollerFurling]" id="rollerFurling" <?php echo $entry->rollerFurling ? 'checked' : ''; ?>></td>
	<td><input type="text" class="calcinput" name="entry[finish]" id="finish" value="<?php echo $entry->finish; ?>"></td>
	<td><div id="elapsed"></div></td>
	<td><div id="tcf"></div></td>
	<td><div id="corrected"></div></td>
	<td><div id="gap"></div></td>
</form>
</tr>
