<?php
/* @var $this RacesController */
/* @var $model Races */

foreach (Seriestypes::model()->findAll() as $s) {
	$str = implode('$$', array(
		$s->id,
		$s->name,
		$s->defaultMethod,
		$s->defaultParam1,
		$s->defaultParam2,
	));
	echo '<span style="display:none" class="seriestype" id="seriestype_'.$s->id.'">'.$str.'</span>';
}

$courses = Courses::model()->findAll();
foreach ($courses as $c) {
	$str = implode('$$', array(
		$c->number,
		$c->distance,
	));
	echo '<span style="display:none" class="course" id="course_'.$c->id.'">'.$str.'</span>';
}
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'series-create-form',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
)); ?>

	<?php echo $form->hiddenField($model,'id'); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'typeid'); ?>
		<?php echo $form->dropDownList($model,'typeid', 
				CHtml::listData(Seriestypes::model()->findAll(), 'id', 'name')
				); ?>
		<?php echo $form->error($model,'typeid'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model, 'name', array(
				'size'=>40,
			)); ?>
		<?php echo $form->error($model, 'name'); ?>
 		<em>(auto-filled with type)</em>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'defaultMethod'); ?>
		<?php echo $form->dropDownList($model,'defaultMethod', array(
			'TOT'=>'Time on Time',
			'TOD'=>'Time on Distance',
		)); ?>
		<?php echo $form->error($model,'defaultMethod'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'defaultParam1'); ?>
		<?php echo $form->numberField($model,'defaultParam1'); ?>
		<?php echo $form->error($model,'defaultParam1'); ?>
 		<em>(for Time on Time)</em>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'defaultParam2'); ?>
		<?php echo $form->numberField($model,'defaultParam2'); ?>
		<?php echo $form->error($model,'defaultParam2'); ?>
 		<em>(for Time on Time)</em>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit', array(
			'id'=>'submit',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->