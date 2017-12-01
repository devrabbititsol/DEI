<?php $role_details = Yii::$app->session->get('role'); ?>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Get Quote</h2>
        <div class="right-wrapper pull-right pr-xlg">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= Yii::$app->params['SITE_URL'] ?>admin">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Get Quote Details</span></li>
            </ol>
        </div>
    </header>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <a href="<?= Yii::$app->params['SITE_URL'] ?>admin/getquote" class="mb-xs mt-xs mr-xs btn btn-primary btn-block">Back To Get Quote List</a>
        </div>
    </div>
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
    <div class="col-md-12">
        <div class="tabs tabs-danger">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#popular4" data-toggle="tab" aria-expanded="true"><i class="fa fa-align-left"></i> Quote Details</a>
                </li>
                <?php if(!empty($employee_details)) { ?>
                <li class="">
                    <a href="#recent5" data-toggle="tab" aria-expanded="false"><i class="fa fa-user"></i> Assigned to</a>
                </li>
                <?php } ?>
            </ul>
            <div class="tab-content">
                <div id="popular4" class="tab-pane active">
                    <form class="form-horizontal form-dtls">
                        <section class="panel">
                            <h2 class="panel-title">Quote Details</h2>

                            <div class="panel-body">
                                
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Purpose of Quote: </label>
                                        <div class="col-sm-7">
                                            <strong> <?= $quote_details['quotation_type'] ?></strong>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Category: </label>
                                        <div class="col-sm-7">
                                            <strong><?= $quote_details['category_name'] ?></strong>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Sub category: </label>
                                        <div class="col-sm-7">
                                            <strong> <?= $quote_details['sub_category_name'] ?></strong>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Capacity: </label>
                                        <div class="col-sm-7">
                                            <strong> <?= $quote_details['capacity_requested'] ?></strong>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Location: </label>
                                        <div class="col-sm-7">
                                            <strong><?= $quote_details['location'] ?></strong>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">What Best Describes Your Job? : </label>
                                        <div class="col-sm-7">
                                            <strong><?= str_replace('_', ' ', $quote_details['job_describes']) ?></strong>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Start Date : </label>
                                        <div class="col-sm-7">
                                            <strong><?= $quote_details['start_date'] ?></strong>
                                        </div>
                                    </div>
                                    <?php if($quote_details['quotation_type']!='buy'){ ?>
                                        <div class="form-group">
                                            <label class="col-sm-5 control-label">Duration : </label>
                                            <div class="col-sm-7">
                                                <strong><?= $quote_details['duration']." ".$quote_details['duration_type'] ?></strong>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Comments : </label>
                                        <div class="col-sm-7">
                                            <strong><?= $quote_details['comments'] ?></strong>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Which Best Describes Your Job? : </label>
                                        <div class="col-sm-7">
                                            <strong><?= str_replace('_', ' ', $quote_details['job_description']) ?></strong>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Name : </label>
                                        <div class="col-sm-7">
                                            <strong><?= $quote_details['name'] ?></strong>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Email : </label>
                                        <div class="col-sm-7">
                                            <strong><?= $quote_details['email'] ?></strong>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Phone : </label>
                                        <div class="col-sm-7">
                                            <strong><?= $quote_details['phone'] ?></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </form>
                </div>
                <div id="recent5" class="tab-pane">
                    <form class="form-horizontal form-dtls">
                        <section class="panel">
                            <h2 class="panel-title">Employee Details</h2>

                            <div class="panel-body">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Name: </label>
                                        <div class="col-sm-7">
                                            <strong> <?= $employee_details['user_name'] ?></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Email: </label>
                                        <div class="col-sm-7">
                                            <strong> <?= $employee_details['email'] ?></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Phone: </label>
                                        <div class="col-sm-7">
                                            <strong> <?= $employee_details['phone_number'] ?></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Company Name: </label>
                                        <div class="col-sm-7">
                                            <strong> <?= $employee_details['company_name'] ?></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Company Address: </label>
                                        <div class="col-sm-7">
                                            <strong> <?= $employee_details['company_address'] ?></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Designation: </label>
                                        <div class="col-sm-7">
                                            <strong> <?= $employee_details['designation'] ?></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">Company Email: </label>
                                        <div class="col-sm-7">
                                            <strong> <?= $employee_details['company_email'] ?></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-12">
        <footer class="panel-footer text-center">
            <?php if($quote_details['quote_status']!=1){?>
            <button class="btn btn-success" onclick="quoteApprove(<?= $quote_details['quotation_id'] ?>);">Approve </button>
            <?php } if($quote_details['quote_status']!=0){?>
            <button type="button" class="btn btn-warning" onclick="quoteHold(<?= $quote_details['quotation_id'] ?>);">Hold</button>
            <?php } if($quote_details['quote_status']!=2){?>
            <button type="button" class="btn btn-danger" onclick="quoteReject(<?= $quote_details['quotation_id'] ?>);">Reject</button>
            <?php } 
            if(($role_details['role_id'] == 2 || $role_details['role_id'] == 8)){
                if($quote_details['employee_id'] == '' || $quote_details['employee_id'] == '0'){?>
                <button type="button" class="btn btn-info"  data-toggle="modal" data-target="#postad_modal">Assign</button>
                <?php } else{ ?>
                <button type="button" class="btn btn-info"  data-toggle="modal" data-target="#postad_modal">Reassign</button>
                <?php } 
            }?>
            <?php if(\app\models\User::checkAccess('payment_action')) { ?>
                <form method="post" id="request_payment" action="<?= Yii::$app->params['SITE_URL'] ?>admin/orderspaymentrequest">
                    <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                    <input type="hidden" id="quotation_id" name="quotation_id" value="<?php echo $quote_details['quotation_id'];?>">
                    <input type="hidden" id="user_email" name="user_email" value="<?php echo $quote_details['email'];?>">
                    <input type="hidden" id="user_phone" name="user_phone" value="<?php echo $quote_details['phone'];?>">
                    <input type="hidden" id="user_name" name="user_name" value="<?php echo $quote_details['name'];?>">
                    <input type="hidden" id="package_type" name="package_type" value="1">
                    <input type="hidden" id="payment_type" name="payment_type" value="4">
                </form>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('request_payment').submit();">REQUEST PAYMENT</button>
            <?php } ?>    
        </footer>
    </div>

    <div class="clearfix mb-xlg"></div>

    <div class="col-md-12">
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle=""></a>
                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss=""></a>
                </div>

                <h2 class="panel-title">Comments</h2>
            </header>
            <div class="panel-body">
                <?php if (!empty($comments)) { ?>
                    <div class="scrollable visible-slider has-scrollbar" data-plugin-scrollable="" style="height: 400px;">
                        <div class="scrollable-content" tabindex="0" style="right: -17px;">
                            <div class="chat">   
                                <div class="chat-history">
                                    <ul class="chat-ul">
                                        <?php
                                        foreach ($comments as $index => $comment) {
                                            if ($index % 2 == 0)
                                                echo '<li>
                                                    <div class="message-data">
                                                        <span class="message-data-name"><i class="fa fa-circle you"></i> ' . $comment['user_name'] . ' on ' . date('m-d-Y H:i:s', strtotime($comment['date_created'])) . '</span>
                                                    </div>
                                                    <div class="message you-message">' . $comment['comment_description'] . '</div>
                                                </li>';
                                            else
                                                echo '<li class="clearfix">
                                                    <div class="message-data align-right">
                                                        <span class="message-data-name"> ' . $comment['user_name'] . ' on ' . date('m-d-Y H:i:s', strtotime($comment['date_created'])) . '</span> <i class="fa fa-circle me"></i>
                                                    </div>
                                                    <div class="message me-message float-right">' . $comment['comment_description'] . '</div>
                                                </li>';
                                        }
                                        ?>

                                    </ul>


                                </div> <!-- end chat-history -->

                            </div>
                        </div>
                    </div>
                <?php
                }
                else {
                    echo "<center><strong>No Comments</strong></center>";
                }
                ?>
            </div>
            <footer class="panel-footer">
                <form method="post" action="<?= Yii::$app->params['SITE_URL'] ?>admin/addcomment" name="addcomment" id="addcomment">
                    <input type="hidden" name="comment_belongs_to" id="comment_belongs_to" value="<?php echo $quote_details['quotation_id']; ?>">
                    <input type="hidden" name="comment_type" id="comment_type" value="8">
                    <textarea name="comment_description" id="comment_description" class="form-control mb-xl" placeholder="Enter your comments here.." required="required" minlength="5"></textarea>
                    <button class="btn btn-primary">Submit the comment </button>
                </form>
            </footer>
        </section>
    </div>

    <!-- end: page -->
    <div class="modal fade" id="postad_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">Assign Quote to employee</h5>

                </div>

                <div class="modal-body">

                    <form action="" method="post" id="assignquote" class="form-horizontal">
                        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                        <input type="hidden" name="quotation_id" value="<?= $quote_details['quotation_id'] ?>" id="quotation_id">

                        <div class="modal-post">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Zone : </label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="zone_id" name="zone_id">
                                        <option value="">SELECT ZONE</option> 
                                        <?php
                                        foreach ($zones as $zone)
                                            if ($zone['zone_status'] == 1)
                                                echo "<option value='" . $zone['zone_id'] . "'>" . strtoupper($zone['zone_name']) . "</option>";
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">State : </label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="state_id" name="state_id">
                                        <option value="">SELECT STATE</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">District : </label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="district_id" name="district_id">
                                        <option value="">SELECT DISTRICT</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Employee : </label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="employee_id" name="employee_id" required="required">
                                        <option value="">SELECT EMPLOYEE</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group"></div>
                        </div>

                        <div class="text-center"> </div>

                        <div class="modal-footer">

                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Close">

                            <input type="submit" name="adpost" value="Submit" onclick="validateQuoteassign()" class="btn btn-success">

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>
</section>
<script>
$(document).ready(function () {
    $("#addcomment").validate();
    $("#assignquote").validate();
});
$('#zone_id').change(function(){
    var zone_id = $(this).val();
    $.ajax({
        url: "<?= Yii::$app->params['SITE_URL'] ?>admin/getstatesbyzones",
        data : {zone_id: zone_id, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" },
        dataType: 'json',
        success: function(data){
            $('#state_id').html(data.states);
        }
    });
});
$('#state_id').change(function(){
    var state_id = $(this).val();
    $.ajax({
        url: "<?= Yii::$app->params['SITE_URL'] ?>admin/getdistrictsbystates",
        data : {state_id: state_id, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" },
        dataType: 'json',
        success: function(data){
            $('#district_id').html(data.districts);
        }
    });
});
$('#district_id').change(function(){
    var district_id = $(this).val();
    $.ajax({
        url: "<?= Yii::$app->params['SITE_URL'] ?>admin/getemployeebydistrict",
        data : {district_id: district_id, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" },
        dataType: 'json',
        success: function(data){
            $('#employee_id').html(data.employees);
        }
    });
});
function quoteApprove(quote_id)
{
    if (window.confirm("Do you really want to Approve?")) { 
        $.ajax({
            url: "<?= Yii::$app->params['SITE_URL'] ?>admin/approvequote",
            type: "POST",
            data : {quote_id: quote_id, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" },
            dataType: 'json',
            success: function(data){
                if (data){
                    window.location.href = "<?= Yii::$app->params['SITE_URL'] ?>admin/viewquote/"+quote_id;
                }
            }
        });
    }
}
function quoteHold(quote_id)
{
    if (window.confirm("Do you really want to Hold?")) { 
        $.ajax({
            url: "<?= Yii::$app->params['SITE_URL'] ?>admin/holdquote",
            type: "POST",
            data : {quote_id: quote_id, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" },
            dataType: 'json',
            success: function(data){
                if (data){
                    window.location.href = "<?= Yii::$app->params['SITE_URL'] ?>admin/viewquote/"+quote_id;
                }
            }
        });
    }
}
function quoteReject(quote_id)
{
    if (window.confirm("Do you really want to Reject?")) { 
        $.ajax({
            url: "<?= Yii::$app->params['SITE_URL'] ?>admin/rejectquote",
            type: "POST",
            data : {quote_id: quote_id, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" },
            dataType: 'json',
            success: function(data){
                if (data){
                    window.location.href = "<?= Yii::$app->params['SITE_URL'] ?>admin/viewquote/"+quote_id;
                }
            }
        });
    }
}
function validateQuoteassign()
{
    if($("#assignquote").valid())
    {
        $.ajax({
            url: "<?= Yii::$app->params['SITE_URL'] ?>admin/assignquote",
            type: "POST",
            data : $('#assignquote').serialize(),
            dataType: 'html',
            success: function(data){
//                /window.location.href = "<?php echo $_SERVER['REQUEST_URI'];?>";
            }
        });
    }
    else
        $("#assignproduct").validate().focusInvalid();
}


</script>