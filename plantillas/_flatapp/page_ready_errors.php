<?php include 'inc/config.php';   // Configuration php file ?>
<?php include 'inc/top.php';      // Meta data and header   ?>
<?php include 'inc/side.php';      // Navigation content     ?>

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-circle_exclamation_mark themed-color"></i>Errors<br><small>Yeap, some of them could happen! :-(</small></h1>
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
            <a href="#">Ready UI</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="">Errors</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <!-- Error Tabs -->
    <ul id="error-tabs" class="nav nav-pills" data-toggle="tabs">
        <li><a href="#error-tabs-400"><strong>400</strong></a></li>
        <li><a href="#error-tabs-401"><strong>401</strong></a></li>
        <li><a href="#error-tabs-403"><strong>403</strong></a></li>
        <li class="active"><a href="#error-tabs-404"><strong>404</strong></a></li>
        <li><a href="#error-tabs-500"><strong>500</strong></a></li>
        <li><a href="#error-tabs-503"><strong>503</strong></a></li>
    </ul>
    <!-- END Error Tabs -->

    <!-- Error Content -->
    <div class="tab-content tab-content-default">
        <!-- 400 Error -->
        <div id="error-tabs-400" class="tab-pane">
            <div class="error-container">
                <div class="error-text">Bad Request!</div>
                <div class="error-code text-error"><i class="icon-remove-sign"></i> 400</div>
                <form action="page_ready_search_results.php" method="post" class="error-search">
                    <div class="input-append">
                        <input type="text" id="example-error-search" placeholder="Search..">
                        <button class="btn"><i class="icon-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <!-- END 400 Error -->

        <!-- 401 Error -->
        <div id="error-tabs-401" class="tab-pane">
            <div class="error-container">
                <div class="error-text">Unauthorized!</div>
                <div class="error-code text-error"><i class="icon-remove-circle"></i> 401</div>
                <form action="page_ready_search_results.php" method="post" class="error-search">
                    <div class="input-append">
                        <input type="text" id="example-error-search2" placeholder="Search..">
                        <button class="btn"><i class="icon-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <!-- END 401 Error -->

        <!-- 403 Error -->
        <div id="error-tabs-403" class="tab-pane">
            <div class="error-container">
                <div class="error-text">Forbidden!</div>
                <div class="error-code text-error"><i class="icon-remove"></i> 403</div>
                <form action="page_ready_search_results.php" method="post" class="error-search">
                    <div class="input-append">
                        <input type="text" id="example-error-search3" placeholder="Search..">
                        <button class="btn"><i class="icon-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <!-- END 403 Error -->

        <!-- 404 Error -->
        <div id="error-tabs-404" class="tab-pane active">
            <div class="error-container">
                <div class="error-text">Page not found!</div>
                <div class="error-code text-error"><i class="icon-warning-sign"></i> 404</div>
                <form action="page_ready_search_results.php" method="post" class="error-search">
                    <div class="input-append">
                        <input type="text" id="example-error-search4" placeholder="Search..">
                        <button class="btn"><i class="icon-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <!-- END 404 Error -->

        <!-- 500 Error -->
        <div id="error-tabs-500" class="tab-pane">
            <div class="error-container">
                <div class="error-text">Internal Server Error!</div>
                <div class="error-code text-error"><i class="icon-warning-sign"></i> 500</div>
                <form action="page_ready_search_results.php" method="post" class="error-search">
                    <div class="input-append">
                        <input type="text" id="example-error-search5" placeholder="Search..">
                        <button class="btn"><i class="icon-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <!-- END 500 Error -->

        <!-- 503 Error -->
        <div id="error-tabs-503" class="tab-pane">
            <div class="error-container">
                <div class="error-text">Service Unavailable!</div>
                <div class="error-code text-error"><i class="icon-remove-circle"></i> 503</div>
                <form action="page_ready_search_results.php" method="post" class="error-search">
                    <div class="input-append">
                        <input type="text" id="example-error-search6" placeholder="Search..">
                        <button class="btn"><i class="icon-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <!-- END 503 Error -->
    </div>
    <!-- END Error Tabs Content -->
</div>
<!-- END Page Content -->

<?php include 'inc/footer.php'; // Footer and scripts ?>

<?php include 'inc/bottom.php'; // Close body and html tags ?>