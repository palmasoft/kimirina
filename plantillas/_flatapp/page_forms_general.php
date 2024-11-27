<?php include 'inc/config.php';   // Configuration php file ?>
<?php include 'inc/top.php';      // Meta data and header   ?>
<?php include 'inc/side.php';      // Navigation content     ?>

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-nameplate_alt themed-color"></i> General Forms<br><small>All the elements you need!</small></h1>
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
        <li class="active"><a href="">General</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <!-- General Forms Block -->
    <div class="block block-themed block-last">
        <!-- General Forms Title -->
        <div class="block-title">
            <h4>General Form Elements &amp; Components</h4>
        </div>
        <!-- END General Forms Title -->

        <!-- General Forms Content -->
        <div class="block-content">
            <form action="page_forms_general.php" method="post" class="form-horizontal" onsubmit="return false;">
                <!-- Default Inputs -->
                <h4 class="sub-header">Default Inputs</h4>
                <div class="control-group">
                    <label class="control-label" for="general-text">Username</label>
                    <div class="controls">
                        <input type="text" id="general-text" name="general-text">
                        <span class="help-block">Your username must be unique..</span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="general-password">Password</label>
                    <div class="controls">
                        <input type="password" id="general-password" name="general-password">
                        <span class="help-block">..and your password hard to guess!</span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="general-placeholder">Placeholder</label>
                    <div class="controls">
                        <input type="text" id="general-placeholder" name="general-placeholder" placeholder="placeholder..">
                        <span class="help-block">Placeholder attribute also works with older browsers!</span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="general-inline-input1">Inline</label>
                    <div class="controls">
                        <input type="text" id="general-inline-input1" name="general-inline-input1" class="input-small">
                        <input type="text" id="general-inline-input2" name="general-inline-input2" class="input-small">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Disabled</label>
                    <div class="controls">
                        <input type="text" id="general-uneditable" name="general-uneditable" class="input-xlarge uneditable-input" disabled>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="general-textarea">Textarea</label>
                    <div class="controls">
                        <textarea id="general-textarea" name="general-textarea" class="textarea-medium" rows="6">...</textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="general-select">Select</label>
                    <div class="controls">
                        <select id="general-select" name="general-select" size="1">
                            <option value="0">Please select</option>
                            <option value="1">Option #1</option>
                            <option value="2">Option #2</option>
                            <option value="3">Option #3</option>
                        </select>
                        <span class="help-block">This is the default select box</span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="general-select">Multiple select</label>
                    <div class="controls">
                        <select id="general-multiple-select" name="general-multiple-select" size="5" multiple>
                            <option value="1">Option #1</option>
                            <option value="2">Option #2</option>
                            <option value="3">Option #3</option>
                            <option value="4">Option #4</option>
                            <option value="5">Option #5</option>
                            <option value="6">Option #6</option>
                            <option value="7">Option #7</option>
                            <option value="8">Option #8</option>
                            <option value="9">Option #9</option>
                            <option value="10">Option #10</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Radios</label>
                    <div class="controls">
                        <label class="radio" for="general-radio1">
                            <input type="radio" id="general-radio1" name="general-radios" value="option1"> Radio 1
                        </label>
                        <label class="radio" for="general-radio2">
                            <input type="radio" id="general-radio2" name="general-radios" value="option2"> Radio 2
                        </label>
                        <label class="radio" for="general-radio3">
                            <input type="radio" id="general-radio3" name="general-radios" value="option3"> Radio 3
                        </label>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Inline Radios</label>
                    <div class="controls">
                        <label class="radio inline" for="general-inline-radio1">
                            <input type="radio" id="general-inline-radio1" name="general-inline-radios" value="option1"> Radio 1
                        </label>
                        <label class="radio inline" for="general-inline-radio2">
                            <input type="radio" id="general-inline-radio2" name="general-inline-radios" value="option1"> Radio 2
                        </label>
                        <label class="radio inline" for="general-inline-radio3">
                            <input type="radio" id="general-inline-radio3" name="general-inline-radios" value="option1"> Radio 3
                        </label>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Checkboxes</label>
                    <div class="controls">
                        <label class="checkbox" for="general-checkbox1">
                            <input type="checkbox" id="general-checkbox1" name="general-checkbox1" value="option1"> Checkbox 1
                        </label>
                        <label class="checkbox" for="general-checkbox2">
                            <input type="checkbox" id="general-checkbox2" name="general-checkbox2" value="option2"> Checkbox 2
                        </label>
                        <label class="checkbox" for="general-checkbox3">
                            <input type="checkbox" id="general-checkbox3" name="general-checkbox3" value="option3"> Checkbox 3
                        </label>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Inline Checkboxes</label>
                    <div class="controls">
                        <label class="checkbox inline" for="general-inline-checkbox1">
                            <input type="checkbox" id="general-inline-checkbox1" name="general-inline-checkbox1" value="option1"> Checkbox 1
                        </label>
                        <label class="checkbox inline" for="general-inline-checkbox2">
                            <input type="checkbox" id="general-inline-checkbox2" name="general-inline-checkbox2" value="option2"> Checkbox 2
                        </label>
                        <label class="checkbox inline" for="general-inline-checkbox3">
                            <input type="checkbox" id="general-inline-checkbox3" name="general-inline-checkbox3" value="option3"> Checkbox 3
                        </label>
                    </div>
                </div>
                <!-- END Default Inputs -->

                <!-- Input Sizes -->
                <h4 class="sub-header">Input Sizes</h4>
                <div class="control-group">
                    <label class="control-label" for="general-input-mini">Mini</label>
                    <div class="controls">
                        <input type="text" id="general-input-mini" name="general-input-mini" class="input-mini">
                        <span class="help-inline"><code>.input-mini</code></span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="general-input-small">Small</label>
                    <div class="controls">
                        <input type="text" id="general-input-small" name="general-input-small" class="input-small">
                        <span class="help-inline"><code>.input-small</code></span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="general-input-medium">Medium</label>
                    <div class="controls">
                        <input type="text" id="general-input-medium" name="general-input-medium" class="input-medium">
                        <span class="help-inline"><code>.input-medium</code></span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="general-input-large">Large</label>
                    <div class="controls">
                        <input type="text" id="general-input-large" name="general-input-large" class="input-large">
                        <span class="help-inline"><code>.input-large</code></span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="general-input-xlarge">xLarge</label>
                    <div class="controls">
                        <input type="text" id="general-input-xlarge" name="general-input-xlarge" class="input-xlarge">
                        <span class="help-inline"><code>.input-xlarge</code></span>
                    </div>
                </div>
                <!-- END Input Sizes -->

                <!-- Prepend Content -->
                <h4 class="sub-header">Prepend Content</h4>
                <div class="control-group">
                    <label class="control-label" for="general-prepend1">Static Content</label>
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on">Firstname</span>
                            <input type="text" id="general-prepend1" name="general-prepend1" class="input-small">
                        </div>
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-twitter"></i></span>
                            <input type="text" id="general-prepend2" name="general-prepend2" class="input-small" placeholder="@username">
                        </div>
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-facebook"></i></span>
                            <input type="text" id="general-prepend3" name="general-prepend3" class="input-small" placeholder="@username">
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="general-prepend4">Buttons</label>
                    <div class="controls">
                        <div class="input-prepend">
                            <button class="btn">Search</button>
                            <input type="text" id="general-prepend4" name="general-prepend4" class="input-small" placeholder="username">
                        </div>
                        <div class="input-prepend">
                            <button class="btn"><i class="icon-search"></i></button>
                            <input type="text" id="general-prepend5" name="general-prepend5" class="input-small" placeholder="search..">
                        </div>
                        <div class="input-prepend">
                            <button class="btn btn-primary"><i class="icon-facebook"></i></button>
                            <button class="btn btn-info"><i class="icon-twitter"></i></button>
                            <button class="btn btn-danger hidden-phone"><i class="icon-pinterest"></i></button>
                            <input type="text" id="general-prepend6" name="general-prepend6" class="input-small" placeholder="@username">
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="general-prepend7">Buttons and Dropdowns</label>
                    <div class="controls">
                        <div class="input-prepend">
                            <div class="btn-group">
                                <button class="btn dropdown-toggle" data-toggle="dropdown">
                                    Action
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="javascript:void(0)">Option 1</a></li>
                                    <li><a href="javascript:void(0)">Option 2</a></li>
                                    <li><a href="javascript:void(0)">Option 3</a></li>
                                </ul>
                            </div>
                            <input id="general-prepend7" name="general-prepend7" type="text" placeholder="...">
                        </div>
                        <div class="input-prepend">
                            <div class="btn-group">
                                <button class="btn btn-primary"><i class="icon-facebook"></i></button>
                                <button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="javascript:void(0)"><i class="icon-twitter"></i> Twitter</a></li>
                                    <li><a href="javascript:void(0)"><i class="icon-google-plus"></i> Google Plus+</a></li>
                                    <li><a href="javascript:void(0)"><i class="icon-linkedin"></i> Linkedin</a></li>
                                    <li><a href="javascript:void(0)"><i class="icon-pinterest"></i> Pinterest</a></li>
                                </ul>
                            </div>
                            <input id="general-prepend8" name="general-prepend8" type="text" placeholder="@username">
                        </div>
                    </div>
                </div>
                <!-- END Prepend Content -->

                <!-- Append Content -->
                <h4 class="sub-header">Append Content</h4>
                <div class="control-group">
                    <label class="control-label" for="general-append1">Static Content</label>
                    <div class="controls">
                        <div class="input-append">
                            <input type="text" id="general-append1" name="general-append1" class="input-small">
                            <span class="add-on">Firstname</span>
                        </div>
                        <div class="input-append">
                            <input type="text" id="general-append2" name="general-append2" class="input-small" placeholder="@username">
                            <span class="add-on"><i class="icon-twitter"></i></span>
                        </div>
                        <div class="input-append">
                            <input type="text" id="general-append3" name="general-append3" class="input-small" placeholder="@username">
                            <span class="add-on"><i class="icon-facebook"></i></span>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="general-append4">Buttons</label>
                    <div class="controls">
                        <div class="input-append">
                            <input type="text" id="general-append4" name="general-append4" class="input-small" placeholder="username">
                            <button class="btn">Search</button>
                        </div>
                        <div class="input-append">
                            <input type="text" id="general-append5" name="general-append5" class="input-small" placeholder="search..">
                            <button class="btn"><i class="icon-search"></i></button>
                        </div>
                        <div class="input-append">
                            <input type="text" id="general-append6" name="general-append6" class="input-small" placeholder="@username">
                            <button class="btn btn-primary"><i class="icon-facebook"></i></button>
                            <button class="btn btn-info"><i class="icon-twitter"></i></button>
                            <button class="btn btn-danger hidden-phone"><i class="icon-pinterest"></i></button>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="general-append7">Buttons and Dropdowns</label>
                    <div class="controls">
                        <div class="input-append">
                            <input id="general-append7" name="general-append7" type="text" placeholder="...">
                            <div class="btn-group">
                                <button class="btn dropdown-toggle" data-toggle="dropdown">
                                    Action
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="javascript:void(0)">Option 1</a></li>
                                    <li><a href="javascript:void(0)">Option 2</a></li>
                                    <li><a href="javascript:void(0)">Option 3</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="input-append">
                            <input id="general-append8" name="general-append8" type="text" placeholder="@username">
                            <div class="btn-group">
                                <button class="btn btn-primary"><i class="icon-facebook"></i></button>
                                <button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="javascript:void(0)"><i class="icon-twitter"></i> Twitter</a></li>
                                    <li><a href="javascript:void(0)"><i class="icon-google-plus"></i> Google Plus+</a></li>
                                    <li><a href="javascript:void(0)"><i class="icon-linkedin"></i> Linkedin</a></li>
                                    <li><a href="javascript:void(0)"><i class="icon-pinterest"></i> Pinterest</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Append Content -->

                <!-- Prepend and Append Content -->
                <h4 class="sub-header">Prepend &amp; Append Content</h4>
                <div class="control-group">
                    <label class="control-label" for="general-preapppend1">Static Content</label>
                    <div class="controls">
                        <div class="input-prepend input-append">
                            <span class="add-on">$</span>
                            <input type="text" id="general-preapppend1" name="general-preapppend1" class="input-mini text-right" placeholder="00">
                            <span class="add-on">.00</span>
                        </div>
                        <div class="input-prepend input-append">
                            <span class="add-on"><i class="icon-facebook"></i></span>
                            <input type="text" id="general-preapppend2" name="general-preapppend2" class="input-small" placeholder="@username">
                            <span class="add-on"><i class="icon-user"></i></span>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="general-preapppend3">Buttons</label>
                    <div class="controls">
                        <div class="input-prepend input-append">
                            <button class="btn"><i class="icon-pencil"></i></button>
                            <input type="text" id="general-preapppend3" name="general-preapppend3" class="input-small" placeholder="Filename">
                            <button class="btn"><i class="icon-cloud-upload"></i></button>
                        </div>
                        <div class="input-prepend input-append">
                            <button class="btn btn-primary"><i class="icon-facebook"></i></button>
                            <input type="text" id="general-preapppend4" name="general-preapppend4" class="input-small text-center" placeholder="@username">
                            <button class="btn btn-info"><i class="icon-twitter"></i></button>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="general-preapppend5">Buttons and Dropdowns</label>
                    <div class="controls">
                        <div class="input-prepend input-append">
                            <div class="btn-group">
                                <button class="btn dropdown-toggle" data-toggle="dropdown"><span class="hidden-phone">Action</span> <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="javascript:void(0)">Edit</a></li>
                                    <li><a href="javascript:void(0)">Delete</a></li>
                                </ul>
                            </div>
                            <input type="text" id="general-preapppend5" name="general-preapppend5" class="input-small" placeholder="@username">
                            <button class="btn btn-warning"><i class="icon-warning-sign"></i></button>
                        </div>
                        <div class="input-prepend input-append">
                            <button class="btn btn-primary"><i class="icon-facebook"></i></button>
                            <input type="text" id="general-preapppend6" name="general-preapppend6" class="input-small" placeholder="@username">
                            <div class="btn-group">
                                <button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="javascript:void(0)"><i class="icon-twitter"></i> Twitter</a></li>
                                    <li><a href="javascript:void(0)"><i class="icon-google-plus"></i> Google Plus+</a></li>
                                    <li><a href="javascript:void(0)"><i class="icon-linkedin"></i> Linkedin</a></li>
                                    <li><a href="javascript:void(0)"><i class="icon-pinterest"></i> Pinterest</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Prepend and Append Content -->

                <!-- Form Components, classes initialized in main.js -->
                <h4 class="sub-header">Components</h4>
                <div class="control-group">
                    <label class="control-label" for="general-typeahead">Typeahead</label>
                    <div class="controls">
                        <input type="text" id="general-typeahead" name="general-typeahead" class="example-typeahead" placeholder="Search..">
                        <span class="help-block">Autocomplete example</span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="general-chosen">Chosen Select</label>
                    <div class="controls">
                        <select id="general-chosen" name="general-chosen" class="select-chosen">
                            <option value="html">html</option>
                            <option value="css">css</option>
                            <option value="javascript">javascript</option>
                            <option value="php">php</option>
                            <option value="mysql">mysql</option>
                        </select>
                        <span class="help-block"><code>.select-chosen</code></span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="general-chosen-multiple">Chosen Select Multiple</label>
                    <div class="controls">
                        <select id="general-chosen-multiple" name="general-chosen-multiple" class="select-chosen" multiple>
                            <option value="html" selected>html</option>
                            <option value="css">css</option>
                            <option value="javascript">javascript</option>
                            <option value="php">php</option>
                            <option value="mysql">mysql</option>
                        </select>
                        <span class="help-block"><code>.select-chosen</code></span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Themed Checkboxes</label>
                    <div class="controls">
                        <label for="general-themed-checkbox1">
                            <input type="checkbox" id="general-themed-checkbox1" name="general-themed-checkbox1" class="input-themed" value="option1"> Checkbox 1
                        </label>
                        <label for="general-themed-checkbox2">
                            <input type="checkbox" id="general-themed-checkbox2" name="general-themed-checkbox2" class="input-themed" value="option2"> Checkbox 2
                        </label>
                        <label for="general-themed-checkbox3">
                            <input type="checkbox" id="general-themed-checkbox3" name="general-themed-checkbox3" class="input-themed" value="option3"> Checkbox 3
                        </label>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Themed Radios</label>
                    <div class="controls">
                        <label for="general-themed-radio1">
                            <input type="radio" id="general-themed-radio1" name="general-radios" class="input-themed" value="option1"> Radio 1
                        </label>
                        <label for="general-themed-radio2">
                            <input type="radio" id="general-themed-radio2" name="general-radios" class="input-themed" value="option2"> Radio 2
                        </label>
                        <label for="general-themed-radio3">
                            <input type="radio" id="general-themed-radio3" name="general-radios" class="input-themed" value="option3"> Radio 3
                        </label>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Horizontal Sliders</label>
                    <div class="controls">
                        <input type="text" id="general-slider" name="general-slider" class="slider" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="1" data-slider-orientation="horizontal" data-slider-selection="before" data-slider-tooltip="show" data-slider-handle="square">
                    </div>
                    <div class="controls">
                        <input type="text" id="general-slider2" name="general-slider2" class="slider" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="50" data-slider-orientation="horizontal" data-slider-selection="before" data-slider-tooltip="hide" data-slider-handle="round">
                    </div>
                    <div class="controls">
                        <input type="text" id="general-slider3" name="general-slider3" class="slider" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="100" data-slider-orientation="horizontal" data-slider-selection="before" data-slider-tooltip="hide" data-slider-handle="triangle">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Vertical Slider</label>
                    <div class="controls">
                        <input type="text" id="general-slider4" name="general-slider4" class="slider" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="50" data-slider-orientation="vertical" data-slider-selection="after" data-slider-tooltip="hide" data-slider-handle="square">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Range Slider</label>
                    <div class="controls">
                        <input type="text" id="general-slider5" name="general-slider5" class="slider" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="[25,75]" data-slider-orientation="horizontal" data-slider-selection="after" data-slider-tooltip="show" data-slider-handle="square">
                    </div>
                </div>
                <!-- END Form Components -->

                <!-- Form Buttons -->
                <div class="form-actions">
                    <button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Reset</button>
                    <button type="submit" class="btn btn-success"><i class="icon-ok"></i> Submit</button>
                </div>
                <!-- END Form Buttons -->
            </form>
        </div>
        <!-- END General Forms Content -->
    </div>
    <!-- END General Forms Block -->
</div>
<!-- END Page Content -->

<?php include 'inc/footer.php'; // Footer and scripts ?>

<?php include 'inc/bottom.php'; // Close body and html tags ?>