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
    
            
    public static function select_amount_by_capacity($data)
    {
        $capacity=$data['capacity'];
        $category_id=$data['category_id'];
        $query = new Query;
        $result = $query->select('price')->from('core_product_capacity')->where("category_id = $category_id")->andWhere("values1 <= $capacity")->orderBy(['capacity_id' => SORT_DESC])->limit(1)->All();
        return json_encode($result[0]['price']);
        
    }

}
