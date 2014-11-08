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
foreach ($divs as $d) {
	$items[$d->id] = array(
		'name'=>$d->name,
		'defaultstarttime'=>$d->defaultstarttime,
		'minphrf'=>$d->minphrf,
		'maxphrf'=>$d->maxphrf,
		'minlength'=>$d->minlength,
		'maxlength'=>$d->maxlength,
	);
}
echo json_encode($items);
