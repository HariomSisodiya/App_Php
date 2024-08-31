<?php

namespace app\controllers;

use app\models\Student;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'logout', 'about', 'contact'],
                        'roles' => ['@'], // Authenticated users
                    ],
                    [
                        'allow' => true,
                        'actions' => ['login', 'signup', 'count', 'student'],
                        'roles' => ['?'], // Guest users
                    ],
                ],
            ],
            'corsFilter' => [
                'class' => \yii\filters\Cors::class,
                'cors' => [
                    'Origin' => ['http://localhost:5173'],
                    'Access-Control-Request-Method' => ['*'],
                    'Access-Control-Request-Headers' => ['*'],
                    'Access-Control-Allow-Credentials' => true,
                ],
            ],
            'contentNegotiator' => [
                'class' => \yii\filters\ContentNegotiator::class,
                // 'formats' => [
                //     'application/json' => Response::FORMAT_JSON,
                // ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
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
    $student = Yii::$app->user->identity;
    $student_id = $student ? $student->id : null;
    $auth_token = Yii::$app->session->get('jwt_token');

    return $this->render('index', [
        'student_id' => $student_id,
        'auth_token' => $auth_token,
    ]);
}


    public function actionCount()
    {
        $studentCount = Student::find()->count();

        return $studentCount;
    }

    public function actionStudent($id)
    {

        $student = Student::findOne($id);

        if ($student == null) {
            return $this->asJson(['error' => 'Student not found']);
        }
        return $this->asJson(['student' => $student]);
    }

    public function actionSignup()
    {
        $student = new Student();

        if ($student->load(Yii::$app->request->post()) && $student->signup()) {
            Yii::$app->getSession()->setFlash('success', 'Thank you for successful signup!');
            return $this->redirect(['login']);
        }

        return $this->render('signup', ['student' => $student]);
    }

    public function actionReact()
    {
        return $this->renderPartial('@app/web/react/index.html');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $student = Yii::$app->user->identity;
            $token = $student->generateJwtToken();
            Yii::$app->session->set('jwt_token', $token);
            
            Yii::$app->getSession()->setFlash('success', 'Student logged in successfully.');
            return $this->goBack();
        } else {
            if ($model->hasErrors()) {
                Yii::$app->getSession()->setFlash('error', 'Failed to login. Please check your credentials.');
            }
            return $this->render('login', ['model' => $model]);
        }

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
