<?php include 'inc/config.php';   // Configuration php file ?>
<?php include 'inc/top.php';      // Meta data and header   ?>
<?php include 'inc/side.php';      // Navigation content     ?>

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-shopping_cart themed-color"></i>Shopping Cart<br><small>6 Items!</small></h1>
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
        <li class="active"><a href="">Shopping Cart</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <!-- Top Options -->
    <div class="pull-right">
        <a href="javascript:void(0)" class="btn"><i class="icon-angle-right"></i> Continue Shopping</a>
        <a href="javascript:void(0)" class="btn btn-success"><i class="icon-ok"></i> Checkout</a>
    </div>
    <a href="javascript:void(0)" class="btn btn-info" data-toggle="tooltip" title="Refresh Cart">
        <i class="icon-refresh"></i>
    </a>
    <a href="javascript:void(0)" class="btn btn-danger" data-toggle="tooltip" title="Clear Cart">
        <i class="icon-remove"></i>
    </a>
    <!-- END Top Options -->

    <!-- Table -->
    <table class="table table-borderless table-hover">
        <thead>
            <tr>
                <th class="span1 text-center"><i class="icon-bolt"></i></th>
                <th class="span2 text-center hidden-phone"><i class="icon-picture"></i></th>
                <th><i class="icon-tag"></i> Product</th>
                <th class="span2 hidden-phone">Status</th>
                <th class="span2 hidden-phone text-center">Quantity</th>
                <th class="span2 text-right">Price</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="span1 text-center">
                    <a href="javascript:void(0)" class="badge badge-important" data-toggle="tooltip" title="Remove Product">
                        <i class="icon-remove"></i>
                    </a>
                </td>
                <td class="span2 hidden-phone text-center">
                    <img src="img/placeholders/image_64x64_dark.png" alt="image" class="img-rounded">
                </td>
                <td>
                    <strong>Item Name</strong><br>
                    This is a description<br>
                    <strong>Product ID:</strong> <em>#P621836</em><br>
                    <span class="label label-info"><i class="icon-truck"></i> Delivery</span> <span class="label label-success">FREE</span>
                </td>
                <td class="span2 hidden-phone">
                    <span class="label label-success"><i class="icon-ok"></i> In Stock</span>
                </td>
                <td class="span2 hidden-phone text-center">
                    <input type="text" value="1" class="span1 text-center">
                </td>
                <td class="span2 text-right">
                    <span class="text-black">$ 199,00</span>
                </td>
            </tr>
            <tr>
                <td class="span1 text-center">
                    <a href="javascript:void(0)" class="badge badge-important" data-toggle="tooltip" title="Remove Product">
                        <i class="icon-remove"></i>
                    </a>
                </td>
                <td class="span2 text-center hidden-phone">
                    <img src="img/placeholders/image_64x64_dark.png" alt="image" class="img-rounded">
                </td>
                <td>
                    <strong>Item Name</strong><br>
                    This is a description<br>
                    <strong>Product ID:</strong> <em>#P521655</em><br>
                    <span class="label label-info"><i class="icon-truck"></i> Delivery</span> <span class="label label-inverse">$ 3,00</span>
                </td>
                <td class="span2 hidden-phone">
                    <span class="label label-success"><i class="icon-ok"></i> In Stock</span>
                </td>
                <td class="span2 hidden-phone text-center">
                    <input type="text" value="1" class="span1 text-center">
                </td>
                <td class="span2 text-right">
                    <span class="text-black">$ 39,00</span>
                </td>
            </tr>
            <tr>
                <td class="span1 text-center">
                    <a href="javascript:void(0)" class="badge badge-important" data-toggle="tooltip" title="Remove Product">
                        <i class="icon-remove"></i>
                    </a>
                </td>
                <td class="span2 hidden-phone text-center">
                    <img src="img/placeholders/image_64x64_dark.png" alt="image" class="img-rounded">
                </td>
                <td>
                    <strong>Item Name</strong><br>
                    This is a description<br>
                    <strong>Product ID:</strong> <em>#P932158</em><br>
                    <span class="label label-info"><i class="icon-truck"></i> Delivery</span> <span class="label label-inverse">$ 3,00</span>
                </td>
                <td class="span2 hidden-phone">
                    <span class="label label-warning"><i class="icon-warning-sign"></i> In 3-5 Days</span>
                </td>
                <td class="span2 hidden-phone text-center">
                    <input type="text" value="1" class="span1 text-center">
                </td>
                <td class="span2 text-right">
                    <span class="text-black">$ 59,00</span>
                </td>
            </tr>
            <tr>
                <td class="span1 text-center">
                    <a href="javascript:void(0)" class="badge badge-important" data-toggle="tooltip" title="Remove Product">
                        <i class="icon-remove"></i>
                    </a>
                </td>
                <td class="span2 hidden-phone text-center">
                    <img src="img/placeholders/image_64x64_dark.png" alt="image" class="img-rounded">
                </td>
                <td>
                    <strong>Item Name</strong><br>
                    This is a description<br>
                    <strong>Product ID:</strong> <em>#P968125</em><br>
                    <span class="label label-info"><i class="icon-truck"></i> Delivery</span> <span class="label label-success">FREE</span>
                </td>
                <td class="span2 hidden-phone">
                    <span class="label label-success"><i class="icon-ok"></i> In Stock</span>
                </td>
                <td class="span2 hidden-phone text-center">
                    <input type="text" value="1" class="span1 text-center">
                </td>
                <td class="span2 text-right">
                    <span class="text-black">$ 999,00</span>
                </td>
            </tr>
            <tr>
                <td class="span1 text-center">
                    <a href="javascript:void(0)" class="badge badge-important" data-toggle="tooltip" title="Remove Product">
                        <i class="icon-remove"></i>
                    </a>
                </td>
                <td class="span2 hidden-phone text-center">
                    <img src="img/placeholders/image_64x64_dark.png" alt="image" class="img-rounded">
                </td>
                <td>
                    <strong>Item Name</strong><br>
                    This is a description<br>
                    <strong>Product ID:</strong> <em>#P516959</em><br>
                    <span class="label label-info"><i class="icon-truck"></i> Delivery</span> <span class="label label-success">FREE</span>
                </td>
                <td class="span2 hidden-phone">
                    <span class="label label-important"><i class="icon-warning-sign"></i> Out of Stock</span>
                </td>
                <td class="span2 hidden-phone text-center">
                    <input type="text" value="1" class="span1 text-center">
                </td>
                <td class="span2 text-right">
                    <span class="text-black">$ 299,00</span>
                </td>
            </tr>
            <tr>
                <td class="span1 text-center">
                    <a href="javascript:void(0)" class="badge badge-important" data-toggle="tooltip" title="Remove Product">
                        <i class="icon-remove"></i>
                    </a>
                </td>
                <td class="span2 hidden-phone text-center">
                    <img src="img/placeholders/image_64x64_dark.png" alt="image" class="img-rounded">
                </td>
                <td>
                    <strong>Item Name</strong><br>
                    This is a description<br>
                    <strong>Product ID:</strong> <em>#P152365</em><br>
                    <span class="label label-info"><i class="icon-truck"></i> Delivery</span> <span class="label label-success">FREE</span>
                </td>
                <td class="span2 hidden-phone">
                    <span class="label label-success"><i class="icon-ok"></i> In Stock</span>
                </td>
                <td class="span2 hidden-phone text-center">
                    <input type="text" value="1" class="span1 text-center">
                </td>
                <td class="span2 text-right">
                    <span class="text-black">$ 1199,00</span>
                </td>
            </tr>
            <!--
            We do not use the colspan="" attribute, so that we can use the .hidden-* classes on <td> elements
            and hide them on mobiles for example. This way we do not break the table structure!
            -->
            <tr class="info">
                <td class="span1"></td>
                <td class="span2 hidden-phone"></td>
                <td class="hidden-phone"></td>
                <td class="span2 hidden-phone"></td>
                <td class="span2 text-right"><strong>Subtotal</strong></td>
                <td class="span2 text-right">
                    <span class="text-black">$ 2794,00</span>
                </td>
            </tr>
            <tr class="info">
                <td class="span1"></td>
                <td class="span2 hidden-phone"></td>
                <td class="hidden-phone"></td>
                <td class="span2 hidden-phone"></td>
                <td class="span2 text-right"><strong>Delivery</strong></td>
                <td class="span2 text-right">
                    <span class="text-black">$ 6,00</span>
                </td>
            </tr>
            <tr class="success">
                <td class="span1"></td>
                <td class="span2 hidden-phone"></td>
                <td class="hidden-phone"></td>
                <td class="span2 hidden-phone"></td>
                <td class="span2 text-right"><strong>Total</strong></td>
                <td class="span2 text-right">
                    <span class="text-black"><strong>$ 2800,00</strong></span>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- END Table -->

    <!-- Bottom Options -->
    <div class="clearfix">
        <div class="pull-right">
            <a href="javascript:void(0)" class="btn"><i class="icon-angle-right"></i> Continue Shopping</a>
            <a href="javascript:void(0)" class="btn btn-success"><i class="icon-ok"></i> Checkout</a>
        </div>
    </div>
    <!-- END Bottom Options -->
</div>
<!-- END Page Content -->

<?php include 'inc/footer.php'; // Footer and scripts ?>

<?php include 'inc/bottom.php'; // Close body and html tags ?>