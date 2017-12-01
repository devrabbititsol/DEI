<div class="container pt-70">
    <div class="col-md-12">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="bs-callout bs-callout-danger" id="callout-inline-form-width"> 
                <center>
                    <?php if($transaction_data['order_status'] == 'Success') { ?>
                    <h4>Your Payment transaction completed successfully.</h4>
                    <?php }else{ ?>
                    <h4><?php echo "Your transaction is ".$transaction_data['order_status'].". Please contact us if you have any queries?"; ?></h4><br>
                    <h4><?php echo $transaction_data['failure_message']; ?></h4>
                    <?php } ?>
                </center>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
