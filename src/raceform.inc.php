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
$msg = array(
	'top'=>'',
	'type'=>'',
	'date'=>'',
);

function parseRaceForm() {
	global $msg, $race;
	$post = $_POST['race'];
	if (empty($post)) {
		$msg['top'] = 'Please enter values before submitting';
		return;
	}
	$race->type = $post['type'];
	if ($race->type == '') {
		$msg['type'] = 'Please select a race type';
	}
	$date = $post['date'];
	if ($date == '') {
		$msg['date'] = 'Please enter a race date';
	} else {
		$result = preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $date);
		if ($result === false) {
			$msg['date'] = 'Error parsing date';
			return;
		} else if ($result === 0) {
			$msg['date'] = 'Invalid date format';
			return;
		}
		$race->racedate = $date;
	}
	if (!$race->save()) {
		$msg['top'] = 'Failed to save your changes - please check values';
		return;
	}
	header('Location: raceform.php?id='.$race->id.'&edit=true');
	exit();
}

if (array_key_exists('submit', $_POST)) {
	parseRaceForm();
}

// Default to today's date
if (empty($race->racedate)) {
	$race->racedate = strftime('%Y-%m-%d');
}
$racedate = strftime('%m/%d/%Y', strtotime($race->racedate));

$title = array_key_exists('id', $_GET) ?
	'Information for Race '.$_GET['id'] :
	'Information for new Race';
?>
<h2><?php echo $title; ?></h2>
<div class="errormsg"><?php echo $msg['top']; ?></div>
<form id="raceform" method="post">
	<table id="race">
		<tr>
			<th>Race Type:</th>
			<td><select name="race[type]" id="racetype">
					<option></option>
					<?php foreach (Race::$VALID_TYPES as $t) {
						echo "<option>$t</option>";
					}?>
				</select></td>
			<td class="errormsg"><?php echo $msg['type']; ?></td>
		</tr>
		<tr>
			<th>Race Date:</th>
			<td><input type="text" name="race[date]" id="racedate" value="<?php echo $racedate; ?>"> (MM/DD/YYYY)</td>
			<td class="errormsg"><?php echo $msg['date']; ?></td>
		</tr>
		<tr>
			<th></th>
			<td><input type="submit" name="submit" id="submit" value="Submit"></td>
			<td class="errormsg"></td>
		</tr>
	</table>
</form>
