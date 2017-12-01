<section role="main" class="content-body">
    <header class="page-header">
        <h2>PAYMENTS</h2>
        <div class="right-wrapper pull-right pr-xlg">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= Yii::$app->params['SITE_URL'] ?>admin">
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

            <h2 class="panel-title">Total Product Payment's List</h2>
        </header>
        <div class="panel-body">
            <table class="table table-bordered table-striped mb-none" id="product-payment-datatable">
                <thead>
                    <tr>
                        <th>Payment Order Id</th>
                        <th>Actual Amount</th>
                        <th>Paid Amount</th>
                        <th>Created On</th>
                        <th>Payment Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($product_payment_details as $payment) {
                        echo '<tr class="gradeX">
                        <td>' . $payment['before_order_id'] . '</td>
                        <td>' . number_format($payment['amount_actual'],2) . '</td>
                        <td>' . number_format($payment['amount_paid'],2) . '</td>
                        <td>' . date("m-d-Y H:i:s", strtotime($payment['created_on'])) . '</td>
                        <td>' . ucwords($payment['payment_status']) . '</td>';
                        if(\app\models\User::checkAccess('product_edit'))
                            echo '<td class="actions text-center">
                                    <a href="'.Yii::$app->params['SITE_URL'].'admin/editpayment/'.$payment['payment_id'].'"><i class="fa fa-pencil"></i></a>
                                    <a href="'.Yii::$app->params['SITE_URL'].'admin/viewpayment/'.$payment['payment_id'].'"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>';
                        else
                            echo '</td><td class="actions text-center">
                                        <a href="' . Yii::$app->params['SITE_URL'] . 'admin/viewpayment/' . $payment['payment_id'] . '"><i class="fa fa-eye"></i></a>
                                    </td></tr>';
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

            <h2 class="panel-title">Total Ads Payment's List</h2>
        </header>
        <div class="panel-body">
            <table class="table table-bordered table-striped mb-none" id="ad-payment-datatable">
                <thead>
                    <tr>
                        <th>Payment Order Id</th>
                        <th>Actual Amount</th>
                        <th>Paid Amount</th>
                        <th>Created On</th>
                        <th>Payment Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($ads_payment_details as $payment) {
                        echo '<tr class="gradeX">
                        <td>' . $payment['before_order_id'] . '</td>
                        <td>' . number_format($payment['amount_actual'],2) . '</td>
                        <td>' . number_format($payment['amount_paid'],2) . '</td>
                        <td>' . date("m-d-Y H:i:s", strtotime($payment['created_on'])) . '</td>
                        <td>' . ucwords($payment['payment_status']) . '</td>';
                        if(\app\models\User::checkAccess('product_edit'))
                            echo '<td class="actions text-center">
                                    <a href="'.Yii::$app->params['SITE_URL'].'admin/editpayment/'.$payment['payment_id'].'"><i class="fa fa-pencil"></i></a>
                                    <a href="'.Yii::$app->params['SITE_URL'].'admin/viewpayment/'.$payment['payment_id'].'"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>';
                        else
                            echo '</td><td class="actions text-center">
                                        <a href="' . Yii::$app->params['SITE_URL'] . 'admin/viewpayment/' . $payment['payment_id'] . '"><i class="fa fa-eye"></i></a>
                                    </td></tr>';
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
    $('#product-payment-datatable').DataTable({"aaSorting": [],"oLanguage": {"sLengthMenu": "\_MENU_"}});
    $('#ad-payment-datatable').DataTable({"aaSorting": [],"oLanguage": {"sLengthMenu": "\_MENU_"}});
} );
</script>