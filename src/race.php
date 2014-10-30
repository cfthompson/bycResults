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
require_once('classes/Race.php');

if (!array_key_exists('id', $_GET)) {
	header('Location: index.php');
	exit();
}
$race = new Race($_GET['id']);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Berkeley YC Results Program</title>
		<link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
		<h1>Berkeley Yacht Club Results - Race <?php echo $race->id; ?></h1>
		<?php require_once('nav.inc.php'); ?>
		<h4>Date: <?php echo strftime('%D', strtotime($race->racedate)); ?></h4>
		<h4>Type: <?php echo $race->type; ?></h4>

		<h3>Entries:</h3>
	</body>
</html>
