var base_url = document.querySelectorAll('head > meta[name="data-base-url"]');
var base_content = base_url[0].getAttribute('content');

function resizeDetails()
{
    if (parseInt($('#width').val())) {

        $.ajax({
            type: "POST",
            url: base_content+"admin/resize",
            data: $('#formCrop').serialize(),
            dataType: 'html',
            success: function (response) {
                $('#cropbox').attr('src', response);
                $('#cropImg').val(response);
                $('#croppedimg').attr('src', response);
                $('.showDefault').attr('src', response);
                $('.jcrop-holder div div img').attr('src', response);
                $('#resizeReset').show();
                $('#resize').hide();
                $("#width").val("");
                $("#height").val("");
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
                $('#cropImg').val(response);
                $('#cropbox').attr('src', response);
                $('#croppedimg').attr('src', response);
                $('.showDefault').attr('src', response);
                $('.jcrop-holder div div img').attr('src', response);
                $('#resizeReset').show();
                $('#resize').hide();
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

function resetWatermark()
{
    var data = new FormData($("#formCrop")[0]);
    $.each(files, function (key, value)
    {
        data.append(key, value);
    });

    $.ajax({
        type: "POST",
        url: base_content+"admin/cropdelete",
        data: data,
        dataType: 'html',
        processData: false,
        contentType: false,
        success: function (response) {
            $('#cropbox').attr('src', $('#imgUrl').val());
            $('#resizeReset').hide();
            $('#resize').show();
        }
    });
    //location.reload();
}
;

function resetSize()
{
    $.ajax({
        type: "POST",
        url: base_content+"admin/cropdelete",
        data: $('#formCrop').serialize(),
        dataType: 'html',
        success: function (response) {
            $('#cropbox').attr('src', $('#imgUrl').val());
            $('#resizeReset').hide();
            $('#w').show();
            $('#h').show();
            $('#resize').show();
        }
    });
    //location.reload();
}
;

function updateCoords(c)
{
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);

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
                $('#cropImg').val(response);
                $('#croppedimg').attr('src', response);
                $('.showDefault').attr('src', response);
                $('.jcrop-holder div div img').attr('src', response);
                $('.showDefault').css('opacity', '1');
                $('.jcrop-tracker').hide();
                $('#cropReset').show();
                $('#crop').hide();
                $("#x").val("");
                $("#y").val("");
                $("#w").val("");
                $("#h").val("");
            }
        });

    } else {
        alert('Please select a crop region then press submit.');
        return false;
    }
}

function resetCrop()
{
    $.ajax({
        type: "POST",
        url:  base_content+"admin/cropdelete",
        data: $('#formCrop').serialize(),
        dataType: 'html',
        success: function (response) {
            $('.showDefault').attr('src', $('#imgUrl').val());
            $('.showDefault').css('opacity', '0.6');
            $('.jcrop-holder div').show();
            $('#cropReset').hide();
            $('#crop').show();
        }
    });
    //location.reload();
}



$(document).keydown(function (e) {

    // Ensure event is not null
    e = e || window.event;

    if ((e.which == 90 || e.keyCode == 90) && e.ctrlKey) {
        resetCrop();resetWatermark();resetSize();
        
    }
});