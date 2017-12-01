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
                <table class="table table-bordered table-striped mb-none" id="datatable-default">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Model</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($products as $product) {
                            echo '<tr class="gradeX">
                        <td>' . $product['manual_product_code'] . '</td>
                        <td>' . $product['category_name'] . '</td>
                        <td>' . $product['sub_category_name'] . '</td>
                        <td>' . $product['model_name'] . '</td>
                        <td>';

                            if ($product['product_status'] == 0)
                                echo '<span class="label label-warning">Pending</span>';
                            elseif ($product['product_status'] == 1)
                                echo '<span class="label label-success">Approved</span>';
                            elseif ($product['product_status'] == 2)
                        /*        echo '<span class="label label-warning">Approved by sales executive</span>';
                            elseif ($product['product_status'] == 4)
                                echo '<span class="label label-success">Approved by sales manger</span>';
                            elseif ($product['product_status'] == 5)
                                echo '<span class="label label-default">Rejected</span>';
                            elseif ($product['product_status'] == 6)
                                echo '<span class="label label-info">Re-Initialized</span>';
                            elseif ($product['product_status'] == 7)    */
                                echo '<span class="label label-danger">Rejected</span>';

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
                        <th>Sub Category</th>
                        <th>Model</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($orders as $order) {
                    echo '<tr class="gradeX">
                        <td>'.$order['manual_order_code'].'</td>
                        <td>'.$order['category_name'].'</td>
                        <td>'.$order['sub_category_name'].'</td>
                        <td>'.$order['model_name'].'</td>
                        <td>';
                    
                    if($order['order_status'] == 0)
                        echo '<span class="label label-warning">Pending</span>';
                    elseif($order['order_status'] == 1)
                        echo '<span class="label label-success">Approved</span>';
                    elseif($order['order_status'] == 2)
                /*        echo '<span class="label label-warning">Approved by sales executive</span>';
                    elseif($order['order_status'] == 4)
                        echo '<span class="label label-success">Approved by sales manger</span>';
                    elseif($order['order_status'] == 5)
                        echo '<span class="label label-default">Rejected</span>';
                    elseif($order['order_status'] == 6)
                        echo '<span class="label label-info">Re-Initialized</span>';
                    elseif($order['order_status'] == 7)     */
                        echo '<span class="label label-danger">Rejected</span>';
                    
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
    <!-- end: page -->
</section>
<script>
$(document).ready(function() {
    $('#order-datatable').DataTable();
} );
</script>
