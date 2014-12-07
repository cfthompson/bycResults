<?php
/* @var $this BoatController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Roster',
);

if (!Yii::app()->user->isGuest) {
	$this->menu=array(
		array('label'=>'Add a New Boat', 'url'=>array('create')),
		array('label'=>'Manage Boats', 'url'=>array('admin')),
	);
}
?>

<h1>Roster</h1>

<p>Tip: Click on a column header to sort by that field.  Click again to sort in reverse order.</p>

<?php if (Yii::app()->user->isGuest) {
	$columns = array(
		'sail',
		'name',
		'model',
		'phrf',
		'length',
		array(
			'name'=>'rollerFurling',
			'class'=>'CSortableCheckBoxColumn',
			'selectableRows'=>0,
			'checked'=>'$data->rollerFurling',
		),
	);
} else {
	$columns = array(
		array(
			'name'=>'sail',
			'class'=>'CSortableLinkColumn',
			'labelExpression'=>'$data->sail',
			'urlExpression'=>'Yii::app()->createUrl("boat/update", array("id"=>$data->id))',
		),
		array(
			'name'=>'name',
			'class'=>'CSortableLinkColumn',
			'labelExpression'=>'$data->name',
			'urlExpression'=>'Yii::app()->createUrl("boat/update", array("id"=>$data->id))',
		),
		array(
			'name'=>'model',
			'class'=>'CSortableLinkColumn',
			'labelExpression'=>'$data->model',
			'urlExpression'=>'Yii::app()->createUrl("boat/update", array("id"=>$data->id))',
		),
		array(
			'name'=>'phrf',
			'class'=>'CSortableLinkColumn',
			'labelExpression'=>'$data->phrf',
			'urlExpression'=>'Yii::app()->createUrl("boat/update", array("id"=>$data->id))',
		),
		array(
			'name'=>'length',
			'class'=>'CSortableLinkColumn',
			'labelExpression'=>'$data->length',
			'urlExpression'=>'Yii::app()->createUrl("boat/update", array("id"=>$data->id))',
		),
		array(
			'name'=>'rollerFurling',
			'class'=>'CSortableCheckBoxColumn',
			'selectableRows'=>0,
			'checked'=>'$data->rollerFurling',
		),
		array(
			'name'=>'skipper',
			'class'=>'CSortableLinkColumn',
			'labelExpression'=>'$data->skipper',
			'urlExpression'=>'Yii::app()->createUrl("boat/update", array("id"=>$data->id))',
		),
		array(
			'name'=>'email',
			'class'=>'CSortableLinkColumn',
			'labelExpression'=>'$data->email',
			'urlExpression'=>'Yii::app()->createUrl("boat/update", array("id"=>$data->id))',
		),
		array(
			'name'=>'phone',
			'class'=>'CSortableLinkColumn',
			'labelExpression'=>'$data->phone',
			'urlExpression'=>'Yii::app()->createUrl("boat/update", array("id"=>$data->id))',
		),
	);
} ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=>$columns,
)); ?>
