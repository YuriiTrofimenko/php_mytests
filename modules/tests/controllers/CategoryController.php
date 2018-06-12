<?php

namespace app\modules\tests\controllers;

//use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Category;

/**
 * Category controller for the `tests` module
 */
class CategoryController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex() {

        return "hello";
    }

    //Проверка наличия у сатегории дочерних категорий
    public function getCategories($id = null)
    {
        return Category::find()->where(['parentId' => $id])->all();
    }

    //http://localhost/web/?r=tests/category/get-categories
    //index.php/?r=tests/category/get-categories
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
            //Yii::$app->response->redirect(Url::to(['index.php/?r=tests/test/get-tests']), 301);
            //Yii::$app->end();
            return array('status'=>false,'data'=> 'No Categories Found');
            //Yii::$app->controllerNamespace = 'tests\controllers';
            //return Yii::$app->runAction('tests/test/get-tests', ['categoryId' => $parent]);
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
