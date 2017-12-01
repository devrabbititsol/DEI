<section role="main" class="content-body">
    <header class="page-header">
        <h2>States</h2>
        <div class="right-wrapper pull-right pr-xlg">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= Yii::$app->params['SITE_URL'] ?>admin">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>States</span></li>
                <!--<li><span></span></li>-->
            </ol>
        </div>
    </header>
    

    <div class="clearfix"></div>
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
                <a href="<?php echo Yii::$app->params['SITE_URL'];?>admin/createstate" class="btn btn-primary">Create</a>
            </div>

            <h2 class="panel-title">Total States List</h2>
        </header>
        <div class="panel-body">
            <table class="table table-bordered table-striped mb-none" id="state-datatable">
                <thead>
                    <tr>
                        <th>State id</th>
                        <th>State</th>
                        <th>Zone</th>
                        <th>Created on</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($states as $state) {
                    echo '<tr class="gradeX">
                        <td>'.$state['state_id'].'</td>
                        <td>'.$state['state_name'].'</td>
                        <td>'.$state['zone_name'].'</td> 
                        <td>'.date('d-m-Y', strtotime($state['date_created'])).'</td>
                        <td>';
                    
                    if($state['state_status'] == 1)
                        echo '<span class="label label-success">Active</span>';
                    elseif($state['state_status'] == 0)
                        echo '<span class="label label-danger">Inactive</span>';
                    
                    echo '<td class="actions text-center">
                            <a href="'.Yii::$app->params['SITE_URL'].'admin/editstate/'.$state['state_id'].'"><i class="fa fa-pencil"></i></a>
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
        $('#state-datatable').DataTable({"oLanguage": {"sLengthMenu": "\_MENU_"}});
    });
</script>