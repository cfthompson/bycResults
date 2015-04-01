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

/* @var $this RaceController */
/* @var $race Races */
/* @var $entry Entries instance to be edited or created */

?>

<h5>TIPS:</h5>
<ul>
	<li>Enter Finish Time as HHMMSS, or HH:MM:SS.  Colons are optional, but hours, minutes and seconds must all be provided.</li>
	<li>You may enter "dnf" or "dsq" instead of finish time.</li>
	<li>After entering finish time, click anywhere outside the text box to see the elapsed time etc.  Then click "Add" on the left to submit the entry.</li>
	<li>After entering all boats, click "Finished: View this Race" to see the final results.  Print that page.</li>
</ul>

<a href="<?php echo $this->createUrl('race/view', array('id'=>$race->id)); ?>">Finished: View this Race</a>

<table id="entries">
	<tr>
		<th>Place</th>
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
	<?php $i = 1;
	if (!Yii::app()->user->isGuest && !$entry->id) { 
		$this->renderPartial('entryForm', array(
			'race'=>$race,
			'entry'=>$entry,
		));
	}

	$division_counter = (count($race->divisions) > 1) ? 1 : 0;
	foreach ($race->divisions as $d) {
		$entries = $d->entries;
		$finishers = 0;
		foreach ($entries as $e) {
			if ($e->status) break;
			++$finishers;
		}
		$tstart = strtotime($race->racedate.' '.$d->starttime);
		$i = 1;
		foreach ($entries as $e) {
			if ($e->id === $entry->id) {
				$this->renderPartial('entryForm', array(
					'race'=>$race,
					'entry'=>$e,
				));
				++$i;
				continue;
			}
			$this->renderPartial('entry', array(
				'race'=>$race,
				'division'=>$d,
				'division_counter'=>$division_counter,
				'entries'=>$entries,
				'e'=>$e,
				'edit'=>true,
				'tstart'=>$tstart,
				'finishers'=>$finishers,
				'i'=>$i,
			));
			++$i;
		}
		++$division_counter;
	}
?>
</table>
<a href="<?php echo $this->createUrl('race/view', array('id'=>$race->id)); ?>">Finished: View this Race</a>