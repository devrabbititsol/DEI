<?php

namespace app\models;

use Yii;
//use yii\base\Model;
use \yii\db\ActiveRecord as Model;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\db\Query;

class Productmodel extends Model
{
    protected $id = 'model_id';

    public static function tableName()
    {
        return 'core_product_models';
    }
    
    //select all models by sub category id
    public static function select_models_by_sub_category_id($sub_category_id)
    {
        $query = new Query;
        return $query->select('*')->from('core_product_models')->where(["sub_category_id" => [$sub_category_id,'50']])->orderBy(['core_product_models.model_name' => SORT_ASC])->All();
        
    }     

}
