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
            $ipdetails['country_name'] = 'India';
            //default hyderabad co-ordinates
            $ipdetails['latitude'] = 17.3850;
            $ipdetails['longitude'] = 78.4867;
            
            $ip = $_SERVER['REMOTE_ADDR'];
            $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));    
            if($ip_data && $ip_data->geoplugin_countryName != null){
                $ipdetails['country_name'] = @$ip_data->geoplugin_countryName;
                if(@$ip_data->geoplugin_countryName == "India")
                {
                    $ipdetails['latitude'] = @$ip_data->geoplugin_latitude;
                    $ipdetails['longitude'] = @$ip_data->geoplugin_longitude;
                }
            }
            
            return $ipdetails;
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
            return 'India';
        }
        
    }
    
    
    

}
