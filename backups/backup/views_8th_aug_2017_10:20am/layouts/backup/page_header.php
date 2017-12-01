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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo Yii::$app->params['SITE_URL']; ?>/images/favicon.png" type="image/x-icon" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?= $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<header>
    <div class="top-bar">
        <div class="container">
            <div class="row">
                <div class="con">
                    <ul class="text-center list-inline">
                        <li class="number"><a href="tel:9246611422"><i class="fa fa-phone"></i> <span>+91-9246611422</span> </a></li>
                        <li><a href="mailto:info@digitalequipmentsindia.com"><i class="fa fa-envelope-o"></i> <span>info@digitalequipmentsindia.com</span></a></li>
                    </ul> 
                    <ul class=" list-inline topbar-social">
                        <li><a href="https://www.facebook.com/bigequipmentsindia" class="fa fa-facebook" target="_blank"></a></li>
                        <li><a href="https://www.linkedin.com/in/bigeqp" class="fa fa-linkedin" target="_blank"></a></li>
                        <li><a href="https://plus.google.com/114187862914130579690" class="fa fa-google-plus" target="_blank"></a></li>
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
                            <a class="navbar-brand" href="<?php echo Yii::$app->homeUrl ;?>"><img src="<?php echo Yii::$app->params['SITE_URL'] . 'images/BEI_logo_header.png';?>" class="img-responsive" alt="">
                                <div class="clearfix"></div></a>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav menu">
                                <?php $current_page = $_SERVER['REQUEST_URI'];?>
                                <li <?php if($current_page == "/dei/web/index" || $current_page == "/dei/web/") echo "class='active'"; ?> ><a href="<?php echo Yii::$app->params['SITE_URL']; ?>"><span>Home</span></a></li>
                                <li <?php if($current_page == "/dei/web/aboutus") echo "class='active'"; ?>><a href="aboutus"><span>About Us</span></a></li>
                                <li <?php if($current_page == "/dei/web/howitworks") echo "class='active'"; ?>><a href="howitworks"><span>How It Works</span></a></li>
                                <li <?php if($current_page == "/dei/web/getquote") echo "class='active'"; ?>><a href="getquote"><span>Get Quote</span></a></li>
                                <li <?php if($current_page == "/dei/web/contact"){ echo "class='active'";} ?>><a href="contact"><span>Contact Us</span></a></li>

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
                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="<?php echo ucwords($display_name);?>"><?PHP if($display_name!='') echo ucwords($display_name).'<i class="fa fa-user-circle"></i> <span class="caret"></span>'; else echo 'Register/ Login' ?></a>
                                  <ul class="dropdown-menu">
                                        <li><a href="my-account.php#!/account/">My Account</a></li>
                                        <li><a href="my-account.php#!/products/">My Wallet</a></li>
                                        <li><a href="my-account.php#!/password/">Change Password</a></li>
                                        <li>
                                            <a href="javascript:{}" onclick="document.getElementById('logout').submit();">Logout</a>
                                        </li>
                                  </ul>
                                </li>
                                <li><a href="#"><i class="fa fa-search"></i></a></li>
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
                <li><a href="howitworks.php"> How it Works</a></li>
                <li><a href="http://receptumelogic.com/projects/bigcranes/chat/chat?locale=en"> Chat With Us</a></li>
                <li><a href="javascript:void(0)" onclick="jQuery('#contactable-inner').click();"> Feedback</a></li>
                <li><a href="contact.php"> Contact</a></li>
            </ul>
        </div>
		<div class="col-sm-3">
        		<h3>Information</h3>
            <ul>
                <li><a href="#"> Get Quote</a></li>
                <li><a href="#"> Terms of Use</a></li>
                <li><a href="#"> Packages</a></li>
                <li><a href="#"> Privacy Policy</a></li>
                <li><a href="#"> Franchise Partner</a></li>
                <li><a href="#"> Executive Admin</a></li>
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
                <li> Pune. 411001.  020- 40147581</li>
            </ul>
        </div>
        <div class="col-sm-3">
        		<div class="phone">+91- 9246611422</div>
                <div class="email"><a href="mailto:info@digitalequipmentsindia.com">info@digitalequipmentsindia.com</a></div>
                <ul class="footer-social list-inline">
                	<li><a href="https://www.facebook.com/bigequipmentsindia" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="https://www.linkedin.com/in/bigeqp"><i class="fa fa-linkedin" target="_blank"></i></a></li>
                    <li><a href="https://plus.google.com/114187862914130579690"><i class="fa fa-google-plus" target="_blank"></i></a></li>
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
                <li><a href="about.php"> About Us</a></li>
                <li><span>/</span></li>
                <li><a href="howitworks.php"> How it Works</a></li>
                 <li><span>/</span></li>
                <li><a href="get-quote.php"> Get Quote</a></li>
                 <li><span>/</span></li>
                <li><a href="contact.php"> Contact us</a></li>
            </ul></div>
		<div class="col-sm-6 text-right"> &copy; 2017 BigCranes India PVT. LTD. All Rights Reserved </div>        
    </div>
</div>

</div>

<?php $this->endBody() ?>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'bn,en,gu,hi,kn,ml,mr,ne,pa,ta,te,ur', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script>
</body>
</html>
<?php $this->endPage() ?>