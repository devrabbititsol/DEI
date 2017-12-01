<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb beibc">
				<li><a href="<?= Yii::$app->params['SITE_URL'] ?>"><i class="fa fa-2x fa-home"></i></a></li>
				<li><a href="#"><h4>Feedback</h4></a></li>
			</ul>
		</div>
	</div>
</div>

<div class="container">
	<div class="row flex mt-10">
		<div class="col-md-12">
			<div class="main_inner_head">
				<h3> Feedback</h3>
			</div>
		</div>	
		
	</div>
</div>
<div class="col-md-4 col-md-offset-4">
    <div class="alert alert-warning invalidauth" style="display: none;">
        <center><strong></strong></center>
	</div>
</div>
<div class="col-md-4 col-md-offset-4">
    <div class="alert alert-success success1" style="display: none;">
        <center><strong></strong></center>
	</div>
</div>
<div class="container mb-30">
    <div class="row">
        <div class="col-md-9">
            <form class="cotactform" id="formcontact" name="formcontact" method="post">
                <?php if(Yii::$app->user->isGuest) { ?>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon bg-dei"><i class="fa fa-user"></i></div>
                            <input class="form-control" placeholder="Name" type="text"  name="name"  id="name" required="required">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon bg-dei"><i class="fa fa-phone"></i></div>
                            <input class="form-control" placeholder="Number" type="text" name="phone"  id="phone" required="required" maxlength="13" minlength="10" >
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon bg-dei"><i class="fa fa-envelope"></i></div>
                            <input class="form-control" placeholder="Email" type="email"  name="email"  id="email" required="required">
                        </div>
                    </div>
                </div>
                <?php } else { 
                $user=Yii::$app->user->identity;?>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon bg-dei"><i class="fa fa-user"></i></div>
                            <input class="form-control" placeholder="Name" type="text"  name="name"  id="name" required="required" readonly="readonly" value="<?= @$user->user_name ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon bg-dei"><i class="fa fa-phone"></i></div>
                            <input class="form-control" placeholder="Number" type="text" name="phone"  id="phone" required="required" maxlength="13" minlength="10" readonly="readonly" value="<?= @$user->phone_number ?>"  >
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon bg-dei"><i class="fa fa-envelope"></i></div>
                            <input class="form-control" placeholder="Email" type="email"  name="email"  id="email" required="required" readonly="readonly" value="<?= @$user->email ?>">
                        </div>
                    </div>
                </div>
                <?php } ?>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon bg-dei"><i class="fa fa-comment"></i></div>
                            <textarea class="form-control" placeholder="Your Message" name="message"  id="message" required="required" minlength="5"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="button" class="btn btn-bei next-step" onclick="return contactValidate()">Send</button>
                </div>
            </form>
        </div>
        <div class="col-md-3">
            <ul class="addresslist">
                <li>
                    <h4><i class="fa fa-map-marker"></i>Address</h4>
                    <p><strong>Big Cranes India PVT. LTD.</strong></p>
                    <p>Regus Business Centre <br>
                        Level 2, Connaught Place <br>
                        Bund Garden Road, Pune.
                    </p>
                </li>
                <li>
                    <h4><i class="fa fa-phone"></i>Phone Number</h4>
                    <p>+91-9246611422</p>
                </li>
                <!--<li>
                    <h4><i class="fa fa-envelope"></i>Email</h4>
                    <p>info@digitalequipmentsindia.com</p>
                </li>-->
            </ul>
        </div>
    </div>
</div>

<script>
$("#formcontact").validate();	
function contactValidate()
{
    if($("#formcontact").valid())
    {
        $.ajax({
            type: "POST",
            url: "feedback",
            data : $('#formcontact').serialize(),
            dataType: 'html',
            success: function(response){
                if(response == "SUCCESS")
                {
                        $(".success1").show();
                        $(".success1").html('Feedback Submitted Successfully...');
                        $("#formcontact")[0].reset();
                        setInterval(function(){ $(".success1").hide(); }, 3000);
                }
                else
                {
                        $(".invalidauth").show();
                        $(".invalidauth").html('Feedback Not Submitted');
                        setInterval(function(){ $(".invalidauth").hide(); }, 3000);
                }
            }
        });
    }
    else
        $("#formcontact").validate().focusInvalid();
    
    return false;
}
	
</script>