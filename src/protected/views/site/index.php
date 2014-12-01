<?php
/* @var $this SiteController */
/* @var $series array of Series */

$this->pageTitle=Yii::app()->name;
?>

<h1>Berkeley Yacht Club Friday Night and Sunday Chowder Series</h1>

<ul id="series">
<?php foreach ($series as $s) {
	echo '<li>'.$s->name.' <a href="'.CHtml::normalizeUrl(array('race/create', 'seriesid'=>$s->id)).'">Add a Race</a>'
			. '<table class="races">'
			. '<tr><th>Date</th><th># Boats</th>';
	if (!Yii::app()->user->isGuest) {
		echo '<th></th>';
	}
	echo '</tr>';
	foreach ($s->races as $r) {
		echo '<tr><td><a href="'.CHtml::normalizeUrl(array('race/view', 'id'=>$r->id)).'">'.$r->racedate.'</a></td><td>'.count($r->entries).'</td>';
		if (!Yii::app()->user->isGuest) {
			echo '<td><a href="'.CHtml::normalizeUrl(array('race/edit', 'id'=>$r->id)).'">Edit</a></td>';
		}
		echo '</tr>';
	}
	echo '</table></li>';
} ?>
</ul>
