<section role="main" class="content-body">
    <header class="page-header">
        <h2>Employees</h2>
        <div class="right-wrapper pull-right pr-xlg">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= Yii::$app->params['SITE_URL'] . 'admin' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Employees</span></li>
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
                <!--<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>-->
            </div>
            <div class="pull-right">
                <a href="<?php echo Yii::$app->params['SITE_URL'];?>admin/createemployee" class="btn btn-primary">Create</a>
            </div>

            <h2 class="panel-title">All Employees List</h2>
        </header>
        <div class="panel-body">
            <table class="table table-bordered table-striped mb-none" id="employee-datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Employee ID</th>
                        <th>Employee Name</th>
                        <!--<th>Email</th>
                        <th>Phone Number</th>-->
                        <th>Employee Type</th>
                        <th>Last login</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($employees as $employee) {
                        echo '<tr class="gradeX">
                        <td>' . $i++ . '</td>
                        <td>' . $employee['user_id'] . '</td>
                        <td>' . $employee['user_name'] . '<label style="display: none">'.$employee['email'].'</label></td>
                        <td>' . @$employee['role_name'] . '</td>';
                        /*<td>' . $employee['email'] . '</td>
                        <td>' . $employee['phone_number'] . '</td>*/
                        if($employee['last_login'])
                            echo '<td>' . date('m-d-Y H:i:s', strtotime($employee['last_login'])) . '</td>';
                        else
                            echo '<td></td>';
                        echo '<td>';

                        if ($employee['user_status'] == 1) {
                            echo '<span class="label label-warning">Pending Verification</span>';
                            echo '</td><td class="actions text-center">
                            <a href="' . Yii::$app->params['SITE_URL'] . 'admin/viewemployee/' . $employee['user_id'] . '"><i class="fa fa-eye"></i></a>
                            <a href="' . Yii::$app->params['SITE_URL'] . 'admin/editemployee/' . $employee['user_id'] . '"><i class="fa fa-pencil"></i></a>
                            <a onclick="return confirmation();" href="' . Yii::$app->params['SITE_URL'] . 'admin/deleteuser/' . $employee['user_id'] . '" class="delete-row"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>';
                        } elseif ($employee['user_status'] == 2) {
                            echo '<span class="label label-success">Active</span>';
                            echo '</td><td class="actions text-center">
                            <a href="' . Yii::$app->params['SITE_URL'] . 'admin/viewemployee/' . $employee['user_id'] . '"><i class="fa fa-eye"></i></a>
                            <a href="' . Yii::$app->params['SITE_URL'] . 'admin/editemployee/' . $employee['user_id'] . '"><i class="fa fa-pencil"></i></a>
                            <a onclick="return confirmation();" href="' . Yii::$app->params['SITE_URL'] . 'admin/deleteuser/' . $employee['user_id'] . '" class="delete-row"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>';
                        } elseif ($employee['user_status'] == 3) {
                            echo '<span class="label label-danger">Inactive</span>';
                            echo '</td><td class="actions text-center">
                            <a href="' . Yii::$app->params['SITE_URL'] . 'admin/viewemployee/' . $employee['user_id'] . '"><i class="fa fa-eye"></i></a>
                            <a onclick="return confirmation();" href="' . Yii::$app->params['SITE_URL'] . 'admin/undouser/' . $employee['user_id'] . '" ><i class="fa fa-undo"></i></a>
                        </td>
                    </tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- end: page -->
</section>

<script>
    function confirmation(){
        return confirm ("Are you sure to change user status?");
    }
</script>
<script>
$(document).ready(function() {
    $('#employee-datatable').DataTable({
        "aaSorting": [],
        "oLanguage": {"sLengthMenu": "\_MENU_"},
        "oSearch": {"sSearch": "<?php echo @$_GET['email']; ?>"},
        "aaSorting": [[ 4, "desc" ]]
        /*"fnInitComplete": function(oSettings, json) {
            $("#" + oSettings.sTableId+"_filter input").val("<?php echo @$_GET['email']; ?>");
         }*/
        });
} );
</script>