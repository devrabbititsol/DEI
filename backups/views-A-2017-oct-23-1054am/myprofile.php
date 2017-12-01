<style>
    table.dataTable {
        font-size: 14px !important;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb beibc">
                <li><a href="<?= Yii::$app->params['SITE_URL'] ?>"><i class="fa fa-2x fa-home"></i></a></li>
                <li><a href="#"><h4>My Account</h4></a></li>
            </ul>
        </div>
    </div>
</div>

<div class="container">
    <div class="row flex mt-10">
        <div class="col-md-12">
            <div class="main_inner_head light-head">
                <h3> My Account</h3>
            </div>
        </div>	

    </div>
</div>
<div class="container mb-30">
    <div class="row">
        <div class="col-md-2">
            <ul class="nav nav-tabs myaccount_menu_list">
                <li><p>User settings</p></li>
                <li class="active"><a href="#security" aria-controls="security" role="tab" data-toggle="tab">Security</a></li>
                <li><a href="#personalinfo" aria-controls="personalinfo" role="tab" data-toggle="tab">Personal Info</a></li>
                <!--<li><a href="#mywallet" aria-controls="mywallet" role="tab" data-toggle="tab">My Wallet</a></li>-->
                <li><p>User Operations</p></li>
                <li><a href="#hire" aria-controls="hire" role="tab" data-toggle="tab">Hire</a></li>
                <li><a href="#supplier" aria-controls="supplier" role="tab" data-toggle="tab">Supplier</a></li>
                <li><a href="#buy" aria-controls="buy" role="tab" data-toggle="tab">Buy</a></li>
                <li><a href="#sale" aria-controls="sale" role="tab" data-toggle="tab">Sale</a></li>
                <li><a href="#supplyorsale" aria-controls="supplyorsale" role="tab" data-toggle="tab">Supply / Sale</a></li>
                <li><a href="#ads" aria-controls="ads" role="tab" data-toggle="tab">Ads</a></li>
                <!--<li><a href="#wantedjob" aria-controls="wantedjob" role="tab" data-toggle="tab">Wanted Job</a></li>
                <li><a href="#postedjob" aria-controls="postedjob" role="tab" data-toggle="tab">Posted Job</a></li>-->
            </ul>
        </div>
        <div class="col-md-10">
            <div class="myaccount_dtls_panel">
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active pl-30" id="security">
                        <h4 class="mb-0 mt-40">Password</h4>
                        <p class="mb-30">Set a strong password to keep your account secure</p>
                        <div class="col-md-12">
                            <div class="col-sm-3"></div>
                            <div class="col-md-6 ">
                                <div class="alert alert-warning invalidauth" style="display: none;">
                                    <center><strong></strong></center>
                                </div>
                                <div class="alert alert-success success1" style="display: none;">
                                    <center><strong></strong></center>
                                </div>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        <div class="col-md-4 col-md-offset-3 error-message" style="display: none;">
                            <div class="alert alert-danger">
                                <center>* All fields are mandatory</center>
                            </div>
                        </div>
                        <form action="#" method="post" role="form" class="col-md-6" id="passwordform"> 
                            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                            <div class="row">
                                <div class="form-group">
                                    <input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder="Old Password *" required="required">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="New Password should be minimum 8 characters *" required="required" minlength="8">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="confirmnewpassword" name="confirmnewpassword" placeholder="Confirm New Password *" required="required" data-rule-equalTo="#newpassword">
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
                    </div>
                    <div role="tabpanel" class="tab-pane pl-30" id="personalinfo">
                        <h4 class="mb-20 mt-20">My Profile</h4>
                        <div class="col-md-12">
                            <div class="col-sm-3"></div>
                            <div class="col-md-6 ">
                                <div class="alert alert-warning invalidauth" style="display: none;">
                                    <center><strong></strong></center>
                                </div>
                                <div class="alert alert-success profilesuccess" style="display: none;">
                                    <center><strong></strong></center>
                                </div>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        <div class="col-md-4 col-md-offset-3 profile_error-message" style="display: none;">
                            <div class="alert alert-danger">
                                <center>* All fields are mandatory</center>
                            </div>
                        </div>
                        <form action="#" method="post" role="form" class="col-md-8 form-horizontal" id="profileform">
                            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Name :</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required="required" value="<?php echo $userdetails['user_name']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Mobile :</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="mobile" name="mobile" readonly placeholder="Mobile No" required="required" value="<?php echo $userdetails['phone_number']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Email Address :</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="email" name="email" readonly placeholder="Email" required="required" value="<?php echo $userdetails['email']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Company Name :</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Company Name" required="required" value="<?php echo $userdetails['company_name']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Designation :</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="designation" name="designation" placeholder="Designation" value="<?php echo $userdetails['designation']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Company Email :</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="company_email" name="company_email" placeholder="Company Email" value="<?php echo $userdetails['company_email']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Company Address :</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Company Address" value="<?php echo $userdetails['company_address']; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-3">

                                    </div>
                                    <div class="col-sm-9">
                                        <button class="btn btn-bei" onclick="return profileValidate();">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="mywallet">
                        <h4 class="mb-20 mt-20">My Profile</h4>
                        <table id="myprofile" class="display datatable">
                            <thead>
                                <tr>
                                    <th>ID.No</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Receipt No</th>
                                    <th>Made of Payment</th>
                                    <th>Commission Due / Paid</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#0012</td>
                                    <td>07/June</td>
                                    <td>25000/-</td>
                                    <td>10258475</td>
                                    <td>Online</td>
                                    <td>Paid</td>
                                </tr>
                                <tr>
                                    <td>#0012</td>
                                    <td>07/June</td>
                                    <td>25000/-</td>
                                    <td>10258475</td>
                                    <td>Online</td>
                                    <td>Paid</td>
                                </tr>
                                <tr>
                                    <td>#0012</td>
                                    <td>07/June</td>
                                    <td>25000/-</td>
                                    <td>10258475</td>
                                    <td>Online</td>
                                    <td>Paid</td>
                                </tr>
                                <tr>
                                    <td>#0012</td>
                                    <td>07/June</td>
                                    <td>25000/-</td>
                                    <td>10258475</td>
                                    <td>Online</td>
                                    <td>Paid</td>
                                </tr>
                                <tr>
                                    <td>#0012</td>
                                    <td>07/June</td>
                                    <td>25000/-</td>
                                    <td>10258475</td>
                                    <td>Online</td>
                                    <td>Not Paid</td>
                                </tr>
                                <tr>
                                    <td>#0012</td>
                                    <td>07/June</td>
                                    <td>25000/-</td>
                                    <td>10258475</td>
                                    <td>Online</td>
                                    <td>Not Paid</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="hire">
                        <h4 class="mb-20 mt-20">Hire</h4>
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-md-6">
                                <div class="alert alert-warning ordererror" style="display: none;">
                                    <center><strong></strong></center>
                                </div>
                                <div class="alert alert-success ordersuccess" style="display: none;">
                                    <center><strong></strong></center>
                                </div>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        <div class="table-responsive">
                        <table id="hire_table" class="display datatable">
                            <thead>
                                <tr>
                                    <th> Order Id </th>
                                    <!--<th> Location </th>-->
                                    <th> Category </th>
                                    <th> Capacity </th>
                                    <!--<th> Duration </th>-->
                                    <th> From Date </th>
                                    <th> To Date </th>
                                    <th> Status </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($hiredetails as $key => $value){ ?>
                                <tr>
                                    <td><?php echo $value['manual_order_code']; ?></td>
                                    <!--<td><?php echo $value['current_location']; ?></td>-->
                                    <td><?php echo $value['category_name']; ?></td>
                                    <td><?php echo $value['capacity']; ?></td>
                                    <!--<td><?php echo $value['no_of_days']; ?> (days)</td>-->
                                    <td><?php echo date("d-m-Y", strtotime($value['from_date'])); ?></td>
                                    <td><?php echo date("d-m-Y", strtotime($value['to_date'])); ?></td>
                                    <?php if ($value['order_status'] == 0) { ?>
                                    <td>Pending</td>
                                    <?php }elseif ($value['order_status'] == 1) { ?>
                                    <td>Approved</td>
                                    <?php }elseif ($value['order_status'] == 2) { ?>
                                    <td>Rejected</td>
                                    <?php }elseif ($value['order_status'] == 3) { ?>
                                    <td>Deleted</td>
                                    <?php }else echo '<td></td>'; /*elseif ($value['order_status'] == 5) { ?>
                                        <td>Re-initialized</td>
                                    <?php } elseif ($value['order_status'] == 6) { ?>
                                        <td>Closed</td>
                                        <?php 
                                    } */if ($value['order_status'] == 3) { ?>
                                        <td><a href="javascript:void(0);" onclick="getProductdata(<?php echo $value['product_id']; ?>);"><i class="fa fa-lg fa-eye" style="color:red;"></i></a> </td>
                                    <?php } else { ?>
                                        <td><a href="javascript:void(0);" onclick="getProductdata(<?php echo $value['product_id']; ?>);"><i class="fa fa-lg fa-eye" style="color:red;"></i></a> &nbsp; &nbsp; 
                                            <a href="javascript:void(0);" onclick="deleteOrder(<?php echo $value['order_id']; ?>);"><i class="fa fa-lg fa-trash" style="color:red;"></i></a></td>
                                    <?php } ?>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                            </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="supplier">
                        <h4 class="mb-20 mt-20">Supplier</h4>
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-md-6">
                                <div class="alert alert-warning producterror" style="display: none;">
                                    <center><strong></strong></center>
                                </div>
                                <div class="alert alert-success productsuccess" style="display: none;">
                                    <center><strong></strong></center>
                                </div>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        <div class="table-responsive">
                        <table id="supplier_table" class="display datatable">
                            <thead>
                                <tr>
                                    <th> Product Id </th>
                                    <th> Category </th>
                                    <th> Sub Category </th>
                                    <th> Model </th>
                                    <!--<th> Location </th>-->
                                    <th> Status </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($supplydetails as $key => $value){ ?> 
                                <tr>
                                    <td><?php echo $value['manual_product_code']; ?></td>
                                    <td><?php echo $value['category_name']; ?></td>
                                    <td><?php echo $value['sub_category_name']; ?></td>
                                    <td><?php echo $value['model_name']; ?></td>
                                    <!--<td><?php echo $value['current_location']; ?></td>-->
                                    <?php if ($value['product_status'] == 0) { ?>
                                    <td>Pending</td>
                                    <?php }elseif ($value['product_status'] == 1) { ?>
                                    <td>Approved</td>
                                    <?php }elseif ($value['product_status'] == 2) { ?>
                                    <td>Rejected</td>
                                    <?php }elseif ($value['product_status'] == 3) { ?>
                                    <td>Deleted</td>
                                    <?php }/*elseif ($value['product_status'] == 5) { ?>
                                    <td>Rejected</td>
                                    <?php }elseif ($value['product_status'] == 6) { ?>
                                    <td>Re-initialized</td>
                                    <?php }elseif ($value['product_status'] == 7) { ?>
                                    <td>Closed</td>
                                    <?php }*/ if ($value['product_status'] == 3) { ?>
                                    <td><a href="javascript:void(0);" onclick="getProductdata(<?php echo $value['product_id']; ?>);"><i class="fa fa-lg fa-eye" style="color:red;"></i></a> </td>
                                    <?php } else { ?>
                                    <td><a href="javascript:void(0);" onclick="getProductdata(<?php echo $value['product_id']; ?>);"><i class="fa fa-lg fa-eye" style="color:red;"></i></a> &nbsp; &nbsp; 
                                        <!--<a href="<?= Yii::$app->params['SITE_URL'] ?>editproduct/<?php echo $value['product_id']; ?>"><i class="fa fa-lg fa-pencil" style="color:red;"></i></a> &nbsp; &nbsp; -->
                                        <a href="javascript:void(0);" onclick="deleteProduct(<?php echo $value['product_id']; ?>);"><i class="fa fa-lg fa-trash" style="color:red;"></i></a>
                                        <?php if($value['payment_type'] == 1 && $value['amount_paid']<$value['amount_actual']){ ?>
                                        <form method="post" action="paynow" id="paynow">
                                            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                                            <input type="hidden" id="payment_id" name="payment_id" value="<?php echo $value['payment_id'];?>">
                                            <a onclick="document.getElementById('paynow').submit();" title="PAY NOW"><i class="fa fa-lg fa-credit-card" style="color:red;"></i></a>
                                        </form> 
                                        <?php }?>
                                        </td>
                                    <?php } ?>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="buy">
                        <h4 class="mb-20 mt-20">My Buy</h4>
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-md-6">
                                <div class="alert alert-warning ordererror" style="display: none;">
                                    <center><strong></strong></center>
                                </div>
                                <div class="alert alert-success ordersuccess" style="display: none;">
                                    <center><strong></strong></center>
                                </div>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        <div class="table-responsive">
                        <table id="mybuy_table" class="display datatable">
                            <thead>
                                <tr>
                                    <th> Order Id </th>
                                    <th> Category </th>
                                    <th> Sub Category </th>
                                    <th> Model </th>
                                    <!--<th> Duration </th>-->
                                    <th> From Date </th>
                                    <th> Status </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($buydetails as $key => $value){ ?>
                                <tr>
                                    <td><?php echo $value['manual_order_code']; ?></td>
                                    <td><?php echo $value['category_name']; ?></td>
                                    <td><?php echo $value['sub_category_name']; ?></td>
                                    <td><?php echo $value['model_name']; ?></td>
                                    <!--<td><?php echo $value['no_of_days']; ?> (days)</td>-->
                                    <td><?php echo date("d-m-Y",strtotime($value['from_date'])); ?></td>
                                    <?php if ($value['order_status'] == 0) { ?>
                                    <td>Pending</td>
                                    <?php }elseif ($value['order_status'] == 1) { ?>
                                    <td>Approved</td>
                                    <?php }elseif ($value['order_status'] == 2) { ?>
                                    <td>Rejected</td>
                                    <?php }elseif ($value['order_status'] == 3) { ?>
                                    <td>Deleted</td>
                                    <?php }/*elseif ($value['order_status'] == 5) { ?>
                                    <td>Re-initialized</td>
                                    <?php }elseif ($value['order_status'] == 6) { ?>
                                    <td>Closed</td>
                                    <?php  } */
                                    if ($value['order_status'] == 3) { ?>
                                    <td><a href="javascript:void(0);" onclick="getProductdata(<?php echo $value['product_id']; ?>);"><i class="fa fa-lg fa-eye" style="color:red;"></i></a> </td>
                                    <?php } else { ?>
                                    <td><a href="javascript:void(0);" onclick="getProductdata(<?php echo $value['product_id']; ?>);"><i class="fa fa-lg fa-eye" style="color:red;"></i></a> &nbsp; &nbsp; 
                                        <a href="javascript:void(0);" onclick="deleteOrder(<?php echo $value['order_id']; ?>);"><i class="fa fa-lg fa-trash" style="color:red;"></i></a>
                                    </td>
                                    <?php } ?>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="sale">
                        <h4 class="mb-20 mt-20">Sale</h4>
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-md-6">
                                <div class="alert alert-warning producterror" style="display: none;">
                                    <center><strong></strong></center>
                                </div>
                                <div class="alert alert-success productsuccess" style="display: none;">
                                    <center><strong></strong></center>
                                </div>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        <div class="table-responsive">
                        <table id="sale_table" class="display datatable">
                            <thead>
                                <tr>
                                    <th> Product Id </th>
                                    <th> Category </th>
                                    <th> Sub Category </th>
                                    <th> Model </th>
                                    <!--<th> Location </th>-->
                                    <th> Status </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($saledetails as $key => $value){ ?>
                                <tr>
                                    <td><?php echo $value['manual_product_code']; ?></td>
                                    <td><?php echo $value['category_name']; ?></td>
                                    <td><?php echo $value['sub_category_name']; ?></td>
                                    <td><?php echo $value['model_name']; ?></td>
                                    <!--<td><?php echo $value['current_location']; ?></td>-->
                                    <?php if ($value['product_status'] == 0) { ?>
                                    <td>Pending</td>
                                    <?php }elseif ($value['product_status'] == 1) { ?>
                                    <td>Approved</td>
                                    <?php }elseif ($value['product_status'] == 2) { ?>
                                    <td>Rejected</td>
                                    <?php }elseif ($value['product_status'] == 3) { ?>
                                    <td>Deleted</td>
                                    <?php }/*elseif ($value['product_status'] == 5) { ?>
                                    <td>Rejected</td>
                                    <?php }elseif ($value['product_status'] == 6) { ?>
                                    <td>Re-initialized</td>
                                    <?php }elseif ($value['product_status'] == 7) { ?>
                                    <td>Closed</td>
                                    <?php  }*/ if ($value['product_status'] == 3) { ?>
                                    <td><a href="javascript:void(0);" onclick="getProductdata(<?php echo $value['product_id']; ?>);"><i class="fa fa-lg fa-eye" style="color:red;"></i></a> </td>
                                    <?php } else { ?>
                                    <td><a href="javascript:void(0);" onclick="getProductdata(<?php echo $value['product_id']; ?>);"><i class="fa fa-lg fa-eye" style="color:red;"></i></a> &nbsp; &nbsp; 
                                        <a href="javascript:void(0);" onclick="deleteProduct(<?php echo $value['product_id']; ?>);"><i class="fa fa-lg fa-trash" style="color:red;"></i></a>
                                        <?php if($value['payment_type'] == 1 && $value['amount_paid']<$value['amount_actual']){ ?>
                                        <form method="post" action="paynow" id="paynow">
                                            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                                            <input type="hidden" id="payment_id" name="payment_id" value="<?php echo $value['payment_id'];?>">
                                            <a onclick="document.getElementById('paynow').submit();" title="PAY NOW"><i class="fa fa-lg fa-credit-card" style="color:red;"></i></a>
                                        </form> 
                                        <?php }?>
                                    </td>
                                    <?php } ?>
                                </tr>
                            <?php }?>
                                
                            </tbody>
                        </table>
                        </div>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane" id="supplyorsale">
                        <h4 class="mb-20 mt-20">Supply / Sale</h4>
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-md-6">
                                <div class="alert alert-warning producterror" style="display: none;">
                                    <center><strong></strong></center>
                                </div>
                                <div class="alert alert-success productsuccess" style="display: none;">
                                    <center><strong></strong></center>
                                </div>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        <div class="table-responsive">
                        <table id="sale_table" class="display datatable">
                            <thead>
                                <tr>
                                    <th> Product Id </th>
                                    <th> Category </th>
                                    <th> Sub Category </th>
                                    <th> Model </th>
                                    <!--<th> Location </th>-->
                                    <th> Status </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($supplyorsaledetails as $key => $value){ ?>
                                <tr>
                                    <td><?php echo $value['manual_product_code']; ?></td>
                                    <td><?php echo $value['category_name']; ?></td>
                                    <td><?php echo $value['sub_category_name']; ?></td>
                                    <td><?php echo $value['model_name']; ?></td>
                                    <!--<td><?php echo $value['current_location']; ?></td>-->
                                    <?php if ($value['product_status'] == 0) { ?>
                                    <td>Pending</td>
                                    <?php }elseif ($value['product_status'] == 1) { ?>
                                    <td>Approved</td>
                                    <?php }elseif ($value['product_status'] == 2) { ?>
                                    <td>Rejected</td>
                                    <?php }elseif ($value['product_status'] == 3) { ?>
                                    <td>Deleted</td>
                                    <?php }/*elseif ($value['product_status'] == 5) { ?>
                                    <td>Rejected</td>
                                    <?php }elseif ($value['product_status'] == 6) { ?>
                                    <td>Re-initialized</td>
                                    <?php }elseif ($value['product_status'] == 7) { ?>
                                    <td>Closed</td>
                                    <?php  }*/ if ($value['product_status'] == 3) { ?>
                                    <td><a href="javascript:void(0);" onclick="getProductdata(<?php echo $value['product_id']; ?>);"><i class="fa fa-lg fa-eye" style="color:red;"></i></a> </td>
                                    <?php } else { ?>
                                    <td><a href="javascript:void(0);" onclick="getProductdata(<?php echo $value['product_id']; ?>);"><i class="fa fa-lg fa-eye" style="color:red;"></i></a> &nbsp; &nbsp; 
                                        <a href="javascript:void(0);" onclick="deleteProduct(<?php echo $value['product_id']; ?>);"><i class="fa fa-lg fa-trash" style="color:red;"></i></a>
                                        <?php if($value['payment_type'] == 1 && $value['amount_paid']<$value['amount_actual']){ ?>
                                        <form method="post" action="paynow" id="paynow">
                                            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                                            <input type="hidden" id="payment_id" name="payment_id" value="<?php echo $value['payment_id'];?>">
                                            <a  onclick="document.getElementById('paynow').submit();" title="PAY NOW"><i class="fa fa-lg fa-credit-card" style="color:red;"></i></a>
                                        </form> 
                                        <?php }?>
                                    </td>
                                    <?php } ?>
                                </tr>
                            <?php }?>
                                
                            </tbody>
                        </table>
                        </div>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane" id="ads">
                        <h4 class="mb-20 mt-20">My Ads</h4>
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-md-6">
                                <div class="alert alert-warning aderror" style="display: none;">
                                    <center><strong></strong></center>
                                </div>
                                <div class="alert alert-success adsuccess" style="display: none;">
                                    <center><strong></strong></center>
                                </div>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        <div class="table-responsive">
                        <table id="sale_table" class="display datatable">
                            <thead>
                                <tr>
                                    <th> Image </th>
                                    <th> Title </th>
                                    <th> Description </th>
                                    <th> Weblink </th>
                                    <th> Expire On </th>
                                    <th> Status </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($addetails as $key => $value){ ?>
                                <tr>
                                    <td><a href="<?= $value['ad_image_url'] ?>"><img src="<?= $value['ad_image_url'] ?>" class="img-responsive"></a></td>
                                    <td><?php echo $value['ad_title']; ?></td>
                                    <td><?php echo $value['description']; ?></td>
                                    <td><?php echo $value['ad_weblink']; ?></td>
                                    <td><?php echo date("d-m-Y", strtotime($value['ad_expire'])); ?></td>
                                    <?php if ($value['ad_image_status'] == 0) { ?>
                                    <td>Pending</td>
                                    <?php }elseif ($value['ad_image_status'] == 1) { ?>
                                    <td>Approved</td>
                                    <?php }elseif ($value['ad_image_status'] == 2) { ?>
                                    <td>Rejected</td>
                                    <?php }elseif ($value['ad_image_status'] == 3) { ?>
                                    <td>Deleted</td>
                                    <?php } ?>
                                    <td>
                                        <?php if ($value['ad_image_status'] < 3) { ?>
                                        <a href="javascript:void(0);" onclick="deleteAd(<?php echo $value['ad_id']; ?>,<?php echo $value['ads_image_id']; ?>);"><i class="fa fa-lg fa-trash" style="color:red;"></i></a>
                                        <?php } ?>
                                        <?php if($value['payment_type'] == 2 && $value['amount_paid']<$value['amount_actual']){ ?>
                                        <form method="post" action="paynow" id="paynow">
                                            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                                            <input type="hidden" id="payment_id" name="payment_id" value="<?php echo $value['payment_id'];?>">
                                            <a onclick="document.getElementById('paynow').submit();" title="PAY NOW"><i class="fa fa-lg fa-credit-card" style="color:red;"></i></a>
                                        </form> 
                                        <?php }?>
                                    </td>
                                </tr>
                            <?php }?>
                                
                            </tbody>
                        </table>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="wantedjob">
                        <h4 class="mb-20 mt-20">My Wanted Job</h4>
                        <table id="wantedjob_table" class="display datatable">
                            <thead>
                                <tr>
                                    <th>ID No</th>
                                    <th>Category</th>
                                    <th>Type Of Job</th>
                                    <th>Date of Applied</th>
                                    <th>Expire Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>ID No</td>
                                    <td>Category</td>
                                    <td>Type Of Job</td>
                                    <td>Date of Applied</td>
                                    <td>Expire Date</td>
                                    <td>Action</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="postedjob">
                        <h4 class="mb-20 mt-20">My Posted Job</h4>
                        <table id="postedjob_table" class="display datatable">
                            <thead>
                                <tr>
                                    <th>ID No</th>
                                    <th>Category</th>
                                    <th>Type Of Job</th>
                                    <th>Date of Applied</th>
                                    <th>Expire Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>ID No</td>
                                    <td>Category</td>
                                    <td>Type Of Job</td>
                                    <td>Date of Applied</td>
                                    <td>Expire Date</td>
                                    <td>Action</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- modal box for product view-->
<div class="modal fade bs-example-modal-lg item_view_model" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="product_details">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="product_model_title">

                </h3>
            </div>
            <div class="modal-body" >
                <div>

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist" id="product_model_navs">

                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content" id="product_model_details"></div>

                </div>
            </div>
            <div class="modal-footer" id="product_model_footer">
                
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function () {
    var hash = window.location.hash;
    if(hash){
        hash && $('ul.nav a[href="' + hash + '"]').tab('show');
    }
    $('.nav-tabs a').click(function (e) {
      $(this).tab('show');
      var scrollmem = $('body').scrollTop() || $('html').scrollTop();
      window.location.hash = this.hash;
      $('html,body').scrollTop(scrollmem);
    });
    
    $('#myprofile, #hire_table, #supplier_table, #mybuy_table, #sale_table, #wantedjob_table, #postedjob_table').DataTable({"aaSorting": []});
});
function passwordValidate()
{
    if($("#passwordform").valid())
    {
        $.ajax({
            type: "POST",
            url: "change-password",
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
        $(".error-message").hide();
    }
    else
    {
        $("#passwordform").validate().focusInvalid();
        $(".error-message").show();
    }
    return false;
}
function profileValidate() {
    if($("#profileform").valid())
    {
        $.ajax({
            type: "POST",
            url: "profileupdate",
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
        $(".profile_error-message").hide();
    }
    else
    {
        $("#profileform").validate().focusInvalid();
        $(".profile_error-message").show();
    }
    
    return false;
}
function deleteOrder(order_id)
{
    if (window.confirm("Do you really want to delete?")) { 
        $.ajax({
            url: "deleteorderbyid",
            type: "POST",
            data : {order_id: order_id, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" },
            dataType: 'json',
            success: function(data){
                if (data == "SUCCESS"){
                    $(".ordersuccess").show();
                    $(".ordersuccess").html('Status Changed Successfully.');
                    setInterval(function(){ location.reload(); }, 3000);					
                    }else{
                    $(".ordererror").show();
                    $(".ordererror").html('Status Change Failed!');
                    setInterval(function(){ location.reload(); }, 3000);			
                }
            }
        });
    }
}
//get product details and assign to modal box
function getProductdata(product_id)
{
    $.ajax({
        url: "getproductbyid",
        data : {product_id: product_id, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" },
        dataType: 'json',
        success: function(data){
            $("#product_model_title").html(data.title);
            $("#product_model_navs").html(data.navs);
            $("#product_model_details").html(data.details + data.images + data.load_charts);
            $('#no_of_days').attr("placeholder","Number of "+data.price_type+" *");
            $('#product_details').modal();
            $('[id^=carousel-selector-]').click(function () {
                var id_selector = $(this).attr("id");
                try {
                    var id = /-(\d+)$/.exec(id_selector)[1];
                    console.log(id_selector, id);
                    jQuery('#myCarousel').carousel(parseInt(id));
                    jQuery('#load_chart_carousel').carousel(parseInt(id));
                    } catch (e) {
                    console.log('Regex failed!', e);
                }
            });
            // When the carousel slides, auto update the text
            $('#myCarousel').on('slid.bs.carousel', function (e) {
                var id = $('.item.active').data('slide-number');
                $('#carousel-text').html($('#slide-content-'+id).html());
            });
            $('#load_chart_carousel').on('slid.bs.carousel', function (e) {
                var id = $('.item.active').data('slide-number');
                $('#carousel-text').html($('#slide-content-'+id).html());
            });
        }
    });
}
//delete product details 
function deleteProduct(product_id)
{
    if (window.confirm("Do you really want to delete?")) { 
        $.ajax({
            url: "deleteproductbyid",
            type: "POST",
            data : {product_id: product_id, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" },
            dataType: 'json',
            success: function(data){
                if (data == "SUCCESS"){
                    $(".productsuccess").show();
                    $(".productsuccess").html('Status Changed Successfully.');
                    setInterval(function(){ location.reload(); }, 3000);					
                    }else{
                    $(".producterror").show();
                    $(".producterror").html('Status Change Failed!');
                    setInterval(function(){ location.reload(); }, 3000);			
                }
            }
        });
    }
}
//delete Ad details 
function deleteAd(ad_id,ad_image_id)
{
    if (window.confirm("Do you really want to delete?")) { 
        $.ajax({
            url: "deleteadbyid",
            type: "POST",
            data : {ad_id: ad_id,ad_image_id: ad_image_id, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" },
            dataType: 'json',
            success: function(data){
                if (data == "SUCCESS"){
                    $(".adsuccess").show();
                    $(".adsuccess").html('Status Changed Successfully.');
                    setInterval(function(){ location.reload(); }, 3000);					
                    }else{
                    $(".aderror").show();
                    $(".aderror").html('Status Change Failed!');
                    setInterval(function(){ location.reload(); }, 3000);			
                }
            }
        });
    }
}

</script>