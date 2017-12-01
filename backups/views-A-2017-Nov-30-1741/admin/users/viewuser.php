<section role="main" class="content-body">
    <header class="page-header">
        <h2>User Details</h2>
        <div class="right-wrapper pull-right pr-xlg">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= Yii::$app->params['SITE_URL'] . 'admin' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><a href="<?= Yii::$app->params['SITE_URL'] . 'admin/users' ?>">
                        <i class="fa fa-users"></i> Users
                    </a>
                </li>
                <li><span>User Details</span></li>
            </ol>
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <a href="<?= Yii::$app->params['SITE_URL'] ?>admin/users" class="mb-xs mt-xs mr-xs btn btn-primary btn-block">Back To Users List</a>
        </div>
    </div>

    <div class="row">

        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                </div>

                <h2 class="panel-title">User Details</h2>
            </header>
            <div class="panel-body">
                <div>
                    <h4 class="mb-xlg">User Details</h4>
                    <div class="col-md-8">

                        <div class="form-group">
                            <label class="col-sm-4 control-label">Name </label>
                            <label class="col-sm-2 control-label"> : </label>
                            <div class="col-sm-6">
                                <label><?php echo ucwords($user['user_name']); ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Mobile Number </label>
                            <label class="col-sm-2 control-label"> : </label>
                            <div class="col-sm-6">
                                <label><?php echo $user['phone_number']; ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Email Address </label>
                            <label class="col-sm-2 control-label"> : </label>
                            <div class="col-sm-6">
                                <label><?php echo $user['email']; ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Company Name </label>
                            <label class="col-sm-2 control-label"> : </label>
                            <div class="col-sm-6">
                                <label><?php echo ucwords($user['company_name']); ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Designation </label>
                            <label class="col-sm-2 control-label"> : </label>
                            <div class="col-sm-6">
                                <label><?php echo $user['designation']; ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Company Email </label>
                            <label class="col-sm-2 control-label"> : </label>
                            <div class="col-sm-6">
                                <label><?php echo $user['company_email']; ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Company Address </label>
                            <label class="col-sm-2 control-label"> : </label>
                            <div class="col-sm-6">
                                <label><?php echo $user['company_address']; ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">User Status </label>
                            <label class="col-sm-2 control-label"> : </label>
                            <div class="col-sm-6">
                                <label><?php
                                    if ($user['user_status'] == 1)
                                        echo '<span class="label label-warning">Pending Verification</span>';
                                    elseif ($user['user_status'] == 2)
                                        echo '<span class="label label-success">Active</span>';
                                    elseif ($user['user_status'] == 3)
                                        echo '<span class="label label-danger">Inactive</span>';
                                    ?></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="row">
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                </div>

                <h2 class="panel-title">All Products List</h2>
            </header>
            <div class="panel-body">
                <table class="table table-bordered table-striped mb-none" id="product-datatable">
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
                        <?php
                        foreach ($products as $product) {
                            echo '<tr class="gradeX">
                        <td>' . $product['manual_product_code'] . '</td>
                        <td>' . $product['category_name'] . '</td>';
                        /*<td>' . $product['sub_category_name'] . '</td>
                        <td>' . $product['model_name'] . '</td>*/
                        echo '<td>'.$product['employee_name'].'</td>
                        <td>'.date('m-d-Y H:i:s', strtotime($product['date_created'])).'</td>
                        <td>';

                        if($product['status_updated_by']) $status_updatedby = ' by '.$product['status_updated_by']; else $status_updatedby = '';
                         
                            if ($product['product_status'] == 0)
                                echo '<span class="label label-warning">Pending'.$status_updatedby.'</span>';
                            elseif ($product['product_status'] == 1)
                                echo '<span class="label label-success">Approved'.$status_updatedby.'</span>';
                            elseif ($product['product_status'] == 2)
                                echo '<span class="label label-danger">Rejected'.$status_updatedby.'</span>';
                            elseif ($product['product_status'] == 3)
                                echo '<span class="label label-default">Deleted</span>';
                        /*        echo '<span class="label label-warning">Approved by sales executive</span>';
                            elseif ($product['product_status'] == 4)
                                echo '<span class="label label-success">Approved by sales manger</span>';
                            elseif ($product['product_status'] == 5)
                                echo '<span class="label label-default">Rejected</span>';
                            elseif ($product['product_status'] == 6)
                                echo '<span class="label label-info">Re-Initialized</span>';
                            elseif ($product['product_status'] == 7)    */
                                //echo '<span class="label label-danger">Rejected</span>';

                            echo '<td class="actions text-center">
                            <a href="' . Yii::$app->params['SITE_URL'] . 'admin/editproduct/' . $product['product_id'] . '"><i class="fa fa-pencil"></i></a>
                            <a href="' . Yii::$app->params['SITE_URL'] . 'admin/viewproduct/' . $product['product_id'] . '"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
    <div class="row">
        
    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
            </div>

            <h2 class="panel-title">All Orders List</h2>
        </header>
        <div class="panel-body">
            <table class="table table-bordered table-striped mb-none" id="order-datatable">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Category</th>
                        <!--<th>Sub Category</th>
                        <th>Model</th>-->
                        <th>Assigned to</th>
                        <th>Created on</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($orders as $order) {
                    echo '<tr class="gradeX">
                        <td>'.$order['manual_order_code'].'</td>
                        <td>'.$order['category_name'].'</td>';
                        /*<td>'.$order['sub_category_name'].'</td>
                        <td>'.$order['model_name'].'</td>*/
                        echo '<td>'.$order['employee_name'].'</td>
                        <td>'.date('m-d-Y H:i:s', strtotime($order['date_created'])).'</td>
                        <td>';
                    
                    if($order['status_updated_by']) $status_updatedby = ' by '.$order['status_updated_by']; else $status_updatedby = '';    
                        
                    if($order['order_status'] == 0)
                        echo '<span class="label label-warning">Pending'.$status_updatedby.'</span>';
                    elseif($order['order_status'] == 1)
                        echo '<span class="label label-success">Approved'.$status_updatedby.'</span>';
                    elseif($order['order_status'] == 2)
                        echo '<span class="label label-danger">Rejected'.$status_updatedby.'</span>';
                    elseif($order['order_status'] == 3)
                        echo '<span class="label label-default">Deleted</span>';
                /*        echo '<span class="label label-warning">Approved by sales executive</span>';
                    elseif($order['order_status'] == 4)
                        echo '<span class="label label-success">Approved by sales manger</span>';
                    elseif($order['order_status'] == 5)
                        echo '<span class="label label-default">Rejected</span>';
                    elseif($order['order_status'] == 6)
                        echo '<span class="label label-info">Re-Initialized</span>';
                    elseif($order['order_status'] == 7)     */
                        //echo '<span class="label label-danger">Rejected</span>';
                    
                    echo '<td class="actions text-center">
                            <a href="'.Yii::$app->params['SITE_URL'].'admin/vieworder/'.$order['order_id'].'"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>';
                    } ?>
                </tbody>
            </table>
        </div>
    </section>
    </div>
    <div class="row">
        <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
            </div>

            <h2 class="panel-title">Total Payment's List</h2>
        </header>
        <div class="panel-body">
            <table class="table table-bordered table-striped mb-none" id="payment-datatable">
                <thead>
                    <tr>
                        <th>Payment Order Id</th>
                        <th>Actual Amount</th>
                        <th>Paid Amount</th>
                        <th>Payment Date</th>
                        <th>Payment Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($payments as $payment) {
                        echo '<tr class="gradeX">
                        <td>' . $payment['before_order_id'] . '</td>
                        <td>' . number_format($payment['amount_actual'],2) . '</td>
                        <td>' . number_format($payment['amount_paid'],2) . '</td>
                        <td>' . date("d-m-Y H:i:s", strtotime($payment['created_on'])) . '</td>
                        <td>' . ucwords($payment['payment_status']) . '</td>
                        </td><td class="actions text-center">
                            <a href="' . Yii::$app->params['SITE_URL'] . 'admin/viewpayment/' . $payment['payment_id'] . '"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
    </div>
    
    <div class="row">
        <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <!--a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a-->
            </div>

            <h2 class="panel-title">Total Ads List</h2>
        </header>
        <div class="panel-body">
            <table class="table table-bordered table-striped mb-none" id="ads-datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Ad Title</th>
<!--                        <th>Created By</th>-->
                        <th>Created On</th>
                        <th>Expiry On</th>
                        <th>Assigned to</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($ads as $ad) {
                        echo '<tr class="gradeX">
                        <td>' . $i++ . '</td>
                        <td>' . ucwords($ad['ad_title']) . '</td>';
//                        <td>' . ucwords($ad['ad_name']) . '</td>'
                        echo '<td>' . date('m-d-Y H:i:s', strtotime($ad['date_created'])) . '</td>
                        <td>' . date('m-d-Y H:i:s', strtotime($ad['ad_expire'])) . '</td>
                        <td>' . ucwords($ad['employee_name']) . '</td>
                        <td>';

                        if($ad['status_updated_by']) $status_updatedby = ' by '.$ad['status_updated_by']; else $status_updatedby = '';
                            
                        if ($ad['ad_status'] == 0)
                            echo '<span class="label label-warning">Pending'.$status_updatedby.'</span>';
                        elseif ($ad['ad_status'] == 1)
                            echo '<span class="label label-success">Approved'.$status_updatedby.'</span>';
                        elseif ($ad['ad_status'] == 2)
                            echo '<span class="label label-danger">Rejected'.$status_updatedby.'</span>';
                        elseif ($ad['ad_status'] == 3)
                            echo '<span class="label label-default">Deleted</span>';

                        echo '<td class="actions text-center">
                            <a href="' . Yii::$app->params['SITE_URL'] . 'admin/viewad/' . $ad['ad_id'] . '"><i class="fa fa-eye"></i></a>
                            <a href="' . Yii::$app->params['SITE_URL'] . 'admin/editad/' . $ad['ad_id'] . '"><i class="fa fa-pencil"></i></a>';
                        if ($ad['ad_status'] != 3) {
                            echo '<a onclick="adDelete('.$ad['ad_id'].')" class="delete-row"><i class="fa fa-trash-o"></i></a>';
                        }
                        echo '</td>
                    </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
    </div>
    
    <div class="row">
        <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
            </div>

            <h2 class="panel-title">Get Quote List</h2>
        </header>
        <div class="panel-body">
            <table class="table table-bordered table-striped mb-none" id="getquote_list">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Sub Category</th>
                        <th>Quote for</th>
                        <th>Assigned To</th>
                        <th>Created on</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($quotes as $quote) {
                    echo '<tr class="gradeX">
                        <td>'.$quote['category_name'].'</td>
                        <td>'.$quote['sub_category_name'].'</td>
                        <td>'.ucfirst($quote['quotation_type']).'</td>
                        <td>'.$quote['employee_name'].'</td>
                        <td>'.date('m-d-Y H:i:s', strtotime($quote['date_created'])).'</td>
                        <td>';
                    if($quote['status_updated_by']) $status_updatedby = ' by '.$quote['status_updated_by']; else $status_updatedby = '';
                    
                    if($quote['quote_status'] == 0)
                        echo '<span class="label label-warning">Pending'.$status_updatedby.'</span>';
                    elseif($quote['quote_status'] == 1)
                        echo '<span class="label label-success">Approved'.$status_updatedby.'</span>';
                    elseif($quote['quote_status'] == 2)
                        echo '<span class="label label-danger">Rejected'.$status_updatedby.'</span>';
                    elseif($quote['quote_status'] == 3)
                        echo '<span class="label label-default">Deleted</span>';
                    else
                        echo $quote['quote_status'];
                    /*elseif($product['product_status'] == 4)
                        echo '<span class="label label-success">Approved by sales manger</span>';
                    elseif($product['product_status'] == 5)
                        echo '<span class="label label-default">Rejected</span>';
                    elseif($product['product_status'] == 6)
                        echo '<span class="label label-info">Re-Initialized</span>';
                    elseif($product['product_status'] == 7)
                        echo '<span class="label label-info">Closed</span>';*/
                    
                    echo '<td class="actions text-center">
                            <a href="'.Yii::$app->params['SITE_URL'].'admin/viewquote/'.$quote['quotation_id'].'"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>';
                    } ?>
                </tbody>
            </table>
        </div>
    </section>
    </div>
    
    
    <!-- end: page -->
</section>
<script>
$(document).ready(function() {
    $('#product-datatable').DataTable({"aaSorting": [],"oLanguage": {"sLengthMenu": "\_MENU_"}});
    $('#order-datatable').DataTable({"aaSorting": [],"oLanguage": {"sLengthMenu": "\_MENU_"}});
    $('#payment-datatable').DataTable({"aaSorting": [],"oLanguage": {"sLengthMenu": "\_MENU_"}});
    $('#ads-datatable').DataTable({"aaSorting": [],"oLanguage": {"sLengthMenu": "\_MENU_"}});
    $('#getquote_list').DataTable({"aaSorting": [],"oLanguage": {"sLengthMenu": "\_MENU_"}});
} );
</script>
