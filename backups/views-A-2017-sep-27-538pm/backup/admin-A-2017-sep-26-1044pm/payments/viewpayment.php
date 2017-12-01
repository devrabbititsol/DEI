<section role="main" class="content-body">
    <header class="page-header">
        <h2>Payment Details</h2>
        <div class="right-wrapper pull-right pr-xlg">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= Yii::$app->params['SITE_URL'] . 'admin' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><a href="<?= Yii::$app->params['SITE_URL'] . 'admin/payments' ?>">
                        <i class="fa fa-inr"></i> Payments
                    </a>
                </li>
                <li><span>Payment Details</span></li>
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

                <h2 class="panel-title">Payment Details</h2>
            </header>
            <div class="panel-body">
                <div>
                    <h4 class="mb-xlg">Payment Details</h4>
                    <div class="col-md-12">

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Payment Order ID </label>
                            <label class="col-sm-1 control-label"> : </label>
                            <div class="col-sm-8">
                                <label><?php echo ucwords($payment['before_order_id']); ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Payment Date </label>
                            <label class="col-sm-1 control-label"> : </label>
                            <div class="col-sm-8">
                                <label><?php echo $payment['created_on']; ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Payment Status </label>
                            <label class="col-sm-1 control-label"> : </label>
                            <div class="col-sm-8">
                                <label><?php echo ucwords($payment['payment_status']); ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Actual Amount</label>
                            <label class="col-sm-1 control-label"> : </label>
                            <div class="col-sm-8">
                                <label><?php echo ucwords($payment['amount_actual']); ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Amount Paid</label>
                            <label class="col-sm-1 control-label"> : </label>
                            <div class="col-sm-8">
                                <label><?php echo ucwords($payment['amount_paid']); ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Billing Name </label>
                            <label class="col-sm-1 control-label"> : </label>
                            <div class="col-sm-8">
                                <label><?php echo ucwords($payment['billing_name']); ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Billing Mobile Number </label>
                            <label class="col-sm-1 control-label"> : </label>
                            <div class="col-sm-8">
                                <label><?php echo $payment['billing_phone']; ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Billing Email Address </label>
                            <label class="col-sm-1 control-label"> : </label>
                            <div class="col-sm-8">
                                <label><?php echo $payment['billing_email']; ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Billing Comments </label>
                            <label class="col-sm-1 control-label"> : </label>
                            <div class="col-sm-8">
                                <label><?php echo $payment['billing_comments']; ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Billing Date </label>
                            <label class="col-sm-1 control-label"> : </label>
                            <div class="col-sm-8">
                                <label><?php echo $payment['billing_time']; ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Order Status </label>
                            <label class="col-sm-1 control-label"> : </label>
                            <div class="col-sm-8">
                                <label><?php echo $payment['order_status']; ?></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
    <!-- end: page -->
</section>

