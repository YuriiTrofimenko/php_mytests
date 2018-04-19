<?php

namespace app\controllers;

use app\models\Answer;
use app\models\Question;
use app\models\forms\QuestionForm;
use app\models\Test;
use yii\data\ActiveDataProvider;

class QuestionController extends \yii\web\Controller
{
       
    public function actionAdd($testId)
    {
        if (!Test::find()->where(['id' => $testId])->exists()) {
            return $this->redirect(['test/index']);
        }

        $model = new QuestionForm(['scenario' => 'create']);
        if(\Yii::$app->request->isPost)
        {
            $model->load(\Yii::$app->request->post());
            $question = new Question();
            $question->testId=$testId;
            $question->text_=$model->text_;
            if($question->save())
            {
                $question->test->questions++;
                $question->test->save();
                return $this->redirect(['test/view', 'id' => $question->testId]);
            }
        }
        return $this->render('form', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $question = Question::findOne($id);
        $model = new QuestionForm([
            'scenario' => 'update',
            'text_' => $question->text_
        ]);

        if(\Yii::$app->request->isPost)
        {
            $model->load(\Yii::$app->request->post());
            $question->text_=$model->text_;
            if($question->save())
            {
                return $this->redirect(['test/view', 'id' => $question->testId]);
            }
        }
        return $this->render('form', ['model' => $model]);
    }

    public function actionView($id) {
        $question = Question::findOne($id);
        $provider = new ActiveDataProvider([
            'query' => $question->getAnswers(),
            'pagination' => false
        ]);

        return $this->render('view', [
            'model' => $question,
            'dataProvider' => $provider
        ]);
    }

    public function actionDelete($id)
    {
        $question = Question::findOne($id);
        $question->test->questions--;
        $question->test->save();
        Answer::deleteAll(['questionId' => $id]);
        $question->delete();
        return $this->redirect(['test/view', 'id' => $question->testId]);
    }
}
