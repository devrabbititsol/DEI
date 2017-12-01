<div class="container">
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb beibc">
                <li><a href="<?= Yii::$app->params['SITE_URL'] ?>"><i class="fa fa-2x fa-home"></i></a></li>
                <li><a href="#"><h4>Edit Product</h4></a></li>
            </ul>
        </div>
    </div>
</div>
<div class="container newproductblock">
    <div class="wizard">
        <div class="wizard-inner">
            <ul class="nav nav-tabs" role="tablist">
                <li role="productdata" <?php if(Yii::$app->user->isGuest) { echo "class='disabled'"; } else { echo "class='active'";} ?>>
                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                                Step <span>1</span>
                        </a>
                </li>

                <li role="productdata" class="disabled">
                        <a href="#step4" data-toggle="tab" aria-controls="complete" role="tab" title="step 3">
                                Step <span>2</span>
                        </a>
                </li>

                <li role="productdata" class="disabled">
                        <a href="#step5" data-toggle="tab" aria-controls="complete" role="tab" title="step 5">
                                Step <span>3</span>
                        </a>
                </li>
                <li role="presentation" class="disabled">
                        <a href="#step6" data-toggle="tab" aria-controls="complete" role="tab" title="step 6">
                                Step <span>4</span>
                        </a>
                </li>
            </ul>
        </div>
        <form role="form" method="post" action="saveproduct" name="addproduct" id="addproduct">
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
            <div class="tab-content">
                    <div class="tab-pane active" role="tabpanel" id="step3">

                        <div class="head-2 col-md-12">
                                <h2>Essential Information <span>(* All fields required)</span></h2>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <select class="form-control" id="category_id" name="category_id" required="required">
                                        <option value="">SELECT CATEGORY *</option>
                                        <?php foreach($productcategories as $category)
                                            if($productdata['category_id'] == $category->category_id)
                                                echo "<option value='$category->category_id' selected='selected'>".strtoupper($category->category_name)."</option>";
                                            else
                                                echo "<option value='$category->category_id'>".strtoupper($category->category_name)."</option>";
                                        ?>
                                </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <select class="form-control" id="subcategory_id" name="sub_category_id" required="required">
                                        <option value="">SELECT SUB CATEGORY *</option>
                                        <?php 
                                        foreach($productsubcategories as $subcategory) 
                                            if($productdata['sub_category_id'] == $subcategory['sub_category_id'])
                                                echo "<option value=".$subcategory["sub_category_id"]." selected='selected'>".strtoupper($subcategory['sub_category_name'])."</option>";
                                            else
                                                echo "<option value=".$subcategory["sub_category_id"].">".strtoupper($subcategory['sub_category_name'])."</option>";
                                        ?>
                                </select>

                          </div>
                        </div>
                        
                        <div class="col-md-12">
                          <div class="form-group">
                              <input type="text" id="capacity" name="capacity" class="form-control" placeholder="Capacity*" required="required" onKeyUp="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" value="<?= substr($productdata['capacity'], 0, strrpos($productdata['capacity'], ' '))?>" />
                              <input type="hidden" id="capacity_metric" name="capacity_metric" value="">
                          </div>
                        </div>
                        
                        <div class="col-md-12 dynamic boomlength">
                          <div class="form-group">
                              <input type="text" id="boom_length" name="boom_length" class="form-control" placeholder="Boom length (in meters) *" required="required" onKeyUp="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" value="<?= $productdata['boom_length'] ?>"/>

                          </div>
                        </div>
                        <ul class="list-inline pull-right">
                                <!-- <li><button type="button" class="btn btn-bei prev-step">Previous</button></li>-->
                                <li><button type="button" class="btn btn-bei btn-info-full" onclick="validateProductinfo()">Save and continue</button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="step4">

                        <div class="head-2 col-md-12">
                                <h2>Basic Information <span>(* All fields required)</span></h2>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <input type="text" class="form-control" name="equipment_title" id="equipment_title" placeholder="Equipment Title *" required="required" value="<?= $productdata['equipment_title'] ?>">

                          </div>
                        </div>
                        <div class="col-md-6 dynamic model">
                          <div class="form-group">
                                <select class="form-control" id="model_id" name="model_id" required="required">
                                    <option value=''>MODEL *</option>
                                </select>
                                <input type="text" name="model_other" id="model_other" placeholder="Model" class="form-control pull-right" style="display:inline-block;width:48%;display: none;" value="<?= $productdata['model_other'] ?>"/>

                          </div>
                        </div>
                        <div class="col-md-6 dynamic fly_jib">
                          <div class="form-group">
                                <!--<div class="input-group">-->
                                    <input type="text" name="fly_jib" id="fly_jib" value="<?= $productdata['fly_jib'] ?>" class="form-control" placeholder="Fly Jib (Length In meters)" onKeyUp="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"/>
                                        <!--<div class="input-group-addon bg-dei"><i class="fa fa-check"></i></div>-->
                                <!-- </div> -->
                          </div>
                        </div>
                        <div class="col-md-6 dynamic luffing_jib">
                          <div class="form-group">
                                <!-- <div class="input-group"> -->
                                        <input type="text" name="luffing_jib" id="luffing_jib" value="<?= $productdata['luffing_jib'] ?>" class="form-control" placeholder="Luffing Jib (Length In meters)" onKeyUp="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"/>
                                        <!-- <div class="input-group-addon bg-dei"><i class="fa fa-check"></i></div> -->
                                <!-- </div> -->
                          </div>
                        </div>
                        <div class="col-md-6 dynamic register_num">
                          <div class="form-group">
                               <input type="text" name="registered_number" id="registered_number" value="<?= $productdata['registered_number'] ?>" placeholder="Registered Number" class="form-control">
                                
                          </div>
                        </div>
                        <div class="col-md-6 dynamic bucket_capacity">
                          <div class="form-group">
                                <input type="text" name="bucket_capacity" id="bucket_capacity" value="<?= $productdata['bucket_capacity'] ?>" placeholder="Bucket Capacity in Cubic Meters*" class="form-control" required="required">
                               
                          </div>
                        </div>
                        <div class="col-md-6 dynamic life_tax_details">
                          <div class="form-group">
                              <select class="form-control select" name="life_tax_details[]" id="life_tax_details" multiple="multiple">
                                 <option value="">Life Tax Details </option> 
                                 <?php foreach($regions as $region)
                                    if($region->region_id!=1)
                                    echo "<option value='$region->region_id'>".strtoupper($region->region_name)."</option>";
                                 ?>
                              </select>
                          </div>
                        </div>
                        <div class="col-md-6 dynamic condition">
                          <div class="form-group">
                               <input type="text" name="condition" id="condition" placeholder="Registered Number *" value="<?= $productdata['condition'] ?>" class="form-control" required="required">
                                
                          </div>
                        </div>
                        <div class="col-md-6 manufacture_year">
                          <div class="form-group">
                              <select class="form-control" name="manufacture_year" id="manufacture_year">
                                   <option value="">Manfacture Year</option>
                                   <?php for($year=1960;$year<=date('Y');$year++){
                                   echo "<option value='$year'>$year</option>";
                                   }
                                   ?>
                                </select>

                          </div>
                        </div>
                        <div class="col-md-6 dimensions">
                          <div class="form-group">
                                <input type="text" name="dimensions" id="dimensions" value="<?= $productdata['dimensions'] ?>" placeholder="Dimensions ( Length x Width x Height ) in meters" class="form-control" size=8 maxlength=8  onkeyup="this.value=this.value.replace(/^(\d\d)(\d)$/g,'$1x$2').replace(/^(\d\d\x\d\d)(\d+)$/g,'$1x$2').replace(/[^\dx]/g,'')">
                                
                          </div>
                        </div>
                        
                        <div class="col-md-6 dynamic kelly_length">
                          <div class="form-group">
                                <input type="text" name="kelly_length" id="kelly_length" value="<?= $productdata['kelly_length'] ?>" placeholder="Kelly Length in Meters" class="form-control" onKeyUp="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                
                          </div>
                        </div>
                        <div class="col-md-6 dynamic arm_length">
                          <div class="form-group">
                                <input type="text" name="arm_length" id="arm_length" value="<?= $productdata['arm_length'] ?>" placeholder="Arm Length in Meters" class="form-control" onKeyUp="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                               
                          </div>
                        </div>
                        <div class="col-md-6 dynamic manufacturer">
                          <div class="form-group">
                                <input type="text" name="manufacturer" id="manufacturer" value="<?= $productdata['manufacturer'] ?>" placeholder="Manufacturer *" class="form-control" required="required">
                                
                          </div>
                        </div>
                        <div class="col-md-6 dynamic no_axles">
                          <div class="form-group">
                                <input type="text" name="numberof_axles" id="numberof_axles" value="<?= $productdata['numberof_axles'] ?>" placeholder="Number of Axles" class="form-control" maxlength="3">
                                
                          </div>
                        </div>
                        <div class="col-md-6 price_type">
                          <div class="form-group">
                              <select class="form-control" name="price_type" id="price_type" required="required">
                                 <option value="">ALL HIRE TYPE *</option> 
                                 <option value="1">DAILY</option> 
                                 <option value="2">MONTHLY</option> 
                              </select>
                          </div>
                        </div>
                        <div class="col-md-6 pricing">
                          <div class="form-group">
                                <input type="text" name="hire_price" id="hire_price" placeholder="Hire Price *" value="<?= $productdata['hire_price'] ?>" class="form-control" required="required" onKeyUp="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                
                          </div>
                        </div>
                        <div class="col-md-6 sale_price">
                          <div class="form-group">
                                <input type="text" name="sale_price" id="sale_price" placeholder="Sale Price *" value="<?= $productdata['sale_price'] ?>" class="form-control" required="required" onKeyUp="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                               
                          </div>
                        </div>
                        
                        <div class="col-md-6 description">
                          <div class="form-group">
                                <textarea class="form-control" name="description"  placeholder="Write few lines about your equipment" ><?= $productdata['description'] ?></textarea>
                                
                          </div>
                        </div>
                        <ul class="list-inline pull-right">
                                <li><button type="button" class="btn btn-bei prev-step">Previous</button></li>
                                <!--<li><button type="button" class="btn btn-bei next-step">Skip</button></li>-->
                                <li><button type="button" class="btn btn-bei btn-info-full" onclick="validateProductinfo()">Save and continue</button></li>
                        </ul>
                    </div>
                    
                    <div class="tab-pane" role="tabpanel" id="step5">

                        <div class="head-2 col-md-12">
                                <h2><?php if(@$_GET['product_type']=='sale')
                                                echo "Equipment Location";
                                            else 
                                                echo "Areas of  Serving Information";?>
                                    <span>(* All fields required)</span>
                                </h2>
                        </div>
                        <div class="col-md-12 serving-details">
                          <div class="form-group">
                              <input id="autocomplete" name="current_location" type="text" class="form-control" required="required" placeholder="Enter Equipment Current Location *" onKeyUp="if (/\d/g.test(this.value)) this.value = this.value.replace(/\d/g,'');" onblur="this.value=this.value.replace(/^[\s]+|[\s]+$/g, '');"/>
                              <input id="google_place_id" type="hidden" name="google_place_id" />

                                <input class="field" id="street_number" name="street" type="hidden" />

                                <input class="field" id="route" name="route" type="hidden" />

                                <input class="field" id="locality" name="city" type="hidden" />

                                <input class="field" id="administrative_area_level_1" name="state" type="hidden" />

                                <input class="field" id="postal_code" name="zipcode" type="hidden" />

                                <input class="field" id="country" name="country" type="hidden" />

                                <input class="field" id="latitude" name="latitude" type="hidden" />

                                <input class="field" id="longitude" name="longitude" type="hidden"  />
                          </div>
                        </div>
                        <?php
                        if(@$_GET['product_type']!='sale'){ ?>
                        <div class="col-md-12">
                          <div class="form-group">
                              <select name="exact_location[]" class="form-control select" id="exact_location_id" multiple="multiple"  placeholder="Choose  Serving location(s)">
                                <?php foreach($regions as $region)
                                    echo "<option value='$region->region_name'>".strtoupper($region->region_name)."</option>";
                                 ?>
                                </select>
                          </div>
                        </div>
                        <?php } ?>
                        <div class="col-md-12">
                          <div class="form-group">
                              <input id="product_images" placeholder="Product Images" type="hidden" class="file" class="file-loading" multiple required="required">
                          </div>
                          <label class="control-label uploadlabel">Images *</label>
                          <div class="upload-ad-photos">
                              <h4>Upload Images</h4>
                            <div id="productimages" class="dropzone dropzone-previews"></div>

                          </div>
                        </div>
                        
                        
                        <div class="col-md-12 dynamic load_chart">
                          <div class="form-group">
                              <input id="load_chart_images" type="hidden">
                          </div>
                          <label class="control-label uploadlabel">Load Charts</label>
                          <div class="upload-ad-photos">
                            <h4>Upload Charts</h4>
                            <div id="productloadcharts" class="dropzone dropzone-previews"></div>
                          </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="col-md-12">
                              <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="product_type_check" id="product_type_check" value="1"> Click here to post both in Hire & Sale
                                    </label>
                              </div>
                            </div>
                        </div>
                        <ul class="list-inline pull-right">
                                <li><button type="button" class="btn btn-bei prev-step">Prev</button></li>
                                <li><button type="button" class="btn btn-bei" onclick="validateProductimage()">Save and Continue</button></li>
                        </ul>
                        <div class="clearfix"></div>
                        <p class="text-right text-small">By clicking Submit you accept our Terms of Use and Privacy Policy</p>
                    </div>
                
                    <div class="tab-pane" role="tabpanel" id="step6">

                        <div class="head-2 col-md-12">
                            <h2>Packages<span>(* All fields required)</span></h2>
                        </div>
                        <input type="hidden" value="" name="package_amount" id="package_amount" >
                        <div class="col-lg-6 col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <input type="radio" class="form-control" id="freepackage" name="package_type" value="1">
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <strong><div class="huge">0.00 INR</div>
                                            <div>Free Premium</div>
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <input type="radio" class="form-control" id="paidpackage" name="package_type" value="2" checked="checked">
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <strong><div class="paidamount">0.00 INR</div>
                                            <div>Paid Premium</div>
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="clearfix"></div>
                        <ul class="list-inline pull-right">
                                <li><button type="button" class="btn btn-bei prev-step">Previous</button></li> 
                                <li><button type="submit" class="btn btn-bei">Submit</button></li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
            </div>
        </form>
    </div>
   
</div>
<script>
  jQuery(document).ready(function($) {
 
        //Handles the carousel thumbnails
        $('[id^=carousel-selector-]').click(function () {
        var id_selector = $(this).attr("id");
        try {
            var id = /-(\d+)$/.exec(id_selector)[1];
            console.log(id_selector, id);
            jQuery('#myCarousel').carousel(parseInt(id));
        } catch (e) {
            console.log('Regex failed!', e);
        }
    });
        // When the carousel slides, auto update the text
        $('#myCarousel').on('slid.bs.carousel', function (e) {
                 var id = $('.item.active').data('slide-number');
                $('#carousel-text').html($('#slide-content-'+id).html());
        });
});	
</script>

<script>
$(document).ready(function () {
    //Initialize tooltips
    $('.nav-tabs > li a[title]').tooltip();
    
    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        var $target = $(e.target);
    
        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".next-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        $active.next().removeClass('disabled');
        nextTab($active);

    });
    $(".prev-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        prevTab($active);

    });
});

function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}	
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTOYrzyFnVI4_eo445CP07XCSNhcPwICk&libraries=places&callback=initAutocomplete" async defer></script>
