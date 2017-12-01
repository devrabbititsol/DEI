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

class Products extends Model
{
    protected $id = 'product_id';

    public static function tableName()
    {
        return 'core_products';
    }
    
    public static function select_product_count_by_category_id($category_id)
    {
        try {
            $query = new Query;
            $count = $query->select('COUNT(*) as count')->from('core_products')->where("category_id = $category_id")->All();
            return $count[0]['count'];
        } catch (ErrorException $e) {
            Yii::warning($e->getMessage());
        }
        
        
    }
    
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
                    ->groupBy(['core_products.product_id'])
                    ->all();
        return $services;
    }
    
    
    //function to insert data in to product table
    public static function insert_new_product_details($data)
    {
        $session = Yii::$app->session;
        foreach($data as $key=>$val) 
        {
            if($key == 'hire_price' || $key == 'sale_price'){
                if($val != '')
                {
                    $val=$val;
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
        
        $insertdata['capacity'] = $insertdata['capacity'].' '.$insertdata['capacity_metric'];  
        unset($insertdata['capacity_metric']);
        
        if(!isset($model_other)) $insertdata['model_other']=''; 
        $insertdata['product_status'] = 1;
        
        $remove_keys = ['email','user_name','phone_number','password','regrepassword','company_name','designation','company_email','address','otp'];
        foreach($remove_keys as $removekey) unset($insertdata[$removekey]);
        
        //save current location to productloaction array
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
        
        //save serving location to productloaction array
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
        
        
        //get current user id
        $insertdata['user_id']=Yii::$app->user->getId(); 
        $insertdata['package_type'] = 0;
        
        //insert data into core_prodcuts table and get insert product id
        Yii::$app->db->createCommand()->insert('core_products', $insertdata)->execute();
        $product_id = Yii::$app->db->getLastInsertID();
        
        $session->set('current_product_id', $product_id);
        
        //generate unique code for product and update
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet);
        $length = 13-strlen($product_id);
        $token='';
        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[rand(0, $max-1)];
        }
        $manual_product_code = $token.$product_id;
        Yii::$app->db->createCommand()->update('core_products', ['manual_product_code' => $manual_product_code], "product_id = '$product_id'")->execute();
        
        
        //save product locations         
        foreach($productlocation as $location)
        {
            $location['product_id'] = $product_id;
            Yii::$app->db->createCommand()->insert('core_product_locations', $location)->execute();
        }
        
        //get category name by id to create folder
        $category_id = $insertdata['category_id'];
        $category_names = Productcategory::select_fields_by_category_id($category_id);
        $category_name= str_replace(' ', '_', $category_names[0]['category_name']);
        
        //save product images and load charts
        
        
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
                
                Yii::$app->db->createCommand()->insert('core_product_images', $images_data)->execute();
                
            }
            $session->remove('product_images');
            $session->remove('product_images_names');
        }
        
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
                Yii::$app->db->createCommand()->insert('core_product_images', $load_charts_data)->execute();
            }
            $session->remove('product_loadcharts');
            $session->remove('product_loadcharts_names');
        }
        
        $response ['status'] = 200;
        $response ['message'] = "Product added successfully";
        
        //send email to user
        $email = User::select_user_email_by_id();
        $subject="Your Equipment Posted Successfully | Digital Equipments India";
        $message = Mail_settings::get_product_add_message($manual_product_code);
            
        Mail_settings::send_email_notification($email,$subject,$message);
        
        return json_encode($response);
    }
    
    
    public static function select_products_by_options($data)
    {
        
        $query = new Query;
        $products = $query->select(['core_products.*','core_product_images.*'])
                    ->from('core_products')
                    ->innerJoin('core_product_images', 'core_product_images.product_id=core_products.product_id');
        
        
        if(isset($_REQUEST['product_type']) && @$_REQUEST['product_type'] != '')
        {
            if($_REQUEST['product_type'] != '')
            {
                $product_type= $_REQUEST['product_type'];
                if($product_type == 'hire') 
                    $products = $products->where("core_products.product_type = 0");
                else if($product_type == 'sale') 
                    $products = $products->where(['core_products.product_type' => [1]]);
                else if($product_type == 'both') 
                    $products = $products->where(['core_products.product_type' => [2]]);
            }
            
        }
        else
        {
            
            $products = $products->where("core_products.product_type = 0");
        }
        if(isset($_REQUEST['category']))
        {
            
            if($_REQUEST['category'] != '')
            {
                $category_id = $_REQUEST['category'];
                $products = $products->andWhere("core_products.category_id = $category_id");
            }
        }
        if(isset($_REQUEST['sub_category_id']) && @$_REQUEST['sub_category_id'] != '')
        {
            
            if($_REQUEST['sub_category_id'] != '')
            {
                $sub_category_id = $_REQUEST['sub_category_id'];
                $products = $products->andWhere("core_products.sub_category_id = $sub_category_id");
            }
        }
        if(@$_REQUEST['current_location'] != '')
        {
            
            $products = $products->andFilterWhere(['LIKE', 'core_products.current_location', $_REQUEST['current_location']]);
        }
        if(@$_REQUEST['price_type'] != '')
        {
            $price_type =$_REQUEST['price_type'];
            $products = $products->andWhere("core_products.price_type = $price_type");
        }
        if(@$_REQUEST['capacity'] != '')
        {
            $capacity =$_REQUEST['capacity'];
            $products = $products->andFilterWhere(['LIKE', 'core_products.capacity', $capacity]);
        }
        
        $products = $products->orderBy(['core_products.product_id' => SORT_DESC])
                    ->andWhere("core_products.product_status = 1")
                    ->groupBy(['core_products.product_id'])
                    ->all();
        return $products;
    }
    
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
        
        $product_title = $product->equipment_title.' <span><i class="fa fa-check-circle"></i> In Stock</span>';
        
        $product_navs ='<li role="presentation" class="active"><a href="#cranedetails" aria-controls="details" role="tab" data-toggle="tab">Details</a></li>
                        <li role="presentation"><a href="#craneimages" aria-controls="craneimages" role="tab" data-toggle="tab">Images</a></li>';
        $loadchartcount = 0;
        foreach($productimages as $index=>$image)
        {
            $image = (object)$image;
            if($image->image_type == 2) $loadchartcount++; 
        }
                        
        if($product->category_id ==1 && $loadchartcount >0)
            $product_navs .='<li role="presentation"><a href="#loadcharts" aria-controls="loadcharts" role="tab" data-toggle="tab">Load Charts</a></li>';
        $price_type = '';
        if(@$product->price_type == 1)
            @$price_type = "Daily";
        else if(@$product->price_type == 2)
            @$price_type = "Monthly";
        
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
            $product_details .= '<li><strong>Hire Price: </strong> <strong><i class="fa fa-rupee"></i></strong> '.$product->hire_price.'/'.$price_type.'</li>'; 
        }
        else if($product->product_type == 1)
        {
            $product_details .= '<li ><strong>Sale Price: </strong> <strong><i class="fa fa-rupee"></i></strong> '.$product->sale_price.'</li>'; 
        }
        else if($product->product_type == 2)
        {
            $product_details .= '<li ><strong>Hire Price: </strong> <strong><i class="fa fa-rupee"></i></strong> '.$product->hire_price.'/'.$price_type.'</li>';
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
            $product_details .= '<li ><strong>Model other: </strong> '.$product->model_other.'</li>'; 
        }
        if($product->current_location != '')
        {
            $product_details .= '<li ><strong>Location: </strong>'.$product->current_location.'</li>'; 
        }
        
        $product_details .= '</ul></div><div class="col-md-6">
                                <ul class="cranedtlslist">';
        if($product->fly_jib != '')
        {
            $product_details .= '<li ><strong>Fly jib:</strong> '.$product->fly_jib.'</li>';
        }
        
        if($product->luffing_jib != '')
        {
            $product_details .= '<li ><strong>Luffing jib:</strong>'.$product->luffing_jib.'</li>'; 
        }
        if($product->registered_number != '')
        {
            $product_details .= '<li ><strong>Registered Number:</strong> '.$product->registered_number.'</li>'; 
        }
        if($life_tax_details != '')
        {
            $product_details .= '<li ><strong>Life Tax Details:</strong> '.$life_tax_details.'</li>'; 
        }
        if($product->condition != '')
        {
            $product_details .= '<li ><strong>Condition:</strong> '.$product->condition.'</li>'; 
        }
        if($product->bucket_capacity != '')
        {
            $product_details .= '<li ><strong>Bucket Capacity:</strong> '.$product->bucket_capacity.'</li>'; 
        }
        if($product->manufacture_year != '')
        {
            $product_details .= '<li ><strong>Manufacure Year:</strong> '.$product->manufacture_year.'</li>'; 
        }
        if($product->boom_length != '')
        {
            $product_details .= '<li ><strong>Boom Length:</strong> '.$product->boom_length.'</li>'; 
        }
        if($product->kelly_length != '')
        {
            $product_details .= '<li ><strong>Kelly Length:</strong>'.$product->kelly_length.'</li>'; 
        }
        if($product->arm_length != '')
        {
            $product_details .= '<li ><strong>Arm Length:</strong>'.$product->arm_length.'</li>'; 
        }
        if($product->numberof_axles != '')
        {
            $product_details .= '<li ><strong>Number of axles:</strong> '.$product->numberof_axles.'</li>'; 
        }
        
        if($product->dimensions != '')
        {
            $product_details .= '<li ><strong>Dimentions:</strong> '.$product->dimensions.'</li>'; 
        }
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
        if(Yii::$app->user->id != $product->user_id)
        {
	    if($product->product_type == 0)
            	$hirenowbutton = '<button type="button" class="btn btn-bei" onclick="order_now('.$product->product_id.');">Hire Now</button>';
            else if($product->product_type == 1)
            	$hirenowbutton = '<button type="button" class="btn btn-bei" onclick="order_now('.$product->product_id.');">Buy Now</button>';
            else if($product->product_type == 2)
            	$hirenowbutton = '<button type="button" class="btn btn-bei" onclick="order_now('.$product->product_id.');">Hire / Buy</button>';
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
        return $data;
        
        }catch (ErrorException $ex) {
            Yii::warning($ex->getMessage());
        }
        
        
    
    }
    
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
        
        return $capacity = $capacity->groupBy(['core_products.capacity'])->All();
    }
    
    function select_user_id_by_product_id($product_id)
    {
        $query = new Query;
        $count = $query->select('user_id')->from('core_products')->where("product_id = '$product_id'")->All();
        return $count[0]['user_id'];
    }
    
    
    
}
