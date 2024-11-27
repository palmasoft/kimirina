<?php include 'inc/config.php';   // Configuration php file ?>
<?php include 'inc/top.php';      // Meta data and header   ?>
<?php include 'inc/side.php';      // Navigation content     ?>

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-picture themed-color"></i>Gallery<br><small>Lighboxes, hover options &amp; various layouts!</small></h1>
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
        <li class="active"><a href="">Gallery</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <!-- Individual Images Block -->
    <div class="block block-themed">
        <!-- Individual Images Title -->
        <div class="block-title">
            <h4><i class="icon-picture"></i> Lightbox in individual images</h4>
        </div>
        <!-- END Individual Images Title -->

        <!-- Individual Images Content -->
        <div class="block-content">
            <div class="row-fluid row-items">
                <div class="span3 offset3">
                    <!-- Just a link with the href of the large image and a data-toggle attribute with the value lightbox-image -->
                    <a href="img/placeholders/image_720x450_light.png" data-toggle="lightbox-image">
                        <img src="img/placeholders/image_720x450_light.png" alt="image">
                    </a>
                </div>
                <div class="span3">
                    <a href="img/placeholders/image_720x450_light.png" data-toggle="lightbox-image">
                        <img src="img/placeholders/image_720x450_light.png" alt="image">
                    </a>
                </div>
            </div>
        </div>
        <!-- END Individual Images Content -->
    </div>
    <!-- END Individual Images Block -->

    <!-- Simple Gallery Block -->
    <div class="block block-themed">
        <!-- Simple Gallery Title -->
        <div class="block-title">
            <h4><i class="icon-camera-retro"></i> Simple Gallery with lightbox enabled</h4>
        </div>
        <!-- END Simple Gallery Title -->

        <!-- Simple Gallery Content -->
        <div class="block-content">
            <!--
            Just create a div with the class .gallery. Inside put the images any way you like in a fluid grid.
            If you would like to enable the lightbox, just add the value lightbox-gallery in the attribute data-toggle of the div. If you do that
            make sure that you put your images inside links with the class .gallery-link and the href of your large image!
            -->
            <div class="gallery" data-toggle="lightbox-gallery">
                <div class="row-fluid row-items">
                    <div class="span3">
                        <a href="img/placeholders/image_720x450_light.png" class="gallery-link">
                            <img src="img/placeholders/image_720x450_light.png" alt="image">
                        </a>
                    </div>
                    <div class="span3">
                        <a href="img/placeholders/image_720x450_light.png" class="gallery-link">
                            <img src="img/placeholders/image_720x450_light.png" alt="image">
                        </a>
                    </div>
                    <div class="span3">
                        <a href="img/placeholders/image_720x450_light.png" class="gallery-link">
                            <img src="img/placeholders/image_720x450_light.png" alt="image">
                        </a>
                    </div>
                    <div class="span3">
                        <a href="img/placeholders/image_720x450_light.png" class="gallery-link">
                            <img src="img/placeholders/image_720x450_light.png" alt="image">
                        </a>
                    </div>
                </div>
                <div class="row-fluid row-items">
                    <div class="span3">
                        <a href="img/placeholders/image_720x450_light.png" class="gallery-link">
                            <img src="img/placeholders/image_720x450_light.png" alt="image">
                        </a>
                    </div>
                    <div class="span3">
                        <a href="img/placeholders/image_720x450_light.png" class="gallery-link">
                            <img src="img/placeholders/image_720x450_light.png" alt="image">
                        </a>
                    </div>
                    <div class="span3">
                        <a href="img/placeholders/image_720x450_light.png" class="gallery-link">
                            <img src="img/placeholders/image_720x450_light.png" alt="image">
                        </a>
                    </div>
                    <div class="span3">
                        <a href="img/placeholders/image_720x450_light.png" class="gallery-link">
                            <img src="img/placeholders/image_720x450_light.png" alt="image">
                        </a>
                    </div>
                </div>
                <div class="row-fluid row-items">
                    <div class="span3">
                        <a href="img/placeholders/image_720x450_light.png" class="gallery-link">
                            <img src="img/placeholders/image_720x450_light.png" alt="image">
                        </a>
                    </div>
                    <div class="span3">
                        <a href="img/placeholders/image_720x450_light.png" class="gallery-link">
                            <img src="img/placeholders/image_720x450_light.png" alt="image">
                        </a>
                    </div>
                    <div class="span3">
                        <a href="img/placeholders/image_720x450_light.png" class="gallery-link">
                            <img src="img/placeholders/image_720x450_light.png" alt="image">
                        </a>
                    </div>
                    <div class="span3">
                        <a href="img/placeholders/image_720x450_light.png" class="gallery-link">
                            <img src="img/placeholders/image_720x450_light.png" alt="image">
                        </a>
                    </div>
                </div>
            </div>
            <div class="pagination pagination-centered pagination-large">
                <ul>
                    <li><a href="javascript:void(0)"><i class="icon-chevron-left"></i></a></li>
                    <li><a href="javascript:void(0)">1</a></li>
                    <li><a href="javascript:void(0)">2</a></li>
                    <li><a href="javascript:void(0)">3</a></li>
                    <li><a href="javascript:void(0)"><i class="icon-chevron-right"></i></a></li>
                </ul>
            </div>
        </div>
        <!-- END Simple Gallery Content -->
    </div>
    <!-- END Simple Gallery Block -->

    <!-- Gallery With Options Block -->
    <div class="block block-themed">
        <!-- Gallery With Options Title -->
        <div class="block-title">
            <h4><i class="icon-camera"></i> Gallery with options and lightbox enabled</h4>
        </div>
        <!-- END Gallery With Options Title -->

        <!-- Gallery With Options Content -->
        <div class="block-content">
            <!--
            For enabling gallery options just add the class .gallery-image to each div and inside add your image and your
            desirable option links inside a div with the class .gallery-image-options. As before, add the class .gallery-link
            to the link you want to open in the lightbox. As simple as that :-)
            -->
            <div class="gallery" data-toggle="lightbox-gallery">
                <div class="row-fluid row-items">
                    <div class="span3 gallery-image">
                        <img src="img/placeholders/image_720x450_light.png" alt="image">
                        <div class="gallery-image-options">
                            <a href="img/placeholders/image_720x450_light.png" class="gallery-link badge badge-inverse"><i class="icon-search"></i></a>
                            <a href="javascript:void(0)" class="badge badge-success"><i class="icon-pencil"></i></a>
                            <a href="javascript:void(0)" class="badge badge-important"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="span3 gallery-image">
                        <img src="img/placeholders/image_720x450_light.png" alt="image">
                        <div class="gallery-image-options">
                            <a href="img/placeholders/image_720x450_light.png" class="gallery-link badge badge-inverse"><i class="icon-search"></i></a>
                            <a href="javascript:void(0)" class="badge badge-success"><i class="icon-pencil"></i></a>
                            <a href="javascript:void(0)" class="badge badge-important"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="span3 gallery-image">
                        <img src="img/placeholders/image_720x450_light.png" alt="image">
                        <div class="gallery-image-options">
                            <a href="img/placeholders/image_720x450_light.png" class="gallery-link badge badge-inverse"><i class="icon-search"></i></a>
                            <a href="javascript:void(0)" class="badge badge-success"><i class="icon-pencil"></i></a>
                            <a href="javascript:void(0)" class="badge badge-important"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="span3 gallery-image">
                        <img src="img/placeholders/image_720x450_light.png" alt="image">
                        <div class="gallery-image-options">
                            <a href="img/placeholders/image_720x450_light.png" class="gallery-link badge badge-inverse"><i class="icon-search"></i></a>
                            <a href="javascript:void(0)" class="badge badge-success"><i class="icon-pencil"></i></a>
                            <a href="javascript:void(0)" class="badge badge-important"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row-fluid row-items">
                    <div class="span3 gallery-image">
                        <img src="img/placeholders/image_720x450_light.png" alt="image">
                        <div class="gallery-image-options">
                            <a href="img/placeholders/image_720x450_light.png" class="gallery-link badge badge-inverse"><i class="icon-search"></i></a>
                            <a href="javascript:void(0)" class="badge badge-success"><i class="icon-pencil"></i></a>
                            <a href="javascript:void(0)" class="badge badge-important"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="span3 gallery-image">
                        <img src="img/placeholders/image_720x450_light.png" alt="image">
                        <div class="gallery-image-options">
                            <a href="img/placeholders/image_720x450_light.png" class="gallery-link badge badge-inverse"><i class="icon-search"></i></a>
                            <a href="javascript:void(0)" class="badge badge-success"><i class="icon-pencil"></i></a>
                            <a href="javascript:void(0)" class="badge badge-important"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="span3 gallery-image">
                        <img src="img/placeholders/image_720x450_light.png" alt="image">
                        <div class="gallery-image-options">
                            <a href="img/placeholders/image_720x450_light.png" class="gallery-link badge badge-inverse"><i class="icon-search"></i></a>
                            <a href="javascript:void(0)" class="badge badge-success"><i class="icon-pencil"></i></a>
                            <a href="javascript:void(0)" class="badge badge-important"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="span3 gallery-image">
                        <img src="img/placeholders/image_720x450_light.png" alt="image">
                        <div class="gallery-image-options">
                            <a href="img/placeholders/image_720x450_light.png" class="gallery-link badge badge-inverse"><i class="icon-search"></i></a>
                            <a href="javascript:void(0)" class="badge badge-success"><i class="icon-pencil"></i></a>
                            <a href="javascript:void(0)" class="badge badge-important"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row-fluid row-items">
                    <div class="span3 gallery-image">
                        <img src="img/placeholders/image_720x450_light.png" alt="image">
                        <div class="gallery-image-options">
                            <a href="img/placeholders/image_720x450_light.png" class="gallery-link badge badge-inverse"><i class="icon-search"></i></a>
                            <a href="javascript:void(0)" class="badge badge-success"><i class="icon-pencil"></i></a>
                            <a href="javascript:void(0)" class="badge badge-important"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="span3 gallery-image">
                        <img src="img/placeholders/image_720x450_light.png" alt="image">
                        <div class="gallery-image-options">
                            <a href="img/placeholders/image_720x450_light.png" class="gallery-link badge badge-inverse"><i class="icon-search"></i></a>
                            <a href="javascript:void(0)" class="badge badge-success"><i class="icon-pencil"></i></a>
                            <a href="javascript:void(0)" class="badge badge-important"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="span3 gallery-image">
                        <img src="img/placeholders/image_720x450_light.png" alt="image">
                        <div class="gallery-image-options">
                            <a href="img/placeholders/image_720x450_light.png" class="gallery-link badge badge-inverse"><i class="icon-search"></i></a>
                            <a href="javascript:void(0)" class="badge badge-success"><i class="icon-pencil"></i></a>
                            <a href="javascript:void(0)" class="badge badge-important"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="span3 gallery-image">
                        <img src="img/placeholders/image_720x450_light.png" alt="image">
                        <div class="gallery-image-options">
                            <a href="img/placeholders/image_720x450_light.png" class="gallery-link badge badge-inverse"><i class="icon-search"></i></a>
                            <a href="javascript:void(0)" class="badge badge-success"><i class="icon-pencil"></i></a>
                            <a href="javascript:void(0)" class="badge badge-important"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pagination pagination-centered pagination-large">
                <ul>
                    <li><a href="javascript:void(0)"><i class="icon-chevron-left"></i></a></li>
                    <li><a href="javascript:void(0)">1</a></li>
                    <li><a href="javascript:void(0)">2</a></li>
                    <li><a href="javascript:void(0)">3</a></li>
                    <li><a href="javascript:void(0)"><i class="icon-chevron-right"></i></a></li>
                </ul>
            </div>
        </div>
        <!-- END Gallery With Options Content -->
    </div>
    <!-- END Gallery With Options Block -->

    <!-- Create the Gallery you want Block -->
    <div class="block block-themed block-last">
        <!-- Create the Gallery you want Title -->
        <div class="block-title">
            <h4><i class="icon-camera"></i> Create the Gallery you need! <small>Different grid and options</small></h4>
        </div>
        <!-- END Create the Gallery you want Title -->

        <!-- Create the Gallery you want Content -->
        <div class="block-content">
            <div class="gallery" data-toggle="lightbox-gallery">
                <div class="row-fluid row-items">
                    <div class="span2 gallery-image">
                        <img src="img/placeholders/image_720x450_light.png" alt="image">
                        <div class="gallery-image-options">
                            <a href="img/placeholders/image_720x450_light.png" class="gallery-link badge badge-inverse"><i class="icon-search"></i></a>
                            <a href="javascript:void(0)" class="badge badge-success"><i class="icon-save"></i></a>
                        </div>
                    </div>
                    <div class="span2 gallery-image">
                        <img src="img/placeholders/image_720x450_light.png" alt="image">
                        <div class="gallery-image-options">
                            <a href="img/placeholders/image_720x450_light.png" class="gallery-link badge badge-inverse"><i class="icon-search"></i></a>
                            <a href="javascript:void(0)" class="badge badge-neutral"><i class="icon-star"></i></a>
                        </div>
                    </div>
                    <div class="span2 gallery-image">
                        <img src="img/placeholders/image_720x450_light.png" alt="image">
                        <div class="gallery-image-options">
                            <a href="img/placeholders/image_720x450_light.png" class="gallery-link badge badge-inverse"><i class="icon-search"></i></a>
                            <a href="javascript:void(0)" class="badge badge-info"><i class="icon-cloud-upload"></i></a>
                        </div>
                    </div>
                    <div class="span2 gallery-image">
                        <img src="img/placeholders/image_720x450_light.png" alt="image">
                        <div class="gallery-image-options">
                            <a href="img/placeholders/image_720x450_light.png" class="gallery-link badge badge-inverse"><i class="icon-search"></i></a>
                            <a href="javascript:void(0)" class="badge badge-info"><i class="icon-cloud-download"></i></a>
                        </div>
                    </div>
                    <div class="span2 gallery-image">
                        <img src="img/placeholders/image_720x450_light.png" alt="image">
                        <div class="gallery-image-options">
                            <a href="img/placeholders/image_720x450_light.png" class="gallery-link badge badge-inverse"><i class="icon-search"></i></a>
                            <a href="javascript:void(0)" class="badge badge-neutral"><i class="icon-star"></i></a>
                        </div>
                    </div>
                    <div class="span2 gallery-image">
                        <img src="img/placeholders/image_720x450_light.png" alt="image">
                        <div class="gallery-image-options">
                            <a href="img/placeholders/image_720x450_light.png" class="gallery-link badge badge-inverse"><i class="icon-search"></i></a>
                            <a href="javascript:void(0)" class="badge badge-info"><i class="icon-cloud-upload"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row-fluid row-items">
                    <div class="span4 gallery-image">
                        <img src="img/placeholders/image_720x450_light.png" alt="image">
                        <div class="gallery-image-options">
                            <a href="img/placeholders/image_720x450_light.png" class="gallery-link badge badge-inverse"><i class="icon-search"></i></a>
                            <a href="javascript:void(0)" class="badge badge-success"><i class="icon-save"></i></a>
                            <a href="javascript:void(0)" class="badge badge-info"><i class="icon-cloud-download"></i></a>
                        </div>
                    </div>
                    <div class="span4 gallery-image">
                        <img src="img/placeholders/image_720x450_light.png" alt="image">
                        <div class="gallery-image-options">
                            <a href="img/placeholders/image_720x450_light.png" class="gallery-link badge badge-inverse"><i class="icon-search"></i></a>
                            <a href="javascript:void(0)" class="badge badge-neutral"><i class="icon-star"></i></a>
                        </div>
                    </div>
                    <div class="span4 gallery-image">
                        <img src="img/placeholders/image_720x450_light.png" alt="image">
                        <div class="gallery-image-options">
                            <a href="img/placeholders/image_720x450_light.png" class="gallery-link badge badge-inverse"><i class="icon-search"></i></a>
                            <a href="javascript:void(0)" class="badge badge-info"><i class="icon-cloud-upload"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row-fluid row-items">
                    <div class="span6 gallery-image">
                        <img src="img/placeholders/image_1680x1050_dark.png" alt="image">
                        <div class="gallery-image-options">
                            <a href="img/placeholders/image_1680x1050_dark.png" class="gallery-link badge badge-inverse"><i class="icon-search"></i></a>
                            <a href="javascript:void(0)" class="badge badge-success"><i class="icon-save"></i></a>
                            <a href="javascript:void(0)" class="badge badge-info"><i class="icon-cloud-download"></i></a>
                        </div>
                    </div>
                    <div class="span6 gallery-image">
                        <img src="img/placeholders/image_1680x1050_dark.png" alt="image">
                        <div class="gallery-image-options">
                            <a href="img/placeholders/image_1680x1050_dark.png" class="gallery-link badge badge-inverse"><i class="icon-search"></i></a>
                            <a href="javascript:void(0)" class="badge badge-info"><i class="icon-cloud-upload"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Create the Gallery you want Content -->
    </div>
    <!-- END Create the Gallery you want Block -->
</div>
<!-- END Page Content -->

<?php include 'inc/footer.php'; // Footer and scripts ?>

<?php include 'inc/bottom.php'; // Close body and html tags ?>