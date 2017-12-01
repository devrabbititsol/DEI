<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\Query;
use app\models\Usersessions;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            //echo '<pre>';print_r($user);echo '</pre>';exit;
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect email or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided email and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[email]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUseremail($this->email);
        }

        return $this->_user;
    }
    //user login base on user status
    public function user_login($data)
    {
        foreach($data as $key=>$val) $$key=get_magic_quotes_gpc()?$val:addslashes($val);
        $password = md5($password);
        $query = new Query;
        
        //check user exists or not by provided email and password.
        $count = $query->select('COUNT(*) as count')->from('core_users')->where("email = '$email'")->andWhere("password = '$password'")->All();
        if($count[0]['count']>0)
        {
            //check for user status
            $userstatus = $query->select('user_status')->from('core_users')->where("email = '$email'")->andWhere("password = '$password'")->All();
            if($userstatus[0]['user_status'] == 2) //active user
            {
                //login user by email id
                Yii::$app->user->login(User::findByUseremail($email));
                Usersessions::insert_user_session();
            }
            return $userstatus[0]['user_status'];
        }
        return 0;
    }
    
    
}
