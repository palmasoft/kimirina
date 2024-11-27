
<div id="pre-page-content">
    <h1>
        <i class="fa-building-o themed-color"></i> Lugares de Intervención<br>
        <small>Listado de lugares de intervención para alcances, abordajes, contactos, .....</small>
    </h1>
</div>

<div id="page-content">
    <!-- Breadcrumb -->
    <!-- You can have the breadcrumb stick on scrolling just by adding the following attributes with their values (data-spy="affix" data-offset-top="250") -->
    <!-- You can try it on other elements too :-), the sticky position and style can be adjusted in the css/main.css with .affix class -->
    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="205">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="#">Configuración</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Lugares de Intervencion</a></li>
    </ul>
    <?php $this->mostrar("lugares_intervencion/encabezadoFiltros", $this->datos); ?>

    <div class=" row-fluid botones_arriba" >
        <div class=" span2 btn-group text-left">	
            <a href="javascript:abrir_form_nuevo_lugar_intervencion();" data-toggle="tooltip" title="Agregar nuevo Formulario al Registro" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo</a>
        </div>
        <div class="span6 text-center">
            <i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span>
        </div>
        <div class=" span4 btn-group text-right">                
            <a href="javascript:mostrar_formulario_editar_lugar_intervencion()" data-toggle="tooltip" title="Editar Formulario" class="btn btn-lg btn-warning"><i class="icon-pencil"></i>Editar</a>
            <a href="javascript:confirmar_eliminar_lugar_intervencion()" data-toggle="tooltip" title="Borrar Formulario" class="btn btn-lg btn-danger"><i class="icon-remove"></i>Eliminar</a>
        </div>
    </div>   

    <div class="block-section">      

        <table id="tbllugaresInter" class="table table-bordered table-hover dataTables" >
            <thead>
                <tr>
                    <th>Provincia</th>
                    <th>Cantón</th>
                    <th>Tipo Lugar</th>
                    <th>Nombre Lugar</th>
                    <th>Direccion Lugar</th>
                    <th>Contacto Lugar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($lugaresIntervencion)) {
                    foreach ($lugaresIntervencion as $lugares) :
                        ?>  
                        <tr fila-id="<?php echo ($lugares->ID_LUGAR) ?>"  data-nombre="<?php echo ($lugares->NOMBRE_LUGAR) ?>">                
                            <td><?php echo ($lugares->NOMBRE_PROVINCIA) ?></td>              
                            <td><?php echo ($lugares->NOMBRE_CANTON) ?></td>
                            <td><?php echo ($lugares->NOMBRE_TIPOLUGAR) ?></td>
                            <td><?php echo ($lugares->NOMBRE_LUGAR) ?></td>
                            <td><?php echo ($lugares->DIRECCION_LUGAR) ?></td>
                            <td><?php echo ($lugares->CONTACTO_LUGAR) ?></td>
                        </tr>
                        <?php
                    endforeach;
                }
                ?>
            </tbody>
        </table>



    </div>
    <!-- END Dynamic Tables Section -->



</div>



<script>
    $(document).ready(function() {
        $('#form-encabezado-filtros').submit(function() {

            var provincia = $("#provincia-chosen").val();
            var canton = $("#sel-lista-cantones").val();
            var tipoLugar = $("#tipo-lugar").val();
            var datos = $(this).serialize();
            if ((provincia == "") && (canton == "") && (tipoLugar == "")) {
                confirm('Consultar Todos los Lugares de Intervención podria tardar unos minutos, desea continuar?', 'busquedaTodos("' + datos + '")');
            } else {
                mostrar_contenidos("sistema", "lugaresIntervencion",
                        "busqueda_lugares_intervencion", $(this).serialize());
            }
        });

        $('#tbllugaresInter tbody tr').dblclick(function(e) {
            $(this).addClass('row_selected');
            $('#registro-seleccionado').html($(this).attr('data-nombre'));
            mostrar_formulario_editar_lugar_intervencion();
        });

        $('#tbllugaresInter tbody tr').live('click', function(e) {
            $('#registro-seleccionado').html($(this).attr('data-nombre'));
        });
    });

    function consultarTodos() {
        mostrar_contenidos("sistema", "lugaresIntervencion",
                "busqueda_lugares_intervencion", $(this).serialize());
    }
    function mostrar_formulario_editar_lugar_intervencion() {
        var tabla = $('#tbllugaresInter').dataTable();
        var idFila = filaId(tabla);
        //alert(idFila);
        if (idFila != null) {
            mostrar_contenidos(
                    'sistema', 'lugaresIntervencion', 'editar_form_lugar_intervencion', 'id_lugar=' + idFila
                    );
        } else {
            alert('Seleccione un registro');
        }

    }
    
    function confirmar_eliminar_lugar_intervencion(){
         var tabla = $('#tbllugaresInter').dataTable();
        var idFila = filaId(tabla);
        //alert(idFila);
        if (idFila != null) {
            var tabla = $('#tbllugaresInter').dataTable();
            var nameTipo = filaSeleccionada(tabla, 'data-nombre');
           confirm( '¿Seguro que desea eliminar el lugar de intervencion <strong>'+nameTipo+'</strong>?', 'eliminar_lugar_intervencion();' );
        } else {
            alert('Seleccione un registro');
        }

    }    
    function eliminar_lugar_intervencion() {
        var tabla = $('#tbllugaresInter').dataTable();
        var idFila = filaId(tabla);
        //alert(idFila);
        if (idFila != null) {
            ejecutarAccionJson(
                    'sistema', 'lugaresIntervencion', 'eliminar_lugar_intervencion', 'id_lugar=' + idFila,
                    'mostrar_resultado_guardar( data, "abrir_listado_lugar_intervencion();", "" );'
                    );
        } else {
            alert('Seleccione un registro');
        }

    }
</script>

<script>
    agregar_boton_ayuda('LISTALUGARESINTERVENC');
</script>

