<?php
/* @var $this BoatController */
/* @var $model Boats */

$this->breadcrumbs=array(
	'Boats'=>array('index'),
	'Add',
);

$this->menu=array(
	array('label'=>'Roster', 'url'=>array('index')),
	array('label'=>'Manage Boats', 
		'url'=>array('admin'),
		'visible'=>!Yii::app()->user->isGuest,
	),
);
?>

<h1>Add a New Boat</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>