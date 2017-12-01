<section role="main" class="content-body">
    <header class="page-header">
        <h2>Users</h2>
        <div class="right-wrapper pull-right pr-xlg">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= Yii::$app->params['SITE_URL'] . 'admin' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Users</span></li>
            </ol>
        </div>
    </header>

    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
            </div>

            <h2 class="panel-title">All Users List</h2>
        </header>
        <div class="panel-body">
            <table class="table table-bordered table-striped mb-none" id="user-datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User ID</th>
                        <th>User Name</th>
                        <!--<th>Email</th>
                        <th>Phone Number</th>-->
                        <th>Last login</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($users as $user) {
                        echo '<tr class="gradeX">
                        <td>' . $i++ . '</td>
                        <td>' . $user['user_id'] . '</td>
                        <td>' . $user['user_name'] . '</td>';
                        /*<td>' . $user['email'] . '</td>
                        <td>' . $user['phone_number'] . '</td>*/
                        echo '<td>' . date('m-d-Y H:i:s', strtotime($user['last_login'])) . '</td>
                        <td>';

                        if ($user['user_status'] == 1) {
                            echo '<span class="label label-warning">Pending Verification</span>';
                            echo '</td><td class="actions text-center">
                            <a href="' . Yii::$app->params['SITE_URL'] . 'admin/viewuser/' . $user['user_id'] . '"><i class="fa fa-eye"></i></a>
                            <a href="' . Yii::$app->params['SITE_URL'] . 'admin/edituser/' . $user['user_id'] . '"><i class="fa fa-pencil"></i></a>
                            <a onclick="return confirmation();" href="' . Yii::$app->params['SITE_URL'] . 'admin/deleteuser/' . $user['user_id'] . '" class="delete-row"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>';
                        } elseif ($user['user_status'] == 2) {
                            echo '<span class="label label-success">Active</span>';
                            echo '</td><td class="actions text-center">
                            <a href="' . Yii::$app->params['SITE_URL'] . 'admin/viewuser/' . $user['user_id'] . '"><i class="fa fa-eye"></i></a>
                            <a href="' . Yii::$app->params['SITE_URL'] . 'admin/edituser/' . $user['user_id'] . '"><i class="fa fa-pencil"></i></a>
                            <a onclick="return confirmation();" href="' . Yii::$app->params['SITE_URL'] . 'admin/deleteuser/' . $user['user_id'] . '" class="delete-row"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>';
                        } elseif ($user['user_status'] == 3) {
                            echo '<span class="label label-danger">Inactive</span>';
                            echo '</td><td class="actions text-center">
                            <a href="' . Yii::$app->params['SITE_URL'] . 'admin/viewuser/' . $user['user_id'] . '"><i class="fa fa-eye"></i></a>
                            <a onclick="return confirmation();" href="' . Yii::$app->params['SITE_URL'] . 'admin/undouser/' . $user['user_id'] . '" ><i class="fa fa-undo"></i></a>
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
    $('#user-datatable').DataTable({"aaSorting": [],"oLanguage": {"sLengthMenu": "\_MENU_"}});
} );
</script>