<?php
/* @var $this RaceController */
/* @var $model Races */

$this->breadcrumbs=array(
	'Race'=>array('/race/view', 'id'=>$model->id),
	'Edit',
	$model->id,
);
?>
<h1>Race <?php echo $model->id.': '.$model->racedate; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
