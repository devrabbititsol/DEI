<?php 
//remove Advt. images session data when refresh
$session = Yii::$app->session;
if($session->has('advt_images'))
    $session->remove('advt_images');
if($session->has('advt_images_names'))
    $session->remove('advt_images_names');
?>
<div class="banner-bei">
<div class="container-fluid">
	<div class="row">
		
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

		  <!-- Wrapper for slides -->
		  <div class="carousel-inner" role="listbox">
			<div class="item active">
			  <img src="images/banner-1.png" alt="ss">
			  <div class="carousel-caption">
                             <!-- <h4>Welcome <?php //echo $country_name; ?>!</h4>
			  	<h2>TO THE LOGISTICS REVOLUTION...</h2>-->
				<!-- start added by DEI IT Team -->
				<!--<h2>URGENT REQUIREMENT FOR KOCHI METRO: 6 CRANES AND 4 PILING RIGS</h2> 
				<h4><a href="#"style="color:#ea2e2e;">Call Us</a> &nbsp; +91- 9246611422</h4> -->
                                <h2>URGENT REQUIREMENT FOR KOCHI METRO: 6 CRANES AND 4 PILING RIGS</h2>
                                <h4><a href="#"style="color:#ea2e2e;">Call Us</a> &nbsp; +91- 9246611422</h4>
				<!-- end add by DEI IT Team -->
			  	<!--<h4>Pioneering an innovative and easier way to facilitate equipments related logistics, across India.</h4>-->
			  </div>
			</div>
                        <div class="item">
			  <img src="images/banner-2.png" alt="ss">
			  <div class="carousel-caption">
			  	<!--<h2>POST YOUR CLASSIFIEDS HERE</h2>
                                <h4><a href="<?php //echo Yii::$app->params['SITE_URL']; ?>contact" style="color:#ea2e2e;">Contact us</a> for placing your classifieds with us</h4>-->
								<!-- start added by DEI IT Team -->
				<!--<h4>Welcome <?php //echo $country_name; ?>!</h4>
			  	<h2>TO THE LOGISTICS REVOLUTION...</h2>-->
				<!--<h2>WANTED IN GUJARAT: Three TYRE MOUNTED CRANES FOR 12 MONTHS - 50 TONS</h2>
				<h4><a href="#"style="color:#ea2e2e;">Contact Parminder Singh</a>&nbsp; +91- 9725289394</h4>-->
                                <h2>WANTED IN GUJARAT: HYDRAULIC TRUCK CRANE WITH 25-30 TON FOR 2 MONTHS</h2>
                                <h4><a href="<?php echo Yii::$app->params['SITE_URL']; ?>contact"style="color:#ea2e2e;">Contact us</a>&nbsp;at <a href="<?php echo Yii::$app->params['SITE_URL']; ?>contact" style="color:#ea2e2e;">http://digitalequipmentsindia.com/contact</a> or +91.83338 93338</h4> 
				<!-- End added by DEI IT Team -->
								
			  </div>
			</div>
                        <div class="item">
			  <img src="images/banner-1.png" alt="ss">
			  <div class="carousel-caption">
			  	<!--<h2>GROW YOUR BUSINESS WITH US</h2>
                                <h4><a href="<?php //echo Yii::$app->params['SITE_URL']; ?>contact" style="color:#ea2e2e;">Contact us</a> for placing your classifieds with us</h4>-->
				<!-- start added by DEI IT Team -->
				<!--<h2>URGENT REQUIREMENT FOR KOCHI METRO: Four ROUGH TERRAIN CRANES - 50 TONS</h2> 
				<h4><a href="<?php echo Yii::$app->params['SITE_URL']; ?>contact" style="color:#ea2e2e;">Contact us</a> for more details</h4>-->
                                <h2>URGENT REQUIREMENT FOR KOCHI METRO: Four ROUGH TERRAIN CRANES - 50 TONS</h2>
                                <h4><a href="<?php echo Yii::$app->params['SITE_URL']; ?>contact" style="color:#ea2e2e;">Contact us</a> for more details</h4>
				<!-- end add by DEI IT Team -->
			  </div>
			</div>
			<div class="item">
			  <img src="images/banner-2.png" alt="ss">
			  <div class="carousel-caption">
			  	<!--<h2>INFRASTRUCTURE REVOLUTION OF INDIA</h2>
			  	<h4>Digital India driven initiative, aiming to bring all construction related equipments in India to a single platform.</h4>-->
				<!-- start added by DEI IT Team -->
				<!--<h2>URGENT REQUIREMENT FOR KOCHI METRO: Two ALL TERRAIN CRANES - 200 TONS</h2> 
				<h4><a href="<?php echo Yii::$app->params['SITE_URL']; ?>contact" style="color:#ea2e2e;">Contact us</a> for more details</h4>-->
                                <h2>URGENT REQUIREMENT FOR KOCHI METRO: Two ALL TERRAIN CRANES - 200 TONS</h2>
                                <h4><a href="<?php echo Yii::$app->params['SITE_URL']; ?>contact" style="color:#ea2e2e;">Contact us</a> for more details</h4>   
				<!-- end add by DEI IT Team -->
			  </div>
			</div>
                        <div class="item">
			  <img src="images/banner-1.png" alt="ss">
			  <div class="carousel-caption">
			  	<!--<h2>FIND YOUR CUSTOMERS EASILY</h2>
                                <h4><a href="<?php //echo Yii::$app->params['SITE_URL']; ?>contact" style="color:#ea2e2e;">Contact us</a> for placing your classifieds with us</h4>-->
				<!-- start added by DEI IT Team -->
				<!--<h2>URGENT REQUIREMENT FOR KOCHI METRO: Two HR180 PILING RIGS - 50 Meter Kelly Bar</h2> 
				<h4><a href="<?php echo Yii::$app->params['SITE_URL']; ?>contact" style="color:#ea2e2e;">Contact us</a> for more details</h4>-->
                                <h2>NEW REQUIREMENT IN GUJARAT-2: 40 TON HYDRAULIC TRUCK CRANE FOR SHORT TERM. NO OLDER THAN 6 YEARS.</h2>
                                <h4><a href="<?php echo Yii::$app->params['SITE_URL']; ?>contact" style="color:#ea2e2e;">Contact us</a>&nbsp;at <a href="<?php echo Yii::$app->params['SITE_URL'];  ?>contact" style="color:#ea2e2e;">http://digitalequipmentsindia.com/contact</a> or +91-83338 93338</h4> 
				<!-- end add by DEI IT Team -->
			  </div>
			</div>
                        <div class="item">
			  <img src="images/banner-2.png" alt="ss">
			  <div class="carousel-caption">
			  	<!--<h2>HELP IS ONE-CLICK AWAY, 24X7</h2>
                                <h4><a href="<?php //echo Yii::$app->params['SITE_URL']; ?>contact" style="color:#ea2e2e;">Contact us</a> for placing your classifieds with us</h4>-->
			  <!-- start added by DEI IT Team -->
				<!--<h2>URGENT REQUIREMENT FOR KOCHI METRO: 6 CRANES AND 4 PILING RIGS</h2> 
				<h4><a href="#"style="color:#ea2e2e;">Call Us</a> +91- 9246611422</h4> -->
				<!--<h2>WANTED IN PARADEEP: 60-80 TON TRUCK MOUNTED TELESCOPIC  CRANE WITH 120 FT. BOOM FOR 1 YEAR at IOCL PROJECT</h2> 
				<h4><a href="#"style="color:#ea2e2e;">Contact Parminder Singh</a> +91. 9725289394</h4>-->
                                <h2>WANTED IN GUJARAT: HYDRAULIC TRUCK CRANE WITH 40 TON FOR 2 MONTHS</h2>
                                <h4><a href="<?php echo Yii::$app->params['SITE_URL']; ?>contact" style="color:#ea2e2e;">Contact us</a>&nbsp;at <a href="<?php echo Yii::$app->params['SITE_URL'];  ?>contact" style="color:#ea2e2e;">http://digitalequipmentsindia.com/contact</a> or +91-83338 93338</h4>
 
				<!-- end add by DEI IT Team -->
			  </div>
			</div>
                        <div class="item">
			  <img src="images/banner-1.png" alt="ss">
			  <div class="carousel-caption">
			  <!--<h2>POST YOUR CLASSIFIEDS HERE</h2>
              <h4><a href="<?php echo Yii::$app->params['SITE_URL']; ?>contact" style="color:#ea2e2e;">Contact us</a> for placing your classifieds with us</h4>-->
			   <h2>WE ARE CREATING DEMANDS FOR YOUR EQUIPMENTS</h2>
			  	<!--<h2>INTERNATIONAL SUPPLIERS FOR INDIAN CUSTOMERS</h2>
                                <h4><a href="<?php //echo Yii::$app->params['SITE_URL']; ?>contact" style="color:#ea2e2e;">Contact us</a> for placing your classifieds with us</h4>-->
			  </div>
			</div>
			
		  </div>

		  <!-- Controls -->
		  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
			<span class="fa fa-angle-left" aria-hidden="true"></span>
			
		  </a>
		  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
			<span class="fa fa-angle-right" aria-hidden="true"></span>
		  </a>
		</div>
	</div>
</div>
</div>
<section class="mobwheel gap">
<div class="container">
	<div class="row">
		<div class="machine-anim">
		  <!-- Nav tabs -->
		  <ul class="nav nav-tabs" role="tablist">
			<li role="presentation">
				<a href="#" data-toggle="modal" data-target="#cranes">
					<img src="images/machine-1.png" alt="">
					<p>cranes <span><?=$cranescount;?></span></p>
				</a>
				<img src="images/aw.png" alt="">
				<img src="images/wa_static_box.png" alt="">
				<img src="images/exwaimg.png" alt="">
			</li>
			<li role="presentation">
				<a href="#rigs" data-toggle="modal" data-target="#rigs">
					<img src="images/machine-2.png" alt="">
					<p>rigs <span><?=$rigscount;?></span></p>
				</a>
				<img src="images/aw.png" alt="">
				<img src="images/wa_static_box.png" alt="">
				<img src="images/exwaimg.png" alt="">
			</li>
			<li role="presentation">
				<a href="#excavators" data-toggle="modal" data-target="#excavators">
					<img src="images/machine-3.png" alt="">
					<p>excavators <span><?=$excavatorscount;?></span></p>
				</a>
				<img src="images/aw.png" alt="">
				<img src="images/wa_static_box.png" alt="">
			</li>
			<li role="presentation">
				<a href="#dumpers" data-toggle="modal" data-target="#dumpers">
					<img src="images/machine-4.png" alt="">
					<p>dumpers <span><?=$dumperscount;?></span></p>
				</a>
				<img src="images/aw.png" alt="">
				<img src="images/wa_static_box.png" alt="">
				<img src="images/exwaimg.png" alt="">
			</li>
			<li role="presentation">
				<a href="#generators" data-toggle="modal" data-target="#generators">
					<img src="images/machine-5.png" alt="">
					<p>generators <span><?=$generatorscount;?></span></p>
				</a>
				<img src="images/aw.png" alt="">
				<img src="images/wa_static_box.png" alt="">
				<img src="images/exwaimg.png" alt="">
			</li>
		  </ul>

		  <!-- Tab panes -->
		  <div class="tab-content">
			<div role="tabpane" class="tab-pane active">
				<ul class="">
					<li><a>
						<img src="images/hireorsupply.png" alt="">
						<span>Hire</span>
					</a></li>
					<li><a>
						<img src="images/hireorsupply.png" alt="">
						<span>Supply</span>
					</a></li>
					<li><a>
						<img src="images/buyorsell.png" alt="">
						<span>Sell</span>
					</a></li>
					<li><a>
						<img src="images/buyorsell.png" alt="">
						<span>Buy</span>
					</a></li>
				</ul>
			</div>
			
			
		  </div>
		</div>
	</div>
</div>
</section>

<section class="gap pt40">
<div class="container">
	<div class="row">
    <div class="main_headding nomb">
            <h2><span>Our</span> advertisers</h2>
    </div>
    <?php 
    if(Yii::$app->user->isGuest)
        echo '<a href="login" class="btn btn-default pull-right postyourad">POST YOUR ADVT</a>';
    else
        echo '<a href="#" class="btn btn-default pull-right postyourad" data-toggle="modal" data-target="#postad_modal">POST YOUR ADVT</a>';
    ?>
    <div class="clearfix"></div>
    <div id="addvertise" class="carousel slide" data-ride="carousel">
 		
  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <?php 
    $i=0;
    foreach($ads as $ad):	
    $ad = (object)$ad;
    $ad_image= @$ad->ad_image_url;
    $ad_width= $ad->ad_width;  
    $ad_height= $ad->ad_height; 

	if($ad_height > 360 || $ad_width > 1400){
	
// Calculate ratio of desired maximum sizes and original sizes.
    $widthRatio = 1400 / $ad_width;
    $heightRatio = 360 / $ad_height;

    // Ratio used for calculating new image dimensions.
    $ratio = min($widthRatio, $heightRatio);

    // Calculate new image dimensions.
    $ad_width  = floor((int)$ad_width  * $ratio);
    $ad_height = floor((int)$ad_height * $ratio);
    }
    ?>
      <div class="item <?php if($i==0) echo "active";?>" >
          <center><h4>Name of Advertiser:&nbsp;<strong><?php echo @$ad->company_name; ?></strong></h4></center>
        <a href="<?php echo @$ad->ad_weblink;?>" target="_blank">
            <center>
               <img style="width:<?php echo $ad_width; ?>px;height:<?php echo $ad_height; ?>px;" src="<?php echo $ad_image; ?>" alt="<?php echo $ad->ad_title;?>">
            </center>
        </a>
    </div>
    <?php $i++; endforeach; ?>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#addvertise" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#addvertise" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
		
	</div>
</div>
</section>

<section class="gap rotate40">
	<div class="rotate0">
	<div class="main_headding">
			<h2><span>Our</span> Services</h2>
		</div>
	<div class="container">
		<div class="row">
			<div id="ourservices" class="carousel slide carousel-fade" data-ride="carousel">

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <?php 
    $array_hire_services = array();
    $array_sale_services = array();
    $googleloc = array();
    foreach($services as $service)
    {
        
        //$address = $service['current_location'];
        //$googleloc[] = array("location"=>array('address'=>"$address"),'htmlContent' => "<h1>$address</h1><br/>");
        if($service['product_type'] == 0)
        {
            $array_hire_services[] = $service;
        }
        else if($service['product_type'] == 1 || $service['product_type'] == 2)
        {
            $array_sale_services[] = $service;
        }
        
    }
    if(empty($array_hire_services))
    {
        $array_hire_services[0]['image_url'] = Yii::$app->params['SITE_URL'] ."uploads/noimage.png";
        $array_hire_services[0]['category_name'] = '';
        $array_hire_services[0]['model_name'] = '';
        $array_hire_services[0]['capacity'] = '';
        $array_hire_services[0]['manufacture_year'] = '';
        $array_hire_services[0]['product_id'] = '';
        $array_hire_services[0]['product_type'] = 0;
    }
    if(empty($array_sale_services))
    {
        $array_sale_services[0]['image_url'] = Yii::$app->params['SITE_URL'] ."uploads/noimage.png";
        $array_sale_services[0]['category_name'] = '';
        $array_sale_services[0]['model_name'] = '';
        $array_sale_services[0]['capacity'] = '';
        $array_sale_services[0]['manufacture_year'] = '';
        $array_sale_services[0]['product_id'] = '';
        $array_sale_services[0]['product_type'] = 1;
    }
    if(count($array_hire_services) <= count($array_sale_services))
    {
        $highestdata = $array_sale_services;
        $lowestdata = $array_hire_services;
    }
    else 
    {
        $highestdata = $array_hire_services;
        $lowestdata = $array_sale_services;
    }
    
    $h_index = 0; $s_index = 0;
    for($index=0;$index<count($highestdata);$index++) {
    ?>
      <div class="item <?php if($index==0) { echo "active"; } ?>">
      <div class="col-md-6">
                <div class="service_box">
				<img src="<?php echo $array_hire_services[$h_index]['image_url']; ?>" class="img-responsive" />

			<div class="sevicebox_content">
			   <h4><?php echo @$array_hire_services[$h_index]['category_name'];?></h4>
				<div class="col-sm-4"><p>Model</p><?php echo @$array_hire_services[$h_index]['model_name'];?></div>
				<div class="col-sm-4"><p>Capacity</p><?php echo @$array_hire_services[$h_index]['capacity'];?></div>
				<div class="col-sm-4"><p>Year Of Manufacture</p><?php echo @$array_hire_services[$h_index]['manufacture_year'];?></div>
				<div class="clearfix"></div>
				<div class="hr"></div>
				<div class="footer">
					<div class="col-md-4 col-sm-4">
						
					</div>
					<div class="col-md-8 col-sm-8">
						<a href="products?product_id=<?php echo @$array_hire_services[$h_index]['product_id']; ?>&product_type=<?php if(@$array_hire_services[$h_index]['product_type']==0) echo "hire"; else if(@$array_hire_services[$h_index]['product_type']==1) echo "sale"; else if(@$array_hire_services[$h_index]['product_type']==2) echo "both";?>" class="btn" ><?php if(@$array_hire_services[$h_index]['product_type']==0) echo "hire"; else if(@$array_hire_services[$h_index]['product_type']==1) echo "sale"; else if(@$array_hire_services[$h_index]['product_type']==2) echo "hire/sale";?></a>
                                        </div>
				</div>
				<div class="clearfix"></div>
			</div>

		</div>
  	  </div>
  	  <div class="col-md-6">
                <div class="service_box">
				<img src="<?php echo $array_sale_services[$s_index]['image_url']; ?>" class="img-responsive" />

			<div class="sevicebox_content">
			   <h4><?php echo @$array_sale_services[$s_index]['category_name'];?></h4>
				<div class="col-sm-4"><p>Model</p><?php echo @$array_sale_services[$s_index]['model_name'];?></div>
				<div class="col-sm-4"><p>Capacity</p><?php echo @$array_sale_services[$s_index]['capacity'];?></div>
				<div class="col-sm-4"><p>Year of Manufacture</p><?php echo @$array_sale_services[$s_index]['manufacture_year'];?></div>
				<div class="clearfix"></div>
				<div class="hr"></div>
				<div class="footer">
					<div class="col-md-4 col-sm-4">
						
					</div>
					<div class="col-md-8 col-sm-8">
						<a href="products?product_id=<?php echo @$array_sale_services[$s_index]['product_id']; ?>&product_type=<?php if(@$array_sale_services[$s_index]['product_type']==0) echo "hire"; else if(@$array_sale_services[$s_index]['product_type']==1) echo "sale"; else if(@$array_sale_services[$s_index]['product_type']==2) echo "both";?>" class="btn" ><?php if(@$array_sale_services[$s_index]['product_type']==0) echo "hire"; else if(@$array_sale_services[$s_index]['product_type']==1) echo "sale"; else if(@$array_sale_services[$s_index]['product_type']==2) echo "hire/sale";?></a>    
					</div>
				</div>
				<div class="clearfix"></div>
			</div>

		</div>
  	  </div>
    </div>
      <?php 
      $s_index++;$h_index++;
      if($s_index >= count($array_sale_services))
      {
          $s_index=0;
      }
      if($h_index >= count($array_hire_services))
      {
          $h_index = 0;
      }
      } ?>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#ourservices" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#ourservices" role="button" data-slide="next">
    <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
		</div>
	</div>
	
	</div>
</section>


<section class="gap clients">
<div class="container">
	<div class="row">
		<div class="main_headding">
			<h2>Clients</h2>
		</div>
		<div id="clients" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#clients" data-slide-to="0" class="active"></li>
    <li data-target="#clients" data-slide-to="1"></li>
    <li data-target="#clients" data-slide-to="2"></li>
    <li data-target="#clients" data-slide-to="3"></li>
    <li data-target="#clients" data-slide-to="4"></li>
    <li data-target="#clients" data-slide-to="5"></li>
    <li data-target="#clients" data-slide-to="6"></li>
    <li data-target="#clients" data-slide-to="7"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <div class="col-md-3 col-sm-6">
          <img src="images/clients/afcons.png" alt="" height="144px" width="244px">
      </div>
      <div class="col-md-3 col-sm-6">
      	<img src="images/clients/ashok_leyland.png" alt="" height="144px" width="244px">
      </div>
      <div class="col-md-3 col-sm-6">
      	<img src="images/clients/bauer.png" alt="" height="144px" width="244px">
      </div>
      <div class="col-md-3 col-sm-6">
      	<img src="images/clients/bharatbenz.jpg" alt="" height="144px" width="244px">
      </div>
    </div>
    <div class="item">
      <div class="col-md-3 col-sm-6">
      	<img src="images/clients/bhel.png" alt="" height="144px" width="244px">
      </div>
      <div class="col-md-3 col-sm-6">
      	<img src="images/clients/bridge.png" alt="" height="144px" width="244px">
      </div>
      <div class="col-md-3 col-sm-6">
      	<img src="images/clients/casagrande.png" alt="" height="144px" width="244px">
      </div>
      <div class="col-md-3 col-sm-6">
      	<img src="images/clients/caterpillar.jpg" alt="" height="144px" width="244px">
      </div>
    </div>
    <div class="item">
      <div class="col-md-3 col-sm-6">
      	<img src="images/clients/demag.jpg" alt="" height="144px" width="244px">
      </div>
      <div class="col-md-3 col-sm-6">
      	<img src="images/clients/escorts.jpg" alt="" height="144px" width="244px">
      </div>
      <div class="col-md-3 col-sm-6">
      	<img src="images/clients/jcb.png" alt="" height="144px" width="244px">
      </div>
      <div class="col-md-3 col-sm-6">
      	<img src="images/clients/kato.jpg" alt="" height="144px" width="244px">
      </div>
    </div>
    <div class="item">
      <div class="col-md-3 col-sm-6">
      	<img src="images/clients/kobelco.png" alt="" height="144px" width="244px">
      </div>
      <div class="col-md-3 col-sm-6">
      	<img src="images/clients/landt.png" alt="" height="144px" width="244px">
      </div>
      <div class="col-md-3 col-sm-6">
      	<img src="images/clients/liebherr_symbol.jpg" alt="" height="144px" width="244px">
      </div>
      <div class="col-md-3 col-sm-6">
      	<img src="images/clients/ace.jpg" alt="" height="144px" width="244px">
      </div>
    </div>
    <div class="item">
      <div class="col-md-3 col-sm-6">
      	<img src="images/clients/mait.jpg" alt="" height="144px" width="244px">
      </div>
      <div class="col-md-3 col-sm-6">
      	<img src="images/clients/megaengineering.png" alt="" height="144px" width="244px">
      </div>
      <div class="col-md-3 col-sm-6">
      	<img src="images/clients/Mercedes-Benz-logo.jpg" alt="" height="144px" width="244px">
      </div>
      <div class="col-md-3 col-sm-6">
      	<img src="images/clients/nec.png" alt="" height="144px" width="244px">
      </div>
    </div>
    <div class="item">
      <div class="col-md-3 col-sm-6">
      	<img src="images/clients/PHLogo.jpg" alt="" height="144px" width="244px">
      </div>
      <div class="col-md-3 col-sm-6">
      	<img src="images/clients/rsz_xcmg.png" alt="" height="144px" width="244px">
      </div>
      <div class="col-md-3 col-sm-6">
      	<img src="images/clients/rsz_zoomlion.png" alt="" height="144px" width="244px">
      </div>
      <div class="col-md-3 col-sm-6">
      	<img src="images/clients/sany.jpg" alt="" height="144px" width="244px">
      </div>
    </div>
    <div class="item">
      <div class="col-md-3 col-sm-6">
      	<img src="images/clients/scania.png" alt="" height="144px" width="244px">
      </div>
      <div class="col-md-3 col-sm-6">
      	<img src="images/clients/simplex_logo.png" alt="" height="144px" width="244px">
      </div>
      <div class="col-md-3 col-sm-6">
      	<img src="images/clients/tadano.png" alt="" height="144px" width="244px">
      </div>
      <div class="col-md-3 col-sm-6">
      	<img src="images/clients/tata-logo-large.jpg" alt="" height="144px" width="244px">
      </div>
    </div>
    <div class="item">
      <div class="col-md-3 col-sm-6">
      	<img src="images/clients/terex.jpg" alt="" height="144px" width="244px">
      </div>
      <div class="col-md-3 col-sm-6">
      	<img src="images/clients/Volvo_logo.png" alt="" height="144px" width="244px">
      </div>
      <!--<div class="col-md-3 col-sm-6">
      	<img src="images/clients/XCMG_logo.png" alt="" height="144px" width="244px">
      </div>
      <div class="col-md-3 col-sm-6">
      	<img src="images/clients/zoomlion-logo.png" alt="" height="144px" width="244px">
      </div>-->
    </div>
    
  </div>

</div>
	</div>
</div>
</section>
<div class="container">
    <div class="col-md-12">
        <?php 
        foreach($locations as $location)
        {
           
            $address = '';
            if($location['city'] != '')
            {
                $address .= $location['city'];
            }
            if($location['state'] != '')
            {
                $address .= ', '.$location['state'];
            }
            if($location['country'] != '')
            {
                $address .= ', '.$location['country'];
            }
            $id=$location['location_id'];
            $country=$location['country'];
            if($location['location_type']==1 && $location['latitude'] != '' && $location['longitude'] != '')
                $googleloc[] = array("location"=>array('address'=>"$address",'country' => "$country",'lat'=> floatval($location['latitude']),'lng'=>floatval($location['longitude'])),'htmlContent' => "<h4>$address</h4>");
        }
        echo yii2mod\google\maps\markers\GoogleMaps::widget([
            'userLocations' => $googleloc,
            'googleMapsUrlOptions' => [
                'key' => 'AIzaSyBi5QVhAovYYFVqpNPi3upJ8fhtBtxwEX8',
                'language' => 'EN',
                'version' => '3.1.18',
            ],
            'googleMapsOptions' => [
                'mapTypeId' => 'roadmap',
                'tilt' => 45,
                'center' => ['lat' => floatval($lat), 'lng' => floatval($lng)],
                'zoom' => 7,
                
            ],
            'wrapperHeight' => '350px',
        ]);
        ?>
    </div>
</div>

<!------------------------------ wheel models ---------------------------->
<!-- Modal -->
<div class="modal fade wapop" id="cranes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" >Cranes</h4>
      </div>
      <div class="modal-body">
        <div class="redoptions">
            <ul class="">
                <li><a href="products?product_type=hire&category=1">
                        <img src="images/hireorsupply.png" alt="">
                        <span>Hire</span>
                </a></li>
                <li><a href="addproduct?product_type=hire&category=1">
                        <img src="images/hireorsupply.png" alt="">
                        <span>Supply</span>
                </a></li>
                <li><a href="addproduct?product_type=sale&category=1">
                        <img src="images/buyorsell.png" alt="">
                        <span>Sell</span>
                </a></li>
                <li><a href="products?product_type=sale&category=1">
                        <img src="images/buyorsell.png" alt="">
                        <span>Buy</span>
                </a></li>
            </ul>
        </div>
      </div>
      
    </div>
  </div>
</div>

<div class="modal fade wapop" id="rigs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Rigs</h4>
      </div>
      <div class="modal-body">
        <div class="redoptions">
            <ul class="">
                <li><a href="products?product_type=hire&category=5">
                        <img src="images/hireorsupply.png" alt="">
                        <span>Hire</span>
                </a></li>
                <li><a href="addproduct?product_type=hire&category=5">
                        <img src="images/hireorsupply.png" alt="">
                        <span>Supply</span>
                </a></li>
                <li><a href="addproduct?product_type=sale&category=5">
                        <img src="images/buyorsell.png" alt="">
                        <span>Sell</span>
                </a></li>
                <li><a href="products?product_type=sale&category=5">
                        <img src="images/buyorsell.png" alt="">
                        <span>Buy</span>
                </a></li>
            </ul>
        </div>
      </div>
      
    </div>
  </div>
</div>

<div class="modal fade wapop" id="excavators" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Excavators</h4>
      </div>
      <div class="modal-body">
        <div class="redoptions">
            <ul class="">
                <li><a href="products?product_type=hire&category=3">
                        <img src="images/hireorsupply.png" alt="">
                        <span>Hire</span>
                </a></li>
                <li><a href="addproduct?product_type=hire&category=3">
                        <img src="images/hireorsupply.png" alt="">
                        <span>Supply</span>
                </a></li>
                <li><a href="addproduct?product_type=sale&category=3">
                        <img src="images/buyorsell.png" alt="">
                        <span>Sell</span>
                </a></li>
                <li><a href="products?product_type=sale&category=3">
                        <img src="images/buyorsell.png" alt="">
                        <span>Buy</span>
                </a></li>
            </ul>
        </div>
      </div>
      
    </div>
  </div>
</div>

<div class="modal fade wapop" id="dumpers" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Dumpers</h4>
      </div>
      <div class="modal-body">
        <div class="redoptions">
            <ul class="">
                <li><a href="products?product_type=hire&category=2">
                        <img src="images/hireorsupply.png" alt="">
                        <span>Hire</span>
                </a></li>
                <li><a href="addproduct?product_type=hire&category=2">
                        <img src="images/hireorsupply.png" alt="">
                        <span>Supply</span>
                </a></li>
                <li><a href="addproduct?product_type=sale&category=2">
                        <img src="images/buyorsell.png" alt="">
                        <span>Sell</span>
                </a></li>
                <li><a href="products?product_type=sale&category=2">
                        <img src="images/buyorsell.png" alt="">
                        <span>Buy</span>
                </a></li>
            </ul>
        </div>
      </div>
      
    </div>
  </div>
</div>

<div class="modal fade wapop" id="generators" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Generators</h4>
      </div>
      <div class="modal-body">
        <div class="redoptions">
            <ul class="">
                <li><a href="products?product_type=hire&category=4">
                        <img src="images/hireorsupply.png" alt="">
                        <span>Hire</span>
                </a></li>
                <li><a href="addproduct?product_type=hire&category=4">
                        <img src="images/hireorsupply.png" alt="">
                        <span>Supply</span>
                </a></li>
                <li><a href="addproduct?product_type=sale&category=4">
                        <img src="images/buyorsell.png" alt="">
                        <span>Sell</span>
                </a></li>
                <li><a href="products?product_type=sale&category=4">
                        <img src="images/buyorsell.png" alt="">
                        <span>Buy</span>
                </a></li>
            </ul>
        </div>
      </div>
      
    </div>
  </div>
</div>

<div class="modal fade" id="postad_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Post Your Advetisement</h5>

            </div>

            <div class="modal-body">

                <form action="facebookad" method="post" enctype="multipart/form-data" id="adform">
                    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                    <?php $user = Yii::$app->user->identity; ?>

                    <div class="modal-post">
                        <div class="col-md-6 col-md-offset-3 error-message" style="display: none;">
                            <div class="alert alert-danger">
                                <center>* All fields are mandatory</center>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Your Name " name="name" value="<?= @$user->user_name ?>" <?php if (@$user->user_id != '') echo "readonly"; ?> required autocomplete="off" onKeyUp="this.value=this.value.replace(/[^A-z]/g,'');">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                <input type="text" class="form-control" placeholder="Your Mobile No " name="phone" required value="<?php if (@$user->phone_number != '') echo @$user->phone_number;
                    else echo '91'; ?>"  maxlength="13" onKeyUp="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" readonly>
                                </div>
                            </div>

                        </div>
                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group">
                                <input type="email" class="form-control" placeholder="Your Email Address " name="email" value="<?= @$user['email'] ?>" <?php if (@$_SESSION['user_id'] != '') echo "readonly"; ?> required readonly>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                <input type="text" class="form-control" placeholder="Title " name="title" required>
                                </div>
                            </div>

                        </div>
                        <div class="row">

                            <div class="col-sm-12">
                                <div class="form-group">
                                <input type="url2" class="form-control" placeholder="Website URL" name="weblink">
                                </div>
                            </div>

                        </div>
                        <div class="row">

                            <div class="col-sm-12">
                                <div class="form-group">
                                <textarea class="mess" name="comments" placeholder="Comments/Queries" style="width:100%;"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="row">

                        <div class="col-md-12">
                          <div class="form-group">
                               <input type="hidden" id="advt_images" required class="form-control" placeholder="Upload Your Images " name="advt_images">
                          </div>
                          <div class="upload-ad-photos">
                              <h4>Upload Images</h4>
                            <div id="advtimages" class="dropzone dropzone-previews"></div>

                          </div>
                        </div>
                        
                        </div>
                        <div class="row pt40">
                            <?php if(strtotime(Yii::$app->params['PROMOTIONAL_OFFER_UPTO']) >= strtotime(date('Y-m-d'))){ ?>
                            <div class="col-sm-12">
                                <div class="form-group">
                                <input type="radio" name="advt_package" value="0" class="form-control styled-radio" <?php if(@$_GET['package'] == 0) { echo 'checked="checked"'; } ?> id="styled-radio-0"><label for="styled-radio-0" class="checkc">Promotional Offer (Valid upto <?= date('F dS, Y',strtotime(Yii::$app->params['PROMOTIONAL_OFFER_UPTO'])) ?>)</label>
                            
                                </div>
                            </div>
                            <?php } ?>
                            <div class="col-sm-12">
                                <div class="form-group">
                                <input type="radio" name="advt_package" value="1" class="form-control styled-radio" <?php if(@$_GET['package'] == 1) { echo 'checked="checked"'; } else if(!isset($_GET['package'])) { echo 'checked="checked"'; } ?> id="styled-radio-1"><label for="styled-radio-1" class="checkc">1 Month (50,000/- Validity 1month)</label>
                            
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                <input type="radio" name="advt_package" value="2" class="form-control styled-radio" id="styled-radio-2" <?php if(@$_GET['package'] == 2) { echo 'checked="checked"'; } ?>><label for="styled-radio-2" class="checkc">3 Months (1,50,000/- Validity 3+1 months)</label>
                            
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                <input type="radio" name="advt_package" value="3" class="form-control styled-radio" id="styled-radio-3" <?php if(@$_GET['package'] == 3) { echo 'checked="checked"'; } ?>><label for="styled-radio-3" class="checkc">6 Months(3,00,000/- Validity 6+3 months)</label>
                                </div>
                            </div>    
                            <div class="col-sm-12">
                                <div class="form-group">
                                <input type="radio" name="advt_package" value="4" class="form-control styled-radio" id="styled-radio-4" <?php if(@$_GET['package'] == 4) { echo 'checked="checked"'; } ?>><label for="styled-radio-4" class="checkc">8 Months(4,00,000/- Validity 8+4 months)</label>
                                </div>
                            </div>    
                        </div>
                        

                    </div>

                    <div class="text-center"> </div>

                    <div class="modal-footer">

                        <input type="button" class="btn btn-info" data-dismiss="modal" value="Close">

                        <input type="submit" name="adpost" value="Submit" onclick="validateAdvtimage()" class="btn grnn advtimage">

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>
<?php if(count(@$response)>0){?>
<div id="errorDialog" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Warning</h4>
      </div>
      <div class="modal-body">
         <?php for($i=0;$i<=count(@$response);$i++){ ?>
            <p><?php echo @$response[$i];?></p>
        <?php } ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<?php }else if(isset($response) && count(@$response)==0){?>
<div id="successDialog" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Success</h4>
      </div>
      <div class="modal-body">
         Your Ad submitted Successfully.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<?php } ?>
<script>
jQuery.validator.addMethod("url2", function(val, elem) {
    if (val.length == 0) { return true; }

    if(!/^(https?|ftp):\/\//i.test(val)) {
        val = 'http://'+val; // set both the value
        $(elem).val(val); // also update the form element
    }
    return /^(https?|http?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(val);
});
$(document).ready(function(){
    $("#adform").validate();
  <?php if(@$_GET['package'] != '') {?>
      $('#postad_modal').modal('show');    
  <?php } ?>
  <?php if(count(@$response)>0) {?>
          $('#errorDialog').modal('show');

          //$('#postad_modal').modal('show');
  <?php }else if(isset($response) && count(@$response)==0){ ?>
      $('#successDialog').modal('show');
  <?php } ?>
});
//reload page after model close
$('#successDialog').on('hidden.bs.modal', function (e) {
   window.location.href = '<?php echo Yii::$app->params['SITE_URL']; ?>';
})
//need to call following while body onload    
 $(document).ready(function () {

        Dropzone.autoDiscover = false;
        $("div#advtimages").dropzone({
            maxFiles: 7,
            url: "uploadadvtimages",
            paramName: 'advt_images',
            acceptedFiles: "image/jpeg,image/png,image/gif",
            maxFilesize: 2,
            init: function () {
                this.on("maxfilesexceeded", function (file) {
                    alert("No more files please! Max 7 Files Allowed");
                });
                this.on('sending', function (file, xhr, formData) {
                    formData.append('advt_images', $("#advt_images").val());
                    $(".advtimage").attr("disabled", true);
                });
                this.on("removedfile", function (file) {
                    $.ajax({
                        url: 'deleteadvtimages',
                        type: "POST",
                        dataType:'html',
                        data: {'filetodelete': file.name, 'category_id': $('#category_id').val(), "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>"},
                        success: function (data) {
                            if (data != "") {
                                $("#advt_images").val('uploaded');
                            } else {
                                $("#advt_images").val('');
                                $("#advtimages").addClass('error');
                                $(".error-message").show();
                            }
                        }
                    });
                });
            },
            success: function (data) {
                $("#advt_images").val('uploaded');
                $("#advtimages").removeClass('error');
                $(".advtimage").attr("disabled", false);
                $(".error-message").hide();
            }
        });
    })

    function validateAdvtimage()
    {
        var files = $("#advt_images").val();
       
        if (files == '' && files != 'uploaded')
        {
            $("#advtimages").addClass('error');
            $(".error-message").show();
        }
        $("#adform").submit(function (e) {
               if($("#advtimages").hasClass('error')){
                    e.preventDefault();
                }
            });

    }
</script>

    
