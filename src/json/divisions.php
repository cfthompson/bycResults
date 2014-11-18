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
require_once(dirname(__FILE__).'/../classes/DivisionType.php');
require_once(dirname(__FILE__).'/../classes/Race.php');

$raceid = false;
if (array_key_exists('raceid', $_GET) && is_numeric($_GET['raceid'])) {
	$raceid = intval($_GET['raceid']);
}
$race = new Race($raceid);
if ($race->id) {
	foreach ($race->divisions as $d) {
		$items[$d->id] = array(
			'name'=>$d->name,
			'starttime'=>$d->starttime,
			'minphrf'=>$d->minphrf,
			'maxphrf'=>$d->maxphrf,
			'minlength'=>$d->minlength,
			'maxlength'=>$d->maxlength,
			'course'=>$d->course,
			'distance'=>$d->distance,
		);
	}
	echo json_encode($items);
	exit();
}

if (!array_key_exists('seriestypeid', $_GET) || !is_numeric($_GET['seriestypeid'])) {
	echo json_encode("");
	exit();
}

$seriestypeid = intval($_GET['seriestypeid']);
$div = new DivisionType();
$divs = $div->findAll('seriestypeid='.$seriestypeid);
if (!$divs) {
	echo json_encode(array());
	exit();
}

$items = array();
$divid = -1;
foreach ($divs as $d) {
	$items[$divid] = array(
		'name'=>$d->name,
		'starttime'=>$d->defaultstarttime,
		'minphrf'=>$d->minphrf,
		'maxphrf'=>$d->maxphrf,
		'minlength'=>$d->minlength,
		'maxlength'=>$d->maxlength,
		'course'=>0,
		'distance'=>0,
	);
	$divid -= 1;
}
echo json_encode($items);
