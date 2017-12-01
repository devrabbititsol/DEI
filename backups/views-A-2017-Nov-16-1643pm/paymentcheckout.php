<form method="POST" name="customerData" id="customerData" action="paymentcheckout">
    <center><h3>Payment Details</h3></center>
    <table width="50%" height="100" border="1" align="center">
        <tbody>
            <tr>
                <td>Name of Purchaser:</td><td><input type="name" name="name" readonly="" value="<?= @$params['billing_name'] ?>"></td>
            </tr>
            <tr>
                <td>Order Id	:</td><td><input type="text" name="order_id" readonly="" value="<?= @$params['order_id'] ?>"></td>
            </tr>
            <tr>
                <td>Amount	:</td><td><input type="text" name="amount" value="<?= @$params['amount'] ?>" max="<?= @$params['amount'] ?>" min="1000" required="required"> (Minimum 1000 INR)</td>
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
                <td></td><td><input class="btn btn-default" type="submit" value="CheckOut"><a class="btn btn-default" href="<?= Yii::$app->params['SITE_URL'] ?>">cancel</a></td>
            </tr>
        </tbody>
    </table>
</form>
<script>
$("#customerData").validate();
</script>