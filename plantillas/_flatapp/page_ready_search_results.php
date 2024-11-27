<?php include 'inc/config.php';   // Configuration php file ?>
<?php include 'inc/top.php';      // Meta data and header   ?>
<?php include 'inc/side.php';      // Navigation content     ?>

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-search themed-color"></i>Search Results<br><small>60 Results Found!</small></h1>
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
        <li class="active"><a href="">Search Results</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <!-- Search Results Block -->
    <div class="block block-themed block-last">
        <!-- Search Results Title -->
        <div class="block-title clearfix">
            <!-- Block Options -->
            <div class="block-options btn-group">
                <a href="javascript:void(0)" class="btn btn-inverse" data-toggle="tooltip" title="Search Options"><i class="icon-cog"></i></a>
                <a href="javascript:void(0)" class="btn btn-inverse dropdown-toggle" data-toggle="dropdown">Sort By <i class="icon-angle-down"></i></a>
                <ul class="dropdown-menu pull-right">
                    <li class="active"><a href="javascript:void(0)">Relevance</a></li>
                    <li><a href="javascript:void(0)">Proficiency</a></li>
                    <li><a href="javascript:void(0)">Date Registered</a></li>
                    <li><a href="javascript:void(0)">Popularity</a></li>
                </ul>
            </div>
            <!-- END Block Options -->
            <h4>Results</h4>
        </div>
        <!-- END Search Results Title -->

        <!-- Search Results Content -->
        <div class="block-content">
            <!-- Results -->
            <?php $prof = array('Web Developer', 'Web Designer', 'UI Designer', 'UX Designer', 'Database Expert'); ?>
            <?php $j=1; for($i=0; $i<10; $i++) { ?>
            <div class="row-fluid row-items">
                <div class="span6">
                    <div class="media media-hover">
                        <a href="javascript:void(0)" class="pull-left">
                            <img src="img/placeholders/image_64x64_dark.png" class="media-object img-circle" alt="Image">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">John Doe <small>username<?php echo $j++; ?></small></h4>
                            <a href="page_user_profile.php" class="badge badge-success" data-toggle="tooltip" title="Profile">
                                <i class="icon-user"></i>
                            </a>
                            <a href="javascript:void(0)" class="badge badge-info"><?php echo $prof[rand(0, 4)]; ?></a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida..</p>
                        </div>
                    </div>
                </div>
                <div class="span6">
                    <div class="media media-hover">
                        <a href="javascript:void(0)" class="pull-left">
                            <img src="img/placeholders/image_64x64_dark.png" class="media-object img-circle" alt="Image">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">John Doe <small>username<?php echo $j++; ?></small></h4>
                            <a href="page_user_profile.php" class="badge badge-success" data-toggle="tooltip" title="Profile">
                                <i class="icon-user"></i>
                            </a>
                            <a href="javascript:void(0)" class="badge badge-info"><?php echo $prof[rand(0, 4)]; ?></a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida..</p>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <!-- END Results -->

            <!-- Pagination -->
            <div class="pagination pagination-centered">
                <ul>
                    <li class="disabled"><a href="javascript:void(0)">Prev</a></li>
                    <li class="active"><a href="javascript:void(0)">1</a></li>
                    <li><a href="javascript:void(0)">2</a></li>
                    <li><a href="javascript:void(0)">3</a></li>
                    <li><a href="javascript:void(0)">Next</a></li>
                </ul>
            </div>
            <!-- END Pagination -->
        </div>
        <!-- END Search Results Content -->
    </div>
    <!-- END Search Results Block -->
</div>
<!-- END Page Content -->

<?php include 'inc/footer.php'; // Footer and scripts ?>

<?php include 'inc/bottom.php'; // Close body and html tags ?>