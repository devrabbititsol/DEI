<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Ads;
use app\models\Products;
use yii\db\Query;
use app\models\Productslocations;

class HomeController extends Controller
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
    public function init()
    {
        $this->layout = 'page_header';
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        //get counts based on category ids
        $cranescount = Products::find()->where('cat_id = 1')->count();
        $dumperscount = Products::find()->where('cat_id = 2')->count();
        $excavatorscount = Products::find()->where('cat_id = 3')->count();
        $generatorscount = Products::find()->where('cat_id = 4')->count();
        $rigscount = Products::find()->where('cat_id = 5')->count();
        
        // get posted ads
        $ads = Ads::find()->all();
        
        //get our services results
        $query = new Query;
        $services = $query->select(['products.*','categories.name AS category_name','types.name AS type_name', 'models.name AS model_name','categories.metric AS metric'])
                    ->from('products')
                    ->leftJoin('categories', 'categories.cat_id=products.cat_id')
                    ->leftJoin('types', 'types.type_id=products.type')
                    ->leftJoin('models', 'models.mod_id=products.model')
                    ->orderBy(['products.prod_id' => SORT_DESC])
                    ->all();
        
        //get product locations for for google maps
        
        $locations = Productslocations::find()->asArray()->limit(100)->all();
        
       
        /*$connection = Yii::$app->getDb();
        $command = $connection->createCommand("select "
            . "p.*,c.name as category_name,t.name as type_name, m.name as model_name,c.metric as metric from products p "
            . "left join categories c on c.cat_id=p.cat_id "
            . "left join types t on t.type_id=p.type "
            . "left join models m on m.mod_id=p.model "
            . "order by p.prod_id desc");

        $services = $command->queryAll();*/
        
        
        //render view with data
        echo $this->render('index', array('ads' => $ads,
                                          'cranescount' => $cranescount,
                                          'dumperscount' => $dumperscount,
                                          'excavatorscount' => $excavatorscount,
                                          'generatorscount' => $generatorscount,
                                          'rigscount' => $rigscount,
                                          'services' => $services,
                                          'locations' => $locations));
    }
    public function actionAdform()
    {
        echo "";exit;
    }
    
    

   
}
