<?php

namespace app\models;

use Yii;
//use yii\base\Model;
use \yii\db\ActiveRecord as Model;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\db\Query;

class Comments extends Model
{
    protected $id = 'comment_id';

    public static function tableName()
    {
        return 'core_comments';
    }
    
    //get product sub categories by category id
    public static function get_comments_by_options($belongs_to,$comment_type)
    {
        $query = new Query;
        return $query->select(['core_comments.comment_description','core_comments.date_created','core_users.user_name'])->from('core_comments')
                ->innerJoin('core_users','core_comments.created_by = core_users.user_id')
                ->where('core_comments.comment_type = '.$comment_type)
                ->andWhere('core_comments.comment_belongs_to = '.$belongs_to)
                ->orderBy(['core_comments.comment_id' => SORT_DESC])->All();
    }
    
    public static function insert_new_comment($data)
    {
        try{
            $newcomment['comment_description'] = $data['comment_description'];
            $newcomment['comment_type'] = $data['comment_type'];
            $newcomment['comment_belongs_to'] = $data['comment_belongs_to'];
            $newcomment['created_by'] = Yii::$app->user->id;
            $newcomment['date_created'] = date('Y-m-d H:i:s');
            Yii::$app->db->createCommand()->insert('core_comments', $newcomment)->execute();
            
            $response ['status'] = 200;
            $response ['message'] = "Comment Added successfully.";
            return $response;
        } catch (ErrorException $ex) {
            Yii::warning('Error while creating new Comment.');
            Yii::warning($ex->getMessage());
            
            $response ['status'] = 400;
            $response ['message'] = "Error while creating new Comment";
            return $response;
        }
        
    }
    
    
}
