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
$product_type = $product_details['product_type'];
if($product_type == 0)
    $product_type = 'Supply';
else if($product_type == 1)
    $product_type = 'Sale';
if($product_type == 2)
    $product_type = 'Supply/Sale';
?>
<section role="main" class="content-body">
    <header class="page-header">
        <h2><?= strtoupper($product_type) ?></h2>
        <div class="right-wrapper pull-right pr-xlg">
            <ol class="breadcrumbs">
                <li>
                    <a href="/admin">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span><?= strtoupper($product_type) ?> Details</span></li>
            </ol>
        </div>
    </header>
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>
    <?php if (Yii::$app->session->hasFlash('warning')): ?>
        <div class="alert alert-warning alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <?= Yii::$app->session->getFlash('warning') ?>
        </div>
    <?php endif; ?>
    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>
    <?php 
    if($product_details['product_type'] == 0)
        $productlist_type = 'supply';
    else if($product_details['product_type'] == 1)
        $productlist_type = 'sale';
    else if($product_details['product_type'] == 2)
        $productlist_type = 'both';
    ?>
    <!-- start: page -->
    <div class="col-md-6 col-md-offset-3">
        <a href="<?= Yii::$app->params['SITE_URL'] ?>admin/products?product_type=<?= $productlist_type ?>" class="mb-xs mt-xs mr-xs btn btn-primary btn-block">Back To <?= strtoupper($product_type) ?> List</a>
    </div>
    <form class="form-horizontal form-dtls" method="post" action="<?= Yii::$app->params['SITE_URL'] ?>admin/updateproduct" id="editproduct">
        <div class="col-md-12">
        <div class="tabs tabs-danger">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#popular4" data-toggle="tab" aria-expanded="true"><i class="fa fa-align-left"></i> Product Details</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="popular4" class="tab-pane active">
                    
                        <section class="panel">

                            <h2 class="panel-title">Product Details</h2>
                            <input type="hidden" name="product_id" value="<?= $product_details['product_id'] ?>"  >
                            <div class="panel-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Category : </label>
                                        <div class="col-sm-8">
                                            <select class="form-control" id="category_id" name="category_id" required="required">
                                                <option value="">SELECT CATEGORY *</option>
                                                <?php
                                                foreach ($productcategories as $category)
                                                    if ($product_details['category_id'] == $category->category_id)
                                                        echo "<option value='$category->category_id' selected='selected'>" . strtoupper($category->category_name) . "</option>";
                                                    else
                                                        echo "<option value='$category->category_id'>" . strtoupper($category->category_name) . "</option>";
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Sub Category : </label>
                                        <div class="col-sm-8">
                                            <select class="form-control" id="subcategory_id" name="sub_category_id" required="required">
                                                <option value="">SELECT SUB CATEGORY *</option>
                                                <?php
                                                foreach ($productsubcategories as $subcategory)
                                                    if ($product_details['sub_category_id'] == $subcategory['sub_category_id'])
                                                        echo "<option value='".$subcategory['sub_category_id']."' selected='selected'>" . strtoupper($subcategory['sub_category_name']) . "</option>";
                                                    else
                                                        echo "<option value='".$subcategory['sub_category_id']."'>" . strtoupper($subcategory['sub_category_name']) . "</option>";
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Capacity : </label>
                                        <div class="col-sm-8">
                                            <?php
                                            $capacity = explode(' ',$product_details['capacity']);
                                            ?>
                                            <input type="text" id="capacity" name="capacity" value="<?=$capacity[0]?>" class="form-control" placeholder="Capacity*" required="required" onKeyUp="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" />
                                            <input type="hidden" id="capacity_metric" name="capacity_metric" value="<?=$capacity[1]?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 dynamic boomlength">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Boom Length : </label>
                                        <div class="col-sm-8">
                                            <input type="text" id="boom_length" name="boom_length" value="<?=$product_details['boom_length']?>" class="form-control" placeholder="Boom length (in meters) *" required="required" onKeyUp="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Equipment Title : </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="equipment_title" value="<?=$product_details['equipment_title']?>" id="equipment_title" placeholder="Equipment Title *" required="required" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Model : </label>
                                        <div class="col-sm-8">
                                            <select class="form-control" id="model_id" name="model_id" required="required">
                                                <option value=''>MODEL *</option>
                                                <?php
                                                foreach ($models as $model)
                                                    if ($product_details['model_id'] == $model['model_id'])
                                                        echo "<option value='".$model['model_id']."' selected='selected'>" . strtoupper($model['model_name']) . "</option>";
                                                    else
                                                        echo "<option value='".$model['model_id']."'>" . strtoupper($model['model_name']) . "</option>";
                                                ?>
                                            </select>
                                            <input type="text" name="model_other" value="<?=$product_details['model_other']?>" id="model_other" placeholder="Model" class="form-control pull-right" style="display:inline-block;width:48%;display: none;" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 <?php if($product_details['model_id'] != 324){ echo 'dynamic';} ?> model_other">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Model Other : </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="model_other" id="model_other" placeholder="Model" class="form-control" value="<?=$product_details['model_other']?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6  dynamic fly_jib">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Fly Jib : </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="fly_jib" id="fly_jib" value="<?=$product_details['fly_jib']?>" class="form-control" placeholder="Fly Jib (Length In meters)" onKeyUp="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 dynamic luffing_jib">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Luffing Jib : </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="luffing_jib" id="luffing_jib" value="<?=$product_details['luffing_jib']?>" class="form-control" placeholder="Luffing Jib (Length In meters)" onKeyUp="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 dynamic register_num">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Registration Number : </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="registered_number" id="registered_number" value="<?=$product_details['registered_number']?>" placeholder="Registered Number" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 dynamic bucket_capacity">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Bucket Capacity : </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="bucket_capacity" id="bucket_capacity" value="<?=$product_details['bucket_capacity']?>" placeholder="Bucket Capacity in Cubic Meters*" class="form-control" required="required">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 dynamic life_tax_details">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Life Tax Details : </label>
                                        <div class="col-sm-8">
                                            <select class="form-control select" name="life_tax_details[]" id="life_tax_details" multiple="multiple">
                                                <!--<option value="">Life Tax Details </option>--> 
                                                <?php
                                                $life_tax_details = explode(',',$product_details['life_tax_details']);
                                                foreach ($regions as $region)
                                                    if ($region->region_id != 1)
                                                    {
                                                    if (in_array($region->region_id, $life_tax_details))
                                                        echo "<option value='".$region->region_id."' selected='selected'>" . strtoupper($region->region_name) . "</option>";
                                                    else
                                                        echo "<option value='".$region->region_id."'>" . strtoupper($region->region_name) . "</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 manufacture_year">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Manufacture Year : </label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="manufacture_year" id="manufacture_year">
                                                <option value="">Manfacture Year</option>
                                                <?php
                                                for ($year = 1960; $year <= date('Y'); $year++) {
                                                    if($product_details['manufacture_year'] == $year)
                                                        echo "<option value='$year' selected='selected'>$year</option>";
                                                    else
                                                        echo "<option value='$year'>$year</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 dimensions">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Dimensions : </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="dimensions" value="<?=$product_details['dimensions']?>" id="dimensions" placeholder="Dimensions ( Length x Width x Height ) in meters" class="form-control" size=8 maxlength=8  onkeyup="this.value=this.value.replace(/^(\d\d)(\d)$/g,'$1x$2').replace(/^(\d\d\x\d\d)(\d+)$/g,'$1x$2').replace(/[^\dx]/g,'')">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 dynamic kelly_length">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Kelly Length : </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="kelly_length" value="<?=$product_details['kelly_length']?>" id="kelly_length" placeholder="Kelly Length in Meters" class="form-control" onKeyUp="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 dynamic arm_length">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Arm Length : </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="arm_length" value="<?=$product_details['arm_length']?>" id="arm_length" placeholder="Arm Length in Meters" class="form-control" onKeyUp="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 dynamic no_axles">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Number of Axles : </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="numberof_axles" value="<?=$product_details['numberof_axles']?>" id="numberof_axles" placeholder="Number of Axles" class="form-control" maxlength="3">
                                        </div>
                                    </div>
                                </div>
                                <?php if($product_details['product_type'] != 1) { ?>
                                <div class="col-md-6 price_type">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Price Type : </label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="price_type" id="price_type" required="required">
                                                <option value="" <?php if($product_details['price_type'] == '') echo "selected='selected'"; ?>>ALL HIRE TYPE *</option> 
                                                <option value="1" <?php if($product_details['price_type'] == 1) echo "selected='selected'"; ?>>DAILY</option> 
                                                <option value="2" <?php if($product_details['price_type'] == 2) echo "selected='selected'"; ?>>MONTHLY</option> 
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 pricing">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Hire Price : </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="hire_price" value="<?=$product_details['hire_price']?>" id="hire_price" placeholder="Hire Price *" class="form-control" required="required" onKeyUp="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                                <?php if($product_details['product_type'] != 0) { ?>
                                <div class="col-md-6 sale_price">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Sale Price : </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="sale_price" value="<?=$product_details['sale_price']?>" id="sale_price" placeholder="Sale Price *" class="form-control" required="required" onKeyUp="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Description : </label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" name="description"  placeholder="Write few lines about your equipment" ><?=$product_details['description']?></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-12 serving-details">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Current Location : </label>
                                        <div class="col-sm-10">
                                            <input id="autocomplete" name="current_location" value="<?=$product_details['current_location']?>" type="text" class="form-control" required="required" placeholder="Enter Equipment Current Location *" onKeyUp="if (/\d/g.test(this.value)) this.value = this.value.replace(/\d/g,'');" onblur="this.value=this.value.replace(/^[\s]+|[\s]+$/g, '');"/>
                                            <input id="google_place_id" type="hidden" name="google_place_id" value="<?= $current_location['google_place_id'] ?>" />

                                            <input class="field" id="street_number" name="street" type="hidden" value="" />

                                            <input class="field" id="route" name="route" type="hidden" />

                                            <input class="field" id="locality" name="city" type="hidden" />

                                            <input class="field" id="administrative_area_level_1" name="state" type="hidden" value="<?= $current_location['longitude'] ?>" />

                                            <input class="field" id="postal_code" name="zipcode" type="hidden" />

                                            <input class="field" id="country" name="country" type="hidden" value="<?= $current_location['country'] ?>"/>

                                            <input class="field" id="latitude" name="latitude" type="hidden" value="<?= $current_location['latitude'] ?>"/>

                                            <input class="field" id="longitude" name="longitude" type="hidden"  value="<?= $current_location['longitude'] ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <?php if($product_details['product_type'] != 1) { 
                                    $saved_locations = [];
                                    foreach($serving_locations as $serving_location)
                                    {
                                        if($serving_location['state'] != '')
                                            $saved_locations[] = strtolower($serving_location['state']);
                                        else
                                            $saved_locations[] = strtolower($serving_location['country']);
                                    }
                                    ?>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Serving Location : </label>
                                        <div class="col-sm-10">
                                            <select name="exact_location[]" class="form-control select" id="exact_location_id" multiple="multiple"  placeholder="Choose  Serving location(s)">
                                                <?php
                                                foreach ($regions as $region)
                                                    if(in_array(strtolower($region->region_name), $saved_locations))
                                                        echo "<option value='$region->region_name' selected='selected'>" . strtoupper($region->region_name) . "</option>";
                                                    else
                                                        echo "<option value='$region->region_name'>" . strtoupper($region->region_name) . "</option>";
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </section>
                    
                </div>
            </div>
        </div>
    </div>
    
    <?php 
    $gallery = ''; $load_charts =''; $editimageurl = Yii::$app->params['SITE_URL'] ."uploads/noimage.png";$editimagename = '';
    foreach($product_images as $index=>$image)
    {
        $image = (object)$image;

        if($image->image_type == 1)
        {
            $url_arr = explode ('/', $image->image_url);
            $ct = count($url_arr);
            $imgname = $url_arr[$ct-1];
            
            $gallery .= '<div class="imagealt"><a class="pull-left mb-xs mr-xs" href="'.$image->image_url.'">
                            <div class="img-responsive">
                                <img src="'.$image->image_url.'">
                            </div>
                        </a>
                        <div class="imagealtctrl">
                        <i href="#editproductimage" data-toggle="modal" data-target="#editproductimage" edit-img-name="'.$imgname.'" edit-img-url="'.$image->image_url.'" class="edit-img-url-cls"><i class="fa fa-pencil"></i></i>
                        <i onclick="deleteproductImage('.$image->product_image_id.')"><i class="fa fa-trash"></i></i>
                        <i download-img-url="'.$image->image_url.'" class="download-img-url-cls"><i class="fa fa-download"></i></i></div></div>';
        }
        else if($image->image_type == 2)
        {

            $load_charts .= '<div class="imagealt"><a class="pull-left mb-xs mr-xs" href="'.$image->image_url.'">
                                <div class="img-responsive">
                                    <img src="'.$image->image_url.'">
                                </div>
                            </a>
                            <div class="imagealtctrl">
                            <i href="#editproductimage" data-toggle="modal" data-target="#editproductimage" edit-img-name="'.$imgname.'" edit-img-url="'.$image->image_url.'" class="edit-img-url-cls"><i class="fa fa-pencil"></i></i>
                            <i onclick="deleteproductImage('.$image->product_image_id.')"><i class="fa fa-trash"></i></i>
                            <i download-img-url="'.$image->image_url.'" class="download-img-url-cls"><i class="fa fa-download"></i></i></div></div>';
        }


    }
    ?>

    <div class="col-md-12">
        <div class="tabs tabs-danger">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#recent4" data-toggle="tab" aria-expanded="false"><i class="fa fa-image"></i> Images</a>
                </li>
            </ul>
            <div class="tab-content">

                <div id="recent4" class="tab-pane active">
                        <section class="panel">

                            <h2 class="panel-title">Edit Images</h2>

                            <div class="panel-body">
                                <div class="popup-gallery">
                                    <?= $gallery ?>
                                </div>
                                
                                <!--<a href="#editproductimage" data-toggle="modal" data-target="#editproductimage"><i class="fa fa-pencil"></i></a>
                                <a href="#editproductimage" data-toggle="modal" data-target="#editproductimage"><i class="fa fa-trash"></i></a>-->
                            </div>

                        </section>
                        <div class="dropzone dz-square dz-clickable" id="productimages">
                            <div class="dz-default dz-message"><span>Drop files here to upload</span></div>
                        </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-12 dynamic load_chart">
        <div class="tabs tabs-danger">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#recent5" data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil"></i> Load Charts</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="recent5" class="tab-pane active">
                        <section class="panel">

                            <h2 class="panel-title">Edit Load Charts</h2>

                            <div class="panel-body">
                                <div class="loadchart-gallery">
                                    <?php if(@$load_charts)
                                             echo @$load_charts;
                                          else
                                              echo "No load charts are available";
                                        ?>
                                </div>
                            </div>

                        </section>
                        <div class="dropzone dz-square dz-clickable" id="productloadcharts">
                            <div class="dz-default dz-message"><span>Drop files here to upload</span></div>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-12">
        <footer class="panel-footer text-center">
            <button type="submit" class="btn btn-danger">Submit</button>
            <a href="<?= Yii::$app->params['SITE_URL'] ?>admin/products?product_type=<?= $productlist_type ?>" type="reset" class="btn btn-default">Cancel</a>
        </footer>
    </div>
</form>
    <div class="clearfix mb-xlg"></div>
</section>
<div class="modal fade wapop" id="editproductimage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Image Edit</h4>
			</div>
			<div class="modal-body">
                            
				<div align="center">
                                    <img class="showDefault img-responsive" src="<?php echo $editimageurl; ?>" id="cropbox" />
					Drag mouse to start cropping
					<!-- This is the form that our event handler fills -->
					<form method="post" id="formCrop" >
						<input type="hidden" value="<?php echo $editimagename; ?>" id="img" name="image" />
						<input type="hidden" value="<?php echo $editimageurl; ?>" id="imgUrl" name="imageurl" />
						<input type="hidden" value="<?php echo $editimageurl; ?>" id="editUrl" name="editurl" />
						<input type="hidden" value="" id="orderEdit" name="editorder" />
						<input type="hidden" id="x" name="x" />
						<input type="hidden" id="y" name="y" />
						<input type="hidden" id="w" name="w" />
						<input type="hidden" id="h" name="h" />
                                                <div class="row">
                                                <div class="form-inline">
                                                    <div class="form-group">
                                                    <input class="form-control" type="text" pattern="[0-9]{2,}" id="width" name="width" placeholder="width"/>
                                                    </div>
                                                    <div class="form-group">
                                                    <input class="form-control" type="text" pattern="[0-9]{2,}" id="height" name="height" placeholder="height" />
                                                    </div>
                                                    <input type="button" name="resize" id="resize" onclick="return resizeDetails();" value="Resize Image" class="btn btn-large btn-inverse" />
                                                </div>
                                                </div>
                                                <div class="row">
                                                <div class="form-inline">
                                                    <div class="form-group">
                                                    <input class="form-control" type="file" id="files" name="files" />
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="form-control" type="radio" name="position" value="topleft"> Top Left
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="form-control" type="radio" name="position" value="topright"> Top Right
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="form-control" type="radio" name="position" value="center"> Center
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="form-control" type="radio" name="position" value="bottomleft"> Bottom Left
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="form-control" type="radio" name="position" value="bottomleft"> Bottom Right
                                                    </div>
                                                    <input type="button" name="resize" id="watermark" onclick="return watermarkDetails();" value="Watermark Image" class="btn btn-large btn-inverse" />
                                                </div>
                                                </div>
                                                <div class="row">
                                                <div class="form-inline">
                                                    
                                                    <div class="form-group">
                                                    <input type="button" name="crop" id="crop" onclick="return checkCoords();" value="Crop Image" class="btn btn-large btn-inverse" />
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="button" name="saveimage" id="saveimage" onclick="return saveImagechanges();" value="Save Image" class="btn btn-large btn-inverse" />
                                                    </div>
                                                </div>
                                                </div>
                                                
					</form>
					<input type="reset" style="display:none;" name="resetImage" id="resetImage" onclick="return resetImage();" value="Reset Changes" class="btn btn-large btn-inverse" />
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function () {
    $('#editproduct').validate();
    $('#life_tax_details').select2({ placeholder: 'Life Tax Details ',width:null});
    $('#exact_location_id').select2({ placeholder: 'Select Serving Locations ',width:null});
    var category_id = "<?= $product_details['category_id']?>";
    $.ajax({
        url: "<?= Yii::$app->params['SITE_URL'] ?>getproductsubcategories",
        data : {category_id: category_id, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" },
        dataType: 'json',
        success: function(data){
            
            $(".dynamic").hide();
            $('#capacity').attr("placeholder","Capacity In "+data.metric+" *");
            $('#capacity_metric').val(data.metric);
            for(var i = 0; i < data.fields.length; i++) {
                $('.'+data.fields[i]).show();
            }
            
        }
    });
    
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
                      url: '<?= Yii::$app->params['SITE_URL'] ?>deleteproductimages',
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
    updatefields(<?= $product_details['category_id']?>);
});

// if model is custom
$('#model_id').on("change",function(){
    if($('#model_id option:selected').text()=="CUSTOM"){
        $(".model_other").show();
    }
    else {$(".model_other").hide();
    }
});

//onclick for image edit
$( ".edit-img-url-cls" ).click(function() {
    var imgurl = $(this).attr('edit-img-url');
    var imgname = $(this).attr('edit-img-name');
    $('#imgUrl').val(imgurl);
    $('#editUrl').val(imgurl);
    $('#cropbox').attr('src', imgurl);
    $('#croppedimg').attr('src', imgurl);
    $('.showDefault').attr('src', imgurl);
    $('.jcrop-holder div div img').attr('src', imgurl);
    $('#img').val(imgname);
    
    $('#cropbox').Jcrop({
        //aspectRatio: 1,
        onSelect: updateCoords,
        boxWidth: 800,
        boxHeight: 600
    });
});

//function to delete image
function deleteproductImage(product_image_id)
{
    if (window.confirm("Do you really want to delete?")) { 
        $.ajax({
            url: "<?= Yii::$app->params['SITE_URL'] ?>admin/deleteproductimage",
            data : {product_image_id: product_image_id, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" },
            dataType: 'html',
            type: "POST",
            success: function(response){
                window.location.reload(true);
            }
        });
    }
}
//function to delete image 
$( ".download-img-url-cls" ).click(function() {
    var imgurl = $(this).attr('download-img-url');
    var downloadimg = "<?= Yii::$app->params['SITE_URL'] ?>admin/downloadproductimage?image_url="+imgurl;
    window.open(downloadimg, '_blank'); 
});

function updatefields (category_id)
{
    var cur_category = category_id;
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
}

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
        }
    });
});   
$('#subcategory_id').change(function(){
    updatefields($("#category_id").val())
    
    $.ajax({
        url: "<?= Yii::$app->params['SITE_URL'] ?>getsubcategorymodels",
        data : {sub_category_id: $(this).val(), "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" },
        dataType: 'json',
        success: function(data){
            $('#model_id').html(data.out);
        }
    });
    
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
//reload page after model close
$('#editproductimage').on('hidden.bs.modal', function (e) {
    $('#cropbox').data('Jcrop').destroy();
});
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTOYrzyFnVI4_eo445CP07XCSNhcPwICk&libraries=places&callback=initAutocomplete" async defer></script>
<?php //$this->registerJsFile(Yii::$app->params['SITE_URL'].'admin_assets/javascripts/imageedit/image_altering.js', ['position' => \yii\web\View::POS_END]); ?> 