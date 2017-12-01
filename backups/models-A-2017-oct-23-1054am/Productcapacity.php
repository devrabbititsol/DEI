<?php

namespace app\models;

use Yii;
//use yii\base\Model;
use \yii\db\ActiveRecord as Model;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\db\Query;

class Productcapacity extends Model
{
    protected $id = 'capacity_id';

    public static function tableName()
    {
        return 'core_product_capacity';
    }
    
    //select price need to paid by user while adding new product.        
    public static function select_amount_by_capacity($data)
    {
        $capacity=$data['capacity'];
        $category_id=$data['category_id'];
        $sub_category_id=$data['sub_category_id'];
        $query = new Query;
        $result =$query->select('price')->from('core_product_capacity');
        $result =$result->where("category_id = $category_id")->andWhere("sub_category_id = $sub_category_id")->andWhere("capacity_status = 2");
        
        $result =$result->andWhere("range_value <= $capacity")->orderBy(['capacity_id' => SORT_DESC]);
        
        $data =$result->limit(1)->All();
        return json_encode($data[0]['price']);
        
    }
    
    //select capacities by category and sub category.
    public static function select_capacity_by_options($data)
    {
        $category_id = $data['category_id'];
        $sub_category_id = $data['sub_category_id'];
        $query = new Query;
        $capacity = $query->select('capacity_name,range_value,capacity_range')->from('core_product_capacity');
        //add status
        $capacity = $capacity->where("capacity_status = 1");
        
        if($category_id != '')
        {
            $capacity = $capacity->andWhere("category_id = $category_id");
        }        
        if($sub_category_id != '')
        {
            $capacity = $capacity->andWhere("sub_category_id = $sub_category_id");
        }
        
        
        
        return $capacity = $capacity->groupBy(['core_product_capacity.capacity_id'])->orderBy(['core_product_capacity.capacity_id' => SORT_ASC])->All();
    }
    
    

}
