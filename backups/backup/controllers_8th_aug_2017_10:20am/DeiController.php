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
        
        //get country name based on ip
        $country_name = Generalsettings::get_country_name_by_ip();
        
        
        
        //render view with data
        echo $this->render('//index', array('ads' => $ads,
                                          'cranescount' => $cranescount,
                                          'dumperscount' => $dumperscount,
                                          'excavatorscount' => $excavatorscount,
                                          'generatorscount' => $generatorscount,
                                          'rigscount' => $rigscount,
                                          'services' => $services,
                                          'locations' => $locations,
                                          'country_name' => $country_name));
    }
    /**
     * 
     * Action to display about us page.
     */
    public function actionAboutus()
    {
        return $this->render('//aboutus');
    }
    
    /**
     * 
     * Action to display how it works page.
     */
    public function actionHowitworks()
    {
        return $this->render('//howitworks');
    }
    
    /**
     * 
     * Action to display get quote form page.
     */
    public function actionGetquote()
    {
        $productcategories = Productcategory::find()->orderBy(['display_order' => SORT_ASC])->all();
        return $this->render('//getquote', array('productcategories' => $productcategories));
    }
    
    /**
     * 
     * Action to display contact us form and save form details while submit
     */
    public function actionContact()
    {
        if(!empty($_POST))
        {
            try{
                $response = Contactform::save_contact_details($_POST);
                return $response;
                
            } catch (ErrorException $ex) {
                Yii::warning($ex->getMessage());
            }
           
        }
        else
        {
            return $this->render('//contact');	
        }
    }
    
    
    /****------ user handling actions start  -----****/
    
    // action to login 
    public function actionLogin()
    {
        //Redirect if user already logged in
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
        //check for post values, if return user status to show otp if pending state
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
    
    //action to user logout
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
    
    //action to show registration page.
    public function actionRegistration()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        return $this->render('//registration');
    }
    
    //save new user and send otp to user
    public function actionNewuserregistration()
    {
        try{
            //insert new user to database table.
            $response = User::insert_new_user($_POST);
            if($response)
            {
                //create a 6 digit otp
                $otp = User::create_otp();
                $email = $_POST['email'];
                $phone = $_POST['phone_number'];
                //send  6 digit otp to user
                $response = User::send_otp_to_user($email,$phone,$otp);
            }
            return $response;
            
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
        }
        
    }
    
    //action to send otp to user while forgotpassword request
    public function actionForgotpassword()
    {
        if(!empty($_POST))
        {
            //check input is email 
            if(filter_var($_POST['account'], FILTER_VALIDATE_EMAIL))
            {
                //check email exists
                $response = User::select_email_exist($_POST['account']);
                if($response)
                {
                    //create a 6 digit otp
                    $otp = User::create_otp();
                    $email = $_POST['account'];
                    //send  6 digit otp to user email
                    return $response = User::send_otp_to_user($email,'',$otp);
                }
                else
                {
                    return false;
                }
            }
            //check input is phone number
            else if(preg_match('/^[0-9]{10}+$/', $_POST['account']))
            {
                
                $response = User::select_phone_number_exist($_POST['account']);
                if($response)
                {
                    //create a 6 digit otp
                    $otp = User::create_otp();
                    $phone = $_POST['account'];
                    //send  6 digit otp to user mobile
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
    
    //action to check if user exist by email
    public function actionCheckemailexist()
    {
        $email = $_POST['email'];
        
        $response = User::select_email_exist($email);
        return $response;
    }
    
    //action to check if user exist by mobile
    public function actionCheckphonenumberexist()
    {
        $phone_number = $_POST['phone_number'];
        
        $response = User::select_phone_number_exist($phone_number);
        return $response;
    }
    
    
    
    //action to check otp entered by user while registering, login and forgotpassword
    public function actionVerifyotp()
    {
        //otp verification while forgot password
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
        //otp verification while login and registration.
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
    
    //action to resend otp to user
    public function actionResendotp()
    {
        foreach($_POST as $key=>$val) $$key=get_magic_quotes_gpc()?$val:addslashes($val);
        //create a 6 digit otp
        $otp = User::create_otp();
        //send 6 digit otp to user email and mobile
        $response = User::send_otp_to_user($email,$phone,$otp);
        return $response;
    }
    
    //action to update user password after forgot password otp verify
    public function actionUpdatepassword()
    {
        $session = Yii::$app->session;
        $account = $session->get('forgot_user_account');
        //check user updating password by email
        if(filter_var($account, FILTER_VALIDATE_EMAIL))
        {
            $data['email'] = $account;
            $data['password'] = $_POST['password'];
            User::update_user_password_by_email($data);
            $session->remove('forgot_user_account');
            return $this->redirect(['login']);
        }
        //check user updating password by mobile
        else if(preg_match('/^[0-9]{10}+$/', $account))
        {
            $data['phone_number'] = $account;
            $data['password'] = $_POST['password'];
            User::update_user_password_by_phone($data);
            $session->remove('forgot_user_account');
            return $this->redirect(['login']);
        }
    }
    /****------  user handling actions end  -----****/
    
    //action to display add product form to user
    public function actionAddproduct()
    {
        //render add product form by getting product categories and regions 
        $productcategories = Productcategory::find()->orderBy(['display_order' => SORT_ASC])->all();
        $regions = Regions::find()->all();
        return $this->render('//addproduct', array('productcategories' => $productcategories,
                                                   'regions' => $regions));
    }
    
    //action to get Sub categories by category id
    public function actionGetproductsubcategories()
    {
        $category_id = $_REQUEST['category_id'];
        $subcategories = Productsubcategory::select_by_category_id($category_id);
        $out='<option value="" selected>SELECT SUB CATEGORY *</option>';
        foreach($subcategories as $subcategory)
        {
            $out.='<option value="'.$subcategory['sub_category_id'].'">'.strtoupper($subcategory['sub_category_name']).'</option>';
        }
        
        //select fields to display for particular category
        $category_fields = Productcategory::select_fields_by_category_id($category_id);
        $fields=explode(",",$category_fields[0]['category_fields']);
        
        return json_encode(array("out"=>$out,"fields"=>$fields,"metric"=>$category_fields[0]['metric']));
        
    }
    
    //Action to get models by sub category id
    public function actionGetsubcategorymodels()
    {
        $sub_category_id = $_REQUEST['sub_category_id'];
        $models = Productmodel::select_models_by_sub_category_id($sub_category_id);
        $out='<option value="">SELECT MODEL * </option>';
        foreach($models as $model)
        {
            $out.='<option value="'.$model['model_id'].'">'.strtoupper($model['model_name']).'</option>';
        }
        return json_encode(array("out"=>$out));
    }
    
    //action to get product capacity for product search dropdown
    public function actionGetproductscapacity()
    {
        
        //$capacities = Products::select_product_capacity_by_category_id($_REQUEST);
        $capacities = Productcapacity::select_capacity_by_options($_REQUEST);
        $out='<option value="" selected>SELECT CAPACITY</option>';
        foreach($capacities as $capacity)
        {
            $out.='<option value="'.$capacity['capacity_range'].'">'.strtoupper($capacity['capacity_name']).'</option>';
        }
        return json_encode(array("out"=>$out));
    }
    
    //action to upload product images while adding new product
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
                $file_extension = pathinfo($_FILES['category_id']['name'], PATHINFO_EXTENSION);
                $name="dei_".rand(1000,50000).time().'.'.$file_extension;  
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
            //return image name after upload
            return json_encode(implode(',',$session->get('product_images')));
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
        }
        
    }
    
    //action to delete product images while adding new product
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
        
        //delete image
        unlink("uploads/".date('Y').'/'.$category_name.'/'.$image_name[$key]);
        unset($image_name[$key]);
        unset($original_image_name[$key]);
        
        
        $session->remove('product_images');
        $session->set('product_images', $image_name);

        $session->remove('product_images_names');
        $session->set('product_images_names', $original_image_name);
        return json_encode(implode(',',$session->get('product_images')));
    }
    
    //action to upload product load charts while adding new product
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
                $file_extension = pathinfo($_FILES['category_id']['name'], PATHINFO_EXTENSION);
                $name="dei_load_chart_".rand(1000,50000).time().'.'.$file_extension; 
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
            //return image name after upload
            return json_encode(implode(',',$session->get('product_loadcharts')));
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
        }
        
    }
    
    //action to delete product load charts while adding new product
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
        
        //delete image
        unlink("uploads/".date('Y').'/'.$category_name.'/'.$load_chart_name[$key]);
        unset($load_chart_name[$key]);
        unset($original_load_chart_name[$key]);
        
        
        $session->remove('product_loadcharts');
        $session->set('product_loadcharts', $load_chart_name);

        $session->remove('product_loadcharts_names');
        $session->set('product_loadcharts_names', $original_load_chart_name);
        return json_encode($session->get('product_loadcharts'));
    }
    
    //action to save new product
    public function actionSaveproduct()
    {
        try{
            if(Yii::$app->request->isGet)
            {
                return $this->redirect(Yii::$app->params['SITE_URL']);
            }
            if (!isset($_POST['repeat'] )) 
            {
                //check for paid package
                if($_POST['package_type'] == 2) //1= free, 2=paid
                {
                    //insert new product details to database table
                    Products::insert_new_product_details($_POST);
                    Yii::$app->response->redirect(['productsuccess']);
                    //return $this->render('//productpayment', array('productdata' => $productdata));
                }
                else
                {
                    //insert new product details to database table
                    Products::insert_new_product_details($_POST);
                    Yii::$app->response->redirect(['productsuccess']);
                    //return $this->render('//productsuccessmessage', array('productdata' => $productdata));
                }
            }
            else
            {
                return $this->redirect(Yii::$app->params['SITE_URL']);
            }
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
            //return back 
            return $this->redirect(Yii::$app->request->referrer);
        }
        
        
    }
    
    /**
     *  Product success message after product added successfully.
     * 
     */
    public function actionProductsuccess()
    {
        try{
            
            $session = Yii::$app->session;
            if(@$session->get('current_product_id') != '')
            {
                $productdata = Products::find()->where(['product_id' => $session->get('current_product_id')])->one(); 
                return $this->render('//productsuccessmessage', array('productdata' => $productdata));
            }
            else
            {
                return $this->redirect(Yii::$app->params['SITE_URL']);
            }
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
            return $this->redirect(Yii::$app->params['SITE_URL']);
        }
        
    }
    //action to get package amount while adding new product
    public function actionGetpackageamount()
    {
        try{
            //get amount to pay by user while creating new product
            $response = Productcapacity::select_amount_by_capacity($_POST);
            return $response;
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
        }
        
    }
    
    //action to render product list page with options
    public function actionProducts()
    {
        
        try{
            $products=Products::select_products_by_options($_REQUEST);
            $productcategories = Productcategory::find()->orderBy(['display_order' => SORT_ASC])->all();
            return $this->render('//products', array('products' => $products,'productcategories' => $productcategories,'options' => $_REQUEST));
            
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
        }
        
    }
    
    //action to show product details dialog box by product id
    public function actionGetproductbyid()
    {
        try{
            //get product details by id from database table.
            $product=Products::select_product_by_id($_REQUEST);
            return json_encode($product);
            
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
        }
        
    }
    
    //action to save new order
    public function actionSaveneworder()
    {
        try{
            //insert new record to database table.
            $product=Productorder::insert_new_order($_REQUEST);
            return $product;
            
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
        }
        
    }
    
    //action to save website Ad and post in facebook
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
            
            //insert ad form data to database table and post in facebook wall
            $response=Ads::insert_facebook_post($_REQUEST);

            $country_name = Generalsettings::get_country_name_by_ip();
            //render view with data
            echo $this->render('//index', array('ads' => $ads,
                                              'cranescount' => $cranescount,
                                              'dumperscount' => $dumperscount,
                                              'excavatorscount' => $excavatorscount,
                                              'generatorscount' => $generatorscount,
                                              'rigscount' => $rigscount,
                                              'services' => $services,
                                              'locations' => $locations,
                                                'response' => $response,
                                                'country_name' => $country_name));
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
            return $this->redirect(['/']);
        }
        
    }
    
    //action to save new get quote request
    public function actionSavegetquote()
    {
        try{
            //insert quotation form data to database table.
            $response=Getquote::insert_new_quotation($_REQUEST);
            return $response;
            
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
        }
        
    }
}
