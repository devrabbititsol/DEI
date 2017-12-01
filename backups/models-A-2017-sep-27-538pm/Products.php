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
use app\models\User;
use app\models\Productsubcategory;

class Products extends Model
{
    protected $id = 'product_id';

    public static function tableName()
    {
        return 'core_products';
    }
    
    //select product count by category id
    public static function select_product_count_by_category_id($category_id=null)
    {
        try {
            $query = new Query;
            if($category_id != null)
            {
                $count = $query->select('COUNT(*) as count')->from('core_products')->where("category_id = $category_id")->andWhere("product_status = 1")->andWhere(['>=','core_products.product_expires_on',date("Y-m-d H:i:s")])->All();
                return $count[0]['count'];
                
            }else
            {
                $query = new Query;
                $pending_products_count = $query->select('COUNT(*) as count')->from('core_products')
                                ->where("product_status = 0")
                               //->andWhere(['>=','core_products.product_expires_on',date("Y-m-d H:i:s")])
                               ->All();//pending products count 
               $total_count['pending_products_count'] = $pending_products_count[0]['count'];

                $query = new Query;
                $count = $query->select('COUNT(*) as count')->from('core_products')
                                //->where("product_status = 1")
                               //->andWhere(['>=','core_products.product_expires_on',date("Y-m-d H:i:s")])
                               ->All();
                $total_count['total_products_count'] = $count[0]['count'];
                return $total_count;
            }
                
            
            
        } catch (ErrorException $e) {
            Yii::warning($e->getMessage());
        }
        
        
    }
    
    //get all product in services block for home page
    public static function select_all_our_services()
    {
        $query = new Query;
        $services = $query->select(['core_products.*','core_product_categories.category_name','core_product_sub_categories.sub_category_name', 'core_product_models.model_name','core_product_categories.metric AS metric','core_product_images.*'])
                    ->from('core_products')
                    ->leftJoin('core_product_categories', 'core_product_categories.category_id=core_products.category_id')
                    ->leftJoin('core_product_sub_categories', 'core_product_sub_categories.sub_category_id=core_products.sub_category_id')
                    ->leftJoin('core_product_models', 'core_product_models.model_id=core_products.model_id')
                    ->innerJoin('core_product_images', 'core_product_images.product_id=core_products.product_id')
                    ->orderBy(['core_products.product_id' => SORT_DESC])
                    ->groupBy('core_products.product_id')
                    ->where("core_products.product_status = 1")
                    ->andWhere(['>=','core_products.product_expires_on',date("Y-m-d H:i:s")])
                    ->all();
        return $services;
    }
    
    
    //function to insert data in to product table
    public static function insert_new_product_details($data)
    {
        try{
            
            $session = Yii::$app->session;
            foreach($data as $key=>$val) 
            {
                if($key == 'hire_price' || $key == 'sale_price'){
                    if($val != '')
                    {
                        $val=str_replace(',', '', $val );
                        if (strpos($val, '.') !== false) {
                            $val=substr($val,0,strpos($val, '.')+3);
                        }
                    }
                    else
                    {
                        $val = 0;
                    }
                }
                if($key == 'life_tax_details')
                {
                    if(sizeof($val)>0){

                        $val=implode(",",$val);
                    }
                }
                if($key == 'exact_location')
                {
                    if(sizeof($val)>0){

                        $val=implode(",",$val);
                    }
                }
                $$key=get_magic_quotes_gpc()?$val:addslashes($val);
                $insertdata[$key] = $$key;

            }
            
            if($insertdata['hire_price_range'] == 'crore')
            {
                
                $insertdata['hire_price'] = $insertdata['hire_price'] * 10000000;
            }
            else if($insertdata['hire_price_range'] == 'lack')
            {
                $insertdata['hire_price'] = $insertdata['hire_price'] * 100000;
            }
            else if($insertdata['hire_price_range'] == 'thousand')
            {
                $insertdata['hire_price'] = $insertdata['hire_price'] * 1000;
            }
            else if($insertdata['hire_price_range'] == 'por')
            {
                $insertdata['hire_price'] = -1;
            }
            
            if($insertdata['sale_price_range'] == 'crore')
            {
                $insertdata['sale_price'] = $insertdata['sale_price'] * 10000000;
            }
            else if($insertdata['sale_price_range'] == 'lack')
            {
                $insertdata['sale_price'] = $insertdata['sale_price'] * 100000;
            }
            else if($insertdata['sale_price_range'] == 'thousand')
            {
                $insertdata['sale_price'] = $insertdata['sale_price'] * 1000;
            }
            else if($insertdata['sale_price_range'] == 'por')
            {
                $insertdata['sale_price'] = -1;
            }
            
            unset($insertdata['hire_price_range']);
            unset($insertdata['sale_price_range']);
            

            $capacity = $insertdata['capacity'];
            $insertdata['capacity'] = $insertdata['capacity'].' '.$insertdata['capacity_metric'];  
            unset($insertdata['capacity_metric']);

            if(!isset($model_other)) $insertdata['model_other']=''; 
            $insertdata['product_status'] = 0; //update this when control panel complete

            $remove_keys = ['email','user_name','phone_number','password','regrepassword','company_name','designation','company_email','address','otp'];
            foreach($remove_keys as $removekey) unset($insertdata[$removekey]);

            //save equipment current location to productloaction array
            $productlocation = array();
            $current_location_keys = ['latitude','longitude','city','state','country','google_place_id','location_type']; 
            foreach($current_location_keys as $key)
            {
                if($key == 'location_type')
                {
                    $location[$key] = 1;
                }
                else
                {
                    $location[$key] = $insertdata[$key];
                    unset($insertdata[$key]);
                }
            }
            $productlocation[] = $location;
            unset($insertdata['street']);
            unset($insertdata['route']);
            unset($insertdata['zipcode']);

            //save equipment serving location to productloaction array
            if(isset($insertdata['exact_location']))
            {
                $exact_locations = explode(',',$insertdata['exact_location']);
                foreach($exact_locations as $exact_location)
                {
                    $get_url_data=file_get_contents("http://maps.google.com/maps/api/geocode/json?address=".urlencode($exact_location)."&sensor=false");
                    $url_data=(array)json_decode($get_url_data);
                    $url_data=$url_data['results'];
                    $components=array_reverse($url_data[0]->address_components);
                    $country	=@$components[0]->long_name;
                    $state		=@$components[1]->long_name;
                    $city		=@$components[2]->long_name;
                    $place_id=$url_data[0]->place_id;
                    $lat=$url_data[0]->geometry->location->lat;
                    $lng=$url_data[0]->geometry->location->lng;
                    $location['latitude'] = $lat;
                    $location['longitude'] = $lng;
                    $location['city'] = $city;
                    $location['state'] = $state;
                    $location['country'] = $country;
                    $location['google_place_id'] = $place_id;
                    $location['location_type'] = 2;
                    $productlocation[] = $location;
                }
            }
            unset($insertdata['exact_location']);
            unset($insertdata['_csrf']);
            unset($insertdata['product_type_check']);
            
            if ($insertdata['length'] == ""){                
                $insertdata['length'] =0;   
            }            
            if ($insertdata['width'] == ""){
                $insertdata['width'] =0;            
            }            
            if ($insertdata['height'] == ""){     
                $insertdata['height'] =0;            
            }                       
            $insertdata['dimensions'] = $insertdata['length'].'x'.$insertdata['width'].'x'.$insertdata['height'];  
            unset($insertdata['length']);          
            unset($insertdata['width']);           
            unset($insertdata['height']);
            
            //update amount if package type is free
            if($data['package_type'] != 2) { $data['package_amount'] = 0; }
                


            //get current user id
            $insertdata['user_id']=Yii::$app->user->getId(); 
            
            $insertdata['updated_by'] = Yii::$app->user->id;
            $insertdata['date_updated'] = date('Y-m-d H:i:s');
            
            //insert data into database core_prodcuts table and get inserted product id
            Yii::$app->db->createCommand()->insert('core_products', $insertdata)->execute();
            $product_id = Yii::$app->db->getLastInsertID();

            $session->set('current_product_id', $product_id);

            //generate unique code for product and update
            //new logic start
            $categories = array('1'=>'C','2'=>'D','3'=>'E','4'=>'G','5'=>'P');//C-crane,D-dumper,E-excavator,G-generator,P-piling rigs
            $manual_product_code = $categories[$insertdata['category_id']];
            
            $subcategorycode = Productsubcategory::get_sub_category_code_by_id($insertdata['sub_category_id']);
            $manual_product_code .= $subcategorycode;
                
            if(strlen($capacity)>4)
                $manual_product_code .= substr($capacity, 0,4);
            else if(strlen($capacity)<=4)
                $manual_product_code .= str_pad($capacity, 4, '0', STR_PAD_LEFT);
            
            $producttype = array('0'=>'H','1'=>'S','2'=>'B'); //H-hire,S-sale,B-both
            $manual_product_code .=$producttype[$insertdata['product_type']];
            
            $manual_product_code .= strtoupper(str_pad(dechex($product_id), 5, '0', STR_PAD_LEFT));
            
            
            //new logic end
            Yii::$app->db->createCommand()->update('core_products', ['manual_product_code' => $manual_product_code], "product_id = '$product_id'")->execute();


            //save product current and serving locations using product id         
            foreach($productlocation as $location)
            {
                $location['product_id'] = $product_id;
                Yii::$app->db->createCommand()->insert('core_product_locations', $location)->execute();
            }

            //get category name by id to get full path of the images & load charts upload for product
            $category_id = $insertdata['category_id'];
            $category_names = Productcategory::select_fields_by_category_id($category_id);
            $category_name= str_replace(' ', '_', $category_names[0]['category_name']);

            //save product images
            if(is_array($session->get('product_images')))
            {
                $product_images = $session->get('product_images');
                $original_image_name=$session->get('product_images_names');
                foreach($product_images as $index=>$product_image)
                {
                    $images_data['product_id'] = $product_id;
                    $images_data['image_name'] = $original_image_name[$index];
                    $images_data['image_url'] = Yii::$app->params['SITE_URL'].'uploads/'.date('Y').'/'.$category_name.'/'.$product_image;
                    $images_data['image_type'] = 1;
                    $images_data['image_status'] = 1;
                    
                    //insert image details to database table.
                    Yii::$app->db->createCommand()->insert('core_product_images', $images_data)->execute();

                }
                $session->remove('product_images');
                $session->remove('product_images_names');
            }
            //save product load_charts
            if(is_array($session->get('product_loadcharts')))
            {
                $product_load_charts = $session->get('product_loadcharts');
                $original_load_chart_name=$session->get('product_loadcharts_names');
                foreach($product_load_charts as $index=>$load_chart)
                {
                    $load_charts_data['product_id'] = $product_id;
                    $load_charts_data['image_name'] = $original_load_chart_name[$index];
                    $load_charts_data['image_url'] = Yii::$app->params['SITE_URL'].'uploads/'.date('Y').'/'.$category_name.'/'.$load_chart;
                    $load_charts_data['image_type'] = 2;
                    $load_charts_data['image_status'] = 1;
                    //insert load_charts details to database table.
                    Yii::$app->db->createCommand()->insert('core_product_images', $load_charts_data)->execute();
                }
                $session->remove('product_loadcharts');
                $session->remove('product_loadcharts_names');
            }

            $response ['status'] = 200;
            $response ['message'] = "Product added successfully";

            
            /*//get current user email
            $email = User::select_user_email_by_id();
            $subject="Big Equipments India | Registration Of Equipment";
            //get what message to send after creating product
            $message = Mail_settings::get_product_add_message($manual_product_code,$product_id);
            
            //send email to current user
            Mail_settings::send_email_notification($email,$subject,$message);*/

            return json_encode($response);
            
        } catch (ErrorException $ex) {
            Yii::warning('Error while adding new product.');
            Yii::warning($ex->getMessage());
        }
        
    }
    
    //function to display results to user while searching for products
    public static function select_products_by_options($data)
    {
        
        $query = new Query;
        $products = $query->select(['core_products.*','core_product_images.*'])
                    ->from('core_products')
                    ->innerJoin('core_product_images', 'core_product_images.product_id=core_products.product_id');
        
        
        //if product type is set i.e., hire, sale or both
        if(isset($_REQUEST['product_type']) && @$_REQUEST['product_type'] != '')
        {
            if($_REQUEST['product_type'] != '')
            {
                $product_type= $_REQUEST['product_type'];
                if($product_type == 'hire') 
                    $products = $products->where(['core_products.product_type' => [0,2]]);
                else if($product_type == 'sale') 
                    $products = $products->where(['core_products.product_type' => [1,2]]);
                else if($product_type == 'both') 
                    $products = $products->where(['core_products.product_type' => [2]]);
            }
            
        }
        //default product type is hire if product type not set to anything
        else
        {
            
            $products = $products->where("core_products.product_type = 0");
        }
        //if user selects the category
        if(isset($_REQUEST['category']))
        {
            
            if($_REQUEST['category'] != '')
            {
                $category_id = $_REQUEST['category'];
                $products = $products->andWhere("core_products.category_id = $category_id");
            }
        }
        //if user selects sub category
        if(isset($_REQUEST['sub_category_id']) && @$_REQUEST['sub_category_id'] != '')
        {
            
            if($_REQUEST['sub_category_id'] != '')
            {
                $sub_category_id = $_REQUEST['sub_category_id'];
                $products = $products->andWhere("core_products.sub_category_id = $sub_category_id");
            }
        }
        //if user sets current location
        if(@$_REQUEST['current_location'] != '')
        {
            
            $products = $products->andFilterWhere(['LIKE', 'core_products.current_location', $_REQUEST['current_location']]);
        }
        //if user sets price type
        if(@$_REQUEST['price_type'] != '')
        {
            $price_type =$_REQUEST['price_type'];
            $products = $products->andWhere("core_products.price_type = $price_type");
        }
        //if user sets capacity range
        if(@$_REQUEST['capacity'] != '')
        {
            
            $capacity =$_REQUEST['capacity'];
            //if user selects between
            if (strpos($capacity, 'and') !== false) {
                $products = $products->andWhere("rtrim(substring_index(core_products.capacity, ' ', 1)) between $capacity");
            }
            //if user selects morethan
            else if (strpos($capacity, '>') !== false) {
                $products = $products->andWhere("rtrim(substring_index(core_products.capacity, ' ', 1)) $capacity");
            }
        }
        
        $products = $products->orderBy(["core_products.product_id" => SORT_DESC])
                    ->andWhere("core_products.product_status = 1")
                    ->andWhere(['>=','core_products.product_expires_on',date("Y-m-d H:i:s")])
                    ->groupBy(['core_products.product_id'])
                    ->all();
        return $products;
    }
    
    //function for get the product details by product id to display in model box
    public static function select_product_by_id($data)
    {
        
        try{
        $product_id=$data['product_id'];
        $productquery = new Query;
        $productdata = $productquery->select(['core_products.*','core_product_categories.category_name','core_product_sub_categories.sub_category_name', 'core_product_models.model_name','core_product_categories.metric','core_product_images.*'])
                    ->from('core_products')
                    ->leftJoin('core_product_categories', 'core_product_categories.category_id=core_products.category_id')
                    ->leftJoin('core_product_sub_categories', 'core_product_sub_categories.sub_category_id=core_products.sub_category_id')
                    ->leftJoin('core_product_models', 'core_product_models.model_id=core_products.model_id')
                    ->innerJoin('core_product_images', 'core_product_images.product_id=core_products.product_id')
                    ->orderBy(['core_products.product_id' => SORT_DESC])
                    ->groupBy(['core_products.product_id'])
                    ->limit(1)
                    ->where("core_products.product_id = $product_id")
                    ->all();
        $product = (object)$productdata[0];
        $imagequery = new Query;
        $productimages = $imagequery->select(['*'])
                    ->from('core_product_images')
                    ->where("product_id = $product_id")
                    ->all();
        
        $tax_details = new Query;
        $tax_ids= explode(',',$product->life_tax_details);
        $tax_regions = $tax_details->select(['region_name'])
                    ->from('core_regions')
                    ->where(['region_id' => $tax_ids])
                    ->all();
        $life_tax_details='';
        foreach($tax_regions as $index=>$region_name)
        {
            if($index==0)
                $life_tax_details = $region_name['region_name'];
            else
                $life_tax_details .= ', '.$region_name['region_name'];
        }
        $common_value = "Not Available";
        //variable to dispaly product title
        $product_title = $product->equipment_title.' <span><i class="fa fa-check-circle"></i> In Stock</span>';
        
        //variable to display product navigation
        $product_navs ='<li role="presentation" class="active"><a href="#cranedetails" aria-controls="details" role="tab" data-toggle="tab">Details</a></li>
                        <li role="presentation"><a href="#craneimages" aria-controls="craneimages" role="tab" data-toggle="tab">Images</a></li>';
        $loadchartcount = 0;
        foreach($productimages as $index=>$image)
        {
            $image = (object)$image;
            if($image->image_type == 2) $loadchartcount++; 
        }
                        
        if($product->category_id ==1)
            $product_navs .='<li role="presentation"><a href="#loadcharts" aria-controls="loadcharts" role="tab" data-toggle="tab">Load Charts</a></li>';
        $price_type = ''; $place_holder_price_type = '';
        if(@$product->price_type == 1)
        {
            @$price_type = "Daily"; 
            $place_holder_price_type ='Days';
        }
        else if(@$product->price_type == 2)
        {
            @$price_type = "Monthly"; 
            $place_holder_price_type ='Months';
        }
        
        //variable to display product details
        $product_details ='<div role="tabpanel" class="tab-pane active" id="cranedetails">
                                  <div class="b-t-b-grey flex">
                                          <img width="209px" height="194px" src="'.$product->image_url.'" alt="">
                                          <p>'.$product->description.'</p>
                                  </div>
                                  <div class="col-md-6">
                                          <ul class="cranedtlslist">
                                                          <li><strong>Code: </strong> '.$product->manual_product_code.'</li>';
        if($product->product_type == 0)
        {
            if($product->hire_price == -1)
                $product_details .= '<li data-toggle="popover" data-trigger="hover" data-content="PRICE ON REQUEST" onmouseover="mousepopover();"><strong>Hire Price: </strong> <strong><i class="fa fa-rupee"></i></strong> PRICE ON REQUEST/'.$price_type.'</li>'; 
            else
                $product_details .= '<li><strong>Hire Price: </strong> <strong><i class="fa fa-rupee"></i></strong> '.$product->hire_price.'/'.$price_type.'</li>'; 
        }
        else if($product->product_type == 1)
        {
            if($product->sale_price == -1)
                $product_details .= '<li data-toggle="popover" data-trigger="hover" data-content="PRICE ON REQUEST" onmouseover="mousepopover();"><strong>Sale Price: </strong> <strong><i class="fa fa-rupee"></i></strong> PRICE ON REQUEST </li>'; 
            else
                $product_details .= '<li ><strong>Sale Price: </strong> <strong><i class="fa fa-rupee"></i></strong> '.$product->sale_price.'</li>'; 
        }
        else if($product->product_type == 2)
        {
            if($product->hire_price == -1)
                $product_details .= '<li data-toggle="popover" data-trigger="hover" data-content="PRICE ON REQUEST" onmouseover="mousepopover();"><strong>Hire Price: </strong> <strong><i class="fa fa-rupee"></i></strong> PRICE ON REQUEST/'.$price_type.'</li>'; 
            else
                $product_details .= '<li><strong>Hire Price: </strong> <strong><i class="fa fa-rupee"></i></strong> '.$product->hire_price.'/'.$price_type.'</li>'; 
            
            
            if($product->sale_price == -1)
                $product_details .= '<li data-toggle="popover" data-trigger="hover" data-content="PRICE ON REQUEST" onmouseover="mousepopover();"><strong>Sale Price: </strong> <strong><i class="fa fa-rupee"></i></strong> PRICE ON REQUEST </li>'; 
            else
                $product_details .= '<li ><strong>Sale Price: </strong> <strong><i class="fa fa-rupee"></i></strong> '.$product->sale_price.'</li>'; 
        }
        
            
            $product_details .= '<li><strong>Capacity: </strong> '.$product->capacity.'</li>';
            $product_details .= '<li><strong>Category: </strong> '.$product->category_name.'</li>';
            $product_details .= '<li><strong>Sub category: </strong> '.$product->sub_category_name.'</li>';
            
        
        if($product->model_name != '')
        {
            $product_details .= '<li ><strong>Model: </strong>'.$product->model_name.'</li>'; 
        }
        if($product->model_other != '')
        {
            $product_details .= '<li ><strong>Model Other: </strong> '.$product->model_other.'</li>'; 
        }
        if($product->current_location != '')
        {
            $pos = strrpos( $product->current_location, ',');
            if ($pos > 0) { // try to find the second one
              $npath = substr($product->current_location, 0, $pos);
              $npos = strrpos($npath, ',');
              if ($npos !== false) {
                 $currentlocation = substr($product->current_location, $npos+1);
              } 
              else {
                  $currentlocation =$product->current_location;
                  
              }
            }
            $product_details .= '<li ><strong>Location: </strong>'.$currentlocation.'</li>'; 
        }
        
        $product_details .= '</ul></div><div class="col-md-6">
                                <ul class="cranedtlslist">';
        if($product->category_id == '1')
        {
            if($product->fly_jib)
                $product_details .= '<li ><strong>Fly jib:</strong> '.$product->fly_jib.' meters</li>';
            else
                $product_details .= '<li ><strong>Fly jib:</strong> '.$common_value.'</li>';
        }
        
        if($product->category_id == '1')
        {
            if($product->luffing_jib)
                $product_details .= '<li ><strong>Luffing jib:</strong>'.$product->luffing_jib.' meters</li>'; 
            else
                $product_details .= '<li ><strong>Luffing jib:</strong> '.$common_value.'</li>';
            
        }
        if($product->category_id == '1' || $product->category_id == '2')
        {
            if($product->registered_number)
                $product_details .= '<li ><strong>Registered Number:</strong> '.$product->registered_number.'</li>'; 
            else
                $product_details .= '<li ><strong>Registered Number:</strong> '.$common_value.'</li>'; 
        }
        
        if($life_tax_details)
            $product_details .= '<li ><strong>Life Tax Details:</strong> '.$life_tax_details.'</li>'; 
        else
            $product_details .= '<li ><strong>Life Tax Details:</strong> '.$common_value.'</li>'; 
        
        if($product->condition != '')
        {
            $product_details .= '<li ><strong>Condition:</strong> '.$product->condition.'</li>'; 
        }
        if($product->category_id == '3')
        {
            if($product->bucket_capacity)
                $product_details .= '<li ><strong>Bucket Capacity:</strong> '.$product->bucket_capacity.' Cubic Metres</li>'; 
            else
                $product_details .= '<li ><strong>Bucket Capacity:</strong> '.$common_value.'</li>'; 
        }
        if($product->manufacture_year != '')
        {
            if($product->manufacture_year)
                $product_details .= '<li ><strong>Manufacture year:</strong> '.$product->manufacture_year.'</li>'; 
            else
                $product_details .= '<li ><strong>Manufacture year:</strong> '.$common_value.'</li>'; 
        }
        if($product->category_id == '1')
        {
            if($product->boom_length)
                $product_details .= '<li ><strong>Boom Length:</strong> '.$product->boom_length.' meters</li>'; 
            else
                $product_details .= '<li ><strong>Boom Length:</strong> '.$common_value.'</li>'; 
        }
        if($product->category_id == '5')
        {
            if($product->kelly_length)
                $product_details .= '<li ><strong>Kelly Length: </strong>'.$product->kelly_length.' meters</li>'; 
            else
                $product_details .= '<li ><strong>Kelly Length: </strong>'.$common_value.'</li>'; 
        }   
        if($product->category_id == '3')
        {
            if($product->arm_length)
                $product_details .= '<li ><strong>Arm Length: </strong>'.$product->arm_length.' meters</li>'; 
            else
                $product_details .= '<li ><strong>Arm Length: </strong>'.$common_value.'</li>'; 
        }
        if($product->category_id == '2')
        {
            if($product->numberof_axles)
                $product_details .= '<li ><strong>Number of axles: </strong> '.$product->numberof_axles.'</li>'; 
            else
                $product_details .= '<li ><strong>Number of axles: </strong> '.$common_value.'</li>'; 
        }
        
        if($product->dimensions && $product->dimensions!= '0x0x0')
            $product_details .= '<li ><strong>Dimensions: </strong> '.$product->dimensions .'</li>'; 
        else
            $product_details .= '<li ><strong>Dimensions: </strong> '.$common_value.'</li>'; 
            
        $product_details .='</ul></div></div>';
            
            $gallery_thumb = '';$gallery = '';$load_charts_thumb = '';$load_charts=''; $i=0; $j=0;
            foreach($productimages as $index=>$image)
            {
                $image = (object)$image;
                if($image->image_type == 1)
                {
                    
                    if($i==0) $active= 'active'; else $active = '';
                    $gallery_thumb .='<li><a class="thumbnail" id="carousel-selector-'.$i.'"><img width="100px" height="74px" src="'.$image->image_url.'"></a></li>';
                    $gallery .= '<div class="item '.$active.'" data-slide-number="'.$i.'"><img src="'.$image->image_url.'"></div>';
                    $i++; 
                }
                else if($image->image_type == 2)
                {
                    
                    if($j==0) $active= 'active'; else $active = '';
                    $load_charts_thumb .='<li><a class="thumbnail" id="carousel-selector-'.$j.'"><img width="100px" height="74px" src="'.$image->image_url.'"></a></li>';
                    $load_charts .= '<div class="item '.$active.'" data-slide-number="'.$j.'"><img src="'.$image->image_url.'"></div>';
                    $j++;
                }
                
                
            }
            //variable to display images slider
            $image_block ='<div role="tabpanel" class="tab-pane" id="craneimages">
                                  <div class="col-sm-2" id="slider-thumbs">
                                          <!-- Bottom switcher of slider -->
                                          <ul class="hide-bullets">'.$gallery_thumb.'</ul>
                                      </div>
                                      <div class="col-sm-10">
                                          <div class="col-xs-12" id="slider">
                                              <!-- Top part of the slider -->
                                              <div class="row">
                                                  <div class="col-sm-12" id="carousel-bounding-box">
                                                      <div class="carousel slide" id="myCarousel">
                                                          <!-- Carousel items -->
                                                          <div class="carousel-inner">'.$gallery.'</div>
                                                          <!-- Carousel nav -->
                                                          <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                                              <span class="glyphicon glyphicon-chevron-left"></span>
                                                          </a>
                                                          <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                                              <span class="glyphicon glyphicon-chevron-right"></span>
                                                          </a>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                              </div>';
            //variable to display load charts if exists.
            if($loadchartcount >0)
            {
                $product_load_charts ='<div role="tabpanel" class="tab-pane" id="loadcharts">
                                      <div class="col-sm-2" id="slider-thumbs">
                                              <!-- Bottom switcher of slider -->
                                              <ul class="hide-bullets">'.$load_charts_thumb.'</ul>
                                          </div>
                                          <div class="col-sm-10">
                                              <div class="col-xs-12" id="slider">
                                                  <!-- Top part of the slider -->
                                                  <div class="row">
                                                      <div class="col-sm-12" id="carousel-bounding-box">
                                                          <div class="carousel slide" id="load_chart_carousel">
                                                              <!-- Carousel items -->
                                                              <div class="carousel-inner">'.$load_charts.'</div>
                                                              <!-- Carousel nav -->
                                                              <a class="left carousel-control" href="#load_chart_carousel" role="button" data-slide="prev">
                                                                  <span class="glyphicon glyphicon-chevron-left"></span>
                                                              </a>
                                                              <a class="right carousel-control" href="#load_chart_carousel" role="button" data-slide="next">
                                                                  <span class="glyphicon glyphicon-chevron-right"></span>
                                                              </a>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                  </div><div class="clearfix"></div>';
            }
            else
            {
                $product_load_charts ='<div role="tabpanel" class="tab-pane" id="loadcharts">
                                      <center><h4>Load Charts Not Available</h4></center>
                                        </div><div class="clearfix"></div>';
            }
            
        //condition to check which button to display    
        if(Yii::$app->user->id != $product->user_id)
        {
	    if($product->product_type == 0)
            	$hirenowbutton = '<button type="button" class="btn btn-bei" onclick="order_now('.$product->product_id.',0);">Hire Now</button>';
            else if($product->product_type == 1)
            	$hirenowbutton = '<button type="button" class="btn btn-bei" onclick="order_now('.$product->product_id.',1);">Buy Now</button>';
            else if($product->product_type == 2)
            	$hirenowbutton = '<button type="button" class="btn btn-bei" onclick="order_now('.$product->product_id.',2);">Hire / Buy</button>';
        }
        else
        {
            $hirenowbutton = '';
        }
        $data['title'] = $product_title;
        $data['navs'] = $product_navs;
        $data['details'] = $product_details;
        $data['images'] = $image_block;
        $data['load_charts'] = $product_load_charts;
        $data['hire_now_button'] = $hirenowbutton;
        $data['price_type'] = $place_holder_price_type;
        return $data;
        
        }catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
        }
        
        
    
    }
    
    //function to get capacity by category id
    function select_product_capacity_by_category_id($data)
    {
        $category_id = $data['category_id'];
        $sub_category_id = $data['sub_category_id'];
        $query = new Query;
        $capacity = $query->select('capacity')->from('core_products')->where("category_id = $category_id");
        if($sub_category_id != '')
        {
            $capacity = $capacity->where("sub_category_id = $sub_category_id");
        }
        
        return $capacity = $capacity->groupBy(['core_products.capacity'])->orderBy(['core_products.capacity' => SORT_ASC])->All();
    }
    
    //get user id(who created) by product id 
    function select_user_id_by_product_id($product_id)
    {
        $query = new Query;
        $count = $query->select('user_id')->from('core_products')->where("product_id = '$product_id'")->All();
        return $count[0]['user_id'];
    }
    
    //deleter product by product id
    public static function delete_product_by_id($data)
    {
        foreach($data as $key=>$val) $$key=get_magic_quotes_gpc()?$val:addslashes($val);
       $status = '3';
        $userId = Yii::$app->user->id;
        $date_updated = date('Y-m-d H:i:s');

        $query = new Query;
        $count = $query->select('COUNT(*) as count')->from('core_products')->where('user_id=:userId', [':userId' => $userId])->andWhere('product_id=:productid', [':productid' => $product_id])->All();

        if($count[0]['count'] == 1)
        {
            $result = $query->createCommand()->update('core_products', ['product_status' => $status,'updated_by' => $userId,'date_updated' => $date_updated], 'product_id = "'.$product_id.'"')->execute();
            if ($result == 1){			
                return "SUCCESS";
                }else{
                return "FAILED";
            }
        }
        else{
            return "FAILED";
        }
    }
    
    public static function get_product_by_id($product_id)
    {
        $query = new Query;
        return $productdata = $query->select(['core_products.*','core_product_categories.category_name','core_product_sub_categories.sub_category_name', 'core_product_models.model_name'])
                                    ->from('core_products')
                                    ->innerJoin('core_product_categories', 'core_product_categories.category_id=core_products.category_id')
                                    ->innerJoin('core_product_sub_categories', 'core_product_sub_categories.sub_category_id=core_products.sub_category_id')
                                    ->innerJoin('core_product_models', 'core_product_models.model_id=core_products.model_id')
                                    ->groupBy(['core_products.product_id'])
                                    ->where("core_products.product_id = $product_id")
                                    ->one();
    }
    
    public static function get_products($limit = null,$product_type = null)
    {
        $query = new Query;
        $products = $query->select(['core_products.*','core_product_categories.category_name','core_users.user_name as employee_name'])
                        ->from('core_products')
                        ->innerJoin('core_product_categories', 'core_product_categories.category_id=core_products.category_id')
                        //->innerJoin('core_product_sub_categories', 'core_product_sub_categories.sub_category_id=core_products.sub_category_id')
                        //->innerJoin('core_product_models', 'core_product_models.model_id=core_products.model_id')
                        ->leftJoin('core_users', 'core_products.employee_id=core_users.user_id');
        if($product_type != null)
        {
           
           $products = $products->where("core_products.product_type = $product_type"); 
        }
        if($limit != null)
        {
            $products = $products->limit($limit);
        }
        return $products = $products->groupBy(['core_products.product_id'])->orderBy(['core_products.date_created' => SORT_DESC])->all();
    }
    
    //function to insert data in to product table
    public static function update_product_details($data)
    {
        try{
            
            $session = Yii::$app->session;
            foreach($data as $key=>$val) 
            {
                
                if($key == 'life_tax_details')
                {
                    if(sizeof($val)>0){

                        $val=implode(",",$val);
                    }
                }
                if($key == 'exact_location')
                {
                    if(sizeof($val)>0){

                        $val=implode(",",$val);
                    }
                }
                $$key=get_magic_quotes_gpc()?$val:addslashes($val);
                $insertdata[$key] = $$key;

            }

            $capacity = $insertdata['capacity'];
            $insertdata['capacity'] = $insertdata['capacity'].' '.$insertdata['capacity_metric'];  
            unset($insertdata['capacity_metric']);

            if(!isset($model_other)) $insertdata['model_other']=''; 
            
           
            //save equipment current location to productloaction array
            $productlocation = array();
            $current_location_keys = ['latitude','longitude','city','state','country','google_place_id','location_type']; 
            foreach($current_location_keys as $key)
            {
                if($key == 'location_type')
                {
                    $location[$key] = 1;
                }
                else
                {
                    $location[$key] = $insertdata[$key];
                    unset($insertdata[$key]);
                }
            }
            $productlocation[] = $location;
            unset($insertdata['street']);
            unset($insertdata['route']);
            unset($insertdata['zipcode']);

            //save equipment serving location to productloaction array
            if(isset($insertdata['exact_location']))
            {
                $exact_locations = explode(',',$insertdata['exact_location']);
                foreach($exact_locations as $exact_location)
                {
                    $get_url_data=file_get_contents("http://maps.google.com/maps/api/geocode/json?address=".urlencode($exact_location)."&sensor=false");
                    $url_data=(array)json_decode($get_url_data);
                    $url_data=$url_data['results'];
                    $components=array_reverse($url_data[0]->address_components);
                    $country	=@$components[0]->long_name;
                    $state		=@$components[1]->long_name;
                    $city		=@$components[2]->long_name;
                    $place_id=$url_data[0]->place_id;
                    $lat=$url_data[0]->geometry->location->lat;
                    $lng=$url_data[0]->geometry->location->lng;
                    $location['latitude'] = $lat;
                    $location['longitude'] = $lng;
                    $location['city'] = $city;
                    $location['state'] = $state;
                    $location['country'] = $country;
                    $location['google_place_id'] = $place_id;
                    $location['location_type'] = 2;
                    $productlocation[] = $location;
                }
            }
            unset($insertdata['exact_location']);
            unset($insertdata['_csrf']);
            //unset($insertdata['product_type_check']);
            
            $product_id = $insertdata['product_id'];
            unset($insertdata['product_id']);    


            //get current user id
            //$insertdata['user_id']=Yii::$app->user->getId(); 
            $insertdata['updated_by'] = Yii::$app->user->id;
            $insertdata['date_updated'] = date('Y-m-d H:i:s');
            
            //insert data into database core_prodcuts table and get inserted product id
            Yii::$app->db->createCommand()->update('core_products', $insertdata,"product_id = $product_id")->execute();
            
            
            Yii::$app->db->createCommand()->delete('core_product_locations', "product_id = $product_id")->execute();
            
            //save product current and serving locations using product id         
            foreach($productlocation as $location)
            {
                $location['product_id'] = $product_id;
                Yii::$app->db->createCommand()->insert('core_product_locations', $location)->execute();
            }

            //get category name by id to get full path of the images & load charts upload for product
            $category_id = $insertdata['category_id'];
            $category_names = Productcategory::select_fields_by_category_id($category_id);
            $category_name= str_replace(' ', '_', $category_names[0]['category_name']);

            //save product images
            if(is_array($session->get('product_images')))
            {
                $product_images = $session->get('product_images');
                $original_image_name=$session->get('product_images_names');
                foreach($product_images as $index=>$product_image)
                {
                    $images_data['product_id'] = $product_id;
                    $images_data['image_name'] = $original_image_name[$index];
                    $images_data['image_url'] = Yii::$app->params['SITE_URL'].'uploads/'.date('Y').'/'.$category_name.'/'.$product_image;
                    $images_data['image_type'] = 1;
                    $images_data['image_status'] = 1;
                    
                    //insert image details to database table.
                    Yii::$app->db->createCommand()->insert('core_product_images', $images_data)->execute();

                }
                $session->remove('product_images');
                $session->remove('product_images_names');
            }
            //save product load_charts
            if(is_array($session->get('product_loadcharts')))
            {
                $product_load_charts = $session->get('product_loadcharts');
                $original_load_chart_name=$session->get('product_loadcharts_names');
                foreach($product_load_charts as $index=>$load_chart)
                {
                    $load_charts_data['product_id'] = $product_id;
                    $load_charts_data['image_name'] = $original_load_chart_name[$index];
                    $load_charts_data['image_url'] = Yii::$app->params['SITE_URL'].'uploads/'.date('Y').'/'.$category_name.'/'.$load_chart;
                    $load_charts_data['image_type'] = 2;
                    $load_charts_data['image_status'] = 1;
                    //insert load_charts details to database table.
                    Yii::$app->db->createCommand()->insert('core_product_images', $load_charts_data)->execute();
                }
                $session->remove('product_loadcharts');
                $session->remove('product_loadcharts_names');
            }

            $response ['status'] = 200;
            $response ['message'] = "Product updated successfully";

            
            /*//get current user email
            $email = User::select_user_email_by_id();
            $subject="Big Equipments India | Registration Of Equipment";
            //get what message to send after creating product
            $message = Mail_settings::get_product_add_message($manual_product_code,$product_id);
            
            //send email to current user
            Mail_settings::send_email_notification($email,$subject,$message);*/

            return $response;
            
        } catch (ErrorException $ex) {
            Yii::warning('Error while updating new product.');
            Yii::warning($ex->getMessage());
            
            $response ['status'] = 400;
            $response ['message'] = "Error while updating product details";
            return $response;
        }
        
    }
    
    public static function update_product_status($product_id,$status)
    {
        try{
            $userId = Yii::$app->user->id;
            $date_updated = date('Y-m-d H:i:s');
            Yii::$app->db->createCommand()->update('core_products', ['product_status' => $status,'updated_by' => $userId,'date_updated' => $date_updated], "product_id = '$product_id'")->execute();
            return true;
        } catch (ErrorException $ex) {
            Yii::warning('Error while updating product status.');
            Yii::warning($ex->getMessage());
        }
        
    }
    
    public static function get_products_by_userid($userid)
    {
        $query = new Query;
        
        return $products = $query->select(['core_products.*','core_product_categories.category_name','core_users.user_name as employee_name'])
                        ->from('core_products')
                        ->innerJoin('core_product_categories', 'core_product_categories.category_id=core_products.category_id')
                        ->leftJoin('core_users', 'core_products.employee_id=core_users.user_id')
                        ->where("core_products.user_id = $userid")
                        ->groupBy(['core_products.product_id'])->orderBy(['core_products.date_created' => SORT_DESC])->all();
        
        /*$products = $query->select(['core_products.*','core_product_categories.category_name','core_product_sub_categories.sub_category_name', 'core_product_models.model_name'])
                        ->from('core_products')
                        ->innerJoin('core_product_categories', 'core_product_categories.category_id=core_products.category_id')
                        ->innerJoin('core_product_sub_categories', 'core_product_sub_categories.sub_category_id=core_products.sub_category_id')
                        ->innerJoin('core_product_models', 'core_product_models.model_id=core_products.model_id')
                        ->where("core_products.user_id = $userid");
        
        return $products = $products->groupBy(['core_products.product_id'])->all();*/
    }
    
    public static function assign_product($data)
    {
        return Yii::$app->db->createCommand("UPDATE core_products set employee_id =:employee_id,updated_by =:updated_by,date_updated =:date_updated where product_id=:product_id")
                    ->bindValue(':employee_id', $data['employee_id'])
                    ->bindValue(':updated_by', Yii::$app->user->id)
                    ->bindValue(':date_updated', date('Y-m-d H:i:s'))
                    ->bindValue(':product_id', $data['product_id'])
                    ->execute();
        
    }
    
}
