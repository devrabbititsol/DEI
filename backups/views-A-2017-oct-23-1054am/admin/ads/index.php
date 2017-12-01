<section role="main" class="content-body">
    <header class="page-header">
        <h2>Ads</h2>
        <div class="right-wrapper pull-right pr-xlg">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= Yii::$app->params['SITE_URL'] ?>admin">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Ads</span></li>
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
    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <!--a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a-->
            </div>

            <h2 class="panel-title">Total Ads List</h2>
        </header>
        <div class="panel-body">
            <table class="table table-bordered table-striped mb-none" id="product_list">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Ad Title</th>
                        <th>Created By</th>
                        <th>Created On</th>
                        <th>Expiry On</th>
                        <th>Assigned to</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($ads as $ad) {
                        echo '<tr class="gradeX">
                        <td>' . $i++ . '</td>
                        <td>' . ucwords($ad['ad_title']) . '</td>
                        <td>' . ucwords($ad['ad_name']) . '</td>';
                        echo '<td>' . date('m-d-Y H:i:s', strtotime($ad['date_created'])) . '</td>
                        <td>' . date('m-d-Y H:i:s', strtotime($ad['ad_expire'])) . '</td>
                        <td>' . ucwords($ad['employee_name']) . '</td>
                        <td>';

                        if($ad['status_updated_by']) $status_updatedby = ' by '.$ad['status_updated_by']; else $status_updatedby = '';
                            
                        if ($ad['ad_status'] == 0)
                            echo '<span class="label label-warning">Pending'.$status_updatedby.'</span>';
                        elseif ($ad['ad_status'] == 1)
                            echo '<span class="label label-success">Approved'.$status_updatedby.'</span>';
                        elseif ($ad['ad_status'] == 2)
                            echo '<span class="label label-danger">Rejected'.$status_updatedby.'</span>';
                        elseif ($ad['ad_status'] == 3)
                            echo '<span class="label label-default">Deleted</span>';

                        echo '<td class="actions text-center">
                            <a href="' . Yii::$app->params['SITE_URL'] . 'admin/viewad/' . $ad['ad_id'] . '"><i class="fa fa-eye"></i></a>
                            <a href="' . Yii::$app->params['SITE_URL'] . 'admin/editad/' . $ad['ad_id'] . '"><i class="fa fa-pencil"></i></a>';
                        if ($ad['ad_status'] != 3) {
                            echo '<a onclick="adDelete('.$ad['ad_id'].')" class="delete-row"><i class="fa fa-trash-o"></i></a>';
                        }
                        echo '</td>
                    </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>


    <!-- end: page -->
</section>
<script>
    $(document).ready(function () {
        $("#product_list").DataTable({
            "aaSorting": [], "oLanguage": {"sLengthMenu": "\_MENU_"}
        });
    });

 function adDelete(ad_id)
    {
        if (window.confirm("Do you really want to Delete?")) {
            $.ajax({
                url: "<?= Yii::$app->params['SITE_URL'] ?>admin/deletead",
                type: "POST",
                data: {ad_id: ad_id, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>"},
                dataType: 'json',
                success: function (data) {
                    if (data) {
                        window.location.href = "<?= Yii::$app->params['SITE_URL'] ?>admin/ads/";
                    }
                }
            });
        }
    }
</script>
