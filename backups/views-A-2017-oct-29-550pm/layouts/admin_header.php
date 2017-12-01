<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AdminAsset;

AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html class="fixed">
    <head>

        <!-- Basic -->
        <meta charset="UTF-8">

        <title>Dashboard | BEI </title>
        <meta name="keywords" content="Dashboard | BEI " />
        <meta name="description" content="Dashboard | BEI ">
        <meta name="author" content="okler.net">
        <link rel="shortcut icon" href="<?php echo Yii::$app->params['SITE_URL']; ?>images/favicon.png" type="image/x-icon" />
        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="data-base-url" content="<?= Yii::$app->params['SITE_URL'] ?>" />
        <!-- Web Fonts  -->
        <?= $this->registerCssFile("http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light"); ?>
        <?= $this->head() ?>
        <script src="<?= Yii::$app->params['SITE_URL'] ?>admin_assets/vendor/jquery/jquery.js"></script>
        <script src="<?= Yii::$app->params['SITE_URL'] ?>admin_assets/vendor/bootstrap/js/bootstrap.js"></script>
        <script src="<?= Yii::$app->params['SITE_URL'] ?>admin_assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>

    </head>
    <body>
        <?php $this->beginBody() ?>
        <section class="body">

            <!-- start: header -->
            <header class="header">
                <div class="logo-container">
                    <a href="../" class="logo">
                        <img src="<?= Yii::$app->params['SITE_URL'] ?>admin_assets/images/logo.png" height="70" alt="Porto Admin" />
                    </a>
                    <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
                        <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                    </div>
                </div>

                <!-- start: search & user box -->
                <div class="header-right">


                    <span class="separator"></span>




                    <div id="userbox" class="userbox">
                        <a href="#" data-toggle="dropdown">
                            <figure class="profile-picture">
                                <img src="<?= Yii::$app->params['SITE_URL'] ?>admin_assets/images/!logged-user.jpg" alt="Joseph Doe" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg" />
                            </figure>
                            <div class="profile-info">
                                <span class="name"><?php echo Yii::$app->user->identity->user_name; ?></span>
                                <span class="role"><?php 
                                $role_details = Yii::$app->session->get('role');
                                echo ucfirst($role_details['role_name']); ?></span>
                            </div>

                            <i class="fa custom-caret"></i>
                        </a>

                        <div class="dropdown-menu">
                            <ul class="list-unstyled">
                                <li class="divider"></li>
                                <li>
                                    <a role="menuitem" tabindex="-1" href="<?= Yii::$app->params['SITE_URL'] ?>admin/myprofile"><i class="fa fa-user"></i> My Profile</a>
                                </li>
                                <li>
                                    <form method="post" action="<?= Yii::$app->params['SITE_URL'] ?>admin/logout" id="logout">
                                        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                                    </form>
                                    <a role="menuitem" tabindex="-1" href="javascript:{}" onclick="document.getElementById('logout').submit();"><i class="fa fa-power-off"></i> Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- end: search & user box -->
            </header>
            <!-- end: header -->

            <div class="inner-wrapper">
                <!-- start: sidebar -->
                <aside id="sidebar-left" class="sidebar-left">

                    <div class="sidebar-header">
                        <div class="sidebar-title">
                            Navigation
                        </div>
                        <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
                            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                        </div>
                    </div>

                    <div class="nano">
                        <div class="nano-content">
                            <nav id="menu" class="nav-main" role="navigation">
                                <ul class="nav nav-main">
                                    <li class="nav-active">
                                        <a href=<?= Yii::$app->params['SITE_URL'].'admin' ?>>
                                            <i class="fa fa-home" aria-hidden="true"></i>
                                            <span>Dashboard</span>
                                        </a>
                                    </li>
                                    <li <?php if(!\app\models\User::checkAccess('user_action')) echo "style='display:none;'"; ?>>
                                        <a href="<?= Yii::$app->params['SITE_URL'].'admin/users' ?>">
                                            <!--span class="pull-right label label-primary">14 New</span-->
                                            <i class="fa fa-users" aria-hidden="true"></i>
                                            <span>Users</span>
                                        </a>
                                    </li>
                                    <li <?php if(!\app\models\User::checkAccess('employee_action')) echo "style='display:none;'"; ?>>
                                        <a href="<?= Yii::$app->params['SITE_URL'].'admin/employees' ?>">
                                            <!--<span class="pull-right label label-primary">14 New</span>-->
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <span>Empoyees</span>
                                        </a>
                                    </li>
                                    <li class="nav-parent" <?php if(!\app\models\User::checkAccess('order_action')) echo "style='display:none;'"; ?>>
                                        <a>
                                            <!--<span class="pull-right label label-primary">28</span>-->
                                            <i class="fa fa-truck" aria-hidden="true"></i>
                                            <span>Orders</span>
                                        </a>
                                        <ul class="nav nav-children">
                                            <li>
                                                <a href="<?= Yii::$app->params['SITE_URL'].'admin/orders?order_type=hire' ?>">Hire</a>
                                                <a href="<?= Yii::$app->params['SITE_URL'].'admin/orders?order_type=buy' ?>">Buy</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-parent" <?php if(!\app\models\User::checkAccess('product_action')) echo "style='display:none;'"; ?>>
                                        <a>
                                            <!--<span class="pull-right label label-primary">28</span>-->
                                            <i class="fa fa-cubes" aria-hidden="true"></i>
                                            <span>Products</span>
                                        </a>
                                        <ul class="nav nav-children">
                                            <li>
                                                <a href="<?= Yii::$app->params['SITE_URL'].'admin/products?product_type=supply' ?>">Supply</a>
                                                <a href="<?= Yii::$app->params['SITE_URL'].'admin/products?product_type=sale' ?>">Sales</a>
                                                <a href="<?= Yii::$app->params['SITE_URL'].'admin/products?product_type=both' ?>">Supply/Sales</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li <?php if(!\app\models\User::checkAccess('advertisement_action')) echo "style='display:none;'"; ?>>
                                        <a href="<?= Yii::$app->params['SITE_URL'].'admin/ads' ?>">
                                            <i class="fa fa-buysellads" aria-hidden="true"></i>
                                            <span>Ads</span>
                                        </a>
                                    </li>
                                    <li <?php if(!\app\models\User::checkAccess('order_action')) echo "style='display:none;'"; ?>>
                                        <a href="<?= Yii::$app->params['SITE_URL'].'admin/getquote' ?>">
                                            <i class="fa fa-align-left" aria-hidden="true"></i>
                                            <span>Get Quote</span>
                                        </a>
                                    </li>
                                    <li <?php if(!\app\models\User::checkAccess('payment_action')) echo "style='display:none;'"; ?>>
                                        <a href="<?= Yii::$app->params['SITE_URL'].'admin/payments' ?>">
                                            <i class="fa fa-inr" aria-hidden="true"></i>
                                            <span>Payments</span>
                                        </a>
                                    </li>
                                    <li <?php if(!\app\models\User::checkAccess('corporate_action')) echo "style='display:none;'"; ?>>
                                        <a href="<?= Yii::$app->params['SITE_URL'].'admin/corporate' ?>">
                                            <i class="fa fa-industry" aria-hidden="true"></i>
                                            <span>Corporate</span>
                                        </a>
                                    </li>
                                    <li class="nav-parent" <?php if(!\app\models\User::checkAccess('setup_action') && $role_details['role_id'] != 6) echo "style='display:none;'"; ?>>
                                        <a>
                                            <i class="fa fa-cog" aria-hidden="true"></i>
                                            <span>Setup</span>
                                        </a>
                                        <ul class="nav nav-children">
                                            <li>
                                                <a href="<?= Yii::$app->params['SITE_URL'].'admin/zones' ?>" <?php if(!\app\models\User::checkAccess('setup_action')) echo "style='display:none;'"; ?>>Zones</a>
                                                <a href="<?= Yii::$app->params['SITE_URL'].'admin/states' ?>" <?php if(!\app\models\User::checkAccess('setup_action')) echo "style='display:none;'"; ?>>States</a>
                                                <a href="<?= Yii::$app->params['SITE_URL'].'admin/districts' ?>" <?php if(!\app\models\User::checkAccess('setup_action')) echo "style='display:none;'"; ?>>Districts</a>
                                                <a href="<?= Yii::$app->params['SITE_URL'].'admin/territories' ?>">Territories</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li <?php if(!\app\models\User::checkAccess('role_action')) echo "style='display:none;'"; ?>>
                                        <a href="<?= Yii::$app->params['SITE_URL'].'admin/role' ?>">
                                            <i class="fa fa-connectdevelop" aria-hidden="true"></i>
                                            <span>User Roles & Permissions</span>
                                        </a>
                                    </li>
                                    <li <?php if(!\app\models\User::checkAccess('role_action')) echo "style='display:none;'"; ?>>
                                        <a href="<?= Yii::$app->params['SITE_URL'].'admin/treeview' ?>">
                                            <i class="glyphicon glyphicon-random" aria-hidden="true"></i>
                                            <span>Tree View</span>
                                        </a>
                                    </li>

                                </ul>
                            </nav>				

                        </div>

                    </div>

                </aside>
                <!-- end: sidebar -->
                
                    
                <?= $content ?>
            </div>


        </section>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>