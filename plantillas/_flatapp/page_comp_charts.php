<?php include 'inc/config.php';   // Configuration php file ?>
<?php include 'inc/top.php';      // Meta data and header   ?>
<?php include 'inc/side.php';      // Navigation content     ?>

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-stats themed-color"></i>Charts<br><small>All kinds of them!</small></h1>
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
        <li class="active"><a href="">Charts</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <!-- Live Stats Block -->
    <div class="block block-themed">
        <!-- Live Stats Title -->
        <div class="block-title">
            <div class="block-options-medium">
                 <span class="label label-neutral">Server</span> <span id="server-live" class="label label-info">0%</span>
            </div>
            <h4><i class="icon-bar-chart"></i> Live Stats</h4>
        </div>
        <!-- END Live Stats Title -->

        <!-- Live Stats Content -->
        <div class="block-content block-content-flat">
            <div id="example-chart-live" class="chart-live"></div>
        </div>
        <!-- END Live Stats Content -->
    </div>
    <!-- END Live Stats Block -->

    <!-- Classic Charts Content -->
    <div class="row-fluid">
        <div class="span6">
            <!-- Lines with points and tooltips Block -->
            <div class="block block-themed">
                <!-- Lines with points and tooltips Title -->
                <div class="block-title">
                    <h4>Lines with points and tooltips</h4>
                </div>
                <!-- END Lines with points and tooltips Title -->

                <!-- Lines with points and tooltips Content -->
                <div class="block-content">
                    <div id="example-chart-classic" class="chart"></div>
                </div>
                <!-- END Lines with points and tooltips Content -->
            </div>
            <!-- END Lines with points and tooltips Block -->
        </div>
        <div class="span6">
            <!-- Pie Block -->
            <div class="block block-themed">
                <!-- Pie Title -->
                <div class="block-title">
                    <h4>Pie</h4>
                </div>
                <!-- END Pie Title -->

                <!-- Pie Content -->
                <div class="block-content">
                    <div id="example-chart-pie" class="chart"></div>
                </div>
                <!-- END Pie Content -->
            </div>
            <!-- END Pie Block -->
        </div>
    </div>
    <div class="row-fluid">
        <div class="span6">
            <!-- Bars Block -->
            <div class="block block-themed">
                <!-- Bars Title -->
                <div class="block-title">
                    <h4>Bars</h4>
                </div>
                <!-- END Bars Title -->

                <!-- Bars Content -->
                <div class="block-content">
                    <div id="example-chart-bars" class="chart"></div>
                </div>
                <!-- END Bars Content -->
            </div>
            <!-- END Bars Block -->
        </div>
        <div class="span6">
            <!-- Stacked Lines Block -->
            <div class="block block-themed">
                <!-- Stacked Lines Title -->
                <div class="block-title">
                    <h4>Stacked Lines</h4>
                </div>
                <!-- END Stacked Lines Title -->

                <!-- Stacked Lines Content -->
                <div class="block-content">
                    <div id="example-chart-stacked" class="chart"></div>
                </div>
                <!-- END Stacked Lines Content -->
            </div>
            <!-- END Stacked Lines Block -->
        </div>
    </div>
    <!-- END Classic Charts Content -->

    <!-- Mini Charts Block -->
    <div class="block block-themed block-last">
        <!-- Mini Charts Title -->
        <div class="block-title">
            <h4>Mini Charts</h4>
        </div>
        <!-- END Mini Charts Title -->

        <!-- Mini Charts Content -->
        <div class="block-content">
            <div class="row-fluid row-items">
                <div class="span4">
                    <h4 class="sub-header">Project #1</h4>
                    <div id="side-mini-chart1" class="side-mini-chart text-success">25,21,32,22,52,42,46,35,25,26</div>
                </div>
                <div class="span4">
                    <h4 class="sub-header">Project #2</h4>
                    <div id="side-mini-chart2" class="side-mini-chart text-info">29,31,35,28,29,33,30,31,36,32</div>
                </div>
                <div class="span4">
                    <h4 class="sub-header">Project #3</h4>
                    <div id="side-mini-chart3" class="side-mini-chart text-black">44,35,52,39,35,42,45,35,41,32</div>
                </div>
            </div>
        </div>
        <!-- END Mini Charts Content -->
    </div>
    <!-- END Mini Charts Block -->
</div>
<!-- END Page Content -->

<?php include 'inc/footer.php'; // Footer and scripts ?>

<!-- Javascript code only for this page -->
<script>
    $(function(){
        /*
         * Flot 0.8.1 jquery plugin is used for charts
         *
         * For more examples or getting extra plugins check its website at http://www.flotcharts.org/
         * Plugins included in this template: pie, resize, stack
         */

        // Get the elements where we will attach the charts
        var chartLive = $('#example-chart-live');
        var chartClassic = $('#example-chart-classic');
        var chartPie = $('#example-chart-pie');
        var chartBars = $('#example-chart-bars');
        var chartStacked = $('#example-chart-stacked');

        /* Live Chart */
        // Function for getting random data for our live chart
        var data = [];
        function getRandomData() {

            if (data.length > 0)
                data = data.slice(1);

            // do a random walk
            while (data.length < 300) {
                var prev = data.length > 0 ? data[data.length - 1] : 50;
                var y = prev + Math.random() * 10 - 5;
                if (y < 0)
                    y = 0;
                if (y > 100)
                    y = 100;
                data.push(y);
            }

            // Show percentage
            $("#server-live").html(y.toFixed(0) + '%');

            // zip the generated y values with the x values
            var res = [];
            for (var i = 0; i < data.length; ++i)
                res.push([i, data[i]]);
            return res;
        }

        // Initialize live chart
        var liveOptions = {
            series: { shadowSize: 0 },
            lines: { show: true, lineWidth: 3, fill: true, fillColor: { colors: [{ opacity: 0.6 }, { opacity: 0.05 }] } },
            colors: ['#333'],
            grid: { show: false },
            yaxis: { min: 0, max: 130 },
            xaxis: { show: false }
        };
        var chartLive = $.plot(chartLive, [ { data: getRandomData() } ], liveOptions);

        // Function for updating live chart
        function updateChartLive() {

            chartLive.setData([ getRandomData() ]);
            chartLive.draw();
            setTimeout(updateChartLive, 500);
        }
        updateChartLive();

        /* Classic Chart */
        var classicData1 = [
            [0, 200],
            [1, 250],
            [2, 360],
            [3, 584],
            [4, 1250],
            [5, 1100],
            [6, 1500],
            [7, 1521],
            [8, 1600],
            [9, 1658],
            [10, 1623],
            [11, 1900],
            [12, 2100],
            [13, 1700],
            [14, 1620],
            [15, 1820],
            [16, 1950],
            [17, 2220],
            [18, 1951],
            [19, 2152],
            [20, 2300],
            [21, 2325],
            [22, 2200],
            [23, 2156],
            [24, 2350],
            [25, 2420],
            [26, 2480],
            [27, 2320],
            [28, 2380],
            [29, 2520],
            [30, 2590]
        ];
        var classicData2 = [
            [0, 50],
            [1, 180],
            [2, 200],
            [3, 350],
            [4, 700],
            [5, 650],
            [6, 700],
            [7, 780],
            [8, 780],
            [9, 790],
            [10, 820],
            [11, 856],
            [12, 1000],
            [13, 950],
            [14, 900],
            [15, 1000],
            [16, 1200],
            [17, 1420],
            [18, 1230],
            [19, 1250],
            [20, 1350],
            [21, 1650],
            [22, 1562],
            [23, 1425],
            [24, 1452],
            [25, 1520],
            [26, 1550],
            [27, 1680],
            [28, 1650],
            [29, 1700],
            [30, 1800]
        ];

        // Initialize Classic Chart
        $.plot(chartClassic, [
            { data: classicData1, lines: { show: true, fill: true, fillColor: { colors: [{ opacity: 0.25 }, { opacity: 0.25 }] } }, points: { show: true }, label: 'All Visits' },
            { data: classicData2, lines: { show: true, fill: true, fillColor: { colors: [{ opacity: 0.1 }, { opacity: 0.1 }] } }, points: { show: true }, label: 'Unique Visits' } ],
            {
                legend: {
                    position: 'nw',
                    backgroundColor: '#f6f6f6',
                    backgroundOpacity: 0.8
                },
                colors: ['#a8db39', '#333'],
                grid: {
                    borderColor: '#cccccc',
                    color: '#999999',
                    labelMargin: 10,
                    hoverable: true,
                    clickable: true
                },
                yaxis: {
                    ticks: 5
                },
                xaxis: {
                    tickSize: 2
                }
            }
        );

        // Creating and attaching a tooltip
        var previousPoint = null;
        chartClassic.bind("plothover", function (event, pos, item) {

            $("#x").text(pos.x.toFixed(2));
            $("#y").text(pos.y.toFixed(2));

            if (item) {
                if (previousPoint !== item.dataIndex) {
                    previousPoint = item.dataIndex;

                    $("#tooltip").remove();
                    var x = item.datapoint[0],
                        y = item.datapoint[1];

                    $('<div id="tooltip" class="chart-tooltip"><strong>' + y +'</strong> visits</div>')
                        .css( { top: item.pageY - 30, left: item.pageX + 5 })
                        .appendTo("body")
                        .show();
                }
            }
            else {
                $("#tooltip").remove();
                previousPoint = null;
            }
        });

        /* Pie Chart */
        var pieData = [];
        var pieSeries = Math.floor(Math.random()*10)+1;
        for(var i = 0; i < 5; i++)
            pieData[i] = { label: 'Data #' + (i+1), data: Math.floor(Math.random()*100)+1 };

        // Initialize Pie Chart
        $.plot(chartPie, pieData,
        {
            series: {
                pie: {
                    show: true,
                    radius: 1,
                    label: {
                        show: true,
                        radius: 3/4,
                        formatter: function(label, pieSeries){
                            return '<div class="chart-pie-label">' + label + '<br>' + Math.round(pieSeries.percent) + '%</div>';
                        },
                        background: {
                            opacity: 0.5,
                            color: '#000000'
                        }
                    }
                }
            },
            colors: ['#39a8db', '#db4a39', '#a8db39', '#39d5db', '#0072bc'],
            legend: {
                show: false
            }
        });

        /* Bars Chart */
        var barsData = [[1, 30], [3, 152], [5, 125], [7, 40], [9, 100], [11, 75], [13, 115]];

        // Initialize Bars Chart
        $.plot(chartBars, [
            { data: barsData, bars: { show: true, fillColor: { colors: [{ opacity: 1 }, { opacity: 1 }] } }, label: 'Sales' } ],
            {
                legend: {
                    backgroundColor: '#f6f6f6',
                    backgroundOpacity: 0.8
                },
                colors: ['#a8db39'],
                grid: {
                    borderColor: '#cccccc',
                    color: '#999999',
                    labelMargin: 10
                },
                yaxis: {
                    ticks: 5
                },
                xaxis: {
                    tickSize: 1
                }
            }
        );

        /* Stacked Chart */
        var stackedData1 = [];
        for (var i = 0; i <= 10; i++)
            stackedData1.push([i, parseInt(Math.random() * 20)]);

        var stackedData2 = [];
        for (var i = 0; i <= 10; i++)
            stackedData2.push([i, parseInt(Math.random() * 20)]);

        var stackedData3 = [];
        for (var i = 0; i <= 10; i++)
            stackedData3.push([i, parseInt(Math.random() * 20)]);

        var stack = 0, bars = true, lines = false, steps = false;

        // Initialize Stacked Chart
        $.plot(chartStacked, [ { data: stackedData1, label: 'Green' }, { data: stackedData2, label: 'Red' }, { data: stackedData3, label: 'Blue' } ], {
            series: {
                stack: true,
                lines: { show: true, fill: true }
            },
            lines: { show: true, lineWidth: 1.5, fill: true, fillColor: { colors: [{ opacity: 1 }, { opacity: 1 }] } },
            legend: {
                backgroundColor: '#f6f6f6',
                backgroundOpacity: 0.8
            },
            colors: ['#a8db39', '#db4a39', '#39a8db'],
            grid: {
                borderColor: '#cccccc',
                color: '#999999',
                labelMargin: 10
            },
            yaxis: {
                ticks: 5
            },
            xaxis: {
                tickSize: 1
            }
        });

        // Mini Stats Initialization
        $('#side-mini-chart1').sparkline('html', {
            type: 'bar',
            barColor: $('#side-mini-chart1').css('color'),
            barWidth: 14,
            barSpacing: 2,
            height: 35,
            tooltipOffsetX: -70,
            tooltipOffsetY: 20,
            tooltipSuffix: ' Updates'
        });
        $('#side-mini-chart2').sparkline('html', {
            type: 'bar',
            barColor: $('#side-mini-chart2').css('color'),
            barWidth: 14,
            barSpacing: 2,
            height: 35,
            tooltipOffsetX: -70,
            tooltipOffsetY: 20,
            tooltipSuffix: ' Updates'
        });
        $('#side-mini-chart3').sparkline('html', {
            type: 'bar',
            barColor: $('#side-mini-chart3').css('color'),
            barWidth: 14,
            barSpacing: 2,
            height: 35,
            tooltipOffsetX: -70,
            tooltipOffsetY: 20,
            tooltipSuffix: ' Updates'
        });
    });
</script>

<?php include 'inc/bottom.php'; // Close body and html tags ?>