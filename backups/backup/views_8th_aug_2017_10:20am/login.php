<div class="container">
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb beibc">
                <li><a href="<?= Yii::$app->params['SITE_URL'] ?>"><i class="fa fa-2x fa-home"></i></a></li>
                <li><a href="login"><h4>Login</h4></a></li>
            </ul>
        </div>
    </div>
</div>
<div class="col-md-4 col-md-offset-4">
    <div class="alert alert-warning invalidauth" style="display: none;">
        <center><strong>Credentials doesn't match.</strong></center>
    </div>
</div>
<?php if(isset($_GET['email'])){ ?>
<div class="col-md-6 col-md-offset-4">
    <div class="alert alert-warning">
      <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
      This Email id already exists.
    </div>
</div>
<?php } ?>
<div class="container">
    <div class="row loginformcls">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <h3>LogIn</h3>

                    <hr>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <form class="" role="form" id="loginform" name="loginform" method="post" action="">
                                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                                <div class="form-group">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required="required" <?php
                                    if (isset($_GET['email'])) {
                                        echo "value='" . $_GET['email'] . "'";
                                    }
                                    ?>>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="required">
                                </div>
                                <div class="form-group">

                                    <input type="checkbox" name="rememberMe" id="rememberMe" class="">
                                    <label for="remember"> Remember Me</label>
                                    <p><a href="forgotpassword" class="text-dei underline">Forgot Password</a> <a href="registration" class="text-dei underline pull-right">Not Registered?</a></p>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="login-submit" class="form-control btn btn-login" value="Log In" onclick="return loginValidate()">
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row verifyotpcls" style="display: none;">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <h3>Verify OTP</h3>

                    <hr>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <form class="" role="form" id="loginform" name="loginform" method="post" action="">
                                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                                <div class="form-group">
                                    <input type="text" class="form-control" id="otp" name="otp" placeholder="Enter Your OTP" required="required">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="login-submit" class="form-control btn btn-login" value="Verify" onclick="return verifyOTP()">
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
</div>

<script>
$(document).ready(function(){
    $("#loginform").validate({
    debug: true,
    errorClass: 'error help-inline',
    validClass: 'success',
    errorElement: 'span',
    highlight: function(element, errorClass, validClass) {
      $(element).parents("div.form-group").addClass('has-error').removeClass(validClass);
    },
    unhighlight: function(element, errorClass, validClass) {
      $(element).parents(".error").removeClass('has-error').addClass(validClass);
    }
    });
});

function loginValidate()
{
    if($("#loginform").valid())
    {
        $.ajax({
            type: "POST",
            url: "login",
            data : $('#loginform').serialize(),
            dataType: 'html',
            success: function(response){
                if(response == 2)
                {
                    window.location.reload();
                }
                else if(response == 1)
                {
                    $(".loginformcls").hide();
                    $(".invalidauth").hide();
                    $(".verifyotpcls").show();
                }
                else
                {
                    $(".invalidauth").show();
                }
            }
        });
    }
    return false;
}
function verifyOTP()
{
    var otp = $("#otp").val();
    var email = $("#email").val();
    if(otp.length>0)
    {
        $.ajax({
            type: "POST",
            url: "verifyotp",
            data : {"email": email,"otp": otp, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" } ,
            dataType: 'html',
            success: function(data){
                if(data)
                {
                    $( "#otp" ).removeClass( "error" );
                    window.location.reload();
                }
                else
                {
                     $( "#otp" ).addClass( "error" );
                }
            }
        });
    }
    return false;
    
}
</script>

