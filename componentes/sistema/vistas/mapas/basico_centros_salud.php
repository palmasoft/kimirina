<div id="mapa" style="height:400px"></div>
<script>

    var map;
    var miPosicion = new google.maps.LatLng(-1.2842625, -79.5624948);
    var lugares = new Array();
    var infowindow = new google.maps.InfoWindow({
        content: ''
    });
<?php
if (isset($lugaresResultado)) {
    $array_js = json_encode($lugaresResultado);
    echo "lugares = " . $array_js . ";\n";
}
?>
    $(document).ready(function() {
        initialize();
    });

    function initialize() {
        var mapOptions = {
            zoom: 7,
            center: miPosicion
        };

        map = new google.maps.Map(document.getElementById('mapa'), mapOptions);

        var bounds = new google.maps.LatLngBounds();
        for (var i in lugares) {

            if (estaVacio(lugares[i].LATITUD_CENTROSERVICIO)) {
                continue;
            }
            //alert(lugares[i].LATITUD_LUGAR, lugares[i].LONGITUD_LUGAR);
            //var marcador = imagen_marcador(lugares[i].ID_TIPO_CENTROSERVICIO);

            var contenido = crear_contenido_ventana(lugares[i]);
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(lugares[i].LATITUD_CENTROSERVICIO, lugares[i].LONGITUD_CENTROSERVICIO),
                map: map,
                title: lugares[i].CODIGO_TIPO_CENTROSERVICIO + " / " + lugares[i].NOMBRE_CENTROSERVICIO,
                //icon: marcador
            });

            (function(marker, contenido) {
                /*
                 * le agreagamos el evento del clic
                 */
                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.setContent(contenido);
                    infowindow.open(map, marker);
                    map.setCenter(marker.position);
                    map.setZoom(15);
                });
            })(marker, contenido);




            var latlng = new google.maps.LatLng(lugares[i].LATITUD_CENTROSERVICIO, lugares[i].LONGITUD_CENTROSERVICIO);
            bounds.extend(latlng);


        }

        if (lugares.length > 0) {
            map.fitBounds(bounds);
        }


    }

    function crear_contenido_ventana(lugar) {
        var contentString = '<div>\n\
                <span style="font-size: 150%;" ><strong><em>' + lugar.NOMBRE_CENTROSERVICIO + '</em></strong></span>' +
                '<br>Direcci&oacute;n de Atenci&oacute;n : <strong>' + lugar.DIRECCION_CENTROSERVICIO +'</strong>' +
                '<br>Tipo de Centro de Salud :' + lugar.NOMBRE_TIPO_CENTROSERVICIO +
                '<br>Codigo del Tipo :' + lugar.CODIGO_TIPO_CENTROSERVICIO +
                '</div>';

        return contentString;
    }


    function zoomTodosMarcadores() {
        map.fitBounds()
    }


</script>

