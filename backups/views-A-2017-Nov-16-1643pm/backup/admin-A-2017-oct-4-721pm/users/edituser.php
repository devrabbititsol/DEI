<section role="main" class="content-body">
    <header class="page-header">
        <h2>Edit User Details</h2>
        <div class="right-wrapper pull-right pr-xlg">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= Yii::$app->params['SITE_URL'] . 'admin' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><a href="<?= Yii::$app->params['SITE_URL'] . 'admin/users' ?>">
                        <i class="fa fa-users"></i> Users
                    </a>
                </li>
                <li><span>Edit User</span></li>
            </ol>
        </div>
    </header>

    <!-- start: page -->

    <div class="col-md-6 col-md-offset-3">
        <a href="<?= Yii::$app->params['SITE_URL'] ?>admin/users" class="mb-xs mt-xs mr-xs btn btn-primary btn-block">Back To Users List</a>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12">

            <section class="panel">
                <div class="panel-body">
                    <div>
                        <h4 class="mb-xlg">Edit User Details</h4>
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
                                        <input type="hidden" class="form-control" id="userid" name="userid" placeholder="Name" required="required" value="<?php echo $userdetails['user_id']; ?>">
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
                                    <div class="col-sm-6">
                                        <a href="<?= Yii::$app->params['SITE_URL'] ?>admin/users" class="btn btn-danger" >Cancel</a>
                                    </div>
                                    <div class="col-sm-6">
                                        <button class="btn btn-success" onclick="return profileValidate();">Update</button>
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

function profileValidate() {
    if($("#profileform").valid())
    {
        $.ajax({
            type: "POST",
            url: "<?= Yii::$app->params['SITE_URL'] ?>admin/profileupdate",
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