<?php
/* @var $this SiteController */
/* @var $series array of Series */
/* @data array of series/races for CTreeView */

$this->pageTitle=Yii::app()->name;
?>

<h1>Berkeley Yacht Club Friday Night and Sunday Chowder Series</h1>

<a href="<?php echo CHtml::normalizeUrl(array('/series/create')); ?>">Add a New Series</a>
<br/>
<br/>

<?php $this->widget('CTreeView', array(
	'data'=>$data,
	'animated'=>'fast',
	'htmlOptions'=>array(
		'class'=>'filetree',
		//'class'=>'treeview-famfamfam',
	),
	'url'=>CHtml::normalizeUrl(array('site/treeDataForSeries')),
)); ?>
