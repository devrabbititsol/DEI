<section role="main" class="content-body">
    <header class="page-header">
        <h2>PAYMENTS</h2>
        <div class="right-wrapper pull-right pr-xlg">
            <ol class="breadcrumbs">
                <li>
                    <a href="/admin">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Payments</span></li>
            </ol>
        </div>
    </header>

    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
            </div>

            <h2 class="panel-title">Total Payment's List</h2>
        </header>
        <div class="panel-body">
            <table class="table table-bordered table-striped mb-none" id="payment-datatable">
                <thead>
                    <tr>
                        <th>Payment Order Id</th>
                        <th>Actual Amount</th>
                        <th>Paid Amount</th>
                        <th>Payment Date</th>
                        <th>Payment Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($payments as $payment) {
                        echo '<tr class="gradeX">
                        <td>' . $payment['before_order_id'] . '</td>
                        <td>' . $payment['amount_actual'] . '</td>
                        <td>' . ucwords($payment['amount_paid']) . '</td>
                        <td>' . date("d-m-Y H:i:s", strtotime($payment['created_on'])) . '</td>
                        <td>' . ucwords($payment['payment_status']) . '</td>
                        </td><td class="actions text-center">
                            <a href="' . Yii::$app->params['SITE_URL'] . 'admin/viewpayment/' . $payment['payment_id'] . '"><i class="fa fa-eye"></i></a>
                        </td>
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
$(document).ready(function() {
    $('#payment-datatable').DataTable({"aaSorting": [],"oLanguage": {"sLengthMenu": "\_MENU_"}});
} );
</script>