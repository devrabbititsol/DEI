<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\db\Query;
use app\models\LoginForm;
use app\models\Contactform;
use app\models\Ads;
use app\models\Products;
use app\models\Productslocations;
use app\models\User;
use app\models\Productcategory;
use app\models\Productsubcategory;
use app\models\Productmodel;
use app\models\Regions;
use app\models\Pricetype;
use app\models\Productcapacity;
use app\models\Productorder;
use app\models\Getquote;
use app\models\Generalsettings;
use app\models\Mail_settings;
use app\models\Payments;
use yii\base\ErrorException;


class AdminController extends Controller
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
    
    public function beforeAction($action) {
        
        //Redirect if user already logged in
        if (Yii::$app->user->isGuest && $action->id != 'login') {
            //echo $action->controller->id;exit;
            return $this->redirect(['admin/login'])->send();;
        }
        return parent::beforeAction($action);
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
    
    public function init()
    {
        //initilize layout
        $this->layout = 'admin_header';
    }
    
    public function actionIndex()
    {
        if(!empty($_POST))
        {
            $userstatus = LoginForm::user_login($_POST);
            if($userstatus == 1)
            {
                \Yii::$app->getSession()->setFlash('error', 'Your Text Here..');
            }
            echo $this->render('//admin/index');
        }
        echo $this->render('//admin/index');
    }
    
    public function actionLogin()
    {
        $this->layout = false;
        echo $this->render('//admin/login');
    }
    
    
}
