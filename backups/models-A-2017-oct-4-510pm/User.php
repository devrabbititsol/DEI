<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\db\Query;
use app\models\Mail_settings;
/**
 * This is the model class for table "users".
 *
 * @property string $userid
 * @property string $username
 * @property string $password
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'core_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            [['email', 'password'], 'string', 'max' => 100]            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userid' => 'id',
            'email' => 'Email',
            'password' => 'Password'
        ];
    }  
    
    /** INCLUDE USER LOGIN VALIDATION FUNCTIONS**/
        /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
/* modified */
    public static function findIdentityByAccessToken($token, $type = null)
    {
          return static::findOne(['access_token' => $token]);
    }
 
/* removed
    public static function findIdentityByAccessToken($token)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }
*/
    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUseremail($email)
    {
        return static::findOne(['email' => $email]);
    }
    
    public static function findByUserphone($phone)
    {
        return static::findOne(['phone_number' => $phone]);
    }

    /**
     * Finds user by password reset token
     *
     * @param  string      $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        $expire = \Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Security::generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Security::generateRandomKey();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Security::generateRandomKey() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    
    //select user email by user id
    public function select_user_email_by_id($user_id=null)
    {
        if($user_id==null)
        {
            $user_id = Yii::$app->user->getId();
        }
        $query = new Query;
        $count = $query->select('email')->from('core_users')->where("user_id = '$user_id'")->All();
        return $count[0]['email'];
    }
    
    //check if email already exist or not
    public function select_email_exist($email)
    {
        $query = new Query;
        $count = $query->select('COUNT(*) as count')->from('core_users')->where("email = '$email'")->All();
        if($count[0]['count']>0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    //check if phone number exist already or not 
    public function select_phone_number_exist($phone_number)
    {
        $query = new Query;
        $count = $query->select('COUNT(*) as count')->from('core_users')->where("phone_number = '$phone_number'")->All();
        if($count[0]['count']>0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    
    /*public function select_phone_exist($phone)
    {
        $query = new Query;
        $count = $query->select('COUNT(*) as count')->from('core_users')->where("phone_number = '$phone'")->All();
        if($count[0]['count']>0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }*/
    
    //create a 6 digit otp number and return 
    public function create_otp()
    {
        $otp = rand(100000,1000000);
        return $otp;
    }
    
    //send otp to user based on email or phone number parameters
    public function send_otp_to_user($email=null,$phone=null,$otp)
    {
        //send if phone number not null
        if($phone != null)
        {
            $otprequest =  "http://tra.bulksmsinhyderabad.co.in/websms/sendsms.aspx?userid=BIGEQP&password=BIGEQP&sender=BIGEQP&mobileno=".$phone."&msg=".urlencode('Thanks for Registering with Big Equipments India. Your OTP: '.$otp);
            $curl_handle=curl_init();
            curl_setopt($curl_handle, CURLOPT_URL,$otprequest);
            curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
            $query = curl_exec($curl_handle);
            curl_close($curl_handle);
            $query = Yii::$app->db;
            $query->createCommand()->update('core_users', ['otp_code' => "$otp"], "phone_number = '$phone'")->execute();
        }
         //send if email not null
        if($email != null)
        {
            $query = Yii::$app->db;
            $query->createCommand()->update('core_users', ['otp_code' => "$otp"], "email = '$email'")->execute();
            
            $query = new Query;
            $user_details = $query->select('user_name')->from('core_users')->where("email = '$email'")->one();
            //send mail to user
            $subject="Big Equipments India | USER REGISTRATION";
            $message = Mail_settings::get_otp_message($otp,$user_details['user_name']);
            
            Mail_settings::send_email_notification($email,$subject,$message);
            
        }
        return true;
    }
    
    //send forgot otp to user based on email or phone number parameters
    public function send_forgot_otp_to_user($email=null,$phone=null,$otp)
    {
        //send if phone number not null
        if($phone != null)
        {
            $otprequest =  "http://tra.bulksmsinhyderabad.co.in/websms/sendsms.aspx?userid=BIGEQP&password=BIGEQP&sender=BIGEQP&mobileno=".$phone."&msg=".urlencode('Thank you for contacting about your forgotten password. Your OTP: '.$otp);
            $curl_handle=curl_init();
            curl_setopt($curl_handle, CURLOPT_URL,$otprequest);
            curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
            $query = curl_exec($curl_handle);
            curl_close($curl_handle);
            $query = Yii::$app->db;
            $query->createCommand()->update('core_users', ['otp_code' => "$otp"], "phone_number = '$phone'")->execute();
        }
         //send if email not null
        if($email != null)
        {
            $query = Yii::$app->db;
            $query->createCommand()->update('core_users', ['otp_code' => "$otp"], "email = '$email'")->execute();
            
            $query = new Query;
            $user_details = $query->select('user_name')->from('core_users')->where("email = '$email'")->one();
            //send mail to user
            $subject="Big Equipments India | Forgot Password";
            $message = Mail_settings::get_forgot_otp_message($otp,$user_details['user_name']);
            
            Mail_settings::send_email_notification($email,$subject,$message);
            
        }
        return true;
    }
    
    //save new user while registration
    public function insert_new_user($data)
    {
        foreach($data as $key=>$val) $$key=get_magic_quotes_gpc()?$val:addslashes($val);
        $password = md5($password);
        $query = new Query;
        $count = $query->select('COUNT(*) as count')->from('core_users')->where("email = '$email'")->orWhere("phone_number = '$phone_number'")->All();
        if($count[0]['count']==0)
        {
        $query = Yii::$app->db;
        $result = $query->createCommand()->insert('core_users', [
                            "user_name"=>$user_name,
                            "email"=>$email,
                            "password"=>$password,
                            "phone_number"=>$phone_number,
                            //"phone_prefix"=>'91',
                            "user_status"=>'1',
                            "company_name"=>$company_name,
                            "designation"=>$designation,
                            "company_email"=>$company_email,
                            "company_address"=>$address,
                            "user_type"=>1
                        ])->execute();
        
        
        $subject="Big Equipments India | User Registration";
        //get message to send to user
        $message = Mail_settings::get_registration_message();
        //send email to user
        Mail_settings::send_email_notification($email,$subject,$message);
        
        if($result)
        {
            return true;
        }
        return false;
        }
        return false;
        
    }
    
    //function to validate otp entered by user.
    public function select_user_current_otp($data)
    {
        //otp entered while forgot password request
        if($data['action']=='forgotpassword')
        {
            foreach($data as $key=>$val) $$key=get_magic_quotes_gpc()?$val:addslashes($val);
            if($email != '')
            {
                $query = new Query;
                $count = $query->select('COUNT(*) as count')->from('core_users')->where("email = '$email'")->andWhere("otp_code = '$otp'")->All();
                if($count[0]['count']>0)
                {
                    
                    $query = Yii::$app->db;
                    $query->createCommand()->update('core_users', ['user_status' => "2"], "email = '$email'")->execute();
                    return true;
                }
                else
                    return false;
                
            }
            else if($phone != '')
                {
                    $query = new Query;
                    $count = $query->select('COUNT(*) as count')->from('core_users')->where("phone_number = '$phone'")->andWhere("otp_code = '$otp'")->All();
                    if($count[0]['count']>0)
                    {
                        $query = Yii::$app->db;
                        $query->createCommand()->update('core_users', ['user_status' => "2"], "phone_number = '$phone'")->execute();
                        Yii::$app->user->login(User::findByUserphone($phone));
                        Usersessions::insert_user_session();
                        return true;
                    }
                    else
                        return false;

                }
            return false;
        }
        //otp entered while registration or login.
        else {
            foreach($data as $key=>$val) $$key=get_magic_quotes_gpc()?$val:addslashes($val);

            $query = new Query;
            $count = $query->select('COUNT(*) as count')->from('core_users')->where("email = '$email'")->andWhere("otp_code = '$otp'")->All();
            if($count[0]['count']>0)
            {
                $query = Yii::$app->db;
                $query->createCommand()->update('core_users', ['user_status' => "2"], "email = '$email'")->execute();
                Yii::$app->user->login(User::findByUseremail($email));
                Usersessions::insert_user_session();
                return true;
            }
            else
            {
                return false;
            }
        }
    }
    
    //update user reset password by email if user forgot request with email
    public function update_user_password_by_email($data)
    {
        foreach($data as $key=>$val) $$key=get_magic_quotes_gpc()?$val:addslashes($val);
        $password = md5($password);
        $query = Yii::$app->db;
        $query->createCommand()->update('core_users', ['password' => "$password"], "email = '$email'")->execute();
        return true;
    }
    
    //update user reset password by phone if user forgot request with phone number
    public function update_user_password_by_phone($data)
    {
        foreach($data as $key=>$val) $$key=get_magic_quotes_gpc()?$val:addslashes($val);
        $password = md5($password);
        $query = Yii::$app->db;
        $query->createCommand()->update('core_users', ['password' => "$password"], "phone_number = '$phone_number'")->execute();
        return true;
    }
    
    //get user details by user id
    public function get_user_details_by_id($userId = null)
    {
        if($userId == null)
        {
            $userId = Yii::$app->user->id;
        }
        return User::findIdentity($userId);
    }

    // Updating user profile details.

    public function update_userdetails($data)
    {
        foreach($data as $key=>$val) $$key=get_magic_quotes_gpc()?$val:addslashes($val);
        $userId = Yii::$app->user->id;

        $query = new Query;

        $result = $query->createCommand()->update('core_users', ['user_name' => $name,'company_name' => $company_name,'company_address' => $address,'designation' => $designation,'company_email' => $company_email], 'user_id = "'.$userId.'"')->execute();

        if ($result == 1){
                return "SUCCESS";
                }else{
                return "FAILED";
        }
    }

    // Change Password Option

    public function password_change($data)
    {
        foreach($data as $key=>$val) $$key=get_magic_quotes_gpc()?$val:addslashes($val);
        $oldpassword = md5($oldpassword);
        $newpassword = md5($newpassword);
        $userId = Yii::$app->user->id;

        $query = new Query;
        $count = $query->select('COUNT(*) as count')->from('core_users')->where('user_id=:userId', [':userId' => $userId])->andWhere('password=:oldpassword', [':oldpassword' => $oldpassword])->All();

        if($count[0]['count'] == 1)
        {
                if($oldpassword != $newpassword)
                {
                        $query = new Query;

                        $result = $query->createCommand()->update('core_users', ['password' => $newpassword], 'user_id = "'.$userId.'"')->execute();

                        return "SUCCESS";
                }
                else{
                        return "PASSWORDFAILED";
                }
        }
        else{
                return "FAILED";
        }
    }

    // Getting user hiring details.

    public function hire_details_by_user($userId)
    {

        $query = new Query;

        $query->select(['core_orders.order_id', 'core_orders.from_date', 'core_orders.to_date', 'core_orders.no_of_days', 'core_orders.order_status', 'core_orders.manual_order_code',
                    'core_products.product_id', 'core_products.capacity', 'core_products.current_location', 'core_product_categories.category_name'])
                ->from('core_orders')->join('INNER JOIN', 'core_products', 'core_orders.product_id =core_products.product_id')
                ->join('INNER JOIN', 'core_product_categories', 'core_product_categories.category_id =core_products.category_id')
                ->where('core_orders.user_id=:userId', [':userId' => $userId])->andWhere('core_orders.type="0"')
                ->orderBy(['core_orders.order_id' => SORT_DESC]);

        $command = $query->createCommand();
        $data = $command->queryAll();

        return $data;
    }

    // Getting user supply details.

    public function supply_details_by_user($userId) {
        
        $query = new Query;

        $query->select(['core_products.product_id', 'core_products.manual_product_code', 'core_products.current_location', 'core_products.product_status',
                    'core_product_models.model_name', 'core_product_sub_categories.sub_category_name', 'core_product_categories.category_name'])
                ->from('core_products')->join('LEFT JOIN', 'core_product_categories', 'core_product_categories.category_id =core_products.category_id')
                ->join('LEFT JOIN', 'core_product_sub_categories', 'core_products.sub_category_id =core_product_sub_categories.sub_category_id')
                ->join('LEFT JOIN', 'core_product_models', 'core_products.model_id =core_product_models.model_id')
                ->where('core_products.user_id=:userId', [':userId' => $userId])
                ->andWhere('core_products.product_type="0"')
                ->orderBy(['core_products.product_id' => SORT_DESC]);

        $command = $query->createCommand();
        $data = $command->queryAll();

        return $data;
    }

    // Getting user buying details.

    public function buy_details_by_user($userId) {
        
        $query = new Query;

        $query->select(['core_orders.order_id', 'core_orders.from_date', 'core_orders.no_of_days', 'core_orders.order_status', 'core_orders.manual_order_code',
                    'core_products.product_id', 'core_product_models.model_name', 'core_product_sub_categories.sub_category_name', 'core_product_categories.category_name'])
                ->from('core_orders')->join('INNER JOIN', 'core_products', 'core_orders.product_id =core_products.product_id')
                ->join('LEFT JOIN', 'core_product_categories', 'core_product_categories.category_id =core_products.category_id')
                ->join('LEFT JOIN', 'core_product_sub_categories', 'core_products.sub_category_id =core_product_sub_categories.sub_category_id')
                ->join('LEFT JOIN', 'core_product_models', 'core_products.model_id =core_product_models.model_id')
                ->where('core_orders.user_id=:userId', [':userId' => $userId])->andWhere('core_orders.type="1"')
                ->orderBy(['core_orders.order_id' => SORT_DESC]);

        $command = $query->createCommand();
        $data = $command->queryAll();

        return $data;
    }

    // Getting user selling details.

    public function sale_details_by_user($userId) {
        $query = new Query;

        $query->select(['core_products.product_id', 'core_products.manual_product_code', 'core_products.current_location', 'core_products.product_status',
                    'core_product_models.model_name', 'core_product_sub_categories.sub_category_name', 'core_product_categories.category_name'])
                ->from('core_products')->join('LEFT JOIN', 'core_product_categories', 'core_product_categories.category_id =core_products.category_id')
                ->join('LEFT JOIN', 'core_product_sub_categories', 'core_products.sub_category_id =core_product_sub_categories.sub_category_id')
                ->join('LEFT JOIN', 'core_product_models', 'core_products.model_id =core_product_models.model_id')
                ->where('core_products.user_id=:userId', [':userId' => $userId])
                ->andWhere('core_products.product_type="1"')
                ->orderBy(['core_products.product_id' => SORT_DESC]);

        $command = $query->createCommand();
        $data = $command->queryAll();

        return $data;
    }
    
    // Getting user supply or selling details.

    public function supply_or_sale_details_by_user($userId) {
        $query = new Query;

        $query->select(['core_products.product_id', 'core_products.manual_product_code', 'core_products.current_location', 'core_products.product_status',
                    'core_product_models.model_name', 'core_product_sub_categories.sub_category_name', 'core_product_categories.category_name'])
                ->from('core_products')->join('LEFT JOIN', 'core_product_categories', 'core_product_categories.category_id =core_products.category_id')
                ->join('LEFT JOIN', 'core_product_sub_categories', 'core_products.sub_category_id =core_product_sub_categories.sub_category_id')
                ->join('LEFT JOIN', 'core_product_models', 'core_products.model_id =core_product_models.model_id')
                ->where('core_products.user_id=:userId', [':userId' => $userId])
                ->andWhere('core_products.product_type="2"')
                ->orderBy(['core_products.product_id' => SORT_DESC]);

        $command = $query->createCommand();
        $data = $command->queryAll();

        return $data;
    }
    
    // Getting user Ads details.

    public function ad_details_by_user($userId) {
        $query = new Query;

        return $query->select(['core_post_ads.*','core_post_ads_images.ads_image_id','core_post_ads_images.ad_image_url','core_post_ads_images.ad_image_status'])
                    ->from('core_post_ads_images')
                    ->leftJoin('core_post_ads', 'core_post_ads.ad_id = core_post_ads_images.ad_id')
                    ->where("core_post_ads.user_id = $userId")
                    //->groupBy(['core_post_ads.ad_id'])
                    ->all();
    }
    
    public static function get_users_count()
    {
        $query = new Query;
        $inactive_users_count = $query->select('COUNT(*) as count')->from('core_users')->where("user_type = 1")->andWhere('user_status = 1')->All();
        $total_count['inactive_users_count'] = $inactive_users_count[0]['count'];
        
        $count = $query->select('COUNT(*) as count')->from('core_users')->where("user_type = 1")->All();//get only public users
        $total_count['total_users_count'] = $count[0]['count'];
        return $total_count;
    }
    public static function get_employee_count()
    {
        $query = new Query;
        $inactive_users_count = $query->select('COUNT(*) as count')->from('core_users')->where(['not in', 'user_type', [1,2]])->andWhere('user_status = 1')->All();
        $total_count['inactive_employee_count'] = $inactive_users_count[0]['count'];
        
        $count = $query->select('COUNT(*) as count')->from('core_users')->where(['not in', 'user_type', [1,2]])->All();//get without public user and super admin
        $total_count['total_employee_count'] = $count[0]['count'];
        return $total_count;
    }
    
    public static function checkAccess($operation)
    {
        $session = Yii::$app->session;
        $role_details = $session->get('role');
        $role = $role_details['role_name'];
        
        $permission_ids = $role_details['permission_ids'];
        $permission_ids = explode(',',$permission_ids);
        
        $query = new Query;
        $permissionsdata = $query->select('permission_action_name')->from('core_permissions')->where(['permission_id' => $permission_ids])->All();
        $permissions = array();
        foreach($permissionsdata as $permission) 
        {
            array_push($permissions,$permission['permission_action_name']);
        }
        
        
        
        $arr[$role] = $permissions;
        
        /*$arr['admin'] = array("users", "ads", "products", "orders", "getquote", "payments", 'addproduct');
        $arr['data-operator'] = array("products");
        $arr['public_user'] = array("");
        $arr['salesexecutive'] = array("products", "orders", 'addproduct');
        $arr['sales-manager'] = array("products", "orders", "getquote", 'addproduct');
        $arr['Super Admin'] = array("users", "ads", "products", "orders", "getquote", "payments", 'addproduct');*/
        
        if(in_array($operation, $arr[$role]) )
            return true;
        else 
            return false;
    }
    
	// Getting all public users
	
    public static function get_public_users()
    {
        $connection = Yii::$app->getDb();
        /*$users = Yii::$app->db->createCommand("SELECT core_users.*,(SELECT core_sessions.date_created FROM core_sessions WHERE core_sessions.user_id = core_users.user_id ORDER BY core_sessions.date_created DESC LIMIT 1) last_login FROM core_users where core_users.user_type =:user_type")
                    ->bindValue(':user_type', 1)
                    ->queryAll();*/
        $users = Yii::$app->db->createCommand("SELECT core_users.*,"
                . "(SELECT core_sessions.date_created FROM core_sessions WHERE core_sessions.user_id = core_users.user_id ORDER BY core_sessions.date_created DESC LIMIT 1) last_login,"
                . "(SELECT core_user_roles.role_name FROM core_user_roles WHERE core_user_roles.role_id = core_users.user_type) role_name FROM core_users "
                . "where core_users.user_type = 1")->queryAll();
        /*$users = $connection->createCommand("SELECT core_users.*,(SELECT core_sessions.date_created FROM core_sessions WHERE core_sessions.user_id = core_users.user_id ORDER BY core_sessions.date_created DESC LIMIT 1) last_login FROM core_users where core_users.user_type = 1")->queryAll();*/
        /*$users = $query->select(['core_users.*','core_sessions.date_created'])->from('core_users')
                        ->innerJoin('core_sessions','core_users.user_id = core_sessions.user_id')
                        ->where("core_users.user_type = '1'")
                        ->orderBy(['core_sessions.date_created' => SORT_DESC])
                        ->groupBy('core_sessions.user_id')
                        ->All();*/
        return $users;
    }

    // Updating user status to inactive i.e 'user_status' => '3'.

    public function inactive_userstatus($id)
    {
        
        $query = new Query;

        $result = $query->createCommand()->update('core_users', ['user_status' => '3'], 'user_id = "'.$id.'"')->execute();

        if ($result == 1){
                return "SUCCESS";
                }else{
                return "FAILED";
        }
    }

    // Updating user status to inactive i.e 'user_status' => '2'.

    public function active_userstatus($id)
    {
        
        $query = new Query;

        $result = $query->createCommand()->update('core_users', ['user_status' => '2'], 'user_id = "'.$id.'"')->execute();

        if ($result == 1){
                return "SUCCESS";
                }else{
                return "FAILED";
        }
    }
    
    // Updating user profile details.

    public function update_userdetails_by_admin($data)
    {
        foreach($data as $key=>$val) $$key=get_magic_quotes_gpc()?$val:addslashes($val);
       
        $query = new Query;

        $result = $query->createCommand()->update('core_users', ['user_name' => $name,'company_name' => $company_name,'company_address' => $address,'designation' => $designation,'company_email' => $company_email], 'user_id = "'.$userid.'"')->execute();

        if ($result == 1){
                return "SUCCESS";
                }else{
                return "FAILED";
        }
    }
    
    
    public static function get_all_employees()
    {
        $session = Yii::$app->session;
        $role_details = $session->get('role');
        //$query = new Query;
        
        
        if($role_details['role_id'] == 2 || $role_details['role_id'] == 3)//admin or superadmin
        {
        $users = Yii::$app->db->createCommand("SELECT core_users.*,"
                . "(SELECT core_sessions.date_created FROM core_sessions WHERE core_sessions.user_id = core_users.user_id ORDER BY core_sessions.date_created DESC LIMIT 1) last_login,"
                . "(SELECT core_user_roles.role_name FROM core_user_roles WHERE core_user_roles.role_id = core_users.user_type) role_name FROM core_users "
                . "where core_users.user_type NOT IN(:user_type1,:user_type2)")
                    ->bindValue(':user_type1', '1')
                    ->bindValue(':user_type2', '2')//get without public user and super admin
                    //->bindValue(':user_type3', $role_details['role_id'])//get without public user and super admin
                    ->queryAll();
        }
        else
        {
            $query = new Query;
            $current_user_data = $query->select(['GROUP_CONCAT(DISTINCT(user_x_roles.user_zone_id)) as zone_id',
                                              'GROUP_CONCAT(DISTINCT(user_x_roles.user_state_id)) as state_id',
                                              'GROUP_CONCAT(DISTINCT(user_x_roles.user_district_id)) as district_id',
                                              'GROUP_CONCAT(DISTINCT(user_x_roles.user_territory_id)) as territory_id'])
                                ->from('user_x_roles')
                                ->where("user_x_roles.user_id = ".Yii::$app->user->id)
                                ->one();
            
            $query = "SELECT core_users.*,"
                . "(SELECT core_sessions.date_created FROM core_sessions WHERE core_sessions.user_id = core_users.user_id ORDER BY core_sessions.date_created DESC LIMIT 1) last_login,"
                . "(SELECT core_user_roles.role_name FROM core_user_roles WHERE core_user_roles.role_id = core_users.user_type) role_name FROM core_users "
                . "LEFT JOIN user_x_roles ON core_users.user_id = user_x_roles.user_id "
                . "where core_users.user_type NOT IN(:user_type1,:user_type2,:user_type3) AND core_users.user_type > :logged_in_role ";
            if($role_details['role_id'] == 4 ) //zonal employee
            {
                $current_mapping_ids = $current_user_data['zone_id'];
                $query = $query." AND user_x_roles.user_zone_id IN (".$current_mapping_ids.")";
             
            }
            elseif($role_details['role_id'] == 5 )//state employee
            {
                $current_mapping_ids = $current_user_data['state_id'];
                $query = $query." AND user_x_roles.user_state_id IN (".$current_mapping_ids.")";
            }
            elseif($role_details['role_id'] == 6 ) //District employee
            {
                $current_mapping_ids = $current_user_data['district_id'];
                $query = $query." AND user_x_roles.user_district_id IN (".$current_mapping_ids.")";
            }
//           /echo $current_mapping_ids;
            $query = $query." GROUP BY user_x_roles.user_id";
         //   echo $query;exit;
            $users = Yii::$app->db->createCommand($query)
                    ->bindValue(':user_type1', '1')
                    ->bindValue(':user_type2', '2')
                    ->bindValue(':user_type3', '8')//get without public user and super admin and dataoperator
                    ->bindValue(':logged_in_role', $role_details['role_id'])
                //    ->bindValue(':current_mapping_id', $current_mapping_ids)
                    ->queryAll();
        }
    //    print_r($users);exit;
        /*$users = $query->select('*')->from('core_users')->where(['not in', 'user_type', [1,2]])->All();*///get without public user and super admin
        return $users;
    }
    
    public static function insert_new_employee($employee_data)
    {
        try{
            $session = Yii::$app->session;
            $role_details = $session->get('role');

            $new_employee['user_name'] = $employee_data['user_name'];
            $new_employee['email'] = $employee_data['email'];
            $new_employee['password'] = md5($employee_data['password']);
            $new_employee['phone_number'] = $employee_data['phone_number'];
            $new_employee['company_name'] = $employee_data['company_name'];
            $new_employee['company_address'] = $employee_data['address'];
            $new_employee['designation'] = $employee_data['designation'];
            $new_employee['company_email'] = $employee_data['company_email'];
            $new_employee['user_status'] = 2;
            $new_employee['date_created'] = date('Y-m-d H:i:s');
            $new_employee['date_modified'] = date('Y-m-d H:i:s');
            $new_employee['user_type'] = $employee_data['user_type'];
            $query = new Query;
            $count = $query->select('COUNT(*) as count')->from('core_users')->where("email = '".$employee_data['email']."'")->orWhere("phone_number = '".$employee_data['phone_number']."'")->All();
            if($count[0]['count']==0)
            {
                $query = Yii::$app->db;
                $result = $query->createCommand()->insert('core_users', $new_employee)->execute();
                $user_id = Yii::$app->db->getLastInsertID();

                if($employee_data['user_type'] == 7)//sales executive
                {
                    foreach($employee_data['territory_id'] as $territory_id)
                    {
                        $query = new Query;
                        $territory_data = $query->select(['core_territories.territory_id','core_territories.territory_name',
                                            'core_districts.district_id','core_districts.district_name',
                                            'core_states.state_id','core_states.state_name',
                                            'core_zones.zone_id','core_zones.zone_name'])
                                            ->from('core_territories')
                                            ->innerJoin('core_districts','core_territories.district_id = core_districts.district_id')
                                            ->innerJoin('core_states','core_districts.state_id = core_states.state_id')
                                            ->innerJoin('core_zones','core_states.zone_id = core_zones.zone_id')
                                            ->where("core_territories.territory_id = $territory_id")
                                            ->one();

                        $new_employee_mapping['user_id'] = $user_id;
                        $new_employee_mapping['user_name'] = $employee_data['user_name'];
                        //$new_employee_mapping['user_role_id'] = $role_details['role_id'];
                        $new_employee_mapping['user_role_id'] = $employee_data['user_type'];
                        $new_employee_mapping['user_zone_id'] = $territory_data['zone_id'];
                        $new_employee_mapping['user_zone_name'] = $territory_data['zone_name'];
                        $new_employee_mapping['user_state_id'] = $territory_data['state_id'];
                        $new_employee_mapping['user_state_name'] = $territory_data['state_name'];
                        $new_employee_mapping['user_district_id'] = $territory_data['district_id'];
                        $new_employee_mapping['user_district_name'] = $territory_data['district_name'];
                        $new_employee_mapping['user_territory_id'] = $territory_data['territory_id'];
                        $new_employee_mapping['user_territory_name'] = $territory_data['territory_name'];
                        $new_employee_mapping['created_by'] = Yii::$app->user->id;
                        $new_employee_mapping['date_created'] = date('Y-m-d H:i:s');

                        $insert_employee_mapping = $query->createCommand()->insert('user_x_roles', $new_employee_mapping)->execute();

                    }
                }
                else if($employee_data['user_type'] == 6)//District Sales Manager
                {
                    foreach($employee_data['district_id'] as $district_id)
                    {
                        $query = new Query;
                        $territory_data = $query->select(['core_districts.district_id','core_districts.district_name',
                                            'core_states.state_id','core_states.state_name',
                                            'core_zones.zone_id','core_zones.zone_name'])->from('core_districts')
                                            ->innerJoin('core_states','core_districts.state_id = core_states.state_id')
                                            ->innerJoin('core_zones','core_states.zone_id = core_zones.zone_id')
                                            ->where("core_districts.district_id = $district_id")
                                            ->one();

                        $new_employee_mapping['user_id'] = $user_id;
                        $new_employee_mapping['user_name'] = $employee_data['user_name'];
                        //$new_employee_mapping['user_role_id'] = $role_details['role_id'];
                        $new_employee_mapping['user_role_id'] = $employee_data['user_type'];
                        $new_employee_mapping['user_zone_id'] = $territory_data['zone_id'];
                        $new_employee_mapping['user_zone_name'] = $territory_data['zone_name'];
                        $new_employee_mapping['user_state_id'] = $territory_data['state_id'];
                        $new_employee_mapping['user_state_name'] = $territory_data['state_name'];
                        $new_employee_mapping['user_district_id'] = $territory_data['district_id'];
                        $new_employee_mapping['user_district_name'] = $territory_data['district_name'];
                        $new_employee_mapping['created_by'] = Yii::$app->user->id;
                        $new_employee_mapping['date_created'] = date('Y-m-d H:i:s');

                        $insert_employee_mapping = $query->createCommand()->insert('user_x_roles', $new_employee_mapping)->execute();

                    }
                }
                else if($employee_data['user_type'] == 5)//State Sales Manager
                {
                    foreach($employee_data['state_id'] as $state_id)
                    {
                        $query = new Query;
                        $territory_data = $query->select(['core_states.state_id','core_states.state_name',
                                            'core_zones.zone_id','core_zones.zone_name'])->from('core_states')
                                            ->innerJoin('core_zones','core_states.zone_id = core_zones.zone_id')
                                            ->where("core_states.state_id = $state_id")
                                            ->one();

                        $new_employee_mapping['user_id'] = $user_id;
                        $new_employee_mapping['user_name'] = $employee_data['user_name'];
                        //$new_employee_mapping['user_role_id'] = $role_details['role_id'];
                        $new_employee_mapping['user_role_id'] = $employee_data['user_type'];
                        $new_employee_mapping['user_zone_id'] = $territory_data['zone_id'];
                        $new_employee_mapping['user_zone_name'] = $territory_data['zone_name'];
                        $new_employee_mapping['user_state_id'] = $territory_data['state_id'];
                        $new_employee_mapping['user_state_name'] = $territory_data['state_name'];
                        $new_employee_mapping['created_by'] = Yii::$app->user->id;
                        $new_employee_mapping['date_created'] = date('Y-m-d H:i:s');

                        $insert_employee_mapping = $query->createCommand()->insert('user_x_roles', $new_employee_mapping)->execute();

                    }
                }
                else if($employee_data['user_type'] == 4)//Zonal Sales Manager
                {
                    foreach($employee_data['zone_id'] as $zone_id)
                    {
                        $query = new Query;
                        $territory_data = $query->select(['core_zones.zone_id','core_zones.zone_name'])->from('core_zones')->where("core_zones.zone_id = $zone_id")->one();

                        $new_employee_mapping['user_id'] = $user_id;
                        $new_employee_mapping['user_name'] = $employee_data['user_name'];
                        //$new_employee_mapping['user_role_id'] = $role_details['role_id'];
                        $new_employee_mapping['user_role_id'] = $employee_data['user_type'];
                        $new_employee_mapping['user_zone_id'] = $territory_data['zone_id'];
                        $new_employee_mapping['user_zone_name'] = $territory_data['zone_name'];
                        $new_employee_mapping['created_by'] = Yii::$app->user->id;
                        $new_employee_mapping['date_created'] = date('Y-m-d H:i:s');

                        $insert_employee_mapping = $query->createCommand()->insert('user_x_roles', $new_employee_mapping)->execute();

                    }
                }
                
                //send mail to user
                $subject="Big Equipments India | EMPLOYEE REGISTRATION";
                $message = Mail_settings::get_employee_registration_to_employee($employee_data['user_name']);

                Mail_settings::send_email_notification($employee_data['email'],$subject,$message);
                
                $response ['status'] = 200;
                $response ['message'] = "Employee created successfully.";
                return $response;
            }
            else
            {
                $response ['status'] = 300;
                $response ['message'] = "Employee already registered with given details.";
                return $response;
            }
        } catch (ErrorException $ex) {
            Yii::warning('Error while creating new Employee.');
            Yii::warning($ex->getMessage());
            
            $response ['status'] = 400;
            $response ['message'] = "Error while creating new Employee.";
            return $response;
        }
        
    }
    
    public function get_employee_details_by_id($employeeId)
    {
        $query = new Query;
        return $query->select(['core_users.*',
                                'GROUP_CONCAT(DISTINCT(user_x_roles.user_zone_name)) as zone_name',
                                'GROUP_CONCAT(DISTINCT(user_x_roles.user_zone_id)) as zone_id',
                                'GROUP_CONCAT(DISTINCT(user_x_roles.user_state_name)) as state_name',
                                'GROUP_CONCAT(DISTINCT(user_x_roles.user_state_id)) as state_id',
                                'GROUP_CONCAT(DISTINCT(user_x_roles.user_district_name)) as district_name',
                                'GROUP_CONCAT(DISTINCT(user_x_roles.user_district_id)) as district_id',
                                'GROUP_CONCAT(DISTINCT(user_x_roles.user_territory_name)) as territory_name',
                                'GROUP_CONCAT(DISTINCT(user_x_roles.user_territory_id)) as territory_id',
                                'core_user_roles.role_name' ])
                            ->from('core_users')
                            ->leftJoin('user_x_roles','user_x_roles.user_id = core_users.user_id')
                            ->innerJoin('core_user_roles','core_users.user_type = core_user_roles.role_id')
                            ->groupBy('user_x_roles.user_id')
                            ->where("core_users.user_id = $employeeId")
                            ->one();
    }
    
    public function update_employee_details($employee_data)
    {
        try{
            $update_employee['user_name'] = $employee_data['user_name'];
            $update_employee['email'] = $employee_data['email'];
            $update_employee['phone_number'] = $employee_data['phone_number'];
            $update_employee['company_name'] = $employee_data['company_name'];
            $update_employee['company_address'] = $employee_data['address'];
            $update_employee['designation'] = $employee_data['designation'];
            $update_employee['company_email'] = $employee_data['company_email'];
            $update_employee['date_created'] = date('Y-m-d H:i:s');
            $update_employee['date_modified'] = date('Y-m-d H:i:s');
            $update_employee['user_type'] = $employee_data['user_type'];

            foreach($update_employee as $key=>$val) $$key=get_magic_quotes_gpc()?$val:addslashes($val);

            $query = new Query;

            $result = $query->createCommand()->update('core_users', ['user_name' => $user_name,'company_name' => $company_name,'company_address' => $company_address,'designation' => $designation,'company_email' => $company_email], 'user_id = "'.$employee_data['user_id'].'"')->execute();

            $user_id = $employee_data['user_id'];
            $query->createCommand()->delete('user_x_roles', ['user_id' => $user_id])->execute();

            if($employee_data['user_type'] == 7)//sales executive
            {
                foreach($employee_data['territory_id'] as $territory_id)
                {
                    $query = new Query;
                    $territory_data = $query->select(['core_territories.territory_id','core_territories.territory_name',
                                        'core_districts.district_id','core_districts.district_name',
                                        'core_states.state_id','core_states.state_name',
                                        'core_zones.zone_id','core_zones.zone_name'])
                                        ->from('core_territories')
                                        ->innerJoin('core_districts','core_territories.district_id = core_districts.district_id')
                                        ->innerJoin('core_states','core_districts.state_id = core_states.state_id')
                                        ->innerJoin('core_zones','core_states.zone_id = core_zones.zone_id')
                                        ->where("core_territories.territory_id = $territory_id")
                                        ->one();

                    $new_employee_mapping['user_id'] = $user_id;
                    $new_employee_mapping['user_name'] = $employee_data['user_name'];
                    $new_employee_mapping['user_role_id'] = $employee_data['user_type'];
                    $new_employee_mapping['user_zone_id'] = $territory_data['zone_id'];
                    $new_employee_mapping['user_zone_name'] = $territory_data['zone_name'];
                    $new_employee_mapping['user_state_id'] = $territory_data['state_id'];
                    $new_employee_mapping['user_state_name'] = $territory_data['state_name'];
                    $new_employee_mapping['user_district_id'] = $territory_data['district_id'];
                    $new_employee_mapping['user_district_name'] = $territory_data['district_name'];
                    $new_employee_mapping['user_territory_id'] = $territory_data['territory_id'];
                    $new_employee_mapping['user_territory_name'] = $territory_data['territory_name'];
                    $new_employee_mapping['created_by'] = Yii::$app->user->id;
                    $new_employee_mapping['date_created'] = date('Y-m-d H:i:s');

                    $insert_employee_mapping = $query->createCommand()->insert('user_x_roles', $new_employee_mapping)->execute();

                }
            }
            else if($employee_data['user_type'] == 6)//District Sales Manager
            {
                foreach($employee_data['district_id'] as $district_id)
                {
                    $query = new Query;
                    $territory_data = $query->select(['core_districts.district_id','core_districts.district_name',
                                        'core_states.state_id','core_states.state_name',
                                        'core_zones.zone_id','core_zones.zone_name'])->from('core_districts')
                                        ->innerJoin('core_states','core_districts.state_id = core_states.state_id')
                                        ->innerJoin('core_zones','core_states.zone_id = core_zones.zone_id')
                                        ->where("core_districts.district_id = $district_id")
                                        ->one();

                    $new_employee_mapping['user_id'] = $user_id;
                    $new_employee_mapping['user_name'] = $employee_data['user_name'];
                    $new_employee_mapping['user_role_id'] = $employee_data['user_type'];
                    $new_employee_mapping['user_zone_id'] = $territory_data['zone_id'];
                    $new_employee_mapping['user_zone_name'] = $territory_data['zone_name'];
                    $new_employee_mapping['user_state_id'] = $territory_data['state_id'];
                    $new_employee_mapping['user_state_name'] = $territory_data['state_name'];
                    $new_employee_mapping['user_district_id'] = $territory_data['district_id'];
                    $new_employee_mapping['user_district_name'] = $territory_data['district_name'];
                    $new_employee_mapping['created_by'] = Yii::$app->user->id;
                    $new_employee_mapping['date_created'] = date('Y-m-d H:i:s');

                    $insert_employee_mapping = $query->createCommand()->insert('user_x_roles', $new_employee_mapping)->execute();

                }
            }
            else if($employee_data['user_type'] == 5)//State Sales Manager
            {
                foreach($employee_data['state_id'] as $state_id)
                {
                    $query = new Query;
                    $territory_data = $query->select(['core_states.state_id','core_states.state_name',
                                        'core_zones.zone_id','core_zones.zone_name'])->from('core_states')
                                        ->innerJoin('core_zones','core_states.zone_id = core_zones.zone_id')
                                        ->where("core_states.state_id = $state_id")
                                        ->one();

                    $new_employee_mapping['user_id'] = $user_id;
                    $new_employee_mapping['user_name'] = $employee_data['user_name'];
                    $new_employee_mapping['user_role_id'] = $employee_data['user_type'];
                    $new_employee_mapping['user_zone_id'] = $territory_data['zone_id'];
                    $new_employee_mapping['user_zone_name'] = $territory_data['zone_name'];
                    $new_employee_mapping['user_state_id'] = $territory_data['state_id'];
                    $new_employee_mapping['user_state_name'] = $territory_data['state_name'];
                    $new_employee_mapping['created_by'] = Yii::$app->user->id;
                    $new_employee_mapping['date_created'] = date('Y-m-d H:i:s');

                    $insert_employee_mapping = $query->createCommand()->insert('user_x_roles', $new_employee_mapping)->execute();

                }
            }
            else if($employee_data['user_type'] == 4)//Zonal Sales Manager
            {
                foreach($employee_data['zone_id'] as $zone_id)
                {
                    $query = new Query;
                    $territory_data = $query->select(['core_zones.zone_id','core_zones.zone_name'])->from('core_zones')->where("core_zones.zone_id = $zone_id")->one();

                    $new_employee_mapping['user_id'] = $user_id;
                    $new_employee_mapping['user_name'] = $employee_data['user_name'];
                    $new_employee_mapping['user_role_id'] = $employee_data['user_type'];
                    $new_employee_mapping['user_zone_id'] = $territory_data['zone_id'];
                    $new_employee_mapping['user_zone_name'] = $territory_data['zone_name'];
                    $new_employee_mapping['created_by'] = Yii::$app->user->id;
                    $new_employee_mapping['date_created'] = date('Y-m-d H:i:s');

                    $insert_employee_mapping = $query->createCommand()->insert('user_x_roles', $new_employee_mapping)->execute();

                }
            }
            $response ['status'] = 200;
            $response ['message'] = "Employee details updated successfully.";
            return $response;
        } catch (ErrorException $ex) {
            Yii::warning('Error while updating Employee Details.');
            Yii::warning($ex->getMessage());
            
            $response ['status'] = 400;
            $response ['message'] = "Error while updating Employee";
            return $response;
        }
        
    }
    
    //get emplyees by district id
    public static function get_employee_by_district_id($district_id)
    {
        $query = new Query;
        return $query->select(['core_users.user_id','core_users.user_name'])->from('user_x_roles')
                            ->innerJoin('core_users','user_x_roles.user_id = core_users.user_id')
                            ->where("user_x_roles.user_district_id = $district_id")
                            ->andWhere("user_x_roles.user_territory_id != 0")
                            ->all();
    }
}
