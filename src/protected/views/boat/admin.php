<?php
/* @var $this BoatController */
/* @var $model Boats */

$this->breadcrumbs=array(
	'Roster'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Roster', 'url'=>array('index')),
	array('label'=>'Add a New Boat', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#boats-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Boats</h1>

<p>Tip: Click on a column header to sort by that field.  Click again to sort in reverse order.</p>
<p>Enter a value in the space below a column header to search by that field.  
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'boats-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
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
		'skipper',
		'email',
		'phone',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update} {delete}',
			'deleteConfirmation'=>'Are you sure you want to delete this boat?  This cannot be undone.',
		),
	),
)); ?>
