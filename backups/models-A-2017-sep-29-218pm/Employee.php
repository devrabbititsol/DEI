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
class Employee extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'core_employees';
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
    public static function findByEmployeeemail($email)
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
    public function select_user_email_by_id($employee_id=null)
    {
        if($user_id==null)
        {
            $user_id = Yii::$app->user->getId();
        }
        $query = new Query;
        $count = $query->select('email')->from('core_employees')->where("employee_id = '$employee_id'")->All();
        return $count[0]['email'];
    }
    
    //check if email already exist or not
    public function select_email_exist($email)
    {
        $query = new Query;
        $count = $query->select('COUNT(*) as count')->from('core_employees')->where("email = '$email'")->All();
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
        $count = $query->select('COUNT(*) as count')->from('core_employees')->where("phone_number = '$phone_number'")->All();
        if($count[0]['count']>0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    
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
            /*$otprequest =  "http://tra.bulksmsinhyderabad.co.in/websms/sendsms.aspx?userid=BIGEQP&password=BIGEQP&sender=DGTEQP&mobileno=".$phone."&msg=".urlencode('Thanks for Registering with Big Equipments India. Your OTP: '.$otp);
            $curl_handle=curl_init();
            curl_setopt($curl_handle, CURLOPT_URL,$otprequest);
            curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
            $query = curl_exec($curl_handle);
            curl_close($curl_handle);*/
            $query = Yii::$app->db;
            $query->createCommand()->update('core_employees', ['otp_code' => "$otp"], "phone_number = '$phone'")->execute();
        }
         //send if email not null
        if($email != null)
        {
            $query = Yii::$app->db;
            $query->createCommand()->update('core_employees', ['otp_code' => "$otp"], "email = '$email'")->execute();
            
            $query = new Query;
            $user_details = $query->select('employee_name')->from('core_employees')->where("email = '$email'")->one();
            //send mail to user
            $subject="Big Equipments India | OTP";
            $message = Mail_settings::get_otp_message($otp,$user_details['employee_name']);
            
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
            $otprequest =  "http://tra.bulksmsinhyderabad.co.in/websms/sendsms.aspx?userid=BIGEQP&password=BIGEQP&sender=DGTEQP&mobileno=".$phone."&msg=".urlencode('Thank you for contacting about your forgotten password. Your OTP: '.$otp);
            $curl_handle=curl_init();
            curl_setopt($curl_handle, CURLOPT_URL,$otprequest);
            curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
            $query = curl_exec($curl_handle);
            curl_close($curl_handle);
            $query = Yii::$app->db;
            $query->createCommand()->update('core_employees', ['otp_code' => "$otp"], "phone_number = '$phone'")->execute();
        }
         //send if email not null
        if($email != null)
        {
            $query = Yii::$app->db;
            $query->createCommand()->update('core_employees', ['otp_code' => "$otp"], "email = '$email'")->execute();
            
            $query = new Query;
            $user_details = $query->select('employee_name')->from('core_employees')->where("email = '$email'")->one();
            //send mail to user
            $subject="Big Equipments India | Forgot Password";
            $message = Mail_settings::get_forgot_otp_message($otp,$user_details['employee_name']);
            
            Mail_settings::send_email_notification($email,$subject,$message);
            
        }
        return true;
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
                $count = $query->select('COUNT(*) as count')->from('employee_name')->where("email = '$email'")->andWhere("otp_code = '$otp'")->All();
                if($count[0]['count']>0)
                {
                    
                    $query = Yii::$app->db;
                    $query->createCommand()->update('employee_name', ['user_status' => "1"], "email = '$email'")->execute();
                    return true;
                }
                else
                    return false;
                
            }
            else if($phone != '')
                {
                    $query = new Query;
                    $count = $query->select('COUNT(*) as count')->from('employee_name')->where("phone_number = '$phone'")->andWhere("otp_code = '$otp'")->All();
                    if($count[0]['count']>0)
                    {
                        $query = Yii::$app->db;
                        $query->createCommand()->update('employee_name', ['user_status' => "1"], "phone_number = '$phone'")->execute();
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
            $count = $query->select('COUNT(*) as count')->from('employee_name')->where("email = '$email'")->andWhere("otp_code = '$otp'")->All();
            if($count[0]['count']>0)
            {
                $query = Yii::$app->db;
                $query->createCommand()->update('employee_name', ['user_status' => "1"], "email = '$email'")->execute();
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
        $query->createCommand()->update('employee_name', ['password' => "$password"], "email = '$email'")->execute();
        return true;
    }
    
    //update user reset password by phone if user forgot request with phone number
    public function update_user_password_by_phone($data)
    {
        foreach($data as $key=>$val) $$key=get_magic_quotes_gpc()?$val:addslashes($val);
        $password = md5($password);
        $query = Yii::$app->db;
        $query->createCommand()->update('employee_name', ['password' => "$password"], "phone_number = '$phone_number'")->execute();
        return true;
    }
    
    //get user details by user id
    public function get_user_details_by_id($userId = null)
    {
        if($userId == null)
        {
            $userId = Yii::$app->employee->id;
        }
        return User::findIdentity($userId);
    }

    // Updating user profile details.

    public function update_userdetails($data)
    {
        foreach($data as $key=>$val) $$key=get_magic_quotes_gpc()?$val:addslashes($val);
        $employeeId = Yii::$app->employee->id;

        $query = new Query;

        $result = $query->createCommand()->update('core_employees', ['employee_name' => $name,'company_name' => $company_name,'company_address' => $address,'designation' => $designation,'company_email' => $company_email], 'employee_id = "'.$employeeId.'"')->execute();

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
        $employeeId = Yii::$app->employee->id;

        $query = new Query;
        $count = $query->select('COUNT(*) as count')->from('core_employees')->where('employee_id=:employeeId', [':employeeId' => $employeeId])->andWhere('password=:oldpassword', [':oldpassword' => $oldpassword])->All();

        if($count[0]['count'] == 1)
        {
                if($oldpassword != $newpassword)
                {
                        $query = new Query;

                        $result = $query->createCommand()->update('core_employees', ['password' => $newpassword], 'employee_id = "'.$employeeId.'"')->execute();

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

    
    public static function get_users_count()
    {
        $query = new Query;
        $count = $query->select('COUNT(*) as count')->from('core_employees')->where("employee_id != ".Yii::$app->employee->id)->All();
        return $count[0]['count'];
    }
    
    public static function checkAccess($operation)
    {
        
        $session = Yii::$app->session;
        $role = $session->get('role');
        
        
        
        $arr['admin'] = array("users", "ads", "products", "orders", "getquote", "payments", 'addproduct');
        $arr['data-operator'] = array("products");
        $arr['public_user'] = array("");
        $arr['salesexecutive'] = array("products", "orders", 'addproduct');
        $arr['sales-manager'] = array("products", "orders", "getquote", 'addproduct');
        $arr['Super Admin'] = array("users", "ads", "products", "orders", "getquote", "payments", 'addproduct');
        
        if(in_array($operation, $arr[$role]) )
            return true;
        else 
            return false;
    }
    
    
    
    
}
