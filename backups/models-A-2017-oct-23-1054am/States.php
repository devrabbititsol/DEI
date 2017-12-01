<?php

namespace app\models;

use Yii;
//use yii\base\Model;
use \yii\db\ActiveRecord as Model;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\db\Query;

class States extends Model
{
    protected $id = 'zone_id';

    public static function tableName()
    {
        return 'core_zones';
    }
    
    //get product sub categories by category id
    public static function get_all_states()
    {
        $query = new Query;
        return $query->select(['core_states.*','core_zones.zone_name'])->from('core_states')
                ->innerJoin('core_zones','core_states.zone_id = core_zones.zone_id')
                ->orderBy(['core_states.state_name' => SORT_ASC])->All();
    }
    
    public static function insert_new_state($data)
    {
        try{
            $state['state_name'] = $data['state_name'];
            $state['state_status'] = $data['state_status'];
            $state['zone_id'] = $data['zone_id'];
            $state['created_by'] = Yii::$app->user->id;
            $state['date_created'] = date('Y-m-d H:i:s');
            $state['updated_by'] = Yii::$app->user->id;
            $state['date_updated'] = date('Y-m-d H:i:s');
            Yii::$app->db->createCommand()->insert('core_states', $state)->execute();
            
            $response ['status'] = 200;
            $response ['message'] = "State created successfully.";
            return $response;
        } catch (ErrorException $ex) {
            Yii::warning('Error while creating new State.');
            Yii::warning($ex->getMessage());
            
            $response ['status'] = 400;
            $response ['message'] = "Error while creating new State";
            return $response;
        }
        
    }
    
    public static function get_state_by_id($state_id)
    {
        $query = new Query;
        return $query->select('*')->from('core_states')->where('state_id = '.$state_id)->one();
    }
    
    public static function update_state($data)
    {
        try{
            //$zone['date_updated'] = date('Y-m-d H:i:s');
            Yii::$app->db->createCommand("UPDATE core_states SET state_name=:state_name, state_status=:state_status, zone_id=:zone_id, updated_by=:updated_by WHERE state_id=:state_id")
            ->bindValue(':state_id', $data['state_id'])
            ->bindValue(':state_name', $data['state_name'])
            ->bindValue(':state_status', $data['state_status'])
            ->bindValue(':zone_id', $data['zone_id'])     
            ->bindValue(':updated_by', Yii::$app->user->id)
            ->execute();
            
            $response ['status'] = 200;
            $response ['message'] = "State updated successfully.";
            return $response;
        } catch (ErrorException $ex) {
            Yii::warning('Error while updating State.');
            Yii::warning($ex->getMessage());
            
            $response ['status'] = 400;
            $response ['message'] = "Error while updating State";
            return $response;
        }
    }
    public static function get_states_by_zone_id($zone_id,$user_type=null)
    {
        $session = Yii::$app->session;
        $role_details = $session->get('role');
        $zone_ids = explode(',', $zone_id);
        $query = new Query;
        if($user_type)
        {
            if($role_details['role_id'] == 2 || $role_details['role_id'] == 3 || $role_details['role_id'] == 8)//super admin
            {
                if($user_type == 5)//state sales manager creation
                {
                    $alloted_zones = $query->select('GROUP_CONCAT(DISTINCT(user_state_id)) as state_id')->where(['in', 'user_zone_id', $zone_ids])->from('user_x_roles')->all();
                    $states = explode(',',$alloted_zones[0]['state_id']);
                    return $query->select('*')->from('core_states')->where(['not in', 'state_id', $states])->andWhere(['in', 'zone_id', $zone_ids])->andWhere('state_status = 1')->orderBy(['core_states.state_name' => SORT_ASC])->All();
                }
                else
                {
                    return $query->select('*')->from('core_states')
                        //->where('zone_id = '.$zone_id)
                        ->where(['in', 'zone_id', $zone_ids])
                        ->andWhere('state_status = 1')->all();
                }
            }
            else if($role_details['role_id'] == 4)//Zonal Sales Manager
            {
                if($user_type == 5)//state sales manager creation
                {
                    $alloted_zones = $query->select('GROUP_CONCAT(DISTINCT(user_state_id)) as state_id')->where(['in', 'user_zone_id', $zone_ids])->from('user_x_roles')->all();
                    $states = explode(',',$alloted_zones[0]['state_id']);
                    return $query->select('*')->from('core_states')->where(['not in', 'state_id', $states])->andWhere(['in', 'zone_id', $zone_ids])->andWhere('state_status = 1')->orderBy(['core_states.state_name' => SORT_ASC])->All();
                }
                else
                {
                    return $query->select('*')->from('core_states')->Where(['in', 'zone_id', $zone_ids])->andWhere('state_status = 1')->orderBy(['core_states.state_name' => SORT_ASC])->All();
                }
            }
            else
            {
                $alloted_zones = $query->select('GROUP_CONCAT(DISTINCT(user_state_id)) as state_id')->where('user_id ='.Yii::$app->user->id)->from('user_x_roles')->all();
                $states = explode(',',$alloted_zones[0]['state_id']);
                return $query->select('*')->from('core_states')->where(['in', 'state_id', $states])->andWhere('state_status = 1')->orderBy(['core_states.state_name' => SORT_ASC])->All();
            }
        }
        else
        {
            return $query->select('*')->from('core_states')
                    //->where('zone_id = '.$zone_id)
                    ->where(['in', 'zone_id', $zone_ids])
                    ->andWhere('state_status = 1')->all();
        }
    }
    
    public static function get_employee_by_stateid($state_id)
    {
        $query = new Query;
        return $query->select('*')->from('user_x_roles')->where('user_state_id = '.$state_id)->andWhere('user_district_id = 0')->one();
    }
    
}
