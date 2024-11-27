<?php include 'inc/config.php';   // Configuration php file ?>
<?php include 'inc/top.php';      // Meta data and header   ?>
<?php include 'inc/side.php';      // Navigation content     ?>

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-camera_small themed-color"></i>Ultimate Product<br><small>2013 Edition! (4 Reviews)</small></h1>
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
        <li class="active"><a href="">Product</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <!-- Product Info -->
    <div class="row-fluid row-items">
        <!-- Images -->
        <div class="span4 gallery" data-toggle="lightbox-gallery">
            <img src="img/placeholders/image_720x450_dark.png" alt="Product Image" class="push">
            <div class="row-fluid">
                <div class="span3">
                    <a href="img/placeholders/image_720x450_dark.png" class="gallery-link">
                        <img src="img/placeholders/image_720x450_dark.png" alt="image">
                    </a>
                </div>
                <div class="span3">
                    <a href="img/placeholders/image_720x450_light.png" class="gallery-link">
                        <img src="img/placeholders/image_720x450_light.png" alt="image">
                    </a>
                </div>
                <div class="span3">
                    <a href="img/placeholders/image_720x450_dark.png" class="gallery-link">
                        <img src="img/placeholders/image_720x450_dark.png" alt="image">
                    </a>
                </div>
                <div class="span3">
                    <a href="img/placeholders/image_720x450_light.png" class="gallery-link">
                        <img src="img/placeholders/image_720x450_light.png" alt="image">
                    </a>
                </div>
            </div>
        </div>
        <!-- END Images -->

        <!-- Basic Product Info -->
        <div class="span5">
            <h4 class="sub-header">Basic Product Info</h4>
            <p>
                <span class="label label-success"><i class="icon-ok"></i> In stock</span>
                <span class="label label-inverse"><i class="icon-asterisk"></i> 15 Available</span>
                <span class="label label-info"><i class="icon-truck"></i> FREE Shipping</span>
            </p>
            <p>Donec lacinia venenatis metus at bibendum? In hac habitasse platea dictumst. Proin ac nibh rutrum lectus rhoncus eleifend. Sed porttitor pretium venenatis. Suspendisse potenti. Aliquam quis ligula elit. Aliquam at orci ac neque semper dictum. Sed tincidunt scelerisque ligula, et facilisis nulla hendrerit non.</p>
            <p>Donec lacinia venenatis metus at bibendum? In hac habitasse platea dictumst. Proin ac nibh rutrum lectus rhoncus eleifend.</p>
        </div>
        <!-- END Basic Product Info -->

        <!-- Extra -->
        <div class="span3 text-center">
            <h4 class="sub-header">$ 1260,00</h4>
            <h4>
                <i class="icon-star themed-color-sun"></i>
                <i class="icon-star themed-color-sun"></i>
                <i class="icon-star themed-color-sun"></i>
                <i class="icon-star themed-color-sun"></i>
                <i class="icon-star-empty themed-color-sun"></i><br>
                <small><em>Based on 4 Reviews</em></small>
            </h4>
            <a href="javascript:void(0)" class="btn btn-large btn-success btn-block"><i class="icon-check"></i> Buy Now</a>
            <a href="javascript:void(0)" class="btn btn-large btn-success btn-block"><i class="icon-gift"></i> Buy as a Gift</a>
            <a href="javascript:void(0)" class="btn btn-large btn-warning btn-block"><i class="icon-shopping-cart"></i> Add to Cart</a>
            <a href="javascript:void(0)" class="btn btn-large btn-inverse btn-block"><i class="icon-bookmark-empty"></i> Add to Wishlist</a>
        </div>
        <!-- END Extra -->
    </div>
    <!-- END Product Info -->

    <!-- Description, Features and Reviews -->
    <div class="block-tabs block-themed">
        <!-- Tab Links -->
        <ul class="nav nav-tabs" data-toggle="tabs">
            <li class="active"><a href="#product-tabs-desc"><i class="icon-info-sign"></i> Description</a></li>
            <li><a href="#product-tabs-features"><i class="icon-magic"></i> Features</a></li>
            <li><a href="#product-tabs-reviews"><i class="icon-pencil"></i> Reviews</a></li>
        </ul>
        <!-- END Tab Links -->

        <!-- Tabs Content -->
        <div class="tab-content">
            <!-- Description -->
            <div class="tab-pane active" id="product-tabs-desc">
                <p class="content-text">
                    <a href="img/placeholders/image_120x120_dark.png" class="pull-left" data-toggle="lightbox-image">
                        <img src="img/placeholders/image_120x120_dark.png" alt="image">
                    </a>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida, urna ligula hendrerit nibh, ac cursus nibh sapien in purus. Mauris tincidunt tincidunt turpis in porta. Integer fermentum tincidunt auctor. Vestibulum ullamcorper, odio sed rhoncus imperdiet, enim elit sollicitudin orci, eget dictum leo mi nec lectus. Nam commodo turpis id lectus scelerisque vulputate. Integer sed dolor erat. Fusce erat ipsum, varius vel euismod sed, tristique et lectus? Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque? Proin rhoncus dui at ligula vestibulum ut facilisis ante sodales! Suspendisse potenti. Aliquam tincidunt sollicitudin sem nec ultrices. Sed at mi velit. Ut egestas tempor est, in cursus enim venenatis eget! Nulla quis ligula ipsum. Donec vitae ultrices dolor?
                </p>
                <h5><em>A small list..</em></h5>
                <ul class="icons-ul list push">
                    <li><i class="icon-li icon-ok text-success"></i> Feature #1 with some info</li>
                    <li><i class="icon-li icon-ok text-success"></i> Feature #2 with some info</li>
                    <li><i class="icon-li icon-ok text-success"></i> Feature #3 with some info</li>
                </ul>
                <p class="content-text">
                    <a href="img/placeholders/image_120x120_dark.png" class="pull-right" data-toggle="lightbox-image">
                        <img src="img/placeholders/image_120x120_dark.png" alt="image">
                    </a>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida, urna ligula hendrerit nibh, ac cursus nibh sapien in purus. Mauris tincidunt tincidunt turpis in porta. Integer fermentum tincidunt auctor. Vestibulum ullamcorper, odio sed rhoncus imperdiet, enim elit sollicitudin orci, eget dictum leo mi nec lectus. Nam commodo turpis id lectus scelerisque vulputate. Integer sed dolor erat. Fusce erat ipsum, varius vel euismod sed, tristique et lectus? Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque? Proin rhoncus dui at ligula vestibulum ut facilisis ante sodales! Suspendisse potenti. Aliquam tincidunt sollicitudin sem nec ultrices. Sed at mi velit. Ut egestas tempor est, in cursus enim venenatis eget! Nulla quis ligula ipsum. Donec vitae ultrices dolor?
                </p>
                <p>Donec lacinia venenatis metus at bibendum? In hac habitasse platea dictumst. Proin ac nibh rutrum lectus rhoncus eleifend. Sed porttitor pretium venenatis. Suspendisse potenti. Aliquam quis ligula elit. Aliquam at orci ac neque semper dictum. Sed tincidunt scelerisque ligula, et facilisis nulla hendrerit non. Suspendisse potenti.</p>
            </div>
            <!-- END Description -->

            <!-- Features -->
            <div class="tab-pane" id="product-tabs-features">
                <h4 class="sub-header">Category #1</h4>
                <table class="table table-hover table-striped">
                    <tbody>
                        <tr>
                            <td class="span3"><strong>Feature #1</strong></td>
                            <td><em>Feature Details</em></td>
                        </tr>
                        <tr>
                            <td class="span3"><strong>Feature #2</strong></td>
                            <td><em>Feature Details</em></td>
                        </tr>
                        <tr>
                            <td class="span3"><strong>Feature #3</strong></td>
                            <td><em>Feature Details</em></td>
                        </tr>
                        <tr>
                            <td class="span3"><strong>Feature #4</strong></td>
                            <td><em>Feature Details</em></td>
                        </tr>
                        <tr>
                            <td class="span3"><strong>Feature #5</strong></td>
                            <td><em>Feature Details</em></td>
                        </tr>
                    </tbody>
                </table>
                <h4 class="sub-header">Category #2</h4>
                <table class="table table-hover table-striped">
                    <tbody>
                        <tr>
                            <td class="span3"><strong>Feature #1</strong></td>
                            <td><em>Feature Details</em></td>
                        </tr>
                        <tr>
                            <td class="span3"><strong>Feature #2</strong></td>
                            <td><em>Feature Details</em></td>
                        </tr>
                        <tr>
                            <td class="span3"><strong>Feature #3</strong></td>
                            <td><em>Feature Details</em></td>
                        </tr>
                        <tr>
                            <td class="span3"><strong>Feature #4</strong></td>
                            <td><em>Feature Details</em></td>
                        </tr>
                        <tr>
                            <td class="span3"><strong>Feature #5</strong></td>
                            <td><em>Feature Details</em></td>
                        </tr>
                    </tbody>
                </table>
                <h4 class="sub-header">Category #3</h4>
                <table class="table table-hover table-striped remove-margin">
                    <tbody>
                        <tr>
                            <td class="span3"><strong>Feature #1</strong></td>
                            <td><em>Feature Details</em></td>
                        </tr>
                        <tr>
                            <td class="span3"><strong>Feature #2</strong></td>
                            <td><em>Feature Details</em></td>
                        </tr>
                        <tr>
                            <td class="span3"><strong>Feature #3</strong></td>
                            <td><em>Feature Details</em></td>
                        </tr>
                        <tr>
                            <td class="span3"><strong>Feature #4</strong></td>
                            <td><em>Feature Details</em></td>
                        </tr>
                        <tr>
                            <td class="span3"><strong>Feature #5</strong></td>
                            <td><em>Feature Details</em></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- END Features -->

            <!-- Reviews -->
            <div class="tab-pane" id="product-tabs-reviews">
                <!-- First Review -->
                <div class="media media-hover">
                    <a href="javascript:void(0)" class="pull-left">
                        <img src="img/placeholders/image_64x64_dark.png" class="media-object img-circle" alt="Image">
                    </a>
                    <div class="media-body">
                        <h5 class="media-heading">
                            <span class="label label-success">
                                <i class="icon-star"></i>
                                <i class="icon-star"></i>
                                <i class="icon-star"></i>
                                <i class="icon-star"></i>
                                <i class="icon-star-empty"></i>
                            </span>
                            <a class="badge badge-success" data-toggle="tooltip" title="This review helped me!"><i class="icon-thumbs-up"></i> 9</a>
                            <a class="badge badge-important" data-toggle="tooltip" title="This review didn't help me!"><i class="icon-thumbs-down"></i> 1</a>
                            <a href="javascript:void(0)">Username1</a>
                            <small>on <span class="label label-inverse">July 26, 2013</span></small>
                        </h5>
                        <p><strong>Good:</strong> First, Second, Third etc</p>
                        <p><strong>Bad:</strong> First, Second, Third etc</p>
                        <p><strong>Comments:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida, urna ligula hendrerit nibh, ac cursus nibh sapien in purus. Donec lacinia venenatis metus at bibendum? In hac habitasse platea dictumst. Proin ac nibh rutrum lectus rhoncus eleifend. Sed porttitor pretium venenatis. Suspendisse potenti. Aliquam quis ligula elit. Aliquam at orci ac neque semper dictum. Sed tincidunt scelerisque ligula, et facilisis nulla hendrerit non. Suspendisse potenti. Pellentesque non accumsan orci. Praesent at lacinia dolor. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
                <!-- END First Review -->

                <!-- Second Review -->
                <div class="media media-hover">
                    <a href="javascript:void(0)" class="pull-left">
                        <img src="img/placeholders/image_64x64_dark.png" class="media-object img-circle" alt="Image">
                    </a>
                    <div class="media-body">
                        <h5 class="media-heading">
                            <span class="label label-warning">
                                <i class="icon-star"></i>
                                <i class="icon-star"></i>
                                <i class="icon-star"></i>
                                <i class="icon-star-empty"></i>
                                <i class="icon-star-empty"></i>
                            </span>
                            <a class="badge badge-success" data-toggle="tooltip" title="This review helped me!"><i class="icon-thumbs-up"></i> 5</a>
                            <a class="badge badge-important" data-toggle="tooltip" title="This review didn't help me!"><i class="icon-thumbs-down"></i> 4</a>
                            <a href="javascript:void(0)">Username2</a>
                            <small>on <span class="label label-inverse">July 25, 2013</span></small>
                        </h5>
                        <p><strong>Good:</strong> First, Second, Third etc</p>
                        <p><strong>Bad:</strong> First, Second, Third etc</p>
                        <p><strong>Comments:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida, urna ligula hendrerit nibh, ac cursus nibh sapien in purus. Donec lacinia venenatis metus at bibendum? In hac habitasse platea dictumst. Proin ac nibh rutrum lectus rhoncus eleifend. Sed porttitor pretium venenatis. Suspendisse potenti. Aliquam quis ligula elit. Aliquam at orci ac neque semper dictum. Sed tincidunt scelerisque ligula, et facilisis nulla hendrerit non. Suspendisse potenti. Pellentesque non accumsan orci. Praesent at lacinia dolor. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
                <!-- END Second Review -->

                <!-- Third Review -->
                <div class="media media-hover">
                    <a href="javascript:void(0)" class="pull-left">
                        <img src="img/placeholders/image_64x64_dark.png" class="media-object img-circle" alt="Image">
                    </a>
                    <div class="media-body">
                        <h5 class="media-heading">
                            <span class="label label-success">
                                <i class="icon-star"></i>
                                <i class="icon-star"></i>
                                <i class="icon-star"></i>
                                <i class="icon-star"></i>
                                <i class="icon-star"></i>
                            </span>
                            <a class="badge badge-success" data-toggle="tooltip" title="This review helped me!"><i class="icon-thumbs-up"></i> 3</a>
                            <a class="badge badge-important" data-toggle="tooltip" title="This review didn't help me!"><i class="icon-thumbs-down"></i> 0</a>
                            <a href="javascript:void(0)">Username3</a>
                            <small>on <span class="label label-inverse">July 16, 2013</span></small>
                        </h5>
                        <p><strong>Good:</strong> First, Second, Third etc</p>
                        <p><strong>Bad:</strong> First, Second, Third etc</p>
                        <p><strong>Comments:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida, urna ligula hendrerit nibh, ac cursus nibh sapien in purus. Donec lacinia venenatis metus at bibendum? In hac habitasse platea dictumst. Proin ac nibh rutrum lectus rhoncus eleifend. Sed porttitor pretium venenatis. Suspendisse potenti. Aliquam quis ligula elit. Aliquam at orci ac neque semper dictum. Sed tincidunt scelerisque ligula, et facilisis nulla hendrerit non. Suspendisse potenti. Pellentesque non accumsan orci. Praesent at lacinia dolor. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
                <!-- END Third Review -->

                <!-- Fourth Review -->
                <div class="media media-hover">
                    <a href="javascript:void(0)" class="pull-left">
                        <img src="img/placeholders/image_64x64_dark.png" class="media-object img-circle" alt="Image">
                    </a>
                    <div class="media-body">
                        <h5 class="media-heading">
                            <span class="label label-important">
                                <i class="icon-star"></i>
                                <i class="icon-star"></i>
                                <i class="icon-star-empty"></i>
                                <i class="icon-star-empty"></i>
                                <i class="icon-star-empty"></i>
                            </span>
                            <a class="badge badge-success" data-toggle="tooltip" title="This review helped me!"><i class="icon-thumbs-up"></i> 3</a>
                            <a class="badge badge-important" data-toggle="tooltip" title="This review didn't help me!"><i class="icon-thumbs-down"></i> 0</a>
                            <a href="javascript:void(0)">Username4</a>
                            <small>on <span class="label label-inverse">July 5, 2013</span></small>
                        </h5>
                        <p><strong>Good:</strong> First, Second, Third etc</p>
                        <p><strong>Bad:</strong> First, Second, Third etc</p>
                        <p><strong>Comments:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida, urna ligula hendrerit nibh, ac cursus nibh sapien in purus. Donec lacinia venenatis metus at bibendum? In hac habitasse platea dictumst. Proin ac nibh rutrum lectus rhoncus eleifend. Sed porttitor pretium venenatis. Suspendisse potenti. Aliquam quis ligula elit. Aliquam at orci ac neque semper dictum. Sed tincidunt scelerisque ligula, et facilisis nulla hendrerit non. Suspendisse potenti. Pellentesque non accumsan orci. Praesent at lacinia dolor. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
                <!-- END Fourth Review -->
            </div>
            <!-- END Reviews -->
        </div>
        <!-- END Tabs Content -->
    </div>
    <!-- END Description, Features and Reviews -->
</div>
<!-- END Page Content -->

<?php include 'inc/footer.php'; // Footer and scripts ?>

<?php include 'inc/bottom.php'; // Close body and html tags ?>