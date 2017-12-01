<section role="main" class="content-body">
    <header class="page-header">
        <h2>Profile</h2>
        <div class="right-wrapper pull-right pr-xlg">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= Yii::$app->params['SITE_URL'] ?>admin">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>My Profile</span></li>
            </ol>
        </div>
    </header>

    <!-- start: page -->


    <div class="row">
        <div class="col-md-4 col-lg-3">

            <section class="panel">
                <div class="panel-body">
                    <div class="thumb-info mb-md">
                        <img src="<?= Yii::$app->params['SITE_URL'] ?>admin_assets/images/!logged-user.jpg" class="rounded img-responsive" alt="John Doe">
                        <div class="thumb-info-title">
                            <span class="thumb-info-inner"><?php echo $userdetails['user_name']; ?></span>
                            <span class="thumb-info-type"><?php echo $userdetails['designation']; ?></span>
                        </div>
                    </div>


                    <!--<h6 class="text-muted">About</h6>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam quis vulputate quam. Interdum et malesuada</p>
                    <div class="clearfix">
                        <a class="text-uppercase text-muted pull-right" href="#">(View All)</a>
                    </div>-->


                </div>
            </section>


        </div>
        <div class="col-md-8 col-lg-9">

            <section class="panel">
                <div class="panel-body">
                    <div>
                        <h4 class="mb-md">Change Password</h4>
                        <form method="post" action="" id="passwordform">
                            <div class="col-md-8">
                                <div class="col-md-row ">
                                    <div class="alert alert-warning invalidauth" style="display: none;">
                                        <center><strong></strong></center>
                                    </div>
                                    <div class="alert alert-success success1" style="display: none;">
                                        <center><strong></strong></center>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Old Password </label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder="Old Password" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">New Password </label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="New Password" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Re-enter New Password </label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" id="confirmnewpassword" name="confirmnewpassword" placeholder="Confirm New Password" required="required" data-rule-equalTo="#newpassword">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <button class="btn btn-bei" onclick="return passwordValidate();">Update</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                        <div class="clearfix mb-xlg"></div>

                        <h4 class="mb-xlg">Edit Profile</h4>
                        <form method="post" id="profileform">
                            <div class="col-md-8">
                                <div class="col-md-row ">
                                    <div class="alert alert-warning invalidauth" style="display: none;">
                                        <center><strong></strong></center>
                                    </div>
                                    <div class="alert alert-success profilesuccess" style="display: none;">
                                        <center><strong></strong></center>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Name: </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required="required" value="<?php echo $userdetails['user_name']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Mobile Number: </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="mobile" name="mobile" readonly placeholder="Mobile No" required="required" value="<?php echo $userdetails['phone_number']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Email Address: </label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" id="email" name="email" readonly placeholder="Email" required="required" value="<?php echo $userdetails['email']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Company Name: </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Company Name" required="required" value="<?php echo $userdetails['company_name']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Designation: </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="designation" name="designation" placeholder="Designation" value="<?php echo $userdetails['designation']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Company Email: </label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" id="company_email" name="company_email" placeholder="Company Email" value="<?php echo $userdetails['company_email']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Company Address: </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Company Address" value="<?php echo $userdetails['company_address']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-9">
                                        <button class="btn btn-bei" onclick="return profileValidate();">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>

    </div>

    <!-- end: page -->
</section>
<script>
function passwordValidate()
{
    if($("#passwordform").valid())
    {
        $.ajax({
            type: "POST",
            url: "<?= Yii::$app->params['SITE_URL'] ?>change-password",
            data : $('#passwordform').serialize(),
            dataType: 'html',
            success: function(response){
                if(response == "SUCCESS")
                {
                    $(".success1").show();
                    $(".success1").html('Password Changed Successfully...');
                    $( "#confirmnewpassword" ).removeClass( "error" );
                    setInterval(function(){ $(".success1").hide(); }, 3000);
                    $("#passwordform")[0].reset();
                }
                else if (response == "FAILED")
                {
                    $(".invalidauth").show();
                    $(".invalidauth").html('Old Password is not valid!');
                    setInterval(function(){ $(".invalidauth").hide(); }, 3000);
                }
                else if (response == "PASSWORDFAILED")
                {
                    $(".invalidauth").show();
                    $(".invalidauth").html('New Password can not be Old Password!');
                    setInterval(function(){ $(".invalidauth").hide(); }, 3000);
                }
            }
        });
    }
    else
        $("#passwordform").validate().focusInvalid();
    
    return false;
}
function profileValidate() {
    if($("#profileform").valid())
    {
        $.ajax({
            type: "POST",
            url: "<?= Yii::$app->params['SITE_URL'] ?>profileupdate",
            data : $('#profileform').serialize(),
            dataType: 'html',
            success: function(response){
                if (response == "SUCCESS"){
                    $(".profilesuccess").show();
                    $(".invalidauth").hide();
                    $(".profilesuccess").html('Profile Updated Successfully.');		
                    setInterval(function(){ $(".profilesuccess").hide(); }, 3000);
                }
                else if (response == "FAILED")
                {
                    $(".invalidauth").show();
                    $(".profilesuccess").hide();
                    $(".invalidauth").html('Profile is upto date!');
                    setInterval(function(){ $(".invalidauth").hide(); }, 3000);
                }
            }
        });

    }
    else
        $("#profileform").validate().focusInvalid();
    
    return false;
}
</script>
    