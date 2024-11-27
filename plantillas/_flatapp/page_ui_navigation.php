<?php include 'inc/config.php';   // Configuration php file ?>
<?php include 'inc/top.php';      // Meta data and header   ?>
<?php include 'inc/side.php';      // Navigation content     ?>

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-direction themed-color"></i>Navigation<br><small>Various elements ready for use!</small></h1>
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
        <li class="active"><a href="">Navigation</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <!-- Navs Block -->
    <div class="block block-themed">
        <!-- Navs Title -->
        <div class="block-title">
            <h4>Navs <small>A <code>&lt;ul&gt;</code> list!</small></h4>
        </div>
        <!-- END Navs Title -->

        <!-- Navs Content -->
        <div class="block-content">
            <!-- Row Fluid -->
            <div class="row-fluid">
                <!-- Tabs -->
                <div class="span6">
                    <h4 class="page-header">Tabs <small><code>.nav</code> <code>.nav-tabs</code></small></h4>
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="javascript:void(0)"><i class="icon-home"></i> Home</a></li>
                        <li><a href="javascript:void(0)"><i class="icon-user"></i> Profile</a></li>
                        <li><a href="javascript:void(0)"><i class="icon-cog"></i></a></li>
                    </ul>
                </div>
                <!-- END Tabs -->

                <!-- Pills -->
                <div class="span6">
                    <h4 class="page-header">Pills <small><code>.nav</code> <code>.nav-pills</code></small></h4>
                    <ul class="nav nav-pills">
                        <li class="active"><a href="javascript:void(0)"><i class="icon-home"></i> Home</a></li>
                        <li><a href="javascript:void(0)"><i class="icon-user"></i> Profile</a></li>
                        <li class="disabled"><a href="javascript:void(0)">Disabled</a></li>
                    </ul>
                </div>
                <!-- END Pills -->
            </div>
            <!-- END Row Fluid -->

            <!-- Row Fluid -->
            <div class="row-fluid">
                <!-- Stacked Tabs -->
                <div class="span6">
                    <h4 class="page-header">Stacked Tabs <small><code>.nav</code> <code>.nav-tabs</code> <code>.nav-stacked</code></small></h4>
                    <ul class="nav nav-tabs nav-stacked">
                        <li class="active"><a href="javascript:void(0)"><i class="icon-home"></i> Home</a></li>
                        <li><a href="javascript:void(0)"><i class="icon-user"></i> Profile</a></li>
                        <li><a href="javascript:void(0)"><i class="icon-cogs"></i> Settings</a></li>
                    </ul>
                </div>
                <!-- END Stacked Tabs -->

                <!-- Stacked Pills -->
                <div class="span6">
                    <h4 class="page-header">Stacked Pills <small><code>.nav</code> <code>.nav-pills</code> <code>.nav-stacked</code></small></h4>
                    <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a href="javascript:void(0)"><i class="icon-home"></i> Home</a></li>
                        <li><a href="javascript:void(0)"><i class="icon-user"></i> Profile</a></li>
                        <li class="disabled"><a href="javascript:void(0)"><i class="icon-trash"></i> Disabled</a></li>
                    </ul>
                </div>
                <!-- END Stacked Pills -->
            </div>
            <!-- END Row Fluid -->
        </div>
        <!-- END Navs Content -->
    </div>
    <!-- END Navs Block -->

    <!-- Navbar Block -->
    <div class="block block-themed">
        <!-- Navbar Title -->
        <div class="block-title">
            <h4>Navbars <small>Fully responsive!</small></h4>
        </div>
        <!-- END Navbar Title -->

        <!-- Navbar Content -->
        <div class="block-content">
            <!-- Default Navbar -->
            <div class="block-section">
                <h4 class="sub-header">Default</h4>
                <!-- Navbar -->
                <div class="navbar">
                    <!-- Navbar Inner -->
                    <div class="navbar-inner">
                        <!-- div.container -->
                        <div class="container">
                            <!-- Mobile Nav for Tablets and Phones -->
                            <ul class="nav pull-right hidden-desktop">
                                <li class="divider-vertical"></li>
                                <li>
                                    <a href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-responsive-collapse-1">
                                        <i class="icon-reorder"></i>
                                    </a>
                                </li>
                            </ul>
                            <!-- END Mobile Nav for Tablets and Phones -->

                            <!-- Brand -->
                            <a class="brand" href="javascript:void(0)">Logo</a>

                            <!-- Links, Dropdowns and Search -->
                            <div class="nav-collapse collapse navbar-responsive-collapse-1">
                                <ul class="nav">
                                    <li class="active"><a href="javascript:void(0)">Home</a></li>
                                    <li><a href="javascript:void(0)">Link</a></li>
                                    <li class="dropdown">
                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">Menu <i class="icon-angle-down"></i></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="javascript:void(0)">Action</a></li>
                                            <li class="divider"></li>
                                            <li class="nav-header">NAV HEADER</li>
                                            <li><a href="javascript:void(0)">First</a></li>
                                            <li><a href="javascript:void(0)">Second</a></li>
                                            <li><a href="javascript:void(0)">Third</a></li>
                                        </ul>
                                    </li>
                                </ul>
                                <form class="navbar-search pull-left" action="page_search_results.php">
                                    <input type="text" class="search-query span2" placeholder="Search">
                                </form>
                                <ul class="nav pull-right">
                                    <li><a href="javascript:void(0)"><i class="icon-cog"></i></a></li>
                                    <li class="divider-vertical remove-margin"></li>
                                    <li class="dropdown">
                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> <i class="icon-angle-down"></i></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="javascript:void(0)">Action 1</a></li>
                                            <li><a href="javascript:void(0)">Action 2</a></li>
                                            <li><a href="javascript:void(0)">Action 3</a></li>
                                            <li class="divider"></li>
                                            <li><a href="javascript:void(0)">Action 4 (Separated)</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <!-- END Links, Dropdowns and Search -->
                        </div>
                        <!-- END div.container -->
                    </div>
                    <!-- END Navbar Inner -->
                </div>
                <!-- END Navbar -->
            </div>
            <!-- END Default Navbar -->

            <!-- Inverse Navbar -->
            <div class="block-section">
                <h4 class="sub-header">Inverse</h4>
                <!-- Navbar -->
                <div class="navbar navbar-inverse">
                    <!-- Navbar Inner -->
                    <div class="navbar-inner">
                        <!-- div.container -->
                        <div class="container">
                            <!-- Mobile Nav for Tablets and Phones -->
                            <ul class="nav pull-right hidden-desktop">
                                <li class="divider-vertical"></li>
                                <li>
                                    <a href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-responsive-collapse-2">
                                        <i class="icon-reorder"></i>
                                    </a>
                                </li>
                            </ul>
                            <!-- END Mobile Nav for Tablets and Phones -->

                            <!-- Brand -->
                            <a class="brand" href="javascript:void(0)">Logo</a>

                            <!-- Links, Dropdowns and Search -->
                            <div class="nav-collapse collapse navbar-responsive-collapse-2">
                                <ul class="nav">
                                    <li class="active"><a href="javascript:void(0)">Home</a></li>
                                    <li><a href="javascript:void(0)">Link</a></li>
                                    <li class="dropdown">
                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">Menu <i class="icon-angle-down"></i></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="javascript:void(0)">Action</a></li>
                                            <li class="divider"></li>
                                            <li class="nav-header">NAV HEADER</li>
                                            <li><a href="javascript:void(0)">First</a></li>
                                            <li><a href="javascript:void(0)">Second</a></li>
                                            <li><a href="javascript:void(0)">Third</a></li>
                                        </ul>
                                    </li>
                                </ul>
                                <form class="navbar-search pull-left" action="page_search_results.php">
                                    <input type="text" class="search-query span2" placeholder="Search">
                                </form>
                                <ul class="nav pull-right">
                                    <li><a href="javascript:void(0)"><i class="icon-cog"></i></a></li>
                                    <li class="divider-vertical remove-margin"></li>
                                    <li class="dropdown">
                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> <i class="icon-angle-down"></i></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="javascript:void(0)">Action 1</a></li>
                                            <li><a href="javascript:void(0)">Action 2</a></li>
                                            <li><a href="javascript:void(0)">Action 3</a></li>
                                            <li class="divider"></li>
                                            <li><a href="javascript:void(0)">Action 4 (Separated)</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <!-- END Links, Dropdowns and Search -->
                        </div>
                        <!-- END div.container -->
                    </div>
                    <!-- END Navbar Inner -->
                </div>
                <!-- END Navbar -->
            </div>
            <!-- END Inverse Navbar -->
        </div>
        <!-- END Navbar Content -->
    </div>
    <!-- END Navbar Block -->

    <!-- Breadcrumbs Block -->
    <div class="block block-themed">
        <!-- Breadcrumb Title -->
        <div class="block-title">
            <h4>Breadcrumbs <small>A <code>&lt;ul&gt;</code> list with <code>.breadcrumb</code> class. You can use any icon as separator!</small></h4>
        </div>
        <!-- END Breadcrumb Title -->

        <!-- Breadcrumb Content -->
        <div class="block-content">
            <ul class="breadcrumb">
                <li>
                    <a href="javascript:void(0)"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
                </li>
                <li>
                    <a href="javascript:void(0)">Profile</a> <span class="divider"><i class="icon-angle-right"></i></span>
                </li>
                <li>
                    <a href="javascript:void(0)">Settings</a> <span class="divider"><i class="icon-angle-right"></i></span>
                </li>
                <li class="active"><i class="icon-envelope"></i> Email</li>
            </ul>
            <ul class="breadcrumb">
                <li>
                    <a href="javascript:void(0)"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-chevron-right"></i></span>
                </li>
                <li>
                    <a href="javascript:void(0)">Profile</a> <span class="divider"><i class="icon-chevron-right"></i></span>
                </li>
                <li>
                    <a href="javascript:void(0)">Settings</a> <span class="divider"><i class="icon-chevron-right"></i></span>
                </li>
                <li class="active"><i class="icon-envelope"></i> Email</li>
            </ul>
            <ul class="breadcrumb">
                <li>
                    <a href="javascript:void(0)"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-chevron-right"></i></span>
                </li>
                <li>
                    <a href="javascript:void(0)">Profile</a> <span class="divider"><i class="icon-arrow-right"></i></span>
                </li>
                <li>
                    <a href="javascript:void(0)">Settings</a> <span class="divider"><i class="icon-angle-right"></i></span>
                </li>
                <li class="active"><i class="icon-envelope"></i> Email</li>
            </ul>
            <ul class="breadcrumb">
                <li>
                    <a href="javascript:void(0)"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-arrow-right"></i></span>
                </li>
                <li>
                    <a href="javascript:void(0)">Profile</a> <span class="divider"><i class="icon-arrow-right"></i></span>
                </li>
                <li>
                    <a href="javascript:void(0)">Settings</a> <span class="divider"><i class="icon-arrow-right"></i></span>
                </li>
                <li class="active"><i class="icon-envelope"></i> Email</li>
            </ul>
            <ul class="breadcrumb">
                <li>
                    <a href="javascript:void(0)"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-circle-arrow-right"></i></span>
                </li>
                <li>
                    <a href="javascript:void(0)">Profile</a> <span class="divider"><i class="icon-circle-arrow-right"></i></span>
                </li>
                <li>
                    <a href="javascript:void(0)">Settings</a> <span class="divider"><i class="icon-circle-arrow-right"></i></span>
                </li>
                <li class="active"><i class="icon-envelope"></i> Email</li>
            </ul>
        </div>
        <!-- END Breadcrumbs Content -->
    </div>
    <!-- END Breadcrumb Block -->

    <!-- Pagination Block -->
    <div class="block block-themed">
        <!-- Pagination Title -->
        <div class="block-title">
            <h4>Pagination <small>A <code>&lt;div&gt;</code> with <code>.pagination</code> class and a <code>&lt;ul&gt;</code> list inside</small></h4>
        </div>
        <!-- END Pagination Title -->

        <!-- Pagination Content -->
        <div class="block-content">
            <!-- Default Pagination and States -->
            <div class="row-fluid">
                <div class="span6">
                    <h4 class="page-header">Default Pagination</h4>
                    <div class="pagination">
                        <ul>
                            <li><a href="javascript:void(0)">Prev</a></li>
                            <li><a href="javascript:void(0)">1</a></li>
                            <li><a href="javascript:void(0)">2</a></li>
                            <li><a href="javascript:void(0)">3</a></li>
                            <li><a href="javascript:void(0)">Next</a></li>
                        </ul>
                    </div>
                </div>
                <div class="span6">
                    <h4 class="page-header">Active and Disabled States</h4>
                    <div class="pagination">
                        <ul>
                            <li class="disabled"><a href="javascript:void(0)">Prev</a></li>
                            <li class="active"><a href="javascript:void(0)">1</a></li>
                            <li><a href="javascript:void(0)">2</a></li>
                            <li><a href="javascript:void(0)">3</a></li>
                            <li><a href="javascript:void(0)">Next</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- END Default Pagination and States -->

            <!-- Pagination Sizes and Icons -->
            <div class="block-section">
                <h4 class="page-header">Sizes and Icons <small><code>.pagination-large</code> - <code>.pagination-small</code> - <code>.pagination-mini</code></small></h4>
                <div class="pagination pagination-large">
                    <ul>
                        <li><a href="javascript:void(0)"><i class="icon-chevron-left"></i></a></li>
                        <li><a href="javascript:void(0)">1</a></li>
                        <li><a href="javascript:void(0)">2</a></li>
                        <li><a href="javascript:void(0)">3</a></li>
                        <li><a href="javascript:void(0)"><i class="icon-chevron-right"></i></a></li>
                    </ul>
                </div>
                <div class="pagination pagination-small">
                    <ul>
                        <li><a href="javascript:void(0)"><i class="icon-circle-arrow-left"></i></a></li>
                        <li><a href="javascript:void(0)">1</a></li>
                        <li><a href="javascript:void(0)">2</a></li>
                        <li><a href="javascript:void(0)">3</a></li>
                        <li><a href="javascript:void(0)"><i class="icon-circle-arrow-right"></i></a></li>
                    </ul>
                </div>
                <div class="pagination pagination-mini">
                    <ul>
                        <li><a href="javascript:void(0)"><i class="icon-arrow-left"></i></a></li>
                        <li><a href="javascript:void(0)">1</a></li>
                        <li><a href="javascript:void(0)">2</a></li>
                        <li><a href="javascript:void(0)">3</a></li>
                        <li><a href="javascript:void(0)"><i class="icon-arrow-right"></i></a></li>
                    </ul>
                </div>
            </div>
            <!-- END Pagination Sizes and Icons -->

            <!-- Pagination Alignment -->
            <div class="block-section">
                <h4 class="page-header">Alignment <small>Default - <code>.pagination-centered</code> - <code>.pagination-right</code></small></h4>
                <div class="pagination">
                    <ul>
                        <li><a href="javascript:void(0)">Prev</a></li>
                        <li><a href="javascript:void(0)">1</a></li>
                        <li><a href="javascript:void(0)">2</a></li>
                        <li><a href="javascript:void(0)">3</a></li>
                        <li><a href="javascript:void(0)">Next</a></li>
                    </ul>
                </div>
                <div class="pagination pagination-centered">
                    <ul>
                        <li><a href="javascript:void(0)">Prev</a></li>
                        <li><a href="javascript:void(0)">1</a></li>
                        <li><a href="javascript:void(0)">2</a></li>
                        <li><a href="javascript:void(0)">3</a></li>
                        <li><a href="javascript:void(0)">Next</a></li>
                    </ul>
                </div>
                <div class="pagination pagination-right">
                    <ul>
                        <li><a href="javascript:void(0)">Prev</a></li>
                        <li><a href="javascript:void(0)">1</a></li>
                        <li><a href="javascript:void(0)">2</a></li>
                        <li><a href="javascript:void(0)">3</a></li>
                        <li><a href="javascript:void(0)">Next</a></li>
                    </ul>
                </div>
            </div>
            <!-- END Pagination Alignment -->
        </div>
        <!-- END Pagination Content -->
    </div>
    <!-- END Pagination Block -->

    <!-- Pager Block -->
    <div class="block block-themed block-last">
        <!-- Pager Title -->
        <div class="block-title">
            <h4>Pager <small>A <code>&lt;ul&gt;</code> with <code>.pager</code> class. You can use only icons, only text or both!</small></h4>
        </div>
        <!-- END Pager Title -->

        <!-- Pager Content -->
        <div class="block-content">
            <ul class="pager">
                <li class="previous"><a href="javascript:void(0)"><i class="icon-arrow-left"></i> Prev</a></li>
                <li class="next"><a href="javascript:void(0)">Next <i class="icon-arrow-right"></i></a></li>
            </ul>
            <ul class="pager">
                <li class="previous"><a href="javascript:void(0)">Prev</a></li>
                <li class="next"><a href="javascript:void(0)">Next</a></li>
            </ul>
            <ul class="pager">
                <li class="previous"><a href="javascript:void(0)"><i class="icon-chevron-left"></i></a></li>
                <li class="next"><a href="javascript:void(0)"><i class="icon-chevron-right"></i></a></li>
            </ul>
        </div>
        <!-- END Pager Content -->
    </div>
    <!-- END Pager Block -->
</div>
<!-- END Page Content -->

<?php include 'inc/footer.php'; // Footer and scripts ?>

<?php include 'inc/bottom.php'; // Close body and html tags ?>