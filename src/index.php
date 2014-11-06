<?php require_once('auth.php'); ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require_once('classes/Race.php');
$r = new Race();
$races = $r->findAll('', 'racedate DESC');
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Berkeley YC Race Results</title>
		<link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
		<div id="header">
		<img src="http://www.berkeleyyc.org/sites/default/files/byc_site_logo.jpg" alt="Home">
		</div>
		<h1>Berkeley Yacht Club Race Results</h1>
		<?php require_once('nav.inc.php'); ?>

		<table id="races">
			<tr>
				<th>Date</th>
				<th>Type</th>
				<th># Boats</th>
				<?php if (getAccessLevel() >= User::ADMIN_ACCESS) {
					echo '<th>Edit</th>';
				} ?>
			</tr>
			<?php foreach ($races as $race) {
				echo '<tr>
				<td><a href="race.php?id='.$race->id.'">'.$race->racedate.'</a></td>
				<td>'.$race->type.'</td>
				<td>'.count($race->entries).'</td>
				';
				if (getAccessLevel() >= User::ADMIN_ACCESS) {
					echo '<td><a href="race.php?id='.$race->id.'&edit=true">Edit</a></td>';
				}
				echo '</tr>';
			} ?>
		</table>
    </body>
</html>
