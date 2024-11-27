

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-notes_2 themed-color"></i> Actividad de Monitor<br>
        <small>Formulario de Registro de Actividades de los monitores</small>
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
            <a href="javascript:mostrar_tabla_actividades_monitor();">Actividades del Monitor</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Actividad del Monitor</a></li>
    </ul>
     <?php $this->mostrar("actividades_monitor/formularioActividadMonitor", $this->datos); ?>

</div>


<script>
    $(document).ready(function() {

       

        $('#form-actividades-monitor').validate({
            submitHandler: function(form){
                
                if (event.handled !== true) {                    
                    if(!validar_datos_actividad_monitor()){                        
                        return false;
                    }
                    
                    var datos = new FormData(document.getElementById('form-actividades-monitor-tabla'));
                    var datosEnabezado = $('#form-actividades-monitor').serializeArray();
                    $.each(datosEnabezado, function(i, field) {
                        datos.append("" + field.name + "", "" + field.value + "");
                    });
                    var soportes = $('#form_actividades_monitor_soportes').serializeArray();
                    $.each(soportes, function(i, field) {
                        datos.append("" + field.name + "", "" + field.value + "");
                    });
                    var archivos = $(".cargar_soporte");
                    for (i = 0; i < archivos.length; i++) {
                        $.each($('.cargar_soporte')[i].files, function(k, file) {
                            datos.append('soporte-' + (k + i), file);
                        });
                    }

                    if (estaVacio($('#registro-id').val())) {
                        ejecutarAccionJsonArchivos(
                                'monitores', 'ActividadesMonitor', 'agregar_actividad_monitor',
                                datos, '  mostrar_resultado_guardar( data, "mostrar_tabla_actividades_monitor();", "" );'
                                );
                    } else {
                        ejecutarAccionJsonArchivos(
                                'monitores', 'ActividadesMonitor', 'editar_actividad_monitor',
                                datos, ' mostrar_resultado_guardar( data, "mostrar_tabla_actividades_monitor();", "" );'
                                );
                    }
                    
                    _puede_salir_formulario = true;
                    event.handled = true;
                }                
                return false;
            }
        });




    });
</script>



<script>
<?php if (isset($datosActividad)): ?>
    agregar_boton_ayuda('EDITARACTIVIDADMONITO');
<?php else: ?>
    agregar_boton_ayuda('NUEVAACTIVIDADMONITOR');
<?php endif; ?>
</script>
