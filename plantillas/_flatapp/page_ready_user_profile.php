<?php include 'inc/config.php';   // Configuration php file ?>
<?php include 'inc/top.php';      // Meta data and header   ?>
<?php include 'inc/side.php';      // Navigation content     ?>

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-user themed-color"></i>John Doe<br><small>username!</small></h1>
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
        <li class="active"><a href="">User Profile</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <!-- User Profile Block -->
    <div class="block block-themed block-last">
        <!-- User Profile Title -->
        <div class="block-title">
            <div class="block-options-medium">
                <a href="javascript:void(0)" class="badge badge-success" data-toggle="tooltip" title="Available For Hire">
                    <i class="icon-ok"></i>
                </a>
                <a href="javascript:void(0)" class="badge badge-info" data-toggle="tooltip" title="Send Message">
                    <i class="icon-envelope"></i>
                </a>
                <a href="javascript:void(0)" class="badge badge-neutral">Web Designer</a>
            </div>
            <h4>User Profile</h4>
        </div>
        <!-- END User Profile Title -->

        <!-- User Profile Content -->
        <div class="block-content">
            <!-- User Profile Content -->
            <div class="row-fluid">
                <!-- First Column -->
                <div class="span3">
                    <!-- Avatar -->
                    <div class="block-section text-center">
                        <img src="img/template/avatar.jpg" class="img-circle" alt="image">
                    </div>
                    <!-- END Avatar -->

                    <!-- Skills -->
                    <div class="block-section">
                        <div class="label label-inverse">Photoshop</div>
                        <div class="progress progress-success progress-mini">
                            <div class="bar" style="width: 90%"></div>
                        </div>
                        <div class="label label-inverse">HTML</div>
                        <div class="progress progress-warning progress-mini">
                            <div class="bar" style="width: 65%"></div>
                        </div>
                        <div class="label label-inverse">CSS</div>
                        <div class="progress progress-success progress-mini">
                            <div class="bar" style="width: 100%"></div>
                        </div>
                        <div class="label label-inverse">Javascript</div>
                        <div class="progress progress-danger progress-mini">
                            <div class="bar" style="width: 45%"></div>
                        </div>
                    </div>
                    <!-- END Skills -->

                    <!-- Links -->
                    <ul class="nav nav-tabs nav-stacked">
                        <li><a href="javascript:void(0)"><i class="icon-coffee"></i> Portfolio</a></li>
                        <li><a href="javascript:void(0)"><i class="icon-paper-clip"></i> Projects</a></li>
                        <li><a href="javascript:void(0)"><i class="icon-picture"></i> Gallery</a></li>
                    </ul>
                    <!-- END Links -->

                    <!-- Social -->
                    <ul class="nav nav-tabs nav-stacked">
                        <li><a href="javascript:void(0)"><i class="icon-facebook"></i> Facebook</a></li>
                        <li><a href="javascript:void(0)"><i class="icon-twitter"></i> Twitter</a></li>
                        <li><a href="javascript:void(0)"><i class="icon-linkedin"></i> LinkedIn</a></li>
                        <li><a href="javascript:void(0)"><i class="icon-pinterest"></i> Pinterest</a></li>
                        <li><a href="javascript:void(0)"><i class="icon-github"></i> Github</a></li>
                    </ul>
                    <!-- END Social -->
                </div>
                <!-- END First Column -->

                <!-- Second Column -->
                <div class="span9">
                    <h4>Bio</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida, urna ligula hendrerit nibh, ac cursus nibh sapien in purus.</p>
                    <p> Mauris tincidunt tincidunt turpis in porta. Integer fermentum tincidunt auctor. Vestibulum ullamcorper, odio sed rhoncus imperdiet, enim elit sollicitudin orci, eget dictum leo mi nec lectus. Nam commodo turpis id lectus scelerisque vulputate. Integer sed dolor erat. Fusce erat ipsum, varius vel euismod sed, tristique et lectus? Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque.</p>
                    <p>Proin rhoncus dui at ligula vestibulum ut facilisis ante sodales! Suspendisse potenti. Aliquam tincidunt sollicitudin sem nec ultrices. Sed at mi velit. Ut egestas tempor est, in cursus enim venenatis eget! Nulla quis ligula ipsum. Donec vitae ultrices dolor?</p>
                    <h4>Favorite Quote</h4>
                    <blockquote>
                        <p>This is an awesome quote!</p>
                        <small>Someone famous <cite title="Source Title">Source Title</cite></small>
                    </blockquote>
                    <h4>Experience</h4>
                    <ul class="icons-ul list">
                        <li>
                            <i class="icon-li icon-ok text-success"></i> <span class="label label-info">2010-2013</span> <strong>Company #1</strong>,<br><em>This is the description of the company..</em><br><a href="javascript:void(0)" class="badge">examplecompany1.com</a>
                        </li>
                        <li>
                            <i class="icon-li icon-ok text-success"></i> <span class="label label-info">2009-2010</span> <strong>Company #2</strong>,<br><em>This is the description of the company..</em><br><a href="javascript:void(0)" class="badge">examplecompany2.com</a>
                        </li>
                        <li>
                            <i class="icon-li icon-ok text-success"></i> <span class="label label-info">2005-2009</span> <strong>Company #3</strong>,<br><em>This is the description of the company..</em><br><a href="javascript:void(0)" class="badge">examplecompany3.com</a>
                        </li>
                        <li>
                            <i class="icon-li icon-ok text-success"></i> <span class="label label-info">2000-2005</span> <strong>Company #4</strong>,<br><em>This is the description of the company..</em><br><a href="javascript:void(0)" class="badge">examplecompany4.com</a>
                        </li>
                    </ul>
                </div>
                <!-- END Second Column -->
            </div>
            <!-- END User Profile Content -->
        </div>
        <!-- END User Profile Content -->
    </div>
    <!-- END User Profile Block -->
</div>
<!-- END Page Content -->

<?php include 'inc/footer.php'; // Footer and scripts ?>

<?php include 'inc/bottom.php'; // Close body and html tags ?>