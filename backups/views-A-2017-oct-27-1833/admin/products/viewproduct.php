<?php 
$product_type = $product_details['product_type'];
if($product_type == 0)
    $product_type = 'Supply';
else if($product_type == 1)
    $product_type = 'Sale';
if($product_type == 2)
    $product_type = 'Supply/Sale';

$role_details = Yii::$app->session->get('role');
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
                <li><span><?= strtoupper($product_type) ?> Details</span></li>
            </ol>
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <?php 
            if($product_details['product_type'] == 0)
                $productlist_type = 'supply';
            else if($product_details['product_type'] == 1)
                $productlist_type = 'sale';
            else if($product_details['product_type'] == 2)
                $productlist_type = 'both';
            ?>
            <a href="<?= Yii::$app->params['SITE_URL'] ?>admin/products?product_type=<?= $productlist_type ?>" class="mb-xs mt-xs mr-xs btn btn-primary btn-block">Back To <?= strtoupper($product_type) ?> List</a>
            <!--<a href="<?php echo Yii::$app->request->referrer; ?>" class="mb-xs mt-xs mr-xs btn btn-primary btn-block">Back To <?= strtoupper($product_type) ?> List</a>-->
        </div>
    </div>
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
    <div class="col-md-12">
        <div class="tabs tabs-danger">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#popular4" data-toggle="tab" aria-expanded="true"><i class="fa fa-align-left"></i> Hire Details</a>
                </li>
                <li class="">
                    <a href="#recent4" data-toggle="tab" aria-expanded="false"><i class="fa fa-image"></i> Images</a>
                </li>
                <?php if($product_details['category_id'] == 1) { ?>
                <li class="">
                    <a href="#recent5" data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil"></i> Load Charts</a>
                </li>
                <?php } ?>
                <li class="">
                    <a href="#recent6" data-toggle="tab" aria-expanded="false"><i class="fa fa-user"></i> Owner Details</a>
                </li>
                <?php if(!empty($employee_details)) { ?>
                <li class="">
                    <a href="#recent7" data-toggle="tab" aria-expanded="false"><i class="fa fa-user"></i> Assigned to</a>
                </li>
                <?php } ?>
            </ul>
            <div class="tab-content">
                <div id="popular4" class="tab-pane active">
                    <form class="form-horizontal form-dtls">
                        <section class="panel">
                            <?php $common_value = "Not Available"; ?>
                            <h2 class="panel-title"><?= $product_details['equipment_title'] ?> Details</h2>

                            <div class="panel-body">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Product ID: </label>
                                        <div class="col-sm-7">
                                            <strong> <?= $product_details['manual_product_code'] ?></strong>
                                        </div>
                                    </div>
                                    <?php 
                                    
                                    $price_type = ''; $place_holder_price_type = '';
                                    if(@$product_details['price_type'] == 1)
                                    {
                                        @$price_type = "Daily"; 
                                        $place_holder_price_type ='Days';
                                    }
                                    else if(@$product_details['price_type'] == 2)
                                    {
                                        @$price_type = "Monthly"; 
                                        $place_holder_price_type ='Months';
                                    }
                                    if($product_details['product_type'] == 0)
                                    {
                                        if($product_details['hire_price'] == '-1') $hire_price = "PRICE ON REQUEST"; else $hire_price = $product_details['hire_price'];
                                    echo '<div class="form-group">
                                            <label class="col-sm-5 control-label">Hire Price: </label>
                                            <div class="col-sm-7">
                                                <strong><i class="fa fa-rupee"></i>'.$hire_price.'/'.$price_type.'</strong>
                                            </div>
                                        </div>';
                                    }
                                    else if($product_details['product_type'] == 1)
                                    {
                                        if($product_details['sale_price'] == '-1') $sale_price = "PRICE ON REQUEST"; else $sale_price = $product_details['sale_price'];
                                        echo '<div class="form-group">
                                                <label class="col-sm-5 control-label">Sale Price: </label>
                                                <div class="col-sm-7">
                                                    <strong><i class="fa fa-rupee"></i>'.$sale_price.'</strong>
                                                </div>
                                            </div>';
                                    }
                                    else if($product_details['product_type'] == 2)
                                    {
                                        if($product_details['hire_price'] == '-1') $hire_price = "PRICE ON REQUEST"; else $hire_price = $product_details['hire_price'];
                                        echo '<div class="form-group">
                                                <label class="col-sm-5 control-label">Hire Price: </label>
                                                <div class="col-sm-7">
                                                    <strong><i class="fa fa-rupee"></i>'.$hire_price.'/'.$price_type.'</strong>
                                                </div>
                                            </div>';
                                        if($product_details['sale_price'] == '-1') $sale_price = "PRICE ON REQUEST"; else $sale_price = $product_details['sale_price'];
                                        echo '<div class="form-group">
                                                <label class="col-sm-5 control-label">Sale Price: </label>
                                                <div class="col-sm-7">
                                                    <strong><i class="fa fa-rupee"></i>'.$sale_price.'</strong>
                                                </div>
                                            </div>';
                                    }
                                    ?>
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Capacity: </label>
                                        <div class="col-sm-7">
                                            <strong><?= $product_details['capacity'] ?></strong>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Category: </label>
                                        <div class="col-sm-7">
                                            <strong> <?= $product_details['category_name'] ?></strong>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Sub category: </label>
                                        <div class="col-sm-7">
                                            <strong><?= $product_details['sub_category_name'] ?></strong>
                                        </div>
                                    </div>
                                    <!--<div class="form-group">
                                        <label class="col-sm-5 control-label">Model: </label>
                                        <div class="col-sm-7">
                                            <strong><?= $product_details['model_name'] ?></strong>
                                        </div>
                                    </div>-->
                                    <?php
                                    if($product_details['model_name'] != 'Custom')
                                    {
                                        echo '<div class="form-group">
                                                <label class="col-sm-5 control-label">Model: </label>
                                                <div class="col-sm-7">
                                                    <strong>'.$product_details['model_name'].'</strong>
                                                </div>
                                            </div>';
                                    }
                                    else
                                    {
                                        echo '<div class="form-group">
                                                <label class="col-sm-5 control-label">Model: </label>
                                                <div class="col-sm-7">
                                                    <strong>'.$product_details['model_other'].'</strong>
                                                </div>
                                            </div>';
                                    }
                                    
                                    if($product_details['current_location'] != '')
                                    {
                                        $currentlocation =$product_details['current_location'];
                                        $pos = strrpos( $product_details['current_location'], ',');
                                        if ($pos > 0) { // try to find the second one
                                          $npath = substr($product_details['current_location'], 0, $pos);
                                          $npos = strrpos($npath, ',');
                                          if ($npos !== false) {
                                             $currentlocation = substr($product_details['current_location'], $npos+1);
                                          } 
                                          else {
                                              $currentlocation =$product_details['current_location'];

                                          }
                                        }
                                        echo '<div class="form-group">
                                                <label class="col-sm-5 control-label">Location: </label>
                                                <div class="col-sm-7">
                                                    <strong>'.@$currentlocation.'</strong>
                                                </div>
                                            </div>';
                                    }
                                    ?>
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Expires On: </label>
                                        <div class="col-sm-7">
                                            <strong><?php echo date('m-d-Y', strtotime($product_details['product_expires_on'])); ?></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <?php
                                    if($product_details['category_id']== '1')
                                    {
                                        if($product_details['fly_jib'])
                                            echo '<div class="form-group">
                                                <label class="col-sm-5 control-label">Fly jib: </label>
                                                <div class="col-sm-7">
                                                    <strong>'.$product_details['fly_jib'].'</strong>
                                                </div>
                                            </div>';
                                        else
                                            echo '<div class="form-group">
                                                <label class="col-sm-5 control-label">Fly jib: </label>
                                                <div class="col-sm-7">
                                                    <strong>'.$common_value.'</strong>
                                                </div>
                                            </div>';
                                        
                                        if($product_details['luffing_jib'])
                                            echo '<div class="form-group">
                                                <label class="col-sm-5 control-label">Luffing jib: </label>
                                                <div class="col-sm-7">
                                                    <strong>'.$product_details['luffing_jib'].'</strong>
                                                </div>
                                            </div>';
                                        else
                                            echo '<div class="form-group">
                                                <label class="col-sm-5 control-label">Luffing jib: </label>
                                                <div class="col-sm-7">
                                                    <strong>'.$common_value.'</strong>
                                                </div>
                                            </div>';
                                    }
                                    
                                    if($product_details['category_id'] == '1' || $product_details['category_id'] == '2')
                                    {
                                        if($product_details['registered_number'])
                                            echo '<div class="form-group">
                                                <label class="col-sm-5 control-label">Registered Number: </label>
                                                <div class="col-sm-7">
                                                    <strong>'.$product_details['registered_number'].'</strong>
                                                </div>
                                            </div>';
                                        else
                                            echo '<div class="form-group">
                                                <label class="col-sm-5 control-label">Registered Number: </label>
                                                <div class="col-sm-7">
                                                    <strong>'.$common_value.'</strong>
                                                </div>
                                            </div>';
                                    }
                                    
                                    if($life_tax_details)
                                        echo '<div class="form-group">
                                                <label class="col-sm-5 control-label">Life Tax Details: </label>
                                                <div class="col-sm-7">
                                                    <strong>'.$life_tax_details.'</strong>
                                                </div>
                                            </div>';
                                    else
                                        echo '<div class="form-group">
                                                <label class="col-sm-5 control-label">Life Tax Details: </label>
                                                <div class="col-sm-7">
                                                    <strong>'.$common_value.'</strong>
                                                </div>
                                            </div>';
                                    
                                    if($product_details['category_id'] == '3')
                                    {
                                        if($product_details['bucket_capacity'])
                                            echo '<div class="form-group">
                                                <label class="col-sm-5 control-label">Bucket Capacity: </label>
                                                <div class="col-sm-7">
                                                    <strong>'.$product_details['bucket_capacity'].' Cubic Metres</strong>
                                                </div>
                                            </div>';
                                        else
                                            echo '<div class="form-group">
                                                <label class="col-sm-5 control-label">Bucket Capacity: </label>
                                                <div class="col-sm-7">
                                                    <strong>'.$common_value.'</strong>
                                                </div>
                                            </div>';
                                    }
                                    
                                    if($product_details['manufacture_year'])
                                        echo '<div class="form-group">
                                            <label class="col-sm-5 control-label">Manufacture year: </label>
                                            <div class="col-sm-7">
                                                <strong>'.$product_details['manufacture_year'].'</strong>
                                            </div>
                                        </div>';
                                    else
                                        echo '<div class="form-group">
                                            <label class="col-sm-5 control-label">Manufacture year: </label>
                                            <div class="col-sm-7">
                                                <strong>'.$common_value.'</strong>
                                            </div>
                                        </div>';
                                    
                                    if($product_details['category_id'] == '1')
                                    {
                                        if($product_details['boom_length'])
                                            echo '<div class="form-group">
                                                <label class="col-sm-5 control-label">Boom Length: </label>
                                                <div class="col-sm-7">
                                                    <strong>'.$product_details['boom_length'].'</strong>
                                                </div>
                                            </div>';
                                        else
                                            echo '<div class="form-group">
                                                <label class="col-sm-5 control-label">Boom Length: </label>
                                                <div class="col-sm-7">
                                                    <strong>'.$common_value.'</strong>
                                                </div>
                                            </div>';
                                    }
                                    if($product_details['category_id'] == '5')
                                    {
                                        if($product_details['kelly_length'])
                                            echo '<div class="form-group">
                                                <label class="col-sm-5 control-label">Kelly Length: </label>
                                                <div class="col-sm-7">
                                                    <strong>'.$product_details['kelly_length'].'</strong>
                                                </div>
                                            </div>';
                                        else
                                            echo '<div class="form-group">
                                                <label class="col-sm-5 control-label">Kelly Length: </label>
                                                <div class="col-sm-7">
                                                    <strong>'.$common_value.'</strong>
                                                </div>
                                            </div>';
                                    }
                                    
                                    if($product_details['category_id'] == '3')
                                    {
                                        if($product_details['arm_length'])
                                            echo '<div class="form-group">
                                                <label class="col-sm-5 control-label">Arm Length: </label>
                                                <div class="col-sm-7">
                                                    <strong>'.$product_details['arm_length'].'</strong>
                                                </div>
                                            </div>';
                                        else
                                            echo '<div class="form-group">
                                                <label class="col-sm-5 control-label">Arm Length: </label>
                                                <div class="col-sm-7">
                                                    <strong>'.$common_value.'</strong>
                                                </div>
                                            </div>';
                                    }
                                    if($product_details['category_id'] == '2')
                                    {
                                        if($product_details['numberof_axles'])
                                            echo '<div class="form-group">
                                                <label class="col-sm-5 control-label">Number of axles: </label>
                                                <div class="col-sm-7">
                                                    <strong>'.$product_details['numberof_axles'].'</strong>
                                                </div>
                                            </div>';
                                        else
                                            echo '<div class="form-group">
                                                <label class="col-sm-5 control-label">Number of axles: </label>
                                                <div class="col-sm-7">
                                                    <strong>'.$common_value.'</strong>
                                                </div>
                                            </div>';
                                    }
                                    
                                    if($product_details['dimensions'])
                                        echo '<div class="form-group">
                                            <label class="col-sm-5 control-label">Dimensions: </label>
                                            <div class="col-sm-7">
                                                <strong>'.$product_details['dimensions'].'</strong>
                                            </div>
                                        </div>';
                                    else
                                        echo '<div class="form-group">
                                            <label class="col-sm-5 control-label">Dimensions: </label>
                                            <div class="col-sm-7">
                                                <strong>'.$common_value.'</strong>
                                            </div>
                                        </div>';
                                    
                                    ?>
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Description: </label>
                                        <div class="col-sm-7">
                                            <strong><?php echo $product_details['description']; ?></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </form>
                </div>
                <?php 
                $gallery = ''; $load_charts ='';
                foreach($product_images as $index=>$image)
                {
                    $image = (object)$image;
                    
                    if($image->image_type == 1)
                    {
                        $gallery .= '<a class="pull-left mb-xs mr-xs" href="'.$image->image_url.'">
                                        <div class="img-responsive">
                                            <img src="'.$image->image_url.'" width="105">
                                        </div>
                                    </a>';
                    }
                    else if($image->image_type == 2)
                    {

                        $load_charts .= '<a class="pull-left mb-xs mr-xs" href="'.$image->image_url.'">
                                        <div class="img-responsive">
                                            <img src="'.$image->image_url.'" width="105">
                                        </div>
                                    </a>';
                    }


                }
                ?>
                <div id="recent4" class="tab-pane">
                    <form id="form1" class="form-horizontal">
                        <section class="panel">
                            
                            <h2 class="panel-title">Images</h2>

                            <div class="panel-body">
                                <div class="popup-gallery">
                                    <?= $gallery ?>
                                    
                                </div>
                            </div>

                            <!--<footer class="panel-footer">
                                <button class="btn btn-primary">Submit </button>
                                <button type="reset" class="btn btn-default">Reset</button>
                            </footer>-->
                        </section>
                    </form>
                </div>
                <div id="recent5" class="tab-pane">

                    <form id="form1" class="form-horizontal">
                        <section class="panel">

                            <h2 class="panel-title">Load Charts</h2>

                            <div class="panel-body">
                                <div class="loadchart-gallery">
                                    <?php if(@$load_charts)
                                             echo @$load_charts;
                                          else
                                              echo "No load charts are available";
                                        ?>
                                    
                                </div>
                            </div>

                            <!--<footer class="panel-footer">
                                <button class="btn btn-primary">Submit </button>
                                <button type="reset" class="btn btn-default">Reset</button>
                            </footer>-->
                        </section>
                    </form>

                </div>
                <div id="recent6" class="tab-pane">
                    <form class="form-horizontal form-dtls">
                        <section class="panel">
                            <h2 class="panel-title"><?= $product_details['equipment_title'] ?> Owner Details</h2>

                            <div class="panel-body">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Name: </label>
                                        <div class="col-sm-7">
                                            <strong> <?= $owner_details['user_name'] ?></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Email: </label>
                                        <div class="col-sm-7">
                                            <strong> <?= $owner_details['email'] ?></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Phone: </label>
                                        <div class="col-sm-7">
                                            <strong> <?= $owner_details['phone_number'] ?></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Company Name: </label>
                                        <div class="col-sm-7">
                                            <strong> <?= $owner_details['company_name'] ?></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Company Address: </label>
                                        <div class="col-sm-7">
                                            <strong> <?= $owner_details['company_address'] ?></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Designation: </label>
                                        <div class="col-sm-7">
                                            <strong> <?= $owner_details['designation'] ?></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Company Email: </label>
                                        <div class="col-sm-7">
                                            <strong> <?= $owner_details['company_email'] ?></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </form>
                </div>
                <div id="recent7" class="tab-pane">
                    <form class="form-horizontal form-dtls">
                        <section class="panel">
                            <h2 class="panel-title">Employee Details</h2>

                            <div class="panel-body">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Name: </label>
                                        <div class="col-sm-7">
                                            <strong> <?= $employee_details['user_name'] ?></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Email: </label>
                                        <div class="col-sm-7">
                                            <strong> <?= $employee_details['email'] ?></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Phone: </label>
                                        <div class="col-sm-7">
                                            <strong> <?= $employee_details['phone_number'] ?></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Company Name: </label>
                                        <div class="col-sm-7">
                                            <strong> <?= $employee_details['company_name'] ?></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Company Address: </label>
                                        <div class="col-sm-7">
                                            <strong> <?= $employee_details['company_address'] ?></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Designation: </label>
                                        <div class="col-sm-7">
                                            <strong> <?= $employee_details['designation'] ?></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Company Email: </label>
                                        <div class="col-sm-7">
                                            <strong> <?= $employee_details['company_email'] ?></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-12">
        <footer class="panel-footer text-center">
            <?php 
            if(\app\models\User::checkAccess('product_edit')) {
                if($product_details['product_status']!=1){?>
                <button class="btn btn-success" onclick="productApprove(<?= $product_details['product_id'] ?>);">Approve </button>
                <?php } if($product_details['product_status']!=0){?>
                <button type="button" class="btn btn-warning" onclick="productHold(<?= $product_details['product_id'] ?>);">Hold</button>
                <?php } if($product_details['product_status']!=2){?>
                <button type="button" class="btn btn-danger" onclick="productReject(<?= $product_details['product_id'] ?>);">Reject</button>
            <?php } ?>
            <a href="<?= Yii::$app->params['SITE_URL'] ?>admin/editproduct/<?= $product_details['product_id'] ?>" class="btn btn-default">Edit</a>
            <?php 
                }
                if(($role_details['role_id'] == 2 || $role_details['role_id'] == 8)){
                if($product_details['employee_id'] == '' || $product_details['employee_id'] == '0'){?>
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#postad_modal">Assign</button>
                <?php } else{ ?>
                <button type="button" class="btn btn-info"  data-toggle="modal" data-target="#postad_modal">Reassign</button>
                <?php } ?>
                
            <?php } ?>
        </footer>
    </div>

    <div class="clearfix mb-xlg"></div>

    <div class="col-md-12">
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle=""></a>
                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss=""></a>
                </div>

                <h2 class="panel-title">Comments</h2>
            </header>
            <div class="panel-body">
                <?php if (!empty($comments)) { ?>
                    <div class="scrollable visible-slider has-scrollbar" data-plugin-scrollable="" style="height: 400px;">
                        <div class="scrollable-content" tabindex="0" style="right: -17px;">
                            <div class="chat">   
                                <div class="chat-history">
                                    <ul class="chat-ul">
                                        <?php
                                        foreach ($comments as $index => $comment) {
                                            if ($index % 2 == 0)
                                                echo '<li>
                                                    <div class="message-data">
                                                        <span class="message-data-name"><i class="fa fa-circle you"></i> ' . $comment['user_name'] . ' on ' . date('m-d-Y H:i:s', strtotime($comment['date_created'])) . '</span>
                                                    </div>
                                                    <div class="message you-message">' . $comment['comment_description'] . '</div>
                                                </li>';
                                            else
                                                echo '<li class="clearfix">
                                                    <div class="message-data align-right">
                                                        <span class="message-data-name"> ' . $comment['user_name'] . ' on ' . date('m-d-Y H:i:s', strtotime($comment['date_created'])) . '</span> <i class="fa fa-circle me"></i>
                                                    </div>
                                                    <div class="message me-message float-right">' . $comment['comment_description'] . '</div>
                                                </li>';
                                        }
                                        ?>

                                    </ul>


                                </div> <!-- end chat-history -->

                            </div>
                        </div>
                    </div>
                <?php
                }
                else {
                    echo "<center><strong>No Comments</strong></center>";
                }
                ?>
            </div>
            <footer class="panel-footer">
                <form method="post" action="<?= Yii::$app->params['SITE_URL'] ?>admin/addcomment" name="addcomment" id="addcomment">
                    <input type="hidden" name="comment_belongs_to" id="comment_belongs_to" value="<?php echo $product_details['product_id']; ?>">
                    <input type="hidden" name="comment_type" id="comment_type" value="4">
                    <textarea name="comment_description" id="comment_description" class="form-control mb-xl" placeholder="Enter your comments here.." required="required" minlength="5"></textarea>
                    <button class="btn btn-primary">Submit the comment </button>
                </form>
            </footer>
        </section>
    </div>

    <!-- end: page -->
    <div class="modal fade" id="postad_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">Assign product to employee</h5>

                </div>

                <div class="modal-body">

                    <form action="" method="post" id="assignproduct" class="form-horizontal">
                        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                        <input type="hidden" name="product_id" value="<?= $product_details['product_id'] ?>" id="product_id">

                        <div class="modal-post">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Zone : </label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="zone_id" name="zone_id">
                                        <option value="">SELECT ZONE</option> 
                                        <?php
                                        foreach ($zones as $zone)
                                            if ($zone['zone_status'] == 1)
                                                echo "<option value='" . $zone['zone_id'] . "'>" . strtoupper($zone['zone_name']) . "</option>";
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">State : </label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="state_id" name="state_id">
                                        <option value="">SELECT STATE</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">District : </label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="district_id" name="district_id">
                                        <option value="">SELECT DISTRICT</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Employee : </label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="employee_id" name="employee_id" required="required">
                                        <option value="">SELECT EMPLOYEE</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group"></div>
                        </div>

                        <div class="text-center"> </div>

                        <div class="modal-footer">

                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Close">

                            <input type="submit" name="adpost" value="Submit" onclick="validateProductassign()" class="btn btn-success">

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>
</section>
<script>
$(document).ready(function () {
    $("#addcomment").validate();
    $("#assignproduct").validate();
});
$('#zone_id').change(function(){
    var zone_id = $(this).val();
    $.ajax({
        url: "<?= Yii::$app->params['SITE_URL'] ?>admin/getstatesbyzones",
        data : {zone_id: zone_id, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" },
        dataType: 'json',
        success: function(data){
            $('#state_id').html(data.states);
        }
    });
});
$('#state_id').change(function(){
    var state_id = $(this).val();
    $.ajax({
        url: "<?= Yii::$app->params['SITE_URL'] ?>admin/getdistrictsbystates",
        data : {state_id: state_id, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" },
        dataType: 'json',
        success: function(data){
            $('#district_id').html(data.districts);
        }
    });
});
$('#district_id').change(function(){
    var district_id = $(this).val();
    $.ajax({
        url: "<?= Yii::$app->params['SITE_URL'] ?>admin/getemployeebydistrict",
        data : {district_id: district_id, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" },
        dataType: 'json',
        success: function(data){
            $('#employee_id').html(data.employees);
        }
    });
});
function productApprove(product_id)
{
    if (window.confirm("Do you really want to Approve?")) { 
        $.ajax({
            url: "<?= Yii::$app->params['SITE_URL'] ?>admin/approveproduct",
            type: "POST",
            data : {product_id: product_id, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" },
            dataType: 'json',
            success: function(data){
                if (data){
                    window.location.href = "<?= Yii::$app->params['SITE_URL'] ?>admin/viewproduct/"+product_id;
                }
            }
        });
    }
}
function productHold(product_id)
{
    if (window.confirm("Do you really want to Hold?")) { 
        $.ajax({
            url: "<?= Yii::$app->params['SITE_URL'] ?>admin/holdproduct",
            type: "POST",
            data : {product_id: product_id, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" },
            dataType: 'json',
            success: function(data){
                if (data){
                    window.location.href = "<?= Yii::$app->params['SITE_URL'] ?>admin/viewproduct/"+product_id;
                }
            }
        });
    }
}
function productReject(product_id)
{
    if (window.confirm("Do you really want to Reject?")) { 
        $.ajax({
            url: "<?= Yii::$app->params['SITE_URL'] ?>admin/rejectproduct",
            type: "POST",
            data : {product_id: product_id, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" },
            dataType: 'json',
            success: function(data){
                if (data){
                    window.location.href = "<?= Yii::$app->params['SITE_URL'] ?>admin/viewproduct/"+product_id;
                }
            }
        });
    }
}
function validateProductassign()
{
    if($("#assignproduct").valid())
    {
        $.ajax({
            url: "<?= Yii::$app->params['SITE_URL'] ?>admin/assignproduct",
            type: "POST",
            data : $('#assignproduct').serialize(),
            dataType: 'html',
            success: function(data){
//                /window.location.href = "<?php echo $_SERVER['REQUEST_URI'];?>";
            }
        });
    }
    else
        $("#assignproduct").validate().focusInvalid();
}


</script>