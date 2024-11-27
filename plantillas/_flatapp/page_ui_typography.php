<?php include 'inc/config.php';   // Configuration php file ?>
<?php include 'inc/top.php';      // Meta data and header   ?>
<?php include 'inc/side.php';      // Navigation content     ?>

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-font themed-color"></i>Typography<br><small>Clean and rich!</small></h1>
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
        <li class="active"><a href="">Typography</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <!-- Headings Block -->
    <div class="block block-themed">
        <!-- Headings Title -->
        <div class="block-title">
            <h4>Headings <small><code>.page-header</code>, <code>.sub-header</code> and default style</small></h4>
        </div>
        <!-- END Headings Title -->

        <!-- Headings Content -->
        <div class="block-content">
            <div class="row-fluid">
                <div class="span4">
                    <h1 class="page-header">h1. Heading</h1>
                    <h2 class="page-header">h2. Heading</h2>
                    <h3 class="page-header">h3. Heading</h3>
                    <h4 class="page-header">h4. Heading</h4>
                    <h5 class="page-header">h5. Heading</h5>
                    <h6 class="page-header">h6. Heading</h6>
                </div>
                <div class="span4">
                    <h1 class="sub-header">h1. Heading</h1>
                    <h2 class="sub-header">h2. Heading</h2>
                    <h3 class="sub-header">h3. Heading</h3>
                    <h4 class="sub-header">h4. Heading</h4>
                    <h5 class="sub-header">h5. Heading</h5>
                    <h6 class="sub-header">h6. Heading</h6>
                </div>
                <div class="span4">
                    <h1>h1. Heading</h1>
                    <h2>h2. Heading</h2>
                    <h3>h3. Heading</h3>
                    <h4>h4. Heading</h4>
                    <h5>h5. Heading</h5>
                    <h6>h6. Heading</h6>
                </div>
            </div>

        </div>
        <!-- END Headings Content -->
    </div>
    <!-- END Headings Block -->

    <!-- Text Block -->
    <div class="block block-themed">
        <!-- Text Title -->
        <div class="block-title">
            <h4>Text <small>Paragraphs, Blockquotes and more</small></h4>
        </div>
        <!-- END Text Title -->

        <!-- Text Content -->
        <div class="block-content">
            <!-- Paragraphs and Links -->
            <div class="row-fluid">
                <div class="span6">
                    <p class="lead">This is a lead paragraph!</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. <a href="javascript:void(0)">Maecenas</a> ultrices, justo vel imperdiet gravida, urna ligula hendrerit nibh, ac cursus nibh sapien in purus. Mauris tincidunt tincidunt turpis in porta. Integer fermentum tincidunt auctor. Vestibulum ullamcorper, odio sed rhoncus imperdiet, enim elit sollicitudin orci, eget dictum leo mi nec lectus. Nam commodo turpis id lectus scelerisque vulputate. Integer sed dolor erat. Fusce erat ipsum, varius vel euismod sed, tristique et lectus? Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque</p>
                </div>
                <div class="span6">
                    <p>Lorem ipsum dolor sit amet, <strong>consectetur adipiscing elit</strong>. Maecenas ultrices, justo vel imperdiet gravida, urna ligula hendrerit nibh, ac cursus nibh sapien in purus. Mauris tincidunt tincidunt turpis in porta. Integer fermentum tincidunt auctor. Vestibulum ullamcorper, odio sed rhoncus imperdiet, enim elit sollicitudin orci, eget dictum leo mi nec lectus. Nam commodo turpis id lectus scelerisque vulputate.</p>
                    <p><em>Integer sed dolor erat. Fusce erat ipsum, varius vel euismod sed, tristique et lectus? Etiam egestas  <a href="javascript:void(0)">fringilla</a> enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque? Proin rhoncus dui at ligula vestibulum ut facilisis ante sodales! Suspendisse potenti. Aliquam tincidunt sollicitudin sem nec ultrices. Sed at mi velit.</em></p>
                </div>
            </div>
            <!-- END Paragraphs and Links -->

            <!-- Emphasis and Well -->
            <div class="row-fluid">
                <!-- Well Paragraph -->
                <div class="span6">
                    <h4 class="sub-header">Well Paragraph</h4>
                    <p class="well"><strong>Gives the paragraph an inset effect!</strong> <code>.well</code><br>Integer sed dolor erat. Fusce erat ipsum, varius vel euismod sed, tristique et lectus? Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque? Proin rhoncus dui at ligula vestibulum ut facilisis ante sodales! Suspendisse potenti. Aliquam tincidunt sollicitudin sem nec ultrices. Sed at mi velit. Ut egestas tempor est, in cursus enim venenatis eget! Nulla quis ligula ipsum. Donec vitae ultrices dolor?</p>
                </div>
                <!-- END Well Paragraph -->

                <!-- Emphasis Text -->
                <div class="span6">
                    <h4 class="sub-header">Emphasis Text</h4>
                    <table class="table table-borderless table-hover">
                        <tbody>
                            <tr>
                                <td><code>.muted</code></td>
                                <td><span class="muted">Muted!</span></td>
                            </tr>
                            <tr>
                                <td><code>.text-success</code></td>
                                <td><span class="text-success">Success!</span></td>
                            </tr>
                            <tr>
                                <td><code>.text-error</code></td>
                                <td><span class="text-error">Important!</span></td>
                            </tr>
                            <tr>
                                <td><code>.text-warning</code></td>
                                <td><span class="text-warning">Warning!</span></td>
                            </tr>
                            <tr>
                                <td><code>.text-info</code></td>
                                <td><span class="text-info">Information!</span></td>
                            </tr>
                            <tr>
                                <td><code>.text-black</code></td>
                                <td><span class="text-black">Text in black color!</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- END Emphasis Text -->
            </div>
            <!-- END Emphasis and Well -->

            <!-- Blockquotes -->
            <h4 class="sub-header">Blockquotes</h4>
            <div class="row-fluid">
                <div class="span6">
                    <blockquote>
                        <p>This is a blockquote with source info</p>
                        <small>Someone famous <cite title="Source Title">Source Title</cite></small>
                    </blockquote>
                </div>
                <div class="span6">
                    <blockquote class="pull-right">
                        <p>This is a blockquote pulled right</p>
                        <small>Someone famous <cite title="Source Title">Source Title</cite></small>
                    </blockquote>
                </div>
            </div>
            <!-- END Blockquotes -->
        </div>
        <!-- END Text Content -->
    </div>
    <!-- END Text Block -->

    <!-- Alerts -->
    <div class="block block-themed">
        <!-- Alerts Title -->
        <div class="block-title">
            <h4>Alerts</h4>
        </div>
        <!-- END Alerts Title -->

        <!-- Alerts Content -->
        <div class="block-content">
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h4>Success</h4> System was updated successfully!
            </div>
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h4>Info</h4> This is just an info message!
            </div>
            <div class="alert alert-error">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h4>Error</h4> Oops.. Something broke down and wanted to let you know!
            </div>
            <div class="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h4>Warning</h4> Are you sure about this? Because that could happen!
            </div>
        </div>
        <!-- END Alerts Content -->
    </div>
    <!-- END Alerts Block -->

    <!-- Badges and Labels -->
    <div class="block block-themed">
        <!-- Badges and Labels Title -->
        <div class="block-title">
            <h4>Badges and Labels</h4>
        </div>
        <!-- END Badges and Labels Title -->

        <!-- Badges and Labels Content -->
        <div class="block-content full">
            <div class="row-fluid">
                <!-- Badges -->
                <div class="span6">
                    <h4 class="sub-header">Badges</h4>
                    <table class="table table-borderless table-hover">
                        <tbody>
                            <tr>
                                <td><code>.badge</code></td>
                                <td class="text-right"><span class="badge">25</span></td>
                            </tr>
                            <tr>
                                <td><code>.badge</code> <code>.badge-neutral</code></td>
                                <td class="text-right"><span class="badge badge-neutral">15</span></td>
                            </tr>
                            <tr>
                                <td><code>.badge</code> <code>.badge-success</code></td>
                                <td class="text-right"><span class="badge badge-success">95</span></td>
                            </tr>
                            <tr>
                                <td><code>.badge</code> <code>.badge-important</code></td>
                                <td class="text-right"><span class="badge badge-important">24</span></td>
                            </tr>
                            <tr>
                                <td><code>.badge</code> <code>.badge-warning</code></td>
                                <td class="text-right"><span class="badge badge-warning">38</span></td>
                            </tr>
                            <tr>
                                <td><code>.badge</code> <code>.badge-info</code></td>
                                <td class="text-right"><span class="badge badge-info">75</span></td>
                            </tr>
                            <tr>
                                <td><code>.badge</code> <code>.badge-inverse</code></td>
                                <td class="text-right"><span class="badge badge-inverse">64</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- END Badges -->

                <!-- Labels -->
                <div class="span6">
                    <h4 class="sub-header">Labels</h4>
                    <table class="table table-borderless table-hover">
                        <tbody>
                            <tr>
                                <td><code>.label</code></td>
                                <td class="text-right"><span class="label">Default</span></td>
                            </tr>
                            <tr>
                                <td><code>.label</code> <code>.label-neutral</code></td>
                                <td class="text-right"><span class="label label-neutral">Neutral</span></td>
                            </tr>
                            <tr>
                                <td><code>.label</code> <code>.label-success</code></td>
                                <td class="text-right"><span class="label label-success">Success</span></td>
                            </tr>
                            <tr>
                                <td><code>.label</code> <code>.label-important</code></td>
                                <td class="text-right"><span class="label label-important">Important</span></td>
                            </tr>
                            <tr>
                                <td><code>.label</code> <code>.label-warning</code></td>
                                <td class="text-right"><span class="label label-warning">Warning</span></td>
                            </tr>
                            <tr>
                                <td><code>.label</code> <code>.label-info</code></td>
                                <td class="text-right"><span class="label label-info">Information</span></td>
                            </tr>
                            <tr>
                                <td><code>.label</code> <code>.label-inverse</code></td>
                                <td class="text-right"><span class="label label-inverse">Inverse</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- END Labels -->
            </div>
            <div class="row-fluid">
                <!-- Link Badges -->
                <div class="span6">
                    <h4 class="sub-header">Link Badges</h4>
                    <div class="text-center">
                        <a href="javascript:void(0)" class="badge">25</a>
                        <a href="javascript:void(0)" class="badge badge-neutral">15</a>
                        <a href="javascript:void(0)" class="badge badge-success">95</a>
                        <a href="javascript:void(0)" class="badge badge-important">24</a>
                        <a href="javascript:void(0)" class="badge badge-warning">38</a>
                        <a href="javascript:void(0)" class="badge badge-info">75</a>
                        <a href="javascript:void(0)" class="badge badge-inverse">64</a>
                    </div>
                </div>
                <!-- Link Badges -->

                <!-- Link Labels -->
                <div class="span6">
                    <h4 class="sub-header">Link Labels</h4>
                    <div class="text-center">
                        <a href="javascript:void(0)" class="label">Default</a>
                        <a href="javascript:void(0)" class="label label-neutral">Neutral</a>
                        <a href="javascript:void(0)" class="label label-success">Success</a>
                        <a href="javascript:void(0)" class="label label-important">Important</a>
                        <a href="javascript:void(0)" class="label label-warning">Warning</a>
                        <a href="javascript:void(0)" class="label label-info">Information</a>
                        <a href="javascript:void(0)" class="label label-inverse">Inverse</a>
                    </div>
                </div>
                <!-- END Link Labels -->
            </div>
        </div>
        <!-- END Badges and Labels Content -->
    </div>
    <!-- END Badges and Labels Block -->

    <!-- Lists Block -->
    <div class="block block-themed block-last">
        <!-- Lists Title -->
        <div class="block-title">
            <h4>Lists</h4>
        </div>
        <!-- END Lists Title -->

        <!-- Lists Content -->
        <div class="block-content">
            <!-- Common Lists -->
            <h4 class="sub-header">Common Lists</h4>
            <div class="row-fluid">
                <div class="span3">
                    <h4>Ordered</h4>
                    <ol class="list">
                        <li>First item</li>
                        <li>Second item</li>
                        <li>
                            Sublist
                            <ol>
                                <li>First item</li>
                                <li>Second item</li>
                                <li>Third item</li>
                            </ol>
                        </li>
                        <li>Third item</li>
                    </ol>
                </div>
                <div class="span3">
                    <h4>Unordered</h4>
                    <ul class="list">
                        <li>First item</li>
                        <li>Second item</li>
                        <li>Third item</li>
                        <li>
                            Sublist
                            <ul>
                                <li>First item</li>
                                <li>Second item</li>
                                <li>Third item</li>
                            </ul>
                        </li>
                        <li>Third item</li>
                    </ul>
                </div>
                <div class="span3">
                    <h4>Unstyled</h4>
                    <ul class="unstyled list">
                        <li>First item</li>
                        <li>Second item</li>
                        <li>Third item</li>
                        <li>
                            Sublist
                            <ul>
                                <li>First item</li>
                                <li>Second item</li>
                                <li>Third item</li>
                            </ul>
                        </li>
                        <li>Third item</li>
                    </ul>
                </div>
                <div class="span3">
                    <h4>Icon styled <small>Use any icon and color!</small></h4>
                    <ul class="icons-ul list">
                        <li><i class="icon-li icon-ok text-black"></i>First item</li>
                        <li><i class="icon-li icon-ok text-black"></i>Second item</li>
                        <li><i class="icon-li icon-ok text-black"></i>Third item</li>
                        <li>
                            <i class="icon-li icon-ok text-black"></i>Sublist
                            <ul class="icons-ul">
                                <li><i class="icon-li icon-unlock text-success"></i>First item</li>
                                <li><i class="icon-li icon-pencil text-info"></i>Second item</li>
                                <li><i class="icon-li icon-fullscreen text-error"></i>Third item</li>
                            </ul>
                        </li>
                        <li><i class="icon-li icon-ok text-warning"></i>Third item</li>
                    </ul>
                </div>
            </div>
            <!-- END Common Lists -->

            <!-- Description Lists -->
            <h4 class="sub-header">Description Lists</h4>
            <div class="row-fluid">
                <div class="span6">
                    <h4>Default</h4>
                    <dl class="list">
                        <dt>Description lists</dt>
                        <dd>A description list is perfect for defining terms.</dd>
                        <dt>Euismod</dt>
                        <dd>Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>
                        <dd>Donec id elit non mi porta gravida at eget metus.</dd>
                        <dt>Malesuada porta</dt>
                        <dd>Etiam porta sem malesuada magna mollis euismod.</dd>
                    </dl>
                </div>
                <div class="span6">
                    <h4>Horizontal</h4>
                    <dl class="dl-horizontal list">
                        <dt>Description lists</dt>
                        <dd>A description list is perfect for defining terms.</dd>
                        <dt>Euismod</dt>
                        <dd>Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>
                        <dd>Donec id elit non mi porta gravida at eget metus.</dd>
                        <dt>Malesuada porta</dt>
                        <dd>Etiam porta sem malesuada magna mollis euismod.</dd>
                    </dl>
                </div>
            </div>
            <!-- END Description Lists -->
        </div>
        <!-- END Lists Content -->
    </div>
    <!-- END Lists Block -->
</div>
<!-- END Page Content -->

<?php include 'inc/footer.php'; // Footer and scripts ?>

<?php include 'inc/bottom.php'; // Close body and html tags ?>