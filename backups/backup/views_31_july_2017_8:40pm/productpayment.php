<div class="container">
    <div class="col-md-12">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="bs-callout bs-callout-danger" id="callout-inline-form-width"> 
                <h4>Your Product is added successfully</h4> 
                <p>Please refere you product id with <?= $productdata->manual_product_code ?></p>
                <?php
                if ($productdata->product_type == 0)
                    $product_type = 'hire';
                else
                    $product_type = 'sale';
                ?>
                <p>You have one more product, click <a href="addproduct?product_type=<?= $product_type ?>&category=<?= $productdata->category_id ?>">here</a> to add.</p>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>