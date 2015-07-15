<?php

/**
 * Archivo funciones
 */
function getMeses() {
    return array('01'=>'Enero', '02'=>'Febrero', '03'=>'Marzo', '04'=>'Abril', 
        '05'=>'Mayo', '06'=>'Junio', '07'=>'Julio', '08'=>'Agosto',
        '09'=>'Septiembre', '10'=>'Octubre', '11'=>'Noviembre', '12'=>'Diciembre');
}

function get2Meses() { 
    $mes = date('n');
    $sig = 0;
    if ($mes < 12) {
        $sig = $mes + 1;
    } else {
        $sig = 1;
    }
    $sig = ($sig < 10)? '0' . $sig: $sig;
    $mes = ($mes < 10)? '0' . $mes: $mes;
    $_res = array();
    $meses = getMeses();
    return array($mes => $meses[$mes], $sig => $meses[$sig]);
}