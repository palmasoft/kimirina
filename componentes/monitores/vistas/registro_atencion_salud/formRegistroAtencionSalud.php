<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-notes_2 themed-color"></i> Registro de Atención en Unidad de Salud<br>
        <small>Formato de registro de atención en unidad de salud</small>
    </h1>
</div>
<!-- END Pre Page Content -->
<div id="page-content">
    <!-- Breadcrumb -->
    <!-- You can have the breadcrumb stick on scrolling just by adding the following attributes with their values (data-spy="affix" data-offset-top="250") -->
    <!-- You can try it on other elements too :-), the sticky position and style can be adjusted in the css/main.css with .affix class -->
    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="205">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="javascript:abrir_listado_registro_atencion_salud();">Registros de Atención en Salud</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Formato de Atencion en Salud</a></li>
    </ul>
    <!-- END Breadcrumb -->
    
    <?php $this->mostrar("registro_atencion_salud/formularioAtencionSalud", $this->datos); ?>
    
</div>



<script>
    var habilitarBoton = 'false';
    $(document).ready(function() {
        
        $("#form-registro-atencion").submit(function(e) {
            var datosForm = $(this).serialize();
            
            if( !validarDatosAtencionSalud() ){
                return false;
            }            
            if (estaVacio($('#registro-id').val())) {
                ejecutarAccionJson(
                        'monitores', 'registroAtencionSalud', 'guardar_nuevo_registro_atencion_salud',
                        datosForm, ' mostrar_resultado_guardar( data, "abrir_listado_registro_atencion_salud()", "" );'
                        );
            } else {
                ejecutarAccionJson(
                        'monitores', 'registroAtencionSalud', 'editar_registro_atencion_salud',
                        datosForm, ' mostrar_resultado_guardar( data, "abrir_listado_registro_atencion_salud()", "" );'
                        );
            }
            
            _puede_salir_formulario = true;

        });
    });
</script>
<script>
<?php if (isset($registrosAtencion)): ?>
    agregar_boton_ayuda('EDITARATENCIONSALUD');
<?php else: ?>
    agregar_boton_ayuda('NUEVOATENCIONSALUD');
<?php endif; ?>
</script>