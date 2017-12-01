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
                        <option value="hire" <?php if($product_type == 'hire') echo "selected=selected";?>>Hire</option>
                        <option value="sale" <?php if($product_type == 'sale') echo "selected=selected";?>>Sale</option>
                        <option value="both" <?php if($product_type == 'both') echo "selected=selected";?>>Hire & Sale</option>
                    </select>
                </div>
                <?php } else { ?>
                <input type="hidden" name="product_type" id="product_type" value="<?= $product_type ?>" />
                <?php } ?>
                <div class="form-group">
                    <label>Choose Categories</label>
                    <select class="form-control" id="category_id" name="category" >
                        <option value="">--select category--</option>
                        <?php foreach($productcategories as $category)
                            if(@$_GET['category'] == $category->category_id || @$options['category'] == $category->category_id)
                                echo "<option value='$category->category_id' selected='selected'>$category->category_name</option>";
                            else
                                echo "<option value='$category->category_id' >$category->category_name</option>";
                        ?>
                    </select>
                </div>
                <div class="form-group" >
                    <label>Select Sub Category</label>
                    <select class="form-control" id="subcategory_id" name="sub_category_id">
                        <option value="">Select Sub Category</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Select Capacity</label>
                    <select class="form-control" id="capacity" name="capacity">
                        <option value="">Select Capacity</option>
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
                                <option value="1" <?php if(@$options['price_type'] == 1) echo "selected=selected"; ?>>Daily</option>
                                <option value="2" <?php if(@$options['price_type'] == 2) echo "selected=selected"; ?>>Monthly</option>
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
                <table id="productslist">
                    
                    <thead><tr><th></th></tr></thead>
                    <tbody>
                <?php foreach($products as $product) { ?>
                    <tr><td>
                <div class="item">
                    <form action="" class="form-inline">
                        <input class="form-control styled-checkbox" type="checkbox" name="multiavailabity[]" id="multiavailabity<?= $product['product_id']?>" value="<?= $product['product_id']?>" onclick="updateproductids(<?= $product['product_id']?>)" <?php if(Yii::$app->user->id == $product['user_id']) echo "disabled style='opacity:0'"; ?>>
                        <label for="styled-checkbox-1" class="checkc"></label>
                    </form>
                    <div class="itemdtls">
                        <div class="itemimg">
                            <img src="<?= $product['image_url'] ?>" alt="" width="93px" height="85px">
                        </div>
                        <div class="itemcon">
                            <h4><?php echo $product['equipment_title']; ?></h4>
                            <ul class="list-inline">
                                <?php if($product_type=='hire'){ ?>
                                <li><i class="fa fa-rupee"></i><?= $product['hire_price'] ?>/<?php if($product['price_type'] == 1) echo "Daily"; else echo "Monthly"; ?></li>
                                <?php } else { ?>
                                <li><i class="fa fa-rupee"></i><?= $product['sale_price'] ?></li>
                                <?php } ?>
                                <li><strong>Capacity:</strong> <?= $product['capacity'] ?></li>
                                <li><strong><i class="fa fa-map-marker"></i>Location</strong> <?= $product['current_location'] ?></li>
                            </ul>
                        </div>
                    </div>

                    <div class="itembtn">
                        <a href="#" class="btn btn-border-bei" onclick="getProductdata(<?= $product['product_id']?>);">View</a>
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
                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                                Step <span><?php if(Yii::$app->user->isGuest) { echo "3"; } else { echo "1";} ?></span>
                        </a>
                </li>
                <li role="productdata" class='disabled'>
                        <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab" title="Step 4">
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
                        <input type="hidden" name="product_id" id="product_id" value="">
                        <input type="hidden" name="type" id="type"  value="<?php if($product_type=="hire") echo "0";else if($product_type=="sale") echo '1';else if($product_type=="both") echo '2';  ?>"  >
                        <div class="col-md-6">
                          <div class="form-group">
                              <input type="text" id="from_date" name="from_date" class="form-control datepicker" placeholder="From Date" required="required" />
                          </div>
                        </div>
                        <?php if($product_type=="hire") { ?>
                        <div class="col-md-6">
                          <div class="form-group">
                              <input type="number" id="no_of_days" name="no_of_days" min="1" class="form-control" placeholder="Number of Days" required="required" />
                            </div>
                        </div>
                        <?php } ?>
                        <div class="col-md-12">
                          <div class="form-group">
                                <textarea class="form-control" name="description" placeholder="Write few lines about your equipment" ></textarea>
                                
                          </div>
                        </div>
                        <ul class="list-inline pull-right">
                            <!-- <li><button type="button" class="btn btn-bei prev-step">Previous</button></li>-->
                            <li><button type="button" id="orderbutton" class="btn btn-bei btn-info-full" onclick="validateOrder()">Submit</button></li>
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
        getcapacity();
    }
});

<?php } ?>
//product type onchage
$('#product_type').change(function(){ getcapacity(); });
//category onchage event
$('#category_id').change(function(){
    $.ajax({
        url: "getproductsubcategories",
        data : {category_id: $(this).val(), "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" },
        dataType: 'json',
        success: function(data){
            $('#subcategory_id').html(data.out);
            <?php if(@$options['sub_category_id']) { ?>
                $('#subcategory_id').val('<?= @$options['sub_category_id'] ?>');
            <?php } ?>
        }
    });
    getcapacity();
}); 
function getcapacity()
{
    
    $.ajax({
        url: "getproductscapacity",
        data : {category_id: $('#category_id').val(),sub_category_id: $('#subcategory_id').val(), "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" },
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
                                '<option value="">All</option>'+
                                '<option value="1">Daily</option>'+
                                '<option value="2">Monthly</option>'+
                            '</select></div>';
            $(".dataTables_length label").contents().filter(function(){ return this.nodeType != 1; }).remove();   
            $("select[name='productslist_length']").addClass("form-control");
         }
    });
    $('.datepicker').datepicker({ startDate: "today" });
    
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
function order_now(product_id)
{
    $('#product_details').modal('toggle');
    $("#product_id").val(product_id);
    $('#order_details').modal('toggle');
}
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
            dataType: 'json',
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
                        data : $('#addorder').serialize(),
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
    };
    
    
}
//validate and save order
function validateOrder()
{
    if($("#addorder").valid())
    {
        $("#orderbutton").attr("disabled", true);
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
            },
            error:function(error){
                $("#orderbutton").attr("disabled", false);
            }
        });
    }
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
//reload page after model close
$('#order_details').on('hidden.bs.modal', function (e) {
   location.reload();
})
//multiple check availability
function updateproductids(id)
{
    $previds = $('#product_id').val();
    if($("#multiavailabity"+id).is(':checked'))
    {
        var result = $previds.split(',');
        result.push(id);
        $('#product_id').val(result);
        $('.checkavailablebutton').removeClass('disabled'); 
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
