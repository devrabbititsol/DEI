<div class="container">
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb beibc">
                <li><a href="<?= Yii::$app->params['SITE_URL'] ?>"><i class="fa fa-2x fa-home"></i></a></li>
                <li><a href="#"><h4>Registration</h4></a></li>
            </ul>
        </div>
    </div>
</div>

<div class="container">
    <div class="wizard">
        <div class="wizard-inner">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                                Step <span>1</span>
                        </a>
                </li>

                <li role="presentation" class="disabled">
                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                                Step <span>2</span>
                        </a>
                </li>
            </ul>
        </div>

        <form role="form" method="post" action="" name="registrationform" id="registrationform">
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
            <div class="tab-content">
                <div class="tab-pane active" role="tabpanel" id="step1">
                    <div class="head-2 col-md-12">
                            <h2>Company Information <span>(* All fields required)</span></h2>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                          <input type="email" name="email" id="email" class="form-control" placeholder="Email Address *" required="required">
                            <span><strong>Note: </strong>This will be your user ID</span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                            <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Enter your user name *" required="required">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                            <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Enter Mobile Number *" required="required" minlength="10" maxlength="10" onKeyUp="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                          <input type="password" name="password" id="password" class="form-control" placeholder="Password *" required="required" minlength="8">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                            <input type="password" name="regrepassword" id="regrepassword" class="form-control" placeholder="Re-enter Enter Password *" required="required" data-rule-equalTo="#password">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                            <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Company name *" required="required">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                            <input type="text" name="designation" id="designation" class="form-control" placeholder="Designation">
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6">
                              <div class="form-group">
                                    <input type="email" name="company_email" id="company_email" class="form-control" placeholder="Company Email">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                    <input type="text" name="address" id="address" class="form-control" placeholder="Company Address">

                              </div>
                            </div>
                        </div>
                    </div>
                    <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-bei next-step" onclick="return registrationValidate();">Save and continue</button></li>
                    </ul>
                </div>
                <div class="tab-pane" role="tabpanel" id="step2">

                    <div class="head-2 col-md-6 col-md-offset-3">
                            <h2>Enter OTP <span>(* All fields required)</span></h2>
                    </div>
                    <div class="head-2 col-md-6 col-md-offset-3">
                        <label>Please check your Registered E-mail or Mobile Number </label>
                    </div>
                    <div class="col-md-6 col-md-offset-3">
                      <div class="form-group">
                          <input type="text" class="form-control" id="otp" name="otp" placeholder="Enter your OTP">

                      </div>
                        <a href="javascript:function() { return false; }" class="text-dei underline" onclick="resendOTP();">Re-send the OTP</a>
                    </div>
                    <div class="clearfix"></div>
                    <ul class="list-inline pull-right">
                        <li><button type="button" class="btn btn-bei next-step" onclick="verifyOTP();">Verify</button></li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
        </form>
	
    </div>
</div>

<script>
  jQuery(document).ready(function($) {
 
        //Handles the carousel thumbnails
        $('[id^=carousel-selector-]').click(function () {
        var id_selector = $(this).attr("id");
        try {
            var id = /-(\d+)$/.exec(id_selector)[1];
            console.log(id_selector, id);
            jQuery('#myCarousel').carousel(parseInt(id));
        } catch (e) {
            console.log('Regex failed!', e);
        }
    });
        // When the carousel slides, auto update the text
        $('#myCarousel').on('slid.bs.carousel', function (e) {
                 var id = $('.item.active').data('slide-number');
                $('#carousel-text').html($('#slide-content-'+id).html());
        });
});	
</script>

<script>
    

$(document).ready(function () {
    //Initialize tooltips
    $('.nav-tabs > li a[title]').tooltip();
    
    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        var $target = $(e.target);
    
        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    /*$(".next-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        $active.next().removeClass('disabled');
        nextTab($active);

    });*/
    $(".prev-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        prevTab($active);

    });
    
    // -------------- Email ID On CHANGE EVENT ---------------- //
    $("#email").change(function(){ 
        var cur_email = $(this).val();
        $.ajax({
            url: "checkemailexist",
            type: "post",
            data: {"email": cur_email, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" } ,
            dataType: 'json',
            success: function (response) {
                if(response)
                {
                window.location.href = '<?php echo Yii::$app->params['SITE_URL']; ?>login?email='+cur_email;
                }
            }
        });
    });
    
    // -------------- Mobiel Number On CHANGE EVENT ---------------- //
    $("#phone_number").change(function(){ 
        var cur_mobile = $(this).val();
        $.ajax({
            url: "checkphonenumberexist",
            type: "post",
            data: {"phone_number": cur_mobile, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" } ,
            dataType: 'json',
            success: function (response) {
                if(response)
                {
                    $("#phone_number").addClass('error');
                }
            }
        });
    });
    
    
});

function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}	

function registrationValidate() {
    if($("#registrationform").valid())
    {
        var cur_mobile = $("#phone_number").val();
        $.ajax({
            url: "checkphonenumberexist",
            type: "post",
            data: {"phone_number": cur_mobile, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" } ,
            dataType: 'html',
            success: function (response) {
                if(response)
                {
                    $("#phone_number").addClass('error');
                    return false;
                }
                else
                {
                    $.ajax({
                        type: "POST",
                        url: "newuserregistration",
                        data : $('#registrationform').serialize(),
                        dataType: 'json',
                        success: function(data){
                            var $active = $('.wizard .nav-tabs li.active');
                            $active.next().removeClass('disabled');
                            nextTab($active);
                        }
                    });
                }
            }
        });
    }
}
function verifyOTP()
{
    if($("#registrationform").valid())
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
                success: function(response){
                    if(response)
                    {
                        $( "#otp" ).removeClass( "error" );
                        window.location.href = '<?php echo Yii::$app->params['SITE_URL']; ?>';
                    }
                    else
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
    }
    
}
function resendOTP()
{
    var email = $("#email").val();
    var phone = $("#phone_number").val();
    $.ajax({
        type: "POST",
        url: "resendotp",
        data : {"email": email,"phone": phone, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" } ,
        dataType: 'json',
        success: function(response){
            
        }
    });
    
       
}
</script>
