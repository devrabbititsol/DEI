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
    
    //get product sub categories by category id
    public static function select_by_category_id($category_id)
    {
        $query = new Query;
        return $query->select('*')->from('core_product_sub_categories')->where("category_id = $category_id")->andWhere("sub_category_status = 1")->orderBy(['core_product_sub_categories.sub_category_name' => SORT_ASC])->All();
    }
    
    //get sub category code by sub category id
    public static function get_sub_category_code_by_id($sub_category_id)
    {
        $query = new Query;
        $code = $query->select('code_name')->from('core_product_sub_categories')->where("sub_category_id = $sub_category_id")->All();
        return $code[0]['code_name'];
    }
}
