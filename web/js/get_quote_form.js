
    $('#multi-step').formProgress({metervalue : 1 });
    
    $('.main-tabs li').click(function () {
        var sel = $(this);
        var tab = sel.index();

        $('.block').removeClass('current');
        sel.siblings('li').removeClass('current');
        sel.addClass('current');
        $('.block:eq(' + tab + ')').addClass('current');
    });
    $('.sub-tabs li').click(function () {
        var sel = $(this);
        var tab = sel.index();

        sel.parents('.sub-tabs').siblings('.sub-block').removeClass('current');
        sel.siblings('li').removeClass('current');
        sel.addClass('current');
        sel.parents('.sub-tabs').siblings('.sub-block:eq(' + tab + ')').addClass('current');
    });
    
    $('.step0').on('click', function (e) {
         
            $('#multi-step').formProgress({metervalue : 1 });
    });
    $('.step1').on('click', function (e) {
        if($("#get_quote_form").valid())
        {
            e.preventDefault();
            $(this).parents('#step1').fadeOut('normal', function () {
                $('#step2').show();
            });
            $('#multi-step').formProgress({metervalue : 2 });
            //console.log(progressbar);
            $(".error-message").hide();
        }
        else
        {
            $(".error-message").show();
        }
    });
    $('.step2').on('click', function (e) {
        if($("#get_quote_form").valid())
        {
            e.preventDefault();
            $(this).parents('#step2').fadeOut('normal', function () {
                $('#step3').show();
            });
            $('#multi-step').formProgress({metervalue : 3 });
            $(".error-message").hide();
        }
        else
        {
            $(".error-message").show();
        }
    });
    $('.step3').on('click', function (e) {
        if($("#get_quote_form").valid())
        {
            e.preventDefault();
            $(this).parents('#step3').fadeOut('normal', function () {
                $('#step4').show();
            });
            $('#multi-step').formProgress({metervalue : 4 });
            $(".error-message").hide();
        }
        else
        {
            $(".error-message").show();
        }
    });
    $('.step4').on('click', function (e) {
        $(".step4").prop("disabled", true);
        $(".backtostep3").prop("disabled", true);
        $(".formloading").show();
        $.ajax({
            url: "savegetquote",
            data :  $('#get_quote_form').serialize(),
            dataType: 'html',
            type: "POST",
            success: function(data){
                //e.preventDefault();
                $('.step4').parents('#step4').fadeOut('normal', function () {
                    $('#step5').show();
                });
                $('#multi-step').formProgress({metervalue : 5 });
            },
            error:function(error){
                $(".step4").prop("disabled", false);
                $(".backtostep3").prop("disabled", false);
                $(".formloading").hide()

            }
        });
        
    });
    $('.backtostep0').on('click', function (e) {
        $("#quote1").show();
        $("#quote2").hide();
        $('#multi-step').formProgress({metervalue : 0 });
    });
    $('.backtostep1').on('click', function (e) {
        e.preventDefault();
        $(this).parents('#step2').fadeOut('normal', function () {
            $('#step1').show();
        });
        $('#multi-step').formProgress({metervalue : 1 });
    });
	$('.backtostep2').on('click', function (e) {
        e.preventDefault();
        $(this).parents('#step3').fadeOut('normal', function () {
            $('#step2').show();
        });
        $('#multi-step').formProgress({metervalue : 2 });
    });
	$('.backtostep3').on('click', function (e) {
        e.preventDefault();
        $(this).parents('#step4').fadeOut('normal', function () {
            $('#step3').show();
        });
        $('#multi-step').formProgress({metervalue : 3 });
    });
	$('.backtostep4').on('click', function (e) {
        e.preventDefault();
        $(this).parents('#step5').fadeOut('normal', function () {
            $('#step4').show();
        });
    });


    $('.pbar').each(function (e) {
        var clsArr = [95, 80, 50, 30, 20];
        $(this).children().animate({
            width: clsArr[e] + '%'
        }, clsArr[e] * 15);
    });
