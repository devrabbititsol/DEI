<?php 
if(!isset($_GET['order_type']))
    $order_type = 'hire';
else
    $order_type = $_GET['order_type'];

if($order_type == 'buy')
    $order_type = 'buy';
else if($order_type == 'both')
    $order_type = 'Hire/Buy';
?>
<section role="main" class="content-body">
    <header class="page-header">
        <h2><?= strtoupper($order_type) ?></h2>
        <div class="right-wrapper pull-right pr-xlg">
            <ol class="breadcrumbs">
                <li>
                    <a href="/admin">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Products</span></li>
                <li><span><?= strtoupper($order_type) ?></span></li>
            </ol>
        </div>
    </header>

   
    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
            </div>

            <h2 class="panel-title">Total <?= ucfirst($order_type) ?> List</h2>
        </header>
        <div class="panel-body">
            <table class="table table-bordered table-striped mb-none" id="orders_list">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Category</th>
                        <!--<th>Sub Category</th>
                        <th>Model</th>-->
                        <th>Assigned to</th>
                        <th>Created on</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($orders as $order) {
                    echo '<tr class="gradeX">
                        <td>'.$order['manual_order_code'].'</td>
                        <td>'.$order['category_name'].'</td>
                        <td>'.$order['employee_name'].'</td>
                        <td>'.date('m-d-Y H:i:s', strtotime($order['date_created'])).'</td><td>';
                            
                            /*'<td>'.$order['sub_category_name'].'</td>
                        <td>'.$order['model_name'].'</td>
                        <td>';*/
                    
                    if($order['order_status'] == 0)
                        echo '<span class="label label-warning">Pending</span>';
                    elseif($order['order_status'] == 1)
                        echo '<span class="label label-success">Approved</span>';
                   elseif($order['order_status'] == 2)
                       echo '<span class="label label-danger">Rejected</span>';
                   elseif($order['order_status'] == 3)
                       echo '<span class="label label-default">Deleted</span>';
                 /*        echo '<span class="label label-warning">Approved by sales executive</span>';
                    elseif($order['order_status'] == 4)
                        echo '<span class="label label-success">Approved</span>';
                    elseif($order['order_status'] == 5)
                        echo '<span class="label label-default">Rejected</span>';
                    elseif($order['order_status'] == 6)
                        echo '<span class="label label-info">Re-Initialized</span>';
                    elseif($order['order_status'] == 7)     */
                        //echo '<span class="label label-danger">Rejected</span>';
                    
                    echo '<td class="actions text-center">
                            <a href="'.Yii::$app->params['SITE_URL'].'admin/vieworder/'.$order['order_id'].'"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>';
                    } ?>
                </tbody>
            </table>
        </div>
    </section>


    <!-- end: page -->
</section>
<script>
$(document).ready(function() {   
    $("#orders_list").DataTable({
        "aaSorting": [],"oLanguage": {"sLengthMenu": "\_MENU_"}
    });
});
</script>
