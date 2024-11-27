<?php include 'inc/config.php';   // Configuration php file ?>
<?php include 'inc/top.php';      // Meta data and header   ?>
<?php include 'inc/side.php';      // Navigation content     ?>

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-table themed-color"></i> Static Tables<br><small>Many variations offered!</small></h1>
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
            <a href="#">Tables</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="">Static</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <!-- Default Style -->
    <h4 class="page-header">Default Style <small><code>.table</code></small></h4>

    <!-- Default Style Section -->
    <div class="block-section">
        <p>Some columns are hidden on mobile phones and/or tablets. This can be achieved by adding the class <code>.hidden-phone</code> on the <code>&lt;td&gt;</code> elements we want to hide. There are also other classes for hiding or making visible html elements on various devices: <code>.hidden-phone</code> <code>.hidden-tablet</code> <code>.hidden-desktop</code> &amp; <code>.visible-phone</code> <code>.visible-tablet</code> <code>.visible-desktop</code>. It is the perfect way for making the tables flexible and responsive.</p>
        <!-- Table Options -->
        <div class="clearfix">
            <div class="btn-group pull-right">
                <button class="btn" data-toggle="tooltip" title="Table Settings"><i class="icon-cog"></i></button>
                <button class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-angle-down"></i></button>
                <ul class="dropdown-menu">
                    <li><a href="javascript:void(0)"><i class="icon-print"></i> Print</a></li>
                    <li><a href="javascript:void(0)"><i class="icon-file-alt"></i> Save as PDF</a></li>
                    <li class="divider"></li>
                    <li><a href="javascript:void(0)"><i class="icon-external-link"></i> Export</a></li>
                </ul>
            </div>
            <button class="btn btn-success"><i class="icon-pencil"></i> Edit Selected</button>
            <button class="btn btn-danger"><i class="icon-remove"></i> Remove Selected</button>
        </div>
        <!-- END Table Options -->

        <!-- Default Table -->
        <table class="table">
            <thead>
                <tr>
                    <th class="span1 text-center"><input type="checkbox"></th>
                    <th class="span1 text-center">#</th>
                    <th class="span2 text-center hidden-phone">Avatar</th>
                    <th>Username</th>
                    <th class="hidden-phone hidden-tablet"><i class="icon-envelope-alt"></i> Email</th>
                    <th class="span1 hidden-phone">Plan</th>
                    <th class="span1 text-center"><i class="icon-bolt"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php for($i=1; $i<7; $i++) { ?>
                <tr>
                    <td class="span1 text-center"><input type="checkbox" id="checkbox1-<?php echo $i; ?>" name="checkbox1-<?php echo $i; ?>"></td>
                    <td class="span1 text-center"><?php echo $i; ?></td>
                    <td class="span2 text-center hidden-phone"><img src="img/placeholders/image_64x64_dark.png" alt="fakeimg" class="img-circle"></td>
                    <td><a href="javascript:void(0)">username<?php echo $i; ?></a></td>
                    <td class="hidden-phone hidden-tablet">user<?php echo $i; ?>@example.com</td>
                    <td class="span1 hidden-phone"><a href="javascript:void(0)" class="label label-info">VIP</a></td>
                    <td class="span1 text-center">
                        <div class="btn-group">
                            <a href="javascript:void(0)" data-toggle="tooltip" title="Edit" class="btn btn-mini btn-success"><i class="icon-pencil"></i></a>
                            <a href="javascript:void(0)" data-toggle="tooltip" title="Delete" class="btn btn-mini btn-danger"><i class="icon-remove"></i></a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <!-- END Default Table -->

        <!-- Pagination -->
        <div class="pagination pagination-centered">
            <ul>
                <li><a href="javascript:void(0)">Prev</a></li>
                <li><a href="javascript:void(0)">1</a></li>
                <li class="active"><a href="javascript:void(0)">2</a></li>
                <li><a href="javascript:void(0)">3</a></li>
                <li><a href="javascript:void(0)">Next</a></li>
            </ul>
        </div>
        <!-- END Pagination -->
    </div>
    <!-- END Default Style Section -->
    <!-- END Default Style -->

    <!-- Condensed Style -->
    <h4 class="page-header">Condensed <small><code>.table</code> <code>.table-condensed</code></small></h4>

    <!-- Condensed Section -->
    <div class="block-section">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th class="span1 text-center"><input type="checkbox"></th>
                    <th class="span1 text-center">#</th>
                    <th>Username</th>
                    <th class="hidden-phone"><i class="icon-envelope-alt"></i> Email</th>
                    <th class="hidden-phone">Firstname</th>
                    <th class="hidden-phone">Lastname</th>
                    <th class="span1 text-center"><i class="icon-bolt"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php for($i=1; $i<7; $i++) { ?>
                <tr>
                    <td class="span1 text-center"><input type="checkbox" id="checkbox2-<?php echo $i; ?>" name="checkbox2-<?php echo $i; ?>"></td>
                    <td class="span1 text-center"><?php echo $i; ?></td>
                    <td><a href="javascript:void(0)">username<?php echo $i; ?></a></td>
                    <td class="hidden-phone">user<?php echo $i; ?>@example.com</td>
                    <td class="hidden-phone">Name</td>
                    <td class="hidden-phone">Last</td>
                    <td class="span1 text-center">
                        <div class="btn-group">
                            <a href="javascript:void(0)" data-toggle="tooltip" title="Edit" class="btn btn-mini btn-success"><i class="icon-pencil"></i></a>
                            <a href="javascript:void(0)" data-toggle="tooltip" title="Delete" class="btn btn-mini btn-danger"><i class="icon-remove"></i></a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- END Condensed Section -->
    <!-- END Condensed Style -->

    <!-- Hover Style -->
    <h4 class="page-header">Hover <small><code>.table</code> <code>.table-hover</code></small></h4>

    <!-- Hover Section -->
    <div class="block-section">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="span1 text-center"><input type="checkbox"></th>
                    <th class="span1 text-center">#</th>
                    <th>Username</th>
                    <th class="hidden-phone"><i class="icon-envelope-alt"></i> Email</th>
                    <th class="hidden-phone">Firstname</th>
                    <th class="hidden-phone">Lastname</th>
                    <th class="span1 text-center"><i class="icon-bolt"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php for($i=1; $i<7; $i++) { ?>
                <tr>
                    <td class="span1 text-center"><input type="checkbox" id="checkbox3-<?php echo $i; ?>" name="checkbox3-<?php echo $i; ?>"></td>
                    <td class="span1 text-center"><?php echo $i; ?></td>
                    <td><a href="javascript:void(0)">username<?php echo $i; ?></a></td>
                    <td class="hidden-phone">user<?php echo $i; ?>@example.com</td>
                    <td class="hidden-phone">Name</td>
                    <td class="hidden-phone">Last</td>
                    <td class="span1 text-center">
                        <div class="btn-group">
                            <a href="javascript:void(0)" data-toggle="tooltip" title="Edit" class="btn btn-mini btn-success"><i class="icon-pencil"></i></a>
                            <a href="javascript:void(0)" data-toggle="tooltip" title="Delete" class="btn btn-mini btn-danger"><i class="icon-remove"></i></a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- END Hover Section -->
    <!-- END Hover Style -->

    <!-- With Stripes Style -->
    <h4 class="page-header">With Stripes <small><code>.table</code> <code>.table-striped</code></small></h4>

    <!-- With Stripes Section -->
    <div class="block-section">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="span1 text-center"><input type="checkbox"></th>
                    <th class="span1 text-center">#</th>
                    <th>Username</th>
                    <th class="hidden-phone"><i class="icon-envelope-alt"></i> Email</th>
                    <th class="hidden-phone">Firstname</th>
                    <th class="hidden-phone">Lastname</th>
                    <th class="span1 text-center"><i class="icon-bolt"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php for($i=1; $i<7; $i++) { ?>
                <tr>
                    <td class="span1 text-center"><input type="checkbox" id="checkbox-4<?php echo $i; ?>" name="checkbox-4<?php echo $i; ?>"></td>
                    <td class="span1 text-center"><?php echo $i; ?></td>
                    <td><a href="javascript:void(0)">username<?php echo $i; ?></a></td>
                    <td class="hidden-phone">user<?php echo $i; ?>@example.com</td>
                    <td class="hidden-phone">Name</td>
                    <td class="hidden-phone">Last</td>
                    <td class="span1 text-center">
                        <div class="btn-group">
                            <a href="javascript:void(0)" data-toggle="tooltip" title="Edit" class="btn btn-mini btn-success"><i class="icon-pencil"></i></a>
                            <a href="javascript:void(0)" data-toggle="tooltip" title="Delete" class="btn btn-mini btn-danger"><i class="icon-remove"></i></a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- END With Stripes Section -->
    <!-- END With Stripes Style -->

    <!-- With Borders Style -->
    <h4 class="page-header">With Borders <small><code>.table</code> <code>.table-bordered</code></small></h4>

    <!-- With Borders Section -->
    <div class="block-section">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="span1 text-center"><input type="checkbox"></th>
                    <th class="span1 text-center">#</th>
                    <th>Username</th>
                    <th class="hidden-phone"><i class="icon-envelope-alt"></i> Email</th>
                    <th class="hidden-phone">Firstname</th>
                    <th class="hidden-phone">Lastname</th>
                    <th class="span1 text-center"><i class="icon-bolt"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php for($i=1; $i<7; $i++) { ?>
                <tr>
                    <td class="span1 text-center"><input type="checkbox" id="checkbox5-<?php echo $i; ?>" name="checkbox5-<?php echo $i; ?>"></td>
                    <td class="span1 text-center"><?php echo $i; ?></td>
                    <td><a href="javascript:void(0)">username<?php echo $i; ?></a></td>
                    <td class="hidden-phone">user<?php echo $i; ?>@example.com</td>
                    <td class="hidden-phone">Name</td>
                    <td class="hidden-phone">Last</td>
                    <td class="span1 text-center">
                        <div class="btn-group">
                            <a href="javascript:void(0)" data-toggle="tooltip" title="Edit" class="btn btn-mini btn-success"><i class="icon-pencil"></i></a>
                            <a href="javascript:void(0)" data-toggle="tooltip" title="Delete" class="btn btn-mini btn-danger"><i class="icon-remove"></i></a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- END With Borders Section -->
    <!-- END With Borders Style -->

    <!-- Borderless Style -->
    <h4 class="page-header">Borderless <small><code>.table</code> <code>.table-borderless</code></small></h4>

    <!-- Borderless Section -->
    <div class="block-section">
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th class="span1 text-center"><input type="checkbox"></th>
                    <th class="span1 text-center">#</th>
                    <th>Username</th>
                    <th class="hidden-phone"><i class="icon-envelope-alt"></i> Email</th>
                    <th class="hidden-phone">Firstname</th>
                    <th class="hidden-phone">Lastname</th>
                    <th class="span1 text-center"><i class="icon-bolt"></i> </th>
                </tr>
            </thead>
            <tbody>
                <?php for($i=1; $i<7; $i++) { ?>
                <tr>
                    <td class="span1 text-center"><input type="checkbox" id="checkbox6-<?php echo $i; ?>" name="checkbox6-<?php echo $i; ?>"></td>
                    <td class="span1 text-center"><?php echo $i; ?></td>
                    <td><a href="javascript:void(0)">username<?php echo $i; ?></a></td>
                    <td class="hidden-phone">user<?php echo $i; ?>@example.com</td>
                    <td class="hidden-phone">Name</td>
                    <td class="hidden-phone">Last</td>
                    <td class="span1 text-center">
                        <div class="btn-group">
                            <a href="javascript:void(0)" data-toggle="tooltip" title="Edit" class="btn btn-mini btn-success"><i class="icon-pencil"></i></a>
                            <a href="javascript:void(0)" data-toggle="tooltip" title="Delete" class="btn btn-mini btn-danger"><i class="icon-remove"></i></a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- END Borderless Section -->
    <!-- END Borderless Style -->

    <!-- Row Classes Style -->
    <h4 class="page-header">Row Classes <small><code>.success</code>, <code>.error</code>, <code>.warning</code> and <code>.info</code></small></h4>

    <!-- Row Classes Section -->
    <div class="block-section block-last">
        <table class="table table-borderless remove-margin">
            <thead>
                <tr>
                    <th class="span1 text-center"><input type="checkbox"></th>
                    <th class="span1 text-center">#</th>
                    <th>Username</th>
                    <th class="hidden-phone"><i class="icon-envelope-alt"></i> Email</th>
                    <th class="hidden-phone">Firstname</th>
                    <th class="hidden-phone">Lastname</th>
                    <th class="span1 text-center"><i class="icon-bolt"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php $row_classes = array('success', 'error', 'warning', 'info'); ?>
                <?php for($i = 0; $i < 8; $i++) { ?>
                <tr class="<?php echo $row_classes[($i < 4) ? $i : rand(0, 3)]; ?>">
                    <td class="span1 text-center"><input type="checkbox" id="checkbox7-<?php echo $i + 1; ?>" name="checkbox7-<?php echo $i + 1; ?>"></td>
                    <td class="span1 text-center"><?php echo $i + 1; ?></td>
                    <td><a href="javascript:void(0)">username<?php echo $i + 1; ?></a></td>
                    <td class="hidden-phone">user<?php echo $i + 1; ?>@example.com</td>
                    <td class="hidden-phone">Name</td>
                    <td class="hidden-phone">Last</td>
                    <td class="span1 text-center">
                        <div class="btn-group">
                            <a href="javascript:void(0)" data-toggle="tooltip" title="Edit" class="btn btn-mini btn-success"><i class="icon-pencil"></i></a>
                            <a href="javascript:void(0)" data-toggle="tooltip" title="Delete" class="btn btn-mini btn-danger"><i class="icon-remove"></i></a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- END Row Classes Section -->
    <!-- END Row Classes Style -->
</div>
<!-- END Page Content -->

<?php include 'inc/footer.php'; // Footer and scripts ?>

<?php include 'inc/bottom.php'; // Close body and html tags ?>