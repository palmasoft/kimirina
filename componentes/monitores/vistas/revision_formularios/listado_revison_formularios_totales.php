
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-ok themed-color"></i> Revisión de Registros en Lote<br>
        <small>Puedes cambiar a estado revisado todos los registros del periodo con un solo clic</small>
    </h1>
</div>
<!-- END Pre Page Content -->


<!-- Page Content -->
<div id="page-content">

    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="205">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="#">Monitores</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Revisión de Registros en Lote</a></li>
    </ul>
    <!-- END Breadcrumb -->


    <?php if (!$tieneRestricciones or Usuario::esDNI() ): ?>            
        <?php $this->mostrar('formulariosGestion/formSubreceptorPeriodo', $this->datos, 'gestion'); ?>
    <?php endif; ?>




    <div style="text-align: center;">
        <h3>Periodo de Revisión <?php echo $PeriodosRevision->CODIGO_PERIODO_INDICADOR ?>-<?php echo $PeriodosRevision->CODIGO_PERIODO ?></h3> 
        <h4>desde <?php echo $PeriodosRevision->FECHA_MIN_PERIODO ?> hasta <?php echo $PeriodosRevision->FECHA_MAX_PERIODO ?></h4>    
    </div>





    <?php if ($HSHTSTRANS or ! $tieneRestricciones) { ?>

        <!-- REGISTRO SEMANAL -->
        <div class="block block-themed">
            <div class="block-title">
                <h4>Hojas de Registro Semanal de Alcances</h4>
                <div class="block-options">
                    <div class="btn-group">
                        <a href="javascript:revisar_todos_semanal_contactos();" data-toggle="tooltip" title="Revisar TODOS los registros pendientes." class="btn btn-lg btn-inverse"><i class="glyphicon-circle_ok"></i> Revisar Todos</a>
                    </div>           
                </div>  
            </div>
            <div class="block-content"> 
                <div class="row-fluid">                    
                    <?php $this->mostrar("revision_formularios/tabla_total_semanal_contactos", $this->datos); ?>
                </div>    
            </div>
        </div>
        <!-- END REGISTRO SEMANAL -->

    <!-- ANIMADORES-->
    <div class="block block-themed">
        <div class="block-title">
            <h4>Recibos de Contactos de Animadores</h4>
            <div class="block-options">
                <div class="btn-group">
                    <a href="javascript:revisar_todos_animadores();" data-toggle="tooltip" title="Revisar TODOS los registros pendientes." class="btn btn-lg btn-inverse"><i class="glyphicon-circle_ok"></i> Revisar Todos</a>
                </div>  
            </div>  
        </div>
        <div class="block-content"> 
            <div class="row-fluid">                    
                <?php $this->mostrar("revision_formularios/tabla_total_animadores", $this->datos); ?>
            </div>    
        </div>
    </div>
    <!-- END ANIMADORES-->

    <?php } ?>

    <?php if (!$PVVS or ! $tieneRestricciones) { ?>
    <!-- ATENCION SALUD-->
    <div class="block block-themed">
        <div class="block-title">
            <h4>Registros de Atención en Salud</h4>
            <div class="block-options">
                <div class="btn-group">
                    <a href="javascript:revisar_todos_atencion_salud();" data-toggle="tooltip" title="Revisar TODOS los registros pendientes." class="btn btn-lg btn-inverse"><i class="glyphicon-circle_ok"></i> Revisar Todos</a>
                </div>
            </div>  
        </div>
        <div class="block-content"> 
            <div class="row-fluid">
                <?php $this->mostrar("revision_formularios/tabla_total_salud", $this->datos); ?>                  
            </div>    
        </div>
    </div>
    <!-- END ATENCION SALUD-->
    <?php } ?>


    <!-- CONSEJERIAS -->
    <?php if ($PVVS or ! $tieneRestricciones) { ?>
        <div class="block block-themed">
            <div class="block-title">
                <h4>Consejerías PVVS</h4>
                <div class="block-options">
                    <div class="btn-group">
                        <a href="javascript:revisar_todos_consejerias();" data-toggle="tooltip" title="Revisar TODOS los registros pendientes." class="btn btn-lg btn-inverse"><i class="glyphicon-circle_ok"></i> Revisar Todos</a>
                    </div>
                </div>  
            </div>
            <div class="block-content"> 
                <div class="row-fluid">
                    <?php $this->mostrar("revision_formularios/tabla_total_consejeria", $this->datos); ?>                    
                </div>    
            </div>
        </div>
    <?php } ?>
    <!-- END CONSEJERIAS -->


</div>



<script>
    $(document).ready(function() {


        $('#form-control-subreceptor-periodo').submit(function(e) {
            if (estaVacio($('#subreceptor-form-control').val())) {
                alert('Seleccione un Subreceptor.');
                return false;
            }
            mostrar_listado_revision_formularios_totales($(this).serialize());

        });


    });
</script>


<script>
    agregar_boton_ayuda('REVISIONMONITORAUTOMA');
</script>