<?php

namespace app\modules\tests\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\helpers\Url;
use app\models\forms\LoginForm;
use app\models\forms\SignupForm;
use app\models\User;
use yii\filters\VerbFilter;

/**
 * Default controller for the `tests` module
 */
class DefaultController extends Controller
{
    private $defaultUrl;

    function __construct($id, $module, $config = []) {
        parent::__construct($id, $module, $config = []);
        $this->defaultUrl = Url::toRoute(['/tests/default/index']);
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionHome()
    {
    	$this->layout = false;
        return $this->render('home');
    }

    public function actionTests()
    {
    	$this->layout = false;
        return $this->render('tests');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            //return $this->goHome();
            return Yii::$app->getResponse()->redirect($this->defaultUrl);
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //return $this->goBack();
            return Yii::$app->getResponse()->redirect($this->defaultUrl);
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Signup action.
     *
     * @return Response|string
     */
    public function actionSignup()
    {
        if (!Yii::$app->user->isGuest) {
            //return $this->goHome();
            return Yii::$app->getResponse()->redirect($this->defaultUrl);
        }

        $model = new SignupForm();

        if($model->load(\Yii::$app->request->post()) && $model->validate()){

            $user = new User();
            $user->username = $model->username;
            $user->password = \Yii::$app->security->generatePasswordHash($model->password);

            if($user->save()){
                $userRole = Yii::$app->authManager->getRole('user');
                Yii::$app->authManager->assign($userRole, $user->getId());
                //return $this->goHome();
                return Yii::$app->getResponse()->redirect($this->defaultUrl);
            }
         }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        //return $this->goHome();
        return Yii::$app->getResponse()->redirect($this->defaultUrl);
    }

    /*public function actions()
    {
        return [
		   'pages' => [
		   		'class' => 'yii\web\ViewAction',
		   ],
		 ];
    }*/
}
