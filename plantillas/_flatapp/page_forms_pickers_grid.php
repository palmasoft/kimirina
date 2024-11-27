<?php include 'inc/config.php';   // Configuration php file ?>
<?php include 'inc/top.php';      // Meta data and header   ?>
<?php include 'inc/side.php';      // Navigation content     ?>

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-eyedropper themed-color"></i> Pickers &amp; Grid<br><small>Add a class and get your picker!</small></h1>
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
            <a href="#">Forms</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="">Pickers &amp; Grid</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <!-- Color Pickers Block -->
    <div class="block block-themed">
        <!-- Color Pickers Title -->
        <div class="block-title">
            <h4><i class="icon-circle text-info"></i> Color Pickers</h4>
        </div>
        <!-- END Color Pickers Title -->

        <!-- Color Pickers Content -->
        <div class="block-content">
            <form action="page_forms_pickers_grid.php" method="post" class="form-horizontal" onsubmit="return false;">
                <div class="control-group">
                    <label class="control-label" for="input-colorpicker">Default</label>
                    <div class="controls">
                        <input type="text" id="input-colorpicker" name="input-colorpicker" class="input-mini input-colorpicker">
                        <span class="help-inline"><code>.input-colorpicker</code></span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="input-colorpicker-comp">As a component</label>
                    <div class="controls">
                        <div class="input-append input-colorpicker color" data-color="#0072bc">
                            <input type="text" id="input-colorpicker-comp" name="input-colorpicker-comp" class="input-mini">
                            <span class="add-on"><i style="background-color: #0072bc"></i></span>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="input-colorpicker-rgba">RGBa</label>
                    <div class="controls">
                        <div class="input-append input-colorpicker color" data-color="rgba(0,0,0,1)" data-color-format="rgba">
                            <input type="text" id="input-colorpicker-rgba" name="input-colorpicker-rgba">
                            <span class="add-on"><i style="background-color: rgba(0,0,0,1)"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Reset</button>
                    <button type="submit" class="btn btn-success"><i class="icon-ok"></i> Submit</button>
                </div>
            </form>
        </div>
        <!-- END Color Pickers Content -->
    </div>
    <!-- END Color Pickers Block -->

    <!-- Time and Date Pickers Block -->
    <div class="block block-themed">
        <!-- Time and Date Pickers Title -->
        <div class="block-title">
            <h4><i class="icon-time"></i> Time and Date Pickers</h4>
        </div>
        <!-- END Time and Date Pickers Title -->

        <!-- Time and Date Pickers Content -->
        <div class="block-content">
            <form action="page_forms_pickers_grid.php" method="post" class="form-horizontal" onsubmit="return false;">
                <div class="control-group">
                    <label class="control-label" for="input-timepicker">Time</label>
                    <div class="controls">
                        <div class="input-append bootstrap-timepicker">
                            <input type="text" id="input-timepicker" name="input-timepicker" class="input-mini input-timepicker">
                            <span class="add-on"><i class="icon-time"></i></span>
                            <span class="help-inline"><code>.input-timepicker</code></span>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="input-datepicker">Date</label>
                    <div class="controls">
                        <input type="text" id="input-datepicker" name="input-datepicker" class="input-small input-datepicker">
                        <span class="help-inline"><code>.input-datepicker</code></span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="input-datepicker-comp">Date as a component</label>
                    <div class="controls">
                        <div class="input-append date input-datepicker" data-date="14-06-2013" data-date-format="dd-mm-yyyy">
                            <input type="text" id="input-datepicker-comp" name="input-datepicker-comp" class="input-small">
                            <span class="add-on"><i class="icon-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="input-daterangepicker">Date Range</label>
                    <div class="controls">
                        <div class="input-append">
                            <input type="text" id="input-daterangepicker" name="input-daterangepicker" class="input-daterangepicker">
                            <span class="add-on"><i class="icon-calendar"></i></span>
                            <span class="help-inline"><code>.input-daterangepicker</code></span>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Advanced Date Range</label>
                    <div class="controls">
                        <div id="example-advanced-daterangepicker" class="btn btn-info">
                            <i class="icon-calendar"></i>
                            <span></span>
                            <b class="caret"></b>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Reset</button>
                    <button type="submit" class="btn btn-success"><i class="icon-ok"></i> Submit</button>
                </div>
            </form>
        </div>
        <!-- END Time and Date Pickers Content -->
    </div>
    <!-- END Time and Date Pickers Block -->

    <!-- Input Grid Block -->
    <div class="block block-themed block-last">
        <!-- Input Grid Title -->
        <div class="block-title">
            <h4><i class="icon-th"></i> Input Grid <small>Use multiple inputs in the same row</small></h4>
        </div>
        <!-- END Input Grid Title -->

        <!-- Input Grid Content -->
        <div class="block-content">
            <form action="page_forms_pickers_grid.php" method="post" class="form-inline" onsubmit="return false;">
                <div class="control-group">
                    <label class="control-label">Label #1</label>
                    <div class="controls controls-row">
                        <input type="text" class="span1" placeholder=".span1">
                        <input type="text" class="span5" placeholder=".span5">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Label #2</label>
                    <div class="controls controls-row">
                        <input type="text" class="span2" placeholder=".span2">
                        <input type="text" class="span4" placeholder=".span4">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Label #3</label>
                    <div class="controls controls-row">
                        <input type="text" class="span3" placeholder=".span3">
                        <input type="text" class="span3" placeholder=".span3">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Label #4</label>
                    <div class="controls controls-row">
                        <input type="text" class="span4" placeholder=".span4">
                        <input type="text" class="span2" placeholder=".span2">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Label #5</label>
                    <div class="controls controls-row">
                        <input type="text" class="span5" placeholder=".span5">
                        <input type="text" class="span1" placeholder=".span1">
                    </div>
                </div>
                <div class="form-actions">
                    <button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Reset</button>
                    <button type="submit" class="btn btn-success"><i class="icon-ok"></i> Submit</button>
                </div>
            </form>
        </div>
        <!-- END Input Grid Content -->
    </div>
    <!-- END Input Grid Block -->
</div>
<!-- END Page Content -->

<?php include 'inc/footer.php'; // Footer and scripts ?>

<?php include 'inc/bottom.php'; // Close body and html tags ?>