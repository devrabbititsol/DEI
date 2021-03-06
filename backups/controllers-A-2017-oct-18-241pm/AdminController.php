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
use app\models\Productimages;
use app\models\Zones;
use app\models\States;
use app\models\Districts;
use app\models\Territories;
use app\models\Comments;
use app\models\Roles;
use app\models\Feedbackform;
use yii\base\ErrorException;
use yii\imagine\Image;


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
        $this->enableCsrfValidation = false; 
        $session = Yii::$app->session;
        
        if($session->has('role'))
        {
            $role_details = $session->get('role');
            if($role_details['role_name'] == 'Public User')
               return $this->redirect(['/'])->send();
        }
        if (Yii::$app->user->isGuest && $action->id != 'login' && $action->id != 'logout' && $action->id != 'forgotpassword' && $action->id != 'verifyotp' && $action->id != 'updatepassword') {
            //echo $action->controller->id;exit;
            return $this->redirect(['admin/login'])->send();
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
    
    
    //Action to display Dashboard
    public function actionIndex()
    {
        $productscount = Products::select_product_count_by_category_id();
        $orderscount = Productorder::get_orders_count();
        //print_r($orderscount);exit;
        $userscount = User::get_users_count();
        //print_r($userscount);exit;
        $employeescount = User::get_employee_count();
        $adscount = Ads::get_ads_count();
        $products = Products::get_products(10);
        $amounts = Payments::get_total_amount();
        echo $this->render('//admin/index', array('productscount' => $productscount,
                                                    'orderscount' => $orderscount,
                                                    'userscount'=> $userscount,
                                                    'adscount' => $adscount,
                                                    'products' => $products,
                                                    'employeescount' => $employeescount,
                                                    'amounts' => $amounts));
    }
    
   /************ AUTH ACTIONS START ***************/
   public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['admin/index'])->send();
        }
        $this->layout = false;
        if(!empty($_POST))
        {
            $userstatus = LoginForm::admin_login($_POST);
            //print_r($userstatus); exit;
            if($userstatus['login'] == 'YES')
            {
                Yii::$app->session->setFlash('success', $userstatus['message']);
                return $this->redirect(['admin/login'])->send();
            }
            else if($userstatus['login'] == 'NO')
            {
                if($userstatus['status'] == '1')
                    Yii::$app->session->setFlash('warning', $userstatus['message']);
                else if($userstatus['status'] == '3')
                    Yii::$app->session->setFlash('error', $userstatus['message']);
                else 
                    Yii::$app->session->setFlash('error', $userstatus['message']);
                
                return $this->redirect(['admin/login'])->send();
            }
            
        }
        echo $this->render('//admin/login');
    }
    
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['admin/login'])->send();
    }
    
    
    //action to forgotpassword
    public function actionForgotpassword()
    {
        $this->layout = false;
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['admin/login'])->send();
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
            return $this->render('//admin/forgotpassword');
        }        
        
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
    
    //action to update user password after forgot password otp verify
    public function actionUpdatepassword()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['admin/login'])->send();
        }
        $session = Yii::$app->session;
        $account = $session->get('forgot_user_account');
        //check user updating password by email
        if(filter_var($account, FILTER_VALIDATE_EMAIL))
        {
            $data['email'] = $account;
            $data['password'] = $_POST['password'];
            User::update_user_password_by_email($data);
            $session->remove('forgot_user_account');
            return $this->redirect(['admin/login']);
        }
        //check user updating password by mobile
        else if(preg_match('/^[0-9]{10}+$/', $account))
        {
            $data['phone_number'] = $account;
            $data['password'] = $_POST['password'];
            User::update_user_password_by_phone($data);
            $session->remove('forgot_user_account');
            return $this->redirect(['admin/login']);
        }
    }
    /************ AUTH ACTIONS END ***************/
    
    /************ USER ACTIONS START ***************/
    public function actionMyprofile()
    {
        $userId = Yii::$app->user->id;
        $userDetails = User::get_user_details_by_id($userId);
        echo $this->render('//admin/myprofile',array('userdetails' => $userDetails));
    }
    /************ USER ACTIONS END ***************/
    
    /************ PRODUCT ACTIONS START ***************/
    
    //action to display products list
    public function actionProducts()
    {
        if(!User::checkAccess('product_action')) 
        {
        Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
        return $this->redirect(['admin/index'])->send();
        }
        if(@$_GET['product_type'] == 'sale')
            $product_type = '1';
        else if(@$_GET['product_type'] == 'both')
            $product_type = '2';
        else 
            $product_type = '0';
        
        
        $products = Products::get_products('',$product_type);
        $productcategories = Productcategory::find()->orderBy(['display_order' => SORT_ASC])->all();
        $regions = Regions::find()->all();
        echo $this->render('//admin/products/index', array('products' => $products,
                                                     'productcategories' => $productcategories,
                                                     'regions' => $regions));
    }
    
    //action to view product details by id
    public function actionViewproduct($id)
    {
        if(!User::checkAccess('product_action')) 
        {
        Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
        return $this->redirect(['admin/index'])->send();
        }
        $product_details = Products::get_product_by_id($id);
        $life_tax_details = Productslocations::get_product_life_tax_details($product_details['life_tax_details']);
        $product_images = Productimages::get_product_images($id);
        $owner_details = User::get_user_details_by_id($product_details['user_id']);
        $comments = Comments::get_comments_by_options($id,4); //params will by product id and type
        $zones = Zones::get_employee_zones();
        
        if($product_details['employee_id']) $employee_id = $product_details['employee_id']; else $employee_id=0;
        $employee_details = User::get_employee_details_by_id($employee_id);
        
        echo $this->render('//admin/products/viewproduct', array('product_details' => $product_details, 
                                                        'life_tax_details' => $life_tax_details, 
                                                        'owner_details' => $owner_details,
                                                        'product_images' => $product_images,
                                                        'comments' => $comments,
                                                        'zones' => $zones,
                                                        'employee_details' => $employee_details));
    }
    //action to view product details by id
    public function actionEditproduct($id)
    {
        if(!User::checkAccess('product_edit')) 
        {
        Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
        return $this->redirect(['admin/index'])->send();
        }
        $product_details = Products::get_product_by_id($id);
        $product_images = Productimages::get_product_images($id);
        $owner_details = User::get_user_details_by_id($product_details['user_id']);
        $productcategories = Productcategory::find()->orderBy(['display_order' => SORT_ASC])->all();
        $productsubcategories = Productsubcategory::select_by_category_id($product_details['category_id']);
        $models = Productmodel::select_models_by_sub_category_id($product_details['sub_category_id']);
        $regions = Regions::find()->all();
        $serving_locations = Productslocations::get_product_serving_locations($id);
        $current_location = Productslocations::get_product_current_location($id);
        echo $this->render('//admin/products/editproduct', array('product_details' => $product_details, 
                                                        'product_images' => $product_images,
                                                        'regions' => $regions,
                                                        'productcategories' => $productcategories,
                                                        'productsubcategories' => $productsubcategories,
                                                        'models' => $models,
                                                        'owner_details' => $owner_details,
                                                        'product_images' => $product_images,
                                                        'serving_locations' => $serving_locations,
                                                        'current_location' => $current_location));
    }
    
    //action to update product
    public function actionUpdateproduct()
    {
        if(!User::checkAccess('product_edit')) 
        {
        Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
        return $this->redirect(['admin/index'])->send();
        }
        try{
            $product_update = Products::update_product_details($_POST);
            
            //if product update success
            if($product_update['status'] == 200)
            {
                Yii::$app->session->setFlash('success', $product_update['message']);
                return $this->redirect(['admin/editproduct/'.$_POST['product_id']])->send();
            }
            
            //if product update fails
            else if($product_update['status'] == 400)
            {
                Yii::$app->session->setFlash('error', $product_update['message']);
                return $this->redirect(['admin/editproduct/'.$_POST['product_id']])->send();
            }
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
        }
        
    }
    
    //action to approve product
    public function actionApproveproduct() {
        
        try{
            $product_id = $_POST['product_id'];
            $product_status = Products::update_product_status($product_id,1);//0=pending,1=approve,2=Rejected
            /*$product = Products::findone($product_id);
            $product->product_status = 1; //0=pending,1=approve,2=Rejected
            $product->updated_by = Yii::$app->user->id;
            $product->date_updated = date('Y-m-d H:i:s');
            $product->save();*/
            Yii::$app->session->setFlash('success', 'Product Approved successfully');
            return true;
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
        }
        
    }
    
    //action to put product on hold
    public function actionHoldproduct() {
        
        try{
            $product_id = $_POST['product_id'];
            $product_status = Products::update_product_status($product_id,0);//0=pending,1=approve,2=Rejected
            /*$product = Products::findone($product_id);
            $product->product_status = 0;
            $product->updated_by = Yii::$app->user->id;
            $product->date_updated = date('Y-m-d H:i:s');
            $product->save();*/
            Yii::$app->session->setFlash('success', 'Product Hold successfully');
            return true;
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
        }
    }
    
    //action to reject a product
    public function actionRejectproduct() {
        
        try{
            $product_id = $_POST['product_id'];
            $product_status = Products::update_product_status($product_id,2);//0=pending,1=approve,2=Rejected
            /*$product = Products::findone($product_id);
            $product->product_status = 2;//0=pending,1=approve,2=Rejected
            $product->updated_by = Yii::$app->user->id;
            $product->date_updated = date('Y-m-d H:i:s');
            $product->save();*/
            Yii::$app->session->setFlash('success', 'Product Rejected successfully');
            return true;
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
        }
    }
    
    //get employees by district
    public function actionGetemployeebydistrict()
    {
        $district_id= $_REQUEST['district_id'];
        $employees = User::get_employee_by_district_id($district_id);
        
        $out='<option value="" selected>SELECT EMPLOYEE *</option>';
        foreach($employees as $employee)
        {
            $out.='<option value="'.$employee['user_id'].'">'.strtoupper($employee['user_name']).'</option>';
        }
        return json_encode(array("employees"=>$out));
    }
    
    //assign product to employee
    public function actionAssignproduct()
    {
        $productassign = Products::assign_product($_REQUEST);
        if($productassign)
        {
            Yii::$app->session->setFlash('success', 'Product assigned successfully.');
            return true;
        }
        else
        {
            Yii::$app->session->setFlash('error', 'Error while product assigning.');
            return false;
        }
    }
    
    
    /************ PRODUCT OPERATIONS END ***************/
        
    /************ IMAGE EDIT START ***************/
    //action to delete proudct image
    public function actionDeleteproductimage()
    {
        if(!empty($_POST))
        {
            $product_image_id = $_POST['product_image_id'];
            $deleteimage = Productimages::delete_product_image($product_image_id);
            if($deleteimage)
            {
                Yii::$app->session->setFlash('success', 'Image Deleted Successfully');
                return 'SUCCESS';
            }
            else
            {
                Yii::$app->session->setFlash('error', 'Image Not Deleted, Please try again.');
                return 'FAILED';
            }
        }
    }
    
    //action to download product image
    public function actionDownloadproductimage()
    {
        if(isset($_GET['image_url']))
        {
            $image_url = str_replace(Yii::$app->params['SITE_URL'],"",$_GET['image_url']);
            if( file_exists( $image_url ) ){
                return Yii::$app->response->sendFile($image_url);
            }
            else
            {
                return 'FAILED';
            }
        }
    }
    
    // action to Image Crop.
    public function actionCrop() {
        //print_r($_POST);exit;
        //return true;
        $imagePath = 'temp/' . time() . "_" . $_POST['image'];

        Image::crop($_POST['editurl'], $_POST['w'], $_POST['h'], array($_POST['x'], $_POST['y']))
                ->save(Yii::getAlias($imagePath), ['quality' => 90]);
        
        $newimage = Yii::$app->params['SITE_URL']. $imagePath;
    //    unlink($_POST['imageurl']);

        return $newimage;
    }

    // Image Delete.
/*
    public function actionCropdelete() {
        unlink(str_replace(Yii::$app->params['SITE_URL'], "", $_POST['editurl']));
    }
    public function actionSizedelete() {
        unlink(str_replace(Yii::$app->params['SITE_URL'], "", $_POST['editurl']));
    }
    public function actionWatermarkdelete() {
        unlink(str_replace(Yii::$app->params['SITE_URL'], "", $_POST['editurl']));
    }
	*/
    //action to undo image changes
    public function actionUndoimage() {
        $preLinks = explode(",", $_POST['editorder']);
        if (count($preLinks) > 0) {
            $val = end($preLinks);
            unlink(str_replace(Yii::$app->params['SITE_URL'], "", $val));
            array_pop($preLinks);

            if (count($preLinks) > 0) {
                return json_encode(array("ordervalue" => implode(",", $preLinks), "editurl" => end($preLinks)));
            } else {
                return json_encode(array("ordervalue" => "", "editurl" => ""));
            }
        } else {
            return json_encode(array("ordervalue" => "0", "editurl" => "0"));
        }
    }
    //action to delete edited images
    public function actionTempdelete() {
        $preLinks = explode(",", $_POST['editorder']);
        if (count($preLinks) > 0) {

            foreach ($preLinks as $key => $value) {

                unlink(str_replace(Yii::$app->params['SITE_URL'], "", $value));
            }
        } else {
            return 0;
        }
    }

    //action to Image Resize.

    public function actionResize() {
        $imagePath = 'temp/' . time() . "_" . $_POST['image'];

        Image::resize($_POST['editurl'], $_POST['width'], $_POST['height'])
                ->save(Yii::getAlias($imagePath), ['quality' => 90]);

        $newimage = Yii::$app->params['SITE_URL'] . $imagePath;

        return $newimage;
    }

    //action to Image Watermark.

    public function actionWatermark() {


        $imagePath = 'temp/' . time() . "_" . $_POST['image'];

        if ($_POST['position'] == "topright") {

            $point = explode(", ", str_replace(")", "", str_replace("(", "", Image::pointRightTop($_POST['editurl'], $_FILES[$_POST['name']]['tmp_name']))));
        } elseif ($_POST['position'] == "bottomright") {

            $point = explode(", ", str_replace(")", "", str_replace("(", "", Image::pointBottomRight($_POST['editurl'], $_FILES[$_POST['name']]['tmp_name']))));
        } elseif ($_POST['position'] == "bottomleft") {

            $point = explode(", ", str_replace(")", "", str_replace("(", "", Image::pointBottomLeft($_POST['editurl'], $_FILES[$_POST['name']]['tmp_name']))));
        } elseif ($_POST['position'] == "center") {

            $point1 = explode(", ", str_replace(")", "", str_replace("(", "", Image::pointCenter($_POST['editurl']))));

            $point2 = explode(", ", str_replace(")", "", str_replace("(", "", Image::pointCenter($_FILES[$_POST['name']]['tmp_name']))));

            //	print_r ($point);print_r ($point2);exit;
            $point[0] = $point1[0] - $point2[0];
            $point[1] = $point1[1] - $point2[1];
        } else {

            $point[0] = 0;
            $point[1] = 0;
        }

        Image::watermark($_POST['editurl'], $_FILES[$_POST['name']]['tmp_name'], array($point[0], $point[1]))
                ->save(Yii::getAlias($imagePath), ['quality' => 90]);

        $newimage = Yii::$app->params['SITE_URL'] . $imagePath;

        return $newimage;
    }

    //action to save edited image
    public function actionSavealteredimage() {
        try {
            //get image path to replace
            $dest_image = str_replace(Yii::$app->params['SITE_URL'], "", $_POST['imageurl']);

            //get new edited image
            $new_image = str_replace(Yii::$app->params['SITE_URL'], "", $_POST['editurl']);

            if ($new_image != $dest_image) {
                //replace old image with new image and delete new temp image
                copy($new_image, $dest_image);
                unlink($new_image);
            }
            Yii::$app->session->setFlash('success', 'Product Image Saved successfully');
            return true;
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
        }
    }

    /************ IMAGE EDIT CLOSE ***************/
    
    /************ SETUP ACTIONS START ***************/
    
    //action to display zones list
    public function actionZones()
    {
        if(!User::checkAccess('setup_action')) 
        {
        Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
        return $this->redirect(['admin/index'])->send();
        }
       $zones = Zones::get_all_zones();
        echo $this->render('//admin/setup/zones/index', array('zones' => $zones));
    }
    
    //action to create new zone
    public function actionCreatezone()
    {
        if(!User::checkAccess('setup_action')) 
        {
        Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
        return $this->redirect(['admin/index'])->send();
        }
        echo $this->render('//admin/setup/zones/create');
    }
    
    //action to save new zone
    public function actionSavezone()
    {
        if(!User::checkAccess('setup_action')) 
        {
        Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
        return $this->redirect(['admin/index'])->send();
        }
        $newzone = Zones::insert_new_zone($_POST);
        //if zone created successfully
        if($newzone['status'] == 200)
        {
            Yii::$app->session->setFlash('success', $newzone['message']);
            return $this->redirect(['admin/createzone'])->send();
        }

        //if zone creation fails
        else if($newzone['status'] == 400)
        {
            Yii::$app->session->setFlash('error', $newzone['message']);
            return $this->redirect(['admin/createzone'])->send();
        }
    }
    
    //action to edit zone
    public function actionEditzone($id)
    {
        if(!User::checkAccess('setup_action')) 
        {
        Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
        return $this->redirect(['admin/index'])->send();
        }
        try{
            $zone_details = Zones::get_zone_by_id($id);
            echo $this->render('//admin/setup/zones/edit', array('zone_details' => $zone_details));
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
            Yii::$app->session->setFlash('error', 'Something went wrong!');
            return $this->redirect(['admin/zones'])->send();
        }
        
    }
    
    //action to update zone
    public function actionUpdatezone()
    {
        if(!User::checkAccess('setup_action')) 
        {
        Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
        return $this->redirect(['admin/index'])->send();
        }
        try{
            $udpatezone = Zones::update_zone($_POST);
            //if zone updated successfully
            if($udpatezone['status'] == 200)
            {
                Yii::$app->session->setFlash('success', $udpatezone['message']);
                return $this->redirect(['admin/editzone/'.$_POST['zone_id']])->send();
            }

            //if zone creation fails
            else if($udpatezone['status'] == 400)
            {
                Yii::$app->session->setFlash('error', $udpatezone['message']);
                return $this->redirect(['admin/editzone/'.$_POST['zone_id']])->send();
            }
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
            Yii::$app->session->setFlash('error', 'Something went wrong!');
            return $this->redirect(['admin/editzone/'.$_POST['zone_id']])->send();
        }
        
        
    }
    
    //action to list of states
    public function actionStates()
    {
        if(!User::checkAccess('setup_action')) 
        {
        Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
        return $this->redirect(['admin/index'])->send();
        }
       $states = States::get_all_states();
        echo $this->render('//admin/setup/states/index', array('states' => $states));
    }
    
    //action to crate state
    public function actionCreatestate()
    {
        if(!User::checkAccess('setup_action')) 
        {
        Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
        return $this->redirect(['admin/index'])->send();
        }
        $zones = Zones::get_all_zones();
        echo $this->render('//admin/setup/states/create', array('zones' => $zones));
    }
    
    //action to save new state
    public function actionSavestate()
    {
        if(!User::checkAccess('setup_action')) 
        {
        Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
        return $this->redirect(['admin/index'])->send();
        }
        $newstate = States::insert_new_state($_POST);
        //if state created successfully
        if($newstate['status'] == 200)
        {
            Yii::$app->session->setFlash('success', $newstate['message']);
            return $this->redirect(['admin/createstate'])->send();
        }

        //if state creation fails
        else if($newstate['status'] == 400)
        {
            Yii::$app->session->setFlash('error', $newstate['message']);
            return $this->redirect(['admin/createstate'])->send();
        }
    }
    
    //action to edit state
    public function actionEditstate($id)
    {
        if(!User::checkAccess('setup_action')) 
        {
        Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
        return $this->redirect(['admin/index'])->send();
        }
        try{
            $state_details = States::get_state_by_id($id);
            $zones = Zones::get_all_zones();
            echo $this->render('//admin/setup/states/edit', array('state_details' => $state_details,'zones' => $zones));
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
            Yii::$app->session->setFlash('error', 'Something went wrong!');
            return $this->redirect(['admin/states'])->send();
        }
        
    }
    
    //action to update state
    public function actionUpdatestate()
    {
        if(!User::checkAccess('setup_action')) 
        {
        Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
        return $this->redirect(['admin/index'])->send();
        }
        try{
            $udpatestate = States::update_state($_POST);
            //if state updated successfully
            if($udpatestate['status'] == 200)
            {
                Yii::$app->session->setFlash('success', $udpatestate['message']);
                return $this->redirect(['admin/editstate/'.$_POST['state_id']])->send();
            }

            //if state updating fails
            else if($udpatestate['status'] == 400)
            {
                Yii::$app->session->setFlash('error', $udpatestate['message']);
                return $this->redirect(['admin/editstate/'.$_POST['state_id']])->send();
            }
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
            Yii::$app->session->setFlash('error', 'Something went wrong!');
            return $this->redirect(['admin/editstate/'.$_POST['state_id']])->send();
        }
        
        
    }
    
    //action to list of districts
    public function actionDistricts()
    {
        if(!User::checkAccess('setup_action')) 
        {
        Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
        return $this->redirect(['admin/index'])->send();
        }
        $districts = Districts::get_all_districts();
        echo $this->render('//admin/setup/districts/index', array('districts' => $districts));
    }
    
    //action to crate district
    public function actionCreatedistrict()
    {
        if(!User::checkAccess('setup_action')) 
        {
        Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
        return $this->redirect(['admin/index'])->send();
        }
        $zones = Zones::get_all_zones();
        $states = States::get_all_states();
        echo $this->render('//admin/setup/districts/create', array('zones' => $zones,'states' => $states));
    }
    
    //action to save new district
    public function actionSavedistrict()
    {
        if(!User::checkAccess('setup_action')) 
        {
        Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
        return $this->redirect(['admin/index'])->send();
        }
        $newstate = Districts::insert_new_district($_POST);
        //if district created successfully
        if($newstate['status'] == 200)
        {
            Yii::$app->session->setFlash('success', $newstate['message']);
            return $this->redirect(['admin/createdistrict'])->send();
        }

        //if district creation fails
        else if($newstate['status'] == 400)
        {
            Yii::$app->session->setFlash('error', $newstate['message']);
            return $this->redirect(['admin/createdistrict'])->send();
        }
    }
    
    //action to edit district
    public function actionEditdistrict($id)
    {
        if(!User::checkAccess('setup_action')) 
        {
        Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
        return $this->redirect(['admin/index'])->send();
        }
        try{
            $district_details = Districts::get_district_by_id($id);
            $zones = Zones::get_all_zones();
            $states = States::get_states_by_zone_id($district_details['zone_id']);
            echo $this->render('//admin/setup/districts/edit', array('district_details' => $district_details,'zones' => $zones,'states' => $states));
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
            Yii::$app->session->setFlash('error', 'Something went wrong!');
            return $this->redirect(['admin/districts'])->send();
        }
        
    }
    
    //action to update district
    public function actionUpdatedistrict()
    {
        if(!User::checkAccess('setup_action')) 
        {
        Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
        return $this->redirect(['admin/index'])->send();
        }
        try{
            $udpatestate = Districts::update_district($_POST);
            //if district updated successfully
            if($udpatestate['status'] == 200)
            {
                Yii::$app->session->setFlash('success', $udpatestate['message']);
                return $this->redirect(['admin/editdistrict/'.$_POST['district_id']])->send();
            }

            //if district updating fails
            else if($udpatestate['status'] == 400)
            {
                Yii::$app->session->setFlash('error', $udpatestate['message']);
                return $this->redirect(['admin/editdistrict/'.$_POST['district_id']])->send();
            }
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
            Yii::$app->session->setFlash('error', 'Something went wrong!');
            return $this->redirect(['admin/editdistrict/'.$_POST['district_id']])->send();
        }
        
        
    }
    
    //get states by zone
    public function actionGetstatesbyzones()
    {
        $zone_id = $_REQUEST['zone_id'];
        $user_type = @$_REQUEST['user_type'];
        $states = States::get_states_by_zone_id($zone_id,$user_type);
        
        if(@$_REQUEST['type'] == 'employee')
        {
            $out='';
            foreach($states as $state)
            {
                $out.='<option value="'.$state['state_id'].'">'.strtoupper($state['state_name']).'</option>';
            }
            return json_encode(array("states"=>$out));
        }
        else
        {
            $out='<option value="" selected>SELECT STATE *</option>';
            foreach($states as $state)
            {
                $out.='<option value="'.$state['state_id'].'">'.strtoupper($state['state_name']).'</option>';
            }
            return json_encode(array("states"=>$out));
        }
    }
    
    //action to list of territories
    public function actionTerritories()
    {
        $session = Yii::$app->session;
        $role_details = $session->get('role');
        if(!User::checkAccess('setup_action') && $role_details['role_id'] != 6) 
        {
        Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
        return $this->redirect(['admin/index'])->send();
        }
        $territories = Territories::get_all_territories();
        echo $this->render('//admin/setup/territories/index', array('territories' => $territories));
    }
    
    //action to crate territory
    public function actionCreateterritory()
    {
        $session = Yii::$app->session;
        $role_details = $session->get('role');
        if(!User::checkAccess('setup_action') && $role_details['role_id'] != 6) 
        {
        Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
        return $this->redirect(['admin/index'])->send();
        }
        
        if($role_details['role_id'] == 2 || $role_details['role_id'] == 3)//super admin or admin
            $zones = Zones::get_employee_zones();
        else
            $zones = Zones::get_employee_zones($role_details['role_id']);
        
        echo $this->render('//admin/setup/territories/create', array('zones' => $zones));
    }
    
    //action to save new district
    public function actionSaveterritory()
    {
        $session = Yii::$app->session;
        $role_details = $session->get('role');
        if(!User::checkAccess('setup_action') && $role_details['role_id'] != 6) 
        {
        Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
        return $this->redirect(['admin/index'])->send();
        }
        $newstate = Territories::insert_new_territory($_POST);
        //if territory created successfully
        if($newstate['status'] == 200)
        {
            Yii::$app->session->setFlash('success', $newstate['message']);
            return $this->redirect(['admin/createterritory'])->send();
        }

        //if territory creation fails
        else if($newstate['status'] == 400)
        {
            Yii::$app->session->setFlash('error', $newstate['message']);
            return $this->redirect(['admin/createterritory'])->send();
        }
    }
    
    //action to edit district
    public function actionEditterritory($id)
    {
        $session = Yii::$app->session;
        $role_details = $session->get('role');
        if(!User::checkAccess('setup_action') && $role_details['role_id'] != 6) 
        {
        Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
        return $this->redirect(['admin/index'])->send();
        }
        try{
            $territory_details = Territories::get_territory_by_id($id);
            
            if($role_details['role_id'] == 2 || $role_details['role_id'] == 3)//super admin or admin
                $zones = Zones::get_employee_zones();
            else
                $zones = Zones::get_employee_zones($role_details['role_id']);
            
            $states = States::get_states_by_zone_id($territory_details['zone_id'],$role_details['role_id']);
            $districts = Districts::get_districts_by_state_id($territory_details['state_id'],$role_details['role_id']);
            echo $this->render('//admin/setup/territories/edit', array('territory_details' => $territory_details,'zones' => $zones,'states' => $states,'districts' => $districts));
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
            Yii::$app->session->setFlash('error', 'Something went wrong!');
            return $this->redirect(['admin/territories'])->send();
        }
        
    }
    
    //action to update district
    public function actionUpdateterritory() 
    {
        $session = Yii::$app->session;
        $role_details = $session->get('role');
        if(!User::checkAccess('setup_action') && $role_details['role_id'] != 6) 
        {
        Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
        return $this->redirect(['admin/index'])->send();
        }
        try{
            $udpatestate = Territories::update_territory($_POST);
            //if district updated successfully
            if($udpatestate['status'] == 200)
            {
                Yii::$app->session->setFlash('success', $udpatestate['message']);
                return $this->redirect(['admin/editterritory/'.$_POST['territory_id']])->send();
            }

            //if district updating fails
            else if($udpatestate['status'] == 400)
            {
                Yii::$app->session->setFlash('error', $udpatestate['message']);
                return $this->redirect(['admin/editterritory/'.$_POST['territory_id']])->send();
            }
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
            Yii::$app->session->setFlash('error', 'Something went wrong!');
            return $this->redirect(['admin/editterritory/'.$_POST['territory_id']])->send();
        }
        
        
    }
    
    //get states by zone
    public function actionGetdistrictsbystates()
    {
        $state_id = $_REQUEST['state_id'];
        $user_type = @$_REQUEST['user_type'];
        $districts = Districts::get_districts_by_state_id($state_id,$user_type);
        
        if(@$_REQUEST['type'] == 'employee')
        {
            $out='';
            foreach($districts as $district)
            {
                $out.='<option value="'.$district['district_id'].'">'.strtoupper($district['district_name']).'</option>';
            }
            return json_encode(array("districts"=>$out));
        }
        else
        {
            $out='<option value="" selected>SELECT DISTRICT *</option>';
            foreach($districts as $district)
            {
                $out.='<option value="'.$district['district_id'].'">'.strtoupper($district['district_name']).'</option>';
            }
            return json_encode(array("districts"=>$out));
        }
    }
    
    //get states by zone
    public function actionGetterritoriesbydistricts()
    {
        $district_id = $_REQUEST['district_id'];
        $user_type = @$_REQUEST['user_type'];
        $territories = Territories::get_territories_by_district_id($district_id,$user_type);
        if(@$_REQUEST['type'] == 'employee')
        {
            $out='';
            foreach($territories as $territory)
            {
                $out.='<option value="'.$territory['territory_id'].'">'.strtoupper($territory['territory_name']).'</option>';
            }
            return json_encode(array("territories"=>$out));
        }
        else
        {
            $out='<option value="" selected>SELECT TERRITORY *</option>';
            foreach($territories as $territory)
            {
                $out.='<option value="'.$territory['territory_id'].'">'.strtoupper($territory['territory_name']).'</option>';
            }
            return json_encode(array("territories"=>$out));
        }
    }
    
    
    /************ SETUP ACTIONS CLOSE ***************/
    
    /************ COMMENTING CODE START *************/
    
    public function actionAddcomment()
    {
        try{
            $newcomment = Comments::insert_new_comment($_POST);
            //if district created successfully
            if($newcomment['status'] == 200)
            {
                Yii::$app->session->setFlash('success', $newcomment['message']);
                return $this->redirect(Yii::$app->request->referrer);
            }

            //if district creation fails
            else if($newcomment['status'] == 400)
            {
                Yii::$app->session->setFlash('error', $newcomment['message']);
                return $this->redirect(Yii::$app->request->referrer);
            }
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
            Yii::$app->session->setFlash('error', 'Something went wrong while adding your comment!');
            return $this->redirect(Yii::$app->request->referrer);
        }
    }
    
    /************ COMMENTING CODE END *************/
    
    /************ USER ACTIONS START *************/
    //List of users
    public function actionUsers()
    {
        if(!User::checkAccess('user_action')) 
        {
        Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
        return $this->redirect(['admin/index'])->send();
        }
        $users = User::get_public_users();
        //print_r($users);exit;
        echo $this->render('//admin/users/index', array('users' => $users));
    }
        
    # View user details
    public function actionViewuser($id)
    {
        if(!User::checkAccess('user_action')) 
        {
        Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
        return $this->redirect(['admin/index'])->send();
        }
        $user = User::get_user_details_by_id($id);
        
        $products = Products::get_products_by_userid($id);  
        
        $orders = Productorder::get_orders_by_userid($id);
        
        $payments = Payments::get_payments_by_userid($id);
        
        echo $this->render('//admin/users/viewuser', array('user' => $user,'products' => $products,'orders' => $orders,'payments' => $payments));
    }
    
    # Edit user details
    public function actionEdituser($id)
    {
        if(!User::checkAccess('user_action')) 
        {
        Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
        return $this->redirect(['admin/index'])->send();
        }
        $user = User::get_user_details_by_id($id);
        
        echo $this->render('//admin/users/edituser', array('userdetails' => $user));
    }
    
    public function actionProfileupdate()
    {
        $userupdate = User::update_userdetails_by_admin($_POST);
        return $userupdate;
    }
    
    # Reactive user
    public function actionUndouser($id)
    {
        $user = User::active_userstatus($id);
        
        return $this->redirect(['admin/users'])->send();
    }
    
    # Delete user
    public function actionDeleteuser($id)
    {
        $user = User::inactive_userstatus($id);
        
        return $this->redirect(['admin/users'])->send();
    }
    
    /************ USER ACTIONS END *************/
    
    /************ EMPLOYEE ACTIONS START *************/
    
    //All employees list
    public function actionEmployees()
    {
        if(!User::checkAccess('employee_action')) 
        {
        Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
        return $this->redirect(['admin/index'])->send();
        }
        $employees = User::get_all_employees();
        //print_r($employees);exit;
        echo $this->render('//admin/employees/index', array('employees' => $employees));
    }
    
    public function actionCreateemployee()
    {
        if(!User::checkAccess('employee_action')) 
        {
        Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
        return $this->redirect(['admin/index'])->send();
        }
        //$zones = Zones::get_employee_zones();
        $roles = Roles::get_all_roles();
        echo $this->render('//admin/employees/createemployee', array('roles' => $roles));
    }
    
    public function actionSaveemployee()
    {
        $newemployee = User::insert_new_employee($_POST);
        if($newemployee['status'] == 200)
        {
            Yii::$app->session->setFlash('success', $newemployee['message']);
            return $this->redirect(['admin/employees'])->send();
        }

        //if employee already exists with given details
        else if($newemployee['status'] == 300)
        {
            Yii::$app->session->setFlash('warning', $newemployee['message']);
            return $this->redirect(['admin/employees'])->send();
        }
        
        else if($newemployee['status'] == 400)
        {
            Yii::$app->session->setFlash('error', $newemployee['message']);
            return $this->redirect(['admin/employees'])->send();
        }
        
        
    }
    
    # View user details
    public function actionViewemployee($id)
    {
        if(!User::checkAccess('employee_action')) 
        {
        Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
        return $this->redirect(['admin/index'])->send();
        }
        $employee = User::get_employee_details_by_id($id);      
        //print_r($employee);exit;
        echo $this->render('//admin/employees/viewemployee', array('employee' => $employee));
    }
    
    # Edit Employee details
    public function actionEditemployee($id)
    {
        if(!User::checkAccess('employee_action')) 
        {
        Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
        return $this->redirect(['admin/index'])->send();
        }
        $employee = User::get_employee_details_by_id($id);
        $roles = Roles::get_all_roles();
        
        $session = Yii::$app->session;
        $role_details = $session->get('role');
        
        if($role_details['role_id'] == 2 || $role_details['role_id'] == 3)//super admin or admin
            $zones = Zones::get_employee_zones();
        else
            $zones = Zones::get_employee_zones($employee['user_type']);
        
        $states = States::get_states_by_zone_id($employee['zone_id']);
        
        if($role_details['role_id'] == 2 || $role_details['role_id'] == 3)//super admin
        {
            $districts = Districts::get_districts_by_state_id($employee['state_id']);
            $territories = Territories::get_territories_by_district_id($employee['district_id']);
        }
        else
        {
            $districts = Districts::get_districts_by_state_id($employee['state_id'],$employee['user_type']);
            $territories = Territories::get_territories_by_district_id($employee['district_id'],$employee['user_type']);
        }
        
        
        
        echo $this->render('//admin/employees/editemployee', array('employeedetails' => $employee,
                                                                   'zones' => $zones,
                                                                   'states' => $states,
                                                                   'districts' => $districts,
                                                                   'territories' => $territories,
                                                                   'roles' => $roles));
    }
    
    //update employee details
    public function actionUpdateemployee()
    {
        $newemployee = User::update_employee_details($_POST);
        if($newemployee['status'] == 200)
        {
            Yii::$app->session->setFlash('success', $newemployee['message']);
            return $this->redirect(['admin/employees'])->send();
        }

        //if employee already exists with given details
        else if($newemployee['status'] == 300)
        {
            Yii::$app->session->setFlash('warning', $newemployee['message']);
            return $this->redirect(['admin/employees'])->send();
        }
        
        else if($newemployee['status'] == 400)
        {
            Yii::$app->session->setFlash('error', $newemployee['message']);
            return $this->redirect(['admin/employees'])->send();
        }
        
        
    }
    
    //get zones by employee type
    
    public function actionGetzonesbyusertype()
    {
        $zones = Zones::get_employee_zones($_REQUEST['user_type']);
        $out = '';
        foreach($zones as $zone)
        {
            $out.='<option value="'.$zone['zone_id'].'">'.strtoupper($zone['zone_name']).'</option>';
        }
        return json_encode(array("zones"=>$out));
    }
    
    /************ EMPLOYEE ACTIONS END *************/
    
    /************ ORDER ACTIONS START ***************/
    
    //action to display orders list
    public function actionOrders()
    {
        if(!User::checkAccess('order_action')) 
        {
        Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
        return $this->redirect(['admin/index'])->send();
        }
        if(@$_GET['order_type'] == 'hire')
            $order_type = '0';
        else if(@$_GET['order_type'] == 'buy')
            $order_type = '1';
        else 
            $order_type = '0';
        
        
        $orders = Productorder::get_orders('',$order_type);
        $ordercategories = Productcategory::find()->orderBy(['display_order' => SORT_ASC])->all();
        $regions = Regions::find()->all();
        echo $this->render('//admin/orders/index', array('orders' => $orders,
                                                     'ordercategories' => $ordercategories,
                                                     'regions' => $regions));
    }
    
    //action to view order details by id
    public function actionVieworder($id)
    {
        if(!User::checkAccess('order_action')) 
        {
        Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
        return $this->redirect(['admin/index'])->send();
        }
        $order_details = Productorder::get_order_by_id($id);
        $product_details = Products::get_product_by_id($order_details['product_id']);
        $life_tax_details = Productslocations::get_product_life_tax_details($product_details['life_tax_details']);
        $product_images = Productimages::get_product_images($order_details['product_id']);
        $product_owner_details = User::get_user_details_by_id($product_details['user_id']);
        $order_owner_details = User::get_user_details_by_id($order_details['user_id']);
        $comments = Comments::get_comments_by_options($id,2); //params will by order id and type
        $zones = Zones::get_employee_zones();
        
        if($order_details['employee_id']) $employee_id = $order_details['employee_id']; else $employee_id=0;
        $employee_details = User::get_employee_details_by_id($employee_id);
        
        echo $this->render('//admin/orders/vieworder', array('order_details' => $order_details,
                                                                'product_details' => $product_details,
                                                                'life_tax_details' => $life_tax_details,
                                                                'product_images' => $product_images,
                                                                'product_owner_details' => $product_owner_details,
                                                                'order_owner_details' => $order_owner_details,
                                                                'comments' => $comments,
                                                                'zones' => $zones,
                                                                'employee_details' => $employee_details));
    }
    
    //action to approve order
    public function actionApproveorder() {
        
        try{
            $order_id = $_POST['order_id'];
            $order_status = Productorder::update_order_status($order_id,1);//0=pending,1=approve,2=Rejected
            /*$order = Productorder::findone($order_id);
            $order->order_status = 1;//0=pending,1=approve,2=Rejected
            $order->updated_by = Yii::$app->user->id;
            $order->date_updated = date('Y-m-d H:i:s');
            $order->save();*/
            Yii::$app->session->setFlash('success', 'Product Approved successfully');
            return true;
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
        }
        
    }
    
    //action to put order on hold
    public function actionHoldorder() {
        
        try{
            $order_id = $_POST['order_id'];
            $order_status = Productorder::update_order_status($order_id,0);//0=pending,1=approve,2=Rejected
            /*$order = Productorder::findone($order_id);
            $order->order_status = 0;//0=pending,1=approve,2=Rejected
            $order->updated_by = Yii::$app->user->id;
            $order->date_updated = date('Y-m-d H:i:s');
            $order->save();*/
            Yii::$app->session->setFlash('success', 'Product Hold successfully');
            return true;
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
        }
    }
    
    //action to reject a order
    public function actionRejectorder() {
        
        try{
            $order_id = $_POST['order_id'];
            $order_status = Productorder::update_order_status($order_id,2);//0=pending,1=approve,2=Rejected
            /*$order = Productorder::findone($order_id);
            $order->order_status = 2;//0=pending,1=approve,2=Rejected
            $order->updated_by = Yii::$app->user->id;
            $order->date_updated = date('Y-m-d H:i:s');
            $order->save();*/
            Yii::$app->session->setFlash('success', 'Order Rejected successfully');
            return true;
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
        }
    }
    
     //assign product to employee
    public function actionAssignorder()
    {
        $orderassign = Productorder::assign_order($_REQUEST);
        if($orderassign)
        {
            Yii::$app->session->setFlash('success', 'Order assigned successfully.');
            return true;
        }
        else
        {
            Yii::$app->session->setFlash('error', 'Error while Order assigning.');
            return false;
        }
    }
    
     /************ ORDER ACTIONS END ***************/
    
    /************ ROLE ACTIONS START ***************/    
    public function actionRole() {
        if (!User::checkAccess('role_action')) {
            Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
            return $this->redirect(['admin/index'])->send();
        }
        $role_details = Roles::select_all_roles();
        $permission_details = Roles::select_all_permissions();
        echo $this->render('//admin/rolematrix', array('permission_details' => $permission_details, 'role_details' => $role_details));
    }

    public function actionRolesubmit() {
        if (!User::checkAccess('role_action')) {
            Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
            return $this->redirect(['admin/index'])->send();
        }
        $permissions = Roles::update_role_permissions($_POST);
        Yii::$app->session->setFlash('success', $permissions);
        return $this->redirect(['admin/role'])->send();
    }
    

    /************ ROLE ACTIONS END ***************/
    
    /************ Advt ACTIONS START ***************/
   
    public function actionAds(){
        if (!User::checkAccess('advertisement_action')) {
            Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
            return $this->redirect(['admin/index'])->send();
        }
       
        $ads = Ads::select_all_ad_details();
               
        echo $this->render('//admin/ads/index', array('ads' => $ads));
    }
   
    public function actionViewad($id){
        if (!User::checkAccess('advertisement_action')) {
            Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
            return $this->redirect(['admin/index'])->send();
        }
       
        $ad = Ads::get_ad_by_id($id);
       
        $ad_images = Ads::get_ad_images_by_id($id);
       
        $user = User::get_user_details_by_id($ad['user_id']);
       
        $comments = Comments::get_comments_by_options($id,5); //params will by ad id and type
        $zones = Zones::get_employee_zones();
        if($ad['employee_id']) $employee_id = $ad['employee_id']; else $employee_id=0;
        $employee_details = User::get_employee_details_by_id($employee_id);
            
        echo $this->render('//admin/ads/viewadvt', array('ad' => $ad,
                                                         'ad_images' => $ad_images,
                                                         "comments" => $comments,
                                                         "user" => $user,
                                                         "employee_details" => $employee_details,
                                                         "zones" => $zones));
    }   
   
    # Edit ad
    public function actionEditad($id)
    {
        if (!User::checkAccess('advertisement_action')) {
            Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
            return $this->redirect(['admin/index'])->send();
        }
        $ad = Ads::get_ad_by_id($id);
       
        $ad_images = Ads::get_ad_images_by_id($id);
       
        echo $this->render('//admin/ads/editadvt', array('ad' => $ad,'ad_images' => $ad_images));
   
    }
   
    # Edit ad
    public function actionUpdatead()
    {
     
        $ad = Ads::update_facebook_post($_POST);
       
        Yii::$app->session->setFlash('success', "Ad details updated successfully");
       
        return $this->redirect(['admin/ads'])->send();
 
    }
   
    # Approve ad
    public function actionApprovead()
    {
        $id = $_POST['ad_id'];
        $ad_status = Ads::update_ad_status($id,1); //0=Hold/Pending,1=Accepted,2=Rejected,3=Deleted
       
        Yii::$app->session->setFlash('success', "Ad approved successfully");
       
        return true;
    }
   
    # Hold ad
    public function actionHoldad()
    {
        $id = $_POST['ad_id'];
        $ad_status = Ads::update_ad_status($id,0); //0=Hold/Pending,1=Accepted,2=Rejected,3=Deleted
       
        Yii::$app->session->setFlash('success', "Ad status changed to hold successfully");
       
        return true;
    }
   
    # Reject ad
    public function actionRejectad()
    {
        $id = $_POST['ad_id'];
        $ad_status = Ads::update_ad_status($id,2); //0=Hold/Pending,1=Accepted,2=Rejected,3=Deleted
       
        Yii::$app->session->setFlash('success', "Ad rejected successfully");
       
        return true;
    }
   
    # Delete ad
    public function actionDeletead()
    {
        $id = $_POST['ad_id'];
        $ad_status = Ads::update_ad_status($id,3); //0=Hold/Pending,1=Accepted,2=Rejected,3=Deleted
       
        Yii::$app->session->setFlash('success', "Ad deleted successfully.");
       
        return true;
    }
    public function actionDeleteadimage()
    {
        if(!empty($_POST))
        {
            $id = $_POST['ad_image_id'];
            $deleteimage =  Ads::update_ad_image_status($id,3);
            if($deleteimage)
            {
                Yii::$app->session->setFlash('success', 'Image Deleted Successfully');
            }
            else
            {
                Yii::$app->session->setFlash('error', 'Image Not Deleted, Please try again.');
            }
        }
    }
    
    //assign Advt. to employee
    public function actionAssignadvertisement()
    {
        $advertisementassign = Ads::assign_advertisement($_REQUEST);
        if($advertisementassign)
        {
            Yii::$app->session->setFlash('success', 'Advertisement assigned successfully.');
            return true;
        }
        else
        {
            Yii::$app->session->setFlash('error', 'Error while Advertisement assigning.');
            return false;
        }
    }
   
    /************ Advt ACTIONS END ***************/
    
    /************ Corporate ACTIONS START ***************/
    
    public function actionCorporate(){
        if (!User::checkAccess('corporate_action')) {
            Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
            return $this->redirect(['admin/index'])->send();
        }
        
        $contact_details = Contactform::select_all_contacts();
                
        $feedback_details = Feedbackform::select_all_feedbacks();
        
        echo $this->render('//admin/corporate/index', array('contact_details' => $contact_details,'feedback_details' => $feedback_details));
    }
    
    public function actionViewcontact($id){
        if (!User::checkAccess('corporate_action')) {
            Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
            return $this->redirect(['admin/index'])->send();
        }
        
        $contact_details = Contactform::get_contact_by_id($id);
        
        $comments = Comments::get_comments_by_options($id,6); //params will by product id and type
                
        echo $this->render('//admin/corporate/viewcontact', array('contact' => $contact_details,'comments' => $comments));
    }
    
    public function actionCorporatestatuscontactactive($id){
        if (!User::checkAccess('corporate_action')) {
            Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
            return $this->redirect(['admin/index'])->send();
        }
        $status=1;
        
        $result=Contactform::update_contact_by_status_id($status,$id);
        
        if ($reuslt = "Status Changed Successfully.")
            Yii::$app->session->setFlash('success', $result);
        else
            Yii::$app->session->setFlash('error', $result);
        
        return $this->redirect(['admin/corporate'])->send();
    }
    
    public function actionCorporatestatuscontactinactive($id){
        if (!User::checkAccess('corporate_action')) {
            Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
            return $this->redirect(['admin/index'])->send();
        }
        $status=0;
        
        $result=Contactform::update_contact_by_status_id($status,$id);
                
        if ($reuslt = "Status Changed Successfully.")
            Yii::$app->session->setFlash('success', $result);
        else
            Yii::$app->session->setFlash('error', $result);
        
        return $this->redirect(['admin/corporate'])->send();
    }
    
    public function actionViewfeedback($id){
        if (!User::checkAccess('corporate_action')) {
            Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
            return $this->redirect(['admin/index'])->send();
        }
        
        $feedback_details = Feedbackform::get_feedback_by_id($id);
        
        $comments = Comments::get_comments_by_options($id,7); //params will by feedback id and type
                
        echo $this->render('//admin/corporate/viewfeedback', array('feedback' => $feedback_details,'comments' => $comments));
    }
    
    public function actionCorporatestatusfeedbackactive($id){
         if (!User::checkAccess('corporate_action')) {
            Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
            return $this->redirect(['admin/index'])->send();
        }
        $status=1;
        
        $result=Feedbackform::update_feedback_by_status_id($status,$id);  
        
        if ($reuslt = "Status Changed Successfully.")
            Yii::$app->session->setFlash('success', $result);
        else
            Yii::$app->session->setFlash('error', $result);
        
        return $this->redirect(['admin/corporate'])->send();
    }
    
    public function actionCorporatestatusfeedbackinactive($id){
         if (!User::checkAccess('corporate_action')) {
            Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
            return $this->redirect(['admin/index'])->send();
        }
        $status=0;
        
        $result=Feedbackform::update_feedback_by_status_id($status,$id);  
        
        if ($reuslt = "Status Changed Successfully.")
            Yii::$app->session->setFlash('success', $result);
        else
            Yii::$app->session->setFlash('error', $result);
        
        return $this->redirect(['admin/corporate'])->send();
    }
    
    /************ Corporate ACTIONS END ***************/
    
    /************ Payments ACTIONS START ***************/
    
    public function actionPayments(){
        if (!User::checkAccess('payment_action')) {
            Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
            return $this->redirect(['admin/index'])->send();
        }
        
        $payment_details = Payments::select_all_payments();
        
        echo $this->render('//admin/payments/index',array('payments' => $payment_details));
    }
    
    public function actionViewpayment($id){
        if (!User::checkAccess('payment_action')) {
            Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
            return $this->redirect(['admin/index'])->send();
        }
        
        $payment_details = Payments::get_payment_by_id($id);
        
        echo $this->render('//admin/payments/viewpayment', array('payment' => $payment_details));
    }
    
    /************ Payments ACTIONS END ***************/
    
    /************ Getquote ACTIONS START ***************/
    public function actionGetquote(){
        if (!User::checkAccess('order_action')) {
            Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
            return $this->redirect(['admin/index'])->send();
        }
        $quotes = Getquote::get_all_quotes();
        echo $this->render('//admin/getquote/index', array('quotes' => $quotes));
    }
    public function actionViewquote($id){
        if (!User::checkAccess('order_action')) {
            Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
            return $this->redirect(['admin/index'])->send();
        }
        $quote_details = Getquote::get_quote_details_by_id($id);
        $zones = Zones::get_employee_zones();
        
        if($quote_details['employee_id']) $employee_id = $quote_details['employee_id']; else $employee_id=0;
        $employee_details = User::get_employee_details_by_id($employee_id);
        
        $comments = Comments::get_comments_by_options($id,8); //params will by quote id and type
        
        echo $this->render('//admin/getquote/viewquote', array('quote_details' => $quote_details,
                                                               'zones' => $zones,
                                                               'employee_details' => $employee_details,
                                                               'comments' => $comments));
    }
    
    //assign product to employee
    public function actionAssignquote()
    {
        $quoteassign = Getquote::assign_quote($_REQUEST);
        if($quoteassign)
        {
            Yii::$app->session->setFlash('success', 'Quote assigned successfully.');
            return true;
        }
        else
        {
            Yii::$app->session->setFlash('error', 'Error while quote assigning.');
            return false;
        }
    }
    
    //action to approve quote
    public function actionApprovequote() {
        
        try{
            $quote_id = $_POST['quote_id'];
            $quote_status = Getquote::update_quote_status($quote_id,1);//0=pending,1=approve,2=Rejected
            /*$quote = Getquote::findone($quote_id);
            $quote->quote_status = 1;//0=pending,1=approve,2=Rejected
            $quote->updated_by = Yii::$app->user->id;
            $quote->date_updated = date('Y-m-d H:i:s');
            $quote->save();*/
            Yii::$app->session->setFlash('success', 'Quote Approved successfully.');
            return true;
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
        }
        
    }
    
    //action to put quote on hold
    public function actionHoldquote() {
        
        try{
            $quote_id = $_POST['quote_id'];
            $quote_status = Getquote::update_quote_status($quote_id,0);//0=pending,1=approve,2=Rejected
            /*$quote = Getquote::findone($quote_id);
            $quote->quote_status = 0;//0=pending,1=approve,2=Rejected
            $quote->updated_by = Yii::$app->user->id;
            $quote->date_updated = date('Y-m-d H:i:s');
            $quote->save();*/
            Yii::$app->session->setFlash('success', 'Quote Hold successfully.');
            return true;
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
        }
    }
    
    //action to reject a quote
    public function actionRejectquote() {
        
        try{
            $quote_id = $_POST['quote_id'];
            $quote_status = Getquote::update_quote_status($quote_id,2);//0=pending,1=approve,2=Rejected
            /*$quote = Getquote::findone($quote_id);
            $quote->quote_status = 2;//0=pending,1=approve,2=Rejected
            $quote->updated_by = Yii::$app->user->id;
            $quote->date_updated = date('Y-m-d H:i:s');
            $quote->save();*/
            Yii::$app->session->setFlash('success', 'Quote Rejected successfully.');
            return true;
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
        }
    }
    
    /************ Getquote ACTIONS END ***************/
    
    /*     * ********** Employee Treeview START************** */

    public function actionTreeview() {
        if (!User::checkAccess('role_action')) {
            Yii::$app->session->setFlash('warning', "Your Don't have permission to access this!");
            return $this->redirect(['admin/index'])->send();
        }
        echo $this->render('//admin/treeview');
    }

    public function actionTestview() {

        echo $this->render('//admin/testview');
    }

    public function actionReadtreeview() {

        # Get Current User Details        
        $userId = Yii::$app->user->id;
        $userDetails = User::get_user_details_by_id($userId);

        $treeView = array();

        # If user is Super Admin
        if ($userDetails['user_type'] == 2) {

            $role = Roles::select_roles_by_id($userDetails['user_type']);

            # Get All Zones
            $zones = Zones::get_all_active_zones();

            # Create an array and assign user_name
            $treeView = array('name' => ucwords($role['role_name']), 'sname' => "(" . ucwords($userDetails['user_name']) . ")", 'children' => "");

            foreach ($zones as $key => $zone) {

                # Get Employee Of the Zone
                $zoneuser = Zones::get_employee_by_zoneid($zone['zone_id']);

                if ($zoneuser['user_name'] != "") {
                    # Create an array and assign zone_name
                    $treeView2 = array('name' => ucwords($zone['zone_name']) . " (" . ucwords($zoneuser['user_name']) . ")", 'children' => "");
                } else {
                    # Create an array and assign zone_name
                    $treeView2 = array('name' => ucwords($zone['zone_name']), 'children' => "");
                }

                # Get All State by zone_id
                $states = States::get_states_by_zone_id($zone['zone_id']);

                foreach ($states as $keys => $state) {

                    # Get Employee Of the State
                    $stateuser = States::get_employee_by_stateid($state['state_id']);

                    if ($stateuser['user_name'] != "") {
                        # Add value to existing array while creating another array for assigning state_name
                        $treeView2['children'][] = array('name' => ucwords($state['state_name']) . " (" . ucwords($stateuser['user_name']) . ")", 'children' => "");
                    } else {
                        # Add value to existing array while creating another array for assigning state_name
                        $treeView2['children'][] = array('name' => ucwords($state['state_name']), 'children' => "");
                    }

                    # Get All Districts by state_id
                    $districts = Districts::get_districts_by_state_id($state['state_id']);
                    foreach ($districts as $keyss => $district) {

                        # Get Employee Of the District
                        $districtuser = Districts::get_employee_by_districtid($district['district_id']);

                        if ($districtuser['user_name'] != "") {
                            # Add value to existing array while creating another array for assigning district_name
                            $treeView2['children'][$keys]['children'][] = array('name' => ucwords($district['district_name']) . " (" . ucwords($districtuser['user_name']) . ")", 'children' => "");
                        } else {
                            # Add value to existing array while creating another array for assigning district_name
                            $treeView2['children'][$keys]['children'][] = array('name' => ucwords($district['district_name']), 'children' => "");
                        }

                        # Get All Territories by district_id
                        $territories = Territories::get_territories_by_district_id($district['district_id']);
                        foreach ($territories as $keysss => $territory) {

                            # Get Employee Of the District
                            $territoryuser = Territories::get_employee_by_territoryid($territory['territory_id']);

                            if ($territoryuser['user_name'] != "") {
                                # Add value to existing array while creating another array for assigning district_name
                                $treeView2['children'][$keys]['children'][$keyss]['children'][] = array('name' => ucwords($territory['territory_name']) . " (" . ucwords($territoryuser['user_name']) . ")");
                            } else {
                                # Add value to existing array while creating another array for assigning district_name
                                $treeView2['children'][$keys]['children'][$keyss]['children'][] = array('name' => ucwords($territory['territory_name']));
                            }
                        }
                    }
                }
                $treeView['children'][] = $treeView2;
            }
        }

        #Return array in json format
        //  print_r ($treeView);exit;
        return json_encode($treeView);
    }

    /*     * ********** Employee Treeview END************** */
}
