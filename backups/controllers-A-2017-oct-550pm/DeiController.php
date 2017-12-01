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
use app\models\Feedbackform;
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
//use app\models\Zones;
use app\models\Generalsettings;
use app\models\Mail_settings;
use app\models\Payments;
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
        //print_r(\app\models\User::findByUseremail('basaveswar.allaka@devrabbit.com'));
        if($action->id == 'uploadproductimages' ||  $action->id == 'uploadadvtimages' ||  $action->id == 'uploadproductloadcharts') {
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
        //print_r($ads);exit;
        //get our services results
        $services = Products::select_all_our_services();
        
        //get product locations for for google maps
        $locations = Productslocations::get_all_current_locations();
        
        //get country name based on ip
        $ipdetails = Generalsettings::get_country_name_by_ip();
        
        
        
        //render view with data
        echo $this->render('//index', array('ads' => $ads,
                                          'cranescount' => $cranescount,
                                          'dumperscount' => $dumperscount,
                                          'excavatorscount' => $excavatorscount,
                                          'generatorscount' => $generatorscount,
                                          'rigscount' => $rigscount,
                                          'services' => $services,
                                          'locations' => $locations,
                                          'country_name' => $ipdetails['country_name'],
                                          'lat' => $ipdetails['latitude'],
                                          'lng' => $ipdetails['longitude']));
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
    
    //function to display feedback form and send email to admin 
    public function actionFeedback()
    {
        if(!empty($_POST))
        {
            try{
                $response = Feedbackform::save_feedback_details($_POST);
                return $response;
                
            } catch (ErrorException $ex) {
                Yii::warning($ex->getMessage());
            }
            /*try{
                $subject="New Feedback | BIG EQUIPMENTS INDIA";
                //get message for this mail
                $message = Mail_settings::get_feedback_message_to_admin($_POST);
                
                //get admin email
                $email = Yii::$app->params['ADMIN_EMAIL'];

                //function to send email to admin
                Mail_settings::send_email_notification($email,$subject,$message);
                return "SUCCESS";
                
            } catch (ErrorException $ex) {
                Yii::warning($ex->getMessage());
                return "FAILED";
            }*/
           
        }
        else
        {
            return $this->render('//feedback');	
        }
    }
    
    //action to terms of use page
    public function actionTermsOfUse()
    {
        return $this->render('//termsofuse');
    }
    
    //action to Privacy policy page
    public function actionPrivacyPolicy()
    {
        return $this->render('//privacypolicy');
    }
    
    //action to Packages page
    public function actionPackages()
    {
        return $this->render('//packages');
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
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
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
                    return $response = User::send_forgot_otp_to_user($email,'',$otp);
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
                    return $response = User::send_forgot_otp_to_user('',$phone,$otp);
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
        //$zones = Zones::get_all_zones();
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
                $file_extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
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
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
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
                    $currentdate_timestamp = strtotime(date("Y-m-d H:i:s"));
                    $_POST['product_expires_on'] = date("Y-m-d H:i:s", strtotime(Yii::$app->params['PRODUCT_PAID_DAYS'], $currentdate_timestamp));
                    //insert new product details to database table
                    Products::insert_new_product_details($_POST);
                    
                    $session = Yii::$app->session;
                    $session->set('productdetails', $_POST);
                    $session->set('payment_product_id', $session->get('current_product_id'));
                    return $this->redirect(['paymentcart']);
                    
                    //Yii::$app->response->redirect(['productsuccess']);
                    //return $this->render('//productpayment', array('productdata' => $productdata));
                }
                else
                {
                    $_POST['product_expires_on'] = date("Y-m-d H:i:s", strtotime(Yii::$app->params['PROMOTIONAL_OFFER_UPTO']));
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
     *  Product success message after product added successfully as free package
     * 
     */
    public function actionProductsuccess()
    {
        try{
            
            $session = Yii::$app->session;
            if(@$session->get('current_product_id') != '')
            {
                $productdata = Products::find()->where(['product_id' => $session->get('current_product_id')])->one(); 
                
                
                //remove following update when control panel completes
                /*$product_status = Products::findOne($session->get('current_product_id'));
                $product_status->product_status = 0;
                $product_status->update();*/
                
                //get current user email
                $email = User::select_user_email_by_id();
                $subject="BIG EQUIPMENTS INDIA | Registration Of Equipment";
                //get what message to send after creating product
                $message = Mail_settings::get_product_add_message($productdata->manual_product_code,$session->get('current_product_id'));

                //send email to current user
                Mail_settings::send_email_notification($email,$subject,$message);
                
                
                $session->set('current_product_id', '');
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
    
    // Product success message after product payment done successfully as paid package
    public function actionProductpaymentsuccess()
    {
        try{
            $session = Yii::$app->session;
            if(@$session->get('current_product_id') != '')
            {
                //update transaction details
                $response = Yii::$app->request->bodyParams;
                $transaction_data = Payments::decrypt_response($response);
                
                if(!empty($transaction_data))
                {
                    Payments::update_transaction($transaction_data);
                }
                $productdata = Products::find()->where(['product_id' => $session->get('current_product_id')])->one(); 
                
                //remove following update when control panel completes
                /*$product_status = Products::findOne($session->get('current_product_id'));
                $product_status->product_status = 1;
                $product_statuscustomer->update();*/
                
                //if order status is success then send email to user 
                if($transaction_data['order_status'] === 'Success')
                {
                    //get current user email
                    $email = User::select_user_email_by_id();
                    $subject="BIG EQUIPMENTS INDIA | Registration Of Equipment";
                    //get what message to send after creating product
                    $message = Mail_settings::get_product_add_message($productdata->manual_product_code,$session->get('current_product_id'));

                    //send email to current user
                    Mail_settings::send_email_notification($email,$subject,$message);
                }
                
                //empty current product id session value
                $session->set('current_product_id', '');
                
                return $this->render('//productsuccessmessage', array('productdata' => $productdata,'transaction_data' => $transaction_data));
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
    
    //action to display message if product payment cancelled by user.
    public function actionProductpaymentcancel()
    {
        try{
            $session = Yii::$app->session;
            if(@$session->get('current_product_id') != '')
            {
                //update transaction details
                $response = Yii::$app->request->bodyParams;
                $transaction_data = Payments::decrypt_response($response);
                
                if(!empty($transaction_data))
                {
                    Payments::update_transaction($transaction_data);
                }
                $productdata = Products::find()->where(['product_id' => $session->get('current_product_id')])->one(); 
                
                //empty current product id session value
                $session->set('current_product_id', '');
                
                return $this->render('//productcancelmessage', array('productdata' => $productdata,'transaction_data' => $transaction_data));
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
    
    //action to edit packageamount
    public function actionEditproduct($product_id)
    {
       try{
           //if not logged in redirect
           if(Yii::$app->user->isGuest)
           {
               return $this->redirect(Yii::$app->params['SITE_URL']);
           }
           
           //get product data by product id
           $productdata = Products::get_product_by_id($product_id);
           
           //get all product categories
           $productcategories = Productcategory::find()->orderBy(['display_order' => SORT_ASC])->all();
           //get all regions
           $regions = Regions::find()->all();
           
           //get product sub categories by produt category of this product
           $productsubcategories = Productsubcategory::select_by_category_id($productdata->category_id);
           
           //get product models by product sub category of this product
           $productmodels = Productsubcategory::select_by_category_id($productdata->sub_category_id);
           
           return $this->render('//editproduct', array('productdata' => $productdata,
                                                        'productcategories' => $productcategories,
                                                        'regions' => $regions,
                                                        'productsubcategories' => $productsubcategories,
                                                        'productmodels' => $productmodels));
           
       } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
            //return $this->redirect(Yii::$app->request->referrer);
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
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        try{
            //insert new record to database table.
            $product=Productorder::insert_new_order($_REQUEST);
            return $product;
            
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
        }
        
    }
    
    //action to upload product images while adding new product
    public function actionUploadadvtimages()
    {
        try {

            $target_path = "uploads/";
            
            $original_image_name =array();
            $image_name = array();

            $fileTmp = $_FILES['advt_images']['tmp_name'];
            $filename = $_FILES['advt_images']['name'];
            
            $parts = explode('.', $filename);
            $ext = $parts[sizeof($parts) - 1];
            $fname = "fb_" . rand(1, 10000) . time() . "." . strtolower($ext);
            
        //    echo $fname;

            $session = Yii::$app->session;

            if ($session->has('advt_images')) {

                $image_name = $session->get('advt_images');
            }
            if ($session->has('advt_images_names')) {

                $original_image_name = $session->get('advt_images_names');
            }


            array_push($image_name, $fname);
            array_push($original_image_name, $filename);

            $session->remove('advt_images');
            $session->set('advt_images', $image_name);

            $session->remove('advt_images_names');
            $session->set('advt_images_names', $original_image_name);

            #if ($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg' || $ext == 'gif') {
                move_uploaded_file($fileTmp, $target_path . $fname);
            #} 
            
            //return image name after upload
            return implode(',', $session->get('advt_images'));
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
        }
    }
    
    //action to delete product images while adding new product
    public function actionDeleteadvtimages()
    {
        $session = Yii::$app->session;
        $original_image_name =array();
        $image_name = array();
        $image_name=$session->get('advt_images');
        $original_image_name=$session->get('advt_images_names');
        
        $key = array_search($_REQUEST['filetodelete'], $original_image_name);
                
        //delete image
        unlink("uploads/".$image_name[$key]);
        unset($image_name[$key]);
        unset($original_image_name[$key]);
        
        
        $session->remove('advt_images');
        $session->set('advt_images', $image_name);

        $session->remove('advt_images_names');
        $session->set('advt_images_names', $original_image_name);
        return implode(',',$session->get('advt_images'));
    }
    
    //action to save website Ad and post in facebook
    public function actionFacebookad()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        try{
            if(empty($_REQUEST))
            {
                return $this->redirect(['/']);
            }
            //insert ad form data to database table and post in facebook wall
            
            if($_REQUEST['advt_package'] == 0){
                $amount_actual = 0; $validity = "1 Months"; $_REQUEST['validity'] = $validity;
            }
            
            if($_REQUEST['advt_package'] == 1){
                $amount_actual = 50000; $validity = "1 Months"; $_REQUEST['validity'] = $validity;
            }
            else if($_REQUEST['advt_package'] == 2){
                $amount_actual = 150000; $validity = "4 Months"; $_REQUEST['validity'] = $validity;
            }
            else if($_REQUEST['advt_package'] == 3){
                $amount_actual = 300000; $validity = "9 Months"; $_REQUEST['validity'] = $validity;
            }
            else if($_REQUEST['advt_package'] == 4){
                $amount_actual = 400000; $validity = "12 Months"; $_REQUEST['validity'] = $validity;
            }
            $response=Ads::insert_facebook_post($_REQUEST);
            
            if(count($response['err'])==0 && $_REQUEST['advt_package'] != 0)//don't have errors and successfully inserted advt
            {
                
                $session = Yii::$app->session;
                $session->set('advt_package', $_REQUEST['advt_package']);
                $session->set('amount_actual', $amount_actual);
                $session->set('ad_id', $response['ad_id']);
                $session->set('payment_ad_id', $response['ad_id']);
                return $this->redirect(['paymentcart']);
                //return $this->actionPaymentcheckout($_REQUEST,$response,$amount_actual);
                
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
            $locations = Productslocations::get_all_current_locations();
            
            //get ip details
            $ipdetails = Generalsettings::get_country_name_by_ip();
            //render view with data
            echo $this->render('//index', array('ads' => $ads,
                                              'cranescount' => $cranescount,
                                              'dumperscount' => $dumperscount,
                                              'excavatorscount' => $excavatorscount,
                                              'generatorscount' => $generatorscount,
                                              'rigscount' => $rigscount,
                                              'services' => $services,
                                              'locations' => $locations,
                                                'response' => $response['err'],
                                                'country_name' => $ipdetails['country_name'],
                                                'lat' => $ipdetails['latitude'],
                                                'lng' => $ipdetails['longitude']));
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
            return $this->redirect(['/']);
        }
        
    }
    
    //action for advt payment success
    public function actionFacebookadpaymentsuccess()
    {
        if(empty($_REQUEST))
        {
            return $this->goHome();
        }
        
        //update transaction details 
        $response = Yii::$app->request->bodyParams;
        $transaction_data = Payments::decrypt_response($response);
        Payments::update_transaction($transaction_data);
        
        //update advt status
        //$ad_status = Ads::update_status($session->get('ad_id'),1);//activate advt.
        
        $postadtofacebook = Ads::post_advt_on_facebook_wall($session->get('ad_id'));
        
        $session->set('ad_id','');
        
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

        //get product locations for google maps
        $locations = Productslocations::get_all_current_locations();
        
        $ipdetails = Generalsettings::get_country_name_by_ip();
        
        $response = array(); //successfully posted advt.
        
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
                                            'country_name' => $ipdetails['country_name'],
                                            'lat' => $ipdetails['latitude'],
                                            'lng' => $ipdetails['longitude']));
    }
    
    public function actionFacebookadpaymentcancel()
    {
        if(empty($_REQUEST))
        {
            return $this->goHome();
        }
        
        //update transaction details 
        $response = Yii::$app->request->bodyParams;
        $transaction_data = Payments::decrypt_response($response);
        Payments::update_transaction($transaction_data);
        
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

        //get product locations for google maps
        $locations = Productslocations::get_all_current_locations();
        
        $ipdetails = Generalsettings::get_country_name_by_ip();
        
        $response = array('You have cancelled your Advertisement payment, Please contact us if you have queries?'); //successfully posted advt.
        
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
                                            'country_name' => $ipdetails['country_name'],
                                            'lat' => $ipdetails['latitude'],
                                            'lng' => $ipdetails['longitude']));
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
    
    
    /* sahoo 7th-aug-2017 */
    
    //my account action 
    public function actionMyAccount()
    {
        // redirect to home if user not logged in
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
        $userId = Yii::$app->user->id;
        
        $userDetails = User::get_user_details_by_id($userId);
        $hireDetails = User::hire_details_by_user($userId);
        $supplyDetails = User::supply_details_by_user($userId);
        $buyDetails = User::buy_details_by_user($userId);
        $saleDetails = User::sale_details_by_user($userId);
        $supplyorsaleDetails = User::supply_or_sale_details_by_user($userId);
        $addetails = User::ad_details_by_user($userId);
        return $this->render('//myprofile',array('userdetails' => $userDetails,
                                                 'hiredetails' => $hireDetails,
                                                 'supplydetails' => $supplyDetails,
                                                 'buydetails' => $buyDetails,
                                                 'saledetails' => $saleDetails,
                                                 'supplyorsaledetails' => $supplyorsaleDetails,
                                                 'addetails' => $addetails));	
    }	
    
    public function actionProfileupdate()
    {
        $userupdate = User::update_userdetails($_POST);
        return $userupdate;
    }
	
    

    // action to Update Password.
    public function actionChangePassword() {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        if (!empty($_POST)) {
            $passwordchange = User::password_change($_POST);

            return $passwordchange;
        } else {
            return $this->render('//myprofile');
        }
    }

    

    //action to delete product details by product id
    public function actionDeleteproductbyid() {
        try {
            $product = Products::delete_product_by_id($_POST);
            return json_encode($product);
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
        }
    }

    //action to delete order details by order id
    public function actionDeleteorderbyid() {
        try {
            $product = Productorder::delete_order_by_id($_POST);
            return json_encode($product);
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
        }
    }
    
    //action to delete order details by order id
    public function actionDeleteadbyid() {
        try {
            $product = Ads::delete_ad_by_id($_POST);
            return json_encode($product);
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
        }
    }
    
    //action to display advertisement payment cart to amount editing
    public function actionPaymentcart()
    {
        try{
           
            $session = Yii::$app->session;
            if($session->get('payment_ad_id') == '' && $session->get('payment_product_id') == '')
            {
                return $this->goHome();
            }
            $userId = Yii::$app->user->id;
            $userbillingDetails = User::get_user_details_by_id($userId);

            //if payment cart is for advt.
            if($session->get('payment_ad_id') != '')
            {
                $transaction_data['payment_type'] = 2; //1= Products,2=Advt.
                $transaction_data['payment_for'] = $session->get('payment_ad_id');
                $redirectUrl = Yii::$app->params['SITE_URL'].'facebookadpaymentsuccess';
                $cancelUrl = Yii::$app->params['SITE_URL'].'facebookadpaymentcancel';

                $payment_type = "P"; //P-payment R-refund
                $payment_module = "A"; //A-advertisement
                $package_type = $session->get('advt_package');//Selected package radio box value
                $advt_primary_key = $session->get('payment_ad_id');//recently inserted ad id
                $amount_actual = $session->get('amount_actual');
                $session->set('payment_ad_id','');

                $transaction_order_id = Generalsettings::create_transaction_order_id($payment_type,$payment_module,$package_type,$advt_primary_key);
            }
            //if payment cart is for product add
            if($session->get('payment_product_id') != '')
            {
                $transaction_data['payment_type'] = 1; //1= Products,2=Advt.
                $transaction_data['payment_for'] = $session->get('payment_product_id');
                $productdetails = $session->get('productdetails');
                $productdata = Products::find()->where(['product_id' => $session->get('payment_product_id')])->one(); 
                $redirectUrl = Yii::$app->params['SITE_URL'].'productpaymentsuccess';
                $cancelUrl = Yii::$app->params['SITE_URL'].'productpaymentcancel';
                
                //generator transaction order id
                $payment_type = "P"; //P-payment R-refund
                if($productdetails['product_type'] == 0)
                    $payment_module = "S"; //S-Supply
                else if($productdetails['product_type'] == 1)
                    $payment_module = "X"; //X-Sale
                else if($productdetails['product_type'] == 2)
                    $payment_module = "B"; //B-Both

                $package_type = $productdetails['package_type'];//Selected package type

                $primary_key = $session->get('payment_product_id');

                $amount_actual = $productdetails['package_amount'];

                $session->set('payment_product_id','');

                $transaction_order_id = Generalsettings::create_transaction_order_id($payment_type,$payment_module,$package_type,$primary_key);
            }

            $tracking_id = time();



            //$amount_actual = Generalsettings::get_logical_amount($amount_actual);

            $transaction_data['before_order_id'] = $transaction_order_id;
            $transaction_data['amount_actual'] = $amount_actual;
            $transaction_data['amount_paid'] = 0;
            $transaction_data['order_status'] = 'Initiated';
            $transaction_data['payment_status'] = 'Not Paid';
            $transaction_data['tracking_id'] = $tracking_id;
            $transaction_data['billing_name'] = $userbillingDetails['user_name'];
            $transaction_data['billing_phone'] = $userbillingDetails['phone_number'];
            $transaction_data['billing_email'] = $userbillingDetails['email'];
            $transaction_data['billing_comments'] = '';
            $transaction_data['billing_time'] = date('Y-m-d H:i:s');
            $transaction_data['user_id'] = Yii::$app->user->getId();

            $newtransaction = Payments::insert_new_transaction($transaction_data);
            if($newtransaction)
            {
                $params = [
                    'tid' => $tracking_id,
                    'order_id' => $transaction_order_id,
                    'amount' => $amount_actual,
                    'currency' => 'INR',
                    'redirect_url' => $redirectUrl,
                    'cancel_url' => $cancelUrl,
                    'language' => 'EN',
                    'billing_name' => $userbillingDetails['user_name'],
                    'billing_tel' => $userbillingDetails['phone_number'],
                    'billing_email' => $userbillingDetails['email'],
                    'delivery_name' => $userbillingDetails['user_name'],
                    'delivery_tel' => $userbillingDetails['phone_number'],
                ];
                echo $this->render('//paymentcheckout', array('params' => $params));
                //\app\components\Ccavenue::form($params, 'auto', Yii::$app->params['PAYMENT_TYPE'], 'websites');
            }
            
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
            return $this->goHome();
        }
        
    }
    //action to redirect to ccavenue page
    public function actionPaymentcheckout()
    {
        if(empty($_REQUEST) || @$_REQUEST['amount']<1000)
        {
            return $this->redirect(['/']);
        }
        $params = $_REQUEST;
        $params['merchant_id'] = Yii::$app->params['ccavenue_merchant_id'];
        \app\components\Ccavenue::form($params, 'auto', Yii::$app->params['PAYMENT_TYPE'], 'websites');
    }

}
