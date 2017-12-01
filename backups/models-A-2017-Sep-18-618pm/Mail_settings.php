<?php

namespace app\models;

use Yii;
//use yii\base\Model;
use \yii\db\ActiveRecord as Model;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\db\Query;

class Mail_settings extends Model
{
    //message to send while otp request to email
    public function get_otp_message($otp,$user_name)
    {
        $message="Dear $user_name <p>Thanks for Registering with Digital Equipments India. Your OTP: <b>".$otp."</b></p>";
        return $message;
    }
    
    //message to send while forgot otp request to email
    public function get_forgot_otp_message($otp,$user_name)
    {
        $message="Dear $user_name <p>Thank you for contacting about your forgotten password. Your OTP: <b>".$otp."</b></p>";
        return $message;
    }
    
    //message to send after new user registration
    public function get_registration_message()
    {
        $message="<p>Your Account Has Been Created Successfully.<br/>Please <a href='www.digitalequipmentsindia.com/login' target='_blank'>Click Here To Login</a> and view your account.<br/>";
        return $message;
    }
    
    //message to send to user after new product added.
    public function get_product_add_message($product_code,$product_id)
    {
        $user = Yii::$app->user->identity; 
        $message="Dear ".@$user->user_name." <p>Thank you for registering with DEI. Your Equipment ID is: <a href='".Yii::$app->params['SITE_URL']."products?product_id=$product_id' style='color: red;'>$product_code</a> will Active Soon.";
        return $message;
    }
    
    //message to send to user who creates as order.
    public function get_order_add_message_to_user($data,$manual_order_code)
    {
        $product_details = $data['product_details'];
        $order_owner_details = $data['order_owner_details'];
        
        $message="Dear ".$order_owner_details->user_name.",<p>Thank you for your enquiry on our website, Your order ID is: $manual_order_code regarding the following equipment</p> "
                . "<br/>Equipment ID: <a href='".Yii::$app->params['SITE_URL']."products?product_id=".$product_details['product_id']."' style='color: red;'>".$product_details['manual_product_code']."</a>"
                . "<br/>Category: ".$product_details['category_name']
                . "<br/>Sub-Category: ".$product_details['sub_category_name']
                . "<br/>Model: ".$product_details['model_name']
                . "<br/>Capacity: ".$product_details['capacity']
                . "<p>One of our representatives will contact you soon</p> ";
        return $message;
    }
    
    //message to send to product owner after creating new order for that product.
    public function get_order_add_message_to_product_owner($data)
    {
        $product_details = $data['product_details'];
        $product_owner_details = $data['product_owner_details'];
        
        $message="Dear ".$product_owner_details->user_name.",<p>This is to inform you that we have received an enquiry regarding your equipment that you posted on our website.</p> "
                . "<br/>Equipment ID: <a href='".Yii::$app->params['SITE_URL']."products?product_id=".$product_details['product_id']."' style='color: red;'>".$product_details['manual_product_code']."</a>"
                . "<br/>Category: ".$product_details['category_name']
                . "<br/>Sub-Category: ".$product_details['sub_category_name']
                . "<br/>Model: ".$product_details['model_name']
                . "<br/>Capacity: ".$product_details['capacity'];
        return $message;
    }
    
    // message to send to admin after every new order creation
    public function get_order_add_message_to_admin($data)
    {
        $product_details = $data['product_details'];
        $product_owner_details = $data['product_owner_details'];
        $order_owner_details = $data['order_owner_details'];
        $order_details = $data['order_details'];
        $message="Dear Admin,<p>Received a Check Availbility Request at digitalequipmentsindia.com</p>"
                . "<br/>Equipment ID: <a href='".Yii::$app->params['SITE_URL']."products?product_id=".$product_details['product_id']."' style='color: red;'>".$product_details['manual_product_code']."</a>"
                . "<br/>Category: ".$product_details['category_name']
                . "<br/>Sub-Category: ".$product_details['sub_category_name']
                . "<br/>Model: ".$product_details['model_name']
                . "<br/>Capacity: ".$product_details['capacity']
                . "<br/>Year of Manufacture: ".$product_details['manufacture_year'];
        
        $message .= "<br/><br/><br/>Name of Enquirer: ".$order_owner_details->user_name
                    . "<br/>Phone Number: ".$order_owner_details->phone_number
                    . "<br/>Email Address: ".$order_owner_details->email
                    . "<br/>Comments: ".$order_details['description'];
        
        $message .= "<br/><br/><br/>Supplier Name: ".$product_owner_details->user_name
                    . "<br/>Supplier Company: ".$product_owner_details->company_name
                    . "<br/>Supplier Phone Number: ".$product_owner_details->phone_number
                    . "<br/>Supplier Email Address: ".$product_owner_details->email;
        
        
        return $message;
    }
    
    // message to send to admin while contact form request
    public function get_contact_message_to_admin($data)
    {
	foreach($data as $key=>$val) $$key=get_magic_quotes_gpc()?$val:addslashes($val);
        $message="Dear Admin,<p>Received a Contact Request at digitalequipmentsindia.com</p> <p>Contacted By :- $name <br/> Mobile No :- $phone <br/> Email Id :- $email </p><p> Message :- <br/> $message</p>";
        return $message;
    }
    
    // message to send to admin while feedback form request
    public function get_feedback_message_to_admin($data)
    {
	foreach($data as $key=>$val) $$key=get_magic_quotes_gpc()?$val:addslashes($val);
        $message="Dear Admin,<p>Received a Feedback at digitalequipmentsindia.com</p> <p>Submitted By :- $name <br/> Mobile No :- $phone <br/> Email Id :- $email </p><p> Message :- <br/> $message</p>";
        return $message;
    }
    
    //message to send to user who creates a new quotation.
    public function get_quote_message_to_user($quoted_user)
    {
        
        $message="Dear .".$quoted_user['name']."<p>Greetings from DEI !</p><p>Thank you for your enquiry on our website. One of our representatives will contact you soon.</p>";
        return $message;
    }
    
    //message to send to admin who creates a new quotation.
    public function get_quote_message_to_admin($quote_details)
    {
        $category = new Query;
        $category = $category->select('category_name')->from('core_product_categories')->where("category_id = ".$quote_details['category_id'])->one();
        
        $subcategory = new Query;
        $subcategory = $subcategory->select('sub_category_name')->from('core_product_sub_categories')->where("sub_category_id = ".$quote_details['sub_category_id'])->one();
        
        
        /*
        if($quote_details['job_description'] == 'doit_yourself')
            $quote_details['job_description'] = 'self';
        */
        $message="Dear Admin<p>Got a new quote enquiry</p>"
                . "<p>"
                . "<strong>Purpose of Quote : </strong>".$quote_details['quotation_type']."<br/>"
                . "<strong>Category : </strong>".$category['category_name']."<br/>"
                . "<strong>Sub category : </strong>".$subcategory['sub_category_name']."<br/>"
                . "<strong>Location : </strong>".$quote_details['location']."<br/>"
                . "<strong>What Best Describes Your Job? : </strong>". str_replace('_', ' ', $quote_details['job_describes']) ."<br/>"
                . "<strong>Start Date : </strong>".$quote_details['start_date']."<br/>";
            if($quote_details['quotation_type']!='buy')
            {
                $message .="<strong>Duration : </strong>".$quote_details['duration']." ".$quote_details['duration_type']."<br/>";
            }
                $message .="<strong>Comments : </strong>".$quote_details['comments']."<br/>"
                . "<strong>Which Best Describes Your Job? : </strong>".str_replace('_', ' ', $quote_details['job_description'])."<br/>"
                . "</p>"
                . "<p>"
                . "<strong>Name : </strong>".$quote_details['name']."<br/>"
                . "<strong>Email : </strong>".$quote_details['email']."<br/>"
                . "<strong>Phone : </strong>".$quote_details['phone']."<br/>"
                . "</p>";
        return $message;
    }
    
    //function to send all types to emails.
    public function send_email_notification($to_email,$subject,$message)
    {
        $email_header = "<table style='border-bottom: solid 1px; width:100%;'><tr><td width='40%'><img src='http://digitalequipmentsindia.com/images/BEI_logo_header.png' width='200px'/></td><td style='width:'60%''>DIGITAL EQUIPMENTS INDIA<br/>The Logistics Revolution...<br/> <a href='digitalequipmentsindia.com'>www.digitalequipmentsindia.com</a></td></tr></table><br/>";
        
        $email_footer = "<p>Regards,<br>Digital Equipments India Team<br>+91-9246611422<br>info@digitalequipmentsindia.com</p>";
        
        $message=$email_header.$message.$email_footer;
        
        /*Yii::$app->mailer->compose()
                ->setFrom('info@digitalequipmentsindia.com')
                ->setTo($to_email)
                ->setSubject($subject)
                ->setHtmlBody($message)
                ->send();*/

	$headers = "MIME-Version: 1.0" . "\r\n";

	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	$headers .= 'From:Digital Equipments India <info@digitalequipmentsindia.com>' . "\r\n";	

	@mail($to_email,$subject,$message,$headers);
       
        return true;
    }

}
