<?php

namespace app\models;

use Yii;
//use yii\base\Model;
use \yii\db\ActiveRecord as Model;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\db\Query;

class Territories extends Model
{
    protected $id = 'territory_id';

    public static function tableName()
    {
        return 'core_territories';
    }
    
    //get product sub categories by category id
    public static function get_all_territories()
    {
        $query = new Query;
        return $query->select(['core_territories.*','core_zones.zone_name','core_states.state_name','core_districts.district_name'])->from('core_territories')
                ->innerJoin('core_districts','core_territories.district_id = core_districts.district_id')
                ->innerJoin('core_states','core_districts.state_id = core_states.state_id')
                ->innerJoin('core_zones','core_states.zone_id = core_zones.zone_id')
                ->orderBy(['core_territories.territory_name' => SORT_ASC])->All();
    }
    
    public static function insert_new_territory($data)
    {
        try{
            $territory['territory_name'] = $data['territory_name'];
            $territory['territory_status'] = $data['territory_status'];
            $territory['district_id'] = $data['district_id'];
            $territory['state_id'] = $data['state_id'];
            $territory['zone_id'] = $data['zone_id'];
            $territory['created_by'] = Yii::$app->user->id;
            $territory['date_created'] = date('Y-m-d H:i:s');
            $territory['updated_by'] = Yii::$app->user->id;
            $territory['date_updated'] = date('Y-m-d H:i:s');
            Yii::$app->db->createCommand()->insert('core_territories', $territory)->execute();
            
            $response ['status'] = 200;
            $response ['message'] = "Territory created successfully";
            return $response;
        } catch (ErrorException $ex) {
            Yii::warning('Error while creating new Territory.');
            Yii::warning($ex->getMessage());
            
            $response ['status'] = 400;
            $response ['message'] = "Error while creating new Territory";
            return $response;
        }
        
    }
    
    public static function get_territory_by_id($territory_id)
    {
        $query = new Query;
        return $query->select(['core_territories.*','core_zones.zone_id','core_states.state_id'])->from('core_territories')
                ->innerJoin('core_districts','core_territories.district_id = core_districts.district_id')
                ->innerJoin('core_states','core_districts.state_id = core_states.state_id')
                ->innerJoin('core_zones','core_states.zone_id = core_zones.zone_id')
                ->where('territory_id = '.$territory_id)->one();
    }
    
    public static function update_territory($data)
    {
        try{
            //$zone['date_updated'] = date('Y-m-d H:i:s');
            Yii::$app->db->createCommand("UPDATE core_territories SET territory_name=:territory_name, territory_status=:territory_status, district_id=:district_id, state_id=:state_id, zone_id=:zone_id, updated_by=:updated_by WHERE territory_id=:territory_id")
            ->bindValue(':territory_id', $data['territory_id'])
            ->bindValue(':territory_name', $data['territory_name'])
            ->bindValue(':territory_status', $data['territory_status'])
            ->bindValue(':district_id', $data['district_id']) 
            ->bindValue(':state_id', $data['state_id']) 
            ->bindValue(':zone_id', $data['zone_id'])         
            ->bindValue(':updated_by', Yii::$app->user->id)
            ->execute();
            
            $response ['status'] = 200;
            $response ['message'] = "Territory updated successfully";
            return $response;
        } catch (ErrorException $ex) {
            Yii::warning('Error while updating Territory.');
            Yii::warning($ex->getMessage());
            
            $response ['status'] = 400;
            $response ['message'] = "Error while updating Territory";
            return $response;
        }
        
    }
    
    public static function get_territories_by_district_id($district_id,$user_type=null)
    {
        $district_ids = explode(',', $district_id);
        $query = new Query;
        if($user_type)
        {
            if($user_type == 7)
            {
            $alloted_zones = $query->select('GROUP_CONCAT(DISTINCT(user_territory_id)) as territory_id')->where(['in', 'user_district_id', $district_ids])->from('user_x_roles')->all();
            $territories = explode(',',$alloted_zones[0]['territory_id']);
            return $query->select('*')->from('core_territories')->where(['not in', 'territory_id', $territories])->andWhere(['in', 'district_id', $district_ids])->andWhere('territory_status = 1')->orderBy(['core_territories.territory_name' => SORT_ASC])->All();
            }
            else
            {
                return $query->select('*')->from('core_territories')
                    //->where('district_id = '.$district_id)
                    ->where(['in', 'district_id', $district_ids])
                    ->andWhere('territory_status = 1')->all();
            }
        }
        else
        {
        return $query->select('*')->from('core_territories')
                //->where('district_id = '.$district_id)
                ->where(['in', 'district_id', $district_ids])
                ->andWhere('territory_status = 1')->all();
        }
    }
    public static function get_employee_by_territoryid($territory_id)
    {
        $query = new Query;
        return $query->select('*')->from('user_x_roles')->where('user_territory_id = '.$territory_id)->one();
    }
}
