<?php

namespace app\models;

use Yii;
//use yii\base\Model;
use \yii\db\ActiveRecord as Model;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\db\Query;

class Zones extends Model
{
    protected $id = 'zone_id';

    public static function tableName()
    {
        return 'core_zones';
    }
    
    //get product sub categories by category id
    public static function get_all_zones()
    {
        $query = new Query;
        return $query->select('*')->from('core_zones')->orderBy(['core_zones.zone_name' => SORT_ASC])->All();
    }
    
    public static function insert_new_zone($data)
    {
        try{
            $zone['zone_name'] = $data['zone_name'];
            $zone['zone_status'] = $data['zone_status'];
            $zone['created_by'] = Yii::$app->user->id;
            $zone['date_created'] = date('Y-m-d H:i:s');
            $zone['updated_by'] = Yii::$app->user->id;
            $zone['date_updated'] = date('Y-m-d H:i:s');
            Yii::$app->db->createCommand()->insert('core_zones', $zone)->execute();
            
            $response ['status'] = 200;
            $response ['message'] = "Zone created successfully.";
            return $response;
        } catch (ErrorException $ex) {
            Yii::warning('Error while creating new Zone.');
            Yii::warning($ex->getMessage());
            
            $response ['status'] = 400;
            $response ['message'] = "Error while creating new zone";
            return $response;
        }
        
    }
    
    public static function get_zone_by_id($zone_id)
    {
        $query = new Query;
        return $query->select('*')->from('core_zones')->where('zone_id = '.$zone_id)->one();
    }
    
    public static function update_zone($data)
    {
        try{
            //$zone['date_updated'] = date('Y-m-d H:i:s');
            Yii::$app->db->createCommand("UPDATE core_zones SET zone_name=:zone_name, zone_status=:zone_status, updated_by=:updated_by WHERE zone_id=:zone_id")
            ->bindValue(':zone_id', $data['zone_id'])
            ->bindValue(':zone_name', $data['zone_name'])
            ->bindValue(':zone_status', $data['zone_status'])
            ->bindValue(':updated_by', Yii::$app->user->id)
            ->execute();
            
            $response ['status'] = 200;
            $response ['message'] = "Zone updated successfully.";
            return $response;
        } catch (ErrorException $ex) {
            Yii::warning('Error while creating new Zone.');
            Yii::warning($ex->getMessage());
            
            $response ['status'] = 400;
            $response ['message'] = "Error while updating zone";
            return $response;
        }
        
    }
    
    //get zones list while creating employee based on roles
    public static function get_employee_zones($user_type=null)
    {
        $session = Yii::$app->session;
        $role_details = $session->get('role');
        
        if($role_details['role_id'] == 2 || $role_details['role_id'] == 3  || $role_details['role_id'] == 8)//super admin
        {
            if($user_type == 4)
            {
                $query = new Query;
                $alloted_zones = $query->select('GROUP_CONCAT(DISTINCT(user_zone_id)) as zone_id')->from('user_x_roles')->all();
                $zones = explode(',',$alloted_zones[0]['zone_id']);
                return $query->select('*')->from('core_zones')->where(['not in', 'zone_id', $zones])->andWhere('zone_status = 1')->orderBy(['core_zones.zone_name' => SORT_ASC])->All();
            }
            else
            {
                $query = new Query;
                return $query->select('*')->from('core_zones')->where('zone_status = 1')->orderBy(['core_zones.zone_name' => SORT_ASC])->All();
            }
        }
        else
        {
            $query = new Query;
            $current_user_zones = $query->select('GROUP_CONCAT(DISTINCT(user_zone_id)) as zone_id')->from('user_x_roles')
                                        ->where("user_x_roles.user_id =".Yii::$app->user->id)
                                        ->all();
            $zones = explode(',',$current_user_zones[0]['zone_id']);
            return $query->select('*')->from('core_zones')->where(['in', 'zone_id', $zones])->andWhere('zone_status = 1')->orderBy(['core_zones.zone_name' => SORT_ASC])->All();
        }
    }
    public static function get_all_active_zones() {
        $query = new Query;
        return $query->select('*')->from('core_zones')->where('zone_status = 1')->orderBy(['core_zones.zone_name' => SORT_ASC])->All();
    }
    public static function get_employee_by_zoneid($zone_id)
    {
        $query = new Query;
        return $query->select('*')->from('user_x_roles')->where('user_zone_id = '.$zone_id)->andWhere('user_state_id = 0')->one();
    }

}
