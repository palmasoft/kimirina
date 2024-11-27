
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-notes_2 themed-color"></i>Formato de Consejeria a PVVS<br>
        <small>Formato de registro de consejeria a persona que vive con VIH y/o SIDA</small>
    </h1>
</div>
<!-- END Pre Page Content -->

<!-- Page Content -->
<div id="page-content">
    <!-- Breadcrumb -->
    <!-- You can have the breadcrumb stick on scrolling just by adding the following attributes with their values (data-spy="affix" data-offset-top="250") -->
    <!-- You can try it on other elements too :-), the sticky position and style can be adjusted in the css/main.css with .affix class -->
    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="205">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="javascript:abrir_listado_consejerias_pvvs();"> Consejerias a PVVS</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Formato de Consejeria a PVVS</a></li>
    </ul>

    <?php $this->mostrar("consejeria_pvvs/formularioConsejeria", $this->datos, 'monitores'); ?>

    <div class="form-actions">
        <button id="btn_validar_datos" type="button" class="btn btn-info"><i class="icon-check"></i> Validar </button>
        <button type="button"  id="btn_limpiar_consejeria_pvvs" class="btn btn-danger"><i class="icon-repeat"></i> Limpiar</button>
        <button type="button" id="btn_guardar_consejeria_pvvs" class="btn btn-success" disabled="" ><i class="icon-ok"></i> Aceptar</button>
    </div>

</div> 

<script>
    $(document).ready(function() {

        $('#form-consejeria-pvvs').validate({
            submitHandler: function(form) {
                if (event.handled !== true) {
                    if (validarDatos()) {

                        var codP = generarCodigoUnicoPemar($('#dosPrimerNombre').val(), $('#dosSegundoNombre').val(), $('#dosPrimerApellido').val(), $('#dosSegundoApellido').val(), $('#mes-nacimiento').val(), $('#ano-nacimiento').val());

                        var data = new FormData(document.getElementById('form-consejeria-pvvs'));
                        data.append("codigo-pemar", "" + codP + "");

                        var soportes = $('#form-consejeria-soportes').serializeArray();
                        $.each(soportes, function(i, field) {
                            data.append("" + field.name + "", "" + field.value + "");
                        });

                        var archivos = $(".cargar_soporte");
                        for (i = 0; i < archivos.length; i++) {
                            $.each($('.cargar_soporte')[i].files, function(k, file) {
                                data.append('soporte-' + (k + i), file);
                            });
                        }

                        if (estaVacio($('#registro-id').val())) {
                            ejecutarAccionJsonArchivos(
                                    'monitores', 'consejeriaPVVS', 'agregar_consejeria_pvvs',
                                    data, ' mostrar_resultado_guardar( data, "abrir_listado_consejerias_pvvs();", "");'
                                    );
                        } else {
                            ejecutarAccionJsonArchivos(
                                    'monitores', 'consejeriaPVVS', 'editar_consejeria_pvvs',
                                    data, ' mostrar_resultado_guardar( data, "abrir_listado_consejerias_pvvs();", "");'
                                    );
                        }
                    }

                    event.handled = true;
                }
                return false;
            }
        });

    });

</script>


