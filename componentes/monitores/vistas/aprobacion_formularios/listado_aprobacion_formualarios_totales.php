
<div id="pre-page-content">
    <h1>
        <i class="icon-thumbs-up-alt themed-color"></i>Aprobación de Registros en Lote<br>
        <small>Aprobación de Registros en Conjunto</small>
    </h1>
</div>

<div id="page-content">

    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="205">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="#">Coordinadores</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Aprobación de Registros en Lote</a></li>
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
                <h4>Formularios Registro Semanal de Alcances</h4>
                <div class="block-options">
                    <table class="botones_arriba" align="center" >
                        <tr><td>
                                <div class="btn-group">
                                    <a href="javascript:aprobar_todos_semanal_contactos();" data-toggle="tooltip" title="Aprobar TODOS los registros del periodo" class="btn btn-lg btn-success"><i class="fa-thumbs-up"> </i> Aprobar Todos</a>

                                </div>
                            </td></tr>
                    </table>            
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
                <h4>Formularios Registro Animadores</h4>
                <div class="block-options">
                    <table class="botones_arriba" align="center" >
                        <tr><td>
                                <div class="btn-group">
                                    <a href="javascript:aprobar_todos_animadores();" data-toggle="tooltip" title="Aprobar TODOS los registros del periodo" class="btn btn-lg btn-success"><i class="fa-thumbs-up"> </i> Aprobar Todos</a>
                                </div>
                            </td></tr>
                    </table>            
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


    <!-- ATENCION SALUD-->
    <?php if (!$PVVS or ! $tieneRestricciones) { ?>
        <div class="block block-themed">
            <div class="block-title">
                <h4>Registros de Atencion en Salud</h4>
                <div class="block-options">
                    <div class="btn-group">
                        <a href="javascript:aprobar_todos_atencion_salud();" data-toggle="tooltip" title="Aprobar TODOS los registros del periodo." class="btn btn-lg btn-success"><i class="fa-thumbs-up"></i> Aprobar Todos</a>
                    </div>
                </div>  
            </div>
            <div class="block-content"> 
                <div class="row-fluid">
                    <?php $this->mostrar("revision_formularios/tabla_total_salud", $this->datos); ?>                  
                </div>    
            </div>
        </div>
    <?php } ?>
    <!-- END ATENCION SALUD-->



    <!-- CONSEJERIAS -->
    <?php if ($PVVS or ! $tieneRestricciones) { ?>
        <div class="block block-themed">
            <div class="block-title">
                <h4>Formularios Consejerias PVVS</h4>
                <div class="block-options">
                    <table class="botones_arriba" align="center" >
                        <tr><td>
                                <div class="btn-group">
                                    <a href="javascript:aprobar_todos_consejerias();" data-toggle="tooltip" title="Aprobar TODOS los registros del periodo" class="btn btn-lg btn-success"><i class="fa-thumbs-up"> </i> Aprobar Todos</a>

                                </div>
                            </td></tr>
                    </table>            
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
            mostrar_listado_aprobacion_formularios_totales($(this).serialize());

        });

    });

    function aprobar_todos_consejerias() {
        confirm("Seguro qeu desea APROBAR la totalidad de los Registros de <strong>CONSEJERIA A PVVS</strong> para este periodo?", ' aprobar_consejerias(); ');
    }
    function aprobar_consejerias() {
        ejecutarAccionJson(
                'monitores', 'aprobacionFormulariosTotales', 'aprobar_todos_formularios_consejerias', '',
                'mostrar_resultado_guardar( data, "mostrar_listado_aprobacion_formularios_totales();", "" );'
                );
    }

    function aprobar_todos_semanal_contactos() {
        confirm("Seguro que desea APROBAR la totalidad de los registros de <strong>HOJA DE SEMANAL DE CONTACTOS</strong>por promotores para este periodo?", "aprobar_semanal_contactos();");
    }
    function aprobar_semanal_contactos() {
        ejecutarAccionJson(
                'monitores', 'aprobacionFormulariosTotales', 'aprobar_todos_formularios_semanales_contactos', '',
                'mostrar_resultado_guardar( data, "mostrar_listado_aprobacion_formularios_totales();", "" );'
                );
    }

    function aprobar_todos_animadores() {
        confirm("Seguro que desea APROBAR la totalidad de los <strong>RECIBOS DE CONTACTOS</strong> por animador para este periodo?", 'aprobar_animadores();');
    }
    function aprobar_animadores() {
        ejecutarAccion(
                'monitores', 'aprobacionFormulariosTotales', 'aprobar_todos_formularios_animadores', '',
                'alert( data ); mostrar_resultado_guardar( data, "mostrar_listado_aprobacion_formularios_totales();", "" );'
                );
    }

    function aprobar_todos_atencion_salud() {
        confirm("Seguro que desea APROBAR la totalidad de los Registros de <strong>ATENCION EN UNIDAD DE SALUD</strong> para este periodo?", "aprobar_registro_atencion_salud();");
    }
    function aprobar_registro_atencion_salud() {
        ejecutarAccionJson(
                'monitores', 'aprobacionFormulariosTotales', 'aprobar_todos_formularios_atencion_salud', '',
                'mostrar_resultado_guardar( data, "mostrar_listado_aprobacion_formularios_totales();", "" );'
                );
    }

</script>




<script>
    agregar_boton_ayuda('APROBACOORDINAAUTOMAT');
</script>