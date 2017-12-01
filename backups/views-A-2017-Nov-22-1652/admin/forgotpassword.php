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

                <div class="panel panel-sign loginformcls">
                    <div class="panel-title-sign mt-xl text-right">
                        <h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> Recover Password</h2>
                    </div>
                    <div class="panel-body">
                        <div class="alert alert-info">
                            <p class="m-none text-weight-semibold h6">Enter your e-mail below and we will send you reset instructions!</p>
                        </div>

                        <form id="forgotpasswordform" name="forgotpasswordform" method="post" action="">
                            <div class="form-group mb-none">
                                <div class="input-group">
                                    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                                    <input name="account" id="account" type="email" placeholder="E-mail" class="form-control input-lg" required="required" />
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary btn-lg" type="submit" onclick="return accountValidate()">Reset!</button>
                                    </span>
                                </div>
                            </div>

                            <p class="text-center mt-lg">Remembered? <a href="<?= Yii::$app->params['SITE_URL'] ?>admin/login">Sign In!</a>
                        </form>
                    </div>
                </div>
                <div class="panel panel-sign verifyotpcls" style="display: none;">
                    <div class="panel-title-sign mt-xl text-right">
                        <h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> Verify OTP</h2>
                    </div>
                    <div class="panel-body">
                        <div class="alert alert-info">
                            <p class="m-none text-weight-semibold h6">Check your mobile or email to find your OTP</p>
                        </div>

                        <form class="" role="form" id="verifyotpform" name="verifyotpform" method="post" action="">
                            <div class="form-group mb-none">
                                <div class="input-group">
                                    <input id="otp" name="otp" type="text" placeholder="Enter Your OTP" class="form-control input-lg" />
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary btn-lg" type="submit" onclick="return verifyOTP()">Verify!</button>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="panel panel-sign changepasswordcls" style="display: none;">
                    <div class="panel-title-sign mt-xl text-right">
                        <h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> Update Password</h2>
                    </div>
                    <div class="panel-body">
                        <div class="alert alert-info">
                            <p class="m-none text-weight-semibold h6">Enter your New password below!</p>
                        </div>

                        <form id="changepasswordform" name="changepasswordform" method="post" action="<?= Yii::$app->params['SITE_URL'] ?>admin/updatepassword">
                            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                            <input type="hidden" name="accountchange" id="accountchange" value="">
                            <div class="form-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Your New Password" required="required" minlength="8">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Confirm New Password" required="required" data-rule-equalTo="#password">
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <input type="submit" name="login-submit" class="form-control btn btn-login" value="Submit">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <p class="text-center text-muted mt-md mb-md">&copy; Copyright 2014. All Rights Reserved.</p>
            </div>
        </section>
        <script src="<?= Yii::$app->params['SITE_URL'] ?>admin_assets/vendor/jquery/jquery.js"></script>
        <script src="<?= Yii::$app->params['SITE_URL'] ?>js/jquery.validate.min.js"></script>
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
<script>
$("#changepasswordform").validate(); 
function accountValidate()
{
    if($("#account").val().length >0)
    {
        $("#passwordbutton").attr("disabled", true);
        $.ajax({
            type: "POST",
            url: "<?= Yii::$app->params['SITE_URL'] ?>admin/forgotpassword",
            data : $('#forgotpasswordform').serialize(),
            dataType: 'html',
            success: function(response){
                if(response)
                {
                    $(".loginformcls").hide();
                    $(".invalidauth").hide();
                    $(".verifyotpcls").show();
                }
                else if(response == '')
                {
                    $(".invalidauth").show();
                    $("#account").addClass('error');
                }
                $("#passwordbutton").attr("disabled", false);
            },
            error:function(error){
                $("#passwordbutton").attr("disabled", false);
            }
        });
    }
    else
    {
        $("#account").addClass('error');
    }
    return false;
}
function verifyOTP()
{
    var otp = $("#otp").val();
    var account = $("#account").val();
    if(otp.length>0)
    {
        $.ajax({
            type: "POST",
            url: "<?= Yii::$app->params['SITE_URL'] ?>admin/verifyotp",
            data : {"account": account,"otp": otp,"action": "forgotpassword", "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" } ,
            dataType: 'html',
            success: function(data){
                if(data)
                {
                    $("#accountchange").val(account);
                    $(".verifyotpcls").hide();
                    $(".changepasswordcls").show();
                    
                }
                else if(data == '')
                {
                     $( "#otp" ).addClass( "error" );
                }
            }
        });
    }
    else
    {
    $( "#otp" ).addClass( "error" );
    }
    return false;
}
</script>
    </body>
</html>