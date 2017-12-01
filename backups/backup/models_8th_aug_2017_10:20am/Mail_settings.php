<?php

namespace app\models;

use Yii;
//use yii\base\Model;
use \yii\db\ActiveRecord as Model;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;

class Mail_settings extends Model
{
    //message to send while otp request to email
    public function get_otp_message($otp)
    {
        $message="<p>Thanks for Registering with Digital Equipments India. Your OTP: <b>".$otp."</b></p>";
        return $message;
    }
    
    //message to send after new user registration
    public function get_registration_message()
    {
        $message="<p>Your Account Has Been Created Successfully.<br/>Please <a href='www.digitalequipmentsindia.com/login' target='_blank'>Click Here To Login</a> and view your account.<br/>";
        return $message;
    }
    
    //message to send to user after new product added.
    public function get_product_add_message($product_code)
    {
        $message="<p>Your Equipment with reference ID $product_code will Active Soon.";
        return $message;
    }
    
    //message to send to user who creates as order.
    public function get_order_add_message_to_user($order_code)
    {
        $message="<p>Thank you for Check Availbility Request at digitalequipmentsindia.com</p> <p>Reference ID: $order_code</p> <p>Please Login to portal to view more Info</p>";
        return $message;
    }
    
    //message to send to product owner after creating new order for that product.
    public function get_order_add_message_to_product_owner($order_code)
    {
        $message="Dear User,<p>Received a Check Availbility Request at digitalequipmentsindia.com</p> <p>Reference ID: $order_code</p> <p>Please Login to portal to view more Info</p>";
        return $message;
    }
    
    // message to send to admin after every new order creation
    public function get_order_add_message_to_admin($order_code)
    {
        $message="Dear Admin,<p>Received a Check Availbility Request at digitalequipmentsindia.com</p> <p>Reference ID: $order_code</p> <p>Please Login to Admin to view more Info</p>";
        return $message;
    }
    
    // message to send to admin while contact form request
    public function get_contact_message_to_admin($data)
    {
	foreach($data as $key=>$val) $$key=get_magic_quotes_gpc()?$val:addslashes($val);
        $message="Dear Admin,<p>Received a Contact Request at digitalequipmentsindia.com</p> <p>Contacted By :- $name <br/> Mobile No :- $phone <br/> Email Id :- $email </p><p> Message :- <br/> $message</p>";
        return $message;
    }
    
    //message to send to user who creates a new quotation.
    public function get_quote_message_to_user()
    {
        $message="<p>Thank You for your Interest. One of our representative will contact you soon.</p>";
        return $message;
    }
    
    //function to send all types to emails.
    public function send_email_notification($to_email,$subject,$message)
    {
        $message.="<p>Regards,<br>Digital Equipments India Team</p>";
        Yii::$app->mailer->compose()
                ->setFrom('info@digitalequipmentsindia.com')
                ->setTo($to_email)
                ->setSubject($subject)
                ->setHtmlBody($message)
                ->send();
        /* 

         
        $message.="<p>Regards,<br>Digital Equipments India Team</p>";

	$headers = "MIME-Version: 1.0" . "\r\n";

	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	$headers .= 'From: <info@digitalequipmentsindia.com>' . "\r\n";	

	@mail('basaveswar.allaka@devrabbit.com','hi',$message,$headers);
        */
        return true;
    }

}
