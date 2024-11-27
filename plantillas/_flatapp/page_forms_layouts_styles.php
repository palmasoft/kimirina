<?php include 'inc/config.php';   // Configuration php file ?>
<?php include 'inc/top.php';      // Meta data and header   ?>
<?php include 'inc/side.php';      // Navigation content     ?>

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-show_thumbnails_with_lines themed-color"></i> Layouts &amp; Styles<br><small>Create your form the way you want!</small></h1>
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
        <li class="active"><a href="">Layouts &amp; Styles</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <!-- Horizontal Form Block -->
    <div class="block block-themed">
        <!-- Horizontal Form Title -->
        <div class="block-title">
            <h4>Horizontal Form <small><code>.form-horizontal</code></small></h4>
        </div>
        <!-- END Horizontal Form Title -->

        <!-- Horizontal Form Content -->
        <div class="block-content">
            <form action="page_forms_layouts_styles.php" method="post" class="form-horizontal" onsubmit="return false;">
                <div class="control-group">
                    <label class="control-label" for="horizontal-text">Username</label>
                    <div class="controls">
                        <input type="text" id="horizontal-text" name="horizontal-text">
                        <span class="help-block">Your username must be unique..</span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="horizontal-password">Password</label>
                    <div class="controls">
                        <input type="password" id="horizontal-password" name="horizontal-password">
                        <span class="help-block">..and your password hard to guess!</span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="horizontal-textarea">Textarea</label>
                    <div class="controls">
                        <textarea id="horizontal-textarea" name="horizontal-textarea" rows="6">...</textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="horizontal-select">Select</label>
                    <div class="controls">
                        <select name="horizontal-select" id="horizontal-select" size="1">
                            <option value="0">Please select</option>
                            <option value="1">Option #1</option>
                            <option value="2">Option #2</option>
                            <option value="3">Option #3</option>
                        </select>
                        <span class="help-block">Choose an option</span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Radios</label>
                    <div class="controls">
                        <label class="radio inline" for="horizontal-radio1">
                            <input type="radio" id="horizontal-radio1" name="horizontal-radios" value="option1"> Radio 1
                        </label>
                        <label class="radio inline" for="horizontal-radio2">
                            <input type="radio" id="horizontal-radio2" name="horizontal-radios" value="option2"> Radio 2
                        </label>
                        <label class="radio inline" for="horizontal-radio3">
                            <input type="radio" id="horizontal-radio3" name="horizontal-radios" value="option3"> Radio 3
                        </label>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Checkboxes</label>
                    <div class="controls">
                        <label class="checkbox inline" for="horizontal-checkbox1">
                            <input type="checkbox" id="horizontal-checkbox1" name="horizontal-checkbox1" value="option1"> Checkbox 1
                        </label>
                        <label class="checkbox inline" for="horizontal-checkbox2">
                            <input type="checkbox" id="horizontal-checkbox2" name="horizontal-checkbox2" value="option2"> Checkbox 2
                        </label>
                        <label class="checkbox inline" for="horizontal-checkbox3">
                            <input type="checkbox" id="horizontal-checkbox3" name="horizontal-checkbox3" value="option3"> Checkbox 3
                        </label>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Reset</button>
                    <button type="submit" class="btn btn-success"><i class="icon-ok"></i> Submit</button>
                </div>
            </form>
        </div>
        <!-- END Horizontal Form Content -->
    </div>
    <!-- END Horizontal Form Block -->

    <!-- Inline Form Block -->
    <div class="block block-themed">
        <!-- Inline Form Title -->
        <div class="block-title">
            <h4>Inline Form <small><code>.form-inline</code></small></h4>
        </div>
        <!-- END Inline Form Title -->

        <!-- Inline Form Content -->
        <div class="block-content">
            <form action="page_forms_layouts_styles.php" method="post" class="form-inline" onsubmit="return false;">
                <div class="control-group">
                    <label class="control-label" for="inline-text">Username</label>
                    <div class="controls">
                        <input type="text" id="inline-text" name="inline-text">
                        <span class="help-block">Your username must be unique..</span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inline-password">Password</label>
                    <div class="controls">
                        <input type="password" id="inline-password" name="inline-password">
                        <span class="help-block">..and your password hard to guess!</span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inline-textarea">Textarea</label>
                    <div class="controls">
                        <textarea id="inline-textarea" name="inline-textarea" rows="6">...</textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inline-select">Select</label>
                    <div class="controls">
                        <select name="inline-select" id="inline-select" size="1">
                            <option value="0">Please select</option>
                            <option value="1">Option #1</option>
                            <option value="2">Option #2</option>
                            <option value="3">Option #3</option>
                        </select>
                        <span class="help-block">Choose an option</span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Radios</label>
                    <div class="controls">
                        <label class="radio inline" for="inline-radio1">
                            <input type="radio" id="inline-radio1" name="inline-radios" value="option1"> Radio 1
                        </label>
                        <label class="radio inline" for="inline-radio2">
                            <input type="radio" id="inline-radio2" name="inline-radios" value="option2"> Radio 2
                        </label>
                        <label class="radio inline" for="inline-radio3">
                            <input type="radio" id="inline-radio3" name="inline-radios" value="option3"> Radio 3
                        </label>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Checkboxes</label>
                    <div class="controls">
                        <label class="checkbox inline" for="inline-checkbox1">
                            <input type="checkbox" id="inline-checkbox1" name="inline-checkbox1" value="option1"> Checkbox 1
                        </label>
                        <label class="checkbox inline" for="inline-checkbox2">
                            <input type="checkbox" id="inline-checkbox2" name="inline-checkbox2" value="option2"> Checkbox 2
                        </label>
                        <label class="checkbox inline" for="inline-checkbox3">
                            <input type="checkbox" id="inline-checkbox3" name="inline-checkbox3" value="option3"> Checkbox 3
                        </label>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Reset</button>
                    <button type="submit" class="btn btn-success"><i class="icon-ok"></i> Submit</button>
                </div>
            </form>
        </div>
        <!-- END Inline Form Content -->
    </div>
    <!-- END Inline Form Block -->

    <!-- Two Column Form Block -->
    <div class="block block-themed">
        <!-- Two Column Form Title -->
        <div class="block-title">
            <h4>Two Column Form <small>Put it in the grid!</small></h4>
        </div>
        <!-- END Two Column Form Title -->

        <!-- Two Column Form Content -->
        <div class="block-content">
            <form action="page_forms_layouts_styles.php" method="post" class="form-inline" onsubmit="return false;">
                <!-- div.row-fluid -->
                <div class="row-fluid">
                    <!-- 1st Column -->
                    <div class="span6">
                        <div class="control-group">
                            <label class="control-label" for="columns-text">Username</label>
                            <div class="controls">
                                <input type="text" id="columns-text" name="columns-text">
                                <span class="help-block">Your username must be unique..</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="columns-password">Password</label>
                            <div class="controls">
                                <input type="password" id="columns-password" name="columns-password">
                                <span class="help-block">..and your password hard to guess!</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="columns-select">Select</label>
                            <div class="controls">
                                <select name="columns-select" id="columns-select" size="1">
                                    <option value="0">Please select</option>
                                    <option value="1">Option #1</option>
                                    <option value="2">Option #2</option>
                                    <option value="3">Option #3</option>
                                </select>
                                <span class="help-block">Choose an option</span>
                            </div>
                        </div>
                    </div>
                    <!-- END 1st Column -->

                    <!-- 2nd Column -->
                    <div class="span6">
                        <div class="control-group">
                            <label class="control-label" for="columns-textarea">Textarea</label>
                            <div class="controls">
                                <textarea id="columns-textarea" name="inline-textarea" rows="6">...</textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Radios</label>
                            <div class="controls">
                                <label class="radio inline" for="columns-radio1">
                                    <input type="radio" id="columns-radio1" name="columns-radios" value="option1"> Radio 1
                                </label>
                                <label class="radio inline" for="columns-radio2">
                                    <input type="radio" id="columns-radio2" name="columns-radios" value="option2"> Radio 2
                                </label>
                                <label class="radio inline" for="columns-radio3">
                                    <input type="radio" id="columns-radio3" name="columns-radios" value="option3"> Radio 3
                                </label>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Checkboxes</label>
                            <div class="controls">
                                <label class="checkbox inline" for="columns-checkbox1">
                                    <input type="checkbox" id="columns-checkbox1" name="columns-checkbox1" value="option1"> Checkbox 1
                                </label>
                                <label class="checkbox inline" for="columns-checkbox2">
                                    <input type="checkbox" id="columns-checkbox2" name="columns-checkbox2" value="option2"> Checkbox 2
                                </label>
                                <label class="checkbox inline" for="columns-checkbox3">
                                    <input type="checkbox" id="columns-checkbox3" name="columns-checkbox3" value="option3"> Checkbox 3
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- END 2nd Column -->
                </div>
                <!-- END div.row-fluid -->
                <div class="form-actions">
                    <button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Reset</button>
                    <button type="submit" class="btn btn-success"><i class="icon-ok"></i> Submit</button>
                </div>
            </form>
        </div>
        <!-- END Two Column Form Content -->
    </div>
    <!-- END Two Column Form Block -->

    <!-- Bordered Form Block -->
    <div class="block block-themed">
        <!-- Bordered Form Title -->
        <div class="block-title">
            <h4>Bordered Form <small><code>.form-horizontal</code> <code>.form-bordered</code></small></h4>
        </div>
        <!-- END Bordered Form Title -->

        <!-- Bordered Form Content -->
        <div class="block-content block-content-flat">
            <form action="page_forms_layouts_styles.php" method="post" class="form-horizontal form-bordered" onsubmit="return false;">
                <div class="control-group">
                    <label class="control-label" for="bordered-text">Username</label>
                    <div class="controls">
                        <input type="text" id="bordered-text" name="bordered-text">
                        <span class="help-block">Your username must be unique..</span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="bordered-password">Password</label>
                    <div class="controls">
                        <input type="password" id="bordered-password" name="bordered-password">
                        <span class="help-block">..and your password hard to guess!</span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="bordered-textarea">Textarea</label>
                    <div class="controls">
                        <textarea id="bordered-textarea" name="bordered-textarea" rows="6">...</textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="bordered-select">Select</label>
                    <div class="controls">
                        <select name="bordered-select" id="bordered-select" size="1">
                            <option value="0">Please select</option>
                            <option value="1">Option #1</option>
                            <option value="2">Option #2</option>
                            <option value="3">Option #3</option>
                        </select>
                        <span class="help-block">Choose an option</span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Radios</label>
                    <div class="controls">
                        <label class="radio inline" for="bordered-radio1">
                            <input type="radio" id="bordered-radio1" name="bordered-radios" value="option1"> Radio 1
                        </label>
                        <label class="radio inline" for="bordered-radio2">
                            <input type="radio" id="bordered-radio2" name="bordered-radios" value="option2"> Radio 2
                        </label>
                        <label class="radio inline" for="bordered-radio3">
                            <input type="radio" id="bordered-radio3" name="bordered-radios" value="option3"> Radio 3
                        </label>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Checkboxes</label>
                    <div class="controls">
                        <label class="checkbox inline" for="bordered-checkbox1">
                            <input type="checkbox" id="bordered-checkbox1" name="bordered-checkbox1" value="option1"> Checkbox 1
                        </label>
                        <label class="checkbox inline" for="bordered-checkbox2">
                            <input type="checkbox" id="bordered-checkbox2" name="bordered-checkbox2" value="option2"> Checkbox 2
                        </label>
                        <label class="checkbox inline" for="bordered-checkbox3">
                            <input type="checkbox" id="bordered-checkbox3" name="bordered-checkbox3" value="option3"> Checkbox 3
                        </label>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Reset</button>
                    <button type="submit" class="btn btn-success"><i class="icon-ok"></i> Submit</button>
                </div>
            </form>
        </div>
        <!-- END Bordered Form Content -->
    </div>
    <!-- END Bordered Form Block -->

    <!-- Bordered with Labels Colored Form Block -->
    <div class="block block-themed block-last">
        <!-- Bordered with Labels Colored Form Title -->
        <div class="block-title">
            <h4>Bordered with Labels Colored Form <small><code>.form-horizontal</code> <code>.form-bordered</code> <code>.form-labels</code></small></h4>
        </div>
        <!-- END Bordered with Labels Colored Form Title -->

        <!-- Bordered with Labels Colored Form Content -->
        <div class="block-content block-content-flat">
            <form action="page_forms_layouts_styles.php" method="post" class="form-horizontal form-bordered form-labels" onsubmit="return false;">
                <div class="control-group">
                    <label class="control-label" for="labels-text">Username</label>
                    <div class="controls">
                        <input type="text" id="labels-text" name="labels-text">
                        <span class="help-block">Your username must be unique..</span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="labels-password">Password</label>
                    <div class="controls">
                        <input type="password" id="labels-password" name="labels-password">
                        <span class="help-block">..and your password hard to guess!</span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="labels-textarea">Textarea</label>
                    <div class="controls">
                        <textarea id="labels-textarea" name="labels-textarea" rows="6">...</textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="labels-select">Select</label>
                    <div class="controls">
                        <select name="labels-select" id="labels-select" size="1">
                            <option value="0">Please select</option>
                            <option value="1">Option #1</option>
                            <option value="2">Option #2</option>
                            <option value="3">Option #3</option>
                        </select>
                        <span class="help-block">Choose an option</span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Radios</label>
                    <div class="controls">
                        <label class="radio inline" for="labels-radio1">
                            <input type="radio" id="labels-radio1" name="labels-radios" value="option1"> Radio 1
                        </label>
                        <label class="radio inline" for="labels-radio2">
                            <input type="radio" id="labels-radio2" name="labels-radios" value="option2"> Radio 2
                        </label>
                        <label class="radio inline" for="labels-radio3">
                            <input type="radio" id="labels-radio3" name="labels-radios" value="option3"> Radio 3
                        </label>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Checkboxes</label>
                    <div class="controls">
                        <label class="checkbox inline" for="labels-checkbox1">
                            <input type="checkbox" id="labels-checkbox1" name="labels-checkbox1" value="option1"> Checkbox 1
                        </label>
                        <label class="checkbox inline" for="labels-checkbox2">
                            <input type="checkbox" id="labels-checkbox2" name="labels-checkbox2" value="option2"> Checkbox 2
                        </label>
                        <label class="checkbox inline" for="labels-checkbox3">
                            <input type="checkbox" id="labels-checkbox3" name="labels-checkbox3" value="option3"> Checkbox 3
                        </label>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Reset</button>
                    <button type="submit" class="btn btn-success"><i class="icon-ok"></i> Submit</button>
                </div>
            </form>
        </div>
        <!-- END Bordered with Labels Colored Form Content -->
    </div>
    <!-- END Bordered with Labels Colored Form Block -->
</div>
<!-- END Page Content -->

<?php include 'inc/footer.php'; // Footer and scripts ?>

<?php include 'inc/bottom.php'; // Close body and html tags ?>