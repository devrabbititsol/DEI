<?php 
if(@$_GET['product_type']) { 
    $product_type= @$_GET['product_type'];} 
else if(@$options['product_type']) { 
    $product_type= @$options['product_type'];} 
else { 
    $product_type= "hire";}
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb beibc">
                <li><a href="<?= Yii::$app->params['SITE_URL'] ?>"><i class="fa fa-2x fa-home"></i></a></li>
                <li><a href="<?= Yii::$app->params['SITE_URL']."products?product_type=".$product_type ?>"><h4><?php if($product_type == 'both') echo "Hire & sale"; else echo $product_type; ?></h4></a></li>
                <li><a href="#"><h4>
                    <?php foreach($productcategories as $category) { 
                        if(@$_GET['category'] == $category->category_id || @$options['category'] == $category->category_id){ 
                            $breadcrum = $category->category_name;
                        }
                    }
                    if(@$breadcrum != '')
                        echo @$breadcrum;
                    else
                        echo "Products";
                    ?></h4></a></li>
            </ul>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-3">

            <form class="crane_left_filters" action="products" method="post" id="searchform">
                
                <div class="head-1">
                    <h1>Filters</h1>
                </div>
                <?php 
                if(@$_GET['product_type']) { 
                    $product_type= @$_GET['product_type'];} 
                else if(@$options['product_type']) { 
                    $product_type= @$options['product_type'];} 
                else { 
                    $product_type= "hire";}
                if(!isset($_GET['product_type'])) { ?>
                <div class="form-group" >
                    <label>Product Type</label>
                    <select class="form-control" id="product_type" name="product_type">
                        <option value="hire" <?php if($product_type == 'hire') echo "selected=selected";?>>HIRE</option>
                        <option value="sale" <?php if($product_type == 'sale') echo "selected=selected";?>>SALE</option>
                        <option value="both" <?php if($product_type == 'both') echo "selected=selected";?>>HIRE & SALE</option>
                    </select>
                </div>
                <?php } else { ?>
                <input type="hidden" name="product_type" id="product_type" value="<?= $product_type ?>" />
                <?php } ?>
                <div class="form-group">
                    <label>Choose Categories</label>
                    <select class="form-control" id="category_id" name="category" >
                        <option value="">SELECT CATEGORY</option>
                        <?php foreach($productcategories as $category)
                            if(@$_GET['category'] == $category->category_id || @$options['category'] == $category->category_id)
                                echo "<option value='$category->category_id' selected='selected'>".strtoupper($category->category_name)."</option>";
                            else
                                echo "<option value='$category->category_id' >".strtoupper($category->category_name)."</option>";
                        ?>
                    </select>
                </div>
                <div class="form-group" >
                    <label>Select Sub Category</label>
                    <select class="form-control" id="subcategory_id" name="sub_category_id">
                        <option value="">SELECT SUB CATEGORY</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Select Capacity</label>
                    <select class="form-control" id="capacity" name="capacity">
                        <option value="">SELECT CAPACITY</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Select Location</label>
                    <input type="text" name="current_location" id="current_location" class="form-control" placeholder="Select your location" onKeyUp="if (/\d/g.test(this.value)) this.value = this.value.replace(/\d/g,'');" onblur="this.value=this.value.replace(/^[\s]+|[\s]+$/g, '');" value="<?= @$options['current_location']; ?>">
                </div>
                <input type="hidden" value="" name="price_type" id="price_type" />
                <button type="submit" class="btn btn-bei">Submit</button>
            </form>
        </div>
        <div class="col-md-9">
            <div class="crane_right_filters">

                <div class="text-right">
                    <button type="button" class="btn btn-bei pull-left checkavailablebutton disabled" onclick="multipleCheckavailability();">Check Out</button>
                    <div class="clearfix"></div>
                    <form class="form-inline">

                        <!--<div class="form-group">
                            <label>Sort by</label>
                            <select class="form-control">
                                <option>Cranes</option>
                                <option>Recent</option>
                                <option>Top Rated</option>
                                <option>Low Rated</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Show</label>
                            <select class="form-control">
                                <option>All</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>-->
                        <?php if($product_type == 'hire'){ ?>
                        <div class="form-group">
                            <label>Hire Type</label>
                            <select class="form-control" onchange="getDatausinghiretype()" id="hire_type">
                                <option value="">All</option>
                                <option value="1" <?php if(@$options['price_type'] == 1) echo "selected=selected"; ?>>DAILY</option>
                                <option value="2" <?php if(@$options['price_type'] == 2) echo "selected=selected"; ?>>MONTHLY</option>
                            </select>
                        </div>
                        <?php } ?>

                    </form>
                    <div class="clearfix"></div>
                </div>
                <!--<div>
                    <div class="col-md-8">
                        <strong>Search Results</strong>
                    </div>
                    <div class="col-md-4">
                        <form>

                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search here..">
                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                </div>
                            </div>

                        </form>



                    </div>
                    <div class="clearfix"></div>
                </div>-->
            </div>
            <div class="cranes_list">
                <table id="productslist" class="col-md-12">
                    
                    <thead><tr><th></th></tr></thead>
                    <tbody>
                <?php foreach($products as $product) { ?>
                    <tr><td>
                <div class="item">
                    <form action="" class="form-inline">
                        <input class="form-control styled-checkbox" type="checkbox" name="multiavailabity[]" id="multiavailabity<?= $product['product_id']?>" value="<?= $product['product_id']?>" onclick="updateproductids(<?= $product['product_id']?>,'<?php if($product['price_type'] == 1) echo "Days"; else echo "Months"; ?>')" <?php if(Yii::$app->user->id == $product['user_id']) echo "disabled style='opacity:0'"; ?>>
                        <label for="styled-checkbox-1" class="checkc"></label>
                    </form>
                    <div class="itemdtls">
                        <div class="itemimg">
                            <img src="<?= $product['image_url'] ?>" alt="" width="93px" height="85px">
                        </div>
                        <div class="itemcon">
                            <h4><?php echo $product['equipment_title']; ?> <span style="display:none;"><?php echo $product['manual_product_code']; ?></span></h4>
                            <ul class="list-inline">
                                <?php if($product_type=='hire'){ ?>
                                <li><i class="fa fa-rupee"></i><?= $product['hire_price'] ?>/<?php if($product['price_type'] == 1) echo "Daily"; else echo "Monthly"; ?></li>
                                <?php } else { ?>
                                <li><i class="fa fa-rupee"></i><?= $product['sale_price'] ?></li>
                                <?php } ?>
                                <li><strong>Capacity:</strong> <?= $product['capacity'] ?></li>
                                <?php 
                                $pos = strrpos( $product['current_location'], ',');
                                if ($pos > 0) { // try to find the second one
                                  $npath = substr($product['current_location'], 0, $pos);
                                  $npos = strrpos($npath, ',');
                                  if ($npos !== false) {
                                     $currentlocation = substr($product['current_location'], $npos+1);
                                  } 
                                  else {
                                      $currentlocation =$product['current_location'];

                                  }
                                }
                                ?>
                                <li><strong><i class="fa fa-map-marker"></i>Location</strong> <?= $currentlocation ?></li>
                            </ul>
                        </div>
                    </div>

                    <div class="itembtn">
                        <a href="javascript:void(0);" class="btn btn-border-bei" onclick="getProductdata(<?= $product['product_id']?>);">View</a>
                    </div>
                </div>
                        </td></tr>
                <?php } ?>
                    </tbody>
                </table>
            
        </div>
    </div>
</div>
</div>
    
<div class="modal fade bs-example-modal-lg item_view_model" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="product_details">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="product_model_title">

                </h3>
            </div>
            <div class="modal-body" >
                <div>

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist" id="product_model_navs">

                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content" id="product_model_details"></div>

                </div>
            </div>
            <div class="modal-footer" id="product_model_footer">
                
            </div>
        </div>
    </div>
</div>


<div class="modal fade bs-example-modal-lg item_view_model" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="order_details">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">
                    Check Availability
                </h3>
            </div>
            <div class="modal-body">
                <div class="">
                    <div class="col-md-12">
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
                <li role="productdata" class='orderdetails <?php if(Yii::$app->user->isGuest) { echo " disabled"; } else { echo " active";} ?>'>
                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step <?php if(Yii::$app->user->isGuest) { echo "3"; } else { echo "1";} ?>">
                                Step <span><?php if(Yii::$app->user->isGuest) { echo "3"; } else { echo "1";} ?></span>
                        </a>
                </li>
                <li role="productdata" class='disabled'>
                        <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab" title="Step <?php if(Yii::$app->user->isGuest) { echo "4"; } else { echo "2";} ?>">
                                Step <span><?php if(Yii::$app->user->isGuest) { echo "4"; } else { echo "2";} ?></span>
                        </a>
                </li>
            </ul>
        </div>
        <form role="form" method="post" action="saveproduct" name="addorder" id="addorder">
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
            <div class="tab-content">
                <?php if(Yii::$app->user->isGuest) { ?>
                <div class="tab-pane <?php if(Yii::$app->user->isGuest) { echo "active"; }?>" role="tabpanel" id="step1">
                        <div class="head-2 col-md-12">
                            <h2>Company Information <span>(* All fields required)</span></h2>
                        </div>
                        <div class="col-md-4 col-md-offset-4">
                            <div class="alert alert-warning phoneexists" style="display: none;">
                                <center><strong>Phone Number already exists.</strong></center>
                            </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                              <input type="email" name="email" id="email" class="form-control" placeholder="Email Address *" required="required">
                                <span><strong>Note: </strong>This will be your user ID</span>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                                <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Enter your name *" required="required">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                                <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Enter Mobile Number *" required="required" minlength="10" maxlength="10" onKeyUp="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <input type="password" name="password" id="password" class="form-control" placeholder="Password should be minimum 8 characters *" required="required" minlength="8">
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
                            <li><button type="button" class="btn btn-bei registration-btn" onclick="validateUser();">Register</button></li>
                            <a href="#" class="formloading" style="display:none;"><img src="<?= Yii::$app->params['SITE_URL'] ?>images/loading.gif" /></a>
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
                        <input type="hidden" name="product_id" id="product_id" value="">
                        <input type="hidden" name="product_price_type" id="product_price_type" value="">
                        <input type="hidden" name="multiple_product_price_type" id="multiple_product_price_type" value="">
                        <div class="col-md-12 ordertype" <?php if($product_type=="hire" || $product_type=="sale") echo "style='display:none;'"; ?>>
                          <div class="form-group">
                              <select class="form-control" required="required" name="type" id="type">
                                  <option value="">Select Type *</option>
                                  <option value="0" <?php if($product_type=="hire") echo "selected";?>>Hire</option>
                                  <option value="1" <?php if($product_type=="sale") echo "selected";?>>Buy</option>
                              </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <input type="text" id="from_date" name="from_date" class="form-control datepicker" placeholder="From Date *" required="required" />
                          </div>
                        </div>
                        
                        <div class="col-md-6 no_of_days_block" <?php if($product_type!="hire") echo "style='display:none;'"; ?>>
                          <div class="form-group">
                              <input type="number" id="no_of_days" name="no_of_days" min="1" class="form-control" placeholder="Number of Days" required="required" />
                            </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                                <textarea class="form-control" name="description" placeholder="Write few lines about your equipment" ></textarea>
                                
                          </div>
                        </div>
                        <ul class="list-inline pull-right">
                            <!-- <li><button type="button" class="btn btn-bei prev-step">Previous</button></li>-->
                            <li><a href="#" class="orderloading" style="display:none;"><img src="<?= Yii::$app->params['SITE_URL'] ?>images/loading.gif" /></a><button type="button" id="orderbutton" class="btn btn-bei btn-info-full" onclick="validateOrder()">Submit</button></li>
                            
                        </ul>
                    </div>
                    
                
                    <div class="tab-pane" role="tabpanel" id="step4">
                        <div id="ordermessage">
                            
                        </div>
                        <ul class="list-inline pull-right">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Close</button>
                        </ul>
                        
                    </div>
                    <div class="clearfix"></div>
            </div>
        </form>
    </div>
                    </div>
   
</div>
            </div>
            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>
    
<script>
//if category exist load sub categories using category id
<?php if(@$_GET['category'] || @$options['category']) { ?>
    <?php if(@$_GET['category'] != '') {?>
        var category_id = <?php echo @$_GET['category']; ?>;
    <?php } if(@$options['category'] != '') {?>
        var category_id = <?php echo $options['category']; ?>;
    <?php } ?>
        
    
$.ajax({
    url: "getproductsubcategories",
    data : {category_id: category_id, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" },
    dataType: 'json',
    success: function(data){

        $('#subcategory_id').html(data.out);
        <?php if(@$options['sub_category_id']) { ?>
            $('#subcategory_id').val(<?= @$options['sub_category_id'] ?>);
        <?php } ?>
        //getcapacity();
    }
});

<?php } ?>
//product type onchage
$('#product_type').change(function(){ getcapacity(); });

//category onchage event
$('#category_id').change(function(){
    if($(this).val() != '')
    {
        $.ajax({
            url: "getproductsubcategories",
            data : {category_id: $(this).val(), "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" },
            dataType: 'json',
            success: function(data){
                $('#subcategory_id').html(data.out);
                $('#capacity').html('<option value="" selected>SELECT CAPACITY</option>');

            }
        });
    }
    else
    {
        $('#subcategory_id').html('<option value="" selected>SELECT SUB CATEGORY</option>');
        $('#capacity').html('<option value="" selected>SELECT CAPACITY</option>');
    }
    //getcapacity();
});

//if sub category exists
<?php if(@$options['sub_category_id'] != '') {?>
   getcapacity($('#category_id').val(),<?= @$options['sub_category_id'] ?>);
<?php }?>


//sub category onchage event
$('#subcategory_id').change(function(){
    if($('#subcategory_id').val() != '')
    {
        getcapacity($('#category_id').val(),$('#subcategory_id').val());
    }
    else
    {
        $('#capacity').html('<option value="" selected>SELECT CAPACITY</option>');
    }
});

function getcapacity(category_id=null,sub_category_id = null)
{
    
    $.ajax({
        url: "getproductscapacity",
        data : {category_id: category_id,sub_category_id: sub_category_id, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" },
        dataType: 'json',
        success: function(data){
            $('#capacity').html(data.out);
            <?php if(@$options['capacity']) { ?>
                $('#capacity').val('<?= @$options['capacity'] ?>');
            <?php } ?>
        }
    });
}
//body onload plugins
$(document).ready(function(){
    $('#productslist').DataTable({
        "aaSorting": [],
        "fnDrawCallback": function (oSettings) {
            $("#productslist_filter input[type='search']").addClass("form-control datatable-search");
            
            var hiretype = '<div class="form-group">'+
                            '<label>Hire Type</label>'+
                            '<select class="form-control" onchange="getDatausinghiretype();" id="hire_type">'+
                                '<option value="">ALL</option>'+
                                '<option value="1">DAILY</option>'+
                                '<option value="2">MONTHLY</option>'+
                            '</select></div>';
            $(".dataTables_length label").contents().filter(function(){ return this.nodeType != 1; }).remove();   
            $("select[name='productslist_length']").addClass("form-control");
         }
    });
    $('.datepicker').datepicker({ startDate: "today",autoclose: true });
    
});
//if product id exist 
<?php  if(@$_GET['product_id'] != ''){ ?>
    getProductdata(<?= @$_GET['product_id'] ?>);
<?php }?>
//get product details and assign to modal box
function getProductdata(product_id)
{
    $.ajax({
        url: "getproductbyid",
        data : {product_id: product_id, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" },
        dataType: 'json',
        success: function(data){
            //var data = data.product;
            $("#product_model_title").html(data.title);
            $("#product_model_navs").html(data.navs);
            $("#product_model_details").html(data.details + data.images + data.load_charts);
            $("#product_model_footer").html(data.hire_now_button);
            $('#no_of_days').attr("placeholder","Number of "+data.price_type+" *");
            $('#product_price_type').val(data.price_type);
            $('#product_details').modal();
            $('[id^=carousel-selector-]').click(function () {
            var id_selector = $(this).attr("id");
            try {
                var id = /-(\d+)$/.exec(id_selector)[1];
                console.log(id_selector, id);
                jQuery('#myCarousel').carousel(parseInt(id));
                jQuery('#load_chart_carousel').carousel(parseInt(id));
            } catch (e) {
                console.log('Regex failed!', e);
            }
        });
            // When the carousel slides, auto update the text
            $('#myCarousel').on('slid.bs.carousel', function (e) {
                     var id = $('.item.active').data('slide-number');
                    $('#carousel-text').html($('#slide-content-'+id).html());
            });
            $('#load_chart_carousel').on('slid.bs.carousel', function (e) {
                     var id = $('.item.active').data('slide-number');
                    $('#carousel-text').html($('#slide-content-'+id).html());
            });
        }
    });
}
//google auto complete
function initAutocomplete() {
    autocomplete = new google.maps.places.Autocomplete(
    (document.getElementById('current_location')),
    {types: ['(regions)'],componentRestrictions: {country: "in"}});
}
//search products using hire type i.e., daily, monthly
function getDatausinghiretype()
{
    var hire_type = $('#hire_type').val();
    $("#price_type").val(hire_type);
    $( "#searchform" ).submit();
}

//display order form when click on single product hire
function order_now(product_id,type)
{
    if(type != 2)
    {
        $("#type").val(type);
        $(".ordertype").hide();
    }
    else{
        $(".ordertype").show();
    }
    $('#product_details').modal('toggle');
    $("#product_id").val(product_id);
    $('#order_details').modal('toggle');
    
    setTimeout(function() {
    $('body').addClass('modal-open');
    $('body').css('padding-right', '15px');
  }, 500)
    
}
//Type onchage event
$('#type').change(function(){
    if($('#type').val() == '0')
    {
        $(".no_of_days_block").show();
    }
    else
    {
        $(".no_of_days_block").hide();
    }
});
//new user registration validation and saving
function validateUser()
{
    if($("#addorder").valid())
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
                    $('.phoneexists').show();
                    return false;
                }
                else
                {
                    $('.phoneexists').hide();
                    $(".registration-btn").prop("disabled", true);
                    $(".formloading").show();
                    $.ajax({
                        type: "POST",
                        url: "newuserregistration",
                        data : $('#addorder').serialize(),
                        dataType: 'json',
                        success: function(data){
                            var $active = $('.wizard .nav-tabs li.active');
                            $active.next().removeClass('disabled');
                            nextTab($active);
                            $(".registration-btn").prop("disabled", false);
                            $(".formloading").hide();
                        }
                    });
                }
                
            }
        });
        
    }
    else
        $("#addorder").validate().focusInvalid();
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
//verify otp
function verifyOTP()
{
    if($("#addorder").valid())
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
    }
    else
        $("#addorder").validate().focusInvalid();
    
    
}
//validate and save order
function validateOrder()
{
    if($("#addorder").valid())
    {
        $("#orderbutton").attr("disabled", true);
        $(".orderloading").show();
        $.ajax({
            url: "saveneworder",
            data :  $('#addorder').serialize(),
            dataType: 'html',
            success: function(data){
                $('#ordermessage').html(data);
                var $active = $('.wizard .nav-tabs li.active');
                $active.next().removeClass('disabled');
                nextTab($active);
                $(".orderdetails").removeClass('active');
                $(".orderdetails").addClass('disabled');
                $("#orderbutton").attr("disabled", false);
                $(".orderloading").hide();
            },
            error:function(error){
                $("#orderbutton").attr("disabled", false);
                $(".orderloading").hide();
            }
        });
    }
    else
        $("#addorder").validate().focusInvalid();
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
        dataType: 'html',
        success: function (response) {
            if(response)
            {
                $("#phone_number").addClass('error');
                $('.phoneexists').show();
            }
            else
            {
                $("#phone_number").removeClass('error');
                $('.phoneexists').hide();
            }
        }
    });
});
//reload page after model close
$('#order_details').on('hidden.bs.modal', function (e) {
   <?php if(isset($_GET['product_id'])){ ?>
           window.location="<?= Yii::$app->params['SITE_URL'] ?>";
   <?php }else{ ?>
   location.reload();
   <?php } ?>
   
})
//multiple check availability
function updateproductids(id,cur_product_price_type = null)
{
    $previds = $('#product_id').val();
    var multiple_product_price_type = $('#multiple_product_price_type').val();
    if($("#multiavailabity"+id).is(':checked'))
    {
        var result = $previds.split(',');
        result.push(id);
        $('#product_id').val(result);
        $('.checkavailablebutton').removeClass('disabled'); 
        
        var check_price_types = multiple_product_price_type.split(',');
        if(jQuery.inArray('Days', check_price_types) !== -1)
        {
            var price_type = 'Days';
            $('#product_price_type').val('Days');
        }
        else
        {
            var price_type = cur_product_price_type;
            $('#product_price_type').val(cur_product_price_type);
        }
        
            check_price_types.push(cur_product_price_type);
        $('#multiple_product_price_type').val(check_price_types);
        $('#no_of_days').attr("placeholder","Number of "+price_type+" *");
    }

    else { 
        var result = $previds.split(',');
        result = jQuery.grep(result, function(value) {
            return value != id;
          });
        $('#product_id').val(result);
        var totalproducts=$("[type='checkbox']:checked").length;
        if(totalproducts > 0)
        {
           $('.checkavailablebutton').removeClass('disabled'); 
        }
        else
        {
            $('.checkavailablebutton').addClass('disabled'); 
        }
        
        var remove_check_price_types = $('#multiple_product_price_type').val().split(',');
        var index = remove_check_price_types.indexOf(cur_product_price_type);
        var new_remove_check_price_types = remove_check_price_types;
        if (index > -1) {
            delete remove_check_price_types[index];//remove_check_price_types.splice(index, 1);
            var new_remove_check_price_types = remove_check_price_types;
        }
        if(jQuery.inArray('Days', new_remove_check_price_types) !== -1)
        {
            var price_type = 'Days';
            $('#product_price_type').val('Days');
        }
        else
        {
            var price_type = 'Months';
            $('#product_price_type').val('Months');
        }
        $('#multiple_product_price_type').val(new_remove_check_price_types);
        $('#no_of_days').attr("placeholder","Number of "+price_type+" *");
        
    }
    
    
}
//open model box when click on checkavailability
function multipleCheckavailability()
{
    var totalproducts=$("[type='checkbox']:checked").length;
    if(totalproducts>0)
    {
        $('#order_details').modal('toggle');
    }
}

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
<script>
   $(document).ready(function(){
       $("#productslist_filter .input[type='search']").addClass("form-control");
   });
</script>
