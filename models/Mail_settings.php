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
        $message="Dear $user_name <p>Thanks for Registering with Big Equipments India. Your OTP: <b>".$otp."</b></p>";
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
        $message="<p>Your Account Has Been Created Successfully.<br/>Please <a href='".Yii::$app->params['SITE_URL']."login' target='_blank'>Click Here To Login</a> and view your account.<br/>";
        return $message;
    }
    
    //message to send to user after new product added.
    public function get_product_add_message($product_code,$product_id)
    {
        $user = Yii::$app->user->identity; 
        $message="Dear ".@$user->user_name." <p>Thank you for registering with BEI. Your Equipment ID is: <a href='".Yii::$app->params['SITE_URL']."products?product_id=$product_id' style='color: red;'>$product_code</a> will Active Soon.";
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
        $message="Dear Admin,<p>Received a Check Availbility Request at bigequipmentsindia.com</p>"
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
        $message="Dear Admin,<p>Received a Contact Request at bigequipmentsindia.com</p> <p>Contacted By :- $name <br/> Mobile No :- $phone <br/> Email Id :- $email </p><p> Message :- <br/> $message</p>";
        return $message;
    }
    
    // message to send to admin while feedback form request
    public function get_feedback_message_to_admin($data)
    {
	foreach($data as $key=>$val) $$key=get_magic_quotes_gpc()?$val:addslashes($val);
        $message="Dear Admin,<p>Received a Feedback at bigequipmentsindia.com</p> <p>Submitted By :- $name <br/> Mobile No :- $phone <br/> Email Id :- $email </p><p> Message :- <br/> $message</p>";
        return $message;
    }
    
    //message to send to user who creates a new quotation.
    public function get_quote_message_to_user($quoted_user)
    {
        
        $message="Dear .".$quoted_user['name']."<p>Greetings from BEI !</p><p>Thank you for your enquiry on our website. One of our representatives will contact you soon.</p>";
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
                . "<strong>Capacity : </strong>".$quote_details['capacity']."<br/>"
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
    
    /*********************** CONTROLEPANEL EMAILS START *********************************/
    
    //function to send registration alert to employee
    public static function get_employee_registration_to_employee($employee_name)
    {
        $message="Dear $employee_name, <p>Your Account Has Been Created Successfully.<br/>Please <a href='".Yii::$app->params['SITE_URL']."admin/forgotpassword' target='_blank'>Click Here</a> to reset your password and view your account.<br/>";
        return $message;
    }
    
    //product expiration payment request message to user
    public static function get_payment_request_for_product($product_details)
    {
        $message = "Dear ".$product_details['owner_name'].",<p>This is to inform you that your Equipment that you have posted on our website has Payment Pending.</p>";
        $message = $message."Here are the details,<br>";
        $message = $message."Equipment Reference ID: ".$product_details['manual_product_code']."<br>";
        $message = $message."Amount pending : ". number_format($product_details['due_amount'],2)." INR<br>";
        $message = $message."Due Date : ".date("m-d-Y", strtotime($product_details['due_date']))."<br>";
        $message = $message."Payment Link : ".$product_details['payment_link']."<br>";
        $message = $message."Special Comments : ".$product_details['due_comments']."<br><br>";
        
        $message = $message."<p>Please pay the specified amount on or before due date so that your equipment will continue to display on our website to recieve enquiries.</p>";
        $message = $message."<p>You may also <a href='".Yii::$app->params['SITE_URL']."login'>Login</a> to your account and click on <strong>My Account</strong> to review further details of all equipments posted by you. Alternatively, you can also pay for your equipments by clicking on <b>Pay Now</b> button in my account tab.</p>";
        return $message;
    }
    //Advertisement expiration payment request message to user
    public static function get_payment_request_for_advt($product_details)
    {
        $message = "Dear ".$product_details['owner_name'].",<p>This is to inform you that your Advertisement that you have posted on our website has Payment Pending.</p>";
        $message = $message."Here are the details,<br>";
        $message = $message."Amount pending : ". number_format($product_details['due_amount'],2)." INR<br>";
        $message = $message."Due Date : ".date("m-d-Y", strtotime($product_details['due_date']))."<br>";
        $message = $message."Payment Link : ".$product_details['payment_link']."<br>";
        $message = $message."Special Comments : ".$product_details['due_comments']."<br><br>";
        
        $message = $message."<p>Please pay the specified amount on or before due date so that your Advertisement will continue to display on our website to recieve enquiries.</p>";
        $message = $message."<p>You may also <a href='".Yii::$app->params['SITE_URL']."login'>Login</a> to your account and click on <strong>My Account</strong> to review further details of all Advertisements posted by you. Alternatively, you can also pay for your equipments by clicking on <b>Pay Now</b> button in my account tab.</p>";
        return $message;
    }
    
    //Order payment request message to user
    public static function get_payment_request_for_order($order_details)
    {
        $message = "Dear ".$order_details['owner_name'].",<p>This is to inform you that we have successfully negotiated for the equipment that you had placed an enquiry for, Please pay the specified fees in order to recieve the work order and equipment.</p>";
        $message = $message."Here are the details,<br>";
        $message = $message."Order ID : ". $order_details['manual_order_code']."<br>";
        $message = $message."Amount pending : ". number_format($order_details['due_amount'],2)." INR<br>";
        $message = $message."Due Date : ".date("m-d-Y", strtotime($order_details['due_date']))."<br>";
        $message = $message."Payment Link : ".$order_details['payment_link']."<br>";
        $message = $message."Special Comments : ".$order_details['due_comments']."<br><br>";
        
        $message = $message."<p>Please pay the specified amount on or before due date so that we can proceed with the next steps.</p>";
        $message = $message."<p>You may also <a href='".Yii::$app->params['SITE_URL']."login'>Login</a> to your account and click on <strong>My Account</strong> to review further details of all your enquiries. Alternatively, you can also pay for your orders by clicking on <b>Pay Now</b> button in my account tab.</p>";
        return $message;
    }
    //Quote payment request message to user
    public static function get_payment_request_for_quote($quote_details)
    {
        $message = "Dear ".$quote_details['owner_name'].",<p>This is to inform you that we have successfully negotiated for the equipment that you had placed an enquiry for through our Get Quote utility, Please pay the specified fees in order to recieve the work order and equipment.</p>";
        $message = $message."Here are the details,<br>";
        $message = $message."Amount pending : ". number_format($quote_details['due_amount'],2)." INR<br>";
        $message = $message."Due Date : ".date("m-d-Y", strtotime($quote_details['due_date']))."<br>";
        $message = $message."Payment Link : ".$quote_details['payment_link']."<br>";
        $message = $message."Special Comments : ".$quote_details['due_comments']."<br><br>";
        
        $message = $message."<p>Please pay the specified amount on or before due date so that we can proceed with the next steps.</p>";
        $message = $message."<p>Please don't hesitate to call us if you have any questions.</p>";
        return $message;
    }
    /*********************** CONTROLEPANEL EMAILS END *********************************/
    
    
    //function to send all types to emails.
    public function send_email_notification($to_email,$subject,$message)
    {
        $email_header = "<table style='border-bottom: solid 1px; width:100%;'><tr><td width='40%'><img src='".Yii::$app->params['SITE_URL']."images/BEI_logo_header.png' width='200px'/></td><td style='width:'60%''>BIG EQUIPMENTS INDIA<br/>The Logistics Revolution...<br/> <a href='".Yii::$app->params['SITE_URL']."'>www.bigequipmentsindia.com</a></td></tr></table><br/>";
        
        $email_footer = "<p>Regards,<br>Big Equipments India Team<br>+91 89565 01234<br>".Yii::$app->params['ADMIN_EMAIL']."</p>";
        
        $message=$email_header.$message.$email_footer;
        
        /*Yii::$app->mailer->compose()
                ->setFrom('info@digitalequipmentsindia.com')
                ->setTo($to_email)
                ->setSubject($subject)
                ->setHtmlBody($message)
                ->send();*/

	$headers = "MIME-Version: 1.0" . "\r\n";

	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	$headers .= 'From:Big Equipments India <'.Yii::$app->params['ADMIN_EMAIL'].'>' . "\r\n";
        
        if($subject == "Big Equipments India | Product expiry alert" || $subject == "Big Equipments India | Advertisement expiry alert" || $subject == "Big Equipments India | Order amount request" || $subject == "Big Equipments India | Getquote amount request")
        {
            $headers .= 'Cc: support@bigequipmentsindia.com' . "\r\n";
        }

	@mail($to_email,$subject,$message,$headers);
        
        return true;
    }
    
    

}
