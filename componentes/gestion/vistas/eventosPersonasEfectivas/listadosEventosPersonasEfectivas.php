
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-table themed-color"></i> Registro de Numero de Atenciones en el Servicio de Salud<br>
        <small>Todos los registros de atencion en salud</small>
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
            <a href="#">Formularios</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Registros numero atencion salud</a></li>
    </ul>
    <!-- END Breadcrumb -->



    <table class="botones_arriba" align="center" ><tr><td>
                <div class=" span1 btn-group">
                    <a href="javascript:abrir_form_nuevo_numero_atencion_salud();" data-toggle="tooltip" title="Agregar nuevo Formulario al Registro" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo</a>						
                </div>
                <span class="span3 text-center"><i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span> </span>
                <div class="btn-group">
                    <a href="javascript:abrir_ver_datos_registro_numero_atencion();" data-toggle="tooltip" title="ver Contactos " class="btn btn-lg btn-info"><i class="icon-eye-open"></i></a>
                    <a href="javascript:mostrar_formulario_editar_numero_atencion_salud();" data-toggle="tooltip" title="Editar Formulario" class="btn btn-lg btn-success"><i class="icon-pencil"></i></a>
                    <a href="javascript:eliminar_numero_atencion_salud();" data-toggle="tooltip" title="Borrar Formulario" class="btn btn-lg btn-danger"><i class="icon-remove"></i></a>
                </div>
            </td></tr></table>

    <!-- Dynamic Tables Section -->
    <div class="block-section">
        <table id="tblRegistroNumeroAtencionSalud" class="table table-striped dataTables" >
            <thead>
                <tr>
                    <th>Mes</th>
                    <th>Unidad de salud</th>
                    <th>Servicio</th>
                    <th>Numero Personas Atendidas</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>    
                <?php foreach ($registrosNumeroAtencionSalud as $registroNumAtencionSalud) : ?>
                    <tr fila-id="<?php echo ($registroNumAtencionSalud->ID_ATENCION_SALUD) ?>" data-nombre="<?php echo ($registroNumAtencionSalud->MES_ATENCIONES_SALUD . "-" . $registroNumAtencionSalud->NOMBRE_CENTROSERVICIO) ?>">
                        <td class="mesAtencion"><?php echo ($registroNumAtencionSalud->MES_ATENCIONES_SALUD)?> - <?php echo ($registroNumAtencionSalud->ANO_ATENCIONES_SALUD) ?></td>
                        <td><?php echo ($registroNumAtencionSalud->NOMBRE_CENTROSERVICIO) ?></td>
                        <td><?php echo ($registroNumAtencionSalud->NOMBRE_SERVICIO) ?></td>                        
                        <td><?php echo ($registroNumAtencionSalud->NUMERO_PEMAR) ?></td>
                        <td><?php echo ($registroNumAtencionSalud->OBSERVACIONES) ?></td>

                    </tr>
                <?php endforeach; ?> 

            </tbody>
        </table>    
    </div>
    <!-- END Dynamic Tables Section -->


</div>



<script>
    $(document).ready(function() {
        $('#tblRegistroNumeroAtencionSalud tbody tr').dblclick(function(e) {
            $(this).addClass('row_selected');
            
            $('#registro-seleccionado').html($(this).attr('data-nombre'));
            mostrar_formulario_editar_numero_atencion_salud();
        });
        
        $('#tblRegistroNumeroAtencionSalud tbody tr').on('click', function(e) {
            $('#registro-seleccionado').html($(this).attr('data-nombre'));
        });
   /*   $('#tblRegistroNumeroAtencionSalud .mesAtencion').each(function()
        {
            
            switch ($(this).html().trim()[1]) {
                case '1':
                    $(this).html('Enero');
                    break;
                case '2':
                    $(this).html('Febrero');
                    break;
                case '3':
                    $(this).html('Marzo');
                    break;
                case '4':
                    $(this).html('Abril');
                    break;
                case '5':
                    $(this).html('Mayo');
                    break;
                case '6':
                    $(this).html('Junio');
                    break;
                case '7':
                    $(this).html('Julio');
                    break;
                case '8':
                    $(this).html('Agosto');
                    break;
                case '9':
                    $(this).html('Septiembre');
                    break;
                case '10':
                    $(this).html('Octubre');
                    break;
                case '11':
                    $(this).html('Noviembre');
                    break;
                case '12':
                    $(this).html('Diciembre');
                    break;
            } 
        }); */
    });
    function mostrar_formulario_editar_numero_atencion_salud() {

        var tabla = $('#tblRegistroNumeroAtencionSalud').dataTable();
        var idFila = filaId(tabla);
        if(idFila != null){
            mostrar_contenidos(
                'monitores', 'registroNumeroAtencionSalud', 'editar_form_numero_atencion_salud', 'id_atencion_salud=' + idFila
            );
        }else{
               
        }
       
    }
    function eliminar_numero_atencion_salud() {
        var tabla = $('#tblRegistroNumeroAtencionSalud').dataTable();
        var idFila = filaId(tabla);
        if(idFila != null){
            ejecutarAccionJson(
                    'monitores', 'registroNumeroAtencionSalud', 'eliminar_numero_atencion_salud', 'id_atencion_salud=' + idFila,
                    'mostrar_resultado_guardar( data, abrir_listado_numero_atencion_salud(), "" );'
                    );
        }else{
                alert('Seleccione un registro');
        }
        
    }
    function abrir_ver_datos_registro_numero_atencion(){
        var tabla = $('#tblRegistroNumeroAtencionSalud').dataTable();   
        var idFila = filaId( tabla );
        if(idFila != null){
            mostrar_datos_registro_numero_atencion( idFila )
        }else{

            }
    }
</script>


