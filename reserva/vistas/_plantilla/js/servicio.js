$(function(){   
    $('.buscar_tipo').submit(function(evt){
        var _tipo = $('#tipo').val();
        $.ajax({
            url: 'servicio/buscar_tipo/' + _tipo,
            success: function (data){
                $('.login_body').html(data);
                cargado();
            }            
        });
        evt.preventDefault();
    });
});