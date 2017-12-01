<div class="container">
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb beibc">
                <li><a href="<?= Yii::$app->params['SITE_URL'] ?>"><i class="fa fa-2x fa-home"></i></a></li>
                <li><a href="forgotpassword"><h4>Forgot password</h4></a></li>
            </ul>
        </div>
    </div>
</div>
<div class="col-md-4 col-md-offset-4">
    <div class="alert alert-warning invalidauth" style="display: none;">
        <!--<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>-->
        <center><strong>We failed to identify your account, Please register again.</strong></center>
    </div>
</div>
<div class="container">
    <div class="row loginformcls">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <h3>Forgot Password</h3>
                    <hr>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form class="" role="form" id="forgotpasswordform" name="forgotpasswordform" method="post" action="">
                                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                                <div class="form-group">
                                    <input type="text" class="form-control" id="account" name="account" placeholder="Enter Your mobile or email" required="required">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="login-submit" id="passwordbutton" class="form-control btn btn-danger" value="Submit" onclick="return accountValidate()">
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
                            <form class="" role="form" id="verifyotpform" name="verifyotpform" method="post" action="">
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
    <div class="row changepasswordcls" style="display: none;">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <h3>Verify OTP</h3>
                    <hr>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form class="" role="form" id="changepasswordform" name="changepasswordform" method="post" action="updatepassword">
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
                </div>
            </div>
        </div>
    </div>
</div>
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

//$this->title = 'Login';
//$this->params['breadcrumbs'][] = $this->title;
?>



<script>
$(document).ready(function(){
   $("#changepasswordform").validate(); 
});
function accountValidate()
{
    if($("#account").val().length >0)
    {
        $("#passwordbutton").attr("disabled", true);
        $.ajax({
            type: "POST",
            url: "forgotpassword",
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
            url: "verifyotp",
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

