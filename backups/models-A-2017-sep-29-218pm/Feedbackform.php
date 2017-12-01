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
use app\models\Mail_settings;

class Feedbackform extends Model
{
    protected $id = 'feedback_id';

    public static function tableName()
    {
        return 'core_feedback_details';
    }
    
    //save feedback details
    public static function save_feedback_details($data)
    {
        try{
            $feedback_details['name'] = $data['name'];
            $feedback_details['email'] = $data['email'];
            $feedback_details['phone'] = $data['phone'];
            $feedback_details['message'] = $data['message'];

            //insert contact details to database table.
            Yii::$app->db->createCommand()->insert('core_feedback_details', $feedback_details)->execute();
            //send mail to admin
            $subject="New Feedback | BIG EQUIPMENTS INDIA";
            //get message for this mail
            $message = Mail_settings::get_feedback_message_to_admin($data);

            $email = Yii::$app->params['ADMIN_EMAIL'];

            //function to send email
            Mail_settings::send_email_notification($email,$subject,$message);
            return "SUCCESS";
        } catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
        }
        
    }
    
    //Select all feedback details
    public static function select_all_feedbacks()
    {
        $query = new Query;
        return $query->select('*')->from('core_feedback_details')->orderBy(['core_feedback_details.date_created' => SORT_DESC])->All();
    }
    
    //Select feedback details by id
    public static function get_feedback_by_id($id) {
        $query = new Query;
        return $query->select('*')->from('core_feedback_details')->where('core_feedback_details.feedback_id = ' . $id)->one();
    }
    
    //Update contact details by status & id
    public static function update_feedback_by_status_id($status,$feedback_id)
    {
        $query = new Query;
        
        $result = $query->createCommand()->update('core_feedback_details', ['feedback_status' => $status], 'feedback_id = "'.$feedback_id.'"')->execute();

       if ($result == 1) {
            return "Status Changed Successfully.";
        } else {
            return "Status Change Failed.";
        }
    }
    
}
