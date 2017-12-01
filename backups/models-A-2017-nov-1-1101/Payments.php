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

class Payments extends Model
{
    protected $id = 'payment_id';

    public static function tableName()
    {
        return 'core_payments';
    }
    
    //insert new transaction details
    public static function insert_new_transaction($transaction_data)
    {
        try{
            Yii::$app->db->createCommand()->insert('core_payments', $transaction_data)->execute();
            return true;
            
        } catch (ErrorException $ex) {
            Yii::warning('Error while inserting new transaction details');
            Yii::warning($ex->getMessage());
            return false;
        }
        
    }
    
    //update transaction details
    public static function update_transaction($transaction_data)
    {
        try{
            foreach($transaction_data as $key=>$val) $$key=get_magic_quotes_gpc()?$val:addslashes($val);
            
            $query = new Query;
            $already_paid_amount = $query->select(['core_payments.amount_paid','core_payments.amount_actual','core_payments.payment_status','core_payments.payment_id','core_payments.user_id'])
                                    ->from('core_payments')
                                    ->where("core_payments.before_order_id = '$order_id'")
                                    ->one();
            
            if($order_status == 'Success')
            {
                if($amount >= $already_paid_amount['amount_actual'])
                {
                    $payment_status = 'Paid';
                }
                else
                {
                    $payment_status = 'Partially Paid';
                }
            }
            else
            {
                $payment_status = 'Not Paid';
            }
            
            $response = json_encode($transaction_data);
            Yii::$app->db->createCommand()->update('core_payments', ['order_status'=>"$order_status",'failure_message' => "$failure_message",'bank_reference_number' => "$bank_ref_no",'amount_paid' => "$amount",'payment_status' => "$payment_status",'response' => "$response"], "before_order_id = '$order_id'")->execute();
            
            $transaction_history = array();
            $transaction_history['payment_id'] = $already_paid_amount['payment_id'];
            $transaction_history['amount'] = $amount;
            $transaction_history['order_status'] = $order_status;
            $transaction_history['ccavenue_message'] = $failure_message;
            $transaction_history['bank_reference_number'] = $bank_ref_no;
            $transaction_history['before_order_id'] = $order_id;
            $transaction_history['ccavenue_response'] = $response;
            $transaction_history['date_created'] = date('Y-m-d H:i:s');
            $transaction_history['created_by'] = $already_paid_amount['user_id'];
            
            Yii::$app->db->createCommand()->insert('core_payment_history', $transaction_history)->execute();
            
            return true;
        } catch (ErrorException $ex) {
            Yii::warning('Error while updating transaction details');
            Yii::warning($ex->getMessage());
            return false;
        }
        
    }
    
    //update paynow transaction details
    public static function update_paynow_transaction($transaction_data)
    {
        try{
            foreach($transaction_data as $key=>$val) $$key=get_magic_quotes_gpc()?$val:addslashes($val);
            
            if (strpos($order_id, '#') !== false) {
                $order_id = substr($order_id, 0, strrpos($order_id, '#'));
            }
            $query = new Query;
            $already_paid_amount = $query->select(['core_payments.amount_paid','core_payments.amount_actual','core_payments.payment_status','core_payments.payment_id','core_payments.user_id'])
                                    ->from('core_payments')
                                    ->where("core_payments.before_order_id = '$order_id'")
                                    ->one();
            
            if($order_status == 'Success')
            {
                $paid_amount = $already_paid_amount['amount_paid'] + $amount;
                if($paid_amount >= $already_paid_amount['amount_actual'])
                {
                    $payment_status = 'Paid';
                }
                else
                {
                    $payment_status = 'Partially Paid';
                }
            }
            else
            {
                $payment_status = $already_paid_amount['payment_status'];
                $paid_amount = $already_paid_amount['amount_paid'];
            }
            
            $response = json_encode($transaction_data);
            Yii::$app->db->createCommand()->update('core_payments', ['order_status'=>"$order_status",'failure_message' => "$failure_message",'bank_reference_number' => "$bank_ref_no",'amount_paid' => "$paid_amount",'payment_status' => "$payment_status",'response' => "$response"], "before_order_id = '$order_id'")->execute();
            
            $transaction_history = array();
            $transaction_history['payment_id'] = $already_paid_amount['payment_id'];
            $transaction_history['amount'] = $amount;
            $transaction_history['order_status'] = $order_status;
            $transaction_history['ccavenue_message'] = $failure_message;
            $transaction_history['bank_reference_number'] = $bank_ref_no;
            $transaction_history['before_order_id'] = $order_id;
            $transaction_history['ccavenue_response'] = $response;
            $transaction_history['date_created'] = date('Y-m-d H:i:s');
            $transaction_history['created_by'] = $already_paid_amount['user_id'];
            
            Yii::$app->db->createCommand()->insert('core_payment_history', $transaction_history)->execute();
            
            return true;
        } catch (ErrorException $ex) {
            Yii::warning('Error while updating transaction details');
            Yii::warning($ex->getMessage());
            return false;
        }
        
    }
    
    //decrypt payment response params
    public static function decrypt_response($response)
    {
        $workingKey = Yii::$app->params['ccavenue_working_key']; //Shared by CCAVENUES
        $encResponse = $response["encResp"];
        $rcvdString = decrypt($encResponse, $workingKey);
        $order_status = "";
        $decryptValues = explode('&', $rcvdString);
        $dataSize = sizeof($decryptValues);
        $transaction_data = [];
        for ($i = 0; $i < $dataSize; $i++) {
            $information = explode('=', $decryptValues[$i]);
            $transaction_data[$information[0]] = $information[1];
        }
        return $transaction_data;
    }
    
    //get total amount
    public static function get_total_amount($payment_type = null)
    {
        $session = Yii::$app->session;
        $role_details = $session->get('role');
        if($role_details['role_id'] != 2 && $role_details['role_id'] != 3 && $role_details['role_id'] != 8)//admin or superadmin or dataoperator
        {
            $query = new Query;
            $amounts = $query->select(['SUM(amount_actual) as amount_actual','SUM(amount_paid) as amount_paid'])->from('core_payments');
            $userId = Yii::$app->user->id;
            $filteredemployees = array();
            $filteredids = array();
            if($role_details['role_id'] == 4)//zonal manager
            {
                $underthiszoneusers = Yii::$app->db->createCommand("SELECT user_x_roles.user_id from user_x_roles where user_x_roles.user_zone_id IN (SELECT user_zone_id from user_x_roles where user_x_roles.user_id = $userId) GROUP BY user_id")->queryAll();
                foreach($underthiszoneusers as $employee_id) $filteredemployees[] = $employee_id['user_id'];
                
                if(!empty($filteredemployees)) $filteredemployees = implode(',',$filteredemployees); else $filteredemployees = "''";
                if($payment_type == 1)
                {
                    $underthiszoneproductids = Yii::$app->db->createCommand("SELECT core_products.product_id from core_products where core_products.employee_id IN ($filteredemployees)")->queryAll();
                    //print_r($underthiszoneproductids);exit;
                    
                    foreach($underthiszoneproductids as $product_id) $filteredids[] = $product_id['product_id'];
                }
                else if($payment_type == 2)
                {
                    $underthiszoneadids = Yii::$app->db->createCommand("SELECT core_post_ads.ad_id from core_post_ads where core_post_ads.employee_id IN ($filteredemployees)")->queryAll();
                    foreach($underthiszoneadids as $ad_id) $filteredids[] = $ad_id['ad_id'];
                }
                $amounts = $amounts->where("payment_type = $payment_type")->andWhere(['core_payments.payment_for' => $filteredids]); 
            }else if($role_details['role_id'] == 5)//state manager
            {
                $underthiszoneusers = Yii::$app->db->createCommand("SELECT user_x_roles.user_id from user_x_roles where user_x_roles.user_state_id IN (SELECT user_state_id from user_x_roles where user_x_roles.user_id = $userId) GROUP BY user_id")->queryAll();
                foreach($underthiszoneusers as $employee_id) $filteredemployees[] = $employee_id['user_id'];
                
                if(!empty($filteredemployees)) $filteredemployees = implode(',',$filteredemployees); else $filteredemployees = "''";
                if($payment_type == 1)
                {
                    $underthiszoneproductids = Yii::$app->db->createCommand("SELECT core_products.product_id from core_products where core_products.employee_id IN ($filteredemployees)")->queryAll();
                    foreach($underthiszoneproductids as $product_id) $filteredids[] = $product_id['product_id'];
                }
                else if($payment_type == 2)
                {
                    $underthiszoneadids = Yii::$app->db->createCommand("SELECT core_post_ads.ad_id from core_post_ads where core_post_ads.employee_id IN ($filteredemployees)")->queryAll();
                    foreach($underthiszoneadids as $ad_id) $filteredids[] = $ad_id['ad_id'];
                }
                $amounts = $amounts->where("payment_type = $payment_type")->andWhere(['core_payments.payment_for' => $filteredids]); 
            }else if($role_details['role_id'] == 6)//district manager
            {
                $underthiszoneusers = Yii::$app->db->createCommand("SELECT user_x_roles.user_id from user_x_roles where user_x_roles.user_district_id IN (SELECT user_district_id from user_x_roles where user_x_roles.user_id = $userId) GROUP BY user_id")->queryAll();
                foreach($underthiszoneusers as $employee_id) $filteredemployees[] = $employee_id['user_id'];
                
                if(!empty($filteredemployees)) $filteredemployees = implode(',',$filteredemployees); else $filteredemployees = "''";
                if($payment_type == 1)
                {
                    $underthiszoneproductids = Yii::$app->db->createCommand("SELECT core_products.product_id from core_products where core_products.employee_id IN ($filteredemployees)")->queryAll();
                    foreach($underthiszoneproductids as $product_id) $filteredids[] = $product_id['product_id'];
                }
                else if($payment_type == 2)
                {
                    $underthiszoneadids = Yii::$app->db->createCommand("SELECT core_post_ads.ad_id from core_post_ads where core_post_ads.employee_id IN ($filteredemployees)")->queryAll();
                    foreach($underthiszoneadids as $ad_id) $filteredids[] = $ad_id['ad_id'];
                }
                $amounts = $amounts->where("payment_type = $payment_type")->andWhere(['core_payments.payment_for' => $filteredids]); 
            }
            else if($role_details['role_id'] == 7)//sales executive
            {
                $underthiszoneusers = Yii::$app->db->createCommand("SELECT user_x_roles.user_id from user_x_roles where user_x_roles.user_territory_id IN (SELECT user_territory_id from user_x_roles where user_x_roles.user_id = $userId) GROUP BY user_id")->queryAll();
                foreach($underthiszoneusers as $employee_id) $filteredemployees[] = $employee_id['user_id'];
                
                if(!empty($filteredemployees)) $filteredemployees = implode(',',$filteredemployees); else $filteredemployees = "''";
                if($payment_type == 1)
                {
                    $underthiszoneproductids = Yii::$app->db->createCommand("SELECT core_products.product_id from core_products where core_products.employee_id IN ($filteredemployees)")->queryAll();
                    foreach($underthiszoneproductids as $product_id) $filteredids[] = $product_id['product_id'];
                }
                else if($payment_type == 2)
                {
                    $underthiszoneadids = Yii::$app->db->createCommand("SELECT core_post_ads.ad_id from core_post_ads where core_post_ads.employee_id IN ($filteredemployees)")->queryAll();
                    foreach($underthiszoneadids as $ad_id) $filteredids[] = $ad_id['ad_id'];
                }
                $amounts = $amounts->where("payment_type = $payment_type")->andWhere(['core_payments.payment_for' => $filteredids]); 
            }
            $amounts = $amounts->orderBy(['core_payments.created_on' => SORT_DESC])->All();
            return $amounts[0];
        }
        else
        {
        $query = new Query;
        $amounts = $query->select(['SUM(amount_actual) as amount_actual','SUM(amount_paid) as amount_paid'])
                        //->where("core_payments.order_status != 'Initiated'")
                        ->where("core_payments.payment_type = $payment_type")
                        ->from('core_payments')->All();
        return $amounts[0];
        }
    }
   
    //Select all payment details
    public static function select_all_payments($payment_type = null) {
        $session = Yii::$app->session;
        $role_details = $session->get('role');
        if($role_details['role_id'] != 2 && $role_details['role_id'] != 3 && $role_details['role_id'] != 8)//admin or superadmin or dataoperator
        {
            $query = new Query;
            $payment = $query->select('*')->from('core_payments');
            $userId = Yii::$app->user->id;
            $filteredemployees = array();
            $filteredids = array();
            if($role_details['role_id'] == 4)//zonal manager
            {
                $underthiszoneusers = Yii::$app->db->createCommand("SELECT user_x_roles.user_id from user_x_roles where user_x_roles.user_zone_id IN (SELECT user_zone_id from user_x_roles where user_x_roles.user_id = $userId) GROUP BY user_id")->queryAll();
                foreach($underthiszoneusers as $employee_id) $filteredemployees[] = $employee_id['user_id'];
                
                if(!empty($filteredemployees)) $filteredemployees = implode(',',$filteredemployees); else $filteredemployees = "''";
                if($payment_type == 1)
                {
                    $underthiszoneproductids = Yii::$app->db->createCommand("SELECT core_products.product_id from core_products where core_products.employee_id IN ($filteredemployees)")->queryAll();
                    //print_r($underthiszoneproductids);exit;
                    
                    foreach($underthiszoneproductids as $product_id) $filteredids[] = $product_id['product_id'];
                }
                else if($payment_type == 2)
                {
                    $underthiszoneadids = Yii::$app->db->createCommand("SELECT core_post_ads.ad_id from core_post_ads where core_post_ads.employee_id IN ($filteredemployees)")->queryAll();
                    foreach($underthiszoneadids as $ad_id) $filteredids[] = $ad_id['ad_id'];
                }
                $payment = $payment->where("payment_type = $payment_type")->andWhere(['core_payments.payment_for' => $filteredids]); 
            }else if($role_details['role_id'] == 5)//state manager
            {
                $underthiszoneusers = Yii::$app->db->createCommand("SELECT user_x_roles.user_id from user_x_roles where user_x_roles.user_state_id IN (SELECT user_state_id from user_x_roles where user_x_roles.user_id = $userId) GROUP BY user_id")->queryAll();
                foreach($underthiszoneusers as $employee_id) $filteredemployees[] = $employee_id['user_id'];
                
                if(!empty($filteredemployees)) $filteredemployees = implode(',',$filteredemployees); else $filteredemployees = "''";
                if($payment_type == 1)
                {
                    $underthiszoneproductids = Yii::$app->db->createCommand("SELECT core_products.product_id from core_products where core_products.employee_id IN ($filteredemployees)")->queryAll();
                    foreach($underthiszoneproductids as $product_id) $filteredids[] = $product_id['product_id'];
                }
                else if($payment_type == 2)
                {
                    $underthiszoneadids = Yii::$app->db->createCommand("SELECT core_post_ads.ad_id from core_post_ads where core_post_ads.employee_id IN ($filteredemployees)")->queryAll();
                    foreach($underthiszoneadids as $ad_id) $filteredids[] = $ad_id['ad_id'];
                }
                $payment = $payment->where("payment_type = $payment_type")->andWhere(['core_payments.payment_for' => $filteredids]); 
            }else if($role_details['role_id'] == 6)//district manager
            {
                $underthiszoneusers = Yii::$app->db->createCommand("SELECT user_x_roles.user_id from user_x_roles where user_x_roles.user_district_id IN (SELECT user_district_id from user_x_roles where user_x_roles.user_id = $userId) GROUP BY user_id")->queryAll();
                foreach($underthiszoneusers as $employee_id) $filteredemployees[] = $employee_id['user_id'];
                
                if(!empty($filteredemployees)) $filteredemployees = implode(',',$filteredemployees); else $filteredemployees = "''";
                if($payment_type == 1)
                {
                    $underthiszoneproductids = Yii::$app->db->createCommand("SELECT core_products.product_id from core_products where core_products.employee_id IN ($filteredemployees)")->queryAll();
                    foreach($underthiszoneproductids as $product_id) $filteredids[] = $product_id['product_id'];
                }
                else if($payment_type == 2)
                {
                    $underthiszoneadids = Yii::$app->db->createCommand("SELECT core_post_ads.ad_id from core_post_ads where core_post_ads.employee_id IN ($filteredemployees)")->queryAll();
                    foreach($underthiszoneadids as $ad_id) $filteredids[] = $ad_id['ad_id'];
                }
                $payment = $payment->where("payment_type = $payment_type")->andWhere(['core_payments.payment_for' => $filteredids]); 
            }
            else if($role_details['role_id'] == 7)//sales executive
            {
                $underthiszoneusers = Yii::$app->db->createCommand("SELECT user_x_roles.user_id from user_x_roles where user_x_roles.user_territory_id IN (SELECT user_territory_id from user_x_roles where user_x_roles.user_id = $userId) GROUP BY user_id")->queryAll();
                foreach($underthiszoneusers as $employee_id) $filteredemployees[] = $employee_id['user_id'];
                
                if(!empty($filteredemployees)) $filteredemployees = implode(',',$filteredemployees); else $filteredemployees = "''";
                if($payment_type == 1)
                {
                    $underthiszoneproductids = Yii::$app->db->createCommand("SELECT core_products.product_id from core_products where core_products.employee_id IN ($filteredemployees)")->queryAll();
                    foreach($underthiszoneproductids as $product_id) $filteredids[] = $product_id['product_id'];
                }
                else if($payment_type == 2)
                {
                    $underthiszoneadids = Yii::$app->db->createCommand("SELECT core_post_ads.ad_id from core_post_ads where core_post_ads.employee_id IN ($filteredemployees)")->queryAll();
                    foreach($underthiszoneadids as $ad_id) $filteredids[] = $ad_id['ad_id'];
                }
                $payment = $payment->where("payment_type = $payment_type")->andWhere(['core_payments.payment_for' => $filteredids]); 
            }
            $payment = $payment->orderBy(['core_payments.created_on' => SORT_DESC])->All();
            
        }
        else
        {
            $query = new Query;
            $payment = $query->select('*')->from('core_payments')->where("core_payments.payment_type = $payment_type");
            $payment = $payment->orderBy(['core_payments.created_on' => SORT_DESC])->All();
                //->where("core_payments.order_status != 'Initiated'")
        }
        return $payment;
    }

    //Get payment details by id
    public static function get_payment_by_id($id) {
        $query = new Query;
        return $query->select('*')->from('core_payments')->where('core_payments.payment_id = ' . $id)
                //->andWhere("core_payments.order_status != 'Initiated'")
                ->one();
    }

    //Get payment details by id
    public static function get_payments_by_userid($user_id) {
        $query = new Query;
        return $query->select('*')->from('core_payments')->where('core_payments.user_id = ' . $user_id)->orderBy(['core_payments.created_on' => SORT_DESC])->All();
    }
    
    //update payment details from admin panel
    public static function update_payment_details($data)
    {
        try{
            $updateddata['amount_paid'] = $data['amount_paid'];
            $updateddata['payment_status'] = $data['payment_status'];
            $updateddata['billing_time'] = date('Y-m-d H:i:s', strtotime($data['billing_time']));
            $updateddata['updated_by'] = Yii::$app->user->id;
            $updateddata['date_updated'] = date('Y-m-d H:i:s');

            $payment_id = $data['payment_id'];

            //update data in database
            Yii::$app->db->createCommand()->update('core_payments', $updateddata, "payment_id = $payment_id")->execute();
            
            $response ['status'] = 200;
            $response ['message'] = "Payment updated successfully";
            return $response;
        } catch (ErrorException $ex) {
            Yii::warning('Error while updating payment details.');
            Yii::warning($ex->getMessage());
            
            $response ['status'] = 400;
            $response ['message'] = "Error while updating payment details";
            return $response;
        }
        
    }
    
    public static function get_payment_details_by_type($payment_type,$payment_for)
    {
         $query = new Query;
         if($payment_type == 1)//product
         {
            return $query->select(['core_payments.amount_actual','core_payments.amount_paid','core_payments.before_order_id','core_products.product_id','core_products.manual_product_code','core_products.product_expires_on','core_products.user_id'])
                ->from('core_payments')
                ->innerJoin('core_products', 'core_payments.payment_for=core_products.product_id')
                ->where("core_payments.payment_type = '$payment_type'")
                ->andWhere("core_payments.payment_for = '$payment_for'")
                ->one();
         }
         else if($payment_type == 2)//advt.
         {
            return $query->select(['core_payments.amount_actual','core_payments.amount_paid','core_payments.before_order_id','core_post_ads.ad_id','core_post_ads.ad_expire','core_post_ads.user_id'])
                ->from('core_payments')
                ->innerJoin('core_post_ads', 'core_payments.payment_for=core_post_ads.ad_id')
                ->where("core_payments.payment_type = '$payment_type'")
                ->andWhere("core_payments.payment_for = '$payment_for'")
                ->one();
         }
    }
    
    public static function generate_payment_request_link($data)
    {
        try{
            
            $payment_link_data = array();
            $payment_link_data['payment_secure_link_id'] = $data['payment_secure_link_id'];
            $payment_link_data['before_order_id'] = $data['before_order_id'];
            $payment_link_data['payment_type'] = $data['payment_type'];
            $payment_link_data['due_date'] = date("Y-m-d", strtotime($data['due_date'])).' 23:59:59';
            $payment_link_data['due_amount'] = $data['due_amount'];
            $payment_link_data['due_comments'] = $data['due_comments'];
            $payment_link_data['link_expire_date'] = date("Y-m-d", strtotime("+7 day")).' 23:59:59';
            $payment_link_data['date_created'] = date('Y-m-d H:i:s');
            $payment_link_data['created_by'] = Yii::$app->user->id;
            
            Yii::$app->db->createCommand()->insert('core_payments_link', $payment_link_data)->execute();
            
            $product_owner_details = User::get_user_details_by_id($data['owner_id']);
            
            $mail_info = array();
            $mail_info['owner_email'] = $product_owner_details->email;
            $mail_info['owner_name'] = $product_owner_details['user_name'];
            $mail_info['payment_link'] = Yii::$app->params['SITE_URL'].'makepaymentrequest?id='.$data['payment_secure_link_id'];
            $mail_info['manual_product_code'] =  $data['manual_product_code'];
            $mail_info['due_date'] =  $data['due_date'];
            $mail_info['due_amount'] =  $data['due_amount'];
            $mail_info['due_comments'] =  $data['due_comments'];
            
            if($data['payment_type'] == 1)
            {
                $subject="Big Equipments India | Product expiry alert";
                $message = Mail_settings::get_payment_request_for_product($mail_info);
            }
            else if($data['payment_type'] == 2)
            {
                $subject="Big Equipments India | Advertisement expiry alert";
                $message = Mail_settings::get_payment_request_for_advt($mail_info);
            }
            Mail_settings::send_email_notification($product_owner_details->email,$subject,$message);
            
            $response ['status'] = 200;
            $response ['message'] = "Payment link generated successfully.";
            return $response;
            
        } catch (ErrorException $ex) {
            Yii::warning('Error while generating payment link');
            Yii::warning($ex->getMessage());
            $response ['status'] = 400;
            $response ['message'] = "Error while generating payment link.";
            return $response;
        }
    }
    
    public static function check_payment_link_expire($payment_secure_link_id)
    {
        $query = new Query;
        $payment_link_details = $query->select('*')
                 ->from('core_payments_link')
                 ->where("payment_secure_link_id = '$payment_secure_link_id'")
                 ->andWhere(['>=','core_payments_link.link_expire_date',date("Y-m-d H:i:s")])
                 ->all();
        return $payment_link_details;
    }

}
