<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$this->registerClientScripts();

		$series = Series::model()->findAllBySql('SELECT * FROM series ORDER BY id DESC');
		$data = array();
		$expanded = true; //expand the most recent series only
		foreach ($series as $s) {
			$seriesdata = array(
				'text'=>'<span class="folder">'.$s->name.'</span>',
				'expanded'=>$expanded,
				'hasChildren'=>true,
				'id'=>'series_'.$s->id,
				'children'=>array(
					array('text'=>''),
				),
			);

			if ($expanded) {
				$seriesdata['children'] = array_merge($seriesdata['children'], $this->getTreeDataForSeries($s));
				$expanded = false;
			}
			else if (!Yii::app()->user->isGuest) {
				$seriesdata['children'] = array(
					array(
						'text'=>'<span class="newrace"><a href="'.CHtml::normalizeUrl(array('race/create', 'seriesid'=>$s->id)).'">Add a New Race</a></span>'
					),
				);
			}

			$data[] = $seriesdata;
		}
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index', array(
			'series'=>$series,
			'data'=>$data,
		));
	}

	public function actionTreeDataForSeries($root) {
		$spl = explode('_', $root);
		if (count($spl) !== 2 || !is_numeric($spl[1])) {
			return;
		}

		$series = Series::model()->findByPk($spl[1]);
		$data = $this->getTreeDataForSeries($series);
		echo json_encode($data);
	}

	private function getTreeDataForSeries($series) {
		$data = array();
		if (!Yii::app()->user->isGuest) {
			$data[] = array(
				'text'=>'<span class="newrace"><a href="'.CHtml::normalizeUrl(array('race/create', 'seriesid'=>$series->id)).'">Add a New Race</a></span>'
			);
		}
		foreach ($series->races as $r) {
			$tstamp = strtotime($r->racedate);
			/* $racedate = strftime('%B %e, %Y', $tstamp); */
                        $racedate = date('F j, Y', $tstamp);
			$text = '<a href="'.CHtml::normalizeUrl(array('race/view', 'id'=>$r->id)).'">'.$racedate.'</a> ('.count($r->entries).' boats)';
			if (!Yii::app()->user->isGuest) {
				$text .= ' &mdash; <a href="'.CHtml::normalizeUrl(array('race/edit', 'id'=>$r->id)).'">Edit</a>';
			}
			$data[] = array(
				'text'=>$text,
				'id'=>'race_'.$r->id,
			);
		}
		return $data;
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	protected function registerClientScripts() {
		$cs = Yii::app()->clientScript;
		$cs->addPackage('site', array(
			'basePath'=>'application.controllers.assets.site',
			'js'=>array('site.js'),
			'css'=>array('site.css'),
			'depends'=>array('jquery'),
		));
		$cs->registerPackage('site');
	}
}
