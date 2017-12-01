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
            
            if($order_status == 'Success')
                $payment_status = 'Paid';
            else
                $payment_status = 'Not Paid';
            
            $response = json_encode($transaction_data);
            
            Yii::$app->db->createCommand()->update('core_payments', ['order_status'=>"$order_status",'failure_message' => "$failure_message",'bank_reference_number' => "$bank_ref_no",'amount_paid' => "$amount",'payment_status' => "$payment_status",'response' => "$response"], "tracking_id = '$tracking_id'")->execute();
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
    public static function get_total_amount()
    {
        $query = new Query;
        $amounts = $query->select(['SUM(amount_actual) as amount_actual','SUM(amount_paid) as amount_paid'])->from('core_payments')->All();
        return $amounts[0];
    }
   
    //Select all payment details
    public static function select_all_payments() {
        $query = new Query;
        return $query->select('*')->from('core_payments')->orderBy(['core_payments.created_on' => SORT_ASC])->All();
    }

    //Get payment details by id
    public static function get_payment_by_id($id) {
        $query = new Query;
        return $query->select('*')->from('core_payments')->where('core_payments.payment_id = ' . $id)->one();
    }

    //Get payment details by id
    public static function get_payments_by_userid($user_id) {
        $query = new Query;
        return $query->select('*')->from('core_payments')->where('core_payments.user_id = ' . $user_id)->orderBy(['core_payments.created_on' => SORT_DESC])->All();
    }

}
