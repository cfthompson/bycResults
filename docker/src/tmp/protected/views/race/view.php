<?php
/* @var $this RaceController */
/* @var $race Races */

$this->breadcrumbs=array(
	'Race',
	$race->id,
);

?>
<h3><?php echo $race->series->name; ?> -- Date: <?php echo $race->racedate; ?></h3>

<?php $this->widget('CTabView', array(
	'tabs'=>array(
		'normal'=>array(
			'title'=>'Normal View',
			'view'=>'normal',
			'data'=>array(
				'race'=>$race,
			),
		),
		'cheatsheet'=>array(
			'title'=>'Cheat Sheet',
			'view'=>'cheatsheet',
			'data'=>array(
				'race'=>$race,
			),
		),
	),
)); ?>
