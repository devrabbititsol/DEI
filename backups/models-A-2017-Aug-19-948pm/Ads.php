<?php

namespace app\models;

use Yii;
//use yii\base\Model;
use \yii\db\ActiveRecord as Model;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\base\ErrorException;

class Ads extends Model
{
    protected $id = 'ad_id';

    public static function tableName()
    {
        return 'core_post_ads';
    }
    
    //get all ads posted by users.
    public static function select_all_ads()
    {
        $query = new Query;
        return $query->select(['core_post_ads.*','core_post_ads_images.ad_image_url'])
                    ->from('core_post_ads')
                    ->innerJoin('core_post_ads_images', 'core_post_ads_images.ad_id=core_post_ads.ad_id')
                    ->groupBy(['core_post_ads.ad_id'])
                    ->all();
    }
    
    //insert ad form data to database table.
    public static function insert_facebook_post($data)
    {
        $err = array();

        $target_path = "uploads/";

        $all_files = array();

        $gallery1 = '';
        
        //check for image size and upload files
        for ($i = 0; isset($_FILES['post_file']['name'][$i]); $i++) {
            $fileTmp = $_FILES['post_file']['tmp_name'][$i];
            $filename = $_FILES['post_file']['name'][$i];
            list($w, $h) = getimagesize($fileTmp);
            if ($w >= 1000) {
                $parts = explode('.', $filename);
                $ext = $parts[sizeof($parts) - 1];
                $fname = "fb_".rand(1, 10000) . time() . "." . $ext;
                $all_files[] = $fname;
                move_uploaded_file($fileTmp, $target_path . $fname);
                if ($i == 0) {
                    $fbpostimg = Yii::$app->params['SITE_URL']. $target_path . $fname;
                }
            } else
                $err[] = $filename . " Image width must be greater than or equal to 1000px";
        }

        //if all images size is fine.
        if(sizeof($err)==0){
            
            $insertad['ad_name'] = $data['name'];
            $insertad['user_id'] = Yii::$app->user->getId();
            $insertad['ad_title'] = $data['title'];
            $insertad['ad_weblink'] = $data['weblink'];
            $insertad['description'] = $data['comments'];
            $insertad['ad_status'] = 0;
            $insertad['image_url'] = '';
            $currentdate_timestamp = strtotime(date("Y-m-d"));
            $ad_expire = date("Y-m-d", strtotime("+2 month", $currentdate_timestamp));
            $insertad['ad_expire'] = $ad_expire;
            
            //insert ad to database table
            Yii::$app->db->createCommand()->insert('core_post_ads', $insertad)->execute();
            $ad_id = Yii::$app->db->getLastInsertID();
            
            //insert images related to that ad post.
            foreach($all_files as $image)
            {
                $insertimage['ad_id'] = $ad_id;
                $insertimage['ad_image_name'] = $image;
                $insertimage['ad_image_url'] = Yii::$app->params['SITE_URL'].'uploads/'.$image;
                $insertimage['ad_image_expire'] = $ad_expire;

                Yii::$app->db->createCommand()->insert('core_post_ads_images', $insertimage)->execute();
                
                //get facebook access tokens.
                $fb_page_id = Yii::$app->params['FACEBOOK_PAGE_ID'];
                $fb_access_token = Yii::$app->params['FACEBOOK_ACCESS_TOKEN'];

                //post image to facebook wall
                try{
                    
                    //$fbdata['url'] = $fbpostimg;
                    $fbdata['url'] = Yii::$app->params['SITE_URL'].'uploads/'.$image;
                    $fbdata['message'] = $data['title'].' '. $data['weblink'];
                    $fbdata['access_token'] = $fb_access_token;
                    $post_url = 'https://graph.facebook.com/'.$fb_page_id.'/photos';
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $post_url);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $fbdata);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $return = curl_exec($ch);
                    curl_close($ch);
                } catch (ErrorException $ex) {
                    Yii::warning($ex->getMessage());
                }
                
            }
         return $err;
        }
        else
        {
            return $err;
        }
    }
    
    //delete ad by order id
    public static function delete_ad_by_id($data) {
        foreach ($data as $key => $val)
            $$key = get_magic_quotes_gpc() ? $val : addslashes($val);
        $status = '2'; //for closing the ad by changing status
        $userId = Yii::$app->user->id;

        $query = new Query;
        $count = $query->select('COUNT(*) as count')->from('core_post_ads')->where('user_id=:userId', [':userId' => $userId])->andWhere('ad_id=:ad_id', [':ad_id' => $ad_id])->All();

        if ($count[0]['count'] == 1) {
            $result = $query->createCommand()->update('core_post_ads', ['ad_status' => $status], 'ad_id = "' . $ad_id . '"')->execute();
            if ($result == 1) {
                return "SUCCESS";
            } else {
                return "FAILED";
            }
        } else {
            return "FAILED";
        }
    }
    

}
