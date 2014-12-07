<?php
/* @var $this BoatController */
/* @var $model Boats */

$this->breadcrumbs=array(
	'Boats'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Roster', 'url'=>array('index')),
	array('label'=>'Add a New Boat', 'url'=>array('create')),
	array('label'=>'Edit this Boat', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Boats', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Boats', 'url'=>array('admin')),
);
?>

<h1>View Boats #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'timestamp',
		'sail',
		'name',
		'model',
		'phrf',
		'FridayNightClass',
		'rollerFurling',
		'skipper',
		'email',
		'phone',
		'length',
	),
)); ?>
