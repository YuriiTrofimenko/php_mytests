<?php

namespace app\modules\tests\controllers;

use yii\web\Controller;
use app\models\Question;

/**
 * Question controller for the `tests` module
 */
class QuestionController extends Controller
{

    public function actionIndex() {

        return "hello";
    }

    public function actionGetQuestion($testid = null) {
     
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
         
        $test = Test::findOne($testid);
         
        if($test != null ){
         
            return array('status' => true, 'data'=> $test);
         
        } else {
         
            return array('status'=>false,'data'=> 'Test not found');
        }
    }

    /*//Проверка наличия у сатегории дочерних категорий
    public function getCategories($id = null)
    {
        return Question::find()->where(['parentId' => $id])->all();
    }

    //http://localhost/web/?r=tests/category/get-categories
    public function actionGetCategories($parent = null)
    {
     
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
         
        //$student = Student::find()->all();
        //$categories = Category::find()->with('parent' => $parent)->all();
        //
        $categories = $this->getCategories($parent);
         
        if(count($categories) > 0 )
         
        {
         
            return array('status' => true, 'data'=> $categories);
         
        }
         
        else
         
        {
         
            return array('status'=>false,'data'=> 'No Categories Found');
         
        }
     
    }*/
}
