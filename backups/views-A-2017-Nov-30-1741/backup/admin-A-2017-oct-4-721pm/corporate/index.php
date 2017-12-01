<section role="main" class="content-body">
    <header class="page-header">
        <h2>CORPORATE</h2>
        <div class="right-wrapper pull-right pr-xlg">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= Yii::$app->params['SITE_URL'] ?>admin">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Corporate</span></li>
            </ol>
        </div>
    </header>

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

    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
            </div>

            <h2 class="panel-title">Total Contact Request List</h2>
        </header>
        <div class="panel-body">
            <table class="table table-bordered table-striped mb-none" id="contact-datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($contact_details as $contact) {
                        echo '<tr class="gradeX">
                        <td>' . $i++ . '</td>
                        <td>' . ucwords($contact['contact_name']) . '</td>
                        <td>' . date("m-d-Y H:i:s", strtotime($contact['date_created'])) . '</td>
                        <td>';

                        if ($contact['contact_status'] == 0) {
                            echo '<span class="label label-warning">Not Contacted</span>';
                            echo '</td><td class="actions text-center">
                            <a href="' . Yii::$app->params['SITE_URL'] . 'admin/viewcontact/' . $contact['contact_id'] . '"><i class="fa fa-eye"></i></a>
                            <a onclick="return contactConfirmation();" href="' . Yii::$app->params['SITE_URL'] . 'admin/corporatestatuscontactactive/' . $contact['contact_id'] . '" class="delete-row"><i class="fa fa-check-square-o"></i></a>
                        </td>
                    </tr>';
                        } elseif ($contact['contact_status'] == 1) {
                            echo '<span class="label label-success">Contacted</span>';
                            echo '</td><td class="actions text-center">
                            <a href="' . Yii::$app->params['SITE_URL'] . 'admin/viewcontact/' . $contact['contact_id'] . '"><i class="fa fa-eye"></i></a>
                            <a onclick="return contactConfirmation();" href="' . Yii::$app->params['SITE_URL'] . 'admin/corporatestatuscontactinactive/' . $contact['contact_id'] . '" ><i class="fa fa-undo"></i></a>
                        </td>
                    </tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
            </div>

            <h2 class="panel-title">Total Feedback's List</h2>
        </header>
        <div class="panel-body">
            <table class="table table-bordered table-striped mb-none" id="feedback-datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($feedback_details as $feedback) {
                        echo '<tr class="gradeX">
                        <td>' . $i++ . '</td>
                        <td>' . ucwords($feedback['name']) . '</td>
                        <td>' . date("m-d-Y H:i:s", strtotime($feedback['date_created'])) . '</td>
                        <td>';

                        if ($feedback['feedback_status'] == 0) {
                            echo '<span class="label label-warning">Inactive</span>';
                            echo '</td><td class="actions text-center">
                            <a href="' . Yii::$app->params['SITE_URL'] . 'admin/viewfeedback/' . $feedback['feedback_id'] . '"><i class="fa fa-eye"></i></a>
                            <a onclick="return feedbackConfirmation();" href="' . Yii::$app->params['SITE_URL'] . 'admin/corporatestatusfeedbackactive/' . $feedback['feedback_id'] . '" class="delete-row"><i class="fa fa-check-square-o"></i></a>
                        </td>
                    </tr>';
                        } elseif ($feedback['feedback_status'] == 1) {
                            echo '<span class="label label-success">Active</span>';
                            echo '</td><td class="actions text-center">
                            <a href="' . Yii::$app->params['SITE_URL'] . 'admin/viewfeedback/' . $feedback['feedback_id'] . '"><i class="fa fa-eye"></i></a>
                            <a onclick="return feedbackConfirmation();" href="' . Yii::$app->params['SITE_URL'] . 'admin/corporatestatusfeedbackinactive/' . $feedback['feedback_id'] . '" ><i class="fa fa-undo"></i></a>
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
    $(document).ready(function () {
        $('#contact-datatable').DataTable({"aaSorting": [],"oLanguage": {"sLengthMenu": "\_MENU_"}});
        $('#feedback-datatable').DataTable({"aaSorting": [],"oLanguage": {"sLengthMenu": "\_MENU_"}});
    });

    function contactConfirmation() {
        return confirm("Are you sure to change contact status?");
    }

    function feedbackConfirmation() {
        return confirm("Are you sure to change feedback status?");
    }
</script>