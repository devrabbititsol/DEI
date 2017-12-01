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
            $otprequest =  "http://tra.bulksmsinhyderabad.co.in/websms/sendsms.aspx?userid=BIGEQP&password=BIGEQP&sender=DGTEQP&mobileno=".$phone."&msg=".urlencode('Thanks for Registering with Digital Equipments India. Your OTP: '.$otp);
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
            
            //send mail to user
            $subject="Your OTP | Digital Equipments India";
            $message = Mail_settings::get_otp_message($otp);
            
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
        
        
        $subject="New Account Created | Digital Equipments India";
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
    
    
}
