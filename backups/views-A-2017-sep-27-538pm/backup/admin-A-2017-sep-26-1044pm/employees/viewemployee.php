<section role="main" class="content-body">
    <header class="page-header">
        <h2>Employee Details</h2>
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
                <li><span>Employee Details</span></li>
            </ol>
        </div>
    </header>

    <!-- start: page -->


    <div class="row">

        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                </div>

                <h2 class="panel-title">Employee Details</h2>
            </header>
            <div class="panel-body">
                <div>
                    <h4 class="mb-xlg">Employee Details</h4>
                    <div class="col-md-8">

                        <div class="form-group">
                            <label class="col-sm-4 control-label">Name </label>
                            <label class="col-sm-2 control-label"> : </label>
                            <div class="col-sm-6">
                                <label><?php echo ucwords($employee['user_name']); ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Mobile Number </label>
                            <label class="col-sm-2 control-label"> : </label>
                            <div class="col-sm-6">
                                <label><?php echo $employee['phone_number']; ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Email Address </label>
                            <label class="col-sm-2 control-label"> : </label>
                            <div class="col-sm-6">
                                <label><?php echo $employee['email']; ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Company Name </label>
                            <label class="col-sm-2 control-label"> : </label>
                            <div class="col-sm-6">
                                <label><?php echo ucwords($employee['company_name']); ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Designation </label>
                            <label class="col-sm-2 control-label"> : </label>
                            <div class="col-sm-6">
                                <label><?php echo $employee['designation']; ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Company Email </label>
                            <label class="col-sm-2 control-label"> : </label>
                            <div class="col-sm-6">
                                <label><?php echo $employee['company_email']; ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Company Address </label>
                            <label class="col-sm-2 control-label"> : </label>
                            <div class="col-sm-6">
                                <label><?php echo $employee['company_address']; ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Employee Type </label>
                            <label class="col-sm-2 control-label"> : </label>
                            <div class="col-sm-6">
                                <label><?php echo $employee['role_name']; ?></label>
                            </div>
                        </div>
                        <?php if($employee['zone_name']!= '') { ?>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Zone </label>
                            <label class="col-sm-2 control-label"> : </label>
                            <div class="col-sm-6">
                                <label><?php echo $employee['zone_name']; ?></label>
                            </div>
                        </div>
                        <?php } if($employee['state_name']!= '') {?>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">State </label>
                            <label class="col-sm-2 control-label"> : </label>
                            <div class="col-sm-6">
                                <label><?php echo $employee['state_name']; ?></label>
                            </div>
                        </div>
                        <?php } if($employee['district_name']!= '') {?>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">District </label>
                            <label class="col-sm-2 control-label"> : </label>
                            <div class="col-sm-6">
                                <label><?php echo $employee['district_name']; ?></label>
                            </div>
                        </div>
                        <?php } if($employee['territory_name']!= '') {?>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Territory </label>
                            <label class="col-sm-2 control-label"> : </label>
                            <div class="col-sm-6">
                                <label><?php echo $employee['territory_name']; ?></label>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">User Status </label>
                            <label class="col-sm-2 control-label"> : </label>
                            <div class="col-sm-6">
                                <label><?php
                                    if ($employee['user_status'] == 1)
                                        echo '<span class="label label-warning">Pending Verification</span>';
                                    elseif ($employee['user_status'] == 2)
                                        echo '<span class="label label-success">Active</span>';
                                    elseif ($employee['user_status'] == 3)
                                        echo '<span class="label label-danger">Inactive</span>';
                                    ?></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
    <!-- end: page -->
</section>
