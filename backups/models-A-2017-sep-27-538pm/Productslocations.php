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
    
    public static function get_product_life_tax_details($product_tax_ids)
    {
        $tax_details = new Query;
        $tax_ids= explode(',',$product_tax_ids);
        $tax_regions = $tax_details->select(['region_name'])
                    ->from('core_regions')
                    ->where(['region_id' => $tax_ids])
                    ->all();
        $life_tax_details='';
        foreach($tax_regions as $index=>$region_name)
        {
            if($index==0)
                $life_tax_details = $region_name['region_name'];
            else
                $life_tax_details .= ', '.$region_name['region_name'];
        }
        
        return $life_tax_details;
    }
    
    public static function get_product_serving_locations($product_id)
    {
        $serving_details = new Query;
        return $serving_details = $serving_details->select(['core_product_locations.state','core_product_locations.country'])->from('core_product_locations')
                    ->where(['product_id' => $product_id])
                    ->andWhere(['location_type' => 2])
                    ->all();
    }
    
    public static function get_product_current_location($product_id)
    {
        $serving_details = new Query;
        return $serving_details = $serving_details->select(['core_product_locations.*'])->from('core_product_locations')
                    ->where(['product_id' => $product_id])
                    ->andWhere(['location_type' => 1])
                    ->one();
    }

}
