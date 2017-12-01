<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\db\Query;

use app\models\LoginForm;
use app\models\ContactForm;
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
use yii\base\ErrorException;

class DeiController extends Controller
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
        if($action->id = 'uploadproductimages') {
            Yii::$app->request->enableCsrfValidation = false;
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
        $this->layout = 'page_header';
    }
    
    public function actionIndex()
    {
        //get Products count by their category
        $cranescount = Products::select_product_count_by_category_id(1);
        $dumperscount = Products::select_product_count_by_category_id(2);
        $excavatorscount = Products::select_product_count_by_category_id(3);
        $generatorscount = Products::select_product_count_by_category_id(4);
        $rigscount = Products::select_product_count_by_category_id(5);
        
        // get all posted ads
        $ads = Ads::select_all_ads();
        
        //get our services results
        $services = Products::select_all_our_services();
        
        //get product locations for for google maps
        $locations = Productslocations::find()->asArray()->limit(100)->all();
        
        
        
        //render view with data
        echo $this->render('//index', array('ads' => $ads,
                                          'cranescount' => $cranescount,
                                          'dumperscount' => $dumperscount,
                                          'excavatorscount' => $excavatorscount,
                                          'generatorscount' => $generatorscount,
                                          'rigscount' => $rigscount,
                                          'services' => $services,
                                          'locations' => $locations));
    }

    public function actionAboutus()
    {
        return $this->render('//aboutus');
    }
    
    public function actionHowitworks()
    {
        return $this->render('//howitworks');
    }
    
    public function actionGetquote()
    {
        return $this->render('//getquote');
    }
    
    public function actionContact()
    {
        return $this->render('//contact');
    }
    
    
    //user handling actions start
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        if(!empty($_POST))
        {
            $userstatus = LoginForm::user_login($_POST);
            if($userstatus == 1)
            {
                $otp = User::create_otp();
                User::send_otp_to_user($_POST['email'],'',$otp);
            }
            return $userstatus;
        }
        else
        {
            return $this->render('//login');
        }        
        
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
    
    public function actionRegistration()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        return $this->render('//registration');
    }
    
    public function actionForgotpassword()
    {
        if(!empty($_POST))
        {
            if(filter_var($_POST['account'], FILTER_VALIDATE_EMAIL))
            {
                $response = User::select_email_exist($_POST['account']);
                if($response)
                {
                    $otp = User::create_otp();
                    $email = $_POST['account'];
                    return $response = User::send_otp_to_user($email,'',$otp);
                }
                else
                {
                    return false;
                }
            }
            else if(preg_match('/^[0-9]{10}+$/', $_POST['account']))
            {
                
                $response = User::select_phone_exist($_POST['account']);
                if($response)
                {
                    $otp = User::create_otp();
                    $phone = $_POST['account'];
                    return $response = User::send_otp_to_user('',$phone,$otp);
                }
                else
                {
                    return false;
                }
            }
            return false;
        }
        else
        {
            return $this->render('//forgotpassword');
        }        
        
    }
    
    //check if user exist by email
    public function actionCheckemailexist()
    {
        $email = $_POST['email'];
        
        $response = User::select_email_exist($email);
        return $response;
    }
    
    //check if user exist by mobile
    public function actionCheckphonenumberexist()
    {
        $phone_number = $_POST['phone_number'];
        
        $response = User::select_phone_number_exist($phone_number);
        return $response;
    }
    
    //save new user and send otp to user
    public function actionNewuserregistration()
    {
        $response = User::insert_new_user($_POST);
        if($response)
        {
            $otp = User::create_otp();
            $email = $_POST['email'];
            $phone = $_POST['phone_number'];
            $response = User::send_otp_to_user($email,$phone,$otp);
        }
        return $response;
    }
    
    //function to verify otp entered by user while registering, login and forgotpassword
    public function actionVerifyotp()
    {
        if(@$_POST['action'] == 'forgotpassword')
        {
            
            if(filter_var($_POST['account'], FILTER_VALIDATE_EMAIL))
            {
                
                $data['action'] = $_POST['action'];
                $data['email']= $_POST['account'];
                $data['phone']= '';
                $data['otp']= $_POST['otp'];
                $response = User::select_user_current_otp($data);
                if($response)
                {
                    $session = Yii::$app->session;
                    $session->set('forgot_user_account', $_POST['account']);
                    return true;
                }
                else
                    return false;
            }
            else if(preg_match('/^[0-9]{10}+$/', $_POST['account']))
            {
                $data['action'] = $_POST['action'];
                $data['email']= '';
                $data['phone']= $_POST['account'];
                $data['otp']= $_POST['otp'];
                $response = User::select_user_current_otp($data);
                if($response)
                {
                    $_SESSION['forgot_user_account'] = $_POST['account'];
                    return true;
                }
                else
                    return false;
            }
            return false;
        }
        else {
            $_POST['action'] = 'login/registration';
            $response = User::select_user_current_otp($_POST);
            if($response)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }
    public function actionResendotp()
    {
        foreach($_POST as $key=>$val) $$key=get_magic_quotes_gpc()?$val:addslashes($val);
        $otp = User::create_otp();
        $response = User::send_otp_to_user($email,$phone,$otp);
        return $response;
    }
    
    public function actionUpdatepassword()
    {
        $session = Yii::$app->session;
        $account = $session->get('forgot_user_account');
        if(filter_var($account, FILTER_VALIDATE_EMAIL))
        {
            $data['email'] = $account;
            $data['password'] = $_POST['password'];
            User::update_user_password_by_email($data);
            $session->remove('forgot_user_account');
            return $this->redirect(['login']);
        }
        else if(preg_match('/^[0-9]{10}+$/', $account))
        {
            $data['phone_number'] = $account;
            $data['password'] = $_POST['password'];
            User::update_user_password_by_phone($data);
            $session->remove('forgot_user_account');
            return $this->redirect(['login']);
        }
    }
    //user handling actions end
    
    public function actionAddproduct()
    {
        $productcategories = Productcategory::find()->orderBy(['display_order' => SORT_ASC])->all();
        $regions = Regions::find()->all();
        return $this->render('//addproduct', array('productcategories' => $productcategories,
                                                   'regions' => $regions));
    }
    
    public function actionGetproductsubcategories()
    {
        $category_id = $_REQUEST['category_id'];
        $subcategories = Productsubcategory::select_by_category_id($category_id);
        $out='<option value="">Select Sub Category *</option>';
        foreach($subcategories as $subcategory)
        {
            $out.='<option value="'.$subcategory['sub_category_id'].'">'.$subcategory['sub_category_name'].'</option>';
        }
        $category_fields = Productcategory::select_fields_by_category_id($category_id);
        $fields=explode(",",$category_fields[0]['category_fields']);
        
        return json_encode(array("out"=>$out,"fields"=>$fields,"metric"=>$category_fields[0]['metric']));
        
    }
    
    public function actionGetsubcategorymodels()
    {
        $sub_category_id = $_REQUEST['sub_category_id'];
        $models = Productmodel::select_models_by_sub_category_id($sub_category_id);
        $out='<option value="">Select Model * </option>';
        foreach($models as $model)
        {
            $out.='<option value="'.$model['model_id'].'">'.$model['model_name'].'</option>';
        }
        return json_encode(array("out"=>$out));
    }
    
    public function actionGetproductscapacity()
    {
        
        $capacities = Products::select_product_capacity_by_category_id($_REQUEST);
        $out='<option value="" selected>Select Capacity</option>';
        foreach($capacities as $capacity)
        {
            $out.='<option value="'.$capacity['capacity'].'">'.$capacity['capacity'].'</option>';
        }
        return json_encode(array("out"=>$out));
    }
    public function actionUploadproductimages()
    {
        try{
            $original_image_name =array();
            $image_name = array();
            ini_set('upload_max_filesize', '64M');
            //get category name by id to create folder
            $category_id = $_REQUEST['category_id'];
            $category_names = Productcategory::select_fields_by_category_id($category_id);
            $category_name= str_replace(' ', '_', $category_names[0]['category_name']);
            
            if (!empty($_FILES['category_id'])) {
                $name="dei_".rand(1000,50000).time();  
                $session = Yii::$app->session;
                if($session->has('product_images'))
                {

                    $image_name=$session->get('product_images');
                }
                if($session->has('product_images_names'))
                {

                    $original_image_name=$session->get('product_images_names');
                }


                array_push($image_name, $name);
                array_push($original_image_name, $_FILES['category_id']['name']);

                $session->remove('product_images');
                $session->set('product_images', $image_name);

                $session->remove('product_images_names');
                $session->set('product_images_names', $original_image_name);
                
                //if folders not exist create
                if (!file_exists('uploads/'.date('Y'))) {
                    mkdir('uploads/'.date('Y'), 0777, true);
                }
                if (!file_exists("uploads/".date('Y').'/'.$category_name)) {
                    mkdir("uploads/".date('Y').'/'.$category_name, 0777, true);
                }
                $targetFile =  "uploads/".date('Y').'/'.$category_name.'/'. $name;  
                move_uploaded_file($_FILES['category_id']['tmp_name'],$targetFile); 
            }
            return json_encode(implode(',',$session->get('product_images')));
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
        }
        
    }
    public function actionDeleteproductimages()
    {
        $session = Yii::$app->session;
        $original_image_name =array();
        $image_name = array();
        $image_name=$session->get('product_images');
        $original_image_name=$session->get('product_images_names');
        
        $key = array_search($_REQUEST['filetodelete'], $original_image_name);
        
        //get category name by id to create folder
        $category_id = $_REQUEST['category_id'];
        $category_names = Productcategory::select_fields_by_category_id($category_id);
        $category_name= str_replace(' ', '_', $category_names[0]['category_name']);
        
        unlink("uploads/".date('Y').'/'.$category_name.'/'.$image_name[$key]);
        unset($image_name[$key]);
        unset($original_image_name[$key]);
        
        
        $session->remove('product_images');
        $session->set('product_images', $image_name);

        $session->remove('product_images_names');
        $session->set('product_images_names', $original_image_name);
        return json_encode(implode(',',$session->get('product_images')));
    }
    
    public function actionUploadproductloadcharts()
    {
        try{
            $original_load_chart_name =array();
            $load_chart_name = array();
            //get category name by id to create folder
            $category_id = $_REQUEST['category_id'];
            $category_names = Productcategory::select_fields_by_category_id($category_id);
            $category_name= str_replace(' ', '_', $category_names[0]['category_name']);
            
            if (!empty($_FILES['file'])) {
                $name="dei_load_chart".rand(1000,50000).time(); 
                $session = Yii::$app->session;
                if($session->has('product_loadcharts'))
                {
                    $load_chart_name=$session->get('product_loadcharts');
                }
                if($session->has('product_loadcharts_names'))
                {
                    $original_load_chart_name=$session->get('product_loadcharts_names');
                }


                array_push($load_chart_name, $name);
                array_push($original_load_chart_name, $_FILES['file']['name']);

                $session->remove('product_loadcharts');
                $session->set('product_loadcharts', $load_chart_name);

                $session->remove('product_loadcharts_names');
                $session->set('product_loadcharts_names', $original_load_chart_name);
                
                //if folders not exist create
                if (!file_exists('uploads/'.date('Y'))) {
                    mkdir('uploads/'.date('Y'), 0777, true);
                }
                if (!file_exists("uploads/".date('Y').'/'.$category_name)) {
                    mkdir("uploads/".date('Y').'/'.$category_name, 0777, true);
                }
                $targetFile =  "uploads/".date('Y').'/'.$category_name.'/'. $name; 
                move_uploaded_file($_FILES['file']['tmp_name'],$targetFile); 
            }
            return json_encode(implode(',',$session->get('product_loadcharts')));
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
        }
        
    }
    public function actionDeleteproductloadcharts()
    {
        $session = Yii::$app->session;
        $original_load_chart_name =array();
        $image_name = array();
        $load_chart_name=$session->get('product_loadcharts');
        $original_load_chart_name=$session->get('product_loadcharts_names');
        
        $key = array_search($_REQUEST['filetodelete'], $original_load_chart_name);
        
        //get category name by id to create folder
        $category_id = $_REQUEST['category_id'];
        $category_names = Productcategory::select_fields_by_category_id($category_id);
        $category_name= str_replace(' ', '_', $category_names[0]['category_name']);
        
        unlink("uploads/".date('Y').'/'.$category_name.'/'.$load_chart_name[$key]);
        unset($load_chart_name[$key]);
        unset($original_load_chart_name[$key]);
        
        
        $session->remove('product_loadcharts');
        $session->set('product_loadcharts', $load_chart_name);

        $session->remove('product_loadcharts_names');
        $session->set('product_loadcharts_names', $original_load_chart_name);
        return json_encode($session->get('product_loadcharts'));
    }
    
    //save new product
    public function actionSaveproduct()
    {
        try{
            if(empty($_POST))
            {
                return $this->redirect(Yii::$app->params['SITE_URL']);
            }
            if($_POST['package_type'] == 2) //1= free, 2=paid
            {
                Products::insert_new_product_details($_POST);
                $session = Yii::$app->session;
                $productdata = Products::find()->where(['product_id' => $session->get('current_product_id')])->one(); 
                return $this->render('//productpayment', array('productdata' => $productdata));
            }
            else
            {
                Products::insert_new_product_details($_POST);
                $session = Yii::$app->session;
                $productdata = Products::find()->where(['product_id' => $session->get('current_product_id')])->one(); 
                return $this->render('//productsuccessmessage', array('productdata' => $productdata));
            }
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
            //return back 
            return $this->redirect(Yii::$app->request->referrer);
        }
        
        
    }
    //get package amount
    public function actionGetpackageamount()
    {
        try{
            $response = Productcapacity::select_amount_by_capacity($_POST);
             
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
        }
        return $response;
    }
    
    //product list
    public function actionProducts()
    {
        
        try{
            $products=Products::select_products_by_options($_REQUEST);
            $productcategories = Productcategory::find()->orderBy(['display_order' => SORT_ASC])->all();
            
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
        }
        return $this->render('//products', array('products' => $products,'productcategories' => $productcategories,'options' => $_REQUEST));
    }
    
    public function actionGetproductbyid()
    {
        try{
            $product=Products::select_product_by_id($_REQUEST);
            return json_encode($product);
            
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
        }
        
    }
    
    public function actionSaveneworder()
    {
        try{
            $product=Productorder::insert_new_order($_REQUEST);
            return $product;
            
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
        }
        
    }
    
    //facebook post Ad
    public function actionFacebookad()
    {
        try{
            if(empty($_REQUEST))
            {
                return $this->redirect(['/']);
            }
            //get Products count by their category
        $cranescount = Products::select_product_count_by_category_id(1);
        $dumperscount = Products::select_product_count_by_category_id(2);
        $excavatorscount = Products::select_product_count_by_category_id(3);
        $generatorscount = Products::select_product_count_by_category_id(4);
        $rigscount = Products::select_product_count_by_category_id(5);
        
        // get all posted ads
        $ads = Ads::select_all_ads();
        
        //get our services results
        $services = Products::select_all_our_services();
        
        //get product locations for for google maps
        $locations = Productslocations::find()->asArray()->limit(100)->all();
        
        $response=Ads::insert_facebook_post($_REQUEST);
        
        
        //render view with data
        echo $this->render('//index', array('ads' => $ads,
                                          'cranescount' => $cranescount,
                                          'dumperscount' => $dumperscount,
                                          'excavatorscount' => $excavatorscount,
                                          'generatorscount' => $generatorscount,
                                          'rigscount' => $rigscount,
                                          'services' => $services,
                                          'locations' => $locations,
                                            'response' => $response));
            
            
            
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
            return $this->redirect(['/']);
        }
        
    }
    
}
