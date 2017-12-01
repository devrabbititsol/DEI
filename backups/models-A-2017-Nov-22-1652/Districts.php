<?php

namespace app\models;

use Yii;
//use yii\base\Model;
use \yii\db\ActiveRecord as Model;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\db\Query;

class Districts extends Model
{
    protected $id = 'district_id';

    public static function tableName()
    {
        return 'core_districts';
    }
    
    //get product sub categories by category id
    public static function get_all_districts()
    {
        $query = new Query;
        return $query->select(['core_districts.*','core_zones.zone_name','core_states.state_name'])->from('core_districts')
                ->innerJoin('core_states','core_districts.state_id = core_states.state_id')
                ->innerJoin('core_zones','core_states.zone_id = core_zones.zone_id')
                ->orderBy(['core_districts.district_name' => SORT_ASC])->All();
    }
    
    public static function insert_new_district($data)
    {
        try{
            $district['district_name'] = $data['district_name'];
            $district['district_status'] = $data['district_status'];
            $district['state_id'] = $data['state_id'];
            $district['zone_id'] = $data['zone_id'];
            $district['created_by'] = Yii::$app->user->id;
            $district['date_created'] = date('Y-m-d H:i:s');
            $district['updated_by'] = Yii::$app->user->id;
            $district['date_updated'] = date('Y-m-d H:i:s');
            Yii::$app->db->createCommand()->insert('core_districts', $district)->execute();
            
            $response ['status'] = 200;
            $response ['message'] = "District created successfully";
            return $response;
        } catch (ErrorException $ex) {
            Yii::warning('Error while creating new District.');
            Yii::warning($ex->getMessage());
            
            $response ['status'] = 400;
            $response ['message'] = "Error while creating new District";
            return $response;
        }
        
    }
    
    public static function get_district_by_id($district_id)
    {
        $query = new Query;
        return $query->select(['core_districts.*','core_zones.zone_id'])->from('core_districts')
                ->innerJoin('core_states','core_districts.state_id = core_states.state_id')
                ->innerJoin('core_zones','core_states.zone_id = core_zones.zone_id')
                ->where('district_id = '.$district_id)->one();
    }
    
    public static function update_district($data)
    {
        try{
            //$zone['date_updated'] = date('Y-m-d H:i:s');
            Yii::$app->db->createCommand("UPDATE core_districts SET district_name=:district_name, district_status=:district_status, state_id=:state_id, zone_id=:zone_id, updated_by=:updated_by WHERE district_id=:district_id")
            ->bindValue(':district_id', $data['district_id'])
            ->bindValue(':district_name', $data['district_name'])
            ->bindValue(':district_status', $data['district_status'])
            ->bindValue(':state_id', $data['state_id'])
            ->bindValue(':zone_id', $data['zone_id'])
            ->bindValue(':updated_by', Yii::$app->user->id)
            ->execute();
            
            $response ['status'] = 200;
            $response ['message'] = "District updated successfully";
            return $response;
        } catch (ErrorException $ex) {
            Yii::warning('Error while updating District.');
            Yii::warning($ex->getMessage());
            
            $response ['status'] = 400;
            $response ['message'] = "Error while updating District";
            return $response;
        }
        
    }
    
    public static function get_districts_by_state_id($state_id,$user_type=null)
    {
        $session = Yii::$app->session;
        $role_details = $session->get('role');
        $state_ids = explode(',', $state_id);
        $query = new Query;
        if($user_type)
        {
            if($role_details['role_id'] == 2 || $role_details['role_id'] == 3 || $role_details['role_id'] == 8)//super admin
            {
                if($user_type == 6)
                {
                $alloted_zones = $query->select('GROUP_CONCAT(DISTINCT(user_district_id)) as district_id')->where(['in', 'user_state_id', $state_ids])->from('user_x_roles')->all();
                $districts = explode(',',$alloted_zones[0]['district_id']);
                return $query->select('*')->from('core_districts')->where(['not in', 'district_id', $districts])->andWhere(['in', 'state_id', $state_ids])->andWhere('district_status = 1')->orderBy(['core_districts.district_name' => SORT_ASC])->All();
                }
                else
                {
                    return $query->select('*')->from('core_districts')
                        //->where('state_id = '.$state_id)
                        ->where(['in', 'state_id', $state_ids])
                        ->andWhere('district_status = 1')->all();
                }
            }
            else if($role_details['role_id'] == 4 || $role_details['role_id'] == 5)//Zonal Sales Manager or District Sales Manager
            {
                if($user_type == 6)//district sales manager creation
                {
                $alloted_zones = $query->select('GROUP_CONCAT(DISTINCT(user_district_id)) as district_id')->where(['in', 'user_state_id', $state_ids])->from('user_x_roles')->all();
                $districts = explode(',',$alloted_zones[0]['district_id']);
                return $query->select('*')->from('core_districts')->where(['not in', 'district_id', $districts])->andWhere(['in', 'state_id', $state_ids])->andWhere('district_status = 1')->orderBy(['core_districts.district_name' => SORT_ASC])->All();
                }
                else
                {
                    return $query->select('*')->from('core_districts')
                        //->where('state_id = '.$state_id)
                        ->where(['in', 'state_id', $state_ids])
                        ->andWhere('district_status = 1')->all();
                }
            }
            else if($role_details['role_id'] == 6)//District sales manager
            {
                
                $alloted_zones = $query->select('GROUP_CONCAT(DISTINCT(user_district_id)) as district_id')->where('user_id ='.Yii::$app->user->id)->from('user_x_roles')->all();
                $districts = explode(',',$alloted_zones[0]['district_id']);
                return $query->select('*')->from('core_districts')->where(['in', 'district_id', $districts])->andWhere('district_status = 1')->orderBy(['core_districts.district_name' => SORT_ASC])->All();
                
            }
            
        }
        else
        {
            return $query->select('*')->from('core_districts')
                    //->where('state_id = '.$state_id)
                    ->where(['in', 'state_id', $state_ids])
                    ->andWhere('district_status = 1')->all();
        }
    }
    public static function get_employee_by_districtid($district_id)
    {
        $query = new Query;
        return $query->select('*')->from('user_x_roles')->where('user_district_id = '.$district_id)->andWhere('user_territory_id = 0')->one();
    }
}
