<?php include 'inc/config.php';   // Configuration php file ?>
<?php include 'inc/top.php';      // Meta data and header   ?>
<?php include 'inc/side.php';      // Navigation content     ?>

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-picture themed-color"></i>Carousel<br><small>Show your images in style!</small></h1>
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
        <li class="active"><a href="">Carousel</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <!-- Example Carousel Block -->
    <div class="block block-themed">
        <!-- Example Carousel Title -->
        <div class="block-title">
            <h4>Carousel <small>With animation and indicators aligned right</small></h4>
        </div>
        <!-- END Example Carousel Title -->

        <!-- Example Carousel Content -->
        <div class="block-content">
            <!-- div.row-fluid -->
            <div class="row-fluid">
                <!-- div.span8.offset2 -->
                <div class="span8 offset2">
                    <!-- Carousel -->
                    <div id="example-carousel" class="carousel slide">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#example-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#example-carousel" data-slide-to="1"></li>
                            <li data-target="#example-carousel" data-slide-to="2"></li>
                            <li data-target="#example-carousel" data-slide-to="3"></li>
                            <li data-target="#example-carousel" data-slide-to="4"></li>
                            <li data-target="#example-carousel" data-slide-to="5"></li>
                        </ol>
                        <!-- END Indicators -->

                        <!-- Carousel items -->
                        <div class="carousel-inner">
                            <div class="active item">
                                <img src="img/placeholders/image_1680x1050_dark.png" alt="fakeimg">
                                <div class="carousel-caption">
                                    <h4>Caption</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida.</p>
                                </div>
                            </div>
                            <div class="item">
                                <img src="img/placeholders/image_1680x1050_light.png" alt="fakeimg">
                                <div class="carousel-caption">
                                    <h4>Caption</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida.</p>
                                </div>
                            </div>
                            <div class="item">
                                <img src="img/placeholders/image_1680x1050_dark.png" alt="fakeimg">
                                <div class="carousel-caption">
                                    <h4>Caption</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida.</p>
                                </div>
                            </div>
                            <div class="item">
                                <img src="img/placeholders/image_1680x1050_light.png" alt="fakeimg">
                                <div class="carousel-caption">
                                    <h4>Caption</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida.</p>
                                </div>
                            </div>
                            <div class="item">
                                <img src="img/placeholders/image_1680x1050_dark.png" alt="fakeimg">
                                <div class="carousel-caption">
                                    <h4>Caption</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida.</p>
                                </div>
                            </div>
                            <div class="item">
                                <img src="img/placeholders/image_1680x1050_light.png" alt="fakeimg">
                                <div class="carousel-caption">
                                    <h4>Caption</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida.</p>
                                </div>
                            </div>
                        </div>
                        <!-- END Carousel items -->

                        <!-- Carousel nav -->
                        <a class="carousel-control left" href="#example-carousel" data-slide="prev"><i class="icon-chevron-left"></i></a>
                        <a class="carousel-control right" href="#example-carousel" data-slide="next"><i class="icon-chevron-right"></i></a>
                        <!-- END Carousel nav -->
                    </div>
                    <!-- END Carousel -->
                </div>
                <!-- END div.span8.offset2 -->
            </div>
            <!-- END div.row-fluid -->
        </div>
        <!-- END Example Carousel Content -->
    </div>
    <!-- END Example Carousel Block -->

    <!-- Example 2 Carousel Block -->
    <div class="block block-themed block-last">
        <!-- Example 2 Carousel Title -->
        <div class="block-title">
            <h4>Carousel <small>No animation, no captions, indicators aligned left and different arrow controls</small></h4>
        </div>
        <!-- END Example 2 Carousel Title -->

        <!-- Example 2 Carousel Content -->
        <div class="block-content">
            <!-- div.row-fluid -->
            <div class="row-fluid">
                <!-- div.span8.offset2 -->
                <div class="span8 offset2">
                    <!-- Carousel -->
                    <div id="example-carousel2" class="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators left">
                            <li data-target="#example-carousel2" data-slide-to="0" class="active"></li>
                            <li data-target="#example-carousel2" data-slide-to="1"></li>
                            <li data-target="#example-carousel2" data-slide-to="2"></li>
                            <li data-target="#example-carousel2" data-slide-to="3"></li>
                            <li data-target="#example-carousel2" data-slide-to="4"></li>
                            <li data-target="#example-carousel2" data-slide-to="5"></li>
                        </ol>
                        <!-- END Indicators -->

                        <!-- Carousel items -->
                        <div class="carousel-inner">
                            <div class="active item">
                                <img src="img/placeholders/image_1680x1050_dark.png" alt="fakeimg">
                            </div>
                            <div class="item">
                                <img src="img/placeholders/image_1680x1050_light.png" alt="fakeimg">
                            </div>
                            <div class="item">
                                <img src="img/placeholders/image_1680x1050_dark.png" alt="fakeimg">
                            </div>
                            <div class="item">
                                <img src="img/placeholders/image_1680x1050_light.png" alt="fakeimg">
                            </div>
                            <div class="item">
                                <img src="img/placeholders/image_1680x1050_dark.png" alt="fakeimg">
                            </div>
                            <div class="item">
                                <img src="img/placeholders/image_1680x1050_light.png" alt="fakeimg">
                            </div>
                        </div>
                        <!-- END Carousel items -->

                        <!-- Carousel nav -->
                        <a class="carousel-control left" href="#example-carousel2" data-slide="prev"><i class="icon-angle-left"></i></a>
                        <a class="carousel-control right" href="#example-carousel2" data-slide="next"><i class="icon-angle-right"></i></a>
                        <!-- END Carousel nav -->
                    </div>
                    <!-- END Carousel -->
                </div>
                <!-- END div.span8.offset2 -->
            </div>
            <!-- END div.row-fluid -->
        </div>
        <!-- END Example 2 Carousel Content -->
    </div>
    <!-- END Example 2 Carousel Block -->
</div>
<!-- END Page Content -->

<?php include 'inc/footer.php'; // Footer and scripts ?>

<?php include 'inc/bottom.php'; // Close body and html tags ?>