<?php
/* @var $this RaceController */
/* @var $race Races */

$this->breadcrumbs=array(
	'Race',
	'View',
	$race->id,
);

?>
<h1 class="hide-on-print">Race <?php echo $race->id.': '.$race->racedate; ?></h1>

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
