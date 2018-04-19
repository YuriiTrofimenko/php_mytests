<?php

namespace app\controllers;

use app\models\Answer;
use app\models\forms\AnswerForm;
use app\models\Question;

class AnswerController extends \yii\web\Controller
{
    
    public function actionAdd($questionId)
    {
        $model = new AnswerForm(['scenario' => 'create']);
        if(!Question::find()->where(['id' => $questionId])->exists())
        { return $this->redirect(['answer/index']); }
        if(\Yii::$app->request->isPost)
        {
            $model->load(\Yii::$app->request->post());
            if($model->validate())
            {
                $answer = new Answer();
                $answer->text_=$model->text_;
                $answer->isTrue=$model->isTrue;
                $answer->questionId=$questionId;
                $answer->save();
               return $this->redirect(['question/view', 'id' => $questionId]);
            }
        }
        return $this->render('form', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = new AnswerForm(['scenario' => 'update']);

        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());

            if ($model->validate()) {
                $answer = Answer::findOne($id);
                $answer->text_=$model->text_;
                $answer->isTrue=$model->isTrue;
                $answer->save();
                return $this->redirect(['question/view', 'id'=>$answer->questionId]);
            }
        } else {
            $model->load(Answer::findOne($id)->toArray(), '');
        }

        return $this->render('form', ['model' => $model]);
    }


    public function actionDelete($id)
    {
        $answer = Answer::findOne($id);
        $answer->delete();
        return $this->redirect(['question/view', 'id' => $answer->questionId]);
    }
}
