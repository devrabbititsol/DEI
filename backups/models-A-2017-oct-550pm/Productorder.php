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
use app\models\Products;
use yii\base\ErrorException;

class Productorder extends Model
{
    protected $id = 'order_id';

    public static function tableName()
    {
        return 'core_orders';
    }
    
    //insert new order details for multiple and single check availability
    public static function insert_new_order($data)
    {
        try{
            $product_ids = $data['product_id'];
            $product_ids = explode(',',"$product_ids");
            $unique_codes = array();
            foreach($product_ids as $product_id)
            {
                if($product_id == '') continue;
                $insertdata['from_date'] = date('Y-m-d H:i:s', strtotime($data['from_date']));
                if(isset($data['no_of_days']))
                {
                    /*$productquery = new Query;
                    $product_price_type = $productquery->select('price_type')->from('core_products')->where("product_id = $product_id")->All();
                    
                    if($product_price_type[0]['price_type'] == 1)
                        $range = " days";
                    else if($product_price_type[0]['price_type'] == 2)
                        $range = " months";*/
                    $range  = " ".$data['product_price_type'];

                    $insertdata['no_of_days'] = $data['no_of_days'];
                    $todate =strtotime("+".$data['no_of_days'].$range, strtotime($data['from_date']));
                    $insertdata['to_date'] = date('Y-m-d H:i:s', $todate);
                }
                else
                    $insertdata['no_of_days'] = 0;



                $insertdata['description'] = $data['description'];
                $insertdata['type'] = $data['type'];
                $insertdata['product_id'] = $product_id;
                $insertdata['order_status'] = 0;
                $insertdata['user_id'] = Yii::$app->user->getId(); //get current user id i.e., who is creating order.
                $insertdata['updated_by'] = Yii::$app->user->id;
                $insertdata['date_updated'] = date('Y-m-d H:i:s');
                
                //insert new order details to database table.
                Yii::$app->db->createCommand()->insert('core_orders', $insertdata)->execute();
                
                //get last insert order id
                $order_id = Yii::$app->db->getLastInsertID();

                //generate unique code for order and update
                
                $productdata = Products::get_product_by_id($product_id);
                
                $categories = array('1'=>'C','2'=>'D','3'=>'E','4'=>'G','5'=>'P');//C-crane,D-dumper,E-excavator,G-generator,P-piling rigs
                $manual_order_code = $categories[$productdata['category_id']];

                $subcategorycode = Productsubcategory::get_sub_category_code_by_id($productdata['sub_category_id']);
                $manual_order_code .= $subcategorycode;
                
                $capacity = substr($productdata['capacity'], 0, strrpos($productdata['capacity'], ' '));
                if(strlen($capacity)>4)
                    $manual_order_code .= substr($capacity, 0,4);
                else if(strlen($capacity)<=4)
                    $manual_order_code .= str_pad($capacity, 4, '0', STR_PAD_LEFT);

                $producttype = array('0'=>'X','1'=>'Y','2'=>'Z'); //H-hire,S-sale,B-both
                $manual_order_code .=$producttype[$insertdata['type']];

                $manual_order_code .= strtoupper(str_pad(dechex($order_id), 5, '0', STR_PAD_LEFT));
                
                //update unique order id in database table.
                Yii::$app->db->createCommand()->update('core_orders', ['manual_order_code' => $manual_order_code], "order_id = '$order_id'")->execute();
                array_push($unique_codes, $manual_order_code);

                //send message to product owner
                //$user_id = Products::select_user_id_by_product_id($product_id);
                //$user_email = User::select_user_email_by_id($user_id);
                $product_details = Products::get_product_by_id($product_id);
                $product_owner_details = User::get_user_details_by_id($product_details['user_id']);
                
                $data['product_details'] = $product_details;
                $data['product_owner_details'] = $product_owner_details;
                
                if($data['type'] == 0)
                    $subject="Big Equipments India | Enquiry for Hire";
                else if($data['type'] == 1)
                    $subject="Big Equipments India | Enquiry for Buy";
                
                $message = Mail_settings::get_order_add_message_to_product_owner($data);
                Mail_settings::send_email_notification($product_owner_details->email,$subject,$message);
                
                //send email to user who is created the order.
                $order_owner_details = User::get_user_details_by_id(Yii::$app->user->id);
                
                $data['order_owner_details'] = $order_owner_details;
                
                $subject="Big Equipments India | Your Equipment Request";
                $message = Mail_settings::get_order_add_message_to_user($data,$manual_order_code);
                Mail_settings::send_email_notification($order_owner_details->email,$subject,$message);
                
                $insertdata['manual_order_code'] = $manual_order_code;
                $data['order_details'] = $insertdata;// this variable holds what data we are using to create new order
                
                //send email to admin
                $email = Yii::$app->params['ADMIN_EMAIL'];
                
                if($data['type'] == 0)
                    $subject="Big Equipments India | Enquiry for Hire from Website";
                else if($data['type'] == 1)
                    $subject="Big Equipments India | Enquiry for Buy from Website";
                
                $message = Mail_settings::get_order_add_message_to_admin($data);
                Mail_settings::send_email_notification($email,$subject,$message);

            }

            
            $order_code = implode(',',$unique_codes);
            
            //message to display to user after creating order.
            $message = '<div class="col-sm-12 col-md-12">
                            <div class="alert alert-success">
                                <span class="glyphicon glyphicon-ok"></span> <strong>Success</strong>
                                <hr class="message-inner-separator">
                                <p>
                                    Thank You, You can refer your order by following unique code(s) '.$order_code.'</p>
                            </div>
                        </div>';
            return $message;
            
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
        }
        
    }
    //delete order by order id
    public static function delete_order_by_id($data) {
        foreach ($data as $key => $val)
            $$key = get_magic_quotes_gpc() ? $val : addslashes($val);
        $status = '3';
        $userId = Yii::$app->user->id;
        $date_updated = date('Y-m-d H:i:s');

        $query = new Query;
        $count = $query->select('COUNT(*) as count')->from('core_orders')->where('user_id=:userId', [':userId' => $userId])->andWhere('order_id=:orderid', [':orderid' => $order_id])->All();

        if ($count[0]['count'] == 1) {
            $result = $query->createCommand()->update('core_orders', ['order_status' => $status,'updated_by' => $userId,'date_updated' => $date_updated], 'order_id = "' . $order_id . '"')->execute();
            if ($result == 1) {
                return "SUCCESS";
            } else {
                return "FAILED";
            }
        } else {
            return "FAILED";
        }
    }
    
    public static function get_orders_count($product_id=null)
    {
        if($product_id)
        {
            $query = new Query;
            $count = $query->select('COUNT(*) as count')->from('core_orders')->All();
            return $count[0]['count'];
        }
        else
        {
            $query = new Query;
            $pending_order_count = $query->select('COUNT(*) as count')->from('core_orders')->where('order_status = 0')->All();//pending orders count
            $total_count['pending_orders_count'] = $pending_order_count[0]['count'];

            $query = new Query;
            $count = $query->select('COUNT(*) as count')->from('core_orders')->All();//get all orders count
            $total_count['total_orders_count'] = $count[0]['count'];
            return $total_count;
            
        }
    }

    public static function get_orders($limit = null,$order_type = null)
    {
        $query = new Query;
        $orders = $query->select(['core_orders.*','core_product_categories.category_name','core_users.user_name as employee_name','status_users.user_name as status_updated_by'/*,'core_product_sub_categories.sub_category_name', 'core_product_models.model_name'*/])
                        ->from('core_orders')
                        ->innerJoin('core_products', 'core_orders.product_id=core_products.product_id')
                        ->innerJoin('core_product_categories', 'core_product_categories.category_id=core_products.category_id')
                        ->leftJoin('core_users', 'core_orders.employee_id=core_users.user_id')
                        ->leftJoin('core_users as status_users', 'core_orders.status_updated_by=status_users.user_id')
                        //->innerJoin('core_product_sub_categories', 'core_product_sub_categories.sub_category_id=core_products.sub_category_id')
                        //->innerJoin('core_product_models', 'core_product_models.model_id=core_products.model_id')
                        ;
        if($order_type != null)
        {
           
           $orders = $orders->where("core_orders.type = $order_type"); 
        }
        if($limit != null)
        {
            $orders = $orders->limit($limit);
        }
        return $orders = $orders->groupBy(['core_orders.order_id'])->orderBy(['core_orders.date_created' => SORT_DESC])->all();
    }
    
    public static function get_order_by_id($order_id)
    {
        $query = new Query;
        return $orders = $query->select(['core_orders.*'])
                        ->from('core_orders')
                        ->where("core_orders.order_id = $order_id")->one();
    }
    
    public static function get_orders_by_userid($userid)
    {
        $query = new Query;
        
        return $orders = $query->select(['core_orders.*','core_product_categories.category_name','core_users.user_name as employee_name','status_users.user_name as status_updated_by'/*,'core_product_sub_categories.sub_category_name', 'core_product_models.model_name'*/])
                        ->from('core_orders')
                        ->innerJoin('core_products', 'core_orders.product_id=core_products.product_id')
                        ->innerJoin('core_product_categories', 'core_product_categories.category_id=core_products.category_id')
                        ->leftJoin('core_users', 'core_orders.employee_id=core_users.user_id')
                        ->leftJoin('core_users as status_users', 'core_orders.status_updated_by=status_users.user_id')
                        ->where("core_orders.user_id = $userid")
                        ->groupBy(['core_orders.order_id'])->orderBy(['core_orders.date_created' => SORT_DESC])->all();
        
        /*$orders = $query->select(['core_orders.*','core_product_categories.category_name','core_product_sub_categories.sub_category_name', 'core_product_models.model_name'])
                        ->from('core_orders')
                        ->innerJoin('core_products', 'core_orders.product_id=core_products.product_id')
                        ->innerJoin('core_product_categories', 'core_product_categories.category_id=core_products.category_id')
                        ->innerJoin('core_product_sub_categories', 'core_product_sub_categories.sub_category_id=core_products.sub_category_id')
                        ->innerJoin('core_product_models', 'core_product_models.model_id=core_products.model_id')
                        ->where("core_orders.user_id = $userid");
        
        return $orders = $orders->groupBy(['core_orders.order_id'])->all();*/
    }
    public static function assign_order($data)
    {
        return Yii::$app->db->createCommand("UPDATE core_orders set employee_id =:employee_id,updated_by =:updated_by,date_updated =:date_updated where order_id=:order_id")
                    ->bindValue(':employee_id', $data['employee_id'])
                    ->bindValue(':updated_by', Yii::$app->user->id)
                    ->bindValue(':date_updated', date('Y-m-d H:i:s'))
                    ->bindValue(':order_id', $data['order_id'])
                    ->execute();
        
    }
    
    public static function update_order_status($order_id,$status)
    {
         try{
            $userId = Yii::$app->user->id;
            $date_updated = date('Y-m-d H:i:s');
            Yii::$app->db->createCommand()->update('core_orders', ['order_status' => $status,'status_updated_by' => $userId,'date_updated' => $date_updated], "order_id = '$order_id'")->execute();
            return true;
        } catch (ErrorException $ex) {
            Yii::warning('Error while updating product order status.');
            Yii::warning($ex->getMessage());
        }
    }
}
