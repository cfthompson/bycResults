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

// @variable: $entry
// @variable: raceid

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
	<td><input type="number" class="calcinput" name="entry[phrf]" id="phrf" value="<?php echo $entry->phrf; ?>"></td>
	<td><input type="checkbox" class="calcinput" name="entry[spinnaker]" id="spinnaker" <?php echo $entry->spinnaker ? 'checked' : ''; ?>></td>
	<td><input type="checkbox" class="calcinput" name="entry[rollerFurling]" id="rollerFurling" <?php echo $entry->rollerFurling ? 'checked' : ''; ?>></td>
	<td><input type="text" class="calcinput" name="entry[finish]" id="finish" value="<?php echo $entry->finish; ?>"></td>
	<td><div id="elapsed"></div></td>
	<td><div id="tcf"></div></td>
	<td><div id="corrected"></div></td>
	<td><div id="gap"></div></td>
</form>
</tr>
