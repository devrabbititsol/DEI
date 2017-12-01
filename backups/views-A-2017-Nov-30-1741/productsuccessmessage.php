<!-- Google Code for Success Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 831481486;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "YsN5CPHH93UQjs29jAM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/831481486/?label=YsN5CPHH93UQjs29jAM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<div class="container pt-70">
    <div class="col-md-12">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="bs-callout bs-callout-danger" id="callout-inline-form-width"> 
                <?php if($transaction_data['order_status'] == 'Success') { ?>
                <center>
                    <h4>Thank you for Registering with Big Equipments India. Your Equipment ID is <a href="products?product_id=<?php echo @$productdata->product_id; ?>&product_type=<?php if(@$productdata->product_type==0) echo "hire"; else if(@$productdata->product_type==1) echo "sale"; else if(@$productdata->product_type==2) echo "both";?>" style="color: red;"><?= @$productdata->manual_product_code ?></a></h4> 
                <?php
                if (@$productdata->product_type == 0)
                    @$product_type = 'hire';
                else
                    @$product_type = 'sale';
                ?>
                <p><strong><a href="addproduct?product_type=<?= @$product_type ?>&category=<?= @$productdata->category_id ?>" style="color: red;">Click Here</a></strong> ADD ANOTHER EQUIPMENT.</p>
                <?php } else{ ?>
                <h4><?php echo "Your transaction is ".$transaction_data['order_status'].". Please contact us if you have any queries?"; ?></h4><br>
                <h4><?php echo $transaction_data['failure_message']; ?></h4>
                <?php } ?>
                </center>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
