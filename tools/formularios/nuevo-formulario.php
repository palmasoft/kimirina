
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
            <a href="#">Forms</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="">General</a></li>
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
        <!-- END General Forms Title -->

         <div class="block-content">
            <form action="page_forms_layouts_styles.php" method="post" class="form-inline" onsubmit="return false;">                    
                <!-- Geo-referencia o Lugar -->
                <h4 class="sub-header">Georreferenciacion</h4>
                <div class="row-fluid">
                    <div class="span3">
                        <div class="control-group">
                            <label class="control-label">Región</label>
                            <div class="controls">
                                <select id="region-chosen" name="region-chosen" class="select-chosen span9">
                                    <option value >seleccione uno</option>
                                    <option value="html">html</option>
                                    <option value="css">css</option>
                                    <option value="javascript">javascript</option>
                                    <option value="php">php</option>
                                    <option value="mysql">mysql</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="span3">
                        <div class="control-group">
                            <label class="control-label">Provincia</label>
                            <div class="controls">
                                <select id="provincia-chosen" name="provincia-chosen" class="select-chosen span9">
                                    <option value >seleccione uno</option>
                                    <option value="html">html</option>
                                    <option value="css">css</option>
                                    <option value="javascript">javascript</option>
                                    <option value="php">php</option>
                                    <option value="mysql">mysql</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="span3">
                        <div class="control-group">
                            <label class="control-label">Cantón</label>
                            <div class="controls">
                                <select id="canton-chosen" name="canton-chosen" class="select-chosen span9">
                                    <option value >seleccione uno</option>
                                    <option value="html">html</option>
                                    <option value="css">css</option>
                                    <option value="javascript">javascript</option>
                                    <option value="php">php</option>
                                    <option value="mysql">mysql</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="span3">
                        <div class="control-group">
                            <label class="control-label">Parroquia</label>
                            <div class="controls">
                                <select id="parroquia-chosen" name="parroquia-chosen" class="select-chosen span9">
                                    <option value >seleccione uno</option>
                                    <option value="html">html</option>
                                    <option value="css">css</option>
                                    <option value="javascript">javascript</option>
                                    <option value="php">php</option>
                                    <option value="mysql">mysql</option>
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

                                <select id="general-chosen" name="general-chosen" class="select-chosen">
                                    <option value="html">html</option>
                                    <option value="css">css</option>
                                    <option value="javascript">javascript</option>
                                    <option value="php">php</option>
                                    <option value="mysql">mysql</option>
                                </select>


                            </div>
                        </div>                            
                    </div>
                    <div class="span4">
                        <div class="control-group">
                        <div class="controls">
                                <label class="control-label">Codigo Unico Sistema</label>
                            
                                <div class="input-prepend" >
                                    <span class="add-on">CUP</span>
                                    <input type="text" id="general-prepend1" name="general-prepend1" class="input-large"  placeholder="CODIGO" readonly>
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
        <div class="block-content text-center">
            <a href="" data-toggle="tooltip" title="clic para eliminar todos los registros" class="btn btn-danger"><i class="glyphicon-bin"></i> borrar todo</a>                
            <a href="javascript:abrir_modal_contacto()" data-toggle="tooltip" title="clic para agregar un nuevo registro" class="btn btn-info" ><i class="icon-pushpin"></i> AGREGAR REGISTRO DE CONTACTO</a>                

            <table id="example-datatables" class="table table-bordered table-hover dataTables">
                <thead>
                    <tr>
                        <th class="span1 text-center hidden-phone">#</th>
                        <th>Dia</th>
                        <th>Lugar</th>
                        <th>PEMAR</th>
                        <th>Nuevo</th>
                        <th>Codigo</th>
                        <th>Edad</th>
                        <th>Temas</th>
                        <th>Insumos</th>
                        <th>Centro de Salud</th>                                
                        <th class="span1 text-center"><i class="icon-bolt"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=1; $i<=31; $i++) { ?>
                    <tr>
                        <td class="span1 text-center hidden-phone"><?php echo $i; ?></td>
                        <td class="text-center"><?php echo $i; ?></td>
                        <td class="text-center"><?php echo $i; ?></td>
                        <td class="text-center"><?php echo $i; ?></td>
                        <td class="text-center"><?php echo $i; ?></td>                                
                        <td class="text-center"><?php echo $i; ?></td>
                        <td class="text-center"><?php echo $i; ?></td>
                        <td class="text-center"><?php echo $i; ?></td>
                        <td class="text-center"><a href="javascript:void(0)">username<?php echo $i; ?></a></td>
                        <td class="text-center">user<?php echo $i; ?>@example.com</td>
                        <td class="span1 text-center">
                            <div class="btn-group">
                                <a href="javascript:void(0)" data-toggle="tooltip" title="Editar" class="btn btn-mini btn-success"><i class="icon-pencil"></i></a>
                                <a href="javascript:void(0)" data-toggle="tooltip" title="Borrar" class="btn btn-mini btn-danger"><i class="icon-remove"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>







<div id="modal-tabbed" class="modal hide fade">
    <!-- Modal Body -->
    <div class="modal-body remove-padding">
        <!-- Modal Tabs -->
        <div class="block-tabs block-themed">
            <div class="block-options">
                <div class="btn-group">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
            </div>
            <ul class="nav nav-tabs" data-toggle="tabs">
                <li class="active"><a href="#modal-home"> Abordaje</a></li>
                <li><a href="#modal-profile"> PEMAR</a></li>
                <li><a href="#modal-messages" data-toggle="tooltip" title="Messages"><i class="icon-envelope"></i> Actividad del PEP</a></li>
                <li><a href="#modal-options" data-toggle="tooltip" title="Options"><i class="icon-cog"></i> Observaciones</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="modal-home">
                    <form action="page_forms_pickers_grid.php" method="post" class="form-horizontal" onsubmit="return false;">


                        <div class="control-group">
                            <label class="control-label" for="input-datepicker-comp">Fecha y Hora</label>
                            <div class="controls">
                                <div class="input-append date input-datepicker" data-date="01-01-2014" data-date-format="dd-mm-yyyy">
                                    <input type="text" id="input-datepicker-comp" name="input-datepicker-comp" class="input-small">
                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                </div>       
                                <div class="input-append bootstrap-timepicker">
                                    <input type="text" id="input-timepicker" name="input-timepicker" class="input-mini input-timepicker">
                                    <span class="add-on"><i class="icon-time"></i></span>                                                
                                </div>
                            </div>
                        </div>


                        <div class="control-group">
                            <label class="control-label" for="general-chosen">Lugar de Abordaje</label>
                            <div class="controls">
                                <select id="general-chosen" name="general-chosen" class="select-chosen">
                                    <option value="html">html</option>
                                    <option value="css">css</option>
                                    <option value="javascript">javascript</option>
                                    <option value="php">php</option>
                                    <option value="mysql">mysql</option>
                                </select>
                            </div>
                        </div>
                        <!-- Map with Markers Content -->
                        <div class="block-content block-content-flat">
                            <div id="example-gmap-markers" class="gmap-con"></div>
                        </div>
                        <!-- END Map with Markers Content -->

                        
                    </form>
                </div>
                <div class="tab-pane" id="modal-profile">

                    <form action="page_forms_pickers_grid.php" method="post" class="form-horizontal" onsubmit="return false;">

                        <div class="control-group">
                            <label class="control-label" for="general-chosen9">Codigo PEMAR</label>
                            <div class="controls">
                                <input type="text" class="typeahead focused" id="codigo-pemar" name="codigo-pemar"  data-provide="typeahead" 
                                    data-items="4" data-source='[avion,carne,sopa,ladron,abanico,banico]' required >
                                <span class="help-block">Escriba el codigo del PEMAR!</span>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="horizontal-text">Periodicidad</label>
                            <div class="controls">
                                <input type="text" id="horizontal-text" name="horizontal-text" value="nuevo" readonly >
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Parroquia</label>
                            <div class="controls">
                                <select id="parroquia-chosen2" name="parroquia-chosen2" class="select-chosen">
                                    <option value >seleccione uno</option>
                                    <option value="html">html</option>
                                    <option value="css">css</option>
                                    <option value="javascript">javascript</option>
                                    <option value="php">php</option>
                                    <option value="mysql">mysql</option>
                                </select>
                            </div>
                        </div>

                         <!-- Color Pickers Block -->
                        <div class="block block-themed">
                            <!-- Color Pickers Title -->
                            <div class="block-title">
                                <h4><i class="icon-circle text-info"></i>Datos Privados</h4>
                            </div>
                            <!-- END Color Pickers Title -->

                            <!-- Color Pickers Content -->
                            <div class="block-content">



                                <div class="control-group">
                                    <label class="control-label" for="input-datepicker-comp">Fecha de Nacimiento</label>
                                    <div class="controls">
                                        <div class="input-append date input-datepicker" data-date="2014-01-01" data-date-format="yyyy-mm-dd">
                                            <input type="text" id="input-datepicker-comp" name="input-datepicker-comp" class="input-small">
                                            <span class="add-on"><i class="icon-calendar"></i></span>
                                        </div>    
                                    </div>
                                </div>





                                <div class="control-group">
                                    <label class="control-label" for="general-prepend2">Identificacion</label>
                                    <div class="controls">
                                        <div class="input-prepend">
                                            <span class="add-on"><i class="icon-barcode"></i>D.I.</span>
                                            <input type="number" id="general-prepend2" name="general-prepend2" class="input-small" min="0" placeholder="987984651516">
                                        </div>
                                    </div>
                                </div>


                                <div class="control-group">
                                    <label class="control-label" for="horizontal-text">Nombre Legal</label>
                                    <div class="controls">
                                        <input type="text" id="horizontal-text" name="horizontal-text">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="horizontal-password">Nombre 2</label>
                                    <div class="controls">
                                        <input type="text" id="horizontal-password" name="horizontal-password">
                                    </div>
                                </div>


                                <div class="control-group">
                                    <label class="control-label" for="general-prepend21">telefono(s)</label>
                                    <div class="controls">
                                        <div class="input-prepend">
                                            <span class="add-on"><i class="icon-phone"></i></span>
                                            <input type="number" id="general-prepend21" name="general-prepend21" class="input-small" min="0" placeholder="987984651516">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END Color Pickers Content -->
                        </div>
                        <!-- END Color Pickers Block -->



                    </form>
                </div>
                <div class="tab-pane" id="modal-messages">Messages Content..</div>
                <div class="tab-pane" id="modal-options">Options Content..</div>
            </div>
        </div>
        <!-- END Modal Tabs -->
    </div>
</div>


</div>
<!-- END Page Content -->



<script>
$(document).ready(function() {       
        
});  


function abrir_modal_contacto () {

    $('#modal-tabbed').modal('show');
    setTimeout(function(){
         
        // Set default height to all Google Maps Containers
        $('#example-gmap-markers').css('height', '260px');
        // Initialize map with markers
        new GMaps({
            div: '#example-gmap-markers',
            lat: 0,
            lng: 0,
            zoom: 1
        }).addMarkers([
            { lat: 30, lng: -30, title: 'Marker #1', infoWindow: { content: '<p>Marker #1: HTML Content</p>'} },
            { lat: -50, lng: 10, title: 'Marker #2', infoWindow: { content: '<p>Marker #2: HTML Content</p>'} },
            { lat: -30, lng: 90, title: 'Marker #3', infoWindow: { content: '<p>Marker #3: HTML Content</p>'} }
        ]);

    },1000);
 
 }     
</script>

