<section role="main" class="content-body">
    <header class="page-header">
        <h2>Zones</h2>
        <div class="right-wrapper pull-right pr-xlg">
            <ol class="breadcrumbs">
                <li>
                    <a href="/admin">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Zones</span></li>
                <!--<li><span></span></li>-->
            </ol>
        </div>
    </header>
    

    <div class="clearfix"></div>

    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                
                <!--<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>-->
            </div>
            <div class="pull-right">
                <a href="<?php echo Yii::$app->params['SITE_URL'];?>admin/createzone" class="btn btn-primary">Create</a>
            </div>

            <h2 class="panel-title">Total Zones List</h2>
        </header>
        <div class="panel-body">
            <table class="table table-bordered table-striped mb-none" id="zones-datatable">
                <thead>
                    <tr>
                        <th>Zone id</th>
                        <th>Zone</th>
                        <th>Created on</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($zones as $zone) {
                    echo '<tr class="gradeX">
                        <td>'.$zone['zone_id'].'</td>
                        <td>'.$zone['zone_name'].'</td>
                        <td>'.date('d-m-Y', strtotime($zone['date_created'])).'</td>
                        <td>';
                    
                    if($zone['zone_status'] == 1)
                        echo '<span class="label label-success">Active</span>';
                    elseif($zone['zone_status'] == 0)
                        echo '<span class="label label-danger">Inactive</span>';
                    
                    echo '<td class="actions text-center">
                            <a href="'.Yii::$app->params['SITE_URL'].'admin/editzone/'.$zone['zone_id'].'"><i class="fa fa-pencil"></i></a>
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
    $(document).ready(function () {
        $('#zones-datatable').DataTable({"oLanguage": {"sLengthMenu": "\_MENU_"}});
    });
</script>