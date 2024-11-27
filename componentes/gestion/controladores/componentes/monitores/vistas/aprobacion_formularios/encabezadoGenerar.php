<div style="text-align: center;">
    <h3>Periodo de Revisión <?php echo $PeriodosRevision->CODIGO_PERIODO_INDICADOR ?>-<?php echo $PeriodosRevision->CODIGO_PERIODO ?></h3> 
    <h4>desde <?php echo $PeriodosRevision->FECHA_MIN_PERIODO ?> hasta <?php echo $PeriodosRevision->FECHA_MAX_PERIODO ?></h4>    
</div>

<form id="form-encabezado-generar" method="post" class="form-inline" onsubmit="return false;">        
    <div class="form-actions" style="text-align: center; size: 20px;">                
        <button id="btn_generar_revision" type="submit" class="btn btn-success">
            <i class="icon-refresh"></i><span style="font-size: 18px; margin: 5px;">generar muestra del 5% para aprobacion</span>
        </button>
    </div>
</form>



<script >
    $('#form-encabezado-generar').submit(function(event) {        
        confirm(  
                'Desea geenrar una muestra del 5% de los registros del periodo para aprobar?. ' +
                'Si actualemente tiene registro en revision, se le agregaran mas para revisar. ', 
            ' generar_porc_revision(); '
        );	
       
    });
    
    function generar_porc_revision(){
        mostrar_contenidos( 
        'monitores', 'aprobacionFormularios', 'generar_formularios_aprobacion', ''
        );	
    }
    
</script>

