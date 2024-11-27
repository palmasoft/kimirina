
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-notes_2 themed-color"></i> Recibo de Contacto PEMAR<br>
        <small>REGISTRO DE RECIBOS DE CONTACTO ENTREGADOS A LOS PEMAR.</small>
    </h1>
</div>

<div id="page-content">

    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="205">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="javascript:abrir_tabla_recibo_contacto_animador();">Formatos</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="javascript:abrir_formulario_recibo_contacto_animador();">Recibo PEMAR</a></li>
    </ul>

    <?php $this->mostrar("recibo_contacto_animador/formularioAnimador", $this->datos); ?>

    <?php $this->mostrar("recibo_contacto_animador/cargarArchivos", $this->datos); ?>


    <div class="block block-themed block-last">
        <div class="form-actions" style="text-align: center;">
            <button id="btn_validar_datos" type="button" class="btn btn-info"><i class="icon-check"></i> Validar </button>
            <button id="btn_limpiar_recibo_animador" type="button" class="btn btn-danger"><i class="icon-repeat"></i> Limpiar</button>
            <button id="btn_guardar_recibo_animador" type="submit" class="btn btn-success" disabled="" ><i class="icon-ok"></i> Guardar</button>
        </div>
    </div>

</div>



<script>
    $(document).ready(function() {



        $('#form-contacto-animador').validate({
            submitHandler: function(form) {

                if (event.handled !== true) {

                    if (!validar_datos_recibo_contacto()) {
                        return false;
                    }

                    var data = new FormData(document.getElementById('form-contacto-animador'));

                    var soportes = $('#form-recibo-contacto-soportes').serializeArray();
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
                                'monitores', 'reciboContactoAnimador', 'agregar_recibo_contacto_animador',
                                data, ' mostrar_resultado_guardar(data, "abrir_tabla_recibo_contacto_animador();", "" );'
                                );
                    } else {

                        ejecutarAccionJsonArchivos(
                                'monitores', 'reciboContactoAnimador', 'update_recibo_contacto_animador',
                                data, 'mostrar_resultado_guardar(data, "abrir_tabla_recibo_contacto_animador();", "" );'
                                );
                    }


                    event.handled = true;
                }
                return false;
            }
        });


    });






</script>


