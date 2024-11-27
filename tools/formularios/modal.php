<div id="modal-nuevo_contacto_pep" class="modal hide fade" style="width: 600px;">
    <!-- Modal Body -->
    <div class="modal-body remove-padding" >
        <!-- Modal Tabs -->
        <div class="block-tabs block-themed" >
            <div class="block-options">
                <div class="btn-group">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
            </div>
            <ul class="nav nav-tabs" data-toggle="tabs">
                <li class="active"><a href="#modal-lugar"><i class="icon-map-marker"></i> Abordaje</a></li>
                <li><a href="#modal-pemar"><i class="icon-meh"></i> PEMAR</a></li>
                <li><a href="#modal-actividad" ><i class="icon-briefcase"></i> Actividad</a></li>
                <li><a href="#modal-salud" ><i class="icon-plus-sign-alt"></i> Salud</a></li>
                <li><a href="#modal-observacion" ><i class="icon-keyboard"></i> Observacion</a></li>
            </ul>
            <div class="tab-content" >
                <div class="tab-pane active" id="modal-lugar">
                    <form action="./" method="post" class="form-horizontal" onsubmit="return false;">
                        <div class="control-group">
                            <label class="control-label" for="input-datepicker-comp" data-toggle="tooltip" title="fecha y hora aproximada del contacto" >Fecha y Hora</label>
                            <div class="controls">
                                <div class="input-append date input-datepicker" data-date="2014-01-01" data-date-format="yyyy-mm-dd">
                                    <input type="text" id="input-datepicker-comp" name="input-datepicker-comp" class="input-small">
                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                </div>       
                                <div class="input-append bootstrap-timepicker">
                                    <input type="text" id="input-timepicker" name="input-timepicker" class="input-small input-timepicker">
                                    <span class="add-on"><i class="icon-time"></i></span>                                                
                                </div>
                            </div>
                        </div>


                        <div class="control-group">
                            <label class="control-label" for="general-chosen" data-toggle="tooltip" 
                                title="luego de seleccionar el lugar se debe verificar que el marcador corresponda al sitio seleccionado. De igual manera usted podra ubicar el marcador donde considere es el sitio exacto del contacto." >Lugar de Abordaje</label>
                            <div class="controls">
                                <select id="lugar_intervencion_contacto" name="lugar_intervencion_contacto" class="select-chosen">
                                    <option value=""></option>
                                    <?php foreach ($lugares as $lugar) { ?>
                                    <option value="<?php echo $lugar->ID_LUGAR; ?>" data-lat-lugar="<?php echo $lugar->LATITUD_LUGAR; ?>" data-lon-lugar="<?php echo $lugar->LONGITUD_LUGAR; ?>">
                                        <?php echo $lugar->NOMBRE_LUGAR; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <!-- Map with Markers Content -->
                        <div class="block-content block-content-flat"  data-toggle="tooltip" 
                                title="incialmente esta en su posicion actual. por favor, verifique que el navegador tenga permisos para leer su ubicacion actual." >
                            <div id="example-gmap-markers" class="gmap-con"></div>
                        </div>
                        <!-- END Map with Markers Content -->
                    </form>
                </div>
                <div class="tab-pane" id="modal-pemar">
                    <form action="./" method="post" class="form-horizontal" onsubmit="return false;">
                        <div class="control-group">
                            <label class="control-label" for="general-chosen9">Codigo PEMAR</label>
                            <div class="controls">
                                <input type="text" class="typeahead focused" id="codigo-pemar" name="codigo-pemar"  data-provide="typeahead" 
                                    data-items="4" data-source='[<?php print implode(',',$lista_codigos_pemar); ?>]' required >
                                <span class="help-block">Escriba el codigo de PEMAR!</span>
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
                                <select id="parroquia_intervencion_contacto" name=parroquia_intervencion_contacto" class="select-chosen">
                                    <option value=""></option>
                                    <?php foreach ($parroquias as $parroquia) { ?>
                                    <option value="<?php echo $parroquia->ID_PARROQUIA; ?>" title="<?php if( $parroquia->CABECERA_CANTONAL == 'SI' ){ echo 'Cabecera Cantonal'; } ?>" >
                                        <?php if( $parroquia->CABECERA_CANTONAL == 'SI' ){ echo '<b>['; } ?>
                                        <?php echo ($parroquia->NOMBRE_PARROQUIA); ?>
                                        <?php if( $parroquia->CABECERA_CANTONAL == 'SI' ) echo ']</b>'; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Tipo PEMAR</label>
                            <div class="controls">
                                <select id="tipo_pemar_intervencion_contacto" name="tipo_pemar_intervencion_contacto" class="select-chosen">
                                    <option value=""></option>
                                    <?php foreach ($tipos_pemars as $tipo) { ?>
                                    <option value="<?php echo $tipo->ID_TIPOPOBLACION; ?>"  >                                    
                                        <?php echo ("[".$tipo->CODIGO_TIPOPOBLACION."] ".$tipo->NOMBRE_TIPOPOBLACION); ?>                                        
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

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
                            <div class="block block-themed">
                                <div class="block-title">
                                    <h4><i class="icon-circle text-info"></i>Datos Privados</h4>
                                </div>
                                <div class="block-content">
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
                                                <input type="phone" id="general-prepend21" name="general-prepend21" class="input-small" min="0" placeholder="987984651516">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="general-prepend21">correo-e</label>
                                        <div class="controls">
                                            <div class="input-prepend">
                                                <span class="add-on"><i class="icon-mail"></i></span>
                                                <input type="email" id="general-prepend221" name="general-prepend221" class="input-small" min="0" placeholder="elcorre@delpemar.com">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane" id="modal-actividad">
                    <form action="./" method="post" class="form-horizontal" onsubmit="return false;">
                        
                        <div class="control-group">
                            <label class="control-label" for="temas_tratados_contacto">Temas Tratados</label>
                            <div class="controls">
                                <select id="temas_tratados_contacto" name="temas_tratados_contacto" class="select-chosen multiple" multiple>                                    
                                    <option value=""></option>
                                    <?php foreach ($temas as $tema) { ?>
                                    <option value="<?php echo $tema->ID_TEMA; ?>"  >                                    
                                        <?php echo ( $tema->TITULO_TEMA ); ?>                                        
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <h4 class="sub-header">Insumo entregados</h4>
                        <div class="control-group">
                            <label class="control-label" for="general-append11">Folletos</label>
                            <div class="controls">
                                <div class="input-append">
                                    <input type="number" min="0" id="general-append11" name="general-append11" class="input-mini">
                                    <span class="add-on">UND</span>
                                </div>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="general-append12">Condones</label>
                            <div class="controls">
                                <div class="input-append">
                                    <input type="number" min="0" id="general-append12" name="general-append12" class="input-mini">
                                    <span class="add-on">UND</span>
                                </div>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="general-append13">Lubicantes</label>
                            <div class="controls">
                                <div class="input-append">
                                    <input type="number" min="0" id="general-append13" name="general-append13" class="input-mini">
                                    <span class="add-on">UND</span>
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
                <div class="tab-pane" id="modal-salud" >
                    <form id="form-servicios-salud" action="./" method="post" class="form-horizontal" onsubmit="return false;" >
                        <div class="control-group">
                            <label class="control-label" for="servicio_salud_derivado">Centro de Servicios en Salud</label>
                            <div class="controls">
                                <select id="centro_servicio_salud_derivado" name="centro_servicio_salud_derivado" class="select-chosen" >
                                    <option value=""></option>
                                    <?php foreach ($centros_salud as $centro) { ?>
                                    <option value="<?php echo $centro->ID_CENTROSERVICIO; ?>"  >                                    
                                        <?php echo ( "[".$centro->IDENTIFICACION_CENTROSERVICIO."]".$centro->NOMBRE_CENTROSERVICIO ); ?>                                        
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        
                        <div class="control-group">
                            <label class="control-label" for="input-datepicker-comp" data-toggle="tooltip" title="fecha y hora ultima atencion" >Fecha y Hora de atención</label>
                            <div class="controls">
                                <div class="input-append date input-datepicker" data-date="2014-01-01" data-date-format="yyyy-mm-dd">
                                    <input type="text" id="input-datepicker-comp" name="input-datepicker-comp" class="input-small">
                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                </div>       
                                <div class="input-append bootstrap-timepicker">
                                    <input type="text" id="input-timepicker" name="input-timepicker" class="input-small input-timepicker">
                                    <span class="add-on"><i class="icon-time"></i></span>                                                
                                </div>
                            </div>
                        </div>
                        
                         
                        <div class="control-group">
                            <label class="control-label" for="servicio_salud_derivado">Servicio de Salud al que deriva</label>
                            <div class="controls">
                                <select id="servicio_salud_derivado" name="servicio_salud_derivado" class="select-chosen" multiple >
                                    <option value=""></option>
                                    <?php foreach ($servicios_salud as $servicio) { ?>
                                    <option value="<?php echo $servicio->ID_SERVICIO; ?>"  >                                    
                                        <?php echo ( "[".$servicio->CODIGO_SERVICIO."]".$servicio->NOMBRE_SERVICIO ); ?>                                        
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>


                    </form>
                </div>
                <div class="tab-pane" id="modal-observacion">
                    <div class="control-group">                        
                        <textarea id="textarea-editor" name="textarea-editor" class="textarea-editor textarea-large" rows="10">...</textarea>
                        <span class="help-block">permite agregar <code>informacion adicional</code> del contacto. como preguntas del contactado u otra observacion pertinente.</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Modal Tabs -->
    </div>

    <div class="modal-footer">
        <button class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button class="btn btn-success">Guardar</button>
    </div>
</div>

<script>



$(document).ready(function() {    


});








function abrir_modal_contacto () {
    
      // Initialize tabs
    $('[data-toggle="tabs"] a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });
    
    $('#modal-nuevo_contacto_pep').modal('show');

    setTimeout(function(){
         
        // Set default height to all Google Maps Containers
        $('#example-gmap-markers').css('height', '260px');

        // Initialize map geolocation
        var gmapGeolocation = new GMaps({
            div: '#example-gmap-markers',
            lat: 0,
            lng: 0
        });
        GMaps.geolocate({
            success: function(position) {
                gmapGeolocation.setCenter(position.coords.latitude, position.coords.longitude);
                gmapGeolocation.addMarker({
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                    title: 'GeoLocation',
                    infoWindow: {
                        content: '<p class="text-success"><i class="icon-map-marker"></i> <strong>Your location!</strong></p>'
                    }
                });
            },
            error: function(error) {
                alert('Geolocation failed: ' + error.message);
            },
            not_supported: function() {
                alert("Your browser does not support geolocation");
            },
            always: function() {
                // Message when geolocation succeed
            }
        });

    },1000);
 
 }     

 </script>