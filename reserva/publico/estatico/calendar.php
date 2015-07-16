<?php
$fecha = is_null(filter_input(INPUT_GET, 'fecha')) ? date('d-m-Y') : filter_input(INPUT_GET, 'fecha');
if (!preg_match('/([0-9]{2})-([0-9]{2})-([0-9]{4})/', $fecha)) {
    $fecha = date('d-m-Y');
}
$fecha1 = explode('-', $fecha);
$dia = $fecha1[0];
$mes = $fecha1[1];
$anio = $fecha1[2];
$meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
?>
<div class="calendario">
    <a href="#" class="cal_clo" title="Cerrar"><img src="vistas/_plantilla/img/delete.png"></a>
    <select id="cal_anio">
        <?php for ($i = $anio - 1; $i <= $anio + 1; $i++) : ?>
            <option value="<?php echo $i ?>"<?php echo ($i == $anio) ? ' selected' : '' ?>><?php echo $i ?></option>
        <?php endfor; ?>
    </select>
    <select id="cal_mes">
        <?php for ($i = 1; $i < 13; $i++) : ?>
            <?php $m = ($i < 10) ? '0' . $i : $i; ?>
            <option value="<?php echo $m ?>"<?php echo ($m == $mes) ? ' selected' : '' ?>><?php echo $meses[$i - 1] ?></option>
        <?php endfor; ?>
    </select>
    <?php
    $ndias = cal_days_in_month(CAL_GREGORIAN, $mes, $anio);
    $pdia = date('w', mktime(0, 0, 0, $mes, 1, $anio));
    $ndia = 1;
    ?>

    <table>
        <tr>
            <th>Do</th><th>Lu</th><th>Ma</th><th>Mi</th><th>Ju</th><th>Vi</th><th>Sa</th>
        </tr>
        <tr>
            <?php for ($i = 0; $i < 42; $i++) : ?>
                <?php if ($ndia <= $ndias && $i >= $pdia) : ?> 
                    <td>
                        <a class="cal_btn"><?php echo $ndia ?></a>
                        <?php $ndia++ ?>                            
                    </td>
                <?php else : ?>
                    <td></td>
                <?php endif; ?>
                <?php if (($i + 1) % 7 == 0) : ?>
                    <?php if ($ndia > $ndias) : ?>
                        <?php break; ?>
                    <?php else: ?>
                    </tr><tr>
                    <?php endif; ?>            
                <?php endif; ?>
            <?php endfor; ?>
        </tr>
    </table>
</div>