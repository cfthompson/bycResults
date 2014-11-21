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


// NOT YET IMPLEMENTED
// This page will need a Captcha element, which I don't feel like
// implementing until I have ported the application to Yii,
// so for now it just redirects to index.php.
// -- Nov. 2014 Bob Gunion
header('Location: index.php');
exit();

require_once('auth.php');
require_once('classes/Boat.php');
require_once('classes/Registration.php');

$id = false;
if (array_key_exists('id', $_GET) && is_numeric($_GET['id'])) {
	$id = intval($_GET['id']);
}
$boat = new Boat($id);

$msg = array();
$msg['top'] = '';
if (array_key_exists('submit', $_POST)) {
	$reg = new Registration($_POST['boat']);
	if (!$reg->save()) {
		$msg['top'] = "Failed to save boat.  Please try again.";
	} else {
		echo '<h1>THANK YOU!</h1><p>Your registration has been submitted.  Next step: come out and race!</p><p>You will be redirected to our racing page in a few seconds.  Or, click <a href="http://berkeleyyc.org/racing">here.</a></p>';
		echo '<script type="text/javascript">setTimeout(function() {window.location.replace("http://berkeleyyc.org/racing");}, 5000);</script>';
		exit();
	}
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Berkeley YC Results Program</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<script type="text/javascript" src="js/jquery.js"></script>
    </head>
    <body>
		<div id="header">
		<img src="http://www.berkeleyyc.org/sites/default/files/byc_site_logo.jpg" alt="Home">
		<h1>Race Results</h1>
		</div>
		<?php require_once('nav.inc.php'); ?>

		<h2>Register Your Boat</h2>
		<p>Use this page to register for races.  Please note:</p>
		<ul>
			<li>The following applies ONLY to Berkeley Friday Night and Chowder Race Series.  For all other Berkeley events, please visit us at <a href='http://berkeleyyc.org/racing'>our Main Racing Page.</a></li>
			<li>For Friday Nights and Sunday Chowders:  NO ENTRY FEE!</li>
			<li>No need to register more than once.  If the skipper contact info, and the info shown on <a href="roster.php">the boat list</a> is correct, you're all set!</li>
			<li>For security reasons, the Owner's Name, Email, and Phone are not automatically filled in even if we have that information, so you will need to enter it again.</li>
			<li>For new boats or if your information has changed, please fill in the information below:</li>
		</ul>
		<form id="registerform" method="post" enctype="multipart/form-data">
			<?php if ($boat->id) { ?>
			<input type="hidden" name="boat[id]" value="<?php echo $boat->id; ?>">
			<?php } ?>
			<div id="top" class="errormsg"><?php echo $msg['top']; ?></div>
			<table id="registertable">
				<tr>
					<th>Yacht's Name:</th>
					<td><input type="text" name="boat[name]" value="<?php echo $boat->name; ?>"></td>
				</tr>
				<tr>
					<th>Boat Type:</th>
					<td><input type="text" name="boat[model]" value="<?php echo $boat->model; ?>"></td>
				</tr>
				<tr>
					<th>Length (LOA, feet):</th>
					<td><input type="number" name="boat[length]" value="<?php echo $boat->length; ?>"></td>
				</tr>
				<tr>
					<th>Sail #:</th>
					<td><input type="text" name="boat[sail]" value="<?php echo $boat->sail; ?>"></td>
				</tr>
				<tr>
					<th>Base PHRF (excluding credits for non-spinnaker or roller furling):</th>
					<td><input type="number" name="boat[phrf]" value="<?php echo $boat->phrf; ?>"></td>
				</tr>
				<tr>
					<th>Attach a PHRF certificate if available:</th>
					<td><input type="file" name="cert"></td>
				</tr>
				<tr>
					<th>Roller Furling?</th>
					<td><input type="checkbox" name="boat[rollerFurling]" value="<?php echo $boat->rollerFurling; ?>"></td>
				</tr>
				<tr>
					<th>Owner's Name:</th>
					<td><input type="text" name="boat[skipper]"></td>
				</tr>
				<tr>
					<th>Email:</th>
					<td><input type="text" name="boat[email]"></td>
				</tr>
				<tr>
					<th>Phone #:</th>
					<td><input type="text" name="boat[phone]"></td>
				</tr>
				<tr>
					<th colspan="2">CLICKING ON "SUBMIT" CONSTITUTES A LEGAL SIGNATURE:  By clicking "Submit", you agree to hold the City of Berkeley, The Berkeley Yacht Club, and the Cal Sailing Club harmless from any claims for damage or injury to boat or crew as a result of participation in this series of races.</th>
				<tr>
					<th></th>
					<td><input type="submit" name="submit" value="Submit"></td>
				</tr>
			</table>
		</form>
	</body>
</html>
