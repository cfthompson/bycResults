<!DOCTYPE html>
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
require_once('auth.php');
require_once('classes/Series.php');
require_once('classes/SeriesTypes.php');

$msg = array(
	'top'=>'',
	'seriestype'=>'',
	'seriesname'=>'',
);
$seriestype = 0;

function parseSeriesForm() {
	global $msg, $seriestype;
	if (!array_key_exists('seriestype', $_POST) || empty($_POST['seriestype'])) {
		$msg['seriestype'] = 'Please select a series type';
		return;
	}
	$seriestype = $_POST['seriestype'];
	$st = new SeriesTypes($seriestype);
	$series = new Series($_POST['series']);
	if (empty($series->name)) {
		$msg['seriesname'] = 'Please enter a name';
		return;
	}
	$series->name = $st->name.' '.$series->name;
	if (!$series->save()) {
		$msg['top'] = 'Failed to save series';
		return;
	}
	header('Location: series.php?id='.$series->id);
	exit();
}

if (array_key_exists('submit', $_POST)) {
	parseSeriesForm();
}

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>BYC Results: Series</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/series.js"></script>
    </head>
    <body>
		<h1>Berkeley Yacht Club Results</h1>
		<?php require_once('nav.inc.php'); ?>
		<form id="seriesform" method="post">
		<?php
		$id = false;
		if (array_key_exists('id', $_GET)) {
			$id = $_GET['id'];
			if (!is_numeric($id)) $id = false;
			else {
				echo '<input type="hidden" name="series[id]" value="'.$id.'">';
			}
		}
		$series = new Series($id);
		$type = new SeriesTypes();
		$types = $type->findAll();
		?>
		<div class="errormsg"><?php echo $msg['top']; ?></div>
		<table id="series">
			<tr>
				<th>Type:</th>
				<td><select id="seriestype" name="seriestype" onchange="seriestype_change()">
						<option></option>
						<?php foreach ($types as $t) {
							$sel = $t->id == $seriestype ? 'selected' : '';
							echo "<option class='seriestype' value='{$t->id}' $sel>{$t->name}</option>";
						} ?>
				</td>
				<td class="errmsg"><?php echo $msg['seriestype']; ?></td>
			</tr>
			<tr>
				<th>Name:</th>
				<td><span id="seriestypeprefix"></span> <input type="text" name="series[name]" value="<?php echo $series->name; ?>"></td>
				<td class="errmsg"><?php echo $msg['seriesname']; ?></td>
			</tr>
			<tr>
				<th></th>
				<td><input type="submit" name="submit" value="Submit"></td>
			</tr>
		</table>
		</form>
    </body>
</html>
