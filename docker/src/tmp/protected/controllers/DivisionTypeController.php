<?php

class DivisionTypeController extends Controller
{

	public function actionDivisions($typeid) {

		$divs = Divisiontypes::model()->findAllByAttributes(array('seriestypeid'=>$typeid));
		if (!$divs) {
			echo json_encode(array());
			Yii::app()->end();
		}
		
		$items = array();
		$divid = -1;
		foreach ($divs as $d) {
			$items[$divid] = array(
				'name'=>$d->name,
				'typeid'=>$d->id,
				'starttime'=>$d->defaultstarttime,
				'minphrf'=>$d->minphrf,
				'maxphrf'=>$d->maxphrf,
				'minlength'=>$d->minlength,
				'maxlength'=>$d->maxlength,
				'operator'=>$d->operator,
				'course'=>0,
				'distance'=>0,
			);
			$divid -= 1;
		}
		echo json_encode($items);
	}

}
