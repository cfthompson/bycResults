<?php

/* 
 * Copyright (C) 2015 rfgunion.
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301  USA
 */

class SeriesController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 * Not currently used for series, since SiteController.actionIndex
	 * lists all series.
	 */
	/*public function actionIndex()
	{
	}*/

	public function actionTreeDataForSeries($id) {
		$series = Series::model()->get($id);
		echo json_encode($this->getTreeDataForSeries($series));
	}

	private function getTreeDataForSeries($series) {
		$data = array();
		foreach ($series->races as $r) {
			$text = '<a href="'.CHtml::normalizeUrl(array('race/view', 'id'=>$r->id)).'">'.$r->racedate.'</a> ('.count($r->entries).' boats)';
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
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform CRUD actions
				'actions'=>array('create','edit','delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionDelete()
	{
		$this->render('delete');
	}

	public function actionCreate()
	{
    	$model=new Series;

    	// uncomment the following code to enable ajax-based validation
    	if(isset($_POST['ajax']) && $_POST['ajax']==='series-create-form')
    	{
        	echo CActiveForm::validate($model);
        	Yii::app()->end();
    	}

    	if(isset($_POST['Series']))
    	{
        	$model->attributes=$_POST['Series'];
        	if($model->save())
        	{
				$this->redirect(array('race/create', 'seriesid'=>$model->id));
				Yii::app()->end();
        	}
			throw new CHttpException(500, 'Cannot save series: '.print_r($model->errors, TRUE));
		}
		$this->registerClientScripts();
    	$this->render('create',array('model'=>$model));
	}

	public function actionEdit($id)
	{
		$model = $this->getSeries($id);
		if (!$model) {
			throw new CHttpException(404, 'No series with id '.$id.' was found.');
		}

   		// uncomment the following code to enable ajax-based validation
    	if(isset($_POST['ajax']) && $_POST['ajax']==='series-create-form')
    	{
        	echo CActiveForm::validate($model);
        	Yii::app()->end();
    	}

    	if(isset($_POST['Series']))
    	{
        	$model->attributes=$_POST['Series'];
        	if($model->save())
        	{
				$this->redirect(array('race/create', 'seriesid'=>$model->id));
				Yii::app()->end();
        	}
		}

		$this->registerClientScripts();
		$this->render('edit', array(
			'model'=>$model,
		));
	}

	protected function registerClientScripts() {
		$cs = Yii::app()->clientScript;
		$cs->addPackage('series', array(
			'basePath'=>'application.controllers.assets.series',
			'js'=>array('seriesform.js'),
			'depends'=>array('jquery'),
		));
		$cs->registerPackage('series');
	}
}
