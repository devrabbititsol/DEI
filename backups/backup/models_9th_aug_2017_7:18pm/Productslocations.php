<?php

namespace app\models;

use Yii;
//use yii\base\Model;
use \yii\db\ActiveRecord as Model;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;

class Productslocations extends Model
{
    protected $id = 'location_id';

    public static function tableName()
    {
        return 'core_product_locations';
    }
    
              

}
