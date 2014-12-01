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

<?php if (!Yii::app()->user->isGuest) {
	echo '<h3><a href="'.$this->createUrl('edit', array('id'=>$race->id)).'">Race Info:</a></h3>';
} else {
	echo '<h3>Race Info:</h3>';
} ?>

<table id="race">
	<tr>
		<th>Date:</th>
		<td><?php echo $race->racedate; ?></td>
		<th>Series:</th>
		<td><?php echo $race->series->name; ?></td>
	</tr>
	<tr>
		<th>RC Boat:</th>
		<td><?php echo $race->rcboat; ?></td>
		<th>RC Skipper:</th>
		<td><?php echo $race->rcskipper; ?></td>
	</tr>
	<tr>
		<th>Prepared By:</th>
		<td><?php echo $race->preparer; ?></td>
		<th># Boats:</th>
		<td><?php echo count($race->entries); ?></td>
	</tr>
	<tr>
		<th>Method:</th>
		<td><?php echo $race->method; ?></td>
		<th>Formula:</th>
		<td><?php if ($race->method == 'TOT') {
			echo 'Elapsed * ('.$race->param1.'/('.$race->param2.' + PHRF))';
		} else {
			echo 'Elapsed - (Distance * PHRF/60)';
		} ?></td>
	</tr>

	<?php foreach ($race->divisions as $d) { ?>
	<tr>
		<th colspan="4" class="divisionheader"><?php echo $d->name; ?> Division:</th>
	</tr>
	<tr>
		<th>Start:</th>
		<td><?php echo $d->starttime; ?></td>
		<th>Course/Distance:</th>
		<td><?php echo $d->course->number.' / '.$d->distance; ?></td>
	</tr>
	<?php if ($d->description) { ?>
	<tr>
		<th>Description:</th>
		<td colspan="3"><?php echo $d->description; ?></td>
	</tr>
	<?php } ?>
	<?php } ?>
</table>

<?php if (!Yii::app()->user->isGuest) {
	echo '<h3><a href="'.$this->createUrl('entries', array('id'=>$race->id)).'">'.count($race->entries).' Boats:</a></h3>';
} else {
	echo '<h3>'.count($race->entries).' Boats:</h3>';
} ?>

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
		<?php if ($race->method === 'TOT') { ?>
		<th>TCF</th>
		<?php } ?>
		<th>Corrected</th>
		<th>Ahead of Next</th>
	</tr>

	<?php 
	foreach ($race->divisions as $division) {
		$entries = $division->entries;
		$tstart = strtotime($race->racedate.' '.$division->starttime);
		// Find # boats that actually finished
		$finishers = 0;
		foreach ($entries as $e) {
			if ($e->status) break;
			++$finishers;
		}
		$i = 1;
		foreach ($entries as $e) {
			$this->renderPartial('entry', array(
				'race'=>$race,
				'division'=>$division,
				'entries'=>$entries,
				'e'=>$e,
				'edit'=>false,
				'tstart'=>$tstart,
				'finishers'=>$finishers,
				'i'=>$i,
			));
			++$i;
		}
	} ?>
</table>
