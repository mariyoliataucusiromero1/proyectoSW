$(function (){
    $('#origen').change(function(evt){
        var dest = $('#destino').val();
        var orig = $('#origen').val();
        if (orig.length !== 0 && dest === orig) {
            alert('Origen y destino tienen que ser diferentes');
            $('#origen option[value=]').attr('selected', true);
        }
    });
    
    $('#destino').change(function(evt){
        var dest = $('#destino').val();
        var orig = $('#origen').val();
        if (orig.length !== 0 && dest === orig) {
            alert('Origen y destino tienen que ser diferentes');
            $('#destino option[value=]').attr('selected', true);
        }
    });
});