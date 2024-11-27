

<div id="pre-page-content">
    <h1>
        <i class="glyphicon-globe themed-color"></i> Navegación Web<br>
        <small>Tabla histórica de navegación en la web.</small>
    </h1>
</div>

<div id="page-content">
     <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="205">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="#">Receptor</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Navegación en ponteonce.org</a></li>
    </ul>
  

    <div class=" row-fluid botones_arriba" >
        <div class=" span4 btn-group text-left">	
        </div>
        <div class="span4 text-center">
            <i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span>
        </div>
        <div class=" span4 btn-group text-right">                
        </div>
    </div>

    <div class="block-section">        
        <style>
            .text_wrap {
                word-wrap: break-word;
                word-break: break-all;
            }
        </style>
        <table id="tblNavegacion" class="table table-bordered table-hover table-condensed dataTable" >
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Código PEMAR</th>
                    <th>Viene de</th>
                    <th>URL</th>
                    <th>Página</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if( !empty($navegacion_web ) )
                foreach ($navegacion_web as $navegacion) : ?>  
                    <tr fila-id="<?php echo ($navegacion->ID_NAVEGACION) ?>"  data-nombre="<?php echo ($navegacion->CODIGO_PEMAR) ?>">                                    
                        <td><?php echo ($navegacion->FECHA_SYSTEMA) ?></td> 
                        <td><?php echo ($navegacion->CODIGO_PEMAR) ?></td>
                        <td class="" ><a title="ir a la pagina" target="_blank" href="<?php echo ( $navegacion->URL_ANTERIOR ) ?>"><h4><?php echo $this->plantilla->saca_dominio_url( $navegacion->URL_ANTERIOR ) ?></h4></a></td>
                        <td class="text_wrap"  ><a title="ir a la pagina" target="_blank" href="<?php echo ( $navegacion->URL_ACTUAL ) ?>"><?php echo ($navegacion->URL_ACTUAL) ?></a></td>
                        <td><?php echo ($navegacion->TITULO_PAGINA) ?></td> 
                    <?php endforeach; ?>
            </tbody>
        </table>


    </div>
    <!-- END Dynamic Tables Section -->



</div>



<script>


    $(document).ready(function() {
//    var datos = new FormData();
//    
//    datos.append('archivo',$('#archivo')[0].files[0]);
//    
//    $.ajax({
//       type:"post",
//       dataType:"json",
//       url:"importar.php",
//       contentType:false,
//       data:datos,
//       processData:false,
//     }).done(function(respuesta){
//       alert(respuesta.mensaje);
//   });
        $('#tblNavegacion tbody tr').live('click', function(e) {
            $('#registro-seleccionado').html($(this).attr('data-nombre'));
        });

        //var tabla = $('#tblNavegacion').dataTable();

         $('#tblNavegacion').fnSort( [ [0,'desc'] ] );
    });

    function cargar_tabla() {

    }

</script>
<script>
    agregar_boton_ayuda('NAVEGACIONPONTEONCE');
</script>