<?php

namespace app\models;

use Yii;
//use yii\base\Model;
use \yii\db\ActiveRecord as Model;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\db\Query;

class Roles extends Model
{
    protected $id = 'role_id';

    public static function tableName()
    {
        return 'core_user_roles';
    }
    
    //get product sub categories by category id
    public static function get_all_roles()
    {
        $query = new Query;
        return $query->select(['core_user_roles.*'])->from('core_user_roles')->All();
    }
    
    public static function select_all_roles()
    {
        $query = new Query;
        $roles = $query->select(['core_user_roles.*'])
                    ->from('core_user_roles')
                    ->where("core_user_roles.role_name != 'Public User'")
                    ->andWhere('core_user_roles.role_name != "Super Admin"')
                    ->all();
        return $roles;
    }
    
    public static function select_all_permissions()
    {
        $query = new Query;
        $permissions = $query->select(['core_permissions.*'])
                    ->from('core_permissions')->all();
        return $permissions;
    }
    
    public static function update_role_permissions($data)
    {
        $permissionKey=array();
        foreach($data as $key=>$val){
            $newKey = explode("_",$key)[2];
            if (isset($permissionKey[$newKey])){
                $permissionKey[$newKey] = $permissionKey[$newKey].",".$val;
            }else{
                $permissionKey[$newKey] = $val;
            }
        }
            
        $query = new Query;
        
        foreach ($permissionKey as $keys=>$values){    
            
        Yii::$app->db->createCommand("UPDATE core_user_roles SET permission_ids=:permission_ids WHERE role_id=:role_id")
            ->bindValue(':permission_ids', $values)
            ->bindValue(':role_id', $keys)
            ->execute();
        }
        
        return "Roles & Permissions Has Updated Successfully.";
    }
    public static function select_roles_by_id($id)
    {
        $query = new Query;
        $roles = $query->select(['core_user_roles.*'])
                    ->from('core_user_roles')
                    ->where("core_user_roles.role_id = '$id'")
                    ->one();
        return $roles;
    }
}
