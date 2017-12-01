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
        /*return $query->select(['core_post_ads.*','core_post_ads_images.ad_image_url'])
                    ->from('core_post_ads')
                    ->innerJoin('core_post_ads_images', 'core_post_ads_images.ad_id=core_post_ads.ad_id')
                    ->groupBy(['core_post_ads.ad_id'])
                    ->all();*/
        $result = $query->select(['core_post_ads.*','core_post_ads_images.ad_image_url','core_users.company_name'])
                    ->from('core_post_ads_images')
                    ->leftJoin('core_post_ads', 'core_post_ads.ad_id=core_post_ads_images.ad_id')
                    ->leftJoin('core_users', 'core_users.user_id=core_post_ads.user_id')
                    ->where("core_post_ads_images.ad_image_status = 1")//get activated ads only
                    ->andWhere(['>=','core_post_ads_images.ad_image_expire',date("Y-m-d H:i:s")])
                    //->groupBy(['core_post_ads.ad_id'])
                    ->all();
					
        foreach ($result as $key => $value) {
            list($ad_width, $ad_height) = @getimagesize($value['ad_image_url']);
            $result[$key]['ad_width'] = $ad_width;
            $result[$key]['ad_height'] = $ad_height;
        }

        return $result;
    }
    
    //insert ad form data to database table.
    /*public static function insert_facebook_post($data)
    {
        $err = array();

        $target_path = "uploads/";

        $all_files = array();

        $gallery1 = '';
        
        //check for image size and upload files
        for ($i = 0; isset($_FILES['post_file']['name'][$i]); $i++) {
            
            $fileTmp = $_FILES['post_file']['tmp_name'][$i];
            $filename = $_FILES['post_file']['name'][$i];
            
            $parts = explode('.', $filename);
            $ext = $parts[sizeof($parts) - 1];
            if($ext=='jpg' || $ext == 'png' || $ext == 'jpeg' || $ext == 'gif')
            {
                list($w, $h) = getimagesize($fileTmp);
                if ($w >= 300 && $w <= 1400) {
                    if($h >= 300 && $h <= 360)
                    {
                        $fname = "fb_".rand(1, 10000) . time() . "." . $ext;
                        $all_files[] = $fname;
                        move_uploaded_file($fileTmp, $target_path . $fname);
                        if ($i == 0) {
                            $fbpostimg = Yii::$app->params['SITE_URL']. $target_path . $fname;
                        }
                    }
                    else
                        $err[] = $filename . " Image height must be between 300 px & 360 px";
                } else
                    $err[] = $filename . " Image width must be between 300 px & 1400 px";
            }
            else
                    $err[] = $filename . " Please upload images only";
        }

        //if all images size is fine.
        if(sizeof($err)==0){
            
            $insertad['ad_name'] = $data['name'];
            $insertad['user_id'] = Yii::$app->user->getId();
            $insertad['ad_title'] = $data['title'];
            $insertad['ad_weblink'] = $data['weblink'];
            $insertad['description'] = $data['comments'];
            if($data['advt_package'] == 0)
            {
                $adstatus = 0;
                $ad_expire = date("Y-m-d H:i:s", strtotime(Yii::$app->params['PROMOTIONAL_OFFER_UPTO']));
                $insertad['ad_expire'] = $ad_expire;
            }
            else
            {
                $adstatus = 1;
                $currentdate_timestamp = strtotime(date("Y-m-d H:i:s"));
                $ad_expire = date("Y-m-d H:i:s", strtotime($data['validity'], $currentdate_timestamp));
                $insertad['ad_expire'] = $ad_expire;
            }
            $insertad['ad_status'] = $adstatus;//change this when control panel complete
            $insertad['image_url'] = '';
            
            
            //insert ad to database table
            Yii::$app->db->createCommand()->insert('core_post_ads', $insertad)->execute();
            $ad_id = Yii::$app->db->getLastInsertID();
            
            //insert images related to that ad post.
            foreach($all_files as $index=>$image)
            {
                if($index>6) break;
                $insertimage = array();
                $insertimage['ad_id'] = $ad_id;
                $insertimage['ad_image_name'] = $image;
                $insertimage['ad_image_url'] = Yii::$app->params['SITE_URL'].'uploads/'.$image;
                $insertimage['ad_image_expire'] = $ad_expire;
                if($data['advt_package'] == 0)
                    $ad_image_status = 0;
                else
                    $ad_image_status = 1;
                
                $insertimage['ad_image_status'] = $ad_image_status;//change this when control panel complete

                Yii::$app->db->createCommand()->insert('core_post_ads_images', $insertimage)->execute();
                
                //if promotional offer selected we will post on fb wall without payment.
                if($data['advt_package'] == 0)
                {
                    //get facebook access tokens.
                    $fb_page_id = Yii::$app->params['FACEBOOK_PAGE_ID'];
                    $fb_access_token = Yii::$app->params['FACEBOOK_ACCESS_TOKEN'];

                    //post image to facebook wall
                    try{

                        //$fbdata['url'] = $fbpostimg;
                        $fbdata['url'] = $insertimage['ad_image_url'];
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
                
            }
         $response['err'] = $err;
         $response['ad_id'] = $ad_id;
         return $response;
        }
        else
        {
            $response['err'] = $err;
            return $response;
        }
    }*/
    
    //insert ad form data to database table.
    public static function insert_facebook_post($data)
    {
        $session = Yii::$app->session;
        $insertad['ad_name'] = $data['name'];
        $insertad['user_id'] = Yii::$app->user->getId();
        $insertad['ad_title'] = $data['title'];
        $insertad['ad_weblink'] = $data['weblink'];
        $insertad['description'] = $data['comments'];
        if ($data['advt_package'] == 0)//free package
        {
            $adstatus = 0;//Inactive status
            $ad_expire = date("Y-m-d H:i:s", strtotime(Yii::$app->params['PROMOTIONAL_OFFER_UPTO']));
            $insertad['ad_expire'] = $ad_expire;
        } else {
            $adstatus = 0;//Inactive status
            $currentdate_timestamp = strtotime(date("Y-m-d H:i:s"));
            $ad_expire = date("Y-m-d H:i:s", strtotime($data['validity'], $currentdate_timestamp));
            $insertad['ad_expire'] = $ad_expire;
        }
        $insertad['ad_status'] = $adstatus; //change this when control panel complete
        $insertad['image_url'] = '';


        //insert ad to database table
        Yii::$app->db->createCommand()->insert('core_post_ads', $insertad)->execute();
        $ad_id = Yii::$app->db->getLastInsertID();

        $all_files = $session->get('advt_images');

        //insert images related to that ad post.
        foreach ($all_files as $index => $image) {
            if ($index > 6)
                break;
            $insertimage = array();
            $insertimage['ad_id'] = $ad_id;
            $insertimage['ad_image_name'] = $image;
            $insertimage['ad_image_url'] = Yii::$app->params['SITE_URL'] . 'uploads/' . $image;
            $insertimage['ad_image_expire'] = $ad_expire;
            if ($data['advt_package'] == 0)//0=promotional
                $ad_image_status = 0;//initially Inactive
            else
                $ad_image_status = 0;//initially Inactive

            $insertimage['ad_image_status'] = $ad_image_status; //change this when control panel complete
            $insertimage['updated_by'] = Yii::$app->user->id;
            $insertimage['date_updated'] = date('Y-m-d H:i:s');

            Yii::$app->db->createCommand()->insert('core_post_ads_images', $insertimage)->execute();

            //if promotional offer selected we will post on fb wall without payment.
            if ($data['advt_package'] == 0)//0=promotional
                {
                //get facebook access tokens.
                $fb_page_id = Yii::$app->params['FACEBOOK_PAGE_ID'];
                $fb_access_token = Yii::$app->params['FACEBOOK_ACCESS_TOKEN'];

                //post image to facebook wall
                try {

                    //$fbdata['url'] = $fbpostimg;
                    $fbdata['url'] = $insertimage['ad_image_url'];
                    $fbdata['message'] = $data['title'] . ' ' . $data['weblink'];
                    $fbdata['access_token'] = $fb_access_token;
                    $post_url = 'https://graph.facebook.com/' . $fb_page_id . '/photos';
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
        }
        $response['err'] = array();
        $response['ad_id'] = $ad_id;
        return $response;
    }
    
    //delete ad by order id
    public static function delete_ad_by_id($data) {
        try{
            foreach ($data as $key => $val) $$key = get_magic_quotes_gpc() ? $val : addslashes($val);
            $status = 3; //for deleting the ad by changing status
            $userId = Yii::$app->user->id;
            $date_updated = date('Y-m-d H:i:s');

            $query = new Query;
            $count = $query->select('COUNT(*) as count')->from('core_post_ads')->where('user_id=:userId', [':userId' => $userId])->andWhere('ad_id=:ad_id', [':ad_id' => $ad_id])->All();

            if ($count[0]['count'] == 1) {
                $result = Yii::$app->db->createCommand("UPDATE core_post_ads_images set ad_image_status = $status,updated_by = $userId,date_updated = '$date_updated' where ads_image_id = $ad_image_id AND ad_id = $ad_id")->execute();
                        //->update('core_post_ads_images', ['ad_image_status' => $status], ["ads_image_id"=>$ad_image_id,"ad_id"=>$ad_id])->execute();
                if ($result == 1) {
                    return "SUCCESS";
                } else {
                    return "FAILED";
                }
            } else {
                return "FAILED";
            }
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
        }
        
    }
    
    //post advt on facebook wall
    public static function post_advt_on_facebook_wall($ad_id)
    {
        $query = new Query;
        $fbposts = $query->select('core_post_ads_images.ad_image_url','core_post_ads.title','core_post_ads.weblink')
                    ->from('core_post_ads_images')
                    ->leftJoin('core_post_ads', 'core_post_ads.ad_id=core_post_ads_images.ad_id')
                    ->where("core_post_ads_images.ad_id = $ad_id")
                    ->All();
        //get facebook access tokens.
        $fb_page_id = Yii::$app->params['FACEBOOK_PAGE_ID'];
        $fb_access_token = Yii::$app->params['FACEBOOK_ACCESS_TOKEN'];
        
        foreach($fbposts as $post)
        {
            //post image to facebook wall
            try{

                //$fbdata['url'] = $fbpostimg;
                $fbdata['url'] = $post['ad_image_url'];
                $fbdata['message'] = $post['title'].' '. $post['weblink'];
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
    }
    
    public static function update_status($ad_id,$status)
    {
        $userId = Yii::$app->user->id;
        $date_updated = date('Y-m-d H:i:s');
        
        $query = new Query;
        $query->createCommand()->update('core_post_ads', ['ad_status' => $status], 'ad_id = "' . $ad_id . '"')->execute();
        $query->createCommand()->update('core_post_ads_images', ['ad_image_status' => $status,'updated_by' => $userId,'date_updated' => $date_updated], 'ad_id = "' . $ad_id . '"')->execute();
        return true;
    }
    
    public static function get_ads_count()
    {
        /*
        $query = new Query;
        $count = $query->select('COUNT(*) as count')->from('core_post_ads_images')->All();
        return $count[0]['count'];*/
        $query = new Query;       
        $pending_ads_count = $query->select('COUNT(*) as count')->from('core_post_ads')->where('ad_status = 0')->All();
        $total_count['pending_ads_count']=$pending_ads_count[0]['count'];
       
        $query = new Query;
        $total_ads_count = $query->select('COUNT(*) as count')->from('core_post_ads')->All();
        $total_count['total_ads_count']=$total_ads_count[0]['count'];
       
        return $total_count;
    }
    
    public static function select_all_ad_details()
    {
        $query = new Query;
        $ads = $query->select('*')->from('core_post_ads')->All();
        return $ads;
    }
    
    public static function get_ad_by_id($ad_id)
    {
        $query = new Query;
        $ads = $query->select('*')->from('core_post_ads')->where("core_post_ads.ad_id = '".$ad_id."'")->one();
        return $ads;
    }
    
    public static function get_ad_images_by_id($ad_id)
    {
        $query = new Query;
        $ads = $query->select('*')->from('core_post_ads_images')->where("core_post_ads_images.ad_id = '".$ad_id."'")
                ->andWhere("core_post_ads_images.ad_image_status != '3'")
                ->All();
        return $ads;
    }
    
    public function update_ad_status($id,$type)
    {
        
        $query = new Query;

        $result = $query->createCommand()->update('core_post_ads', ['ad_status' => $type], 'ad_id = "'.$id.'"')->execute();
        
        $result2 = $query->createCommand()->update('core_post_ads_images', ['ad_image_status' => $type,'updated_by'=>Yii::$app->user->id,'date_updated' => date('Y-m-d H:i:s')], 'ad_id = "'.$id.'"')->execute();
        
        return $result2;
    }
    
    public function update_ad_image_status($id,$type)
    {
        
        $query = new Query;
        
        $result = $query->createCommand()->update('core_post_ads_images', ['ad_image_status' => $type,'updated_by'=>Yii::$app->user->id,'date_updated' => date('Y-m-d H:i:s')], 'ads_image_id = "'.$id.'"')->execute();
        
        return $result;
    }
    
    public static function update_facebook_post($data)
    {
        $session = Yii::$app->session;
        $insertad['ad_title'] = $data['title'];
        $insertad['ad_weblink'] = $data['weblink'];
        $insertad['description'] = $data['comments'];
        $ad_expire = date("Y-m-d H:i:s",strtotime($data['expire']));
        $insertad['ad_expire'] = $ad_expire;
        $insertad['image_url'] = '';
        $ad_id=$data['ad_id'];
        
        $insertad['updated_by'] = Yii::$app->user->id;
        $insertad['date_updated'] = date('Y-m-d H:i:s');
        
        //update ad to database table
        Yii::$app->db->createCommand()->update('core_post_ads', $insertad,"ad_id = $ad_id")->execute();
        
        $insertadimage['ad_image_expire'] = $ad_expire;
        
        $insertadimage['updated_by'] = Yii::$app->user->id; 
        $insertadimage['date_updated'] = date('Y-m-d H:i:s');
        
        Yii::$app->db->createCommand()->update('core_post_ads_images', $insertadimage,"ad_id = $ad_id")->execute();
       
        $all_files = $session->get('advt_images');

        //insert images related to that ad post.
    /*    foreach ($all_files as $index => $image) {
            if ($index > 6)
                break;
            $insertimage = array();
            $insertimage['ad_id'] = $ad_id;
            $insertimage['ad_image_name'] = $image;
            $insertimage['ad_image_url'] = Yii::$app->params['SITE_URL'] . 'uploads/' . $image;
            $insertimage['ad_image_expire'] = $ad_expire;
            if ($data['advt_package'] == 0)
                $ad_image_status = 0;
            else
                $ad_image_status = 1;

            $insertimage['ad_image_status'] = $ad_image_status; //change this when control panel complete
            $insertimage['updated_by'] = Yii::$app->user->id;
            $insertimage['date_updated'] = date('Y-m-d H:i:s');

            Yii::$app->db->createCommand()->insert('core_post_ads_images', $insertimage)->execute();

            //if promotional offer selected we will post on fb wall without payment.
            if ($data['advt_package'] == 0) {
                //get facebook access tokens.
                $fb_page_id = Yii::$app->params['FACEBOOK_PAGE_ID'];
                $fb_access_token = Yii::$app->params['FACEBOOK_ACCESS_TOKEN'];

                //post image to facebook wall
                try {

                    //$fbdata['url'] = $fbpostimg;
                    $fbdata['url'] = $insertimage['ad_image_url'];
                    $fbdata['message'] = $data['title'] . ' ' . $data['weblink'];
                    $fbdata['access_token'] = $fb_access_token;
                    $post_url = 'https://graph.facebook.com/' . $fb_page_id . '/photos';
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
        } */
        $response['err'] = array();
        $response['ad_id'] = $ad_id;
        return $response;
    }
    public static function assign_advertisement($data)
    {
        return Yii::$app->db->createCommand("UPDATE core_post_ads set employee_id =:employee_id,updated_by =:updated_by,date_updated =:date_updated where ad_id=:ad_id")
                    ->bindValue(':employee_id', $data['employee_id'])
                    ->bindValue(':updated_by', Yii::$app->user->id)
                    ->bindValue(':date_updated', date('Y-m-d H:i:s'))
                    ->bindValue(':ad_id', $data['ad_id'])
                    ->execute();
        
    }
}
