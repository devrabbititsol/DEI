<?php

namespace app\models;

use Yii;
//use yii\base\Model;
use \yii\db\ActiveRecord as Model;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\base\ErrorException;

class Usersessions extends Model
{
    protected $id = 'session_id';

    public static function tableName()
    {
        return 'core_sessions';
    }
    
    //insert user session details when logged in
    public static function insert_user_session()
    {
        try{
            
            $u_agent = $_SERVER['HTTP_USER_AGENT'];
            $bname = "Unknown";
            if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
                $bname = 'Internet Explorer'; 
            elseif(preg_match('/Firefox/i',$u_agent)) 
                $bname = 'Mozilla Firefox'; 
            elseif(preg_match('/Chrome/i',$u_agent)) 
                $bname = 'Google Chrome'; 
            elseif(preg_match('/Safari/i',$u_agent)) 
                $bname = 'Apple Safari'; 
            elseif(preg_match('/Opera/i',$u_agent))
                $bname = 'Opera'; 
            elseif(preg_match('/Netscape/i',$u_agent))
                $bname = 'Netscape'; 
            
            $usersession['user_id'] = Yii::$app->user->id;
            $usersession['authentication_token'] = Yii::$app->session->getId();
            $usersession['date_created'] = date('Y-m-d H:i:s');
            $usersession['date_expiration'] = date('Y-m-d H:i:s');
            $usersession['ip_address'] = $_SERVER['REMOTE_ADDR'];
            $usersession['http_user_agent'] = $bname;
            $usersession['mode'] = 0;
            Yii::$app->db->createCommand()->insert('core_sessions', $usersession)->execute();
            return true;
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
        }
        
        
        
    }
    
    
    

}
