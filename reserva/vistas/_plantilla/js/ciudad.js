$(function(){
    $('.buscar_ciudad').submit(function(evt){
        var _nombre = $('#ciudad').val();
        $.ajax({
            url: 'ciudad/buscar/' + _nombre,
            success: function (data){
                $('.login_body').html(data);
                cargado();
            }            
        });
        evt.preventDefault();
    });
});