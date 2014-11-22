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

require_once('auth.php');
require_once('classes/Course.php');

$course = new Course();
$courses = $course->findAll('', 'number');

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
		<h1>Race Results</h1>
		</div>
		<?php require_once('nav.inc.php'); ?>

		<h2>Courses for Chowder and Friday Night Races:</h2>
		<table>
			<tr>
				<th>Number:</th>
			<?php $i = 0;
			foreach ($courses as $c) {
				if ($c->distance == 0) continue;
				echo '<th>'.$c->number.'</th>';
				++$i;
				if ($i == 20) break;
			} ?>
			</tr>
			<tr>
				<th>Roundings:</th>
			<?php $i = 0;
			foreach ($courses as $c) {
				if ($c->distance == 0) continue;
				$a = explode(', ', $c->roundings);
				echo '<td>'.implode('<br>', $a).'</td>';
				++$i;
				if ($i == 20) break;
			} ?>
			</tr>
			<tr>
				<th>Distance:</th>
			<?php $i = 0;
			foreach ($courses as $c) {
				if ($c->distance == 0) continue;
				echo '<td>'.$c->distance.'</td>';
				++$i;
				if ($i == 20) break;
			} ?>
			</tr>
		</table>

		<table>
			<tr>
				<th>Number:</th>
			<?php $i = 0;
			foreach ($courses as $c) {
				if ($c->distance == 0) continue;
				++$i;
				if ($i <= 20) continue;
				echo '<th>'.$c->number.'</th>';
			} ?>
			</tr>
			<tr>
				<th>Roundings:</th>
			<?php $i = 0;
			foreach ($courses as $c) {
				if ($c->distance == 0) continue;
				++$i;
				if ($i <= 20) continue;
				$a = explode(', ', $c->roundings);
				echo '<td>'.implode('<br>', $a).'</td>';
			} ?>
			</tr>
			<tr>
				<th>Distance:</th>
			<?php $i = 0;
			foreach ($courses as $c) {
				if ($c->distance == 0) continue;
				++$i;
				if ($i <= 20) continue;
				echo '<td>'.$c->distance.'</td>';
			} ?>
			</tr>
		</table>

			<h3>Course 1234:</h3>
			<p>Custom course announced via VHF at least five minutes before the start of the division.</p>

    </body>
</html>
