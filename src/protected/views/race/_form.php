<?php
/* @var $this RacesController */
/* @var $model Races */

foreach (Series::model()->findAll() as $s) {
	$str = implode('$$', array(
		$s->typeid,
		$s->name,
		$s->defaultMethod,
		$s->defaultParam1,
		$s->defaultParam2,
	));
	echo '<span style="display:none" class="series" id="series_'.$s->id.'">'.$str.'</span>';
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
	'id'=>'races-create-form',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
)); ?>

	<?php echo $form->hiddenField($model,'id'); ?>
	<?php echo $form->hiddenField($model,'seriesid'); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'seriesid'); ?>
		<?php echo $form->dropDownList($model,'seriesid', 
				CHtml::listData(Series::model()->findAll(), 'id', 'name'),
				array(
					'disabled'=>true,
				)); ?>
		<?php echo $form->error($model,'seriesid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'racedate'); ?>
		<?php echo $form->dateField($model,'racedate'); ?>
		<?php echo $form->error($model,'racedate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rcboat'); ?>
		<?php echo $form->textField($model,'rcboat'); ?>
		<?php echo $form->error($model,'rcboat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rcskipper'); ?>
		<?php echo $form->textField($model,'rcskipper'); ?>
		<?php echo $form->error($model,'rcskipper'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'preparer'); ?>
		<?php echo $form->textField($model,'preparer'); ?>
		<?php echo $form->error($model,'preparer'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'method'); ?>
		<?php echo $form->dropDownList($model,'method', array('TOT'=>'Time on Time', 'TOD'=>'Time on Distance')); ?>
		<?php echo $form->error($model,'method'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'param1'); ?>
		<?php echo $form->numberField($model,'param1'); ?>
		<?php echo $form->error($model,'param1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'param2'); ?>
		<?php echo $form->numberField($model,'param2'); ?>
		<?php echo $form->error($model,'param2'); ?>
	</div>

	<div id="divisiontop">
		<?php if ($model->divisions) {

			foreach ($model->divisions as $d) {
				echo '<div class="row">'.
				'<div class="row divisionheader">'.$d->name.' Division:</div>'.
				'<input type="hidden" name="Races[divisions]['.$d->id.'][name]" value="'.$d->name.'">'.
				'<input type="hidden" name="Races[divisions]['.$d->id.'][typeid]" value="'.$d->id.'">'.
				'<input type="hidden" name="Races[divisions]['.$d->id.'][minphrf]" value="'.$d->minphrf.'">'.
				'<input type="hidden" name="Races[divisions]['.$d->id.'][maxphrf]" value="'.$d->maxphrf.'">'.
				'<input type="hidden" name="Races[divisions]['.$d->id.'][minlength]" value="'.$d->minlength.'">'.
				'<input type="hidden" name="Races[divisions]['.$d->id.'][maxlength]" value="'.$d->maxlength.'">'.
				'<div class="row divisionrow">'.
				'<label for="Races_divisions_'.$d->id.'_starthourminute">Start Time:</label>'.
				'<input type="hidden" name="Races[divisions]['.$d->id.'][typeid]" value="'.$d->typeid.'">'.
				'<input type="text" name="Races[divisions]['.$d->id.'][starthourminute]" id="Races_divisions_'.$d->id.'_starthourminute" value="'.$d->starttime.'">'.
				' (HH:MM)<div class="errorMessage" id="Races_divisions_'.$d->id.'_em_" style="display:none"></div>'.
				'</div>'.
				'<div class="row divisionrow"><label for="Races_divisions_'.$d->id.'_courseid">Course:</label>'.
				'<select class="course" name="Races[divisions]['.$d->id.'][courseid]" id="Races_divisions_'.$d->id.'_courseid"><option></option>';
				foreach ($courses as $c) {
					$sel = $d->courseid === $c->id ? 'selected' : '';
					echo '<option '.$sel.' value="'.$c->id.'">'.$c->number.'</option>';
				}
				echo '</select>'.
				'<div class="errorMessage" id="Races_divisions_'.$d->id.'_course_em_" style="display:none"></div>'.
				'</div>'.
				'<div class="row divisionrow"><label for="Races_divisions_'.$d->id.'_distance">Distance:</label>'.
				'<input readonly name="Races[divisions]['.$d->id.'][distance]" id="Races_divisions_'.$d->id.'_distance" class="distance" value="'.$d->distance.'">'.
				'<div class="errorMessage" style="display:none"></div>';
			}
		} else {

			$i = -1;
			foreach (DivisionTypes::model()->findAllByAttributes(array('seriestypeid'=>$model->series->typeid)) as $d) {
				echo '<div class="row">';
				echo '<input type="hidden" name="Races[divisions]['.$i.'][name]" value="'.$d->name.'">';
				echo '<input type="hidden" name="Races[divisions]['.$i.'][typeid]" value="'.$d->id.'">';
				echo '<input type="hidden" name="Races[divisions]['.$i.'][minphrf]" value="'.$d->minphrf.'">';
				echo '<input type="hidden" name="Races[divisions]['.$i.'][maxphrf]" value="'.$d->maxphrf.'">';
				echo '<input type="hidden" name="Races[divisions]['.$i.'][minlength]" value="'.$d->minlength.'">';
				echo '<input type="hidden" name="Races[divisions]['.$i.'][maxlength]" value="'.$d->maxlength.'">';
				echo '<label for="Races_divisions_'.$i.'_starttime">Start Time</label>';
				echo $form->textField($d, 'defaultstarttime', array(
					'id'=>'Races_divisions_'.$i.'_starttime',
					'name'=>'Races[divisions]['.$i.'][starttime]',
				));
				echo $form->error($d, 'defaultstarttime', array(
					'for'=>'Races_divisions_'.$i.'_starttime_em_',
				));
				echo '</div>';
				echo '<div class="row">';
				echo '<label for="Races_divisions_'.$i.'_courseid">Course</label>';
				echo '<select class="course" name="Races[divisions]['.$i.'][courseid]" id="Races_divisions_'.$i.'_courseid"><option></option>';
				foreach ($courses as $c) {
					echo '<option value="'.$c->id.'">'.$c->number.'</option>';
				}
				echo '</select>';
				echo '</div>';
				echo '<div class="row">';
				echo '<label for="Races_divisions_'.$i.'_distance">Distance</label>'.
				'<input readonly name="Races[divisions]['.$i.'][distance]" id="Races_divisions_'.$i.'_distance" class="distance">'.
				'<div class="errorMessage" style="display:none"></div>';
				echo '</div>';
				$i -= 1;
			}
		} ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit', array(
			'id'=>'submit',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->