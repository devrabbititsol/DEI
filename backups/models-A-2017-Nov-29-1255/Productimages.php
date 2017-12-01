<?php

namespace app\models;

use Yii;
//use yii\base\Model;
use \yii\db\ActiveRecord as Model;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\db\Query;

class Productimages extends Model
{
    protected $id = 'product_image_id';

    public static function tableName()
    {
        return 'core_product_images';
    }
    
    public static function get_product_images($product_id)
    {
        $product_images = new Query;
        return $product_images = $product_images->select('*')->from('core_product_images')->where(['product_id' => $product_id])->andWhere(['image_status' => 1])->all();
    }
    
    public static function delete_product_image($product_image_id)
    {
        $query = Yii::$app->db;
        return $query->createCommand()->update('core_product_images', ['image_status' => 2], "product_image_id = '$product_image_id'")->execute();
    }
}
