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
require_once('classes/SeriesType.php');
require_once('classes/Course.php');

// @variable $race

$msg = array(
	'top'=>'',
	'seriesid'=>'',
	'date'=>'',
	'preparer'=>'',
	'rcskipper'=>'',
	'rcboat'=>'',
);

function parseRaceForm() {
	global $msg, $race;
	$post = $_POST['race'];
	if (empty($post)) {
		$msg['top'] = 'Please enter values before submitting';
		return;
	}

	if (empty($post['racedate'])) {
		$msg['date'] = 'Please enter a race date';
		return;
	}
	$result = preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $post['racedate']);
	if ($result === false) {
		$msg['date'] = 'Error parsing date';
		return;
	} else if ($result === 0) {
		$msg['date'] = 'Invalid date format';
		return;
	}

	$race = new Race($post);
	if (!$race->seriesid) {
		$msg['seriesid'] = 'Please select a series';
		return;
	}
	if (!$race->save()) {
		$msg['top'] = 'Failed to save your changes - please check values';
		return;
	}
	header('Location: entries.php?raceid='.$race->id.'&edit=true');
	exit();
}

if (array_key_exists('submit', $_POST)) {
	parseRaceForm();
}

// Retrieve all divisions for this race
$div = new Division();
$divs = $div->findAll('raceid='.$race->id, 'starttime');
$msg['div'] = array();
foreach ($divs as $d) {
	$msg['div'][$d->id] = array(
		'starttime'=>'',
		'course'=>'');
}

// Default to today's date
if (empty($race->racedate)) {
	$race->racedate = strftime('%Y-%m-%d');
}
$t = strtotime($race->racedate);
$racedate = strftime('%m/%d/%Y', $t);

$title = array_key_exists('id', $_GET) ?
	'Information for Race '.$_GET['id'] :
	'Information for new Race';
?>
<h2><?php echo $title; ?></h2>
<div class="errormsg"><?php echo $msg['top']; ?></div>
<?php $series = new Series();
$allseries = $series->findAll();
foreach ($allseries as $s) {
	echo '<span style="display:none" id="series_'.$s->id.'">'.$s->typeid.'$$'.$s->name.'</span>';
} 
$course = new Course();
$allcourses = $course->findAll();
foreach ($allcourses as $c) {
	echo '<span style="display:none" id="course_'.$c->id.'">'.$c->number.'$$'.$c->distance.'</span>';
}
?>
<form id="raceform" method="post">
	<table id="race">
		<tr>
			<th>Series:</th>
			<td><select name="race[seriesid]" id="seriesid">
					<option></option>
					<?php foreach ($allseries as $s) {
						$sel = $s->id == $race->seriesid ? 'selected' : '';
						echo "<option value='{$s->id}' $sel>{$s->name}</option>";
					}?>
				</select></td>
			<td class="errormsg"><?php echo $msg['seriesid']; ?></td>
		</tr>
		<tr>
			<th>Race Date:</th>
			<td><input type="text" name="race[racedate]" id="racedate" value="<?php echo $racedate; ?>"> (MM/DD/YYYY)</td>
			<td class="errormsg"><?php echo $msg['date']; ?></td>
		</tr>
		<tr>
			<th>Prepared By:</th>
			<td><input type="text" name="race[preparer]" id="preparer" value="<?php echo $race->preparer; ?>"></td>
			<td class="errormsg"><?php echo $msg['preparer']; ?></td>
		</tr>
		<tr>
			<th>Committee Boat:</th>
			<td><input type="text" name="race[rcskipper]" id="rcskipper" value="<?php echo $race->rcskipper; ?>"></td>
			<td class="errormsg"><?php echo $msg['rcskipper']; ?></td>
		</tr>
		<tr>
			<th>RC Boat Skipper:</th>
			<td><input type="text" name="race[rcboat]" id="rcboat" value="<?php echo $race->rcboat; ?>"></td>
			<td class="errormsg"><?php echo $msg['rcboat']; ?></td>
		</tr>
		<?php foreach ($divs as $d) {
			$hour = intval($d->starttime/3600);
			$minute = ($d->starttime - ($hour*3600))/60;
			echo '<tr><th colspan="3">'.$d->name.' Division:</th></tr>'
					. '<tr><th>Start Time (HHMM):</th>'
					. '<td>'
					. '<input type="number" name="race[divisions]['.$d->id.'][starthour]" value="'.$hour.'">'
					. '<input type="number" name="race[divisions]['.$d->id.'][startminute]" value="'.$minute.'"></td>'
					. '<td class="errormsg">'.$msg['div'][$d->id]['starttime'].'</td>'
					. '</tr>'
					. '<tr><th>Course:</th>'
					. '<td><select id="course"><option value="0"></option>';
			foreach ($allcourses as $c) {
				echo '<option value="'.$c->id.'">'.$c->number.'</option>';
			}
			echo '</select></td>'
					. '<td class="errormsg">'.$msg['div'][$d->id]['course'].'</td>'
					. '</tr>'
					. '<tr><th>Distance:</th>'
					. '<td><span id="distance"></span></td>'
					. '<td></td>'
					. '</tr>';
		} ?>
		<tr>
			<th></th>
			<td><input type="submit" name="submit" id="submit" value="Next->"></td>
			<td class="errormsg"></td>
		</tr>
	</table>
</form>
