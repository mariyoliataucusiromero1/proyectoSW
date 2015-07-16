$(function(){
    $('.buscar_dni').submit(function(evt){
        var _dni = $('#dni').val();
        $('#nombre').val('');
        $.ajax({
            url: 'cliente/buscar_dni/' + _dni,
            success: function (data){
                $('.login_body').html(data);
                cargado();
            }            
        });
        evt.preventDefault();
    });
    
    $('.buscar_nombre').submit(function(evt){
        var _nombre = $('#nombre').val();
        $('#dni').val('');
        $.ajax({
            url: 'cliente/buscar_nombre/' + _nombre,
            success: function (data){
                $('.login_body').html(data);
                cargado();
            }            
        });
        evt.preventDefault();
    });
});