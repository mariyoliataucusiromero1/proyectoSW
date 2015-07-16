$(function(){
    $('.buscar_ruc').submit(function(evt){
        var _ruc = $('#ruc').val();
        $('#razon').val('');
        $.ajax({
            url: 'entidad/buscar_ruc/' + _ruc,
            success: function (data){
                $('.login_body').html(data);
                cargado();
            }            
        });
        evt.preventDefault();
    });
    
    $('.buscar_razon').submit(function(evt){
        var _razon = $('#razon').val();
        $('#ruc').val('');
        $.ajax({
            url: 'entidad/buscar_razon/' + _razon,
            success: function (data){
                $('.login_body').html(data);
                cargado();
            }            
        });
        evt.preventDefault();
    });
});