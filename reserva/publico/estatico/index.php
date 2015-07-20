<?php
$m_actual = date('n');
if (is_null(filter_input(INPUT_GET, 'mes'))) {
    $mes = $m_actual;
} else {
    $mes = (int) filter_input(INPUT_GET, 'mes');
}
$ndia = 1;
?>
<div class="calendario">
    <a href="#" class="cal_clo" title="Cerrar"><img src="vistas/_plantilla/img/delete.png"></a>
    <?php if ($mes == $m_actual) : ?>
        <?php
        $anio = date('Y');
        $ndias = cal_days_in_month(CAL_GREGORIAN, $mes, $anio);        
        $dia = date('j');
        $pdia = date('w', mktime(0, 0, 0, $mes, 1, $anio));
        ?>

        <table>
            <tr>
                <th>Do</th><th>Lu</th><th>Ma</th><th>Mi</th><th>Ju</th><th>Vi</th><th>Sa</th>
            </tr>
            <tr>
                <?php for ($i = 0; $i < 42; $i++) : ?>
                    <?php if ($ndia <= $ndias && $i >= $pdia) : ?> 
                        <td>
                            <a class="<?php echo ($dia > $ndia) ? 'cal_lbl' : 'cal_btn' ?>"><?php echo $ndia ?></a>
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
    <?php else: ?>
        <?php
        if ($mes < $m_actual) {
            $anio = date('Y') + 1;
            $ndias = cal_days_in_month(CAL_GREGORIAN, $mes, $anio);
            $pdia = date('w', mktime(0, 0, 0, $mes, 1, $anio));
        } else {
            $anio = date('Y');
            $ndias = cal_days_in_month(CAL_GREGORIAN, $mes, $anio);
            $pdia = date('w', mktime(0, 0, 0, $mes, 1, $anio));
        }        
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
                            <?php
                            break;
                        else:
                            ?>
                        </tr><tr>
                        <?php endif; ?>            
                    <?php endif; ?>
                <?php endfor; ?>
            </tr>
        </table>
    <?php endif; ?>
    <input type="hidden" name="anio" value="<?php echo $anio ?>" id="anio">
</div>