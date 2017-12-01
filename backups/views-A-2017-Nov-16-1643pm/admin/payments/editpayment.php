<section role="main" class="content-body">
    <header class="page-header">
        <h2>Edit Payment Details</h2>
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
                <li><span>Edit Payment Details</span></li>
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
    <!-- start: page -->
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <a href="<?php echo Yii::$app->params['SITE_URL'].'admin/payments'; ?>"  class="mb-xs mt-xs mr-xs btn btn-primary btn-block">Back To Payments List</a>
        </div>
    </div>

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
                    <form class="" method="post" action="<?= Yii::$app->params['SITE_URL'] ?>admin/updatepayment" id="editpayment">
                        <input type="hidden" name="payment_id" id="payment_id" value="<?php echo $payment['payment_id']; ?>" >
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
                                <label><?php echo date("m-d-Y H:i:s", strtotime($payment['created_on'])); ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Payment Status </label>
                            <label class="col-sm-1 control-label"> : </label>
                            <div class="col-sm-2">
                                <select name="payment_status" id="payment_status" class="form-control" required="required">
                                    <option value="">-- payment status -- </option>
                                    <option value="Not Paid" <?php if($payment['payment_status'] == "Not Paid") echo "selected"; ?>> Not Paid </option>
                                    <option value="Partially Paid" <?php if($payment['payment_status'] == "Partially Paid") echo "selected"; ?>> Partially Paid </option>
                                    <option value="Paid" <?php if($payment['payment_status'] == "Paid") echo "selected"; ?>> Paid </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Actual Amount</label>
                            <label class="col-sm-1 control-label"> : </label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" name="amount_actual" value="<?=$payment['amount_actual']?>" id="amount_actual" placeholder="Actual Amount *" required="required" min="<?php echo $payment['amount_paid']; ?>" >
<!--                                <label><?php echo ucwords($payment['amount_actual']); ?></label>-->
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Amount Paid</label>
                            <label class="col-sm-1 control-label"> : </label>
                            <div class="col-sm-8">
<!--                                <input type="number" class="form-control" name="amount_paid" value="<?=$payment['amount_paid']?>" id="amount_paid" placeholder="Amount Paid *" required="required" min="<?=$payment['amount_paid']?>" >-->
                                <label><?php echo number_format($payment['amount_paid'],2); ?>
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
                            <div class="col-sm-2">
                                <input type="text" class="form-control datepicker" name="billing_time" value="<?php echo date("m/d/Y", strtotime($payment['billing_time'])); ?>" id="billing_time" placeholder="Billing Date *" required="required"  >
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
                    <footer class="col-md-offset-1">
                        <button type="submit" class="btn btn-danger">Submit</button>
                        <a href="<?php echo Yii::$app->params['SITE_URL'].'admin/payments'; ?>" class="btn btn-default">Cancel</a>
                    </footer>
                    </form>
                </div>
            </div>
        </section>
    </div>
    
    <!-- end: page -->
</section>

<script>
    $(document).ready(function () {
    $('.datepicker').datepicker();
    $('#editpayment').validate();
    });
</script>