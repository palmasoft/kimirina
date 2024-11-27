
<div id="ubicacion_para_registro"  style="width:680px; max-width: 100%; margin: auto;" >
    <div id="mapa" style="height:400px"></div>
    <section id="informacion">
        <h4>Ubicacion para el Sitio</h4>
        <h5>Latitud: <span><input id="gps_lat_marcador" name="gps_lat_marcador" type="text" value="<?php echo isset($LATITUD_LUGAR) ? ($LATITUD_LUGAR) : ''; ?>" class="input-themed text-center" /></span> | Longitud: <span><input id="gps_lon_marcador" name="gps_lon_marcador" type="text" value="<?php echo isset($LONGITUD_LUGAR) ? ($LONGITUD_LUGAR) : ''; ?>" class="input-themed text-center" /></span></H5>
        <a href="javascript:void(0);" onclick="geolocalizacion();" >ir a mi Ubicacion Actual</a>
    </section>
</div>



<script>


    var coordenadas;
    var map;
    var infowindow;
    var marker;
    var geocoder;


    function actualizar_posicion_marcador(latLng) {
        coordenadas = {
            Lat: latLng.lat(),
            Lng: latLng.lng()
        }
        informacionPOS(coordenadas);
    }

    function informacionPOS(coordenadas) {
        $("#gps_lat_marcador").val(coordenadas.Lat);
        $("#gps_lon_marcador").val(coordenadas.Lng);
    }

    function geolocalizacion() {
        initialize();
    }

    function initialize() {
        coordenadas = {
            Lat: 0,
            Lng: 0
        };
        function errores(error) {
            alert('Ha ocurrido un error al obtener la información');
        }

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(localizacion, errores);
        } else {
            alert("Tu navegador no soporta la 'Geolocalización'");
        }
    }

    function localizacion(posicion) {

        coordenadas = {
            Lat: posicion.coords.latitude,
            Lng: posicion.coords.longitude
        }

        informacionPOS(coordenadas);

        var mapOptions = {
            zoom: 7,
            center: new google.maps.LatLng(coordenadas.Lat, coordenadas.Lng),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }

        map = new google.maps.Map(document.getElementById('mapa'), mapOptions);

        infowindow = new google.maps.InfoWindow({
            map: map,
            animation: google.maps.Animation.DROP,
            position: new google.maps.LatLng(coordenadas.Lat, coordenadas.Lng),
            content: 'Esta es la ubicación actual. <br />Arrastre el marcador de posicion hasta la ubicacion.<br /><em>Click en la X para cerrar este mensaje.</em>'
        });

        marker = new google.maps.Marker({
            map: map,
            position: new google.maps.LatLng(coordenadas.Lat, coordenadas.Lng),
            animation: google.maps.Animation.DROP,
            title: "Esta es la ubicación que será registrada.",
            draggable: true,
            drag: 'alert'
        });

        //google.maps.event.addListener(map, 'dragend', function() { alert('map dragged'); } );
        google.maps.event.addListener(marker, 'drag', function() {
            actualizar_posicion_marcador(marker.getPosition());
        });
        google.maps.event.addListener(map, "click", function(event)
        {
            marker.setPosition(event.latLng);
            actualizar_posicion_marcador(marker.getPosition());
            map.setCenter(marker.getPosition());
        });

    }

    function resolverDireccion(address) {
        geocoder = new google.maps.Geocoder();
        geocoder.geocode({
            'address': address
        }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                marker.setPosition(results[0].geometry.location);
                actualizar_posicion_marcador(marker.getPosition());
                map.setZoom(8);
                map.setCenter(marker.getPosition());
            }
        });
    }
</script>