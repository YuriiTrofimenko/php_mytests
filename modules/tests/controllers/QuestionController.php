<?php

namespace app\modules\tests\controllers;

use Yii;
use yii\web\Controller;
use app\models\Question;
use app\models\session\UserState;

/**
 * Question controller for the `tests` module
 */
class QuestionController extends Controller
{

    public function actionIndex() {

        return "hello";
    }

    public function actionGetQuestion($testid = null) {
     
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $session = Yii::$app->session;
        //$session->open();
        $userState = $session->get('user_state');
        if (!$userState || ($userState && $userState->currentTestId != $testid)) {
            //return array('status'=>false,'data'=> $userState);
            $userName = Yii::$app->user->identity->username;
            $firstQuestionIndex = 1;
            $currentTestQCount =
                Question::find()
                    ->where(['testid' => $testid])
                    ->count();
            $score = 0;

            $userState = new UserState(
                    $userName
                    , $testid
                    , $firstQuestionIndex
                    , $currentTestQCount
                    , $score
                );
            $session->set('user_state', $userState);
        }
        
        if ($userState->currentQuestionIndex <= $userState->currentTestQCount) {
             
            $currentQuestionIndex = $userState->currentQuestionIndex;
            $test =
                Question::find()
                    ->where(['testid' => $testid])
                    ->offset($currentQuestionIndex - 1)
                    ->limit(1)
                    ->one();
         
            if($test != null ){
             
                $userState->currentQuestionIndex += 1;
                return array('status' => true, 'data'=> $test);
                //return array('status' => true, 'data'=> $userState);
             
            } else {
             
                return array('status'=>false,'data'=> 'Questions not found');
            }
        }
        $session->remove('user_state');
        return array('status'=>false,'data'=> 'Test is completed');
        //return array('status'=>false,'data'=> $userState);
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
