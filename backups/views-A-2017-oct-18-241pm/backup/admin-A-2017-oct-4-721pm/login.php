<!doctype html>
<html class="fixed">
    <head>

        <!-- Basic -->
        <meta charset="UTF-8">

        <meta name="keywords" content="HTML5 Admin Template" />
        <meta name="description" content="Porto Admin - Responsive HTML5 Template">
        <meta name="author" content="okler.net">

        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <!-- Web Fonts  -->

        <?= $this->registerCssFile("http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light"); ?>
        <link rel="stylesheet" href="<?= Yii::$app->params['SITE_URL'] ?>admin_assets/vendor/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="<?= Yii::$app->params['SITE_URL'] ?>admin_assets/vendor/font-awesome/css/font-awesome.css" />
        <link rel="stylesheet" href="<?= Yii::$app->params['SITE_URL'] ?>admin_assets/vendor/magnific-popup/magnific-popup.css" />
        <link rel="stylesheet" href="<?= Yii::$app->params['SITE_URL'] ?>admin_assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

        <!-- Theme CSS -->
        <link rel="stylesheet" href="<?= Yii::$app->params['SITE_URL'] ?>admin_assets/stylesheets/theme.css" />

        <!-- Skin CSS -->
        <link rel="stylesheet" href="<?= Yii::$app->params['SITE_URL'] ?>admin_assets/stylesheets/skins/default.css" />

        <!-- Theme Custom CSS -->
        <link rel="stylesheet" href="<?= Yii::$app->params['SITE_URL'] ?>admin_assets/stylesheets/theme-custom.css">

        <!-- Head Libs -->
        <script src="<?= Yii::$app->params['SITE_URL'] ?>admin_assets/vendor/modernizr/modernizr.js"></script>
    </head>
    <body>

        <!-- start: page -->
        <section class="body-sign">

            <div class="center-sign">
                <a href="/" class="logo pull-right">
                    <img src="<?= Yii::$app->params['SITE_URL'] ?>admin_assets/images/logo - signin.png" alt="Porto Admin" />
                </a>

                <div class="panel panel-sign">
                    <div class="panel-title-sign mt-xl text-center">
                        <h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> Sign In</h2>
                    </div>
                    <div class="panel-body">
                        <?php if (Yii::$app->session->hasFlash('success')): ?>
                            <div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <?= Yii::$app->session->getFlash('success') ?>
                            </div>
                        <?php endif; ?>
                        <?php if (Yii::$app->session->hasFlash('warning')): ?>
                            <div class="alert alert-warning alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <?= Yii::$app->session->getFlash('warning') ?>
                            </div>
                        <?php endif; ?>
                        <?php if (Yii::$app->session->hasFlash('error')): ?>
                            <div class="alert alert-danger alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <?= Yii::$app->session->getFlash('error') ?>
                            </div>
                        <?php endif; ?>
                        <form action="<?= Yii::$app->params['SITE_URL'] ?>admin/login" method="post">
                            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                            <div class="form-group mb-lg">
                                <label>Email</label>
                                <div class="input-group input-group-icon">
                                    <input name="email" type="email" class="form-control input-lg" />
                                    <span class="input-group-addon">
                                        <span class="icon icon-lg">
                                            <i class="fa fa-user"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group mb-lg">
                                <div class="clearfix">
                                    <label class="pull-left">Password</label>
                                    <a href="<?= Yii::$app->params['SITE_URL'] ?>admin/forgotpassword" class="pull-right">Lost Password?</a>
                                </div>
                                <div class="input-group input-group-icon">
                                    <input name="password" type="password" class="form-control input-lg" />
                                    <span class="input-group-addon">
                                        <span class="icon icon-lg">
                                            <i class="fa fa-lock"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-xl">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary hidden-xs">Sign In</button>
                                    <button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Sign In</button>
                                </div>
                            </div>




                        </form>
                    </div>
                </div>

                <p class="text-center text-muted mt-md mb-md">&copy; Copyright 2017. All Rights Reserved.</p>
            </div>
        </section>
        <script src="<?= Yii::$app->params['SITE_URL'] ?>admin_assets/vendor/jquery/jquery.js"></script>
        <script src="<?= Yii::$app->params['SITE_URL'] ?>admin_assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
        <script src="<?= Yii::$app->params['SITE_URL'] ?>admin_assets/vendor/bootstrap/js/bootstrap.js"></script>
        <script src="<?= Yii::$app->params['SITE_URL'] ?>admin_assets/vendor/nanoscroller/nanoscroller.js"></script>
        <script src="<?= Yii::$app->params['SITE_URL'] ?>admin_assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="<?= Yii::$app->params['SITE_URL'] ?>admin_assets/vendor/magnific-popup/magnific-popup.js"></script>
        <script src="<?= Yii::$app->params['SITE_URL'] ?>admin_assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

        <!-- Theme Base, Components and Settings -->
        <script src="<?= Yii::$app->params['SITE_URL'] ?>admin_assets/javascripts/theme.js"></script>

        <!-- Theme Custom -->
        <script src="<?= Yii::$app->params['SITE_URL'] ?>admin_assets/javascripts/theme.custom.js"></script>

        <!-- Theme Initialization Files -->
        <script src="<?= Yii::$app->params['SITE_URL'] ?>admin_assets/javascripts/theme.init.js"></script>
    </body>
</html>