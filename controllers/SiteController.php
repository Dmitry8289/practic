<?php

namespace app\controllers;

use app\models\Car;
use app\models\ContactForm;
use app\models\RegisterForm;
use app\models\Reservation;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use yii\web\UploadedFile;

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
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['account'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
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
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Ваша заявка успешно отправлена.');

            return $this->refresh();
        }
        return $this->render('index', ['model' => $model]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = false;
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if (Yii::$app->user->identity->isAdmin()) {
                return $this->redirect(['/admin']);
            }
            return $this->redirect(['/site/account']);
        }

        $model->password = '';
        return $this->render('login', [
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

    public function actionAccount()
    {
        $this->layout = false;
        $user = User::findOne(Yii::$app->user->id);
        $cars = $user->car;
        $carsharing_cars = $user->carsharing;
        return $this->render('account', ['cars' => $cars, 'carsharing_cars' => $carsharing_cars]);
    }

    public function actionRegister()
    {
        $this->layout = false;
        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Регистрация на сервисе прошла успешно!');

            return $this->refresh();
        }
        return $this->render('register', ['model' => $model]);
    }

    public function actionCatalog()
    {
        $this->layout = false;
        $catalog = Car::find()->where(['status' => 1])->orderBy(['id' => SORT_DESC]);
        $provider = new ActiveDataProvider([
            'query' => $catalog,
        ]);
        return $this->render('catalog', ['provider' => $provider]);
    }

    public function actionNewcar()
    {
        $this->layout = false;
        $model = new Car();
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post()) && $model->save();
            $model->image = UploadedFile::getInstance($model, 'image');
            $model->save(false);
            $model->image->saveAs("img/{$model->image->baseName}.{$model->image->extension}");
            if ($model->upload()) {
                Yii::$app->session->setFlash('success', 'Добавление автомобиля прошло успешно!');

                return $this->redirect(['/site/catalog']);
            }
        }

        return $this->render('newcar', ['model' => $model]);
    }

    public function actionReservation()
    {
        $this->layout = false;
        $model = new Reservation();
        if ($model->load(Yii::$app->request->post()) && $model->save(false))
        {
            $car = Car::findOne($model->car_id);
            if($car !== null) {
                $car->status = 0;
                $car->user_id = $model->user_id;
                $car->save(false);
            }
            Yii::$app->session->setFlash('success', 'Вы успешно забронировали данный автомобиль!');

            return $this->redirect(['/site/account']);
        }

        return $this->render('reservation', ['model' => $model]);
    }

    public function actionCheck()
    {
        $now = time();
        $cars = Reservation::find()->where(['<', 'end_date', $now])->all();
        foreach ($cars as $car) {
            $car->status = 0;
            $car->user_id = null;
            $car->save(false);
        }
    }
}
