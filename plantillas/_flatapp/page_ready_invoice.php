<?php include 'inc/config.php';   // Configuration php file ?>
<?php include 'inc/top.php';      // Meta data and header   ?>
<?php include 'inc/side.php';      // Navigation content     ?>

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-wallet themed-color"></i>Invoice<br><small>It's time for some reward!</small></h1>
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
        <li class="active"><a href="">Invoice</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <!-- Invoice -->
    <h4 class="page-header">
        <span class="header-options pull-right btn-group">
            <a href="javascript:void(0)" class="btn" data-toggle="tooltip" title="Save"><i class="icon-save"></i></a>
            <a href="javascript:void(0)" class="btn" data-toggle="tooltip" title="Print"><i class="icon-print"></i></a>
        </span>
        <i class="icon-file-alt"></i> #INV00115
    </h4>

    <!-- Invoice Content -->
    <!-- Addresses -->
    <div class="block-section-pad remove-margin">
        <div class="row-fluid">
            <div class="span6">
                <address>
                    <strong><i class="icon-home"></i> Your Company</strong><br>
                    Address Line<br>
                    Town/City<br>
                    Region, Zip/Postal Code<br><br>
                    <abbr title="Phone"><i class="icon-phone"></i> </abbr> (000) 000-0000
                </address>
            </div>
            <div class="span6">
                <table class="table-borderless table-condensed pull-right">
                    <tbody>
                        <tr>
                            <td><strong>Bill To:</strong></td>
                            <td>
                                <address>
                                    <strong>Client Company</strong><br>
                                    Address Line<br>
                                    Town/City<br>
                                    Region, Zip/Postal Code
                                </address>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Invoice</strong></td>
                            <td><span class="label label-inverse">#INV00115</span></td>
                        </tr>
                        <tr>
                            <td><strong>Date</strong></td>
                            <td><span class="label label-important">July 20, 2013</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END Addresses -->

    <!-- Product Table -->
    <table class="table table-borderless table-hover">
        <thead>
            <tr>
                <th></th>
                <th>Product</th>
                <th class="hidden-phone">Description</th>
                <th class="hidden-phone text-center">Unit Price</th>
                <th class="hidden-phone text-center">Quantity</th>
                <th class="text-center">Discount</th>
                <th class="text-right">Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td><strong>Design</strong></td>
                <td class="hidden-phone"><em>WebApp #1</em></td>
                <td class="hidden-phone text-center">$ 1200,00</td>
                <td class="hidden-phone text-center">1</td>
                <td class="text-center">-</td>
                <td class="text-right">$ 1200,00</td>
            </tr>
            <tr>
                <td>2</td>
                <td><strong>Development</strong></td>
                <td class="hidden-phone"><em>WebApp #2</em></td>
                <td class="hidden-phone text-center">$ 1200,00</td>
                <td class="hidden-phone text-center">1</td>
                <td class="text-center">-</td>
                <td class="text-right">$ 1200,00</td>
            </tr>
            <tr>
                <td>3</td>
                <td><strong>Design</strong></td>
                <td class="hidden-phone"><em>WebApp #3</em></td>
                <td class="hidden-phone text-center">$ 1200,00</td>
                <td class="hidden-phone text-center">1</td>
                <td class="text-center">-</td>
                <td class="text-right">$ 1200,00</td>
            </tr>
            <tr>
                <td>4</td>
                <td>...</td>
                <td class="hidden-phone">...</td>
                <td class="hidden-phone text-center">...</td>
                <td class="hidden-phone text-center">...</td>
                <td class="text-center">...</td>
                <td class="text-right">...</td>
            </tr>
            <tr>
                <td>5</td>
                <td>...</td>
                <td class="hidden-phone">...</td>
                <td class="hidden-phone text-center">...</td>
                <td class="hidden-phone text-center">...</td>
                <td class="text-center">...</td>
                <td class="text-right">...</td>
            </tr>
            <tr>
                <td>6</td>
                <td>...</td>
                <td class="hidden-phone">...</td>
                <td class="hidden-phone text-center">...</td>
                <td class="hidden-phone text-center">...</td>
                <td class="text-center">...</td>
                <td class="text-right">...</td>
            </tr>
            <tr>
                <td>7</td>
                <td>...</td>
                <td class="hidden-phone">...</td>
                <td class="hidden-phone text-center">...</td>
                <td class="hidden-phone text-center">...</td>
                <td class="text-center">...</td>
                <td class="text-right">...</td>
            </tr>
            <tr>
                <td>8</td>
                <td>...</td>
                <td class="hidden-phone">...</td>
                <td class="hidden-phone text-center">...</td>
                <td class="hidden-phone text-center">...</td>
                <td class="text-center">...</td>
                <td class="text-right">...</td>
            </tr>
            <tr>
                <td>9</td>
                <td>...</td>
                <td class="hidden-phone">...</td>
                <td class="hidden-phone text-center">...</td>
                <td class="hidden-phone text-center">...</td>
                <td class="text-center">...</td>
                <td class="text-right">...</td>
            </tr>
            <tr>
                <td>10</td>
                <td>...</td>
                <td class="hidden-phone">...</td>
                <td class="hidden-phone text-center">...</td>
                <td class="hidden-phone text-center">...</td>
                <td class="text-center">...</td>
                <td class="text-right">...</td>
            </tr>
            <!--
            We do not use the colspan="" attribute, so that we can use the .hidden-* classes on <td> elements
            and hide them for example on mobiles. This way we do not break the table structure!
            -->
            <tr class="info">
                <td></td>
                <td></td>
                <td class="hidden-phone"></td>
                <td class="hidden-phone"></td>
                <td class="hidden-phone"></td>
                <td class="text-right"><strong>Subtotal</strong></td>
                <td class="text-right">$ 3600,00</td>
            </tr>
            <tr class="info">
                <td></td>
                <td></td>
                <td class="hidden-phone"></td>
                <td class="hidden-phone"></td>
                <td class="hidden-phone"></td>
                <td class="text-right"><strong>VAT Rate</strong></td>
                <td class="text-right">10%</td>
            </tr>
            <tr class="info">
                <td></td>
                <td></td>
                <td class="hidden-phone"></td>
                <td class="hidden-phone"></td>
                <td class="hidden-phone"></td>
                <td class="text-right"><strong>VAT Due</strong></td>
                <td class="text-right">$ 360,00</td>
            </tr>
            <tr class="success">
                <td></td>
                <td></td>
                <td class="hidden-phone"></td>
                <td class="hidden-phone"></td>
                <td class="hidden-phone"></td>
                <td class="text-right"><strong>Total Due</strong></td>
                <td class="text-right"><span class="text-black"><strong>$ 3960,00</strong></span></td>
            </tr>
        </tbody>
    </table>
    <!-- END Product Table -->

    <!-- Extras -->
    <div class="row-fluid">
        <div class="span8">
            <p class="remove-margin"><strong>Sent to:</strong> <a href="javascript:void(0)" class="badge badge-success">client@company.com</a><br>Payment Due by <span class="label label-important">July 20, 2013</span></p>
        </div>
        <div class="span4">
            <a href="javascript:void(0)" class="btn btn-large btn-success pull-right"><i class="icon-ok"></i> Send</a>
        </div>
    </div>
    <!-- END Extras -->
    <!-- END Invoice Content -->
</div>
<!-- END Page Content -->

<?php include 'inc/footer.php'; // Footer and scripts ?>

<?php include 'inc/bottom.php'; // Close body and html tags ?>