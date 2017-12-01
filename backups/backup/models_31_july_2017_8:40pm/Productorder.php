<?php

namespace app\models;

use Yii;
//use yii\base\Model;
use \yii\db\ActiveRecord as Model;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\db\Query;
use app\models\Mail_settings;
use app\models\User;

class Productorder extends Model
{
    protected $id = 'order_id';

    public static function tableName()
    {
        return 'core_orders';
    }
    
    public static function insert_new_order($data)
    {
        $product_ids = $data['product_id'];
        $product_ids = explode(',',"$product_ids");
        $unique_codes = array();
        foreach($product_ids as $product_id)
        {
            if($product_id == '') continue;
            $insertdata['from_date'] = date('Y-m-d H:i:s', strtotime($data['from_date']));
            if(isset($data['no_of_days']))
            {
                $insertdata['no_of_days'] = $data['no_of_days'];
                $todate =strtotime("+".$data['no_of_days']." days", strtotime($data['from_date']));
                $insertdata['to_date'] = date('Y-m-d H:i:s', $todate);
            }
            else
                $insertdata['no_of_days'] = 0;



            $insertdata['description'] = $data['description'];
            $insertdata['type'] = $data['type'];
            $insertdata['product_id'] = $product_id;
            $insertdata['order_status'] = 1;
            $insertdata['user_id'] = Yii::$app->user->getId();
            Yii::$app->db->createCommand()->insert('core_orders', $insertdata)->execute();
            $order_id = Yii::$app->db->getLastInsertID();

            //generate unique code for order and update
            $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $codeAlphabet.= "0123456789";
            $max = strlen($codeAlphabet);
            $length = 13-strlen($order_id);
            $token='';
            for ($i=0; $i < $length; $i++) {
                $token .= $codeAlphabet[rand(0, $max-1)];
            }
            $manual_order_code = $token.$order_id;
            Yii::$app->db->createCommand()->update('core_orders', ['manual_order_code' => $manual_order_code], "order_id = '$order_id'")->execute();
            array_push($unique_codes, $manual_order_code);
            
            //send message to product owner
            $user_id = Products::select_user_id_by_product_id($product_id);
            $user_email = User::select_user_email_by_id($user_id);
            $subject="Check Availability Request | Digital Equipments India";
            $message = Mail_settings::get_order_add_message_to_product_owner($manual_order_code);
            Mail_settings::send_email_notification($user_email,$subject,$message);
            
        }
        
        //send email to user
        $email = User::select_user_email_by_id();
        $order_code = implode(',',$unique_codes);
        $subject="Check Availability Request | Digital Equipments India";
        $message = Mail_settings::get_order_add_message_to_user($order_code);
        Mail_settings::send_email_notification($email,$subject,$message);
        
        //send email to admin
        $email = Yii::$app->params['ADMIN_EMAIL'];
        $subject="Check Availability Request | Digital Equipments India";
        $message = Mail_settings::get_order_add_message_to_admin($order_code);
        Mail_settings::send_email_notification($email,$subject,$message);
        
        
        
        
        
        $message = '<div class="col-sm-12 col-md-12">
                        <div class="alert alert-success">
                            <span class="glyphicon glyphicon-ok"></span> <strong>Success</strong>
                            <hr class="message-inner-separator">
                            <p>
                                Thank You, You can refer your order by following unique code(s) '.$order_code.'</p>
                        </div>
                    </div>';
        return $message;
    }

}
