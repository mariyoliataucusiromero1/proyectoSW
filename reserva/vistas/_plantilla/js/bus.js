$(function(){
    
    $('.buscar_placa').submit(function(evt){
        var _placa = $('#placa').val();
        $.ajax({
            url: 'bus/buscar_placa/' + _placa,
            success: function (data){
                $('.login_body').html(data);
                cargado();
            }            
        });
        evt.preventDefault();
    });
});