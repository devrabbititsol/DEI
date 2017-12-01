<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link rel="shortcut icon" href="<?php echo Yii::$app->params['SITE_URL']; ?>images/favicon.png" type="image/x-icon" />
    <?= Html::csrfMetaTags() ?>
    <title>BEI::BIG EQUIPMENTS INDIA</title>
    <meta name="description" content="BIG EQUIPMENTS INDIA is a wholly owned brand of BIG CRANES INDIA Pvt. Ltd. which is based at Pune, Maharashtra."/>  
    <meta name="keywords" content="BIG EQUIPMENTS INDIA, Big cranes india, Cranes for hire, cranes for sale, buy cranes, sell cranes" />  
    
    <meta property="og:site_name" content="BIG EQUIPMENTS INDIA">
    <meta property="og:title" content="BIG EQUIPMENTS INDIA is a wholly owned brand of BIG CRANES INDIA Pvt. Ltd. which is based at Pune, Maharashtra." />
    <meta property="og:description" content="BIG EQUIPMENTS INDIA is a wholly owned brand of BIG CRANES INDIA Pvt. Ltd. which is based at Pune, Maharashtra.Big Cranes India Pvt Ltd is a digital India driven initiative aiming to bring all construction related equipment in India and from other parts of the world to a single platform in order to enhance efficiency of work force by reducing time,distance and effort to click of a bottom." />
    <meta property="og:image" content="<?php echo Yii::$app->params['SITE_URL']; ?>images/BEI_logo_header-thumb.png">
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo Yii::$app->params['SITE_URL']; ?>" />

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="<?php echo Yii::$app->params['SITE_URL']; ?>">
    <meta name="twitter:title" content="BIG EQUIPMENTS INDIA is a wholly owned brand of BIG CRANES INDIA Pvt. Ltd. which is based at Pune, Maharashtra.">
    <meta name="twitter:description" content="BIG EQUIPMENTS INDIA is a wholly owned brand of BIG CRANES INDIA Pvt. Ltd. which is based at Pune, Maharashtra.Big Cranes India Pvt Ltd is a digital India driven initiative aiming to bring all construction related equipment in India and from other parts of the world to a single platform in order to enhance efficiency of work force by reducing time,distance and effort to click of a bottom.">
    <meta name="twitter:image" content="<?php echo Yii::$app->params['SITE_URL']; ?>images/BEI_logo_header-thumb.png">
    
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="BIG EQUIPMENTS INDIA is a wholly owned brand of BIG CRANES INDIA Pvt. Ltd. which is based at Pune, Maharashtra.">
    <meta itemprop="description" content="BIG EQUIPMENTS INDIA is a wholly owned brand of BIG CRANES INDIA Pvt. Ltd. which is based at Pune, Maharashtra.Big Cranes India Pvt Ltd is a digital India driven initiative aiming to bring all construction related equipment in India and from other parts of the world to a single platform in order to enhance efficiency of work force by reducing time,distance and effort to click of a bottom.">
    <meta itemprop="image" content="<?php echo Yii::$app->params['SITE_URL']; ?>images/BEI_logo_header-thumb.png">
    
    <!-- facebook -->
    <meta property="fb:admins" content="<?php echo Yii::$app->params['FACEBOOK_PAGE_ID']; ?>" />
    
    <link rel="image_src" href="<?php echo Yii::$app->params['SITE_URL']; ?>images/BEI_logo_header-thumb.png" />
   
    <?= $this->head() ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-107840953-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'UA-107840953-1');
</script> 

    <!-- Facebook Pixel Code -->
   <script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '204360073438097');
  fbq('track', 'PageView');
  </script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=204360073438097&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
    <!-- Google Code for Remarketing Tag -->
    <!--------------------------------------------------
    Remarketing tags may not be associated with personally identifiable information or placed on pages related to sensitive categories. See more information and instructions on how to setup the tag on: http://google.com/ads/remarketingsetup
    --------------------------------------------------->
    <script type="text/javascript">
    /* <![CDATA[ */
    var google_conversion_id = 831481486;
    var google_custom_params = window.google_tag_params;
    var google_remarketing_only = true;
    /* ]]> */
    </script>
    <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
    </script>
    <noscript>
    <div style="display:inline;">
    <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/831481486/?guid=ON&amp;script=0"/>
    </div>
    </noscript>

</head>
<body>
<?php $this->beginBody() ?>
<header>
    <div class="top-bar">
        <div class="container">
            <div class="row">
                <div class="con">
                    <ul class="text-center list-inline">
                        <li class="number"><a href="tel:8956501234"><i class="fa fa-phone"></i> <span>+91 89565 01234</span> </a></li>
                        <!--<li><a href="mailto:info@digitalequipmentsindia.com"><i class="fa fa-envelope-o"></i> <span>info@digitalequipmentsindia.com</span></a></li>-->
                    </ul> 
                    <ul class=" list-inline topbar-social">
                       <li><a href="https://www.facebook.com/bigequipmentsindia" class="fa fa-facebook" target="_blank"></a></li>
                       <li><a href="https://www.linkedin.com/company/big-equipments-india" class="fa fa-linkedin" target="_blank"></a></li>
                       <li><a href="https://plus.google.com/114187862914130579690" class="fa fa-google-plus" target="_blank"></a></li>
                       <li><a href="https://www.youtube.com/channel/UCFfphS_aeW8bfvIz5TNieyA" target="_blank" class="fa fa-youtube"></a></li>
                       <li><a href="https://twitter.com/BigEquipments" target="_blank" class="fa fa-twitter"></a></li>
                       <li><a href="https://www.instagram.com/bigequipmentsindia/" target="_blank" class="fa fa-instagram"></a></li>
                    </ul>
                    <div class="dropdown language">
                        <a id="google_translate_element"></a> 
                    </div>                
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="container-fluid">	
        <div class="container">
            <div class="row">	
                <nav class="navbar navbar-default">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="col-md-4">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="<?php echo Yii::$app->homeUrl ;?>"><img src="<?php echo Yii::$app->params['SITE_URL'] . 'images/BEI_logo_header.png';?>" class="img-responsive" alt="" height="90px">
                                <div class="clearfix"></div></a>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav menu">
                                <?php $current_page = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>
                                <li <?php if($current_page == Yii::$app->params['SITE_URL']|| $current_page == Yii::$app->params['SITE_URL']."index") echo "class='active'"; ?> ><a href="<?php echo Yii::$app->params['SITE_URL']; ?>"><span>Home</span></a></li>
                                <li <?php if($current_page == Yii::$app->params['SITE_URL']."aboutus") echo "class='active'"; ?>><a href="aboutus"><span>About Us</span></a></li>
                                <li <?php if($current_page == Yii::$app->params['SITE_URL']."howitworks") echo "class='active'"; ?>><a href="howitworks"><span>How It Works</span></a></li>
                                <li <?php if($current_page == Yii::$app->params['SITE_URL']."getquote") echo "class='active'"; ?>><a href="getquote"><span>Get Quote</span></a></li>
                                <li <?php if($current_page == Yii::$app->params['SITE_URL']."contact"){ echo "class='active'";} ?>><a href="contact"><span>Contact Us</span></a></li>

                            </ul>
                            <?php if(Yii::$app->user->isGuest){ ?>
                            <ul class="nav navbar-nav navbar-right accountlist">
                                <li class="">
                                    <div style="padding-top: 13px;font-size: 14px;"><a href="registration">Register </a>|<a href="login"> Login</a></div>
                                </li>
                            </ul>
                            <?php } else { 
                                $display_name = strlen(trim(Yii::$app->user->identity->user_name)) > 12 ? substr(Yii::$app->user->identity->user_name,0,12).'...' : Yii::$app->user->identity->user_name;
                                ?>
                            <form method="post" action="logout" id="logout">
                                <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                            </form>
                            <ul class="nav navbar-nav navbar-right accountlist">
                                <li class="dropdown accountdrop">
                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="<?php echo ucwords($display_name);?>"><?PHP if($display_name!='') echo ucwords($display_name).' <i class="fa fa-user-circle"></i> <span class="caret"></span>'; else echo 'Register/ Login' ?></a>
                                  <ul class="dropdown-menu">
                                        <li><a href="<?= Yii::$app->params['SITE_URL'] ?>my-account">My Account</a></li>
                                        <!--<li><a href="#">My Wallet</a></li>
                                        <li><a href="#">Change Password</a></li>-->
                                        <li>
                                            <a href="javascript:{}" onclick="document.getElementById('logout').submit();">Logout</a>
                                        </li>
                                  </ul>
                                </li>
                                <!--<li><a href="#"><i class="fa fa-search"></i></a></li>-->
                            </ul>
                            <?php } ?>
                        </div><!-- /.navbar-collapse -->
                    </div>



                </nav>
            </div>
        </div>
    </div>
</header>

<?= $content ?>
    
<div class="gap clients"></div> 
<div class="gap clients"></div> 
<div>
	<img src="<?php echo Yii::$app->homeUrl . 'images/footer-shape.png';?>" class="img-responsive" alt="">
</div>
<div class="foote">
<footer>
<div class="container">
	<div class="row">
		<div class="col-sm-3">
        	<h3>Help</h3>
            <ul>
                <li><a href="<?= Yii::$app->params['SITE_URL'] ?>howitworks"> How it Works</a></li>
                <li><a href="<?= Yii::$app->params['SITE_URL'] ?>contact"> Chat With Us</a></li>
                <li><a href="<?= Yii::$app->params['SITE_URL'] ?>feedback"> Feedback</a></li>
                <li><a href="<?= Yii::$app->params['SITE_URL'] ?>contact"> Contact</a></li>
            </ul>
        </div>
		<div class="col-sm-3">
        		<h3>Information</h3>
            <ul>
                <li><a href="<?= Yii::$app->params['SITE_URL'] ?>getquote"> Get Quote</a></li>
                <li><a href="<?= Yii::$app->params['SITE_URL'] ?>terms-of-use"> Terms of Use</a></li>
                <li><a href="<?= Yii::$app->params['SITE_URL'] ?>packages"> Pricing</a></li>
                <li><a href="<?= Yii::$app->params['SITE_URL'] ?>privacy-policy"> Privacy Policy</a></li>
                <li><a href="<?= Yii::$app->params['SITE_URL'] ?>franchisepartner"> Franchise Partner</a></li>
                <!--<li><a href="#"> Executive Admin</a></li>-->
            </ul>
        </div>
        <div class="col-sm-3">
        		<h3>Contact Us</h3>
            <ul class="contactfooter">
                <li> Our headquarters</li>
                <li> <strong>Big Cranes India PVT. LTD.,</strong></li>
                <li> Regus Business Centre</li>
                <li> Level 2, Connaught Place</li>
                <li> Bund Garden Road,</li>
                <li> Pune. 411001.  <a href="tel:02040147581">020- 40147581</a></li>
                </ul>
            </div>
            <div class="col-sm-3">
                <div class="phone"><i class="fa fa-phone"></i> <a href="tel:8956501234" style="color:#fff;">+91 89565 01234</a></div>
                <div class="email"><!--<a href="mailto:info@digitalequipmentsindia.com">info@digitalequipmentsindia.com</a>--></div>
                <ul class="footer-social list-inline">
                 <li><a href="https://www.facebook.com/bigequipmentsindia" target="_blank"><i class="fa fa-facebook"></i></a></li>
                 <li><a href="https://www.linkedin.com/company/big-equipments-india/" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                 <li><a href="https://plus.google.com/114187862914130579690" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                 <li><a href="https://www.youtube.com/channel/UCFfphS_aeW8bfvIz5TNieyA" target="_blank"><i class="fa fa-youtube"></i></a></li>
                 <li><a href="https://twitter.com/BigEquipments" target="_blank"><i class="fa fa-twitter"></i></a></li>
                 <li><a href="https://www.instagram.com/bigequipmentsindia/" target="_blank"><i class="fa fa-instagram"></i></a></li>

                </ul>
          
        </div>
    </div>
</div>
</footer>
</div>
<div class="footer-bar">
<div class="container">
	<div class="row">
		<div class="col-sm-6">
            <ul class="list-inline">
                <li><a href="<?= Yii::$app->params['SITE_URL'] ?>aboutus"> About Us</a></li>
                <li><span>/</span></li>
                <li><a href="<?= Yii::$app->params['SITE_URL'] ?>howitworks"> How it Works</a></li>
                 <li><span>/</span></li>
                <li><a href="<?= Yii::$app->params['SITE_URL'] ?>getquote"> Get Quote</a></li>
                 <li><span>/</span></li>
                <li><a href="<?= Yii::$app->params['SITE_URL'] ?>contact"> Contact us</a></li>
            </ul></div>
		<div class="col-sm-6 text-right"> &copy; 2017 Big Cranes India PVT. LTD. All Rights Reserved </div>        
    </div>
</div>

</div>

<?php $this->endBody() ?>
<?php 
if(Yii::$app->controller->action->id != 'products' && Yii::$app->controller->action->id != 'login') {
?>
<script>
    $.cookie('selected_product_ids', '');
</script>
<?php } ?>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'bn,en,gu,hi,kn,ml,mr,ne,pa,ta,te,ur', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script>
</body>
</html>
<?php $this->endPage() ?>
