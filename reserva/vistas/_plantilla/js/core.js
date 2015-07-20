$(function (){
    var $form = $('form');
    if ($form.length !== 0) {
        $form.submit(function(){
            preCarga();
        });
    }
});

function preCarga(){
    $('#cargando').fadeIn(10);
    $('#marco').fadeIn(10);
}
function cargado(){
    $('#cargando').fadeOut();
    $('#marco').fadeOut();
}