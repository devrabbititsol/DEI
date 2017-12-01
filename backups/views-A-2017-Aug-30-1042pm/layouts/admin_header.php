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
<html class="fixed">
    <head>

        <!-- Basic -->
        <meta charset="UTF-8">

        <title>Dashboard | DEI </title>
        <meta name="keywords" content="Dashboard | DEI " />
        <meta name="description" content="Dashboard | DEI ">
        <meta name="author" content="okler.net">

        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <!-- Web Fonts  -->
        <?= $this->registerCssFile("http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light"); ?>
        <?= $this->head() ?>

    </head>
    <body>
        <?php $this->beginBody() ?>
        <section class="body">

            <!-- start: header -->
            <header class="header">
                <div class="logo-container">
                    <a href="../" class="logo">
                        <img src="admin_assets/images/logo.png" height="35" alt="Porto Admin" />
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
                                <img src="admin_assets/images/!logged-user.jpg" alt="Joseph Doe" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg" />
                            </figure>
                            <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
                                <span class="name">John Doe Junior</span>
                                <span class="role">administrator</span>
                            </div>

                            <i class="fa custom-caret"></i>
                        </a>

                        <div class="dropdown-menu">
                            <ul class="list-unstyled">
                                <li class="divider"></li>
                                <li>
                                    <a role="menuitem" tabindex="-1" href="user_dtls.html"><i class="fa fa-user"></i> My Profile</a>
                                </li>
                                <li>
                                    <a role="menuitem" tabindex="-1" href="pages-signin.html"><i class="fa fa-power-off"></i> Logout</a>
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
                                        <a href="index.html">
                                            <i class="fa fa-home" aria-hidden="true"></i>
                                            <span>Dashboard</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="users.html">
                                            <span class="pull-right label label-primary">14 New</span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <span>Users</span>
                                        </a>
                                    </li>
                                    <li class="nav-parent">
                                        <a>
                                            <span class="pull-right label label-primary">28</span>
                                            <i class="fa fa-truck" aria-hidden="true"></i>
                                            <span>Orders</span>
                                        </a>
                                        <ul class="nav nav-children">
                                            <li>
                                                <a href="hire.html">Hire</a>
                                                <a href="buy.html">Buy</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-parent">
                                        <a>
                                            <span class="pull-right label label-primary">28</span>
                                            <i class="fa fa-cubes" aria-hidden="true"></i>
                                            <span>Products</span>
                                        </a>
                                        <ul class="nav nav-children">
                                            <li>
                                                <a href="supply.html">Supply</a>
                                                <a href="sale.html">Sales</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="ads.html">
                                            <i class="fa fa-buysellads" aria-hidden="true"></i>
                                            <span>Ads</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="get_quote.html">
                                            <i class="fa fa-align-left" aria-hidden="true"></i>
                                            <span>Get Quote</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="payments.html">
                                            <i class="fa fa-align-left" aria-hidden="true"></i>
                                            <span>Payments</span>
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