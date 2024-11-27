<?php include 'inc/config.php';   // Configuration php file ?>
<?php include 'inc/top.php';      // Meta data and header   ?>
<?php include 'inc/side.php';      // Navigation content     ?>

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-more_items themed-color"></i>Tabs &amp; Accordions<br><small>We all need them somewhere in our UI!</small></h1>
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
        <li class="active"><a href="">Tabs &amp; Accordions</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <!-- Default Tabs Block -->
    <div class="block block-themed">
        <!-- Default Tabs Title -->
        <div class="block-title">
            <h4>Default Tabs <small>Simple to use and to customize</small></h4>
        </div>
        <!-- END Default Tabs Title -->

        <!-- Default Tabs Content -->
        <div class="block-content full">
            <ul class="nav nav-tabs" data-toggle="tabs">
                <li class="active"><a href="#example-tabs-home"><i class="icon-home"></i> Home</a></li>
                <li><a href="#example-tabs-profile">Profile</a></li>
                <li><a href="#example-tabs-messages" data-toggle="tooltip" title="Messages"><i class="icon-envelope"></i></a></li>
                <li><a href="#example-tabs-options" data-toggle="tooltip" title="Options"><i class="icon-cog"></i></a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="example-tabs-home">Home Content..</div>
                <div class="tab-pane" id="example-tabs-profile">Profile Content..</div>
                <div class="tab-pane" id="example-tabs-messages">Messages Content..</div>
                <div class="tab-pane" id="example-tabs-options">Options Content..</div>
            </div>
        </div>
        <!-- END Default Tabs Content -->
    </div>
    <!-- END Default Tabs Block -->

    <!-- Left Aligned Tabs Block -->
    <div class="block block-themed">
        <!-- Left Aligned Tabs Title -->
        <div class="block-title">
            <h4>Left Aligned Tabs</h4>
        </div>
        <!-- END Left Aligned Tabs Title -->

        <!-- Left Aligned Tabs Content -->
        <div class="block-content">
            <div class="tabs-left clearfix">
                <ul class="nav nav-tabs" data-toggle="tabs">
                    <li class="active"><a href="#example-tabs2-home"><i class="icon-home"></i> Home</a></li>
                    <li><a href="#example-tabs2-profile"><i class="icon-user"></i> Profile</a></li>
                    <li><a href="#example-tabs2-messages"><i class="icon-envelope-alt"></i> Messages</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="example-tabs2-home">Home Content..</div>
                    <div class="tab-pane" id="example-tabs2-profile">Profile Content..</div>
                    <div class="tab-pane" id="example-tabs2-messages">Messages Content..</div>
                </div>
            </div>
        </div>
        <!-- END Left Aligned Tabs Content -->
    </div>
    <!-- END Left Aligned Tabs Block -->

    <!-- Right Aligned Tabs Block -->
    <div class="block block-themed">
        <!-- Right Aligned Tabs Title -->
        <div class="block-title">
            <h4>Right Aligned Tabs</h4>
        </div>
        <!-- END Right Aligned Tabs Title -->

        <!-- Right Aligned Tabs Content -->
        <div class="block-content">
            <div class="tabs-right clearfix">
                <ul class="nav nav-tabs" data-toggle="tabs">
                    <li class="active"><a href="#example-tabs3-home"><i class="icon-home"></i> Home</a></li>
                    <li><a href="#example-tabs3-profile"><i class="icon-user"></i> Profile</a></li>
                    <li><a href="#example-tabs3-messages"><i class="icon-envelope-alt"></i> Message</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="example-tabs3-home">Home Content..</div>
                    <div class="tab-pane" id="example-tabs3-profile">Profile Content..</div>
                    <div class="tab-pane" id="example-tabs3-messages">Messages Content..</div>
                </div>
            </div>
        </div>
        <!-- END Right Aligned Tabs Content -->
    </div>
    <!-- END Right Aligned Tabs Block -->

    <!-- Block Tabs -->
    <div class="block block-tabs">
        <div class="block-options hidden-phone">
            <button class="btn btn-primary" data-toggle="tooltip" title="Post on Facebook"><i class="icon-facebook"></i></button>
            <button class="btn btn-info" data-toggle="tooltip" title="Post on Twitter"><i class="icon-twitter"></i></button>
            <button class="btn btn-warning" data-toggle="tooltip" title="Take Screenshot"><i class="icon-picture"></i></button>
            <div class="btn-group">
                <a class="btn btn-inverse dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)"><i class="icon-angle-down"></i></a>
                <ul class="dropdown-menu pull-right">
                    <li><a href="javascript:void(0)">Action</a></li>
                    <li class="disabled"><a href="javascript:void(0)">Disabled</a></li>
                    <li class="divider"></li>
                    <li><a href="javascript:void(0)">Another Action</a></li>
                </ul>
            </div>
        </div>
        <ul class="nav nav-tabs" data-toggle="tabs">
            <li class="active"><a href="#example-tabs5-home">Home</a></li>
            <li><a href="#example-tabs5-profile">Profile</a></li>
            <li><a href="#example-tabs5-messages" data-toggle="tooltip" title="Messages"><i class="icon-envelope"></i></a></li>
            <li><a href="#example-tabs5-options" data-toggle="tooltip" title="Options"><i class="icon-cog"></i></a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="example-tabs5-home">Default Block Tabs!</div>
            <div class="tab-pane" id="example-tabs5-profile">Profile Content..</div>
            <div class="tab-pane" id="example-tabs5-messages">Messages Content..</div>
            <div class="tab-pane" id="example-tabs5-options">Options Content..</div>
        </div>
    </div>
    <!-- END Block Tabs -->

    <!-- Block Tabs Themed -->
    <div class="block block-tabs block-themed">
        <div class="block-options hidden-phone">
            <div class="btn-group">
                <button class="btn btn-inverse" data-toggle="tooltip" title="Flag it!"><i class="icon-flag"></i></button>
                <button class="btn btn-inverse" data-toggle="tooltip" title="Delete it!"><i class="icon-trash"></i></button>
            </div>
        </div>
        <ul class="nav nav-tabs" data-toggle="tabs">
            <li class="active"><a href="#example-tabs4-home">Home</a></li>
            <li><a href="#example-tabs4-profile">Profile</a></li>
            <li><a href="#example-tabs4-messages" data-toggle="tooltip" title="Messages"><i class="icon-envelope"></i></a></li>
            <li><a href="#example-tabs4-options" data-toggle="tooltip" title="Options"><i class="icon-cog"></i></a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="example-tabs4-home">Block Tabs Themed!</div>
            <div class="tab-pane" id="example-tabs4-profile">Profile Content..</div>
            <div class="tab-pane" id="example-tabs4-messages">Messages Content..</div>
            <div class="tab-pane" id="example-tabs4-options">Options Content..</div>
        </div>
    </div>
    <!-- END Block Tabs Themed -->

    <!-- Accordion Block -->
    <div class="block block-themed block-last">
        <!-- Accordion Title -->
        <div class="block-title">
            <h4>Accordion</h4>
        </div>
        <!-- END Accordion Title -->

        <!-- Accordion Content -->
        <div class="block-content">
            <div class="accordion" id="example-accordion">
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#example-accordion" href="#example-accordion-content1">Question #1</a>
                    </div>
                    <div id="example-accordion-content1" class="accordion-body collapse in">
                        <div class="accordion-inner">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida, urna ligula hendrerit nibh, ac cursus nibh sapien in purus. Mauris tincidunt tincidunt turpis in porta. Integer fermentum tincidunt auctor. Vestibulum ullamcorper, odio sed rhoncus imperdiet, enim elit sollicitudin orci, eget dictum leo mi nec lectus. Nam commodo turpis id lectus scelerisque vulputate. Integer sed dolor erat. Fusce erat ipsum, varius vel euismod sed, tristique et lectus? Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque? Proin rhoncus dui at ligula vestibulum ut facilisis ante sodales! Suspendisse potenti. Aliquam tincidunt sollicitudin sem nec ultrices. Sed at mi velit. Ut egestas tempor est, in cursus enim venenatis eget! Nulla quis ligula ipsum. Donec vitae ultrices dolor?</div>
                    </div>
                </div>
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#example-accordion" href="#example-accordion-content2">Question #2</a>
                    </div>
                    <div id="example-accordion-content2" class="accordion-body collapse">
                        <div class="accordion-inner">Donec lacinia venenatis metus at bibendum? In hac habitasse platea dictumst. Proin ac nibh rutrum lectus rhoncus eleifend. Sed porttitor pretium venenatis. Suspendisse potenti. Aliquam quis ligula elit. Aliquam at orci ac neque semper dictum. Sed tincidunt scelerisque ligula, et facilisis nulla hendrerit non. Suspendisse potenti. Pellentesque non accumsan orci. Praesent at lacinia dolor. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                    </div>
                </div>
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#example-accordion" href="#example-accordion-content3">Question #3</a>
                    </div>
                    <div id="example-accordion-content3" class="accordion-body collapse">
                        <div class="accordion-inner">Answer..</div>
                    </div>
                </div>
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#example-accordion" href="#example-accordion-content4">Question #4</a>
                    </div>
                    <div id="example-accordion-content4" class="accordion-body collapse">
                        <div class="accordion-inner">Answer..</div>
                    </div>
                </div>
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#example-accordion" href="#example-accordion-content5">Question #5</a>
                    </div>
                    <div id="example-accordion-content5" class="accordion-body collapse">
                        <div class="accordion-inner">Answer..</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Accordion Content -->
    </div>
    <!-- END Accordion Block -->
</div>
<!-- END Page Content -->

<?php include 'inc/footer.php'; // Footer and scripts ?>

<?php include 'inc/bottom.php'; // Close body and html tags ?>