
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-notes_2 themed-color"></i> Nuevo Formulario de Contacto<br><small>Primero debes digitar los datos del formulario!</small></h1>
</div>
<!-- END Pre Page Content -->

<!-- Page Content -->
<div id="page-content">
    <!-- Breadcrumb -->
    <!-- You can have the breadcrumb stick on scrolling just by adding the following attributes with their values (data-spy="affix" data-offset-top="250") -->
    <!-- You can try it on other elements too :-), the sticky position and style can be adjusted in the css/main.css with .affix class -->
    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="250">
        <li>
            <a href="index.php"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="#">Formularios</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="">Nuevo Formulario de PEP</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <!-- General Forms Block -->
    <div class="block block-themed block-last">
        <!-- General Forms Title -->
        <div class="block-title">
            <h4><a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Generales"><i class="icon-arrow-up"></i></a>  Datos Generales del Formulario</h4>
            <div class="block-options">
                <div class="input-prepend" style="float: right;margin: 5px 10px;" >
                    <a href="javascript:void(0)" data-toggle="tooltip" title="clic para generar el CODIGO" class="btn btn-lg btn-info">CODIGO <i class="glyphicon-magic"></i></a>           
                    <input type="text" id="codigo-formulario" name="codigo-formulario" placeholder="debes generarlo " readonly >                     
               </div>
            </div>            
        </div>

         <div class="block-content">
            <form action="page_forms_layouts_styles.php" method="post" class="form-inline" onsubmit="return false;">                    
                <!-- Geo-referencia o Lugar -->
                <h4 class="sub-header">Georreferenciacion</h4>
                <div class="row-fluid">
                    <div class="span3">
                        <div class="control-group">
                            <label class="control-label">Región</label>
                            <div class="controls">
                                <select id="region-chosen" name="region-chosen" class="select-chosen span9" onchange=" cargar_provincias ()" > 
                                    <option value >seleccione uno</option>
                                    <?php foreach ($regiones as $region) { ?>
                                        <option value="<?php echo $region->ID_REGION ?>"><?php echo htmlentities($region->NOMBRE_REGION) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="span3">
                        <div class="control-group">
                            <label class="control-label">Provincia</label>
                            <div id="lista-provincia" class="controls">
                                <select id="provincia-chosen" name="provincia-chosen" class="select-chosen span9">
                                    <option value >seleccione la region</option>
                                    <?php foreach ($provincias as $provincia) { ?>
                                        <option disabled="disabled" value="<?php echo $provincia->ID_PROVINCIA ?>"><?php echo htmlentities($provincia->NOMBRE_PROVINCIA) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="span3">
                        <div class="control-group">
                            <label class="control-label">Cantón</label>
                            <div id="lista-cantones" class="controls">
                                <select id="canton-chosen" name="canton-chosen" class="select-chosen span9">
                                    <option value >seleccione uno</option>                                    
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="span3">
                        <div class="control-group">
                            <label class="control-label">Parroquia</label>
                            <div  id="lista-parroquias" class="controls">
                                <select id="parroquia-chosen" name="parroquia-chosen" class="select-chosen span9">
                                    <option value >seleccione uno</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Prepend Content -->
                <h4 class="sub-header">Encargado del Contacto </h4>
                <div class="row-fluid">                        
                    <div class="span3">
                        <div class="control-group">
                            <label class="control-label">PEP'S</label>
                            <div class="controls">
                                <select id="promotor-formulario" name="promotor-formulario" class="select-chosen" onchange="mostar_otro_nombre_pep();" >
                                    <option value >seleccione el promotor</option>
                                    <?php foreach ($Promotores as $promotor) { ?>
                                    <option data-alias="<?php echo $promotor->NOMBRE_OTRO_PERSONA ?>"  
                                        data-nombre-alias="<?php echo $promotor->ALIAS_TIPOPOBLACION ?>" 
                                        data-codigo-tipo="<?php echo $promotor->CODIGO_TIPOPOBLACION ?>" 
                                        value="<?php echo $promotor->ID_PERSONA ?>"><?php echo htmlentities($promotor->NOMBRE_REAL_PERSONA) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>                            
                    </div>
                    <div class="span4">
                        <div class="control-group">
                        <div class="controls">
                                <label id="alias-nombre-pep" class="control-label">Segundo Nombre </label>
                            
                                <div class="input-prepend" >
                                    <span id="tipo-poblacion-pep" class="add-on">CUP</span>
                                    <input type="text" id="alias-pep" name="alias-pep" class="input-large"  placeholder="CODIGO" readonly>
                                </div>


                            </div>
                        </div>                            
                    </div>
                    <div class="span5">
                        <div class="control-group">
                        <label class="control-label">Fechas de Contactos</label>
                        <div class="controls">
                            <div id="example-advanced-daterangepicker" class="btn btn-info advanced-daterangepicker">
                                <i class="icon-calendar"></i>
                                <span></span>
                                <b class="caret"></b>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </form>
        </div>

    </div>

    <div class="block block-themed block-last">
        <div class="block-title">
            <h4><a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Carga de Archivos"><i class="icon-arrow-up"></i></a>  Carga de Archivos de Soporte <small>Solo debe <code>arrastrar y soltar</code> sobre el recuadro, los archivos escaneados de los formularios!</small></h4>
        </div>

        <div class="block-content ">
            <form action="archivos.php" class="dropzone">
                <div class="fallback">
                    <input type="file" id="file3" name="file3" multiple>
                </div>
            </form>
        </div>
    </div>

    <div class="block block-themed block-last">
        <div class="block-title">
            <h4><a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Registro de Contactos"><i class="icon-arrow-up"></i></a>  Registros de PEMARs Alcanzados <small>aca se debe cliquear sobre el botón <code>Agregar Registro de Contacto</code>!</small></h4>
        </div>
        <div class="block-content text-center" style="padding: 0px;">

            <div class="btn-group">
                <a href="javascript:void(0)"  data-toggle="tooltip" title="Eliminar Todo" class="btn btn-small btn-danger"><i class="glyphicon-bin"></i> borrar todo</a>                
                <a id="abrir-formulario-nuevo" href="javascript:void(0)" data-toggle="tooltip" title="Agregar Nuevo" class="btn btn-small btn-info" ><i class="icon-pushpin"></i> agregar registro de contacto</a>                
                <a href="javascript:void(0)"  data-toggle="tooltip" title="Editar Seleccionado" class="btn btn-small btn-success"><i class="icon-pencil"></i> editar</a>
                <a href="javascript:void(0)"  data-toggle="tooltip" title="Borrar Seleccionado" class="btn btn-small btn-danger"><i class="icon-remove"></i> eliminar</a>
            </div>



            <table id="example-datatables" class="table table-bordered table-hover dataTables">
                <thead>
                    <tr>
                        <th class="span1 text-center hidden-phone">#</th>
                        <th>Dia</th>
                        <th>Lugar</th>
                        <th>PEMAR</th>
                        <th class="span1 text-center hidden-phone">Nuevo</th>
                        <th>Codigo</th>
                        <th>Edad</th>
                        <th class="span1 text-center hidden-phone">Temas</th>
                        <th class="span1 text-center hidden-phone">Insumos</th>
                        <th class="span1 text-center hidden-phone">Salud</th>                                
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=1; $i<=31; $i++) { ?>
                    <tr>
                        <td class="span1 text-center hidden-phone"><?php echo $i; ?></td>
                        <td class="text-center"><?php echo $i; ?></td>
                        <td class="text-center"><?php echo $i; ?></td>
                        <td class="text-center"><?php echo $i; ?></td>
                        <td class="text-center hidden-phone"><?php echo $i; ?></td>                                
                        <td class="text-center"><?php echo $i; ?></td>
                        <td class="text-center"><?php echo $i; ?></td>
                        <td class="text-center hidden-phone"><?php echo $i; ?></td>
                        <td class="text-center hidden-phone"><a href="javascript:void(0)">username<?php echo $i; ?></a></td>
                        <td class="text-center hidden-phone">user<?php echo $i; ?>@example.com</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

<?php //$this->mostrar( "formularios/modal", array() ); ?>
</div>

<script>
$(document).ready(function() {       
    
    $(".dropzone").dropzone();

    $('#promotor-formulario').on('change', function(evt, params) { 
        var miValue = $( this ).val();
        if (miValue >0){
            $('#alias-pep').attr( 'value', $( "#promotor-formulario option[value="+miValue+"]").attr('data-alias') );
            $('#alias-nombre-pep').html( $( "#promotor-formulario option[value="+miValue+"]").attr('data-nombre-alias') );
            $('#tipo-poblacion-pep').html( $( "#promotor-formulario option[value="+miValue+"]").attr('data-codigo-tipo') );
        }

    });
    
    $('#abrir-formulario-nuevo').on('click', function(evt, params) { 
        abrir_formulario_nuevo_contacto();
    });  
    
});  

function cargar_provincias () {
    ejecutarAccionSinBloqueo( 
            "sistema", "ubicacion", "lista_seleccion_provincias", "id_region="+$('#region-chosen').val(), 
            "$('#lista-provincia').html(data);  $('#sel-lista-provincia').chosen({width: '95%'}); ");
     cargar_cantones ();
     cargar_parroquias();
}

function cargar_cantones () {
    ejecutarAccionSinBloqueo( 
            "sistema", "ubicacion", "lista_seleccion_cantones", "id_provincia="+$('#sel-lista-provincia').val(), 
            "$('#lista-cantones').html(data);  $('#sel-lista-cantones').chosen({width: '95%'}); ");    
     cargar_parroquias();
}

function cargar_parroquias () {
    ejecutarAccionSinBloqueo( 
            "sistema", "ubicacion", "lista_seleccion_parroquias", "id_canton="+$('#sel-lista-cantones').val(), 
            "$('#lista-parroquias').html(data);  $('#sel-lista-parroquias').chosen({width: '95%'}); ");
}

function cargar_promotores () {
    ejecutarAccionSinBloqueo( 
            "supervision", "consolidadopromotores", "lista_seleccion_promotores", "id_monitor="+$('#monitor-formulario').val(), 
            "$('#lista-promotores').html(data);  $('#promotor-formulario').chosen({width: '95%'}); ");    
     cargar_parroquias();
}

</script>

