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

<?php $allboats = Boats::model()->findAllBySql('SELECT * FROM boats ORDER BY ABS(sail)');
foreach ($allboats as $b) {
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
		$d->operator,
	));
	echo '<span style="display:none" class="division" id="division_'.$d->id.'">'.$str.'</span>';
} ?>
<form id="entry_form" method="post">
	<input type="hidden" name="entry[raceid]" value="<?php echo $race->id; ?>">
	<input type="hidden" name="entry[divisionid]" id="divisionid" value="<?php echo $entry->divisionid; ?>">
	<?php if ($entry->id) { ?>
		<input type="hidden" name="entry[id]" value="<?php echo $entry->id; ?>">
	<?php } ?>
	<td><input type="submit" name="entry_submit" id="entry_submit" value="<?php echo ($entry->id) ? 'Submit' : 'Add'; ?>">
		<?php if ($entry->id) { ?>
		<input type="submit" name="entry_delete" value="Delete">
		<?php } ?>
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
				echo "<option $sel value=\"{$b->id}\">{$b->name} - {$b->sail}</option>";
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
