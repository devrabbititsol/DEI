<?php 
//remove product images session data when refresh
$session = Yii::$app->session;
if($session->has('product_images'))
    $session->remove('product_images');
if($session->has('product_images_names'))
    $session->remove('product_images_names');
if($session->has('product_loadcharts'))
    $session->remove('product_loadcharts');
if($session->has('product_loadcharts_names'))
    $session->remove('product_loadcharts_names');
?>
<?php 
$category_name = '';
foreach($productcategories as $category)
{
    if($category->category_id == @$_GET['category'])
    {
        $category_name = $category->category_name;
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb beibc">
                <li><a href="<?= Yii::$app->params['SITE_URL'] ?>"><i class="fa fa-2x fa-home"></i></a></li>
                <?php if($category_name != '') {?>
                <li><a href="<?= Yii::$app->params['SITE_URL']."addproduct?category=".@$_GET['category'] ?>"><h4><?= $category_name ?></h4></a></li>
                <?php } ?>
                <?php if(Yii::$app->user->isGuest) { ?>
                <li><a href="#"><h4>Supplier Registration</h4></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
<div class="container newproductblock">
    <div class="wizard">
        <div class="wizard-inner">
            <ul class="nav nav-tabs" role="tablist">
                <?php if(Yii::$app->user->isGuest) { ?>
                <li role="authentication" class="authentication <?php if(Yii::$app->user->isGuest) { echo "active"; }?>">
                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                                Step <span>1</span>
                        </a>
                </li>

                <li role="authentication" class="authentication disabled">
                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                                Step <span>2</span>
                        </a>
                </li>
                <?php } ?>
                <li role="productdata" <?php if(Yii::$app->user->isGuest) { echo "class='disabled'"; } else { echo "class='active'";} ?>>
                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                                Step <span><?php if(Yii::$app->user->isGuest) { echo "3"; } else { echo "1";} ?></span>
                        </a>
                </li>

                <li role="productdata" class="disabled">
                        <a href="#step4" data-toggle="tab" aria-controls="complete" role="tab" title="step 3">
                                Step <span><?php if(Yii::$app->user->isGuest) { echo "4"; } else { echo "2";} ?></span>
                        </a>
                </li>

                <li role="productdata" class="disabled">
                        <a href="#step5" data-toggle="tab" aria-controls="complete" role="tab" title="step 5">
                                Step <span><?php if(Yii::$app->user->isGuest) { echo "5"; } else { echo "3";} ?></span>
                        </a>
                </li>
                <li role="presentation" class="disabled">
                        <a href="#step6" data-toggle="tab" aria-controls="complete" role="tab" title="step 6">
                                Step <span><?php if(Yii::$app->user->isGuest) { echo "6"; } else { echo "4";} ?></span>
                        </a>
                </li>
            </ul>
        </div>
        <form role="form" method="post" action="saveproduct" name="addproduct" id="addproduct">
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
            <div class="tab-content">
                <?php if(Yii::$app->user->isGuest) { ?>
                <div class="tab-pane <?php if(Yii::$app->user->isGuest) { echo "active"; }?>" role="tabpanel" id="step1">
                        <div class="head-2 col-md-12">
                            <h2>Company Information <span>(* All fields required)</span></h2>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                              <input type="email" name="email" id="email" class="form-control" placeholder="Email Address *" required="required">
                                <span><strong>Note: </strong>This will be your user ID</span>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                                <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Enter your user name *" required="required">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                                <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Enter Mobile Number *" required="required" minlength="10" maxlength="10" onKeyUp="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <input type="password" name="password" id="password" class="form-control" placeholder="Password *" required="required" minlength="8">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                                <input type="password" name="regrepassword" id="regrepassword" class="form-control" placeholder="Re-enter Enter Password *" required="required" data-rule-equalTo="#password">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                                <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Company name *" required="required">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                                <input type="text" name="designation" id="designation" class="form-control" placeholder="Designation">
                          </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                  <div class="form-group">
                                        <input type="email" name="company_email" id="company_email" class="form-control" placeholder="Company Email">
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                        <input type="text" name="address" id="address" class="form-control" placeholder="Company Address">
                                  </div>
                                </div>
                            </div>
                        </div>
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-bei" onclick="validateUser();">Register</button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="step2">

                        <div class="head-2 col-md-6 col-md-offset-3">
                            <h2>Enter OTP <span>(* All fields required)</span></h2>
                            
                        </div>
                        <div class="head-2 col-md-6 col-md-offset-3">
                            <label>Please check your Registered E-mail or Mobile Number </label>
                        </div>
                        <div class="col-md-6 col-md-offset-3">
                          <div class="form-group">
                              <input type="text" class="form-control" id="otp" name="otp" placeholder="Enter your OTP">

                          </div>
                            <a href="javascript:function() { return false; }" class="text-dei underline" onclick="resendOTP();">Re-send the OTP</a>
                        </div>
                        <div class="clearfix"></div>
                        <ul class="list-inline pull-right">
                                <!-- <li><button type="button" class="btn btn-bei prev-step">Previous</button></li> -->
                                <li><button type="button" class="btn btn-bei" onclick="verifyOTP();">Verify</button></li>
                        </ul>
                    </div>
                <?php } ?>
                    <div class="tab-pane <?php if(!Yii::$app->user->isGuest) { echo "active"; }?>" role="tabpanel" id="step3">

                        <div class="head-2 col-md-12">
                                <h2>Essential Information <span>(* All fields required)</span></h2>
                        </div>
                        <input type="hidden" name="product_type" id="product_type"  value="<?php if(@$_GET['product_type']=="hire") echo "0";else if(@$_GET['product_type']=="sale") echo '1'?>"  >
                        <div class="col-md-6">
                          <div class="form-group">
                              <select class="form-control" id="category_id" name="category_id" required="required">
                                        <option value="">SELECT CATEGORY *</option>
                                        <?php foreach($productcategories as $category)
                                            if(@$_GET['category'] == $category->category_id)
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
                                </select>

                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                              <input type="text" id="capacity" name="capacity" class="form-control" placeholder="Capacity*" required="required" onKeyUp="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" />
                              <input type="hidden" id="capacity_metric" name="capacity_metric" value="">
                          </div>
                        </div>
                        <div class="col-md-12 dynamic boomlength">
                          <div class="form-group">
                                <input type="text" id="boom_length" name="boom_length" class="form-control" placeholder="Boom length (in meters) *" required="required" onKeyUp="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" />

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
                              <input type="text" class="form-control" name="equipment_title" id="equipment_title" placeholder="Equipment Title *" required="required" >

                          </div>
                        </div>
                        <div class="col-md-6 dynamic model">
                          <div class="form-group">
                                <select class="form-control" id="model_id" name="model_id" required="required">
                                    <option value=''>MODEL *</option>
                                </select>
                                <input type="text" name="model_other" id="model_other" placeholder="Model" class="form-control pull-right" style="display:inline-block;width:48%;display: none;" />

                          </div>
                        </div>
                        <div class="col-md-6 dynamic fly_jib">
                          <div class="form-group">
                                <!--<div class="input-group">-->
                                    <input type="text" name="fly_jib" id="fly_jib" class="form-control" placeholder="Fly Jib (Length In meters)" onKeyUp="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"/>
                                        <!--<div class="input-group-addon bg-dei"><i class="fa fa-check"></i></div>-->
                                <!-- </div> -->
                          </div>
                        </div>
                        <div class="col-md-6 dynamic luffing_jib">
                          <div class="form-group">
                                <!-- <div class="input-group"> -->
                                        <input type="text" name="luffing_jib" id="luffing_jib" class="form-control" placeholder="Luffing Jib (Length In meters)" onKeyUp="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"/>
                                        <!-- <div class="input-group-addon bg-dei"><i class="fa fa-check"></i></div> -->
                                <!-- </div> -->
                          </div>
                        </div>
                        <div class="col-md-6 dynamic register_num">
                          <div class="form-group">
                               <input type="text" name="registered_number" id="registered_number" placeholder="Registered Number" class="form-control">
                                
                          </div>
                        </div>
                        <div class="col-md-6 dynamic bucket_capacity">
                          <div class="form-group">
                                <input type="text" name="bucket_capacity" id="bucket_capacity" placeholder="Bucket Capacity in Cubic Meters*" class="form-control" required="required">
                               
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
                               <input type="text" name="condition" id="condition" placeholder="Registered Number *" class="form-control" required="required">
                                
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
                                <input type="text" name="dimensions" id="dimensions" placeholder="Dimensions ( Length x Width x Height ) in meters" class="form-control" size=8 maxlength=8  onkeyup="this.value=this.value.replace(/^(\d\d)(\d)$/g,'$1x$2').replace(/^(\d\d\x\d\d)(\d+)$/g,'$1x$2').replace(/[^\dx]/g,'')">
                                
                          </div>
                        </div>
                        
                        <div class="col-md-6 dynamic kelly_length">
                          <div class="form-group">
                                <input type="text" name="kelly_length" id="kelly_length" placeholder="Kelly Length in Meters" class="form-control" onKeyUp="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                
                          </div>
                        </div>
                        <div class="col-md-6 dynamic arm_length">
                          <div class="form-group">
                                <input type="text" name="arm_length" id="arm_length" placeholder="Arm Length in Meters" class="form-control" onKeyUp="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                               
                          </div>
                        </div>
                        <div class="col-md-6 dynamic manufacturer">
                          <div class="form-group">
                                <input type="text" name="manufacturer" id="manufacturer" placeholder="Manufacturer *" class="form-control" required="required">
                                
                          </div>
                        </div>
                        <div class="col-md-6 dynamic no_axles">
                          <div class="form-group">
                                <input type="text" name="numberof_axles" id="numberof_axles" placeholder="Number of Axles" class="form-control" maxlength="3">
                                
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
                                <input type="text" name="hire_price" id="hire_price" placeholder="Hire Price *" class="form-control" required="required" onKeyUp="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                
                          </div>
                        </div>
                        <div class="col-md-6 sale_price">
                          <div class="form-group">
                                <input type="text" name="sale_price" id="sale_price" placeholder="Sale Price *" class="form-control" required="required" onKeyUp="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                               
                          </div>
                        </div>
                        
                        <div class="col-md-6 description">
                          <div class="form-group">
                                <textarea class="form-control" name="description" placeholder="Write few lines about your equipment" ></textarea>
                                
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
<script>
//need to call following while body onload    
$(document).ready(function () {
    $('#addproduct').validate();
    $('#life_tax_details').select2({ placeholder: 'Life Tax Details ',width:null});
    $('#exact_location_id').select2({ placeholder: 'Select Serving Locations ',width:null});
    $(".dynamic").hide();
    Dropzone.autoDiscover = false;
    $("div#productimages").dropzone({
        url:"uploadproductimages",
        paramName: 'category_id',
        acceptedFiles: "image/jpeg,image/png,image/gif",
        init: function() {
            this.on('sending', function(file, xhr, formData){ 
                formData.append('category_id',$("#category_id").val()); 
            });
            this.on("removedfile", function(file) {
                 $.ajax({
                      url: 'deleteproductimages',
                      type: "POST",
                      data: { 'filetodelete': file.name,'category_id': $('#category_id').val(), "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>"},
                      success:function(data){
                            $("#product_images").val(data);
                        }
                 });
            });
       },
       success:function(data){
            $("#product_images").val('uploaded');
            $("#productimages").removeClass('error');
        }
    });
    $("div#productloadcharts").dropzone({
    url:"uploadproductloadcharts",
    acceptedFiles: "image/jpeg,image/png,image/gif",
    init: function() {
            this.on('sending', function(file, xhr, formData){ 
                formData.append('category_id',$("#category_id").val()); 
            });
            this.on("removedfile", function(file) {
                 $.ajax({
                      url: 'deleteproductloadcharts',
                      type: "POST",
                      data: { 'filetodelete': file.name,'category_id': $('#category_id').val(), "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>"},
                      success:function(data){
                            $("#load_chart_images").val(data);
                        }
                 });
            });
       },
       success:function(data){
            $("#load_chart_images").val('uploaded');
            $("#productloadcharts").removeClass('error');
        }
    });
    CheckPriceFields();
    <?php if(@$_GET['category']) { ?>
	var category_id = <?php echo @$_GET['category']; ?>;
	$.ajax({
	    url: "getproductsubcategories",
	    data : {category_id: category_id, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" },
	    dataType: 'json',
	    success: function(data){
		$('#subcategory_id').html(data.out);
		$(".dynamic").hide();
		$('#capacity').attr("placeholder","Capacity In "+data.metric+" *");
		$('#capacity_metric').val(data.metric);
		for(var i = 0; i < data.fields.length; i++) {
		    $('.'+data.fields[i]).show();
		    $("#life_tax_details").select2({ placeholder: 'Life Tax Details '});
		}
	    }
	});
	<?php } ?>
        
        $('#bucket_capacity').keypress(function(event) {
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
          event.preventDefault();
        }
      });
      $(window).keydown(function(event){
        if(event.keyCode == 13) {
          event.preventDefault();
          return false;
        }
      });
});

$('#category_id').change(function(){
    var category_id = $(this).val();
    $.ajax({
        url: "getproductsubcategories",
        data : {category_id: $(this).val(), "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" },
        dataType: 'json',
        success: function(data){
            
            $('#subcategory_id').html(data.out);
            $(".dynamic").hide();
            $('#capacity').attr("placeholder","Capacity In "+data.metric+" *");
            $('#capacity_metric').val(data.metric);
            for(var i = 0; i < data.fields.length; i++) {
                $('.'+data.fields[i]).show();
                $("#life_tax_details").select2({ placeholder: 'Life Tax Details '});
            }
            $('#addproduct')[0].reset();
            $('#category_id').val(category_id);
            <?php 
            //remove product images session data when refresh
            $session = Yii::$app->session;
            if($session->has('product_images'))
                $session->remove('product_images');
            if($session->has('product_images_names'))
                $session->remove('product_images_names');
            if($session->has('product_loadcharts'))
                $session->remove('product_loadcharts');
            if($session->has('product_loadcharts_names'))
                $session->remove('product_loadcharts_names');
            ?>
        }
    });
});   
$('#subcategory_id').change(function(){
    var cur_category = $("#category_id").val();
    if(cur_category == 1) { //register_num life_tax_details
	if($(this).val() == 4 || $(this).val() == 5 || $(this).val() == 7) {
                if($(this).val() == 4) $("div.register_num").hide();
                else {
                $("div.register_num").hide();
                $("div.life_tax_details").hide();
                }
        } 
        else {					
                $("div.register_num").show();
                $("div.life_tax_details").show();
        }
    }
    if(cur_category == 5) {
        if($(this).val() == 30) 
            $("div.kelly_length").hide();
        else
            $("div.kelly_length").show();
    }
    
    /*if($(this).val() == 5 || $(this).val() == 7 || $(this).val() == 10) 
        $("div.load_chart").hide();
    else  
        $("div.load_chart").show();*/
    
    $.ajax({
        url: "getsubcategorymodels",
        data : {sub_category_id: $(this).val(), "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" },
        dataType: 'json',
        success: function(data){
            $('#model_id').html(data.out);
        }
    });
});   
$('#model_id').on("change",function(){
    if($('#model_id option:selected').text()=="CUSTOM"){
        $("#model_other").show();
        $('#model_id').css({"width":"50%","display":"inline-block"});
    }
    else {$("#model_other").hide();
        $('#model_id').css({"width":"100%"});
    }
});
function CheckPriceFields(){
    if($('#product_type').val()==0) {
        $(".pricing").show();
        $(".price_type").show();
        $(".sale_price").hide();								
    }
    else if($('#product_type').val()==1) {
        $(".pricing").hide();
        $(".price_type").hide();
        $(".sale_price").show();				
    }

    else if($('#product_type').val()==2) {
        $(".pricing").show();
        $(".price_type").show();
        $(".sale_price").show();				
    }
}

//new user registration validation and saving
function validateUser()
{
    if($("#addproduct").valid())
    {
        var cur_mobile = $("#phone_number").val();
        $.ajax({
            url: "checkphonenumberexist",
            type: "post",
            data: {"phone_number": cur_mobile, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" } ,
            dataType: 'html',
            success: function (response) {
                if(response)
                {
                    $("#phone_number").addClass('error');
                }
                else
                {
                    $.ajax({
                        type: "POST",
                        url: "newuserregistration",
                        data : $('#addproduct').serialize(),
                        dataType: 'json',
                        success: function(data){
                            var $active = $('.wizard .nav-tabs li.active');
                            $active.next().removeClass('disabled');
                            nextTab($active);
                        }
                    });
                }
            }
        });
        
    }
}
//verify otp
function verifyOTP()
{
    if($("#addproduct").valid())
    {
        var otp = $("#otp").val();
        var email = $("#email").val();
        if(otp.length>0)
        {
            $.ajax({
                type: "POST",
                url: "verifyotp",
                data : {"email": email,"otp": otp, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" } ,
                dataType: 'html',
                success: function(response){
                    if(response)
                    {
                        $( "#otp" ).removeClass( "error" );
                        var $active = $('.wizard .nav-tabs li.active');
                        $active.next().removeClass('disabled');
                        nextTab($active);
                        $(".authentication").removeClass('active');
                        $(".authentication").addClass('disabled');
                    }
                    else
                    {
                         $( "#otp" ).addClass( "error" );
                    }
                }
            });
        }
        else
        {
            $( "#otp" ).addClass( "error" );
        }
    };
    
    
}
//resend otp
function resendOTP()
{
    var email = $("#email").val();
    var phone = $("#phone_number").val();
    $.ajax({
        type: "POST",
        url: "resendotp",
        data : {"email": email,"phone": phone, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" } ,
        dataType: 'json',
        success: function(response){
            
        }
    });
    
       
}
//check email exist. If exist redirect 
$("#email").change(function(){ 
    var cur_email = $(this).val();
    $.ajax({
        url: "checkemailexist",
        type: "post",
        data: {"email": cur_email, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" } ,
        dataType: 'json',
        success: function (response) {
            if(response)
            {
            window.location="<?= Yii::$app->params['SITE_URL'] ?>login?email="+cur_email;
            }
        }
    });
});
// -------------- Mobiel Number On CHANGE EVENT ---------------- //
$("#phone_number").change(function(){ 
    var cur_mobile = $(this).val();
    $.ajax({
        url: "checkphonenumberexist",
        type: "post",
        data: {"phone_number": cur_mobile, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" } ,
        dataType: 'json',
        success: function (response) {
            if(response)
            {
                $("#phone_number").addClass('error');
            }
        }
    });
});

//getpackageamount using capacity and category id
$("#capacity").change(function(){ 
    var capacity = $(this).val();
    var category_id = $("#category_id").val();
    $.ajax({
        url: "getpackageamount",
        type: "post",
        data: {"capacity": capacity,'category_id':category_id, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" } ,
        dataType: 'json',
        success: function (data) {
            $('.paidamount').html(data+' INR');
            $('#package_amount').val(data);
        }
    });
});

//validate essential block info
function validateProductinfo()
{
    if($("#addproduct").valid())
    {
        var $active = $('.wizard .nav-tabs li.active');
        $active.next().removeClass('disabled');
        nextTab($active);
    }
}
function validateProductimage()
{
    if($("#addproduct").valid())
    {
        if($("#product_images").val() != '' && $("#product_images").val() != '""')
        {
            if($("#category_id").val()== 1)
            {
                var $active = $('.wizard .nav-tabs li.active');
                $active.next().removeClass('disabled');
                nextTab($active);
                /*if($("#load_chart_images").val() != '' && $("#load_chart_images").val() != '""')
                {
                    var $active = $('.wizard .nav-tabs li.active');
                    $active.next().removeClass('disabled');
                    nextTab($active);
                }
                else
                {
                    $("#productloadcharts").addClass('error');
                    return false;
                }   */
            }
            var $active = $('.wizard .nav-tabs li.active');
            $active.next().removeClass('disabled');
            nextTab($active);
        }
        else
        {
            $("#productimages").addClass('error');
        }
    }
}

function saveProduct()
{
    if($("#addproduct").valid())
    {
        $.ajax({
            url: "saveproduct",
            type: "post",
            data: $('#addproduct').serialize(),
            dataType: 'json',
            success: function (response) {
                if(response)
                {
                    //console.log(response);
                    //$(".newproductblock").hide();
                    //$(".paymentblock").show();
                }
            }
        });
    }
}

<?php $ltype=0;
      if(@$_GET['product_type']=='hire')	$ltype=0;

if(@$_GET['product_type']=='sale')	$ltype=1;

if(@$_GET['product_type']=='both')	$ltype=2;

 ?>

$('#product_type_check').click(function(){
    if($(this).is(":checked")) 
    {
        $('#product_type_check').val('2');
        $('#product_type').val('2');
    }
    else $('#product_type_check').val('<?=$ltype?>');
    
    CheckPriceFields();
    var $active = $('.wizard .nav-tabs li.active');
    $active.next().removeClass('disabled');
    prevTab($active);
});

$('#exact_location_id').on('select2:select', function (evt) {
    if($('#exact_location_id').val().indexOf('India')!=-1){ 
        $("#exact_location_id").val('India'); 
        $("#exact_location_id").trigger('change'); 
    }
});

//google current location autofill 
var placeSearch, autocomplete;
var componentForm = {
            
            
            
        
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'long_name',
        country: 'long_name',
        postal_code: 'short_name'};
    
function initAutocomplete() {
    autocomplete = new google.maps.places.Autocomplete(
    (document.getElementById('autocomplete')),
    {types: ['(regions)'],componentRestrictions: {country: "in"}});
    autocomplete.addListener('place_changed', fillInAddress);
}
function fillInAddress() {
    // Get the place details from the autocomplete object.
    var place = autocomplete.getPlace();
    document.getElementById("google_place_id").value=place.place_id;
    for (var component in componentForm) {
        document.getElementById(component).value = '';
        document.getElementById(component).disabled = false;
    }
    document.getElementById('latitude').value = place.geometry.location.lat();
    document.getElementById('longitude').value = place.geometry.location.lng();
    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
        }
    }
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTOYrzyFnVI4_eo445CP07XCSNhcPwICk&libraries=places&callback=initAutocomplete" async defer></script>
