

<div id="pre-page-content">
    <h1>
        <i class="glyphicon-notes_2 themed-color"></i>Formato de Consejería a PVVS<br>
        <small>Formato de registro de consejería a personas que viven con VIH/SIDA</small>
    </h1>
</div>

<div id="page-content">
     <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="205">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="javascript:abrir_listado_consejerias_pvvs();"> Consejerías a PVVS</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Formato de Consejería a PVVS</a></li>
    </ul>

    <?php $this->mostrar("consejeria_pvvs/formularioConsejeria", $this->datos, 'monitores'); ?>

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

                    _puede_salir_formulario = true;
                    event.handled = true;
                }
                return false;
            }
        });

    });

</script>


<script>
<?php if (isset($datosConsejeria)): ?>
    agregar_boton_ayuda('EDITARCONSEJERIAS');
<?php else: ?>
    agregar_boton_ayuda('NUEVACONSEJERIA');
<?php endif; ?>
</script>