var base_url = document.querySelectorAll('head > meta[name="data-base-url"]');
var base_content = base_url[0].getAttribute('content');

function resizeDetails()
{
    if (parseInt($('#width').val())) {

        $.ajax({
            type: "POST",
            url: base_content + "admin/resize",
            data: $('#formCrop').serialize(),
            dataType: 'html',
            success: function (response) {
                var order = $('#orderEdit').val();
                if (order != "") {
                    $('#orderEdit').val(order + ',' + response);
                } else {
                    $('#orderEdit').val(response);
                }

                $('#editUrl').val(response);
                $('#cropbox').attr('src', response);
                $('#croppedimg').attr('src', response);
                $('.showDefault').attr('src', response);
                $('#resetImage').show();
                $('.jcrop-holder div div img').attr('src', response);
                var img = $('<img src="' + $('#editUrl').val() + '"/>').load(function () {
                    if (this.width < 800 || this.height < 600)
                    {
                        $('#cropbox').data('Jcrop').destroy();
                        $('#cropbox').Jcrop({
                            onSelect: updateCoords,
                            boxWidth: this.width,
                            boxHeight: this.height,
                            trueSize: [this.width, this.height]
                        });
                    }
                });

            }
        });

    } /*else {
     alert('Please select a crop region then press submit.');
     return false;
     }*/
}

function watermarkDetails()
{
    var data = new FormData($("#formCrop")[0]);
    $.each(files, function (key, value)
    {
        data.append(key, value);
	});
	
    if ($('#files').val() != "" && $("input[name=position]").is(":checked")) {
		
        $.ajax({
            type: "POST",
            url: base_content+"admin/watermark",
            data: data,
            dataType: 'html',
            processData: false,
            contentType: false,
            success: function (response) {
                var order = $('#orderEdit').val();
                if (order != ""){
                        $('#orderEdit').val(order+','+response);

                        }else{
                        $('#orderEdit').val(response);

                }
			
                $('#editUrl').val(response);
                $('#cropbox').attr('src', response);
                $('#croppedimg').attr('src', response);
                $('.showDefault').attr('src', response);
                $('#resetImage').show();
                $('.jcrop-holder div div img').attr('src', response);
                var img = $('<img src="'+$('#editUrl').val()+'"/>').load(function(){
                    if(this.width<800 || this.height<600)
                    {
                        
                        $('#cropbox').data('Jcrop').destroy();
                        $('#cropbox').Jcrop({
                            onSelect: updateCoords,
                            boxWidth: this.width,
                            boxHeight: this.height,
                            trueSize: [this.width, this.height]
                        });
                    }
                });
            }
	});
		
    } else if ($('#files').val() != "" && !$("input[name=position]").is(":checked")) {
    alert('Please select a Position then press submit.');
    return false;
    } else if ($('#files').val() == "" && $("input[name=position]").is(":checked")) {
    alert('Please select a File then press submit.');
    return false;
    } else {
    alert('Please select Options then press submit.');
    return false;
    }
}
;
/*
function resetWatermark()
{
    var data = new FormData($("#formCrop")[0]);
    $.each(files, function (key, value)
    {
        data.append(key, value);
	});
	
    $.ajax({
        type: "POST",
        url: base_content+"admin/watermarkdelete",
        data: data,
        dataType: 'html',
        processData: false,
        contentType: false,
        success: function (response) {
            $('#cropbox').attr('src', $('#imgUrl').val());
		}
	});
    //location.reload();
}
;

function resetSize()
{
    $.ajax({
        type: "POST",
        url: base_content+"admin/sizedelete",
        data: $('#formCrop').serialize(),
        dataType: 'html',
        success: function (response) {
            $('#sizebox').attr('src', $('#imgUrl').val());
            $('#croppedimg').attr('src', $('#imgUrl').val());
		}
	});
}
;
*/
function updateCoords(c)
{
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
	
}

function updatewidth(width)
{
    if(width>800)
        return 800;
    else
        return width;
}
function updateheight(height)
{
    if(height>600)
        return 600;
    else
        return height;
}
function checkCoords()
{
    if (parseInt($('#w').val())) {
		
        $.ajax({
            type: "POST",
            url: base_content+"admin/crop",
            data: $('#formCrop').serialize(),
            dataType: 'html',
            success: function (response) {
				var order = $('#orderEdit').val();
				if (order != ""){
					$('#orderEdit').val(order+','+response);
					}else{
					$('#orderEdit').val(response);
				}
				
                $('#editUrl').val(response);
                $('#croppedimg').attr('src', response);
                $('.showDefault').attr('src', response);
                $('.jcrop-holder div div img').attr('src', response);
				$('#cropbox').data('Jcrop').release();
                $('.showDefault').css('opacity', '1');
                $('#resetImage').show();
                $("#x").val("");
                $("#y").val("");
                $("#w").val("");
                $("#h").val("");
                
                var img = $('<img src="'+$('#editUrl').val()+'"/>').load(function(){
                    if(this.width<800 || this.height<600)
                    {
                        $('#cropbox').data('Jcrop').destroy();
                        $('#cropbox').Jcrop({
                            onSelect: updateCoords,
                            boxWidth: this.width,
                            boxHeight: this.height,
                            trueSize: [this.width, this.height]
                        });
                    }
                });
			}
		});
		
		} else {
        alert('Please select a crop region then press submit.');
        return false;
	}
}

function resetImage()
{

    $.ajax({
        type: "POST",
        url:  base_content+"admin/tempdelete",
        data: $('#formCrop').serialize(),
        dataType: 'html',
        success: function (response) {
		$('#resetImage').hide();	
		$('.showDefault').attr('src', $('#imgUrl').val());
		$('#editUrl').val($('#imgUrl').val());
		$('#orderEdit').val("");
        $('.jcrop-holder div div img').attr('src', $('#imgUrl').val());
        $('#resetImage').hide();
        /*$('#cropbox').data('Jcrop').destroy();
        var img = $('<img src="'+$('#editUrl').val()+'"/>').load(function(){
            $('#cropbox').Jcrop({
            onSelect: updateCoords,
            boxWidth: 800,
            boxHeight: 600,
            trueSize: [this.width, this.height]
        });
        });*/
		}
	});
}
/*
function resetCrop()
{
    $.ajax({
        type: "POST",
        url:  base_content+"admin/cropdelete",
        data: $('#formCrop').serialize(),
        dataType: 'html',
        success: function (response) {
            $('.showDefault').attr('src', $('#imgUrl').val());
			$('.jcrop-holder div div img').attr('src', $('#imgUrl').val());
			$('#cropbox').data('Jcrop').release();
		}
	});
}
*/
function undoImage()
{
    $.ajax({
        type: "POST",
        url:  base_content+"admin/undoimage",
        data: $('#formCrop').serialize(),
        dataType: 'json',
        success: function (response) {
			if (response.ordervalue != ""){
				$('#orderEdit').val(response.ordervalue);
				$('#editUrl').val(response.editurl);
				$('.showDefault').attr('src', response.editurl);
				$('.jcrop-holder div div img').attr('src', $('#imgUrl').val());
                                
                                var img = $('<img src="'+$('#editUrl').val()+'"/>').load(function(){
                                    if(this.width<800 || this.height<600)
                                    {
                                        $('#cropbox').data('Jcrop').release();
                                        $('#cropbox').data('Jcrop').destroy();
                                        $('#cropbox').Jcrop({
                                            onSelect: updateCoords,
                                            boxWidth: this.width,
                                            boxHeight: this.height,
                                            trueSize: [this.width, this.height]
                                        });
                                    }
                                });
				}else{
				$('.showDefault').attr('src', $('#imgUrl').val());
				$('#editUrl').val($('#imgUrl').val());
				$('#orderEdit').val("");
                                $('#resetImage').hide();
				$('.jcrop-holder div div img').attr('src', $('#imgUrl').val());
				
                                var img = $('<img src="'+$('#editUrl').val()+'"/>').load(function(){
                                    if(this.width<800 || this.height<600)
                                    {
                                        $('#cropbox').data('Jcrop').release();
                                        $('#cropbox').data('Jcrop').destroy();
                                        $('#cropbox').Jcrop({
                                            onSelect: updateCoords,
                                            boxWidth: this.width,
                                            boxHeight: this.height,
                                            trueSize: [this.width, this.height]
                                        });
                                    }
                                    else
                                    {
                                        $('#cropbox').data('Jcrop').release();
                                        $('#cropbox').data('Jcrop').destroy();
                                        $('#cropbox').Jcrop({
                                            onSelect: updateCoords,
                                            boxWidth: 800,
                                            boxHeight: 600,
                                            //trueSize: [800, 600]
                                        });
                                        $(".jcrop-holder").css('width','800px');
                                        $(".jcrop-tracker").css('width','800px');
                                        $(".jcrop-holder img").css('width','800px');
                                    }
                                
                                });
			}
                        
		}
	});
}

function saveImagechanges()
{
    $.ajax({
        type: "POST",
        url:  base_content+"admin/savealteredimage",
        data: $('#formCrop').serialize(),
        dataType: 'json',
        success: function (response) {
            window.location.reload(true);
        }
    });
}

$(document).keydown(function (e) {
	
    // Ensure event is not null
    e = e || window.event;
	
    if ((e.which == 90 || e.keyCode == 90) && e.ctrlKey) {
	
		undoImage();
        
	}
});