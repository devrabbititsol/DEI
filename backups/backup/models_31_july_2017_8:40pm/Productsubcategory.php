<?php

namespace app\models;

use Yii;
//use yii\base\Model;
use \yii\db\ActiveRecord as Model;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\db\Query;

class Productsubcategory extends Model
{
    protected $id = 'sub_category_id';

    public static function tableName()
    {
        return 'core_product_sub_categories';
    }
    
    public static function select_by_category_id($category_id)
    {
        $query = new Query;
        return $query->select('*')->from('core_product_sub_categories')->where("category_id = $category_id")->All();
        
    }

}
