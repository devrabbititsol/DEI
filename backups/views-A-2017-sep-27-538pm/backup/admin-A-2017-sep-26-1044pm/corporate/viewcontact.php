<section role="main" class="content-body">
    <header class="page-header">
        <h2>Contact Details</h2>
        <div class="right-wrapper pull-right pr-xlg">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= Yii::$app->params['SITE_URL'] . 'admin' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><a href="<?= Yii::$app->params['SITE_URL'] . 'admin/corporate' ?>">
                        <i class="fa fa-industry"></i> Corporate
                    </a>
                </li>
                <li><span>Contact Details</span></li>
            </ol>
        </div>
    </header>

    <!-- start: page -->


    <div class="row">

        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                </div>

                <h2 class="panel-title">Contact Details</h2>
            </header>
            <div class="panel-body">
                <div>
                    <h4 class="mb-xlg">Contact Details</h4>
                    <div class="col-md-12">

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Name </label>
                            <label class="col-sm-1 control-label"> : </label>
                            <div class="col-sm-8">
                                <label><?php echo ucwords($contact['contact_name']); ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Mobile Number </label>
                            <label class="col-sm-1 control-label"> : </label>
                            <div class="col-sm-8">
                                <label><?php echo $contact['phone']; ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Email Address </label>
                            <label class="col-sm-1 control-label"> : </label>
                            <div class="col-sm-8">
                                <label><?php echo $contact['email']; ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Message </label>
                            <label class="col-sm-1 control-label"> : </label>
                            <div class="col-sm-8">
                                <label><?php echo $contact['message']; ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Date </label>
                            <label class="col-sm-1 control-label"> : </label>
                            <div class="col-sm-8">
                                <label><?php echo $contact['date_created']; ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Status </label>
                            <label class="col-sm-1 control-label"> : </label>
                            <div class="col-sm-8">
                                <label><?php
                                    if ($contact['contact_status'] == 0)
                                        echo '<span class="label label-warning">Not Contacted</span>';
                                    elseif ($contact['contact_status'] == 1)
                                        echo '<span class="label label-success">Contacted</span>';
                                    ?></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="clearfix mb-xlg"></div>

    <div class="row">
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle=""></a>
                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss=""></a>
                </div>

                <h2 class="panel-title">Comments</h2>
            </header>
            <div class="panel-body">
                <?php if (!empty($comments)) { ?>
                    <div class="scrollable visible-slider has-scrollbar" data-plugin-scrollable="" style="height: 400px;">
                        <div class="scrollable-content" tabindex="0" style="right: -17px;">
                            <div class="chat">   
                                <div class="chat-history">
                                    <ul class="chat-ul">
                                        <?php
                                        foreach ($comments as $index => $comment) {
                                            if ($index % 2 == 0)
                                                echo '<li>
                                                    <div class="message-data">
                                                        <span class="message-data-name"><i class="fa fa-circle you"></i> ' . $comment['user_name'] . ' on ' . date('m-d-Y H:i:s', strtotime($comment['date_created'])) . '</span>
                                                    </div>
                                                    <div class="message you-message">' . $comment['comment_description'] . '</div>
                                                </li>';
                                            else
                                                echo '<li class="clearfix">
                                                    <div class="message-data align-right">
                                                        <span class="message-data-name"> ' . $comment['user_name'] . ' on ' . date('m-d-Y H:i:s', strtotime($comment['date_created'])) . '</span> <i class="fa fa-circle me"></i>
                                                    </div>
                                                    <div class="message me-message float-right">' . $comment['comment_description'] . '</div>
                                                </li>';
                                        }
                                        ?>

                                    </ul>


                                </div> <!-- end chat-history -->

                            </div>
                        </div>
                    </div>
                    <?php
                }
                else {
                    echo "<center><strong>No Comments</strong></center>";
                }
                ?>
            </div>
            <footer class="panel-footer">
                <form method="post" action="<?= Yii::$app->params['SITE_URL'] ?>admin/addcomment" name="addcomment" id="addcomment">
                    <input type="hidden" name="comment_belongs_to" id="comment_belongs_to" value="<?php echo $contact['contact_id']; ?>">
                    <input type="hidden" name="comment_type" id="comment_type" value="6"><!-- comment type -->
                    <textarea name="comment_description" id="comment_description" class="form-control mb-xl" placeholder="Enter your comments here.." required="required" minlength="5"></textarea>
                    <button class="btn btn-primary">Submit the comment </button>
                </form>
            </footer>
        </section>
    </div>

    <!-- end: page -->
</section>
<script>
$(document).ready(function () {
    $("#addcomment").validate();
});
</script>
