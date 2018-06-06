<?php

namespace app\modules\tests\controllers;

use yii\web\Controller;
use app\models\Test;

/**
 * Test controller for the `tests` module
 */
class TestController extends Controller
{

    public function actionIndex() {

        return "hello";
    }

    //Проверка наличия у сатегории дочерних категорий
    public function getTests($categoryId = null)
    {
        return Test::find()->where(['categoryId' => $categoryId])->all();
    }

    //http://localhost/web/?r=tests/test/get-tests
    public function actionGetTests($parent = null) {
     
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
         
        $tests = $this->getTests($parent);
         
        if(count($tests) > 0 ){
         
            return array('status' => true, 'data'=> $tests);
         
        } else {
         
            return array('status'=>false,'data'=> 'No tests found');
        }
    }

    public function actionGetTest($testid = null) {
     
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
         
        $test = Test::findOne($testid);
         
        if($test != null ){
         
            return array('status' => true, 'data'=> $test);
         
        } else {
         
            return array('status'=>false,'data'=> 'Test not found');
        }
    }
}
