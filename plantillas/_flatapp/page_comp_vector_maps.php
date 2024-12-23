<?php include 'inc/config.php';   // Configuration php file ?>
<?php include 'inc/top.php';      // Meta data and header   ?>
<?php include 'inc/side.php';      // Navigation content     ?>

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-pin themed-color"></i>Vector Maps<br><small>Great looking and vector based!</small></h1>
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
        <li class="active"><a href="">Vector Maps</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <!-- World Map Block -->
    <div class="block block-themed">
        <!-- World Map Title -->
        <div class="block-title">
            <h4>World Vector Map (with click event and data)</h4>
        </div>
        <!-- END World Map Title -->

        <!-- World Map Content -->
        <div class="block-content block-content-flat">
            <div id="example-vmap-world"></div>
        </div>
        <!-- END World Map Content -->
    </div>
    <!-- END World Map Block -->

    <!-- Regions Block -->
    <div class="block block-themed block-last">
        <!-- Regions Title -->
        <div class="block-title">
            <div class="block-options btn-group">
                <a href="javascript:void(0)" class="btn btn-inverse dropdown-toggle" data-toggle="dropdown">Select Region <i class="icon-angle-down"></i></a>
                <ul id="example-vmaps-list" class="dropdown-menu pull-right">
                    <li class="active"><a href="javascript:void(0)" data-vmap="0">Europe</a></li>
                    <li><a href="javascript:void(0)" data-vmap="1">Germany</a></li>
                    <li><a href="javascript:void(0)" data-vmap="2">Russia</a></li>
                    <li><a href="javascript:void(0)" data-vmap="3">USA</a></li>
                    <li><a href="javascript:void(0)" data-vmap="4">World</a></li>
                </ul>
            </div>
            <h4 id="example-vmap-title">Europe</h4>
        </div>
        <!-- END Regions Title -->

        <!-- Regions Content -->
        <div class="block-content block-content-flat">
            <div id="example-vmap-0" class="example-vmaps"></div>
            <div id="example-vmap-1" class="example-vmaps"></div>
            <div id="example-vmap-2" class="example-vmaps"></div>
            <div id="example-vmap-3" class="example-vmaps"></div>
            <div id="example-vmap-4" class="example-vmaps"></div>
        </div>
        <!-- END Regions Content -->
    </div>
    <!-- END Regions Block -->
</div>
<!-- END Page Content -->

<?php include 'inc/footer.php'; // Footer and scripts ?>

<!-- jqvmap.maps.js, Don't forget to include maps data -->
<script src="js/helpers/jqvmap.maps.js"></script>

<!-- Javascript code only for this page -->
<script>
    $(function(){
        // Default Maps Height
        var mapHeight = '550px';

        /*
         *  Vector Maps, Dropdown functionality
         *
         */
        var vMapTitle = $('#example-vmap-title');
        var vMapList = $('#example-vmaps-list');
        var vMapCons = $('.example-vmaps');

        // Available Vector Maps
        var vMaps = [
            {
                title: 'Europe',
                map: 'europe_en'
            },
            {
                title: 'Germany',
                map: 'germany_en'
            },
            {
                title: 'Russia',
                map: 'russia_en'
            },
            {
                title: 'USA',
                map: 'usa_en'
            },
            {
                title: 'World',
                map: 'world_en'
            }
        ];

        // Set default map height to all map containers
        vMapCons.css('height', mapHeight);

        // View vector map
        function viewVmap(mapCode) {

            var mapCon = $('#example-vmap-' + mapCode);

            // Update Map Title
            vMapTitle.html(vMaps[mapCode].title);

            // Hide all maps..
            vMapCons.hide();

            // ..and show the one we need
            if (mapCon.html().length > 0)
                mapCon.show();
            else // Create the map if not initialized before
                mapCon.show().vectorMap({ map: vMaps[mapCode].map });
        }

        // Dropdown link click functionality
        vMapList.find('a').click(function(){

            // Remove .active class from all <li> elements
            vMapList.find('li').removeClass('active');

            // Add the class .active to the parent <li> element of link clicked
            $(this).parent().addClass('active');

            // View selected map
            viewVmap($(this).attr('data-vmap'));
        });

        // View Europe Map
        viewVmap(0);

        /*
         * Vector Maps, Initialize World Map with some sample data and click event
         *
         */
        var sampleData = {"af":"16.63","al":"11.58","dz":"158.97","ao":"85.81","ag":"1.1","ar":"351.02","am":"8.83","au":"1219.72","at":"366.26","az":"52.17","bs":"7.54","bh":"21.73","bd":"105.4","bb":"3.96","by":"52.89","be":"461.33","bz":"1.43","bj":"6.49","bt":"1.4","bo":"19.18","ba":"16.2","bw":"12.5","br":"2023.53","bn":"11.96","bg":"44.84","bf":"8.67","bi":"1.47","kh":"11.36","cm":"21.88","ca":"1563.66","cv":"1.57","cf":"2.11","td":"7.59","cl":"199.18","cn":"5745.13","co":"283.11","km":"0.56","cd":"12.6","cg":"11.88","cr":"35.02","ci":"22.38","hr":"59.92","cy":"22.75","cz":"195.23","dk":"304.56","dj":"1.14","dm":"0.38","do":"50.87","ec":"61.49","eg":"216.83","sv":"21.8","gq":"14.55","er":"2.25","ee":"19.22","et":"30.94","fj":"3.15","fi":"231.98","fr":"2555.44","ga":"12.56","gm":"1.04","ge":"11.23","de":"3305.9","gh":"18.06","gr":"305.01","gd":"0.65","gt":"40.77","gn":"4.34","gw":"0.83","gy":"2.2","ht":"6.5","hn":"15.34","hk":"226.49","hu":"132.28","is":"12.77","in":"1430.02","id":"695.06","ir":"337.9","iq":"84.14","ie":"204.14","il":"201.25","it":"2036.69","jm":"13.74","jp":"5390.9","jo":"27.13","kz":"129.76","ke":"32.42","ki":"0.15","kr":"986.26","undefined":"5.73","kw":"117.32","kg":"4.44","la":"6.34","lv":"23.39","lb":"39.15","ls":"1.8","lr":"0.98","ly":"77.91","lt":"35.73","lu":"52.43","mk":"9.58","mg":"8.33","mw":"5.04","my":"218.95","mv":"1.43","ml":"9.08","mt":"7.8","mr":"3.49","mu":"9.43","mx":"1004.04","md":"5.36","mn":"5.81","me":"3.88","ma":"91.7","mz":"10.21","mm":"35.65","na":"11.45","np":"15.11","nl":"770.31","nz":"138","ni":"6.38","ne":"5.6","ng":"206.66","no":"413.51","om":"53.78","pk":"174.79","pa":"27.2","pg":"8.81","py":"17.17","pe":"153.55","ph":"189.06","pl":"438.88","pt":"223.7","qa":"126.52","ro":"158.39","ru":"1476.91","rw":"5.69","ws":"0.55","st":"0.19","sa":"434.44","sn":"12.66","rs":"38.92","sc":"0.92","sl":"1.9","sg":"217.38","sk":"86.26","si":"46.44","sb":"0.67","za":"354.41","es":"1374.78","lk":"48.24","kn":"0.56","lc":"1","vc":"0.58","sd":"65.93","sr":"3.3","sz":"3.17","se":"444.59","ch":"522.44","sy":"59.63","tw":"426.98","tj":"5.58","tz":"22.43","th":"312.61","tl":"0.62","tg":"3.07","to":"0.3","tt":"21.2","tn":"43.86","tr":"729.05","tm":0,"ug":"17.12","ua":"136.56","ae":"239.65","gb":"2258.57","us":"14624.18","uy":"40.71","uz":"37.72","vu":"0.72","ve":"285.21","vn":"101.99","ye":"30.02","zm":"15.69","zw":"5.57"};

        $('#example-vmap-world').css('height', mapHeight).vectorMap({
            map: vMaps[4].map,
            selectedColor: '#333',
            values: sampleData,
            onRegionClick: function(element, code, region) {
                var message = region  + '" (' + code.toUpperCase() + ')';
                alert(message);
            }
        });
    });
</script>

<?php include 'inc/bottom.php'; // Close body and html tags ?>