<?php 
//get current logged in employee role details
$role_details = Yii::$app->session->get('role');
?>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Employees</h2>
        <div class="right-wrapper pull-right pr-xlg">
            <ol class="breadcrumbs">
                <li>
                    <a href="/admin">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Create Employee</span></li>
            </ol>
        </div>
    </header>
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

    <!-- start: page -->
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <a href="<?= Yii::$app->params['SITE_URL'] ?>admin/employees" class="mb-xs mt-xs mr-xs btn btn-primary btn-block">Back To Employees List</a>
        </div>
    </div>
    <form class="form-horizontal form-dtls" method="post" action="<?= Yii::$app->params['SITE_URL'] ?>admin/saveemployee" id="addemployee">
        <div class="col-md-12" >
            <div class="tabs tabs-danger">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#popular4" data-toggle="tab" aria-expanded="true"><i class="fa fa-align-left"></i> Employee</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="popular4" class="tab-pane active">

                        <section class="panel">

                            <h2 class="panel-title">Add Employee</h2>
                            <div class="panel-body">
                                <div class="col-md-4 col-md-offset-4">
                                    <div class="alert alert-warning phoneexists" style="display: none;">
                                        <center><strong>Phone Number already exists.</strong></center>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Employee Email : </label>
                                        <div class="col-sm-10">
                                            <input type="email" id="email" name="email" class="form-control" placeholder="Employee Email*" required="required"  />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Employee Name : </label>
                                            <div class="col-sm-8">
                                                <input type="text" id="user_name" name="user_name" class="form-control" placeholder="Employee Name*" required="required"  />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Employee Phone : </label>
                                            <div class="col-sm-8">
                                                <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Enter Mobile Number *" required="required" minlength="10" maxlength="10" onKeyUp="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Password : </label>
                                            <div class="col-sm-8">
                                                <input type="password" name="password" id="password" class="form-control" placeholder="Password should be minimum 8 characters *" required="required" minlength="8">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Confirm Password : </label>
                                            <div class="col-sm-8">
                                                <input type="password" name="regrepassword" id="regrepassword" class="form-control" placeholder="Re-enter Enter Password *" required="required" data-rule-equalTo="#password">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Company Name : </label>
                                            <div class="col-sm-8">
                                                <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Company name *" required="required">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Designation : </label>
                                            <div class="col-sm-8">
                                                <input type="text" name="designation" id="designation" class="form-control" placeholder="Designation">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Company Email : </label>
                                            <div class="col-sm-8">
                                                <input type="email" name="company_email" id="company_email" class="form-control" placeholder="Company Email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Company Address : </label>
                                            <div class="col-sm-8">
                                                <input type="text" name="address" id="address" class="form-control" placeholder="Company Address">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Employee Type : </label>
                                            <div class="col-sm-8">
                                                <select class="form-control" id="user_type" name="user_type" required="required">
                                                    <option value="">SELECT USER TYPE *</option>
                                                    <?php
                                                    foreach ($roles as $role)
                                                        if(($role_details['role_id'] == 2 || $role_details['role_id'] == 3) && $role['role_id'] != 1 && $role['role_id']>$role_details['role_id'])
                                                            echo "<option value='".$role['role_id']."'>" . strtoupper($role['role_name']) . "</option>";
                                                        else if ($role['role_id'] != 1 && $role['role_id']>$role_details['role_id'] && $role['role_id']!=8)
                                                            echo "<option value='".$role['role_id']."'>" . strtoupper($role['role_name']) . "</option>";
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 zone state district territory places multiplezone">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Zone : </label>
                                            <div class="col-sm-8">
                                                <select class="form-control col-sm-6 multiselect" multiple="multiple" id="zone_id" name="zone_id[]" required="required">
                                                    <?php
                                                    /*foreach ($zones as $zone)
                                                        if ($zone['zone_status'] == 1)
                                                            echo "<option value='".$zone['zone_id']."'>" . strtoupper($zone['zone_name']) . "</option>";
                                                    */?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 state district territory places multiplestate">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">State : </label>
                                            <div class="col-sm-8">
                                                <select class="form-control col-sm-6 multiselect" multiple="multiple" id="state_id" name="state_id[]" required="required">
                                                    
                                                </select>
                                                <!--<select class="form-control" id="state_id" name="state_id" required="required">
                                                    <option value="">SELECT STATE *</option>
                                                </select>-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 district territory places multipledistrict">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">District : </label>
                                            <div class="col-sm-8">
                                                <select class="form-control col-sm-6 multiselect" multiple="multiple" id="district_id" name="district_id[]" required="required">
                                                    
                                                </select>
                                                <!--<select class="form-control" id="district_id" name="district_id" required="required">
                                                    <option value="">SELECT DISTRICT *</option>
                                                </select>-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 territory places multipleterritory">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Territory : </label>
                                            <div class="col-sm-8">
                                                <select class="form-control col-sm-6 multiselect" multiple="multiple" id="territory_id" name="territory_id[]" required="required">
                                                    
                                                </select>
                                                <!--<select class="form-control" id="territory_id" name="territory_id" required="required">
                                                    <option value="">SELECT TERRITORY *</option>
                                                </select>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <footer class="panel-footer text-center">
                <button type="button" class="btn btn-danger" onclick="employeeValidate()">Submit</button>
                <a href="<?php echo Yii::$app->request->referrer;?>" type="reset" class="btn btn-default">Cancel</a>
            </footer>
        </div>
    </form>
    <div class="clearfix mb-xlg"></div>
</section>

<script>

$('.places').hide();
    
$(document).ready(function () {
    /*$.validator.addMethod("needsSelection", function (value, element) {
        alert('stes');
    });*/
    $('#state_id,#district_id,#territory_id').multiselect({
        selectAllValue: 'multiselect-all',
        enableCaseInsensitiveFiltering: true,
        enableFiltering: true,
        maxHeight: '300',
        buttonWidth: '310'
    });
    /*$.validator.addMethod("needsSelection", function (value, element) {
        var count = $(element).find('option:selected').length;
        return count > 0;
    });*/
}); 
/*$( "#addemployee" ).submit(function( event ) {
    var cur_mobile = $("#phone_number").val();
    $.ajax({
        url: "<?= Yii::$app->params['SITE_URL'] ?>checkphonenumberexist",
        type: "post",
        data: {"phone_number": cur_mobile, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" } ,
        dataType: 'html',
        success: function (response) {
            if(response)
            {
                $("#phone_number").addClass('error');
                $('.phoneexists').show();
                return false;
            }
            else
            {
                return true;
            }
        }
    });
});*/
$('#user_type').change(function(){
    var user_type = $(this).val();
    //if(user_type == 4 || user_type == 5 || user_type == 6 || user_type == 7)
        $(".places").hide();
    
    if(user_type == 4)
        $(".zone").show();
    else if(user_type == 5)
        $(".state").show();
    else if(user_type == 6)
        $(".district").show();
    else if(user_type == 7)
        $(".territory").show();
    
    
    //Get zones by user type
    $.ajax({
        url: "<?= Yii::$app->params['SITE_URL'] ?>admin/getzonesbyusertype",
        data : {user_type: user_type, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" },
        dataType: 'json',
        success: function(data){
            $('#zone_id').html(data.zones);
            $("#zone_id").multiselect('destroy');
            $('#zone_id').multiselect({
                selectAllValue: 'multiselect-all',
                enableCaseInsensitiveFiltering: true,
                enableFiltering: true,
                maxHeight: '300',
                buttonWidth: '310',
                onChange: function(element, checked) {
                    var brands = $('#zone_id option:selected');
                    var zones = [];
                    $(brands).each(function(index, brand){
                        zones.push([$(this).val()]);
                    });
                    $.ajax({
                        url: "<?= Yii::$app->params['SITE_URL'] ?>admin/getstatesbyzones",
                        data : {zone_id: zones.join(","),type: 'employee',user_type: user_type, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" },
                        dataType: 'json',
                        success: function(data){
                            //$("#state_id").multiselect('dataprovider', data.states);
                            $('#state_id').html(data.states);
                            $("#state_id").multiselect('destroy');
                            $('#state_id').multiselect({
                                selectAllValue: 'multiselect-all',
                                enableCaseInsensitiveFiltering: true,
                                enableFiltering: true,
                                maxHeight: '300',
                                buttonWidth: '310',
                                onChange: function(element, checked) {
                                    var brands = $('#state_id option:selected');
                                    var states = [];
                                    $(brands).each(function(index, brand){
                                        states.push([$(this).val()]);
                                    });
                                    $.ajax({
                                        url: "<?= Yii::$app->params['SITE_URL'] ?>admin/getdistrictsbystates",
                                        data : {state_id: states.join(","),type: 'employee',user_type: user_type, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" },
                                        dataType: 'json',
                                        success: function(data){
                                            $('#district_id').html(data.districts);
                                            $("#district_id").multiselect('destroy');
                                            $('#district_id').multiselect({
                                                selectAllValue: 'multiselect-all',
                                                enableCaseInsensitiveFiltering: true,
                                                enableFiltering: true,
                                                maxHeight: '300',
                                                buttonWidth: '310',
                                                onChange: function(element, checked) {
                                                    var brands = $('#district_id option:selected');
                                                    var districts = [];
                                                    $(brands).each(function(index, brand){
                                                        districts.push([$(this).val()]);
                                                    });
                                                    $.ajax({
                                                        url: "<?= Yii::$app->params['SITE_URL'] ?>admin/getterritoriesbydistricts",
                                                        data : {district_id: districts.join(","),type: 'employee',user_type: user_type, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" },
                                                        dataType: 'json',
                                                        success: function(data){
                                                            $('#territory_id').html(data.territories);
                                                            $("#territory_id").multiselect('destroy');
                                                            $("#territory_id").multiselect({
                                                                selectAllValue: 'multiselect-all',
                                                                enableCaseInsensitiveFiltering: true,
                                                                enableFiltering: true,
                                                                maxHeight: '300',
                                                                buttonWidth: '310',
                                                            });
                                                        }
                                                    });

                                                }
                                            });
                                        }
                                    });

                                }
                            });
                        }
                    });

                }
            });
        }
    });
    
});


// -------------- Email ID On CHANGE EVENT ---------------- //
$("#email").change(function(){ 
    var cur_email = $(this).val();
    $.ajax({
        url: "<?= Yii::$app->params['SITE_URL'] ?>checkemailexist",
        type: "post",
        data: {"email": cur_email, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" } ,
        dataType: 'json',
        success: function (response) {
            if(response)
            {
            window.location.href = '<?php echo Yii::$app->params['SITE_URL']; ?>admin/employees?email='+cur_email;
            }
        }
    });
});
// -------------- Mobiel Number On CHANGE EVENT ---------------- //
$("#phone_number").change(function(){ 
    var cur_mobile = $(this).val();
    $.ajax({
        url: "<?= Yii::$app->params['SITE_URL'] ?>checkphonenumberexist",
        type: "post",
        data: {"phone_number": cur_mobile, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" } ,
        dataType: 'html',
        success: function (response) {
            if(response)
            {
                $("#phone_number").addClass('error');
                $('.phoneexists').show();
            }
            else{
                $("#phone_number").removeClass('error');
                $('.phoneexists').hide();
            }
        }
    });
});
function employeeValidate(){
    var zone_count = $("#zone_id :selected").length;
    var state_count = $("#state_id :selected").length;
    var distirct_count = $("#district_id :selected").length;
    var territory_count = $("#territory_id :selected").length;
    if($('#addemployee').valid())
    {
        if(zone_count == 0 && $('.multiplezone').is(':visible'))
        {
            $('<label id="user_name-error" class="error" for="zone_id">Please select atleast One.</label>').insertAfter("#zone_id" );
            return false;
        }
        if(state_count == 0 && $('.multiplestate').is(':visible'))
        {
            $('<label id="user_name-error" class="error" for="zone_id">Please select atleast One.</label>').insertAfter("#state_id" );
            return false;
        }
        if(distirct_count == 0 && $('.multipledistrict').is(':visible'))
        {   
            $('<label id="user_name-error" class="error" for="zone_id">Please select atleast One.</label>').insertAfter("#district_id" );
            return false;
        }
        if(territory_count == 0 && $('.multipleterritory').is(':visible'))
        {
            $('<label id="user_name-error" class="error" for="zone_id">Please select atleast One.</label>').insertAfter("#territory_id" );
            return false;
        }
        $("#addemployee").submit();
        
    }
    else
    {
        if(zone_count == 0)
            $('<label id="user_name-error" class="error" for="zone_id">Please select atleast One.</label>').insertAfter("#zone_id" );
        if(state_count == 0)
            $('<label id="user_name-error" class="error" for="zone_id">Please select atleast One.</label>').insertAfter("#state_id" );
        if(distirct_count == 0)
            $('<label id="user_name-error" class="error" for="zone_id">Please select atleast One.</label>').insertAfter("#district_id" );
        if(territory_count == 0)
            $('<label id="user_name-error" class="error" for="zone_id">Please select atleast One.</label>').insertAfter("#territory_id" );
        if(zone_count == 0 || state_count == 0 || distirct_count == 0 || territory_count == 0)
            return false;
    }
}
/*
$(".multiselect").on("change", function () {
    alert();
});*/
/*$('#zone_id').change(function(){
    var zone_id = $(this).val();
    $.ajax({
        url: "<?= Yii::$app->params['SITE_URL'] ?>admin/getstatesbyzone",
        data : {zone_id: $(this).val(), "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" },
        dataType: 'json',
        success: function(data){
            $('#state_id').html(data.states);
        }
    });
});*/
    

/*$('#state_id').change(function(){
    var state_id = $(this).val();
    $.ajax({
        url: "<?= Yii::$app->params['SITE_URL'] ?>admin/getdistrictsbystates",
        data : {state_id: $(this).val(), "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" },
        dataType: 'json',
        success: function(data){
            $('#district_id').html(data.districts);
        }
    });
}); */


/*$('#district_id').change(function(){
    var district_id = $(this).val();
    $.ajax({
        url: "<?= Yii::$app->params['SITE_URL'] ?>admin/getterritoriesbydistrict",
        data : {district_id: $(this).val(), "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" },
        dataType: 'json',
        success: function(data){
            $('#territory_id').html(data.territories);
        }
    });
}); */
</script>