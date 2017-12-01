<style type="text/css">
        .block form {
            margin-top: 30px;
        }
        #step1, #step2, #step3, #step4, #step5  {
            margin: 0;
            background-color: transparent;
            display: block;
        }
        #step2, #step3, #step4, #step5 {
            display: none;
        }
    </style>
<div class="container-fluid get-quote-bg">
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb beibc">
				<li><a href="<?= Yii::$app->params['SITE_URL'] ?>"><i class="fa fa-2x fa-home"></i></a></li>
				<li><a href="#"><h4>Get Quote</h4></a></li>
			</ul>
		</div>
	</div>
</div>
    <form method="post" name="get_quote_form" id="get_quote_form">
        <div class="container" id="quote1">
            <div class="row mt-10">
                
                <div class="col-md-12">
                    <div class="main_inner_head light-head">
                        <h3> Get Quote</h3>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="main_inner_head text-normal">
                        <h3> Purpose Of Quote</h3>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-1">
                                <div class="radio">
                                    <input type="radio" name="quotation_type" id="quotation_type1" class="css-checkbox" value="hire" checked="checked"/>
                                    <label for="quotation_type1" class="css-label radGroup1">Hire</label>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="radio">
                                    <input type="radio" name="quotation_type" id="quotation_type2" class="css-checkbox" value="buy" />
                                    <label for="quotation_type2" class="css-label radGroup1">Buy</label>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="main_inner_head text-normal">
                        <h3> Flexible way to Hire or Buy Equipment for your needs</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <select class="form-control" id="category_id" name="category_id" required="required">
                                                <option value="">SELECT CATEGORY *</option>
                                                <?php
                                                foreach ($productcategories as $category)
                                                    echo "<option value='$category->category_id' >" . strtoupper($category->category_name) . "</option>";
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon bg-dei"><i class="fa fa-map-marker"></i></div>
                                                <input class="form-control" placeholder="Where do you need it?" type="text" name="location" id="location" required="required">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <a href="javascript:void(0);" type="button" class="btn btn-bei btn-lg next-step step0" onclick="showProgressform();">Continue</a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="container" id="quote2">
            <div class="row">
                <div class="col-md-12">
                    <div class="meter">
                        <div id="multi-step"></div>
                    </div>
                </div>
                <div class="col-md-8" id="step1">
                        <div class="main_inner_head text-normal mt-50">
                            <h3> Tell us Something More About the job For <span id="category_name"></span> In <span id="selected_location"></span></h3>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <select class="form-control" id="subcategory_id" name="sub_category_id" required="required">
                                                    <option value="">SELECT SUB CATEGORY *</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="main_inner_head text-normal">
                                                <h3> What Best Describes Your Job?</h3>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="radio">
                                                            <input type="radio" name="job_describes" id="job_describes1" class="css-checkbox" value="ready_to_use" checked="checked"/>
                                                            <label for="job_describes1" class="css-label radGroup1">Ready To Use</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="radio">
                                                            <input type="radio" name="job_describes" id="job_describes2" class="css-checkbox" value="planning_for_budgeting" />
                                                            <label for="job_describes2" class="css-label radGroup1">Planning For Budgeting</label>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <button type="button" name="back" class="btn btn-bei btn-lg backtostep0">Back</button>
                                            <button type="button" class="btn btn-bei btn-lg next-step step1 required1" value="Next1">Next</button>
                                        </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-md-8" id="step2">
                        <div class="main_inner_head text-normal mt-50">
                            <h3> When Does Your Job Start?</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input class="form-control datepicker" placeholder="Please select start date" type="text" required="required" name="start_date" id="start_date">
                                                    <div class="input-group-addon bg-dei"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8 hiredata">
                                            <div class="form-group">
                                                <input class="form-control" placeholder="Duration Length" id="duration" name="duration" type="text" required="required" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                            </div>
                                        </div>
                                        <div class="col-md-8 hiredata">
                                            <div class="form-group">
                                                <select class="form-control" id="duration_type" name="duration_type" required="required">
                                                    <option value="">Select Duration Type</option>
                                                    <option value="days">Days</option>
                                                    <!--<option value="week">Week</option>-->
                                                    <option value="month">Month</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>

                                        <div class="col-md-8">
                                            <div class="main_inner_head text-normal">
                                                <h3> Any extra comments?</h3>
                                            </div>
                                            <div class="form-group">
                                                <textarea name="comments" id="comments" class="form-control" ></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <button type="button" name="back" class="btn btn-bei btn-lg backtostep1">Back</button>
                                            <button type="button" class="btn btn-bei btn-lg next-step step2 required2" value="Next2">Next</button>
                                        </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-md-12" id="step3">
                        <div class="main_inner_head text-normal mt-50">
                            <h3> Your contact details</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                        <?php if(Yii::$app->user->isGuest) { ?>
                                        
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input class="form-control" placeholder="Name" type="text" name="name" id="name" required="required">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input class="form-control" placeholder="Email" type="email" name="email" id="email" required="required">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input class="form-control" placeholder="Phone Number" type="text" name="phone" id="phone" required="required" minlength="10" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" maxlength="10" autocomplete="off">
                                                    <div class="input-group-addon bg-dei"><i class="fa fa-phone"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } else { 
                                            $user=Yii::$app->user->identity;
                                        ?>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input class="form-control" placeholder="Name" type="text" name="name" id="name" readonly="readonly" value="<?= @$user->user_name ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input class="form-control" placeholder="Email" type="email" name="email" id="email" required="required" readonly="readonly" value="<?= @$user->email ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input class="form-control" placeholder="Phone Number" type="text" name="phone" id="phone" required="required" readonly="readonly" value="<?= @$user->phone_number ?>" minlength="10" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" maxlength="10" autocomplete="off">
                                                    <div class="input-group-addon bg-dei"><i class="fa fa-phone"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>

                                        <div class="col-md-12">
                                            <button type="button" name="back" class="btn btn-bei btn-lg next-step backtostep2">Back</button>
                                            <button type="button" class="btn btn-bei btn-lg next-step step3 required3" value="Next3">Next</button>
                                        </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-md-12" id="step4">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="main_inner_head text-normal">
                                    <h3> Which Best Describes Your Job?</h3>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="job_description" id="job_description1" class="css-checkbox" checked="checked" value="commercial">
                                                    <label for="job_description1" class="css-label radGroup1">Commerical</label>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="job_description" id="job_description2" class="css-checkbox" value="doit_yourself">
                                                    <label for="job_description2" class="css-label radGroup1">Do It Yourself</label>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button type="button" name="back" class="btn btn-bei btn-lg next-step backtostep3">Back</button>
                                <button type="button" class="btn btn-bei btn-lg next-step step4 required4" value="Next4">Next</button>
                                <a href="#" class="formloading" style="display:none;"><img src="<?= Yii::$app->params['SITE_URL'] ?>images/loading.gif" /></a>
                            </div>

                        </div>
                </div>

                <div class="col-md-12" id="step5">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="successgetquote mt-50">
                                    <img src="images/success_getquote.png" alt="">
                                    <p>Your enquiry has been successfully sent</p>
                                    <p style="font-size: 18px;">You should start receiving quotes shortly</p>

                                </div>
                                <a href="<?= Yii::$app->params['SITE_URL'] ?>getquote" class="btn btn-bei btn-lg">Need Another Item?</a>

                            </div>

                        </div>
                </div>
            </div>
        </div>    
    </form>
    


</div>

<script>
$(document).ready(function(){
    $("#quote2").hide();
    //$("#get_quote_form").validate();
    
    $('.datepicker').datepicker({ startDate: "today",autoclose: true });
    $("input[name='quotation_type']").click(function(){
        if($(this).val() == 'buy')
        {
            $('.hiredata').hide();
        }
        else
        {
            $('.hiredata').show();
        }
    });
});
//category onchage event
$('#category_id').change(function(){
    $.ajax({
        url: "getproductsubcategories",
        data : {category_id: $(this).val(), "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" },
        dataType: 'json',
        success: function(data){
            $('#subcategory_id').html(data.out);
            $('#capacity').html('<option value="" selected>SELECT CAPACITY</option>');
            var category_name = $('#category_id option:selected').text();
            $('#category_name').html(category_name);
            
        }
    });
});
function showProgressform()
{
    if($("#get_quote_form").valid())
    {
        
        var seleted_location = $("#location").val();
        $('#selected_location').html(seleted_location.substring(0, seleted_location.indexOf(',')));
        $("#quote1").hide();
        $("#quote2").show();
    }
    else
        $("#get_quote_form").validate().focusInvalid();
}
//google auto complete
function initAutocomplete() {
    autocomplete = new google.maps.places.Autocomplete(
    (document.getElementById('location')),
    {types: ['(regions)'],componentRestrictions: {country: "in"}});
}
</script>
<?php $this->registerJsFile('js/formeter.1.3.min.js', ['position' => \yii\web\View::POS_END]); ?> 
<?php $this->registerJsFile('js/get_quote_form.js', ['position' => \yii\web\View::POS_END]); ?> 
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTOYrzyFnVI4_eo445CP07XCSNhcPwICk&libraries=places&callback=initAutocomplete" async defer></script>