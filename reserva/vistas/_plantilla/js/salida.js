$(function () {
    $('#mes').change(function () {
        $('#dia').val('');
        $('#dia').focus();
    });

    $('#dia').on({
        focusin: function () {
            $('.carga_calendar').html($('#marco').html());
            $('.carga_calendar').show();
            $.ajax({
                url: 'publico/estatico/?mes=' + $('#mes').val(),
                cache: true,
                success: function (data) {
                    $('.carga_calendar').html(data);
                }
            });
        }
    });

    $('.calendario .cal_btn').live('click', function () {
        var dia = $(this).html();
        if (dia < 10) {
            dia = '0' + dia;
        }
        $('#dia').val(dia);
        $('.carga_calendar').fadeOut(300);
        $('#buscar_intervalos').click();
    });

    $('.calendario .cal_clo').live('click', function (evt) {
        $('.carga_calendar').fadeOut(300);
        evt.preventDefault();
    });
    
    $('#ruta').change(function (){
        $(location).attr('href', 'salida/listar/' + $(this).val());
    });
    
    
    
    $('#fecha').on({
        focusin: function () {
            $('.carga_calendar1').html($('#marco').html());
            $('.carga_calendar1').show();
            $.ajax({
                url: 'publico/estatico/calendar.php?fecha=' + $('#fecha').val(),
                cache: true,
                success: function (data) {
                    $('.carga_calendar1').html(data);
                }
            });
        }
    });

    $('.calendario .cal_clo').live('click', function (evt) {
        $('.carga_calendar1').fadeOut(300);
        evt.preventDefault();
    });

    $('#cal_anio').live('change', function (evt) {
        $('.carga_calendar1').html($('#marco').html());
        $('.carga_calendar1').show();
        $.ajax({
            url: 'publico/estatico/calendar.php?fecha=01-01-' + $(this).val(),
            cache: true,
            success: function (data) {
                $('.carga_calendar1').html(data);
            }
        });
    });
    
    $('#cal_mes').live('change', function (evt) {
        var _mes = $('#cal_mes').val();
        var _anio = $('#cal_anio').val();
        $('.carga_calendar1').html($('#marco').html());
        $('.carga_calendar1').show();
        $.ajax({
            url: 'publico/estatico/calendar.php?fecha=01-' + _mes + '-' + _anio,
            cache: true,
            success: function (data) {
                $('.carga_calendar1').html(data);
            }
        });
    });
    
    $('.calendario .cal_btn').live('click', function () {
        var dia = $(this).html();
        if (dia < 10) {
            dia = '0' + dia;
        }
        $('#fecha').val($('#cal_anio').val() + '-' + $('#cal_mes').val() + '-' + dia);
        $.ajax({
            url: 'salida/filtro/' + $('#ruta').val() + '/' + $('#fecha').val(),
            success: function(data){
                $('.login_body').html(data);
            }
        });
        $('.carga_calendar1').html('');
    });
    
    
});


