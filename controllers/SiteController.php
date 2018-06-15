<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\forms\LoginForm;
use app\models\forms\SignupForm;
use app\models\ContactForm;
use app\models\User;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
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
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        /*echo "<pre>";
        var_dump(Yii::$app->authManager->getRolesByUser(User::findByUsername(Yii::$app->user->identity->username)->getId()));
        echo "</pre>";*/
        //die();
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {

        $session = Yii::$app->session;

        if ($session->has('failure_time') && (time() - $session->get('failure_time') < 60)) {
            
            
            $session->remove('attempts_count');
            return "Вы указали неверные данные для входа на сайт более 3 раз. 1 минута, после которой можно будет сделать следующую попытку, еще не истекла";
        } else {
            
            $session->remove('failure_time');
        }

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            if ($session->has('attempts_count')) {
                
                $session->remove('attempts_count');
            }
            return $this->goBack();
        } else {

            $attemptsCount = $session->get('attempts_count');
            if (!$attemptsCount) {
                
                $session->set('attempts_count', 1);
            } else {

                $attemptsCount++;
                $session->set('attempts_count', $attemptsCount);
            }
            if ($attemptsCount > 3) {
                
                $session->set('failure_time', time());
                return "Вы указали неверные данные для входа на сайт более 3 раз. Следующую попытку можно будет сделать через 1 минуту";
            }
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
            return $this->goHome();
        }

        $model = new SignupForm();

        if($model->load(\Yii::$app->request->post()) && $model->validate()){

            $user = new User();
            $user->username = $model->username;
            $user->password = \Yii::$app->security->generatePasswordHash($model->password);

            if($user->save()){
                $userRole = Yii::$app->authManager->getRole('user');
                Yii::$app->authManager->assign($userRole, $user->getId());
                return $this->goHome();
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

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
