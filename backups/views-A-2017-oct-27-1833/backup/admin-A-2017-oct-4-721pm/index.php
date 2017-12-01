<section role="main" class="content-body">
    <header class="page-header">
        <h2>Dashboard</h2>
    </header>
    <!-- start: page -->
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
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="row">
                <div class="col-md-12 col-lg-6 col-xl-6">
                    <section class="panel panel-featured-left panel-featured-primary">
                        <div class="panel-body">
                            <div class="widget-summary">
                                <div class="widget-summary-col widget-summary-col-icon">
                                    <div class="summary-icon bg-primary">
                                        <i class="fa fa-truck"></i>
                                    </div>
                                </div>
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">Orders</h4>
                                        <div class="info">
                                            <strong class="amount"><?= number_format($orderscount['pending_orders_count']).' / '. number_format($orderscount['total_orders_count'])?></strong>
                                            <!--<span class="text-primary">(14 unread)</span>-->
                                        </div>
                                    </div>
                                    <div class="summary-footer">
                                        <a href="<?= Yii::$app->params['SITE_URL'].'admin/orders' ?>" class="text-muted text-uppercase">view all</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-6">
                    <section class="panel panel-featured-left panel-featured-secondary">
                        <div class="panel-body">
                            <div class="widget-summary">
                                <div class="widget-summary-col widget-summary-col-icon">
                                    <div class="summary-icon bg-secondary">
                                        <i class="fa fa-cubes"></i>
                                    </div>
                                </div>
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">Products</h4>
                                        <div class="info">
                                            <strong class="amount"><?= number_format($productscount['pending_products_count']).' / '. number_format($productscount['total_products_count'])?></strong>
                                        </div>
                                    </div>
                                    <div class="summary-footer">
                                        <a href="<?= Yii::$app->params['SITE_URL'] ?>admin/products" class="text-muted text-uppercase">View All</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-6">
                    <section class="panel panel-featured-left panel-featured-tertiary">
                        <div class="panel-body">
                            <div class="widget-summary">
                                <div class="widget-summary-col widget-summary-col-icon">
                                    <div class="summary-icon bg-tertiary">
                                        <i class="fa fa-buysellads"></i>
                                    </div>
                                </div>
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">Ads</h4>
                                        <div class="info">
                                            <strong class="amount"><?= number_format($adscount['pending_ads_count']).' / '. number_format($adscount['total_ads_count'])?></strong>
                                        </div>
                                    </div>
                                    <div class="summary-footer">
                                        <a href="<?= Yii::$app->params['SITE_URL'].'admin/ads' ?>" class="text-muted text-uppercase">View All</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-6">
                    <section class="panel panel-featured-left panel-featured-quartenary">
                        <div class="panel-body">
                            <div class="widget-summary">
                                <div class="widget-summary-col widget-summary-col-icon">
                                    <div class="summary-icon bg-quartenary">
                                        <i class="fa fa-user"></i>
                                    </div>
                                </div>
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">Total Users</h4>
                                        <div class="info">
                                            <strong class="amount"><?= number_format($userscount['inactive_users_count']).' / '. number_format($userscount['total_users_count'])?></strong>
                                            <!--<span class="text-primary">(14 New users today)</span>-->
                                        </div>
                                    </div>
                                    <div class="summary-footer">
                                        <a href="<?= Yii::$app->params['SITE_URL'].'admin/users' ?>" class="text-muted text-uppercase">View All</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-6">
                    <section class="panel panel-featured-left panel-featured-info">
                        <div class="panel-body">
                            <div class="widget-summary">
                                <div class="widget-summary-col widget-summary-col-icon">
                                    <div class="summary-icon bg-info">
                                        <i class="fa fa-user"></i>
                                    </div>
                                </div>
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">Total Employees</h4>
                                        <div class="info">
                                            <strong class="amount"><?= number_format($employeescount['inactive_employee_count']).' / '. number_format($employeescount['total_employee_count'])?></strong>
                                            <!--<span class="text-primary">(14 New users today)</span>-->
                                        </div>
                                    </div>
                                    <div class="summary-footer">
                                        <a href="<?= Yii::$app->params['SITE_URL'].'admin/employees' ?>" class="text-muted text-uppercase">View All</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-6">
                    <section class="panel panel-featured-left panel-featured-warning">
                        <div class="panel-body">
                            <div class="widget-summary">
                                <div class="widget-summary-col widget-summary-col-icon">
                                    <div class="summary-icon bg-warning">
                                        <i class="fa fa-inr"></i>
                                    </div>
                                </div>
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">Total Amount</h4>
                                        <div class="info">
                                            <strong class="amount"><?= number_format($amounts['amount_paid']).' / '.number_format($amounts['amount_actual'])  ?></strong>
                                            <!--<span class="text-primary">(14 New users today)</span>-->
                                        </div>
                                    </div>
                                    <div class="summary-footer">
                                        <a href="<?= Yii::$app->params['SITE_URL'].'admin/payments' ?>" class="text-muted text-uppercase">View All</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <!--<div class="row">

        <div class="col-lg-12 col-md-12">
            <section class="panel">
                <header class="panel-heading panel-heading-transparent">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                        <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                    </div>

                    <h2 class="panel-title">Product Stats</h2>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-none">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Status</th>
                                    <th>Progress</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($products as $index=>$product){ ?>
                                <tr>
                                    <td><?= ++$index ?></td>
                                    <td><?= $product['equipment_title'] ?></td>
                                    <td>
                                        <?php 
                                        if($product['product_status'] == 1)
                                            echo '<span class="label label-danger">Pending / Waiting for approval</span>';
                                        elseif($product['product_status'] == 2)
                                            echo '<span class="label label-warning">Approved by data operator</span>';
                                        elseif($product['product_status'] == 3)
                                            echo '<span class="label label-warning">Approved by sales executive</span>';
                                        elseif($product['product_status'] == 4)
                                            echo '<span class="label label-success">Approved by sales manger</span>';
                                        elseif($product['product_status'] == 5)
                                            echo '<span class="label label-default">Rejected</span>';
                                        elseif($product['product_status'] == 6)
                                            echo '<span class="label label-info">Re-Initialized</span>';
                                        elseif($product['product_status'] == 7)
                                            echo '<span class="label label-info">Closed</span>';
                                        ?>
                                        
                                    </td>
                                    <td>
                                        <?php 
                                        $eachpercent = 100/7;
                                        $product_percent = number_format($eachpercent*$product['product_status']);
                                        ?>
                                        <div class="progress progress-sm progress-half-rounded m-none mt-xs light">
                                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="<?= $product_percent ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $product_percent ?>%;">
                                                <?= $product_percent ?>%
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>-->
    <!-- end: page -->
</section>