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

$allseries = array();
foreach (Series::model()->findAll() as $s) {
	$allseries[$s->id] = $s->name;
}

return array(
	'title'=>'Enter basic race info',
	'elements'=>array(
		'seriesid'=>array(
			'type'=>'dropdownlist',
			'items'=>$allseries,
		),
		'racedate'=>array(
			'type'=>'date',
		),
		'rcboat'=>array(
			'type'=>'text',
			'maxlength'=>30,
		),
		'rcskipper'=>array(
			'type'=>'text',
			'maxlength'=>30,
		),
		'preparer'=>array(
			'type'=>'text',
			'maxlength'=>30,
		),
		'method'=>array(
			'type'=>'dropdownlist',
			'items'=>array('TOT'=>'TOT', 'TOD'=>'TOD'),
		),
		'param1'=>array(
			'type'=>'number',
		),
		'param2'=>array(
			'type'=>'number',
		),
	),
	'buttons'=>array(
		'submit'=>array(
			'type'=>'submit',
			'label'=>'Next',
		),
	),
);