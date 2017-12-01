<section role="main" class="content-body">
    <header class="page-header">
        <h2>Get Quote</h2>
        <div class="right-wrapper pull-right pr-xlg">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= Yii::$app->params['SITE_URL'] ?>admin">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Get Quote</span></li>
            </ol>
        </div>
    </header>


    <div class="clearfix"></div>

    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
            </div>

            <h2 class="panel-title">Get Quote List</h2>
        </header>
        <div class="panel-body">
            <table class="table table-bordered table-striped mb-none" id="getquote_list">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Sub Category</th>
                        <th>Quote for</th>
                        <th>Assigned To</th>
                        <th>Created on</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($quotes as $quote) {
                    echo '<tr class="gradeX">
                        <td>'.$quote['category_name'].'</td>
                        <td>'.$quote['sub_category_name'].'</td>
                        <td>'.ucfirst($quote['quotation_type']).'</td>
                        <td>'.$quote['employee_name'].'</td>
                        <td>'.date('m-d-Y H:i:s', strtotime($quote['date_created'])).'</td>
                        <td>';
                    if($quote['status_updated_by']) $status_updatedby = ' by '.$quote['status_updated_by']; else $status_updatedby = '';
                    
                    if($quote['quote_status'] == 0)
                        echo '<span class="label label-warning">Pending'.$status_updatedby.'</span>';
                    elseif($quote['quote_status'] == 1)
                        echo '<span class="label label-success">Approved'.$status_updatedby.'</span>';
                    elseif($quote['quote_status'] == 2)
                        echo '<span class="label label-danger">Rejected'.$status_updatedby.'</span>';
                    elseif($quote['quote_status'] == 3)
                        echo '<span class="label label-default">Deleted</span>';
                    else
                        echo $quote['quote_status'];
                    /*elseif($product['product_status'] == 4)
                        echo '<span class="label label-success">Approved by sales manger</span>';
                    elseif($product['product_status'] == 5)
                        echo '<span class="label label-default">Rejected</span>';
                    elseif($product['product_status'] == 6)
                        echo '<span class="label label-info">Re-Initialized</span>';
                    elseif($product['product_status'] == 7)
                        echo '<span class="label label-info">Closed</span>';*/
                    
                    echo '<td class="actions text-center">
                            <a href="'.Yii::$app->params['SITE_URL'].'admin/viewquote/'.$quote['quotation_id'].'"><i class="fa fa-eye"></i></a>
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
    $("#getquote_list").DataTable({
        "aaSorting": [],"oLanguage": {"sLengthMenu": "\_MENU_"}
    });
});
</script>
