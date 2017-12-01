<form method="POST" name="customerData" id="customerData" action="paymentcheckout" class="col-md-6">
    <center><h3 class="col-md-6 col-md-offset-8">Payment Details</h3></center>
    <table class="table table-bordered table-responsive col-md-6 col-md-offset-6">
        <tbody>
            <tr>
                <td width="35%">Name of Purchaser:</td><td><input type="name" name="name" readonly="" value="<?= @$params['billing_name'] ?>"></td>
            </tr>
            <tr>
                <td>Order Id	:</td><td><input type="text" name="order_id" readonly="" value="<?= @$params['order_id'] ?>"></td>
            </tr>
            <tr>
                <td>Total Amount :</td><td><?php echo number_format($params['amount_actual']); ?></td>
            </tr>
            <tr>
                <td>Paid Amount	:</td><td><?php echo number_format($params['amount_paid']); ?></td>
            </tr>
            <tr>
                <td>Balance	:</td><td><input type="text" name="amount" value="<?php echo $params['amount_actual']-$params['amount_paid']; ?>" max="<?php echo $params['amount_actual']-$params['amount_paid'] ?>" min="1000" required="required"> (Minimum 1000 INR)</td>
            </tr>
            <tr>
                <td>Currency	:</td><td><input type="text" name="currency" value="INR" readonly=""></td> 
            </tr>
            <input type="hidden" name="redirect_url" value="<?= @$params['redirect_url'] ?>">
            <input type="hidden" name="cancel_url" value="<?= @$params['cancel_url'] ?>">
            <input type="hidden" name="tid" value="<?= @$params['tid'] ?>">
            <input type="hidden" name="billing_tel" value="<?= @$params['billing_tel'] ?>">
            <input type="hidden" name="billing_email" value="<?= @$params['billing_email'] ?>">
            <input type="hidden" name="delivery_name" value="<?= @$params['delivery_name'] ?>">
            <input type="hidden" name="delivery_tel" value="<?= @$params['delivery_tel'] ?>">
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
            <tr>
                <td></td><td>
                    <strong>*<?php echo Yii::$app->params['GST']; ?>% GST will be charged for this transaction.</strong><br/>
                    <input class="btn btn-default" type="submit" value="CheckOut"><a class="btn btn-default" href="<?php  echo 'my-account'; ?>">cancel</a></td>
            </tr>
        </tbody>
    </table>
</form>
<script>
$("#customerData").validate();
</script>