<?php
/* @var $this RaceController */
/* @var $race Races */

$this->breadcrumbs=array(
	'Race'=>array('/race/view', 'id'=>$race->id),
	'Edit',
	$race->id,
);
?>
<h1>Race <?php echo $race->id.': '.$race->racedate; ?></h1>

<?php $allseries = Series::model()->findAll();
foreach ($allseries as $s) {
	$str = implode('$$', array(
		$s->typeid,
		$s->name,
		$s->defaultMethod,
		$s->defaultParam1,
		$s->defaultParam2,
	));
	echo '<span style="display:none" id="series_'.$s->id.'">'.$str.'</span>';
} 

$allcourses = Courses::model()->findAll();
foreach ($allcourses as $c) {
	$str = implode('$$', array(
		$c->number,
		$c->distance,
	));
	echo '<span style="display:none" class="courseid" id="course_'.$c->id.'">'.$str.'</span>';
}

?>
<div class="wide form">
	<?php echo $form; ?>
</div>
<?php /* ?>
<form id="raceform" method="post">
	<?php if ($id) {
		echo '<input type="hidden" id="raceid" name="race[id]" value="'.$id.'">';
	} ?>
	<table id="race">
		<tr>
			<th>Series:</th>
			<td><select name="race[seriesid]" id="seriesid">
					<option></option>
					<?php foreach ($allseries as $s) {
						$sel = $s->id == $race->seriesid ? 'selected' : '';
						echo "<option value='{$s->id}' $sel>{$s->name}</option>";
					}?>
				</select></td>
			<td class="errormsg"><?php echo $msg['seriesid']; ?></td>
		</tr>
		<tr>
			<th>Race Date:</th>
			<td><input type="text" name="race[racedate]" id="racedate" value="<?php echo $racedate; ?>"> (MM/DD/YYYY)</td>
			<td class="errormsg"><?php echo $msg['date']; ?></td>
		</tr>
		<tr>
			<th>Prepared By:</th>
			<td><input type="text" name="race[preparer]" id="preparer" value="<?php echo $race->preparer; ?>"></td>
			<td class="errormsg"><?php echo $msg['preparer']; ?></td>
		</tr>
		<tr>
			<th>RC Boat Skipper:</th>
			<td><input type="text" name="race[rcskipper]" id="rcskipper" value="<?php echo $race->rcskipper; ?>"></td>
			<td class="errormsg"><?php echo $msg['rcskipper']; ?></td>
		</tr>
		<tr>
			<th>Committee Boat:</th>
			<td><input type="text" name="race[rcboat]" id="rcboat" value="<?php echo $race->rcboat; ?>"></td>
			<td class="errormsg"><?php echo $msg['rcboat']; ?></td>
		</tr>
		<tr>
			<th>Method:</th>
			<td><select name="race[method]" id="method">
				<option></option>
				<?php $seriestype = new SeriesType();
				foreach ($seriestype->findAll() as $st) {
					$sel = $race->method == $st->defaultMethod ? 'selected' : '';
					echo '<option value="'.$st->defaultMethod.'" '.$sel.'>'.$st->defaultMethod.'</option>';
				} ?>
				</select>
			</td>
			<td class="errormsg"><?php echo $msg['method']; ?></td>
		</tr>
		<tr>
			<th>Parameter 1:</th>
			<td><input type="number" name="race[param1]" id="param1" value="<?php echo $race->param1; ?>"></td>
			<td class="errormsg"><?php echo $msg['param1']; ?></td>
		</tr>
		<tr>
			<th>Parameter 2:</th>
			<td><input type="number" name="race[param2]" id="param2" value="<?php echo $race->param2; ?>"></td>
			<td class="errormsg"><?php echo $msg['param2']; ?></td>
		</tr>
		<tr id="divisiontop">
			<th colspan="3" class="divisionheader">Divisions</th>
		</tr>
		<tr>
			<th></th>
			<td><input type="submit" name="submit" id="submit" value="Next->" <?php echo ($id ? '' : 'disabled'); ?>></td>
			<td class="errormsg"></td>
		</tr>
	</table>
</form>
<?php */ ?>