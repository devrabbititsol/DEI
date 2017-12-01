<section role="main" class="content-body">
    <header class="page-header">
        <h2>ROLES & PERMISSIONS</h2>
        <div class="right-wrapper pull-right pr-xlg">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= Yii::$app->params['SITE_URL'] . 'admin' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Roles & Permissions Table</span></li>
            </ol>
        </div>
    </header>

    <!-- start: page -->

    <div class="row">

        <div class="col-md-12 col-lg-12">
            <?php if (Yii::$app->session->hasFlash('success')): ?>
                <div align="center" class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <?= Yii::$app->session->getFlash('success') ?>
                </div>
            <?php endif; ?>
            <?php if (Yii::$app->session->hasFlash('warning')): ?>
                <div align="center" class="alert alert-warning alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <?= Yii::$app->session->getFlash('warning') ?>
                </div>
            <?php endif; ?>
            <?php if (Yii::$app->session->hasFlash('error')): ?>
                <div align="center" class="alert alert-danger alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <?= Yii::$app->session->getFlash('error') ?>
                </div>
            <?php endif; ?>
            <form action="rolesubmit" method="post"> 
                <section id="cd-table">
                    <header class="cd-table-column">
                        <h2 style="font-size: 13px;">Permissions <i class="fa fa-arrow-down"></i> &nbsp; Roles <i class="fa fa-arrow-right"></i> </h2>
                        <ul>
                            <?php foreach ($permission_details as $permission) { ?>
                                <li><?php echo $permission['permission_display_name']; ?></li>
                            <?php } ?>
                        </ul>
                    </header>

                    <div class="cd-table-container">
                        <div class="cd-table-wrapper">
                            <?php
                            $j = 1;
                            foreach ($role_details as $role) {
                                ?>
                                <div class="cd-table-column">
                                    <h2><?php echo $role['role_name']; ?></h2>
                                    <ul>
                                        <?php
                                        $count = count($permission_details);
                                        for ($i = 1; $i <= $count; $i++) {
                                            ?>
                                            <li><input type="checkbox" <?php if (in_array($permission_details[$i - 1]['permission_id'], explode(",", $role['permission_ids']))) {
                                        echo "checked";
                                    } ?> name="<?php echo "check_" . $i . "_" . $role['role_id']; ?>" value="<?php echo $permission_details[$i - 1]['permission_id']; ?>"></li>                                      
                                <?php } ?>
                                    </ul>
                                </div> <!-- cd-table-column -->
                                <?php
                                $j++;
                            }
                            ?>
                        </div> <!-- cd-table-wrapper -->
                    </div> <!-- cd-table-container -->
                    <em class="cd-scroll-right"></em>
                </section> <!-- cd-table -->
                <div align="center">
                    <input type="submit" class="btn btn-success" value="Update Roles & Permissions">
                </div>
            </form>

        </div>

    </div>

    <!-- end: page -->
</section>

