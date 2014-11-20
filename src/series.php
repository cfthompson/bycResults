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
require_once('classes/SeriesType.php');

$msg = array(
	'top'=>'',
	'seriestype'=>'',
	'seriesname'=>'',
);

$id = false;
$edit = false;
if (array_key_exists('id', $_GET)) {
	$id = $_GET['id'];
	if (!is_numeric($id)) $id = false;
	else {
		$edit = array_key_exists('edit', $_GET) && $_GET['edit'];
	}
} else {
	$edit = true;
}
$series = new Series($id);

function parseSeriesForm() {
	global $msg, $series;
	$series = new Series($_POST['series']);
	if (!$series->typeid) {
		$msg['seriestype'] = 'Please select a series type';
		return;
	}
	if (empty($series->name)) {
		$msg['seriesname'] = 'Please enter a name';
		return;
	}
	$series->name = $series->type->name.' '.$series->name;
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
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>BYC Results: Series</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/series.js"></script>
    </head>
    <body>
		<div id="header">
		<img src="http://www.berkeleyyc.org/sites/default/files/byc_site_logo.jpg" alt="Home">
		<h1>Race Results</h1>
		</div>
		<?php require_once('nav.inc.php'); ?>
	<?php if ($edit) {
		$type = new SeriesType();
		$types = $type->findAll();
	?>
		<div class="errormsg"><?php echo $msg['top']; ?></div>
		<form id="seriesform" method="post">
		<?php if ($id) echo '<input type="hidden" name="series[id]" id="seriesid" value="'.$id.'">'; ?>
		<table id="series">
			<tr>
				<th>Type:</th>
				<td><select id="seriestype" name="series[typeid]" onchange="seriestype_change()">
						<option></option>
						<?php foreach ($types as $t) {
							$sel = $t->id == $series->typeid ? 'selected' : '';
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
	<?php } else { ?>
		<table id="series">
			<tr>
				<th>Type:</th>
				<td><?php echo $series->type->name; ?></td>
			</tr>
			<tr>
				<th>Name:</th>
				<td><?php echo $series->name; ?></td>
			</tr>
		</table>
	<?php } ?>
    </body>
</html>
