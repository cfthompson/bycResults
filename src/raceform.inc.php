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
	'method'=>'',
	'param1'=>'',
	'param2'=>'',
);

function parseRaceForm() {
	global $msg, $race, $id;
	$post = $_POST['race'];
	if (empty($post)) {
		$msg['top'] = 'Please enter values before submitting';
		return;
	}

	if (empty($post['racedate'])) {
		$msg['date'] = 'Please enter a race date';
		return;
	}
	$result = preg_match('/^(\d{2})\/?(\d{2})\/?(\d{4})$/', $post['racedate'], $matches);
	if ($result === false) {
		$msg['date'] = 'Error parsing date';
		return;
	} else if ($result === 0) {
		$msg['date'] = 'Invalid date format';
		return;
	}
	// Ensure racedate is in expected format
	$post['racedate'] = $matches[1].'/'.$matches[2].'/'.$matches[3];

	if (empty($post['method'])) {
		$msg['method'] = 'Please enter a calculation method';
		return;
	}
	if ($post['method'] === 'TOT') {
		if (empty($post['param1'])) {
			$msg['param1'] = 'Please enter parameters for time-on-time calculation';
		}
		if (empty($post['param2'])) {
			$msg['param2'] = 'Please enter parameters for time-on-time calculation';
		}
		if ($msg['param1'] || $msg['param2']) return;
	}

	$race = new Race($post);
	if (!$race->seriesid) {
		$msg['seriesid'] = 'Please select a series';
		return;
	}

	$divisions = array();
	foreach ($_POST['division'] as $divid=>$vals) {
		if (!array_key_exists('course', $vals) || !is_numeric($vals['course'])
				|| $vals['course'] < 1) {
			$msg['div'][$divid]['course'] = 'Please enter a course number';
			return;
		}
		if (!array_key_exists('distance', $vals) || !is_numeric($vals['distance'])
				|| $vals['distance'] <= 0.0) {
			$msg['div'][$divid]['distance'] = 'Please enter a valid distance';
			return;
		}
		$result = preg_match('/^(\d{2}):?(\d{2})/', $vals['starthourminute'], $matches);
		if ($result === false) {
			$msg['div'][$divid]['starttime'] = 'Error parsing start time';
			return;
		} else if ($result === 0) {
			$msg['div'][$divid]['starttime'] = 'Invalid start time';
			return;
		}
		$starttime = $matches[1].':'.$matches[2].':00';
		$div = new Division($vals);
		if ($divid > 0) {
			$div->id = $divid;
		}
		$div->starttime = $starttime;
		$divisions[$divid] = $div;
	}
	$race->divisions = $divisions;

	if ($id) {
		$oldRace = new Race($id);
	}

	if (!$race->save()) {
		$msg['top'] = 'Failed to save your changes - please check values';
		return;
	}

	if ($id) {
		// Update corrected times for all entries if the calculation method has changed
		if ($oldRace->method != $race->method
			|| $oldRace->param1 != $race->param1
			|| $oldRace->param2 != $race->param2) {
			foreach ($race->entries as $e) {
				$e->race = $race;
				$e->save(true);
			}
		}
	}

	echo '<script type="text/javascript">window.location.replace("entries.php?raceid='.$race->id.'&edit=true");</script>';
	exit();
}

$id = false;
if (array_key_exists('id', $_GET) && is_numeric($_GET['id'])) {
	$id = intval($_GET['id']);
}

$divs = $race->divisions;
$msg['div'] = array();
foreach ($divs as $d) {
	$msg['div'][$d->id] = array(
		'starttime'=>'',
		'course'=>'',
		'distance'=>'');
}

if (array_key_exists('submit', $_POST)) {
	parseRaceForm();
}

// Default to today's date
if (empty($race->racedate)) {
	$race->racedate = strftime('%Y-%m-%d');
}
$t = strtotime($race->racedate);
$racedate = strftime('%m/%d/%Y', $t);

$title = $id ?
	'Information for Race '.$_GET['id'] :
	'Information for new Race';
?>
<h2><?php echo $title; ?></h2>
<div class="errormsg"><?php echo $msg['top']; ?></div>
<?php $series = new Series();
$allseries = $series->findAll();
foreach ($allseries as $s) {
	$str = implode('$$', array(
		$s->typeid,
		$s->name,
		$s->defaultMethod,
		$s->defaultParam1,
		$s->defaultParam2,
	));
	echo '<span style="display:none" id="series_'.$s->id.'">'.$str.'</span>';
} 
$course = new Course();
$allcourses = $course->findAll();
foreach ($allcourses as $c) {
	$str = implode('$$', array(
		$c->number,
		$c->distance,
	));
	echo '<span style="display:none" class="courseid" id="course_'.$c->id.'">'.$str.'</span>';
}

?>
<form id="raceform" method="post">
	<?php if ($id) {
		echo '<input type="hidden" id="raceid" name="race[id]" value="'.$id.'">';
	} ?>
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
			<th>RC Boat Skipper:</th>
			<td><input type="text" name="race[rcskipper]" id="rcskipper" value="<?php echo $race->rcskipper; ?>"></td>
			<td class="errormsg"><?php echo $msg['rcskipper']; ?></td>
		</tr>
		<tr>
			<th>Committee Boat:</th>
			<td><input type="text" name="race[rcboat]" id="rcboat" value="<?php echo $race->rcboat; ?>"></td>
			<td class="errormsg"><?php echo $msg['rcboat']; ?></td>
		</tr>
		<tr>
			<th>Method:</th>
			<td><select name="race[method]" id="method">
				<option></option>
				<?php $seriestype = new SeriesType();
				foreach ($seriestype->findAll() as $st) {
					$sel = $race->method == $st->defaultMethod ? 'selected' : '';
					echo '<option value="'.$st->defaultMethod.'" '.$sel.'>'.$st->defaultMethod.'</option>';
				} ?>
				</select>
			</td>
			<td class="errormsg"><?php echo $msg['method']; ?></td>
		</tr>
		<tr>
			<th>Parameter 1:</th>
			<td><input type="number" name="race[param1]" id="param1" value="<?php echo $race->param1; ?>"></td>
			<td class="errormsg"><?php echo $msg['param1']; ?></td>
		</tr>
		<tr>
			<th>Parameter 2:</th>
			<td><input type="number" name="race[param2]" id="param2" value="<?php echo $race->param2; ?>"></td>
			<td class="errormsg"><?php echo $msg['param2']; ?></td>
		</tr>
		<tr id="divisionheader">
			<th colspan="3">Divisions</th>
		</tr>
		<tr>
			<th></th>
			<td><input type="submit" name="submit" id="submit" value="Next->" <?php echo ($id ? '' : 'disabled'); ?>></td>
			<td class="errormsg"></td>
		</tr>
	</table>
</form>
