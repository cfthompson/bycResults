<?php
/* @var $this BoatController */
/* @var $model Boats */

$this->breadcrumbs=array(
	'Boats'=>array('index'),
	'Update',
);

$this->menu=array(
	array('label'=>'Roster', 'url'=>array('index')),
	array('label'=>'Add a New Boat', 'url'=>array('create')),
	array('label'=>'Manage Boats', 'url'=>array('admin')),
	array('label'=>'Delete this Boat', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this boat?  This cannot be undone!')),
);
?>

<h1>Update Boat <?php echo $model->name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>