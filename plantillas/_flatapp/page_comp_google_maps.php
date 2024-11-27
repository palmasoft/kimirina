<?php include 'inc/config.php';   // Configuration php file ?>
<?php include 'inc/top.php';      // Meta data and header   ?>
<?php include 'inc/side.php';      // Navigation content     ?>

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-google_maps themed-color"></i>Google Maps<br><small>Bring them in your app!</small></h1>
</div>
<!-- END Pre Page Content -->

<!-- Page Content -->
<div id="page-content">
    <!-- Breadcrumb -->
    <!-- You can have the breadcrumb stick on scrolling just by adding the following attributes with their values (data-spy="affix" data-offset-top="250") -->
    <!-- You can try it on other elements too :-), the sticky position and style can be adjusted in the css/main.css with .affix class -->
    <ul class="breadcrumb" data-spy="affix" data-offset-top="250">
        <li>
            <a href="index.php"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="#">Components</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="">Google Maps</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <!-- Google Maps Content -->
    <!-- First Row -->
    <div class="row-fluid row-items">
        <!-- General Map -->
        <div class="span6">
            <!-- General Map Block -->
            <div class="block block-themed">
                <!-- General Map Title -->
                <div class="block-title">
                    <h4>General Map</h4>
                </div>
                <!-- END General Map Title -->

                <!-- General Map Content -->
                <div class="block-content block-content-flat">
                    <div id="example-gmap-general" class="gmap-con"></div>
                </div>
                <!-- END General Map Content -->
            </div>
            <!-- END General Map Block -->
        </div>
        <!-- END General Map -->

        <!-- Map With Markers -->
        <div class="span6">
            <!-- Map with Markers Block -->
            <div class="block block-themed">
                <!-- Map with Markers Title -->
                <div class="block-title">
                    <h4>Map with Markers</h4>
                </div>
                <!-- END Map with Markers Title -->

                <!-- Map with Markers Content -->
                <div class="block-content block-content-flat">
                    <div id="example-gmap-markers" class="gmap-con"></div>
                </div>
                <!-- END Map with Markers Content -->
            </div>
            <!-- END Map with Markers Block -->
        </div>
        <!-- END Map With Markers -->
    </div>
    <!-- END First Row -->

    <!-- Second Row, hide it from IE < 9 Browsers since geolocation and street view don't work in them -->
    <div class="row-fluid row-items hidden-lt-ie9">
        <!-- Street View -->
        <div class="span6">
            <!-- Street View Block -->
            <div class="block block-themed">
                <!-- Street View Title -->
                <div class="block-title">
                    <h4>Street View</h4>
                </div>
                <!-- END Street View Title -->

                <!-- Street View Content -->
                <div class="block-content block-content-flat">
                    <div id="example-gmap-street" class="gmap-con"></div>
                </div>
                <!-- END Street View Content -->
            </div>
            <!-- END Street View Block -->
        </div>
        <!-- END Street View -->

        <!-- Geolocation -->
        <div class="span6">
            <!-- Geolocation Block -->
            <div class="block block-themed remove-margin">
                <!-- Geolocation Title -->
                <div class="block-title">
                    <h4>Geolocation</h4>
                </div>
                <!-- END Geolocation Title -->

                <!-- Geolocation Content -->
                <div class="block-content block-content-flat">
                    <div id="example-gmap-geolocation" class="gmap-con"></div>
                </div>
                <!-- END Geolocation Content -->
            </div>
            <!-- END Geolocation Block -->
        </div>
        <!-- END Geolocation -->
    </div>
    <!-- END Second Row -->
    <!-- END Google Maps Content -->
</div>
<!-- END Page Content -->

<?php include 'inc/footer.php'; // Footer and scripts ?>

<!-- Javascript code only for this page -->
<script>
    $(function(){
        /*
         * With Gmaps.js, Check out examples and documentation at http://hpneo.github.io/gmaps/examples.html
         */

        // Set default height to all Google Maps Containers
        $('#example-gmap-general, #example-gmap-markers, #example-gmap-geolocation, #example-gmap-street')
                .css('height', '400px');

        // Initialize general map
        new GMaps({
            div: '#example-gmap-general',
            lat: 0,
            lng: 0,
            zoom: 1
        }).setMapTypeId(google.maps.MapTypeId.SATELLITE);

        // Initialize map with markers
        new GMaps({
            div: '#example-gmap-markers',
            lat: 0,
            lng: 0,
            zoom: 1
        })
            .addMarkers([
                { lat: 30, lng: -30, title: 'Marker #1', infoWindow: { content: '<p>Marker #1: HTML Content</p>'} },
                { lat: -50, lng: 10, title: 'Marker #2', infoWindow: { content: '<p>Marker #2: HTML Content</p>'} },
                { lat: -30, lng: 90, title: 'Marker #3', infoWindow: { content: '<p>Marker #3: HTML Content</p>'} }
            ]);

        // Initialize street view panorama
        new GMaps.createPanorama({
            el: '#example-gmap-street',
            lat: -23.442896,
            lng: 151.906584,
            pov: {
                heading: 340,
                pitch: 5
            }
        });

        // Initialize map geolocation
        var gmapGeolocation = new GMaps({
            div: '#example-gmap-geolocation',
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
    });
</script>

<?php include 'inc/bottom.php'; // Close body and html tags ?>