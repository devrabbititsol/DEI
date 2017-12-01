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

class Getquote extends Model
{
    protected $id = 'quotation_id';

    public static function tableName()
    {
        return 'core_quotation';
    }
    
    //insert new quotation request
    public static function insert_new_quotation($data)
    {
        try{
            $get_quote = $data;
            $get_quote['start_date'] = date('Y-m-d', strtotime($data['start_date']));
            if($get_quote['duration_type'] == '')
                unset($get_quote['duration_type']);
                
            //save quote data
            Yii::$app->db->createCommand()->insert('core_quotation', $get_quote)->execute();
            //send mail to user
            $subject="Digital Equipments India | Quotation Enquiry";
            $message = Mail_settings::get_quote_message_to_user($data);

            $email = $data['email'];

            Mail_settings::send_email_notification($email,$subject,$message);
            
            //send email to admin
            $message = Mail_settings::get_quote_message_to_admin($get_quote);
            $email = Yii::$app->params['ADMIN_EMAIL'];
            Mail_settings::send_email_notification($email,$subject,$message);
            
            return "SUCCESS";
            
        } catch (ErrorException $ex) {
            Yii::warning('Error while adding new quote.');
            Yii::warning($ex->getMessage());
            return "FAILED";
        }
        
    }
    
    
    

}
