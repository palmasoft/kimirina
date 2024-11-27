<?php include 'inc/config.php';   // Configuration php file ?>
<?php include 'inc/top.php';      // Meta data and header   ?>
<?php include 'inc/side.php';      // Navigation content     ?>

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="icon-spinner themed-color"></i>Progress Bars<br><small>Something is loading? Let the user know!</small></h1>
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
            <a href="#">User Interface</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="">Progress Bars</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <!-- Progress Bars Block -->
    <div class="block block-themed block-last">
        <!-- Progress Bars Title -->
        <div class="block-title">
            <h4>Progress Bars</h4>
        </div>
        <!-- END Progress Bars Title -->

        <!-- Progress Bars Content -->
        <div class="block-content">
            <!-- Demo -->
            <div class="block-section">
                <h4 class="sub-header">Demo</h4>
                <!-- Demo code is at the bottom of this page -->
                <button id="example-progress-bar-button" type="button" class="btn btn-success push" data-loading-text="Working..">
                    <i class="icon-play"></i> Start the demo
                </button>
                <!-- The demo progress bar -->
                <div id="example-progress-bar" class="progress progress-big">
                    <div class="bar bar-danger"></div>
                </div>
            </div>
            <!-- END Demo -->

            <!-- Normal -->
            <div class="block-section">
                <h4 class="sub-header">Normal</h4>
                <div class="progress progress-danger">
                    <div class="bar" style="width: 20%">20%</div>
                </div>
                <div class="progress progress-warning">
                    <div class="bar" style="width: 40%">40%</div>
                </div>
                <div class="progress progress-info">
                    <div class="bar" style="width: 60%">60%</div>
                </div>
                <div class="progress progress-success">
                    <div class="bar" style="width: 80%">80%</div>
                </div>
            </div>
            <!-- END Normal -->

            <!-- Mini -->
            <div class="block-section">
                <h4 class="sub-header">Mini</h4>
                <div class="progress progress-mini progress-danger">
                    <div class="bar" style="width: 20%"></div>
                </div>
                <div class="progress progress-mini progress-warning">
                    <div class="bar" style="width: 40%"></div>
                </div>
                <div class="progress progress-mini progress-info">
                    <div class="bar" style="width: 60%"></div>
                </div>
                <div class="progress progress-mini progress-success">
                    <div class="bar" style="width: 80%"></div>
                </div>
            </div>
            <!-- END Mini -->

            <!-- Big -->
            <div class="block-section">
                <h4 class="sub-header">Big</h4>
                <div class="progress progress-big progress-danger">
                    <div class="bar" style="width: 20%">20%</div>
                </div>
                <div class="progress progress-big progress-warning">
                    <div class="bar" style="width: 40%">40%</div>
                </div>
                <div class="progress progress-big progress-info">
                    <div class="bar" style="width: 60%">60%</div>
                </div>
                <div class="progress progress-big progress-success">
                    <div class="bar" style="width: 80%">80%</div>
                </div>
            </div>
            <!-- END Big -->

            <!-- Striped -->
            <div class="block-section">
                <h4 class="sub-header">Striped</h4>
                <div class="progress progress-striped progress-danger">
                    <div class="bar" style="width: 20%">20%</div>
                </div>
                <div class="progress progress-striped progress-warning">
                    <div class="bar" style="width: 40%">40%</div>
                </div>
                <div class="progress progress-striped progress-info">
                    <div class="bar" style="width: 60%">60%</div>
                </div>
                <div class="progress progress-striped progress-success">
                    <div class="bar" style="width: 80%">80%</div>
                </div>
            </div>
            <!-- END Striped -->

            <!-- Striped Animated -->
            <div class="block-section">
                <h4 class="sub-header">Striped Animated (on modern browsers)</h4>
                <div class="progress progress-striped progress-danger active">
                    <div class="bar" style="width: 20%">(20%) Loading..</div>
                </div>
                <div class="progress progress-striped progress-warning active">
                    <div class="bar" style="width: 40%">(40%) Loading..</div>
                </div>
                <div class="progress progress-striped progress-info active">
                    <div class="bar" style="width: 60%">(60%) Loading..</div>
                </div>
                <div class="progress progress-striped progress-success active">
                    <div class="bar" style="width: 80%">(80%) Loading..</div>
                </div>
            </div>
            <!-- END Striped Animated -->

            <!-- Stacked -->
            <div class="block-section">
                <h4 class="sub-header">Stacked</h4>
                <div class="progress">
                    <div class="bar bar-info" style="width: 30%;">30%</div>
                    <div class="bar bar-success" style="width: 40%;">40%</div>
                    <div class="bar bar-warning" style="width: 15%;">15%</div>
                    <div class="bar bar-danger" style="width: 15%;">15%</div>
                </div>
                <div class="progress progress-striped">
                    <div class="bar bar-info" style="width: 30%;">30%</div>
                    <div class="bar bar-success" style="width: 40%;">40%</div>
                    <div class="bar bar-warning" style="width: 15%;">15%</div>
                    <div class="bar bar-danger" style="width: 15%;">15%</div>
                </div>
                <div class="progress progress-striped active">
                    <div class="bar bar-info" style="width: 30%;">30%</div>
                    <div class="bar bar-success" style="width: 40%;">40%</div>
                    <div class="bar bar-warning" style="width: 15%;">15%</div>
                    <div class="bar bar-danger" style="width: 15%;">15%</div>
                </div>
            </div>
            <!-- END Stacked -->
        </div>
        <!-- END Progress Bars Content -->
    </div>
    <!-- END Progress Bars Block -->
</div>
<!-- END Page Content -->

<?php include 'inc/footer.php'; // Footer and scripts ?>

<!-- Javascript code only for this page -->
<script>
    $(function(){
        // Demostration of progress bars
        var pbButton = $('#example-progress-bar-button');
        var pbBar = $('#example-progress-bar .bar');

        // When the button is clicked
        pbButton.click(function(){
            $(this).button('loading');
            var i = 0;

            // Run the following block of code in intervals
            interval = setInterval(function() {
                pbBar.css('width', i + '%');
                if (i > 10)
                    pbBar.html(i + '%');
                if (i > 30)
                    pbBar.removeClass('bar-danger').addClass('bar-warning');
                if (i > 50)
                    pbBar.removeClass('bar-warning').addClass('bar-info');
                if (i > 70)
                    pbBar.removeClass('bar-info').addClass('bar-success');
                i+=5;
                if (i > 100) {
                    pbBar.css('width', '100%');
                    pbBar.html('<i class="icon-ok"></i>');
                    pbButton.html('Done!');
                    clearInterval(interval);
                }
            }, 300);
        });
    });
</script>

<?php include 'inc/bottom.php'; // Close body and html tags ?>