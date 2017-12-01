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
use app\models\User;

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
            $get_quote['date_created'] = date('Y-m-d H:i:s');
            $get_quote['quote_status'] = 0;
            $get_quote['capacity_requested'] = $data['capacity_requested'].' '.$data['capacity_metric'];
            
            if($get_quote['duration_type'] == '')
                unset($get_quote['duration_type']);
                
            unset($get_quote['_csrf']);
            unset($get_quote['capacity_metric']);
            //save quote data
            Yii::$app->db->createCommand()->insert('core_quotation', $get_quote)->execute();
            //send mail to user
            $subject="Big Equipments India | Quotation Enquiry";
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
    
    //get all quotes
    public static function get_all_quotes()
    {
        $query = new Query;
        $quote = $query->select(['core_quotation.*','core_product_categories.category_name','core_product_sub_categories.sub_category_name','core_users.user_name as employee_name','status_users.user_name as status_updated_by'])
                    ->from('core_quotation')
                    ->innerJoin('core_product_categories', 'core_product_categories.category_id=core_quotation.category_id')
                    ->innerJoin('core_product_sub_categories', 'core_product_sub_categories.sub_category_id=core_quotation.sub_category_id')  
                    ->leftJoin('core_users', 'core_quotation.employee_id=core_users.user_id')
                    ->leftJoin('core_users as status_users', 'core_quotation.status_updated_by=status_users.user_id');
        $session = Yii::$app->session;
        $role_details = $session->get('role');
        if($role_details['role_id'] != 2 && $role_details['role_id'] != 3 && $role_details['role_id'] != 8)//admin or superadmin or dataoperator
        {
            $userId = Yii::$app->user->id;
            $filteredemployees = array();
            $query = new Query;
            if($role_details['role_id'] == 4)//zonal manager
            {
                $underthiszoneusers = Yii::$app->db->createCommand("SELECT user_x_roles.user_id from user_x_roles where user_x_roles.user_zone_id IN (SELECT user_zone_id from user_x_roles where user_x_roles.user_id = $userId) GROUP BY user_id")->queryAll();
                foreach($underthiszoneusers as $employee_id) $filteredemployees[] = $employee_id['user_id'];
                $quote = $quote->where(['core_quotation.employee_id' => $filteredemployees]); 
            }else if($role_details['role_id'] == 5)//state manager
            {
                $underthiszoneusers = Yii::$app->db->createCommand("SELECT user_x_roles.user_id from user_x_roles where user_x_roles.user_state_id IN (SELECT user_state_id from user_x_roles where user_x_roles.user_id = $userId) GROUP BY user_id")->queryAll();
                foreach($underthiszoneusers as $employee_id) $filteredemployees[] = $employee_id['user_id'];
                $quote = $quote->where(['core_quotation.employee_id' => $filteredemployees]); 
            }else if($role_details['role_id'] == 6)//district manager
            {
                $underthiszoneusers = Yii::$app->db->createCommand("SELECT user_x_roles.user_id from user_x_roles where user_x_roles.user_district_id IN (SELECT user_district_id from user_x_roles where user_x_roles.user_id = $userId) GROUP BY user_id")->queryAll();
                foreach($underthiszoneusers as $employee_id) $filteredemployees[] = $employee_id['user_id'];
                $quote = $quote->where(['core_quotation.employee_id' => $filteredemployees]); 
            }
            else if($role_details['role_id'] == 7)//sales executive
            {
                $quote = $quote->where("core_quotation.employee_id = $userId"); 
            }
            
        }
        return $quote = $quote->orderBy(['core_quotation.quotation_id' => SORT_DESC])->All();
    }
    
    public static function get_quote_details_by_id($quote_id)
    {
        $query = new Query;
        return $query->select(['core_quotation.*','core_product_categories.category_name','core_product_sub_categories.sub_category_name','core_users.user_name as employee_name','status_users.user_name as status_updated_by'])
                    ->from('core_quotation')
                    ->innerJoin('core_product_categories', 'core_product_categories.category_id=core_quotation.category_id')
                    ->innerJoin('core_product_sub_categories', 'core_product_sub_categories.sub_category_id=core_quotation.sub_category_id')  
                    ->leftJoin('core_users', 'core_quotation.employee_id=core_users.user_id')
                    ->leftJoin('core_users as status_users', 'core_quotation.status_updated_by=status_users.user_id')
                    ->where("core_quotation.quotation_id = $quote_id")
                    ->one();
    }
    
    public static function assign_quote($data)
    {
        return Yii::$app->db->createCommand("UPDATE core_quotation set employee_id =:employee_id,updated_by =:updated_by,date_updated =:date_updated where quotation_id=:quotation_id")
                    ->bindValue(':employee_id', $data['employee_id'])
                    ->bindValue(':updated_by', Yii::$app->user->id)
                    ->bindValue(':date_updated', date('Y-m-d H:i:s'))
                    ->bindValue(':quotation_id', $data['quotation_id'])
                    ->execute();
        
    }
    
    public static function update_quote_status($quote_id,$status)
    {
        try{
            $userId = Yii::$app->user->id;
            $date_updated = date('Y-m-d H:i:s');
            Yii::$app->db->createCommand()->update('core_quotation', ['quote_status' => $status,'status_updated_by' => $userId,'date_updated' => $date_updated], "quotation_id = '$quote_id'")->execute();
            return true;
        } catch (ErrorException $ex) {
            Yii::warning('Error while updating get quote status.');
            Yii::warning($ex->getMessage());
        }
    }

    public static function get_quotes_by_userid($userid)
    {
        $user_details = User::get_user_details_by_id($userid);
       
        $query = new Query;
        $quote = $query->select(['core_quotation.*','core_product_categories.category_name','core_product_sub_categories.sub_category_name','core_users.user_name as employee_name','status_users.user_name as status_updated_by'])
                    ->from('core_quotation')
                    ->innerJoin('core_product_categories', 'core_product_categories.category_id=core_quotation.category_id')
                    ->innerJoin('core_product_sub_categories', 'core_product_sub_categories.sub_category_id=core_quotation.sub_category_id') 
                    ->leftJoin('core_users', 'core_quotation.employee_id=core_users.user_id')
                    ->leftJoin('core_users as status_users', 'core_quotation.status_updated_by=status_users.user_id');
       
        return $quote = $quote->where("core_quotation.email = '$user_details->email'")->orWhere("core_quotation.phone = '$user_details->phone_number'")->orderBy(['core_quotation.quotation_id' => SORT_DESC])->All();
    }    
    public static function get_quotes_by_employeeid($employeeid)
    {
        $query = new Query;
        $quote = $query->select(['core_quotation.*','core_product_categories.category_name','core_product_sub_categories.sub_category_name','core_users.user_name as employee_name','status_users.user_name as status_updated_by'])
                    ->from('core_quotation')
                    ->innerJoin('core_product_categories', 'core_product_categories.category_id=core_quotation.category_id')
                    ->innerJoin('core_product_sub_categories', 'core_product_sub_categories.sub_category_id=core_quotation.sub_category_id')  
                    ->leftJoin('core_users', 'core_quotation.employee_id=core_users.user_id')
                    ->leftJoin('core_users as status_users', 'core_quotation.status_updated_by=status_users.user_id');
        $session = Yii::$app->session;
        $role_details = $session->get('role');
        $view_employee_role = Yii::$app->db->createCommand("SELECT user_x_roles.user_role_id from user_x_roles where user_x_roles.user_id = $employeeid")->queryAll();
        $view_employee_role = @$view_employee_role[0]['user_role_id'];
        $filteredemployees = array();
        if($role_details['role_id'] == 2 || $role_details['role_id'] == 3 || $role_details['role_id'] == 8)//admin or superadmin or dataoperator
        {
            if($view_employee_role == 4)//zonal manager
            {
                $underthiszoneusers = Yii::$app->db->createCommand("SELECT user_x_roles.user_id from user_x_roles where user_x_roles.user_zone_id IN (SELECT user_zone_id from user_x_roles where user_x_roles.user_id = $employeeid) GROUP BY user_id")->queryAll();
                foreach($underthiszoneusers as $employee_id) $filteredemployees[] = $employee_id['user_id'];
                if(in_array($employeeid, $filteredemployees))
                {
                    if($view_employee_role == 7)
                        $quote = $quote->where(['core_quotation.employee_id' => $employeeid]); 
                    else
                        $quote = $quote->where(['core_quotation.employee_id' => $filteredemployees]); 
                }
                else
                {
                    return array();
                }

            }else if($view_employee_role == 5)//state manager
            {
                $underthiszoneusers = Yii::$app->db->createCommand("SELECT user_x_roles.user_id from user_x_roles where user_x_roles.user_state_id IN (SELECT user_state_id from user_x_roles where user_x_roles.user_id = $employeeid) GROUP BY user_id")->queryAll();
                foreach($underthiszoneusers as $employee_id) $filteredemployees[] = $employee_id['user_id'];
                if(in_array($employeeid, $filteredemployees))
                {
                    if($view_employee_role == 7)
                        $quote = $quote->where(['core_quotation.employee_id' => $employeeid]); 
                    else
                        $quote = $quote->where(['core_quotation.employee_id' => $filteredemployees]); 
}
                else
                {
                    return array();
                }
            }else if($view_employee_role == 6)//district manager
            {
                $underthiszoneusers = Yii::$app->db->createCommand("SELECT user_x_roles.user_id from user_x_roles where user_x_roles.user_district_id IN (SELECT user_district_id from user_x_roles where user_x_roles.user_id = $employeeid) GROUP BY user_id")->queryAll();
                foreach($underthiszoneusers as $employee_id) $filteredemployees[] = $employee_id['user_id'];
                if(in_array($employeeid, $filteredemployees))
                {
                    if($view_employee_role == 7)
                        $quote = $quote->where(['core_quotation.employee_id' => $employeeid]); 
                    else
                        $quote = $quote->where(['core_quotation.employee_id' => $filteredemployees]); 
                }
                else
                {
                    return array();
                }
            }else if($view_employee_role == 7)//sales executive
            {
                $quote = $quote->where(['core_quotation.employee_id' => $employeeid]); 
            }
            else
            {
                return array();
            }
        }
        else if($role_details['role_id'] == 4)//zonal manager
        {
            $underthiszoneusers = Yii::$app->db->createCommand("SELECT user_x_roles.user_id from user_x_roles where user_x_roles.user_zone_id IN (SELECT user_zone_id from user_x_roles where user_x_roles.user_id = $employeeid) GROUP BY user_id")->queryAll();
            foreach($underthiszoneusers as $employee_id) $filteredemployees[] = $employee_id['user_id'];
            if(in_array($employeeid, $filteredemployees))
            {
                if($view_employee_role == 7)
                    $quote = $quote->where(['core_quotation.employee_id' => $employeeid]); 
                else
                    $quote = $quote->where(['core_quotation.employee_id' => $filteredemployees]); 
            }
            else
            {
                return array();
            }
            
        }else if($role_details['role_id'] == 5)//state manager
        {
            $underthiszoneusers = Yii::$app->db->createCommand("SELECT user_x_roles.user_id from user_x_roles where user_x_roles.user_state_id IN (SELECT user_state_id from user_x_roles where user_x_roles.user_id = $employeeid) GROUP BY user_id")->queryAll();
            foreach($underthiszoneusers as $employee_id) $filteredemployees[] = $employee_id['user_id'];
            if(in_array($employeeid, $filteredemployees))
            {
                if($view_employee_role == 7)
                    $quote = $quote->where(['core_quotation.employee_id' => $employeeid]); 
                else
                    $quote = $quote->where(['core_quotation.employee_id' => $filteredemployees]); 
            }
            else
            {
                return array();
            }
        }else if($role_details['role_id'] == 6)//district manager
        {
            $underthiszoneusers = Yii::$app->db->createCommand("SELECT user_x_roles.user_id from user_x_roles where user_x_roles.user_district_id IN (SELECT user_district_id from user_x_roles where user_x_roles.user_id = $employeeid) GROUP BY user_id")->queryAll();
            foreach($underthiszoneusers as $employee_id) $filteredemployees[] = $employee_id['user_id'];
            if(in_array($employeeid, $filteredemployees))
            {
                if($view_employee_role == 7)
                    $quote = $quote->where(['core_quotation.employee_id' => $employeeid]); 
                else
                    $quote = $quote->where(['core_quotation.employee_id' => $filteredemployees]); 
            }
            else
            {
                return array();
            }
        }
        return $quote = $quote->orderBy(['core_quotation.quotation_id' => SORT_DESC])->All();
    }

}
