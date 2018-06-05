<?php

namespace app\modules\tests\controllers;

use yii\web\Controller;

/**
 * Default controller for the `tests` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionHome()
    {
    	$this->layout = false;
        return $this->render('home');
    }

    public function actionTests()
    {
    	$this->layout = false;
        return $this->render('tests');
    }

    /*public function actions()
    {
        return [
		   'pages' => [
		   		'class' => 'yii\web\ViewAction',
		   ],
		 ];
    }*/
}
