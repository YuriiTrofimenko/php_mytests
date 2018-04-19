<?php

namespace app\controllers;

use app\models\Answer;
use app\models\Question;
use app\models\Test;
use app\models\forms\TestForm;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

Class TestController extends \yii\web\Controller {

    public function actionIndex() {
        $provider = new \yii\data\ActiveDataProvider([
            'query' => Test::find()->with('category'),
        ]);

        return $this->render('list', [
            'dataProvider' => $provider
        ]);
    }

    public  function actionView($id){
        $provider = new ActiveDataProvider([
            'query' => Question::find()->where(['testId' => $id])
        ]);

        return $this->render('view', ['provider' => $provider,'model' => Test::findOne($id)]);
    }

    public function actionAdd()
    {
        $model = new TestForm(['scenario' => 'create']);

        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());
            if($model->save())
            {
                return $this->redirect(['test/index']);
            }
        }

        return $this->render('form', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = new TestForm(['scenario' => 'update']);
        $model->test = Test::findOne($id);

        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());

            if ($model->save()) {
                return $this->redirect(['test/index']);
            }
        }

        return $this->render('form', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        $questionsIds = array_keys(Question::find()->where(['testId' => $id])->asArray()->indexBy('id')->all());

        Answer::deleteAll(['questionId' => $questionsIds]);
        Question::deleteAll(['id' => $questionsIds]);
        Test::deleteAll(['id' => $id]);

        return $this->redirect(['test/index']);
    }

}