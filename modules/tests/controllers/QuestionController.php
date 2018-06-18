<?php

namespace app\modules\tests\controllers;

use Yii;
use yii\web\Controller;
use app\models\Test;
use app\models\Question;
use app\models\Answer;
use app\models\session\UserState;

/**
 * Question controller for the `tests` module
 */
class QuestionController extends Controller
{

    public function actionIndex() {

        return "hello";
    }

    public function getAnswerMap($answer) {

        return ['id'=>$answer['id'], 'text'=>$answer['text_']];
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

        $selection = Yii:: $app->request->post()['selection'];
        if ($selection) {

            $prevQuestionIndex = $userState->currentQuestionIndex;
            $prevQuestionIndex--;
            $question =
                Question::find()
                    ->where(['testid' => $testid])
                    ->offset($prevQuestionIndex - 1)
                    ->limit(1)
                    ->one();
            
            if($question != null ){

                $rightAnswersCount =
                    Answer::find()
                    ->where(['questionId' => $question->id, 'isTrue' => 1, 'id' => $selection])
                    ->count();
                
                $userState->score += $rightAnswersCount;
            }
        }
        
        if ($userState->currentQuestionIndex <= $userState->currentTestQCount) {
             
            $currentQuestionIndex = $userState->currentQuestionIndex;
            $question =
                Question::find()
                    ->where(['testid' => $testid])
                    ->offset($currentQuestionIndex - 1)
                    ->limit(1)
                    ->one();
         
            if($question != null ){
             
                $answers =
                    Answer::find()
                    ->where(['questionId' => $question->id])
                    ->all();

                $answersMap = array_map([$this, 'getAnswerMap'], $answers);


                $userState->currentQuestionIndex += 1;
                return [
                    'status' => true
                    , 'data'=> [
                        'question'=>$question->text_
                        , 'total_count'=>$userState->currentTestQCount
                        , 'current_question_index'=>$currentQuestionIndex
                        , 'answers'=>$answersMap
                    ]
                ];
                //return array('status' => true, 'data'=> $userState);
             
            } else {
             
                return array('status'=>false,'data'=> 'Questions not found');
            }
        }
        $totalScore = $userState->score;
        //Sending a message
        /*Yii::$app->mailer->compose(
            'resultmessage', [
                    'testname' => Test::findOne($userState->currentTestId)->name,
                    'username' => $userState->userName,
                    'score' => $totalScore,
                    'total' => $userState->currentTestQCount,
                ])
            ->setFrom('yurii@localhost')
            ->setTo('yurii@localhost')
            ->setSubject('Test result')
            ->send();*/
        $testname = Test::findOne($userState->currentTestId)->name;
        $username = $userState->userName;
        $total = $userState->currentTestQCount;

        $to      = 'yurii@localhost';
        $subject = 'Test result';
        $message = "Тест {$testname}. Результаты пользователя {$username}: {$totalScore} баллов из {$total}.";
        //$message = '=?UTF-8?B?'.base64_encode($message).'?=';
        $headers = 'From: yurii@localhost' . "\r\n" .
            'Reply-To: yurii@localhost' . "\r\n" .
            //'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/plain; charset=UTF-8' . "\r\n" .
            //'Content-Transfer-Encoding: base64' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);
        $session->remove('user_state');
        return array('status'=>false,'data'=> ['totalScore'=>$totalScore, 'total'=>$userState->currentTestQCount]);
    }
}
