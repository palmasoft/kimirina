<?php include 'inc/config.php';   // Configuration php file ?>
<?php include 'inc/top.php';      // Meta data and header   ?>
<?php include 'inc/side.php';      // Navigation content     ?>

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="icon-time themed-color"></i>Timeline<br><small>Awesome for keeping track of updates!</small></h1>
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
        <li class="active"><a href="">Timeline</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <!-- Timeline Block -->
    <div class="block block-themed block-last">
        <!-- Timeline Title -->
        <div class="block-title">
            <h4><i id="timeline-icon" class="icon-spinner icon-spin"></i> Live Updates</h4>
        </div>
        <!-- END Timeline Title -->

        <!-- Timeline Content -->
        <div class="block-content">
            <!-- Timeline Container -->
            <div class="timeline-container">
                <!-- Timeline -->
                <ul class="timeline">
                    <li>
                        <i class="timeline-meta-cat icon-cog themed-background-city"></i>
                        <span class="timeline-meta-time">5 hours ago</span>
                        <span class="timeline-title">System Update</span>
                        <span class="timeline-text"><strong>App</strong> updated to 2.0 version! Please check <a href="page_ready_faq.php">FAQ</a> for more info!</span>
                    </li>
                    <li>
                        <i class="timeline-meta-cat icon-pencil themed-background-tulip"></i>
                        <span class="timeline-meta-time">10 hours ago</span>
                        <span class="timeline-title">Page Edited</span>
                        <span class="timeline-text"><a href="page_ready_pricing_tables.php">Pricing Tables</a></span>
                    </li>
                    <li class="clearfix">
                        <i class="timeline-meta-cat icon-comments themed-background-leaf"></i>
                        <span class="timeline-meta-time">17 hours ago</span>
                        <img src="img/placeholders/image_64x64_dark.png" alt="Avatar" class="timeline-avatar">
                        <span class="timeline-title"><a href="page_ready_user_profile.php">Chloe</a> just commented on an <a href="page_ready_product.php">Product</a></span>
                        <span class="timeline-text">Its a great product! I highly recommend it!</span>
                    </li>
                    <li>
                        <i class="timeline-meta-cat icon-pencil themed-background-tulip"></i>
                        <span class="timeline-meta-time">yesterday</span>
                        <span class="timeline-title">Page Edited</span>
                        <span class="timeline-text"><a href="page_ready_invoice.php">Invoice</a></span>
                    </li>
                    <li class="clearfix">
                        <i class="timeline-meta-cat glyphicon-circle_plus themed-background-diamond"></i>
                        <span class="timeline-meta-time">yesterday</span>
                        <img src="img/placeholders/image_64x64_dark.png" alt="Avatar" class="timeline-avatar">
                        <span class="timeline-title"><a href="page_ready_user_profile.php">Estelle</a> just added 1 new <a href="page_ready_article.php">Article</a></span>
                        <p class="timeline-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida, urna ligula hendrerit nibh, ac cursus nibh sapien in purus. Mauris tincidunt tincidunt turpis in porta. Integer fermentum tincidunt auctor. Vestibulum ullamcorper, odio sed rhoncus imperdiet, enim elit sollicitudin orci, eget dictum leo mi nec lectus. Nam commodo turpis id lectus scelerisque vulputate. Integer sed dolor erat. Fusce erat ipsum, varius vel euismod sed, tristique et lectus? Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque? Proin rhoncus dui at ligula vestibulum ut facilisis ante sodales! Suspendisse potenti. Aliquam tincidunt sollicitudin sem nec ultrices. Sed at mi velit. Ut egestas tempor est, in cursus enim venenatis eget! Nulla quis ligula ipsum. Donec vitae ultrices dolor?</p>
                        <p class="timeline-text remove-margin">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida, urna ligula hendrerit nibh, ac cursus nibh sapien in purus. Mauris tincidunt tincidunt turpis in porta. Integer fermentum tincidunt auctor. Vestibulum ullamcorper, odio sed rhoncus imperdiet, enim elit sollicitudin orci, eget dictum leo mi nec lectus. Nam commodo turpis id lectus scelerisque vulputate. Integer sed dolor erat. Fusce erat ipsum, varius vel euismod sed, tristique et lectus? Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque? Proin rhoncus dui at ligula vestibulum ut facilisis ante sodales! Suspendisse potenti. Aliquam tincidunt sollicitudin sem nec ultrices. Sed at mi velit. Ut egestas tempor est, in cursus enim venenatis eget! Nulla quis ligula ipsum. Donec vitae ultrices dolor?</p>
                    </li>
                    <li class="clearfix">
                        <i class="timeline-meta-cat glyphicon-picture themed-background-wood"></i>
                        <span class="timeline-meta-time">6 days ago</span>
                        <img src="img/placeholders/image_64x64_dark.png" alt="Avatar" class="timeline-avatar">
                        <span class="timeline-title"><a href="page_ready_user_profile.php">Michael</a> just added 3 new photos</span>
                        <a href="img/placeholders/image_720x450_light.png" data-toggle="lightbox-image"><img src="img/placeholders/image_160x120_light.png" alt="image"></a>
                        <a href="img/placeholders/image_720x450_light.png" data-toggle="lightbox-image"><img src="img/placeholders/image_160x120_light.png" alt="image"></a>
                        <a href="img/placeholders/image_720x450_light.png" data-toggle="lightbox-image"><img src="img/placeholders/image_160x120_light.png" alt="image"></a>
                    </li>
                    <li>
                        <i class="timeline-meta-cat icon-cogs themed-background-asphalt"></i>
                        <span class="timeline-meta-time">2 weeks ago</span>
                        <span class="timeline-title">Component Update</span>
                        <span class="timeline-text"><strong>Widget</strong> updated to 1.2 version! Please check <a href="page_ready_faq.php">FAQ</a> for more info!</span>
                    </li>
                    <li class="clearfix">
                        <i class="timeline-meta-cat icon-ok themed-background-sun"></i>
                        <span class="timeline-meta-time">1 month ago</span>
                        <img src="img/template/avatar.jpg" alt="Avatar" class="timeline-avatar">
                        <span class="timeline-title">Welcome John!</span>
                        <span class="timeline-text"><a href="page_ready_user_profile.php">John Doe</a> just joined <strong>App</strong></span>
                    </li>
                </ul>
                <!-- END Timeline -->
            </div>
            <!-- END Timeline Container -->
        </div>
        <!-- END Timeline Content -->
    </div>
    <!-- END Timeline Block -->
</div>
<!-- END Page Content -->

<?php include 'inc/footer.php'; // Footer and scripts ?>

<!-- Javascript code only for this page -->
<script>
    $(function(){
        /* Timeline - Adding content demostration */
        var timelineSpeed = 250;

        setTimeout(function(){
            $('<li class="clearfix">' +
                '<i class="timeline-meta-cat glyphicon-picture themed-background-wood"></i>' +
                '<span class="timeline-meta-time">just now</span>' +
                '<img src="img/template/avatar.jpg" alt="Avatar" class="timeline-avatar">' +
                '<span class="timeline-title"><a href="page_ready_user_profile.php">John Doe</a> just added 2 new photos</span>' +
                '<a href="img/placeholders/image_720x450_light.png" data-toggle="lightbox-image"><img src="img/placeholders/image_160x120_light.png" alt="image"></a> ' +
                '<a href="img/placeholders/image_720x450_light.png" data-toggle="lightbox-image"><img src="img/placeholders/image_160x120_light.png" alt="image"></a>' +
            '</li>').prependTo('.timeline').hide().slideDown(timelineSpeed);

            // Re Initialize Image Popup for new image content
            $('[data-toggle="lightbox-image"]').magnificPopup({ type: 'image' });
        }, 2000);

        setTimeout(function(){
            $('<li>' +
                '<i class="timeline-meta-cat glyphicon-circle_plus themed-background-ocean"></i>' +
                '<span class="timeline-meta-time">just now</span>' +
                '<span class="timeline-title">Twitter</span>' +
                '<span class="timeline-text">+3 Followers</span>' +
            '</li>').prependTo('.timeline').hide().slideDown(timelineSpeed);
        }, 4000);

        setTimeout(function(){
            $('<li class="clearfix">' +
                '<i class="timeline-meta-cat icon-comments themed-background-leaf"></i>' +
                '<span class="timeline-meta-time">just now</span>' +
                '<img src="img/placeholders/image_64x64_dark.png" alt="Avatar" class="timeline-avatar">' +
                '<span class="timeline-title"><a href="page_ready_user_profile.php">Estelle</a> just commented on an <a href="page_ready_product.php">Product</a></span>' +
                '<span class="timeline-text">Yes, I like this product too!</span>' +
            '</li>').prependTo('.timeline').hide().slideDown(timelineSpeed);
        }, 6000);

        setTimeout(function(){
            $('<li class="clearfix">' +
                '<i class="timeline-meta-cat glyphicon-brush themed-background-dawn"></i>' +
                '<span class="timeline-meta-time">just now</span>' +
                '<img src="img/template/pixelcave.png" alt="pixelcave" class="timeline-avatar">' +
                '<span class="timeline-title">Thank you!</span>' +
                '<span class="timeline-text">This was just a demonstration of how loading updates could happen! You can use all the available color themes as well as any icon for your category!</span>' +
            '</li>').prependTo('.timeline').hide().slideDown(timelineSpeed);

            // Remove loading spinner
            $('#timeline-icon').removeClass('icon-spin').removeClass('icon-spinner').addClass('icon-ok');
        }, 8000);
    });
</script>

<?php include 'inc/bottom.php'; // Close body and html tags ?>