
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-notes_2 themed-color"></i> Lugares Intenvencion<br>
        <small>Nuevo Registro de Lugar de Intervencion</small>
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
            <a href="javascript:abrir_listado_lugar_intervencion();">Lugares</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Lugares Intervencion</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <div class="block  block-themed" >
        <div class="block-title">
            <h4>
                <a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Generales"><i class="icon-arrow-up"></i></a>  
                Nuevo Lugar Intervencion
            </h4>
            <div class="block-options">            
            </div>  
        </div>
        <div class="block-content"> 

            <form id="form-lugares-intervencion" class="form-horizontal" onsubmit="return false;" >
                <input type="hidden" id="registro-id" name="registro-id" value="<?php echo isset($lugarIntervencion) ? ($lugarIntervencion->ID_LUGAR) : ''; ?>" />
                <!-- TIPO DE LUGAR -->
                <div class="control-group">
                    <label class="control-label" for="tipoLugar">Tipo de lugar</label>
                    <div class="controls">
                        <select id="tipoLugar" name="tipoLugar" class="select-chosen" >
                            <option value >Seleccione una</option>
                            <?php
                            foreach ($tipoLugares as $tipoLugar) {
                                $selected = "";
                                if (isset($lugarIntervencion))
                                    if ($lugarIntervencion->ID_TIPOLUGAR == $tipoLugar->ID_TIPOLUGAR)
                                        $selected = "selected";

                                echo ('<option value="' . $tipoLugar->ID_TIPOLUGAR . '" ' . $selected . ' >' . ($tipoLugar->NOMBRE_TIPOLUGAR) . '</option>');
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <!-- PROVICIA-CANTON -->
                <div class="control-group">
                    <label class="control-label">Provincia</label>
                    <div id="lista-provincia" class="controls">
                        <select id="provincia-chosen" name="provincia-chosen" class="select-chosen" size="1">
                            <option value >seleccione la provincia</option>
                            <?php 
                            foreach ($provincias as $provincia) { 
                                 $selected = "";
                                if (isset($lugarIntervencion))
                                    if ($lugarIntervencion->ID_PROVINCIA == $provincia->ID_PROVINCIA)
                                        $selected = "selected";
                                ?>
                            <option value="<?php echo $provincia->ID_PROVINCIA ?>"  <?php echo $selected; ?> ><?php echo ($provincia->NOMBRE_PROVINCIA) ?></option>
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
                                if (isset($lugarIntervencion))
                                    if ($lugarIntervencion->ID_CANTON == $canton->ID_CANTON)
                                        $selected = "selected";
                                ?>
                            <option value="<?php echo $canton->ID_CANTON ?>" <?php echo $selected; ?> ><?php echo ($canton->NOMBRE_CANTON) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div> 
                <!-- NOMBRE LUGAR -->
                <div class="control-group">
                    <label class="control-label" for="nombreLugar">Nombre</label>
                    <div class="controls">
                        <input type="text" name="nombreLugar" value="<?php echo isset($lugarIntervencion) ? ($lugarIntervencion->NOMBRE_LUGAR) : ''; ?>" placeholder=""  class="required" required="required"/>
                    </div>
                </div>
                <!-- DIRECCION LUGAR -->
                <div class="control-group">
                    <label class="control-label" for="direccionLugar">Direccion</label>
                    <div class="controls">
                        <input type="text" name="direccionLugar" value="<?php echo isset($lugarIntervencion) ? ($lugarIntervencion->DIRECCION_LUGAR) : ''; ?>" placeholder=""  />
                    </div>
                </div>
                <!-- TELEFONO  LUGAR-->
                <div class="control-group">
                    <label class="control-label" for="telefonoLugar">Telefono Lugar</label>
                    <div class="controls">
                        <input type="text" name="telefonoLugar" class="sinEspacios" value="<?php echo isset($lugarIntervencion) ? ($lugarIntervencion->TELEFONO_LUGAR) : ''; ?>" placeholder=""  />
                    </div>
                </div>
                <!-- CONTACTO  -->
                <div class="control-group">
                    <label class="control-label" for="nombreContacto">Nombre Contacto</label>
                    <div class="controls">
                        <input type="text" name="nombreContacto" value="<?php echo isset($lugarIntervencion) ? ($lugarIntervencion->CONTACTO_LUGAR) : ''; ?>" placeholder=""  />
                    </div>
                </div>
                <!-- TELEFONO CONTACTO-->
                <div class="control-group">
                    <label class="control-label" for="telefonoContacto">Telefono del Contacto</label>
                    <div class="controls">
                        <input type="text" name="telefonoContacto" class="sinEspacios" value="<?php echo isset($lugarIntervencion) ? ($lugarIntervencion->TELEFONO_CONTACTO_LUGAR) : ''; ?>" placeholder=""  />
                    </div>
                </div>
                <!-- CORREO CONTACTO -->
                <div class="control-group">
                    <label class="control-label" for="correoContacto">Correo del Contacto</label>
                    <div class="controls">
                        <input type="text" name="correoContacto" class="sinEspacios" value="<?php echo isset($lugarIntervencion) ? ($lugarIntervencion->CORREO_CONTACTO_LUGAR) : ''; ?>" placeholder=""  />
                    </div>
                </div>
                <!-- WEB  --> 
                <div class="control-group">
                    <label class="control-label" for="web">Web</label>
                    <div class="controls">
                        <input type="text" name="web" class="sinEspacios" value="<?php echo isset($lugarIntervencion) ? ($lugarIntervencion->WEB_LUGAR) : ''; ?>" placeholder=""  />
                    </div>
                </div>
                <!-- REFERENCIA -->
                <div class="control-group">
                    <label class="control-label" for="referencia">Referencia</label>
                    <div class="controls">
                        <input type="text" name="referencia" value="<?php echo isset($lugarIntervencion) ? ($lugarIntervencion->REFERENCIA_LUGAR) : ''; ?>" placeholder=""  />
                    </div>
                </div>
                <!-- OBSERVACIONES --> 
                <div class="control-group">
                    <label class="control-label" for="observaciones">Observaciones</label>
                    <div class="controls">
                        <textarea id="observaciones" name="observaciones" value="<?php echo isset( $lugarIntervencion ) ? ($lugarIntervencion->OBSERVACIONES_LUGAR) : '' ; ?>" rows="4"></textarea>
                    </div>
                </div>

                <div id="ubicacion_para_registro"  style="width:680px" >

                    <div id="mapa" style="height:400px"></div>
                    <section id="informacion">
                        <h4>Ubicacion para lugar Intervencion</h4>
                        <h5>Latitud: <span id="latitude"><?php echo isset($lugarIntervencion) ? ($lugarIntervencion->LATITUD_LUGAR) : ''; ?></span></h5>
                        <h5>Longitud: <span id="longitude"><?php echo isset($lugarIntervencion) ? ($lugarIntervencion->LONGITUD_LUGAR) : ''; ?></span></H5>
                        <a href="#" onclick="geolocalizacion();" >ir a mi Ubicacion Actual</a>
                    </section>
                    <input id="gps_lat_centro" name="gps_lat_centro" type="hidden" value="<?php echo isset($lugarIntervencion) ? ($lugarIntervencion->LATITUD_LUGAR) : ''; ?>" >
                    <input id="gps_lon_centro" name="gps_lon_centro" type="hidden" value="<?php echo isset($lugarIntervencion) ? ($lugarIntervencion->LONGITUD_LUGAR) : ''; ?>" >
                </div>

                <!-- Form Buttons -->
                <div class="form-actions">
                    <button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Limpiar</button>
                    <button type="submit" class="btn btn-success"><i class="icon-ok"></i> Guardar</button>
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


    $(document).ready(function() {
        //informacion('lo que sea');
        $('#form-lugares-intervencion').submit(function() {

            if(estaVacio( $('#tipoLugar').val() )){
                alert('Seleccione el tipo de lugar');
                return false;
            }

            if(estaVacio( $('#cantones').val()) ){
                alert('Seleccione el canton');
                return false;
            }



            var datosForm = $(this).serialize();

            if (estaVacio($('#registro-id').val())) {
                ejecutarAccionJson('sistema', 'lugaresIntervencion', 'guardar_nuevo_lugar_intervencion',
                        datosForm, 'mostrar_resultado_guardar( data, "abrir_listado_lugar_intervencion();", "" );'
                        );
            } else {
                ejecutarAccionJson(
                        'sistema', 'lugaresIntervencion', 'editar_lugar_intervencion',
                        datosForm, 'mostrar_resultado_guardar( data, "abrir_listado_lugar_intervencion();", "" );'
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

