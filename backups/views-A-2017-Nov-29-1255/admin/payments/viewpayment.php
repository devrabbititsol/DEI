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
        <div class="col-md-6 col-md-offset-3">
            <a href="<?= Yii::$app->params['SITE_URL'] . 'admin/payments' ?>" class="mb-xs mt-xs mr-xs btn btn-primary btn-block">Back To Payments List</a>
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
                            <label class="col-sm-3 control-label">Created On </label>
                            <label class="col-sm-1 control-label"> : </label>
                            <div class="col-sm-8">
                                <label><?php echo date("m-d-Y H:i:s", strtotime($payment['created_on'])); ?></label>
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
                                <label><?php echo date("m-d-Y", strtotime($payment['billing_time'])); ?></label>
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
                    <input type="hidden" name="comment_belongs_to" id="comment_belongs_to" value="<?php echo $payment['payment_id']; ?>">
                    <input type="hidden" name="comment_type" id="comment_type" value="3"><!-- comment type -->
                    <textarea name="comment_description" id="comment_description" class="form-control mb-xl" placeholder="Enter your comments here.." required="required" minlength="5"></textarea>
                    <button class="btn btn-primary">Submit the comment </button>
                </form>
            </footer>
        </section>
    </div>
</section>
<script>
$(document).ready(function () {
    $("#addcomment").validate();
});
</script>

