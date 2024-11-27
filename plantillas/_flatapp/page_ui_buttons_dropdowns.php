<?php include 'inc/config.php';   // Configuration php file ?>
<?php include 'inc/top.php';      // Meta data and header   ?>
<?php include 'inc/side.php';      // Navigation content     ?>

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-electricity themed-color"></i>Buttons &amp; Dropdowns<br><small>They come in many colors, sizes and options!</small></h1>
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
        <li class="active"><a href="">Buttons &amp; Dropdowns</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <!-- Buttons Block -->
    <div class="block block-themed">
        <!-- Buttons Title -->
        <div class="block-title">
            <h4>Buttons <small>You can have all kinds of buttons with different colors and sizes</small></h4>
        </div>
        <!-- END Buttons Title -->

        <!-- Buttons Content -->
        <div class="block-content">
            <!-- div.row-fluid -->
            <div class="row-fluid">
                <!-- Simple Buttons -->
                <div class="span6">
                    <h4 class="sub-header">Simple Buttons</h4>
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td class="span3"><code>.btn</code></td>
                                <td><button type="button" class="btn">Default</button></td>
                            </tr>
                            <tr>
                                <td class="span3"><code>.btn</code> <code>.btn-primary</code></td>
                                <td><button type="button" class="btn btn-primary">Primary</button></td>
                            </tr>
                            <tr>
                                <td class="span3"><code>.btn</code> <code>.btn-success</code></td>
                                <td><button type="button" class="btn btn-success">Success</button></td>
                            </tr>
                            <tr>
                                <td class="span3"><code>.btn</code> <code>.btn-danger</code></td>
                                <td><button type="button" class="btn btn-danger">Danger</button></td>
                            </tr>
                            <tr>
                                <td class="span3"><code>.btn</code> <code>.btn-warning</code></td>
                                <td><button type="button" class="btn btn-warning">Warning</button></td>
                            </tr>
                            <tr>
                                <td class="span3"><code>.btn</code> <code>.btn-info</code></td>
                                <td><button type="button" class="btn btn-info">Info</button></td>
                            </tr>
                            <tr>
                                <td class="span3"><code>.btn</code> <code>.btn-inverse</code></td>
                                <td><button type="button" class="btn btn-inverse">Inverse</button></td>
                            </tr>
                            <tr>
                                <td class="span3"><code>.btn</code> <code>.btn-link</code></td>
                                <td><button type="button" class="btn btn-link">Link</button></td>
                            </tr>
                            <tr>
                                <td class="span3"><code>.btn</code> <code>.disabled</code></td>
                                <td>
                                    <a class="btn disabled" href="javascript:void(0)">Link</a>
                                    <button class="btn disabled" type="submit" disabled>Button</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- END Simple Buttons -->

                <!-- Sizes -->
                <div class="span6">
                    <h4 class="sub-header">Sizes</h4>
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td class="span4"><code>.btn</code> <code>.btn-mini</code></td>
                                <td>
                                    <button type="button" class="btn btn-mini">Default</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="span4"><code>.btn</code> <code>.btn-small</code></td>
                                <td>
                                    <button type="button" class="btn btn-small">Default</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="span4"><code>.btn</code></td>
                                <td>
                                    <button type="button" class="btn">Default</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="span4"><code>.btn</code> <code>.btn-large</code></td>
                                <td>
                                    <button type="button" class="btn btn-large">Default</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="span4"><code>.btn</code> <code>.btn-mini</code> <code>.btn-inverse</code></td>
                                <td>
                                    <button type="button" class="btn btn-mini btn-inverse">Inverse</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="span4"><code>.btn</code> <code>.btn-small</code> <code>.btn-warning</code></td>
                                <td>
                                    <button type="button" class="btn btn-small btn-warning">Warning</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="span4"><code>.btn</code> <code>.btn-success</code></td>
                                <td>
                                    <button type="button" class="btn btn-success">Success</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="span4"><code>.btn</code> <code>.btn-large</code> <code>.btn-info</code></td>
                                <td>
                                    <button type="button" class="btn btn-large btn-info">Information</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- END Sizes -->
            </div>
            <!-- END div.row-fluid -->
        </div>
        <!-- END Buttons Content -->
    </div>
    <!-- END Buttons Block -->

    <!-- Buttons and Icons Block -->
    <div class="block block-themed">
        <!-- Buttons and Icons Title -->
        <div class="block-title">
            <h4>Buttons and Icons <small>You can use only icons or with text in any button size</small></h4>
        </div>
        <!-- END Buttons and Icons Title -->

        <!-- Buttons and Icons Content -->
        <div class="block-content">
            <div class="block-section">
                <button class="btn btn-mini btn-danger"><i class="icon-remove"></i></button>
                <button class="btn btn-mini btn-warning"><i class="icon-warning-sign"></i></button>
                <button class="btn btn-mini btn-success"><i class="icon-user"></i> New User <i class="icon-plus"></i></button>
                <button class="btn btn-mini btn-primary"><i class="icon-facebook"></i> Facebook</button>
                <button class="btn btn-mini btn-info"><i class="icon-twitter"></i> Twitter</button>
            </div>
            <div class="block-section">
                <button class="btn btn-small btn-danger"><i class="icon-remove"></i></button>
                <button class="btn btn-small btn-warning"><i class="icon-warning-sign"></i></button>
                <button class="btn btn-small btn-success"><i class="icon-user"></i> New User <i class="icon-plus"></i></button>
                <button class="btn btn-small btn-primary"><i class="icon-facebook"></i> Facebook</button>
                <button class="btn btn-small btn-info"><i class="icon-twitter"></i> Twitter</button>
            </div>
            <div class="block-section">
                <button class="btn btn-danger"><i class="icon-remove"></i></button>
                <button class="btn btn-warning"><i class="icon-warning-sign"></i></button>
                <button class="btn btn-success"><i class="icon-user"></i> New User <i class="icon-plus"></i></button>
                <button class="btn btn-primary"><i class="icon-facebook"></i> Facebook</button>
                <button class="btn btn-info"><i class="icon-twitter"></i> Twitter</button>
            </div>
            <div class="block-section">
                <button class="btn btn-large btn-danger"><i class="icon-remove"></i></button>
                <button class="btn btn-large btn-warning"><i class="icon-warning-sign"></i></button>
                <button class="btn btn-large btn-success"><i class="icon-user"></i> New User <i class="icon-plus"></i></button>
                <button class="btn btn-large btn-primary"><i class="icon-facebook"></i> Facebook</button>
                <button class="btn btn-large btn-info"><i class="icon-twitter"></i> Twitter</button>
            </div>
        </div>
        <!-- END Buttons and Icons Content -->
    </div>
    <!-- END Buttons and Icons Block -->

    <!-- Buttons and Dropdowns Block -->
    <div class="block block-themed block-last">
        <!-- Buttons and Dropdowns Title -->
        <div class="block-title">
            <h4>Buttons and Dropdowns</h4>
        </div>
        <!-- END Buttons and Dropdowns Title -->

        <!-- Buttons and Dropdowns Content -->
        <div class="block-content">
            <!-- Button group -->
            <div class="block-section">
                <h4 class="sub-header">Button Group</h4>
                <p>Create buttons inside a <code>&lt;div&gt;</code> element with <code>.btn-group</code> class to create a button group</p>
                <div class="btn-group">
                    <button class="btn btn-info">Left</button>
                    <button class="btn btn-info">Middle</button>
                    <button class="btn btn-info">Right</button>
                </div>
            </div>
            <!-- END Button group -->

            <!-- Vertical Button Group -->
            <div class="block-section">
                <h4 class="sub-header">Vertical Button Group</h4>
                <p>Add the extra <code>.btn-group-vertical</code> class for a vertical group</p>
                <div class="btn-group btn-group-vertical">
                    <button class="btn btn-warning"><i class="icon-file"></i></button>
                    <button class="btn btn-success"><i class="icon-file-alt"></i></button>
                    <button class="btn btn-danger"><i class="icon-file"></i></button>
                </div>
            </div>
            <!-- END Vertical Button Group -->

            <!-- Button Groups and Dropdowns -->
            <div class="block-section">
                <h4 class="sub-header">Button Groups and Dropdowns</h4>
                <p>Use any button within a <code>.btn-group</code> and the proper dropdown menu markup to trigger it. Dropdown menus have many options such as disabled links, second level menus or split buttons</p>
                <div class="btn-group">
                    <a class="btn btn-danger dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">Dropdown <i class="icon-angle-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="javascript:void(0)">Action</a></li>
                        <li class="disabled"><a href="javascript:void(0)">Disabled</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-submenu">
                            <a href="javascript:void(0)">More options</a>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:void(0)">First Option</a></li>
                                <li><a href="javascript:void(0)">Second Option</a></li>
                                <li class="divider"></li>
                                <li><a href="javascript:void(0)">Another Option</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="btn-group dropup">
                    <a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">Dropup <i class="icon-angle-up"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="javascript:void(0)">Action</a></li>
                        <li class="disabled"><a href="javascript:void(0)">Disabled</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-submenu">
                            <a href="javascript:void(0)">More options</a>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:void(0)">First Option</a></li>
                                <li><a href="javascript:void(0)">Second Option</a></li>
                                <li class="divider"></li>
                                <li><a href="javascript:void(0)">Another Option</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="btn-group">
                    <a class="btn btn-success">Split</a>
                    <a class="btn btn-success"><i class="icon-cog"></i></a>
                    <a class="btn btn-success dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)"><i class="icon-angle-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="javascript:void(0)">Action</a></li>
                        <li class="disabled"><a href="javascript:void(0)">Disabled</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-submenu">
                            <a href="javascript:void(0)">More options</a>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:void(0)">First Option</a></li>
                                <li><a href="javascript:void(0)">Second Option</a></li>
                                <li class="divider"></li>
                                <li><a href="javascript:void(0)">Another Option</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- END Button groups and dropdowns -->

            <!-- Toolbars -->
            <div class="block-section">
                <h4 class="sub-header">Toolbars</h4>
                <p>Combine sets of divs with <code>.btn-group</code> classes inside a div with <code>.btn-toolbar</code> class to create a toolbar! Remember that you can use any icon, color or size you want!</p>
                <div class="btn-toolbar">
                    <div class="btn-group">
                        <button class="btn btn-mini"><i class="icon-file"></i></button>
                        <button class="btn btn-mini"><i class="icon-save"></i></button>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-mini"><i class="icon-cut"></i></button>
                        <button class="btn btn-mini"><i class="icon-copy"></i></button>
                        <button class="btn btn-mini"><i class="icon-paste"></i></button>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-mini"><i class="icon-bold"></i></button>
                        <button class="btn btn-mini"><i class="icon-italic"></i></button>
                        <button class="btn btn-mini"><i class="icon-underline"></i></button>
                        <button class="btn btn-mini"><i class="icon-strikethrough"></i></button>
                    </div>
                </div>
                <div class="btn-toolbar">
                    <div class="btn-group">
                        <button class="btn btn-warning"><i class="icon-align-left"></i></button>
                        <button class="btn btn-warning"><i class="icon-align-center"></i></button>
                        <button class="btn btn-warning"><i class="icon-align-right"></i></button>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-info"><i class="icon-indent-left"></i></button>
                        <button class="btn btn-info"><i class="icon-indent-right"></i></button>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-success"><i class="icon-list-ul"></i></button>
                        <button class="btn btn-success"><i class="icon-list-ol"></i></button>
                        <button class="btn btn-success"><i class="icon-table"></i></button>
                    </div>
                    <div class="btn-group dropup">
                        <button class="btn btn-success dropdown-toggle" data-toggle="dropdown"><i class="icon-chevron-up"></i></button>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:void(0)">Action</a></li>
                            <li class="disabled"><a href="javascript:void(0)">Disabled</a></li>
                            <li class="divider"></li>
                            <li class="dropdown-submenu">
                                <a href="javascript:void(0)">More options</a>
                                <ul class="dropdown-menu">
                                    <li><a href="javascript:void(0)">First Option</a></li>
                                    <li><a href="javascript:void(0)">Second Option</a></li>
                                    <li class="divider"></li>
                                    <li><a href="javascript:void(0)">Another Option</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- END Toolbars -->
        </div>
        <!-- END Buttons and Dropdowns Content -->
    </div>
    <!-- END Buttons and Dropdowns Block -->
</div>
<!-- END Page Content -->

<?php include 'inc/footer.php'; // Footer and scripts ?>

<?php include 'inc/bottom.php'; // Close body and html tags ?>