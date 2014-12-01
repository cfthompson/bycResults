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
	<?php $i = 1;
	if (!Yii::app()->user->isGuest && !$entry->id) { 
		$this->renderPartial('entryForm', array(
			'race'=>$race,
			'entry'=>$entry,
		));
	}

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
				'entries'=>$entries,
				'e'=>$e,
				'edit'=>true,
				'tstart'=>$tstart,
				'finishers'=>$finishers,
				'i'=>$i,
			));
			++$i;
		}
	}
?>
</table>
<a href="<?php echo $this->createUrl('race/view', array('id'=>$race->id)); ?>">Finished: View this Race</a>