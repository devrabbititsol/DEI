<?php 
//remove Advt. images session data when refresh
$session = Yii::$app->session;
if($session->has('advt_images'))
    $session->remove('advt_images');
if($session->has('advt_images_names'))
    $session->remove('advt_images_names');
?>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Ads</h2>
        <div class="right-wrapper pull-right pr-xlg">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= Yii::$app->params['SITE_URL'] ?>admin">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Ads</span></li>
            </ol>
        </div>
    </header>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <a href="<?= Yii::$app->params['SITE_URL'] ?>admin/ads" class="mb-xs mt-xs mr-xs btn btn-primary btn-block">Back To Advt. List</a>
        </div>
    </div>
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
    
    <!-- start: page -->
    
    <form class="form-horizontal form-dtls" method="post" action="<?= Yii::$app->params['SITE_URL'] ?>admin/updatead" id="editad">
        <div class="col-md-12">
        <div class="tabs tabs-danger">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#popular4" data-toggle="tab" aria-expanded="true"><i class="fa fa-align-left"></i> Ad Details</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="popular4" class="tab-pane active">
                    
                        <section class="panel">

                            <h2 class="panel-title">Ad Details</h2>
                            <input type="hidden" name="ad_id" value="<?= $ad['ad_id'] ?>"  >
                            <div class="panel-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Title : </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" placeholder="Title" id="title" value="<?= $ad['ad_title'] ?>" name="title" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Comments/Queries : </label>
                                        <div class="col-sm-8">
                                            <textarea type="text" class="form-control" placeholder="Comments/Queries" id="comments" name="comments"><?= $ad['description']?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Website URL : </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" placeholder="Title" id="weblink" value="<?= $ad['ad_weblink'] ?>" name="weblink" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Expiry Date : </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control datepicker" readonly style="cursor:pointer;" placeholder="Select a date" id="expire" value="<?= date("m-d-Y",strtotime($ad['ad_expire'])) ?>" name="expire" required>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                        </section>
                    
                </div>
            </div>
        </div>
    </div>
    
    <?php 
    $gallery = ''; $load_charts =''; $editimageurl = Yii::$app->params['SITE_URL'] ."uploads/noimage.png";$editimagename = '';
    foreach($ad_images as $index=>$image)
    {
        $image = (object)$image;

            $imgname = $image->ad_image_name;
            
            $gallery .= '<div class="imagealt"><a class="pull-left mb-xs" href="'.$image->ad_image_url.'">
                            <div class="img-responsive">
                                <img src="'.$image->ad_image_url.'">
                            </div>
                        </a>
                        <div class="imagealtctrl">
                        <i href="#editadimage" data-toggle="modal" data-target="#editadimage" edit-img-name="'.$imgname.'" edit-img-url="'.$image->ad_image_url.'" class="edit-img-url-cls"><i class="fa fa-pencil"></i></i>
                        <i onclick="deleteadImage('.$image->ads_image_id.')"><i class="fa fa-trash"></i></i>
                        <i download-img-url="'.$image->ad_image_url.'" class="download-img-url-cls"><i class="fa fa-download"></i></i></div></div>';
    }
    ?>

    <div class="col-md-12">
        <div class="tabs tabs-danger">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#recent4" data-toggle="tab" aria-expanded="false"><i class="fa fa-image"></i> Images</a>
                </li>
            </ul>
            <div class="tab-content">

                <div id="recent4" class="tab-pane active">
                        <section class="panel">

                            <h2 class="panel-title">Edit Images</h2>

                            <div class="panel-body">
                                <div class="popup-gallery">
                                    <?= $gallery ?>
                                </div>
                                
                            </div>

                        </section>
                    <!--div class="form-group">
                               <input type="hidden" id="advt_images" required class="form-control" placeholder="Upload Your Images " name="advt_images">
                          </div>
                        <div class="dropzone dz-square dz-clickable" id="advtimages">
                            <div class="dz-default dz-message"><span>Drop files here to upload</span></div>
                        </div-->
                </div>

            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-12">
        <footer class="panel-footer text-center">
            <button type="submit" class="btn btn-danger">Submit</button>            
            <a href="<?= Yii::$app->params['SITE_URL'] ?>admin/ads" type="reset" class="btn btn-default">Cancel</a>
        </footer>
    </div>
</form>
    <div class="clearfix mb-xlg"></div>
</section>
<div class="modal fade wapop" id="editadimage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Image Edit</h4>
			</div>
			<div class="modal-body">
                            
				<div align="center">
                                    <img class="showDefault img-responsive" src="<?php echo $editimageurl; ?>" id="cropbox" />
					Drag mouse to start cropping
					<!-- This is the form that our event handler fills -->
					<form method="post" id="formCrop" >
						<input type="hidden" value="<?php echo $editimagename; ?>" id="img" name="image" />
						<input type="hidden" value="<?php echo $editimageurl; ?>" id="imgUrl" name="imageurl" />
						<input type="hidden" value="<?php echo $editimageurl; ?>" id="editUrl" name="editurl" />
						<input type="hidden" value="" id="orderEdit" name="editorder" />
						<input type="hidden" id="x" name="x" />
						<input type="hidden" id="y" name="y" />
						<input type="hidden" id="w" name="w" />
						<input type="hidden" id="h" name="h" />
                                                <div class="row">
                                                <div class="form-inline">
                                                    <div class="form-group">
                                                    <input class="form-control" type="text" pattern="[0-9]{2,}" id="width" name="width" placeholder="width"/>
                                                    </div>
                                                    <div class="form-group">
                                                    <input class="form-control" type="text" pattern="[0-9]{2,}" id="height" name="height" placeholder="height" />
                                                    </div>
                                                    <input type="button" name="resize" id="resize" onclick="return resizeDetails();" value="Resize Image" class="btn btn-large btn-inverse" />
                                                </div>
                                                </div>
                                                <div class="row">
                                                <div class="form-inline">
                                                    <div class="form-group">
                                                    <input class="form-control" type="file" id="files" name="files" />
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="form-control" type="radio" name="position" value="topleft"> Top Left
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="form-control" type="radio" name="position" value="topright"> Top Right
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="form-control" type="radio" name="position" value="center"> Center
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="form-control" type="radio" name="position" value="bottomleft"> Bottom Left
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="form-control" type="radio" name="position" value="bottomleft"> Bottom Right
                                                    </div>
                                                    <input type="button" name="resize" id="watermark" onclick="return watermarkDetails();" value="Watermark Image" class="btn btn-large btn-inverse" />
                                                </div>
                                                </div>
                                                <div class="row">
                                                <div class="form-inline">
                                                    
                                                    <div class="form-group">
                                                    <input type="button" name="crop" id="crop" onclick="return checkCoords();" value="Crop Image" class="btn btn-large btn-inverse" />
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="button" name="saveimage" id="saveimage" onclick="return saveImagechanges();" value="Save Image" class="btn btn-large btn-inverse" />
                                                    </div>
                                                </div>
                                                </div>
                                                
					</form>
					<input type="reset" style="display:none;" name="resetImage" id="resetImage" onclick="return resetImage();" value="Reset Changes" class="btn btn-large btn-inverse" />
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function () {
    $('.datepicker').datepicker({ startDate: "today",autoclose: true });
    $('#editad').validate();
        
        var maxnofiles = 7 ;
 /*       
        Dropzone.autoDiscover = false;
        $("div#advtimages").dropzone({
            maxFiles: maxnofiles,
            url: "<?= Yii::$app->params['SITE_URL'] ?>uploadadvtimages",
            paramName: 'advt_images',
            acceptedFiles: "image/jpeg,image/png,image/gif",
            maxFilesize: 2,
            init: function () {
                this.on("maxfilesexceeded", function (file) {
                    alert("No more files please! Max "+maxfilesize+" Files Allowed");
                });
                this.on('sending', function (file, xhr, formData) {
                    formData.append('advt_images', $("#advt_images").val());
                    $(".advtimage").attr("disabled", true);
                });
                this.on("removedfile", function (file) {
                    $.ajax({
                        url: '<?= Yii::$app->params['SITE_URL'] ?>deleteadvtimages',
                        type: "POST",
                        dataType:'html',
                        data: {'filetodelete': file.name, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>"},
                        success: function (data) {
                            if (data != "") {
                                $("#advt_images").val('uploaded');
                            } else {
                                $("#advt_images").val('');
                                $("#advtimages").addClass('error');
                                $(".error-message").show();
                            }
                        }
                    });
                });
            },
            success: function (data) {
                $("#advt_images").val('uploaded');
            }
        }); */
});

// if model is custom
$('#model_id').on("change",function(){
    if($('#model_id option:selected').text()=="CUSTOM"){
        $(".model_other").show();
    }
    else {$(".model_other").hide();
    }
});

//onclick for image edit
$( ".edit-img-url-cls" ).click(function() {
    var imgurl = $(this).attr('edit-img-url');
    var imgname = $(this).attr('edit-img-name');
    $('#imgUrl').val(imgurl);
    $('#editUrl').val(imgurl);
    $('#cropbox').attr('src', imgurl);
    $('#croppedimg').attr('src', imgurl);
    $('.showDefault').attr('src', imgurl);
    $('.jcrop-holder div div img').attr('src', imgurl);
    $('#img').val(imgname);
    
    $('#cropbox').Jcrop({
        //aspectRatio: 1,
        onSelect: updateCoords,
        boxWidth: 800,
        boxHeight: 600
    });
});

//function to delete image
function deleteadImage(ad_image_id)
{
    if (window.confirm("Do you really want to delete?")) { 
        $.ajax({
            url: "<?= Yii::$app->params['SITE_URL'] ?>admin/deleteadimage",
            data : {ad_image_id: ad_image_id, "_csrf": "<?php echo Yii::$app->request->csrfToken; ?>" },
            dataType: 'html',
            type: "POST",
            success: function(response){
                window.location.reload(true);
            }
        });
    }
}
//function to delete image 
$( ".download-img-url-cls" ).click(function() {
    var imgurl = $(this).attr('download-img-url');
    var downloadimg = "<?= Yii::$app->params['SITE_URL'] ?>admin/downloadproductimage?image_url="+imgurl;
    window.open(downloadimg, '_blank'); 
});

//reload page after model close
$('#editadimage').on('hidden.bs.modal', function (e) {
    $('#cropbox').data('Jcrop').destroy();
});
</script>