<div id="map" style="height:400px"></div>
<script>
    $(document).ready(function() {
        initialize();
    }); 
    <?php
if (isset($lugaresResultado)) {
    $array_js = json_encode($lugaresResultado);
    echo "lugares = " . $array_js . ";\n";
}
?>
   function initialize () {
            var mapOptions = {
                zoom: 7,
                center: new google.maps.LatLng(-1.2842625, -79.5624948),
                disableDefaultUI: true,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            map = new google.maps.Map(document.getElementById('map'), mapOptions);
    }

</script>