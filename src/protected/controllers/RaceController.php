<?php

class RaceController extends Controller
{
	public function actionDelete()
	{
		$this->render('delete');
	}

	public function actionCreate($seriesid)
	{
		$series = Series::model()->findByPk($seriesid);
		if (!$series) {
			throw new CHttpException(404, 'No series with id '.$seriesid.' was found.');
		}

    	$model=new Races;

    	// uncomment the following code to enable ajax-based validation
    	if(isset($_POST['ajax']) && $_POST['ajax']==='races-create-form')
    	{
        	echo CActiveForm::validate($model);
        	Yii::app()->end();
    	}

    	if(isset($_POST['Races']))
    	{
        	$model->attributes=$_POST['Races'];
        	if($model->save())
        	{
				foreach ($_POST['Races']['divisions'] as $divid=>$attrs) {
					if ($divid < 0) {
						$d = new Divisions();
						$d->attributes = $attrs;
						$d->raceid = $model->id;
						if (!$d->save()) {
							throw new CHttpException(500, 'Cannot save a division: '.print_r($d->errors, TRUE));
						}
					}
				}
				$this->redirect(array('race/entries', 'id'=>$model->id));
				Yii::app()->end();
        	}
			throw new CHttpException(500, 'Cannot save race: '.print_r($model->errors, TRUE));
    	} else {
			$model->racedate = date('Y-m-d');
			$model->seriesid = $seriesid;
			$model->method = $series->defaultMethod;
			$model->param1 = $series->defaultParam1;
			$model->param2 = $series->defaultParam2;
		}
		$this->registerClientScripts();
    	$this->render('create',array('model'=>$model));
	}

	public function actionEdit($id)
	{
		$model = $this->getRace($id);
		if (!$model) {
			throw new CHttpException(404, 'No race with id '.$id.' was found.');
		}

   		// uncomment the following code to enable ajax-based validation
    	if(isset($_POST['ajax']) && $_POST['ajax']==='races-create-form')
    	{
        	echo CActiveForm::validate($model);
        	Yii::app()->end();
    	}

    	if(isset($_POST['Races']))
    	{
        	$model->attributes=$_POST['Races'];
        	if($model->save())
        	{
				foreach ($_POST['Races']['divisions'] as $divid=>$d) {
					if ($divid > 0) {
						$division = Divisions::model()->findByPk($divid);
					} else {
						$division = new Divisions;
					}
					$division->attributes = $d;
					$division->raceid = $model->id;
					$division->save();
			}
				$this->redirect(array('race/entries', 'id'=>$model->id));
				Yii::app()->end();
        	}
		}
		/*
		$form = new CForm('application.views.race.raceForm', $race);
		if ($form->submitted() && $form->validate()) {
			$race->save();
			$this->redirect(array('race/entries', 'id'=>$race->id));
			Yii::app()->end();
		}
		*/

		$this->registerClientScripts();
		$this->render('edit', array(
			'model'=>$model,
		));
	}

	public function actionIndex($id)
	{
		$this->actionView($id);
	}

	public function actionView($id)
	{
		$race = $this->getRace($id);
		if (!$race) {
			throw new CHttpException(404, 'No race with id '.$id.' was found.');
		}
		$this->render('view', array(
			'race'=>$race,
		));
	}

	public function actionEntries($id, $entryid=false) {
		$race = $this->getRace($id);
		if (!$race) {
			throw new CHttpException(404, 'No race with id '.$id.' was found.');
		}
		if ($entryid) {
			$entry = Entries::model()->findByPk($entryid);
		} else {
			$entry = new Entries();
		}
		if (array_key_exists('entry_submit', $_POST)) {
			$entry->setAttributes($_POST['entry']);
			if ($entry->spinnaker === 'on') {
				$entry->spinnaker = 1;
			} else if (!array_key_exists('spinnaker', $_POST['entry'])) {
				$entry->spinnaker = 0;
			}
			if ($entry->rollerFurling === 'on') {
				$entry->rollerFurling = 1;
			} else if (!array_key_exists('rollerFurling', $_POST['entry'])) {
				$entry->rollerFurling = 0;
			}
			if (strtoupper($entry->finish) === 'DNF' || strtoupper($entry->finish) === 'DSQ') {
				$entry->status = strtoupper($entry->finish);
			}
			if ($entry->save(true)) {
				$this->redirect(array('race/entries', 'id'=>$race->id));
				Yii::app()->end();
			}
		} else if (array_key_exists('entry_delete', $_POST)) {
			if (!$entryid || $entryid !== $_POST['entry']['id']) {
				// something's fishy
				$this->redirect(array('site/index'));
				Yii::app()->end();
			}
			if ($entry->delete()) {
				$this->redirect(array('race/entries', 'id'=>$race->id));
				Yii::app()->end();
			}
		}

		$this->registerClientScripts();

		$this->render('entries', array(
			'race'=>$race,
			'entry'=>$entry,
		));
	}

	public function actionDivisions($id) {
		$race = $this->getRace($id);
		if (!$race) {
			throw new CHttpException(404, 'No race with id '.$id.' was found.');
		}

		$items = array();
		foreach ($race->divisions as $d) {
			$items[$d->id] = array(
				'name'=>$d->name,
				'typeid'=>$d->typeid,
				'starttime'=>$d->starttime,
				'minphrf'=>$d->minphrf,
				'maxphrf'=>$d->maxphrf,
				'minlength'=>$d->minlength,
				'maxlength'=>$d->maxlength,
				'course'=>$d->course,
				'distance'=>$d->distance,
			);
		}
		echo json_encode($items);
		Yii::app()->end();
	}

	protected function registerClientScripts() {
		$cs = Yii::app()->clientScript;
		$cs->addPackage('race', array(
			'basePath'=>'application.controllers.assets.race',
			'js'=>array('entryform.js', 'raceform.js'),
			'depends'=>array('jquery'),
		));
		$cs->registerPackage('race');
	}

	protected function getRace($id) {
		if (!$id || !is_numeric($id)) {
			$this->redirect(Yii::app()->homeUrl);
			Yii::app()->end();
		}
		$race = Races::model()->findByPk($id);
		return $race;
	}

	protected function strtohms($secs) {
		$hr = fmod($secs, 3600);
		$h = ($secs - $hr)/3600;
		$mr = fmod($hr, 60);
		$m = ($hr - $mr)/60;
		$s = $mr;
		$result = sprintf('%02d:%02d:%02d', $h, $m, $s);
		return $result;
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}