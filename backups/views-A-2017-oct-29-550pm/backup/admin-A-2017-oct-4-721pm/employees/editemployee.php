<?php 
//get current logged in employee role details
$role_details = Yii::$app->session->get('role');
?>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Edit Employee Details</h2>
        <div class="right-wrapper pull-right pr-xlg">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= Yii::$app->params['SITE_URL'] . 'admin' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><a href="<?= Yii::$app->params['SITE_URL'] . 'admin/employees' ?>">
                        <i class="fa fa-users"></i> Employees
                    </a>
                </li>
                <li><span>Edit Employee</span></li>
            </ol>
        </div>
    </header>

    <!-- start: page -->

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
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <a href="<?= Yii::$app->params['SITE_URL'] ?>admin/employees" class="mb-xs mt-xs mr-xs btn btn-primary btn-block">Back To Employees List</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12">

            <section class="panel">
                <div class="panel-body">
                    <div>
                        <h4 class="mb-xlg">Edit Employee Details</h4>
                        <form method="post" id="editemployee" action="<?= Yii::$app->params['SITE_URL'] ?>admin/updateemployee">
                            <div class="col-md-12">
                                <div class="col-md-row ">
                                    <div class="alert alert-warning invalidauth" style="display: none;">
                                        <center><strong></strong></center>
                                    </div>
                                    <div class="alert alert-success profilesuccess" style="display: none;">
                                        <center><strong></strong></center>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Employee Email : </label>
                                        <div class="col-sm-10">
                                            <input type="email" id="email" name="email" readonly="readonly" class="form-control" value="<?php echo $employeedetails['email']; ?>" placeholder="Employee Email*" required="required"  />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Employee Name : </label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Name" required="required" value="<?php echo $employeedetails['user_name']; ?>">
                                                <input type="hidden" class="form-control" id="user_id" name="user_id" placeholder="Name" required="required" value="<?php echo $employeedetails['user_id']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Employee Phone : </label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="phone_number" name="phone_number" readonly placeholder="Mobile No" required="required" value="<?php echo $employeedetails['phone_number']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Company Name : </label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Company Name" required="required" value="<?php echo $employeedetails['company_name']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Designation : </label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="designation" name="designation" placeholder="Designation" value="<?php echo $employeedetails['designation']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Company Email : </label>
                                            <div class="col-sm-8">
                                                <input type="email" class="form-control" id="company_email" name="company_email" placeholder="Company Email" value="<?php echo $employeedetails['company_email']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Company Address : </label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="address" name="address" placeholder="Company Address" value="<?php echo $employeedetails['company_address']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Employee Type : </label>
                                            <div class="col-sm-8">
                                                <select class="form-control" id="user_type" name="user_type" required="required" readonly >
                                                    <option value="">SELECT USER TYPE *</option>
                                                    <?php
                                                    foreach ($roles as $role)
                                                        if(($role_details['role_id'] == 2 || $role_details['role_id'] == 3)  && $role['role_id'] != 1 && $role['role_id']>$role_details['role_id'])
                                                            echo "<option value='".$role['role_id']."'".(($role['role_id']==$employeedetails['user_type'])?'selected="selected"':"").">" . strtoupper($role['role_name']) . "</option>";
                                                        else if ($role['role_id'] != 1 && $role['role_id']>$role_details['role_id'] && $role['role_id']!=8)
                                                            echo "<option value='".$role['role_id']."'".(($role['role_id']==$employeedetails['user_type'])?'selected="selected"':"").">" . strtoupper($role['role_name']) . "</option>";
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
                                                    $current_zones = explode(',',$employeedetails['zone_id']);
                                                    
                                                    foreach ($zones as $zone)
                                                        if ($zone['zone_status'] == 1)
                                                            echo "<option value='".$zone['zone_id']."'".((in_array($zone['zone_id'],$current_zones))?'selected="selected"':"").">" . strtoupper($zone['zone_name']) . "</option>";
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 state district territory places multiplestate">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">State : </label>
                                            <div class="col-sm-8">
                                                <select class="form-control col-sm-6 multiselect" multiple="multiple" id="state_id" name="state_id[]" required="required">
                                                    <?php
                                                    $current_states = explode(',',$employeedetails['state_id']);
                                                    
                                                    foreach ($states as $state)
                                                        if ($state['state_status'] == 1)
                                                            echo "<option value='".$state['state_id']."'".((in_array($state['state_id'],$current_states))?'selected="selected"':"").">" . strtoupper($state['state_name']) . "</option>";
                                                    ?>
                                                </select>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 district territory places multipledistrict">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">District : </label>
                                            <div class="col-sm-8">
                                                <select class="form-control col-sm-6 multiselect" multiple="multiple" id="district_id" name="district_id[]" required="required">
                                                    <?php
                                                    $current_districts = explode(',',$employeedetails['district_id']);
                                                    
                                                    foreach ($districts as $district)
                                                        if ($district['district_status'] == 1)
                                                            echo "<option value='".$district['district_id']."'".((in_array($district['district_id'],$current_districts))?'selected="selected"':"").">" . strtoupper($district['district_name']) . "</option>";
                                                    ?>
                                                </select>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 territory places multipleterritory">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Territory : </label>
                                            <div class="col-sm-8">
                                                <select class="form-control col-sm-6 multiselect" multiple="multiple" id="territory_id" name="territory_id[]" required="required">
                                                    <?php
                                                    $current_territories = explode(',',$employeedetails['territory_id']);
                                                    
                                                    foreach ($territories as $territory)
                                                        if ($territory['territory_status'] == 1)
                                                            echo "<option value='".$territory['territory_id']."'".((in_array($territory['territory_id'],$current_territories))?'selected="selected"':"").">" . strtoupper($territory['territory_name']) . "</option>";
                                                    ?>
                                                </select>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <a href="<?= Yii::$app->params['SITE_URL'] ?>admin/employees" class="btn btn-danger" >Cancel</a>
                                    </div>
                                    <div class="col-sm-6">
                                        <button class="btn btn-success" onclick="return employeeValidate();">Update</button>
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
$(document).ready(function() {
    $('#zone_id,#state_id,#district_id,#territory_id').multiselect({
        selectAllValue: 'multiselect-all',
        enableCaseInsensitiveFiltering: true,
        enableFiltering: true,
        maxHeight: '300',
        buttonWidth: '300'
    });
});
$(".places").hide();
$('#zone_id').change(function(element, checked) {
    var user_type = $('#user_type').val();
    var brands = $('#zone_id option:selected');
    var zones = [];
    $(brands).each(function(index, brand){
        zones.push([$(this).val()]);
    });
    //console.log(zones.join(","));
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
                buttonWidth: '300'
            })
        }
    })
});
$('#state_id').change(function(element, checked) {
    var user_type = $('#user_type').val();
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
                buttonWidth: '300'
            })
        }
    })
});
$('#district_id').change(function(element, checked) {
    var user_type = $('#user_type').val();
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
                buttonWidth: '300'
            })
        }
    })
});
<?php if($employeedetails['user_type'] == 4){ ?>
    $(".zone").show();
<?php } else if($employeedetails['user_type'] == 5){ ?>
    $(".state").show();
<?php } else if($employeedetails['user_type'] == 6){ ?>    
    $(".district").show();
<?php } else if($employeedetails['user_type'] == 7){ ?>   
    $(".territory").show();
<?php } ?>
    
$('#user_type').change(function(){
    var user_type = $(this).val();
    /*$(".places").hide();
    
    if(user_type == 4)
        $(".zone").show();
    else if(user_type == 5)
        $(".state").show();
    else if(user_type == 6)
        $(".district").show();
    else if(user_type == 7)
        $(".territory").show();*/
    
    
    //Get zones by user type
    /*$.ajax({
        url: "<?= Yii::$app->params['SITE_URL'] ?>admin/getzonesbyusertype",
        data : {user_type: user_type, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" },
        dataType: 'json',
        success: function(data){
            $('#zone_id').html(data.zones);
            $("#zone_id").multiselect('destroy');
        }
    });*/
    
});

function updateDropdowns()
{
    var user_type = $("#user_type").val();
    $('#zone_id').multiselect({
    selectAllValue: 'multiselect-all',
    enableCaseInsensitiveFiltering: true,
    enableFiltering: true,
    maxHeight: '300',
    buttonWidth: '300',
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
function employeeValidate(){
    var zone_count = $("#zone_id :selected").length;
    var state_count = $("#state_id :selected").length;
    var distirct_count = $("#district_id :selected").length;
    var territory_count = $("#territory_id :selected").length;
    if($('#editemployee').valid())
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
        $("#editemployee").submit();
        
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
</script>