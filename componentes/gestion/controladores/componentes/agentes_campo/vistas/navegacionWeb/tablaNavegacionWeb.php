
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-user themed-color"></i> Navegacion Web<br>
        <small>Tabla historica de navegacion en la web.</small>
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
            <a href="#">Sistema</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Navegacion</a></li>
    </ul>
    <!-- END Breadcrumb -->
    
    <div class=" row-fluid botones_arriba" >
        <div class=" span4 btn-group text-left">	
        </div>
        <div class="span4 text-center">
            <i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span>
        </div>
        <div class=" span4 btn-group text-right">                
        </div>
    </div>



    <!-- Dynamic Tables Section -->
    <div class="block-section">


        <table id="tblNavegacion" class="table table-bordered table-hover dataTables" >
            <thead>
                <tr>
                    <th>Codigo PEMAR</th>
                    <th>De donde vienes</th>
                    <th>URL Actual</th>
                    <th>Dominio Web</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($navegacion_web as $navegacion) : ?>  
                    <tr fila-id="<?php echo ($navegacion->ID_NAVEGACION) ?>"  data-nombre="<?php echo ($navegacion->CODIGO_PEMAR) ?>">                
                        <td><?php echo ($navegacion->CODIGO_PEMAR) ?></td>
                        <td><?php echo ($navegacion->URL_ANTERIOR) ?></td>
                        <td><?php echo ($navegacion->URL_ACTUAL) ?></td>
                        <td><?php echo ($navegacion->DOMINIO_WEB) ?></td> 
                <?php endforeach; ?>
            </tbody>
        </table>
       

    </div>
    <!-- END Dynamic Tables Section -->



</div>



<script>
    

$(document).ready(function() {    
    var datos = new FormData();
    datos.append('archivo',$('#archivo')[0].files[0]);
    
    $.ajax({
       type:"post",
       dataType:"json",
       url:"importar.php",
       contentType:false,
       data:datos,
       processData:false,
     }).done(function(respuesta){
       alert(respuesta.mensaje);
   });
    $('#tblNavegacion tbody tr').live('click', function(e) {
        $('#registro-seleccionado').html($(this).attr('data-nombre'));
    });
});

function cargar_tabla(){
    
}

</script>