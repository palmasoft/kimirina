<div style="text-align: center;">
    <h3>Periodo de Revisión <?php echo $PeriodosRevision->CODIGO_PERIODO_INDICADOR ?>-<?php echo $PeriodosRevision->CODIGO_PERIODO ?></h3> 
    <h4>desde <?php echo $PeriodosRevision->FECHA_MIN_PERIODO ?> hasta <?php echo $PeriodosRevision->FECHA_MAX_PERIODO ?></h4>    
</div>

<form id="form-encabezado-generar" method="post" class="form-inline" onsubmit="return false;">    

    <div class="form-actions" style="text-align: center; size: 20px;">                
        <button id="btn_generar_revision" type="submit" class="btn btn-success">
            <i class="icon-refresh"></i><span style="font-size: 18px; margin: 5px;">generar muestra del 5% para revisión</span>
        </button>
    </div>
</form>

<script >
    $(document).ready(function() {
        $('#form-encabezado-generar').submit(function(event) {
            confirm(
                    'Desea generar una muestra del 5% del los registros del periodo para revisar?. ' +
                    'Si actualmente tiene registros en revision, se <strong>AGREGARÁN MÁS</strong> para revisar. ',
                    'generar5paraRevision();'
                    );
        });
    });
</script>

