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

/* @var $this SeriesController */
/* @var $model Series */

$this->breadcrumbs=array(
	'Series'=>array('/site/index'),
	'Create',
);
?>
<h1>Add a Series</h1>

<p><strong>NOTE:</strong> You should only do this twice a year, at the
	beginning of a new Sunday Chowder or Friday Night season.  When scoring
	races during the season, please add a race to an 
	<a href="<?php echo CHtml::normalizeUrl(array('site/index')); ?>">existing series</a></p>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
