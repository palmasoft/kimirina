
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-notes_2 themed-color"></i> Recibo de Centro de Servicos<br>
        <small>REGISTRO DE LA INFORMACION DE LOS CENTROS DE SERVICIOS.</small>
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
            <a href="javascript:abrir_listado_centro_salud();">Listado Ubicaciones</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Recibo centro servicios</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <div class="block  block-themed" >
        <div class="block-title">
            <h4>
                <a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Generales"><i class="icon-arrow-up"></i></a>  
                Datos 
            </h4>
            <div class="block-options">            
            </div>  
        </div>
        <div class="block-content"> 
            
        <form id="form-ubicaciones_centro" class="form-horizontal" onsubmit="return false;" >       
            <input type="hidden" id="registro-id" name="registro-id" value="<?php echo isset($ubicaciones) ? ($ubicaciones->ID_CENTROSERVICIO) : ''; ?>" />             
                                <!-- SUBRECEPTOR -->
                <div class="control-group form-horizontal">
                    <label class="control-label" for="subreceptor">Subreceptor</label>
                    <div class="controls">

                        <select id="subreceptor" name="subreceptor" class="select-chosen" size="1">
                            <option value >Ninguno</option>
                            <?php
                            foreach ($subreceptores as $subreceptor) {
                                $selected = "";
                                if (isset($ubicaciones))
                                    if ($ubicaciones->ID_SUBRECEPTOR == $subreceptor->ID_SUBRECEPTOR)
                                        $selected = "selected";

                                echo ('<option value="' . $subreceptor->ID_SUBRECEPTOR . '" ' . $selected . ' >' . $subreceptor->SIGLAS_SUBRECEPTOR . '</option>');
                            }
                            ?>
                        </select>

                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Tipo de Centro</label>
                    <div id="listado-servicios" class="controls">
                        <select id="sel-lista-servicios" name="id_servicio" class="select-chosen"  size="1">
                            <option value >seleccione el centro</option>
                            <?php
                            foreach ($tipocentros as $tipocentro) {
                                $selected = "";
                                if (isset($ubicaciones))
                                    if ($ubicaciones->ID_TIPO_CENTROSERVICIO == $tipocentro->ID_TIPO_CENTROSERVICIO)
                                        $selected = "selected";
                                ?>
                                <option value="<?php echo $tipocentro->ID_TIPO_CENTROSERVICIO ?>" <?php echo $selected; ?> ><?php echo ($tipocentro->NOMBRE_TIPO_CENTROSERVICIO) ?></option>
                                <?php } ?>
                        </select>
                    </div>
                </div> 
                

                <div class="control-group">
                    <label class="control-label">Provincia</label>
                    <div id="lista-provincia" class="controls">
                        <select id="provincia-chosen" name="provincia-chosen" class="select-chosen" size="1">
                            <option value >seleccione la provincia</option>
                            <?php
                            foreach ($provincias as $provincia) {
                                $selected = "";
                                if (isset($ubicaciones))
                                    if ($ubicaciones->ID_PROVINCIA == $provincia->ID_PROVINCIA)
                                        $selected = "selected";
                                ?>
                                <option value="<?php echo $provincia->ID_PROVINCIA ?>" <?php echo $selected; ?> ><?php echo ($provincia->NOMBRE_PROVINCIA) ?></option>
                                <?php } ?>
                        </select>
                    </div>

                </div>
                <div class="control-group">
                    <label class="control-label">Cantón</label>
                    <div id="listado-cantones" class="controls">
                        <select id="cantones" name="cantones" class="select-chosen"  size="1">
                            <option value >seleccione el canton</option>
                            <?php
                            foreach ($cantones as $canton) {
                                $selected = "";
                                if (isset($ubicaciones))
                                    if ($ubicaciones->ID_CANTON == $canton->ID_CANTON)
                                        $selected = "selected";
                                ?>
                                <option value="<?php echo $canton->ID_CANTON ?>" <?php echo $selected; ?> ><?php echo ($canton->NOMBRE_CANTON) ?></option>
                                <?php } ?>
                        </select>
                    </div>
                </div> 
                <div class="control-group">
                    <label class="control-label" for="nombre-ubicacion">Nombre del Centro</label>
                    <div class="controls">
                        <input type="text" name="nombre-ubicacion" placeholder="nombre" value="<?php echo isset($ubicaciones) ? ($ubicaciones->NOMBRE_CENTROSERVICIO) : ''; ?>" class="required" required="required"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="identificacion-ubicaicion">Identificacion del Centro</label>
                    <div class="controls">
                        <input type="text" name="identificacion-ubicaicion" class="sinEspacios" placeholder="identificaion" value="<?php echo isset($ubicaciones) ? ($ubicaciones->IDENTIFICACION_CENTROSERVICIO) : ''; ?>"  />
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="telefono-ubicaicion">Telefono del Centro</label>
                    <div class="controls">
                        <input type="text" name="telefono-ubicaicion" class="sinEspacios" placeholder="telefono" value="<?php echo isset($ubicaciones) ? ($ubicaciones->TELEFONO_CENTROSERVICIO) : ''; ?>"/>
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="correo-ubicaicion">Correo del Centro</label>
                    <div class="controls">
                        <input type="email" name="correo-ubicaicion" class="sinEspacios" placeholder="correo" value="<?php echo isset($ubicaciones) ? ($ubicaciones->CORREO_CENTROSERVICIO) : ''; ?>" />
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="web-ubicaicion">Web del Centro</label>
                    <div class="controls">
                        <input type="text" name="web-ubicaicion" placeholder="web" class="sinEspacios" value="<?php echo isset($ubicaciones) ? ($ubicaciones->WEB_CENTROSERVICIO) : ''; ?>" />
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="contacto-ubicaicion">Contacto del Centro</label>
                    <div class="controls">
                        <input type="text" name="contacto-ubicaicion" placeholder="contacto" value="<?php echo isset($ubicaciones) ? ($ubicaciones->CONTACTO_CENTROSERVICIO) : ''; ?>" />
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="direccion-ubicaicion">Direccion del Centro</label>
                    <div class="controls">
                        <input type="text" name="direccion-ubicaicion" placeholder="Direccion" value="<?php echo isset($ubicaciones) ? ($ubicaciones->DIRECCION_CENTROSERVICIO) : ''; ?>" />
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="marcador-ubicaicion">Marcador del Centro</label>
                    <div class="controls">
                        <input type="text" name="marcador-ubicaicion" placeholder="marcador" value="<?php echo isset($ubicaciones) ? ($ubicaciones->MARCADOR_CENTROSERVICIO) : ''; ?>" />
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="cobertura-ubicaicion">Cobertura del Centro</label>
                    <div class="controls">
                        <input type="text" name="cobertura-ubicaicion" placeholder="cobertura" value="<?php echo isset($ubicaciones) ? ($ubicaciones->COBERTURA_CENTROSERVICIO) : ''; ?>" />
                    </div>
                </div>

                <div id="ubicacion_para_registro"  style="width:680px" >

                    <div id="mapa" style="height:400px"></div>
                    <section id="informacion">
                        <h4>Ubicacion para centro</h4>
                        <h5>Latitud: <input id="gps_lat_centro" name="gps_lat_centro" type="text" value="<?php echo isset($ubicaciones) ? ($ubicaciones->LATITUD_CENTROSERVICIO) : ''; ?>" >
<!--                            <span id="latitude"><?php echo isset($ubicaciones) ? ($ubicaciones->LATITUD_CENTROSERVICIO) : ''; ?></span>-->
                        </h5>
                        <h5>Longitud: <input id="gps_lon_centro" name="gps_lon_centro" type="text" value="<?php echo isset($ubicaciones) ? ($ubicaciones->LONGITUD_CENTROSERVICIO) : ''; ?>" >
<!--                            <span id="longitude"><?php echo isset($ubicaciones) ? ($ubicaciones->LONGITUD_CENTROSERVICIO) : ''; ?></span>-->
                        </h5>
                        <a href="#" onclick="geolocalizacion();" >ir a mi Ubicacion Actual</a>
                    </section>                   
                    
                </div>


                <!-- Form Buttons -->
                <div class="form-actions">
                    <button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Limpiar</button>
                    <button type="submit" class="btn btn-success"><i class="icon-ok"></i> Enviar</button>
                </div>
                <!-- END Form Buttons -->
        </form>
            
        </div>        
    </div>   
    
</div>



<script>    

    var coordenadas;
    var map;
    var infowindow ;
    var marker;

    function informacionPOS (coordenadas) {

        $("#latitude").html(coordenadas.Lat);
        $("#longitude").html(coordenadas.Lng);

        $("#gps_lat_centro").val(coordenadas.Lat);
        $("#gps_lon_centro").val(coordenadas.Lng);

    }
    
    function localizacion (posicion) {

            coordenadas = {
                Lat: posicion.coords.latitude,
                Lng: posicion.coords.longitude
            }
            
            informacionPOS(coordenadas);
            
            var mapOptions = {
                zoom: 7,
                center: new google.maps.LatLng(coordenadas.Lat, coordenadas.Lng),
                disableDefaultUI: true,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            
            map = new google.maps.Map(document.getElementById('mapa'), mapOptions);
            /*
            infowindow = new google.maps.InfoWindow({
                map: map,
                animation: google.maps.Animation.DROP,
                position: new google.maps.LatLng(coordenadas.Lat, coordenadas.Lng),
                content: 'Esta es la ubicación actual. <br />Arrastre el marcador de posicion hasta la ubicacion de su centro de salud.<br /><em>Click en la X para cerra este mensaje.</em>'
            });
*/
            marker = new google.maps.Marker({
                map: map,
                position: new google.maps.LatLng(coordenadas.Lat, coordenadas.Lng),
                animation: google.maps.Animation.DROP,
                title: "Esta es la ubicación que será registrada para la ubicacion centro de salud.",
                draggable: true,
                drag: 'alert'
            });

            //google.maps.event.addListener(map, 'dragend', function() { alert('map dragged'); } );
            google.maps.event.addListener(marker, 'drag', function() {

                actualizar_posicion_marcador( marker.getPosition() );
                
            } );
    }

    function actualizar_posicion_marcador(latLng) {
        coordenadas = {
            Lat: latLng.lat(),
            Lng: latLng.lng()
        }
            informacionPOS(coordenadas);
    }
    
    function initialize() {
        coordenadas = {
            Lat: 0,
            Lng: 0
        };
        function errores (error) {
            alert('Ha ocurrido un error al obtener la información');
        }
        
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(localizacion,errores);
        } else {
            alert("Tu navegador no soporta la 'Geolocalización'");
        }  
    }

    function geolocalizacion(){
        initialize();
    }



$(document).ready(function(){

    $('#form-ubicaciones_centro').submit(function() {
           
            if(estaVacio( $('#subreceptor').val()) ){
                alert('Rellene el campo de subreceptor');
                return false;
            }
            if(estaVacio( $('#sel-lista-servicios').val()) ){
                alert('Rellene el campo de tipo de centro');
                return false;
            }
            if(estaVacio( $('#cantones').val()) ){
                alert('Rellene el campo de canton');
                return false;
            }

            var datosForm = $(this).serialize();
            
            if( estaVacio( $('#registro-id').val() )  ){
                ejecutarAccionJson( 'sistema', 'directorio_centro_salud', 'guardar_nuevo_centro_salud',
                    datosForm, 'mostrar_resultado_guardar( data, "abrir_listado_centro_salud();", "" );' 
                );
            }else{
                ejecutarAccionJson(
                    'sistema', 'directorio_centro_salud', 'editar_centro_salud', 
                    datosForm, 'mostrar_resultado_guardar( data, "abrir_listado_centro_salud();", "" );' 
                );
            }

            
    });

    $('#provincia-chosen').on('change', function(evt, params) {
        cargar_cantones('listado-cantones', 'cantones', $(this).val());
    });

    if( !estaVacio( $('#registro-id').val())  ){

       var posicion = {
            coords: {
                latitude: $("#gps_lat_centro").val(),
                longitude: $("#gps_lon_centro").val()
            }
       }
       //alert(posicion.coords.latitude);
       localizacion(posicion);
    }else{

       initialize();

    }

});	

</script>

