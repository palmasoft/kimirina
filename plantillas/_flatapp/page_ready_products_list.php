<?php include 'inc/config.php';   // Configuration php file ?>
<?php include 'inc/top.php';      // Meta data and header   ?>
<?php include 'inc/side.php';      // Navigation content     ?>

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-shopping_bag themed-color"></i>Products List<br><small>List your products for your eShop!</small></h1>
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
        <li class="active"><a href="">Products List</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <!-- Products List Block -->
    <div class="block block-themed block-last">
        <!-- Products List Title -->
        <div class="block-title">
            <div class="block-options">
                <div class="btn-group">
                    <a class="btn dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">Order By <i class="icon-angle-down"></i></a>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="javascript:void(0)">Price (Low to High)</a></li>
                        <li><a href="javascript:void(0)">Price (High to Low)</a></li>
                        <li><a href="javascript:void(0)">Newest</a></li>
                        <li class="divider"></li>
                        <li><a href="javascript:void(0)">Best Sellers</a></li>
                    </ul>
                </div>
                <div class="btn-group">
                    <a class="btn dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">10 <i class="icon-angle-down"></i></a>
                    <ul class="dropdown-menu pull-right text-center">
                        <li><a href="javascript:void(0)">20</a></li>
                        <li><a href="javascript:void(0)">30</a></li>
                        <li><a href="javascript:void(0)">40</a></li>
                        <li class="divider"></li>
                        <li><a href="javascript:void(0)">All Products</a></li>
                    </ul>
                </div>
            </div>
            <h4><i class="icon-asterisk"></i> Showing 10 out of 50 Products</h4>
        </div>
        <!-- END Products List Title -->

        <!-- Products List Content -->
        <div class="block-content">
            <div class="row-fluid row-items">
                <div class="span3">
                    <!-- Categories Menu Block -->
                    <div class="block">
                        <!-- Categories Menu Title -->
                        <div class="block-title">
                            <h4>Categories Menu</h4>
                        </div>
                        <!-- END Categories Menu Title -->

                        <!-- Categories Menu Content -->
                        <div class="block-content full">
                            <ul class="nav nav-pills nav-stacked remove-margin">
                                <li class="active"><a href="javascript:void(0)">Category #1</a></li>
                                <li><a href="javascript:void(0)">Category #2</a></li>
                                <li><a href="javascript:void(0)">Category #3</a></li>
                                <li><a href="javascript:void(0)">Category #4</a></li>
                                <li><a href="javascript:void(0)">Category #5</a></li>
                                <li><a href="javascript:void(0)">Category #6</a></li>
                            </ul>
                        </div>
                        <!-- END Categories Menu Content -->
                    </div>
                    <!-- END Categories Menu Block -->

                    <!-- Filters #1 Block -->
                    <div class="block">
                        <!-- Filters #1 Title -->
                        <div class="block-title">
                            <h4>Filters #1</h4>
                        </div>
                        <!-- END Filters #1 Title -->

                        <!-- Filters #1 Content -->
                        <div class="block-content full">
                            <label for="filter1">
                                <input type="checkbox" id="filter1" name="filter1" class="input-themed">
                                Filter #1
                            </label>
                            <label for="filter2" class="remove-margin">
                                <input type="checkbox" id="filter2" name="filter2" class="input-themed">
                                Filter #2
                            </label>
                        </div>
                        <!-- END Filters #1 Content -->
                    </div>
                    <!-- END Filters #1 Block -->

                    <!-- Filters #2 Block -->
                    <div class="block">
                        <!-- Filters #2 Title -->
                        <div class="block-title">
                            <h4>Filters #2</h4>
                        </div>
                        <!-- END Filters #2 Title -->

                        <!-- Filters #2 Content -->
                        <div class="block-content full">
                            <label for="filter3">
                                <input type="checkbox" id="filter3" name="filter3" class="input-themed">
                                Filter #3
                            </label>
                            <label for="filter4" class="remove-margin">
                                <input type="checkbox" id="filter4" name="filter4" class="input-themed">
                                Filter #4
                            </label>
                        </div>
                        <!-- END Filters #2 Content -->
                    </div>
                    <!-- END Filters #2 Block -->

                    <!-- Filters #3 Block -->
                    <div class="block">
                        <!-- Filters #3 Title -->
                        <div class="block-title">
                            <h4>Filters #3</h4>
                        </div>
                        <!-- END Filters #3 Title -->

                        <!-- Filters #3 Content -->
                        <div class="block-content full">
                            <label for="filter5">
                                <input type="checkbox" id="filter5" name="filter5" class="input-themed">
                                Filter #5
                            </label>
                            <label for="filter6">
                                <input type="checkbox" id="filter6" name="filter6" class="input-themed">
                                Filter #6
                            </label>
                            <label for="filter7">
                                <input type="checkbox" id="filter7" name="filter7" class="input-themed">
                                Filter #7
                            </label>
                            <label for="filter8" class="remove-margin">
                                <input type="checkbox" id="filter8" name="filter8" class="input-themed">
                                Filter #8
                            </label>
                        </div>
                        <!-- END Filters #3 Content -->
                    </div>
                    <!-- END Filters #3 Block -->
                </div>

                <div class="span9">
                    <?php $j=1; for($i=0; $i<10; $i++) { ?>
                    <div class="media media-hover">
                        <a href="javascript:void(0)" class="pull-left">
                            <img src="img/placeholders/image_160x120_dark.png" class="media-object img-rounded" alt="Image">
                        </a>
                        <div class="media-body">
                            <div class="pull-right">
                                <h4 class="sub-header text-black text-right">$ <?php echo rand(1, 2500); ?>,00</h4>
                                <a href="page_ready_shopping_cart.php" class="btn btn-warning"><i class="icon-shopping-cart"></i> Add to cart</a>
                                <a href="javascript:void(0)" class="btn btn-success">Buy now</a>
                            </div>
                            <h4 class="media-heading"><a href="page_ready_product.php">Product #<?php echo $j++; ?></a> <small><?php echo rand(2011, 2013); ?> Edition</small></h4>
                            <p>Donec lacinia venenatis metus at bibendum.. In hac habitasse platea dictumst..<br><strong><?php echo rand(1, 5); ?>  years warranty</strong></p>
                            <p>Available: <strong><?php echo rand(1, 100); ?></strong></p>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="pagination pagination-centered">
                        <ul>
                            <li class="disabled"><a href="javascript:void(0)">Prev</a></li>
                            <li class="active"><a href="javascript:void(0)">1</a></li>
                            <li><a href="javascript:void(0)">2</a></li>
                            <li><a href="javascript:void(0)">3</a></li>
                            <li><a href="javascript:void(0)">4</a></li>
                            <li><a href="javascript:void(0)">5</a></li>
                            <li><a href="javascript:void(0)">Next</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Products List Content -->
    </div>
    <!-- END Products List Block -->
</div>
<!-- END Page Content -->

<?php include 'inc/footer.php'; // Footer and scripts ?>

<?php include 'inc/bottom.php'; // Close body and html tags ?>