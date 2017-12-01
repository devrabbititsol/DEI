<?php

namespace app\models;

use Yii;
//use yii\base\Model;
use \yii\db\ActiveRecord as Model;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\db\Query;

class Productcategory extends Model
{
    protected $id = 'category_id';

    public static function tableName()
    {
        return 'core_product_categories';
    }
    
    //select fieds by category id.
    public static function select_fields_by_category_id($category_id)
    {
        $query = new Query;
        return $query->select('*')->from('core_product_categories')->where("category_id = $category_id")->All();
        
    }

}
