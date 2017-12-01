<?php 
if(!isset($_GET['product_type']))
    $product_type = 'supply';
else
    $product_type = $_GET['product_type'];

if($product_type == 'sale')
    $product_type = 'sale';
else if($product_type == 'both')
    $product_type = 'supply/sale';
?>
<section role="main" class="content-body">
    <header class="page-header">
        <h2><?= strtoupper($product_type) ?></h2>
        <div class="right-wrapper pull-right pr-xlg">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= Yii::$app->params['SITE_URL'] ?>admin">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Products</span></li>
                <li><span><?= strtoupper($product_type) ?></span></li>
            </ol>
        </div>
    </header>

    <!-- start: page -->
    <div class="col-lg-12 wizart-custom" <?php if(!\app\models\User::checkAccess('addproduct')) echo "style='display:none;'"; ?>>
        <section class="panel form-wizard" id="w1">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle=""></a>
                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss=""></a>
                </div>

                <h2 class="panel-title">Form Wizard</h2>
            </header>
            <div class="panel-body">
                <div class="wizard-tabs">
                    <ul class="wizard-steps">
                        <!--<li class="active">
                            <a href="#step1" data-toggle="tab" class="text-center">
                                <span class="badge hidden-xs">1</span>
                                Registration
                            </a>
                        </li>
                        <li>
                            <a href="#step2" data-toggle="tab" class="text-center">
                                <span class="badge hidden-xs">2</span>
                                Confirm
                            </a>
                        </li>-->
                        <li class="active">
                            <a href="#step3" data-toggle="tab" class="text-center">
                                <span class="badge hidden-xs">1</span>
                                product
                            </a>
                        </li>
                        <li class="disabled">
                            <a href="#step4" data-toggle="tab" class="text-center">
                                <span class="badge hidden-xs">2</span>
                                product
                            </a>
                        </li>
                        <li class="disabled">
                            <a href="#step5" data-toggle="tab" class="text-center">
                                <span class="badge hidden-xs">3</span>
                                product
                            </a>
                        </li>
                    </ul>
                </div>
                <form role="form" method="post" action="saveproduct" name="addproduct" id="addproduct">
                    <div class="tab-content">
                        <div id="step1" class="tab-pane">
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
                                    <input name="email" id="email" class="form-control" placeholder="Email Address *" required="required" aria-required="true" type="email">
                                    <span><strong>Note: </strong>This will be your user ID</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input name="user_name" id="user_name" class="form-control" placeholder="Enter your name *" required="required" aria-required="true" type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input name="phone_number" id="phone_number" class="form-control" placeholder="Enter Mobile Number *" required="required" minlength="10" maxlength="10" onkeyup="if (/\D/g.test(this.value))
                                                this.value = this.value.replace(/\D/g, '')" aria-required="true" type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input name="password" id="password" class="form-control" placeholder="Password should be minimum 8 characters *" required="required" minlength="8" aria-required="true" type="password">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input name="regrepassword" id="regrepassword" class="form-control" placeholder="Re-enter Enter Password *" required="required" data-rule-equalto="#password" aria-required="true" type="password">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input name="company_name" id="company_name" class="form-control" placeholder="Company name *" required="required" aria-required="true" type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input name="designation" id="designation" class="form-control" placeholder="Designation" type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input name="company_email" id="company_email" class="form-control" placeholder="Company Email" type="email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input name="address" id="address" class="form-control" placeholder="Company Address" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-inline pull-right">
                                <li>
                                    <button type="button" class="btn btn-bei registration-btn" onclick="validateUser();">Register</button>
                                    <a href="#" class="formloading" style="display:none;"><img src="http://devrabbitdev.com/dei/web/images/loading.gif"></a>
                                </li>
                            </ul>
                        </div>
                        <div id="step2" class="tab-pane">

                            <div class="head-2 col-md-6 col-md-offset-3">
                                <h2>Enter OTP <span>(* All fields required)</span></h2>

                            </div>
                            <div class="head-2 col-md-6 col-md-offset-3">
                                <label>Please check your Registered E-mail or Mobile Number </label>
                            </div>
                            <div class="col-md-6 col-md-offset-3">
                                <div class="form-group">
                                    <input class="form-control" id="otp" name="otp" placeholder="Enter your OTP" type="text">

                                </div>
                                <a href="javascript:function() { return false; }" class="text-dei underline" onclick="resendOTP();">Re-send the OTP</a>
                            </div>
                            <div class="clearfix"></div>
                            <ul class="list-inline pull-right">
                                <!-- <li><button type="button" class="btn btn-bei prev-step">Previous</button></li> -->
                                <li><button type="button" class="btn btn-bei" onclick="verifyOTP();">Verify</button></li>
                            </ul>
                        </div>
                        <div id="step3" class="tab-pane active">

                            <div class="head-2 col-md-12">
                                <h2>Essential Information <span>(* All fields required)</span></h2>
                            </div>
                            <input name="product_type" id="product_type" value="0" type="hidden">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" id="category_id" name="category_id" required="required" aria-required="true">
                                        <option value="">SELECT CATEGORY *</option>
                                        <?php foreach($productcategories as $category)
                                            echo "<option value='$category->category_id'>".strtoupper($category->category_name)."</option>";
                                        ?>                           
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" id="subcategory_id" name="sub_category_id" required="required" aria-required="true">
                                        <option value="" selected="">SELECT SUB CATEGORY *</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input id="capacity" name="capacity" class="form-control" placeholder="Capacity In Tons *" required="required" onkeyup="if (/\D/g.test(this.value))
                                                this.value = this.value.replace(/\D/g, '')" aria-required="true" type="text">
                                    <input id="capacity_metric" name="capacity_metric" value="Tons" type="hidden">
                                </div>
                            </div>
                            <div class="col-md-12 dynamic boomlength" style="display: block;">
                                <div class="form-group">
                                    <input id="boom_length" name="boom_length" class="form-control" placeholder="Boom length (in meters) *" required="required" onkeyup="if (/\D/g.test(this.value))
                                                this.value = this.value.replace(/\D/g, '')" aria-required="true" type="text">

                                </div>
                            </div>
                            <ul class="list-inline pull-right">
                                <!-- <li><button type="button" class="btn btn-bei prev-step">Previous</button></li>-->
                                <li><button type="button" class="btn btn-bei btn-info-full" onclick="validateProductinfo()">Save and continue</button></li>
                            </ul>
                        </div>
                        <div id="step4" class="tab-pane">

                            <div class="head-2 col-md-12">
                                <h2>Basic Information <span>(* All fields required)</span></h2>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" name="equipment_title" id="equipment_title" placeholder="Equipment Title *" required="required" aria-required="true" type="text">

                                </div>
                            </div>
                            <div class="col-md-6 dynamic model" style="display: block;">
                                <div class="form-group">
                                    <select class="form-control" id="model_id" name="model_id" required="required" aria-required="true">
                                        <option value="">MODEL *</option>
                                    </select>
                                    <input name="model_other" id="model_other" placeholder="Model" class="form-control pull-right" style="display:inline-block;width:48%;display: none;" type="text">

                                </div>
                            </div>
                            <div class="col-md-6 dynamic fly_jib" style="display: block;">
                                <div class="form-group">
                                    <!--<div class="input-group">-->
                                    <input name="fly_jib" id="fly_jib" class="form-control" placeholder="Fly Jib (Length In meters)" onkeyup="if (/\D/g.test(this.value))
                                                this.value = this.value.replace(/\D/g, '')" type="text">
                                        <!--<div class="input-group-addon bg-dei"><i class="fa fa-check"></i></div>-->
                                    <!-- </div> -->
                                </div>
                            </div>
                            <div class="col-md-6 dynamic luffing_jib" style="display: block;">
                                <div class="form-group">
                                    <!-- <div class="input-group"> -->
                                    <input name="luffing_jib" id="luffing_jib" class="form-control" placeholder="Luffing Jib (Length In meters)" onkeyup="if (/\D/g.test(this.value))
                                                this.value = this.value.replace(/\D/g, '')" type="text">
                                    <!-- <div class="input-group-addon bg-dei"><i class="fa fa-check"></i></div> -->
                                    <!-- </div> -->
                                </div>
                            </div>
                            <div class="col-md-6 dynamic register_num" style="display: block;">
                                <div class="form-group">
                                    <input name="registered_number" id="registered_number" placeholder="Registered Number" class="form-control" type="text">

                                </div>
                            </div>
                            <div class="col-md-6 dynamic bucket_capacity" style="display: none;">
                                <div class="form-group">
                                    <input name="bucket_capacity" id="bucket_capacity" placeholder="Bucket Capacity in Cubic Meters*" class="form-control" required="required" aria-required="true" type="text">

                                </div>
                            </div>
                            <div class="col-md-6 dynamic life_tax_details" style="display: block;">
                                <div class="form-group">
                                    <select class="form-control select" name="life_tax_details[]" id="life_tax_details" multiple="multiple">
                                        <option value="">Life Tax Details </option> 
                                        <?php
                                        foreach ($regions as $region)
                                            if ($region->region_id != 1)
                                                echo "<option value='$region->region_id'>" . strtoupper($region->region_name) . "</option>";
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 dynamic condition" style="display: none;">
                                <div class="form-group">
                                    <input name="condition" id="condition" placeholder="Registered Number *" class="form-control" required="required" aria-required="true" type="text">

                                </div>
                            </div>
                            <div class="col-md-6 manufacture_year">
                                <div class="form-group">
                                    <select class="form-control" name="manufacture_year" id="manufacture_year">
                                        <option value="">Manfacture Year</option>
                                        <?php
                                        for ($year = 1960; $year <= date('Y'); $year++) {
                                            echo "<option value='$year'>$year</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 dimensions">
                                <div class="form-group">
                                    <input name="dimensions" id="dimensions" placeholder="Dimensions ( Length x Width x Height ) in meters" class="form-control" size="8" maxlength="8" onkeyup="this.value = this.value.replace(/^(\d\d)(\d)$/g, '$1x$2').replace(/^(\d\d\x\d\d)(\d+)$/g, '$1x$2').replace(/[^\dx]/g, '')" type="text">

                                </div>
                            </div>

                            <div class="col-md-6 dynamic kelly_length" style="display: none;">
                                <div class="form-group">
                                    <input name="kelly_length" id="kelly_length" placeholder="Kelly Length in Meters" class="form-control" onkeyup="if (/\D/g.test(this.value))
                                                this.value = this.value.replace(/\D/g, '')" type="text">

                                </div>
                            </div>
                            <div class="col-md-6 dynamic arm_length" style="display: none;">
                                <div class="form-group">
                                    <input name="arm_length" id="arm_length" placeholder="Arm Length in Meters" class="form-control" onkeyup="if (/\D/g.test(this.value))
                                                this.value = this.value.replace(/\D/g, '')" type="text">

                                </div>
                            </div>
                            <div class="col-md-6 dynamic manufacturer" style="display: none;">
                                <div class="form-group">
                                    <input name="manufacturer" id="manufacturer" placeholder="Manufacturer *" class="form-control" required="required" aria-required="true" type="text">

                                </div>
                            </div>
                            <div class="col-md-6 dynamic no_axles" style="display: none;">
                                <div class="form-group">
                                    <input name="numberof_axles" id="numberof_axles" placeholder="Number of Axles" class="form-control" maxlength="3" type="text">

                                </div>
                            </div>
                            <div class="col-md-6 price_type">
                                <div class="form-group">
                                    <select class="form-control" name="price_type" id="price_type" required="required" aria-required="true">
                                        <option value="">ALL HIRE TYPE *</option> 
                                        <option value="1">DAILY</option> 
                                        <option value="2">MONTHLY</option> 
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 pricing">
                                <div class="form-group">
                                    <input name="hire_price" id="hire_price" placeholder="Hire Price *" class="form-control" required="required" onkeyup="if (/\D/g.test(this.value))
                                                this.value = this.value.replace(/\D/g, '')" aria-required="true" type="text">

                                </div>
                            </div>
                            <div class="col-md-6 sale_price" style="display: none;">
                                <div class="form-group">
                                    <input name="sale_price" id="sale_price" placeholder="Sale Price *" class="form-control" required="required" onkeyup="if (/\D/g.test(this.value))
                                                this.value = this.value.replace(/\D/g, '')" aria-required="true" type="text">

                                </div>
                            </div>

                            <div class="col-md-6 description">
                                <div class="form-group">
                                    <textarea class="form-control" name="description" placeholder="Write few lines about your equipment"></textarea>

                                </div>
                            </div>
                            <ul class="list-inline pull-right">
                                <li><button type="button" class="btn btn-bei prev-step">Previous</button></li>
                                <!--<li><button type="button" class="btn btn-bei next-step">Skip</button></li>-->
                                <li><button type="button" class="btn btn-bei btn-info-full" onclick="validateProductinfo()">Save and continue</button></li>
                            </ul>
                        </div>
                        <div id="step5" class="tab-pane">

                            <div class="head-2 col-md-12">
                               <h2><?php if(@$product_type=='sale')
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

                                    <input class="field" id="route" name="route" type="hidden"0 />

                                    <input class="field" id="locality" name="city" type="hidden" />

                                    <input class="field" id="administrative_area_level_1" name="state" type="hidden" />

                                    <input class="field" id="postal_code" name="zipcode" type="hidden" />

                                    <input class="field" id="country" name="country" type="hidden" />

                                    <input class="field" id="latitude" name="latitude" type="hidden" />

                                    <input class="field" id="longitude" name="longitude" type="hidden"  />
                                </div>
                            </div>
                            <?php if (@product_type != 'sale') { ?>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <select name="exact_location[]" class="form-control select" id="exact_location_id" multiple="multiple"  placeholder="Choose  Serving location(s)">
                                            <?php
                                            foreach ($regions as $region)
                                                echo "<option value='$region->region_name'>" . strtoupper($region->region_name) . "</option>";
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
                                            <input name="product_type_check" id="product_type_check" value="1" type="checkbox"> Click here to post both in Hire &amp; Sale
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-inline pull-right">
                                <li><button type="button" class="btn btn-bei prev-step">Prev</button></li>
                                <li><button type="button" class="btn btn-bei productimage" onclick="validateProductimage()">Save and Continue</button></li>
                            </ul>
                            <div class="clearfix"></div>
                            <p class="text-right text-small">By clicking Submit you accept our Terms of Use and Privacy Policy</p>
                        </div>
                        <div id="step6" class="tab-pane">

                        </div>
                    </div>
                </form>
            </div>
            <!--<div class="panel-footer">
                    <ul class="pager">
                            <li class="previous disabled">
                                    <a><i class="fa fa-angle-left"></i> Previous</a>
                            </li>
                            <li class="finish hidden pull-right">
                                    <a>Finish</a>
                            </li>
                            <li class="next">
                                    <a>Next <i class="fa fa-angle-right"></i></a>
                            </li>
                    </ul>
            </div>-->
        </section>
    </div>

    <div class="clearfix"></div>

    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
            </div>

            <h2 class="panel-title">Total <?= ucfirst($product_type) ?> List</h2>
        </header>
        <div class="panel-body">
            <table class="table table-bordered table-striped mb-none" id="product_list">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Category</th>
                        <!--<th>Sub Category</th>
                        <th>Model</th>-->
                        <th>Assigned To</th>
                        <th>Created on</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($products as $product) {
                    echo '<tr class="gradeX">
                        <td>'.$product['manual_product_code'].'</td>
                        <td>'.$product['category_name'].'</td>';
                        /*<td>'.$product['sub_category_name'].'</td>
                        <td>'.$product['model_name'].'</td>*/
                        echo '<td>'.$product['employee_name'].'</td>
                        <td>'.date('m-d-Y H:i:s', strtotime($product['date_created'])).'</td>
                        <td>';
                        
                    if($product['status_updated_by']) $status_updatedby = ' by '.$product['status_updated_by']; else $status_updatedby = '';
                    
                    if($product['product_status'] == 0)
                        echo '<span class="label label-warning">Pending'.$status_updatedby.'</span>';
                    elseif($product['product_status'] == 1)
                        echo '<span class="label label-success">Approved'.$status_updatedby.'</span>';
                    elseif($product['product_status'] == 2)
                        echo '<span class="label label-danger">Rejected'.$status_updatedby.'</span>';
                    elseif($product['product_status'] == 3)
                        echo '<span class="label label-default">Deleted</span>';
                    else
                        echo $product['product_status'];
                    /*elseif($product['product_status'] == 4)
                        echo '<span class="label label-success">Approved by sales manger</span>';
                    elseif($product['product_status'] == 5)
                        echo '<span class="label label-default">Rejected</span>';
                    elseif($product['product_status'] == 6)
                        echo '<span class="label label-info">Re-Initialized</span>';
                    elseif($product['product_status'] == 7)
                        echo '<span class="label label-info">Closed</span>';*/
                    if(\app\models\User::checkAccess('product_edit'))
                        echo '<td class="actions text-center">
                                <a href="'.Yii::$app->params['SITE_URL'].'admin/editproduct/'.$product['product_id'].'"><i class="fa fa-pencil"></i></a>
                                <a href="'.Yii::$app->params['SITE_URL'].'admin/viewproduct/'.$product['product_id'].'"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>';
                    else
                        echo '<td class="actions text-center">
                                <a href="'.Yii::$app->params['SITE_URL'].'admin/viewproduct/'.$product['product_id'].'"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>';
                    } ?>
                </tbody>
            </table>
        </div>
    </section>


    <!-- end: page -->
</section>
<script>
$(document).ready(function() {   
    $("#product_list").DataTable({
        "aaSorting": [],"oLanguage": {"sLengthMenu": "\_MENU_"}
    });
});
</script>
<script>
$(document).ready(function () {
    $(".next-step").click(function (e) {

        var $active = $('.wizard-tabs .wizard-steps li.active');
        $active.next().removeClass('disabled');
        nextTab($active);

    });
    $(".prev-step").click(function (e) {

        var $active = $('.wizard-tabs .wizard-steps li.active');
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
//validate essential block info
function validateProductinfo()
{
    if($("#addproduct").valid())
    {
        var $active = $('.wizard-tabs .wizard-steps li.active');
        $active.next().removeClass('disabled');
        nextTab($active);
    }
    else
        $("#addproduct").validate().focusInvalid();
}
//category onchange
$('#category_id').change(function(){
    var category_id = $(this).val();
    $.ajax({
        url: "<?= Yii::$app->params['SITE_URL'] ?>getproductsubcategories",
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
//onchange sub category
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
    
    $.ajax({
        url: "<?= Yii::$app->params['SITE_URL'] ?>getsubcategorymodels",
        data : {sub_category_id: $(this).val(), "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" },
        dataType: 'json',
        success: function(data){
            $('#model_id').html(data.out);
        }
    });
}); 
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
        url:"<?= Yii::$app->params['SITE_URL'] ?>uploadproductimages",
        paramName: 'category_id',
        acceptedFiles: "image/jpeg,image/png,image/gif",
        maxFilesize: 2,
        init: function() {
            this.on('sending', function(file, xhr, formData){ 
                formData.append('category_id',$("#category_id").val()); 
                $(".productimage").attr("disabled", true);
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
            $(".productimage").attr("disabled", false);
        }
    });
    $("div#productloadcharts").dropzone({
    url:"<?= Yii::$app->params['SITE_URL'] ?>uploadproductloadcharts",
    acceptedFiles: "image/jpeg,image/png,image/gif",
    maxFilesize: 2,
    init: function() {
            this.on('sending', function(file, xhr, formData){ 
                formData.append('category_id',$("#category_id").val()); 
                $(".productimage").attr("disabled", true);
            });
            this.on("removedfile", function(file) {
                 $.ajax({
                      url: '<?= Yii::$app->params['SITE_URL'] ?>deleteproductloadcharts',
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
            $(".productimage").attr("disabled", false);
        }
    });
        
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
</script>