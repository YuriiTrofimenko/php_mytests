<?php

namespace app\modules\tests\controllers;

use yii\web\Controller;
use app\models\Category;

/**
 * Default controller for the `tests` module
 */
class CategoryController extends Controller
{

    public function actionIndex() {

        return "hello";
    }

    public function actionGetCategories($parent = null)
 
    {
     
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
         
        //$student = Student::find()->all();
        //$categories = Category::find()->with('parent' => $parent)->all();
        //
        $categories = Category::find()->where(['parentId' => $parent])->all();
         
        if(count($categories) > 0 )
         
        {
         
            return array('status' => true, 'data'=> $categories);
         
        }
         
        else
         
        {
         
            return array('status'=>false,'data'=> 'No Categories Found');
         
        }
     
    }
    /**
     * Renders the index view for the module
     * @return string
     */
    /*public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionHome()
    {
    	$this->layout = false;
        return $this->render('home');
    }

    public function actionAbout()
    {
    	$this->layout = false;
        return $this->render('about');
    }*/

    /*public function actions()
    {
        return [
		   'pages' => [
		   		'class' => 'yii\web\ViewAction',
		   ],
		 ];
    }*/
}
