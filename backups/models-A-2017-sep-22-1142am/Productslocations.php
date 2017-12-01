<?php

namespace app\models;

use Yii;
//use yii\base\Model;
use \yii\db\ActiveRecord as Model;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\db\Query;

class Productslocations extends Model
{
    protected $id = 'location_id';

    public static function tableName()
    {
        return 'core_product_locations';
    }
    
    //get all product in services block for home page
    public static function get_all_current_locations()
    {
        $query = new Query;
        $services = $query->select(['core_product_locations.*'])
                    ->from('core_product_locations')
                    ->innerJoin('core_products', 'core_products.product_id=core_product_locations.product_id')
                    ->where('core_product_locations.location_type = 1')
                    ->andWhere("core_products.product_status = 1")
                    ->andWhere(['>=','core_products.product_expires_on',date("Y-m-d")])
                    ->groupBy(['core_product_locations.product_id'])
                    ->all();
        return $services;
    }          

}
