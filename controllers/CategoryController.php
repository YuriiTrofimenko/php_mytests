<?php

namespace app\controllers;

use yii\filters\AccessControl;
use app\models\Category;
use app\models\forms\CategoryForm;
use yii\helpers\Url;

class CategoryController extends \yii\web\Controller {

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex() {
        $provider = new \yii\data\ActiveDataProvider([
            'query' => Category::find()->with('parent'),
        ]);

        return $this->render('list', [
            'dataProvider' => $provider
        ]);
    }

    public function actionAdd()
    {
        $model=new CategoryForm([
            'scenario' => 'create'
        ]);

        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());

            if ($model->save()) {
                return $this->redirect(['category/index']);
            }
        }
        return $this->render('form', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = new CategoryForm(['scenario' => 'update']);

        if (\Yii::$app->request->isPost) {
            $model->id = $id;
            $model->load(\Yii::$app->request->post());

            if ($model->save()) {
                return $this->redirect(['category/index']);
            }
        } else {
            $model->load(Category::findOne($id)->toArray(), '');
        }

        return $this->render('form', ['model' => $model]);
    }

    public function actionDelete($id)   //допилить удаление
    {
        $category = Category::findOne($id);
        if (empty($category->childCategories)) {
            $category->delete();
            return $this->redirect(['category/index']);
        }

        if (\Yii::$app->request->post('remove-all', false)) {
            Category::deleteAll(['parentId' => $id]);
            $category->delete();
            return $this->redirect(['category/index']);
        }

        /*
        if (\Yii::$app->request->post('cancel', false)) {
            return $this->redirect(['category/index']);
        }
        */

        \Yii::$app->session->setFlash('children-delete-confirmation', ['categoryId' => $id]);
        // в индексе нужно сделать иф children-delete-confirmation
        // вывести сообщение с формой. В форме только сабмит с name remove-all value = 1
        // и cancel закрывает сообщение
        // <div class="alert alert-warning alert-dismissible" role="alert">
        // <button type="button" data-dismiss="alert" aria-label="Cancel">Cancel</button>
        // </div>
        // Метод формы пост и action = delete c $id
        return $this->redirect(['category/index']);
    }
}
