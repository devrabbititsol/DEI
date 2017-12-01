<div class="container pt-70">
    <div class="col-md-12">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="bs-callout bs-callout-danger" id="callout-inline-form-width"> 
                <center>
                <h4>Thankyou for Registering with Digital Equipments India. Your Equipment ID is <?= @$productdata->manual_product_code ?></h4> 
                <?php
                if (@$productdata->product_type == 0)
                    @$product_type = 'hire';
                else
                    @$product_type = 'sale';
                ?>
                <p><strong><a href="addproduct?product_type=<?= @$product_type ?>&category=<?= @$productdata->category_id ?>" style="color: red;">Click Here</a></strong> ADD ANOTHER EQUIPMENT.</p>
                
                </center>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
