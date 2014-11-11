<?php require_once('auth.php'); ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require_once('classes/Series.php');
require_once('classes/Race.php');
$s = new Series();
$series = $s->findAll();
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

		<ul id="series">
			<?php foreach ($series as $s) { ?>
			<li><a hrf="series.php?id=<?php echo $s->id; ?>"><?php echo $s->name; ?></a>
				<?php if (getAccessLevel() >= User::ADMIN_ACCESS) { ?>
				<a class="newrace" href="race.php?seriesid=<?php echo $s->id; ?>&edit=true">Add a Race</a>
				<?php } ?>
				<?php require('races.inc.php'); ?></li>
			<?php } ?>
		</ul>
    </body>
</html>
