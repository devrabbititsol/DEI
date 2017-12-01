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
                <li><span>Edit Payment Request</span></li>
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
    <!--<div class="row">
        <div class="col-md-6 col-md-offset-3">
            <a href="<?php echo Yii::$app->params['SITE_URL'].'admin/payments'; ?>"  class="mb-xs mt-xs mr-xs btn btn-primary btn-block">Back To Payments List</a>
        </div>
    </div>-->

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
                    <form class="" method="post" action="<?= Yii::$app->params['SITE_URL'] ?>admin/generatequotepaymentlink" id="generatepaymentlink">
                    <input type="hidden" name="payment_secure_link_id" id="payment_secure_link_id" value="<?php echo md5(strtotime(date("Y-m-d H:i:s"))); ?>" >
                    <input type="hidden" name="payment_type" id="payment_type" value="<?php echo $payment_type; ?>" >
                    <input type="hidden" name="payment_for" id="payment_for" value="<?php echo $payment_for; ?>" >
                    <input type="hidden" name="owner_name" id="owner_name" value="<?php echo $payment_details['user_name']; ?>" >
                    <input type="hidden" name="owner_email" id="owner_email" value="<?php echo $payment_details['user_email']; ?>" >
                    <input type="hidden" name="owner_phone" id="owner_phone" value="<?php echo $payment_details['user_phone']; ?>" >
                    <input type="hidden" name="package_type" id="package_type" value="<?php echo @$payment_details['package_type']; ?>" >
                    <div class="col-md-12">
                        <?php if($payment_details['amount_actual'] != 0) { ?>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Actual Amount</label>
                            <label class="col-sm-1 control-label"> : </label>
                            <div class="col-sm-8">
                                <label><?php echo number_format($payment_details['amount_actual']); ?></label>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Due Amount</label>
                            <label class="col-sm-1 control-label"> : </label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" name="due_amount" value="<?php if($payment_details['amount_actual'] != 0) { echo $payment_details['amount_actual']-$payment_details['amount_paid']; } ?>" id="due_amount" placeholder="Amount Due *" required="required" min="100" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Due Date </label>
                            <label class="col-sm-1 control-label"> : </label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control datepicker" name="due_date" value="<?php echo date("m/d/Y"); ?>" id="due_date" placeholder="Due Date *" required="required"  >
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Comments </label>
                            <label class="col-sm-1 control-label"> : </label>
                            <div class="col-sm-4">
                                <textarea class="form-control" name="due_comments" id="due_comments"></textarea>
                            </div>
                        </div>
                    </div>
                    <footer class="col-md-offset-1">
                        <button type="submit" class="btn btn-danger">Submit</button>
                            <a href="<?php echo Yii::$app->params['SITE_URL'].'admin/viewquote/'.$payment_for; ?>" class="btn btn-default">Cancel</a>
                        
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
    $('#generatepaymentlink').validate();
    });
</script>