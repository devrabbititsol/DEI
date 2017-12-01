<div class="container">
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb beibc">
                <li><a href="<?= Yii::$app->params['SITE_URL'] ?>"><i class="fa fa-2x fa-home"></i></a></li>
                <li><a href="#"><h4>Franchise Partner</h4></a></li>
            </ul>
        </div>
    </div>
</div>
<div class="container magni" data-image="images/BEI_Franchise_Details.png" data-image-zoom="images/BEI_Franchise_Details.png" data-size="100">
<!--    <img src="images/BEI_Franchise_Details.png" class="img-responsive magni">-->
</div>
<?php $this->registerCssFile('css/jQuery.MagnifierRentgen.min.css', ['position' => \yii\web\View::POS_HEAD]); ?> 
<?php $this->registerJsFile('js/jQuery.MagnifierRentgen.min.js', ['position' => \yii\web\View::POS_END]); ?> 
<script>
$(document).ready(function(){
    $(".magni").magnifierRentgen();
});
    
</script>