<div class="banner-bei">
<div class="container-fluid">
	<div class="row">
		
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

		  <!-- Wrapper for slides -->
		  <div class="carousel-inner" role="listbox">
			<div class="item active">
			  <img src="images/banner-1.png" alt="ss">
			  <div class="carousel-caption">
			  	<h2>THE LOGISTICS REVOLUTION...</h2>
			  	<h4>Pioneering an innovative and easier way to facilitate equipments related logistics, across India.</h4>
			  </div>
			  <div class="bannerbtn">
				  <span class="btn btn-default"><a href="recruiter.php">Post Job</a> | <a href="search-job.php">Apply Job</a></span>
				</div>
			</div>
			<div class="item">
			  <img src="images/banner-2.png" alt="ss">
			  <div class="carousel-caption">
			  	<h2>INFRASTRUCTURE REVOLUTION OF INDIA</h2>
			  	<h4>Digital India driven initiative, aiming to bring all construction related equipments in India to a single platform.</h4>
			  </div>
			  <div class="bannerbtn">
			  <span class="btn btn-default"><a href="recruiter.php">Post Job</a> | <a href="search-job.php">Apply Job</a></span>
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
        echo '<a href="login.php" class="btn btn-default pull-right postyourad">Post Your Add</a>';
    ?>
    <div class="clearfix"></div>
    <div id="addvertise" class="carousel slide" data-ride="carousel">
 		
  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <?php 
    $i=0;
    foreach($ads as $ad):		
    $ad_image= unserialize($ad->gallery);   
    ?>
    <div class="item <?php if($i==0) echo "active";?>">
        <a href="<?php echo '';?>" target="_blank">
        <img src="<?php echo 'uploads/'.$ad_image[0]; ?>" alt="...">
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
    foreach($services as $service)
    {
        if($service['listing_type'] == 0)
        {
            $array_hire_services[] = $service;
        }
        else if($service['listing_type'] == 1 || $service['listing_type'] == 2)
        {
            $array_sale_services[] = $service;
        }
    }
    if(count($array_hire_services) >= count($array_sale_services))
        $lowestdata = $array_sale_services;
    else 
        $lowestdata = $array_hire_services;
    for($index=0;$index<count($lowestdata);$index++) {
    ?>
      <div class="item <?php if($index==0) { echo "active"; } ?>">
      <div class="col-md-6">
                <?php 
                if($array_hire_services[$index]['list_image']!='' && file_exists("uploads/".$array_hire_services[$index]['list_image']))
                  {
                  $list_image=$array_hire_services[$index]['list_image'];
                  }
                  else{ $list_image="noimage.png";}
                ?>
		<div class="service_box">
				<img src="<?php echo Yii::$app->homeUrl ."uploads/".$list_image; ?>" class="img-responsive" />

			<div class="sevicebox_content">
			   <h4><?php echo @$array_hire_services[$index]['category_name'];?></h4>
				<div class="col-sm-4"><p>Model</p><?php echo @$array_hire_services[$index]['model_name'];?></div>
				<div class="col-sm-4"><p>Capacity</p><?php echo @$array_hire_services[$index]['capacity'].' '.@$array_hire_services[$index]['metric'];?></div>
				<div class="col-sm-4"><p>Year of Manufacturer</p><?php echo @$array_hire_services[$index]['year_manufacture'];?></div>
				<div class="clearfix"></div>
				<div class="hr"></div>
				<div class="footer">
					<div class="col-md-4 col-sm-4">
						
					</div>
					<div class="col-md-8 col-sm-8">
						<a href="product.php?id=<?php echo @$array_hire_services[$index]['prod_id']; ?>" class="btn" ><?php if(@$array_hire_services[$index]['listing_type']==0) echo "hire"; else if(@$row['listing_type']==1) echo "sale"; else if(@$array_hire_services[$index]['listing_type']==2) echo "hire/sale";?></a>    
					</div>
				</div>
				<div class="clearfix"></div>
			</div>

		</div>
  	  </div>
  	  <div class="col-md-6">
                <?php 
                if($array_sale_services[$index]['list_image']!='' && file_exists("uploads/".$array_sale_services[$index]['list_image']))
                  {
                  $list_image=$array_sale_services[$index]['list_image'];
                  }
                  else{ $list_image="noimage.png";}
                ?>
		<div class="service_box">
				<img src="<?php echo Yii::$app->homeUrl ."uploads/".$list_image; ?>" class="img-responsive" />

			<div class="sevicebox_content">
			   <h4><?php echo @$array_sale_services[$index]['category_name'];?></h4>
				<div class="col-sm-4"><p>Model</p><?php echo @$array_sale_services[$index]['model_name'];?></div>
				<div class="col-sm-4"><p>Capacity</p><?php echo @$array_sale_services[$index]['capacity'].' '.@$array_sale_services[$index]['metric'];?></div>
				<div class="col-sm-4"><p>Year of Manufacturer</p><?php echo @$array_sale_services[$index]['year_manufacture'];?></div>
				<div class="clearfix"></div>
				<div class="hr"></div>
				<div class="footer">
					<div class="col-md-4 col-sm-4">
						
					</div>
					<div class="col-md-8 col-sm-8">
						<a href="product.php?id=<?php echo @$array_sale_services[$index]['prod_id']; ?>" class="btn" ><?php if(@$array_sale_services[$index]['listing_type']==0) echo "hire"; else if(@$array_sale_services[$index]['listing_type']==1) echo "sale"; else if(@$array_sale_services[$index]['listing_type']==2) echo "hire/sale";?></a>    
					</div>
				</div>
				<div class="clearfix"></div>
			</div>

		</div>
  	  </div>
    </div>
      <?php } ?>
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
			<h2><span>Our</span> Clients</h2>
		</div>
		<div id="clients" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#clients" data-slide-to="0" class="active"></li>
    <li data-target="#clients" data-slide-to="1"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <div class="col-md-3 col-sm-6">
      	<img src="images/IndiaPost-logo.png" alt="">
      </div>
      <div class="col-md-3 col-sm-6">
      	<img src="images/L&T-logo.png" alt="">
      </div>
      <div class="col-md-3 col-sm-6">
      	<img src="images/vrl-logo.png" alt="">
      </div>
      <div class="col-md-3 col-sm-6">
      	<img src="images/navata-logo.png" alt="">
      </div>
    </div>
    <div class="item">
      <div class="col-md-3 col-sm-6">
      	<img src="images/IndiaPost-logo.png" alt="">
      </div>
      <div class="col-md-3 col-sm-6">
      	<img src="images/L&T-logo.png" alt="">
      </div>
      <div class="col-md-3 col-sm-6">
      	<img src="images/vrl-logo.png" alt="">
      </div>
      <div class="col-md-3 col-sm-6">
      	<img src="images/navata-logo.png" alt="">
      </div>
    </div>
    
  </div>

</div>
	</div>
</div>
</section>

<div class="row">
    <div class="col-md-12">
        <div id="map_canvas" style="height:350px; border: 2px solid #3872ac;"></div>
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
                <li><a href="classifieds.php?listing_type=hire&category=1">
                        <img src="images/hireorsupply.png" alt="">
                        <span>Hire</span>
                </a></li>
                <li><a href="post-ad.php?listing_type=hire&category=1">
                        <img src="images/hireorsupply.png" alt="">
                        <span>Supply</span>
                </a></li>
                <li><a href="post-ad.php?listing_type=sale&category=1">
                        <img src="images/buyorsell.png" alt="">
                        <span>Sell</span>
                </a></li>
                <li><a href="classifieds.php?sel_listing_type=buy&listing_type=sale&category=1">
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
                <li><a href="classifieds.php?listing_type=hire&category=5">
                        <img src="images/hireorsupply.png" alt="">
                        <span>Hire</span>
                </a></li>
                <li><a href="post-ad.php?listing_type=hire&category=5">
                        <img src="images/hireorsupply.png" alt="">
                        <span>Supply</span>
                </a></li>
                <li><a href="post-ad.php?listing_type=sale&category=5">
                        <img src="images/buyorsell.png" alt="">
                        <span>Sell</span>
                </a></li>
                <li><a href="classifieds.php?sel_listing_type=buy&listing_type=sale&category=5">
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
                <li><a href="classifieds.php?listing_type=hire&category=3">
                        <img src="images/hireorsupply.png" alt="">
                        <span>Hire</span>
                </a></li>
                <li><a href="post-ad.php?listing_type=hire&category=3">
                        <img src="images/hireorsupply.png" alt="">
                        <span>Supply</span>
                </a></li>
                <li><a href="post-ad.php?listing_type=sale&category=3">
                        <img src="images/buyorsell.png" alt="">
                        <span>Sell</span>
                </a></li>
                <li><a href="classifieds.php?sel_listing_type=buy&listing_type=sale&category=3">
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
                <li><a href="classifieds.php?listing_type=hire&category=2">
                        <img src="images/hireorsupply.png" alt="">
                        <span>Hire</span>
                </a></li>
                <li><a href="post-ad.php?listing_type=hire&category=2">
                        <img src="images/hireorsupply.png" alt="">
                        <span>Supply</span>
                </a></li>
                <li><a href="post-ad.php?listing_type=sale&category=2">
                        <img src="images/buyorsell.png" alt="">
                        <span>Sell</span>
                </a></li>
                <li><a href="classifieds.php?sel_listing_type=buy&listing_type=sale&category=2">
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
                <li><a href="classifieds.php?listing_type=hire&category=4">
                    <img src="images/hireorsupply.png" alt="">
                    <span>Hire</span>
                </a></li>
                <li><a href="post-ad.php?listing_type=hire&category=4">
                    <img src="images/hireorsupply.png" alt="">
                    <span>Supply</span>
                </a></li>
                <li><a href="post-ad.php?listing_type=sale&category=4">
                    <img src="images/buyorsell.png" alt="">
                    <span>Sell</span>
                </a></li>
                <li><a href="classifieds.php?sel_listing_type=buy&listing_type=sale&category=4">
                    <img src="images/buyorsell.png" alt="">
                    <span>Buy</span>
                </a></li>
            </ul>
        </div>
      </div>
      
    </div>
  </div>
</div>
<!--<script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=geometry,places&ext=.js"></script> -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBi5QVhAovYYFVqpNPi3upJ8fhtBtxwEX8&libraries=places&callback=initialize&libraries=geometry,places&ext=.js" async defer></script>
<script>
var locations = <?php echo json_encode($locations); ?>;
var geocoder;
var map;
var bounds = new google.maps.LatLngBounds();

function initialize() {
    map = new google.maps.Map(
    document.getElementById("map_canvas"), {
        center: new google.maps.LatLng(20.5937, 78.9629),
        zoom: 13,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    geocoder = new google.maps.Geocoder();

    for (i = 0; i < locations.length; i++) {


        geocodeAddress(locations, i);
    }
}
google.maps.event.addDomListener(window, "load", initialize);

function geocodeAddress(locations, i) {
    console.log(locations[i]);
    var title = locations[i].id;
    var address = locations[i].location;
    if(locations[i].city != '')
    {
        address = address+', '+locations[i].city;
    }
    if(locations[i].state != '')
    {
        address = address+', '+locations[i].state;
    }
    if(locations[i].country != '')
    {
        address = address+', '+locations[i].country;
    }
    
    var url = locations[i].id;
    geocoder.geocode({
        'address': address
    },

    function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            var marker = new google.maps.Marker({
                icon: 'http://maps.google.com/mapfiles/ms/icons/blue.png',
                map: map,
                position: results[0].geometry.location,
                title: title,
                animation: google.maps.Animation.DROP,
                address: address,
                url: url
            })
            infoWindow(marker, map, title, address, url);
            bounds.extend(marker.getPosition());
            map.fitBounds(bounds);
        } else {
            alert("geocode of " + address + " failed:" + status);
        }
    });
}

function infoWindow(marker, map, title, address, url) {
    google.maps.event.addListener(marker, 'click', function () {
        var html = "<div><h3>" + title + "</h3><p>" + address + "<br></div><a href='" + url + "'>View location</a></p></div>";
        iw = new google.maps.InfoWindow({
            content: html,
            maxWidth: 350
        });
        iw.open(map, marker);
    });
}

function createMarker(results) {
    var marker = new google.maps.Marker({
        icon: 'http://maps.google.com/mapfiles/ms/icons/blue.png',
        map: map,
        position: results[0].geometry.location,
        title: title,
        animation: google.maps.Animation.DROP,
        address: address,
        url: url
    })
    bounds.extend(marker.getPosition());
    map.fitBounds(bounds);
    infoWindow(marker, map, title, address, url);
    return marker;
}    
</script>
    
