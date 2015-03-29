<?php
/* @var $this SeriesController */
/* @var $model Races */

$this->breadcrumbs=array(
	'Series'=>array('/site/index'),
	'Edit',
	$model->id,
);
?>
<h1>Series <?php echo $model->id.': '.$model->name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
