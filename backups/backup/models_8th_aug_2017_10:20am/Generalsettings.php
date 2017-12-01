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
use app\models\Mail_settings;

class Generalsettings extends Model
{
    
    //get country name by ip
    public static function get_country_name_by_ip()
    {
        try{
            $ip = $_SERVER['REMOTE_ADDR'];
            $url = "http://freegeoip.net/json/" . $ip;
            $json = file_get_contents($url);
            $data = json_decode($json, TRUE);
            return $country =  $data['country_name']; 
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
            return 'India';
        }
        
    }
    
    
    

}
