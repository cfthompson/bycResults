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
/* @var $entries array of all Entries in current division */
/* @var $e current Entries instance */
/* @var $edit true if in edit mode, false otherwise */
/* @var $tstart timestamp of start time for this division */
/* @var $finishers # boats in this division that finished */
/* @var $i row counter */

$link = '';
$lend = '';
if ($edit) {
	$link = '<a href="'.$this->createUrl('entries', array('id'=>$race->id, 'entryid'=>$e->id)).'">';
	$lend = '</a>';
}
if ($e->status) {
	echo '<tr>
		<td></td>
		<td>'.$division->name.'</td>
		<td>'.$link.$e->boat->sail.$lend.'</td>
		<td>'.$link.$e->boat->name.$lend.'</td>
		<td>'.$e->boat->model.'</td>
		<td>'.$e->phrf.'</td>
		<td>'.($e->spinnaker ? 'Y' : 'N').'</td>
		<td>'.($e->rollerFurling ? 'Y' : 'N').'</td>
		<td>'.$e->status.'</td>
		<td></td>';
	if ($race->method === 'TOT') {
		echo '<td></td>';
	}
	echo '<td></td>
		<td></td>
	</tr>';
	return;
}
$tend = strtotime($race->racedate.' '.$e->finish);
$telapsed = $tend - $tstart;
$elapsed = $this->strtohms($telapsed);
$gap = '';
if ($finishers > $i) {
	$tcorrected = strtotime($race->racedate.' '.$e->corrected);
	$tothercorr = strtotime($race->racedate.' '.$entries[$i]->corrected);
	$secs = $tothercorr - $tcorrected;
	$gap = $this->strtohms($secs);
}
echo '<tr>
	<td>'.$link.$i.$lend.'</td>
	<td>'.$division->name.'</td>
	<td>'.$link.$e->boat->sail.$lend.'</td>
	<td>'.$link.$e->boat->name.$lend.'</td>
	<td>'.$e->boat->model.'</td>
	<td>'.$e->phrf.'</td>
	<td>'.($e->spinnaker ? 'Y' : 'N').'</td>
	<td>'.($e->rollerFurling ? 'Y' : 'N').'</td>
	<td>'.$e->finish.'</td>
	<td>'.$elapsed.'</td>';
if ($race->method === 'TOT') {
	echo '<td>'.sprintf('%.02f', $e->tcf).'</td>';
}
echo '<td>'.$e->corrected.'</td>
	<td>'.$gap.'</td>
</tr>';
