<?php

class RaceController extends Controller
{
	public function actionDelete()
	{
		$this->render('delete');
	}

	public function actionEdit($id)
	{
		$race = $this->getRace($id);
		if (!$race) {
			throw new CHttpException(404, 'No race with id '.$id.' was found.');
		}
		$form = new CForm('application.views.race.raceForm', $race);
		if ($form->submitted() && $form->validate()) {
			$this->redirect(array('race/entries', 'id'=>$race->id));
			Yii::app()->end();
		}

		$this->render('edit', array(
			'form'=>$form,
			'race'=>$race,
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

		$cs = Yii::app()->clientScript;
		$cs->addPackage('race', array(
			'basePath'=>'application.controllers.assets.race',
			'js'=>array('entryform.js', 'raceform.js'),
			'depends'=>array('jquery'),
		));
		$cs->registerPackage('race');

		$this->render('entries', array(
			'race'=>$race,
			'entry'=>$entry,
		));
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