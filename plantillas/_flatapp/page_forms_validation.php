<?php include 'inc/config.php';   // Configuration php file ?>
<?php include 'inc/top.php';      // Meta data and header   ?>
<?php include 'inc/side.php';      // Navigation content     ?>

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-notes_2 themed-color"></i> Validation<br><small>Your front-end validation is taken care of!</small></h1>
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
        <li class="active"><a href="">Validation</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <!-- Validation States Block -->
    <div class="block block-themed">
        <!-- Validation States Title -->
        <div class="block-title">
            <h4>Validation States and Messages <small>Help the user with all the included features</small></h4>
        </div>
        <!-- END Validation States Title -->

        <!-- Validation States Content -->
        <div class="block-content">
            <form action="page_forms_validation.php" method="post" class="form-horizontal" onsubmit="return false;">
                <div class="control-group">
                    <label class="control-label" for="validation-blockhelp">Block Message</label>
                    <div class="controls">
                        <input type="text" id="validation-blockhelp" name="validation-blockhelp">
                        <span class="help-block">Block message text</span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="validation-inlinehelp">Inline Message</label>
                    <div class="controls">
                        <input type="text" id="validation-inlinehelp" name="validation-inlinehelp">
                        <span class="help-inline">Inline message text</span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="validation-tooltip">Tooltip</label>
                    <div class="controls">
                        <input type="text" id="validation-tooltip" name="validation-tooltip" data-toggle="tooltip" data-placement="right" title="Provide information to the user with tooltips!">
                        <span class="help-block">Tooltip with info on hover</span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="validation-popover">Popover</label>
                    <div class="controls">
                        <input type="text" id="validation-popover" name="validation-popover" data-toggle="popover" data-placement="right" data-title="Title" data-content="Provide information to the user with popovers!">
                        <span class="help-block">Popover with info on click</span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label text-error" for="validation-email">Email *</label>
                    <div class="controls">
                        <input type="email" id="validation-email" name="validation-email" placeholder="test@example.com" required>
                        <span class="help-block">For browsers that support the <code>required</code> attribute, the border of the input remains red until the content is valid!</span>
                    </div>
                </div>
                <div class="control-group success">
                    <label class="control-label" for="validation-success">Success</label>
                    <div class="controls">
                        <div class="input-append">
                            <input type="text" id="validation-success" name="validation-success">
                            <div class="add-on"><i class="icon-ok"></i></div>
                        </div>
                        <span class="help-block">Valid Username!</span>
                    </div>
                </div>
                <div class="control-group info">
                    <label class="control-label" for="validation-info">Info</label>
                    <div class="controls">
                        <div class="input-append">
                            <input type="text" id="validation-info" name="validation-info">
                            <div class="add-on"><i class="icon-info-sign"></i></div>
                        </div>
                        <span class="help-block">Email already exists!</span>
                    </div>
                </div>
                <div class="control-group warning">
                    <label class="control-label" for="validation-warning">Warning</label>
                    <div class="controls">
                        <div class="input-append">
                            <input type="password" id="validation-warning" name="validation-warning">
                            <div class="add-on"><i class="icon-warning-sign"></i></div>
                        </div>
                        <span class="help-block">Your password is too simple!</span>
                    </div>
                </div>
                <div class="control-group error">
                    <label class="control-label" for="validation-error">Error</label>
                    <div class="controls">
                        <div class="input-append">
                            <input type="text" id="validation-error" name="validation-error">
                            <div class="add-on"><i class="icon-remove"></i></div>
                        </div>
                        <span class="help-block">Failed!</span>
                    </div>
                </div>
            </form>
        </div>
        <!-- END Validation States Content -->
    </div>
    <!-- END Validation States Block -->

    <!-- Javascript Validation Block -->
    <div class="block block-themed block-last">
        <!-- Javascript Validation Title -->
        <div class="block-title">
            <h4>Javascript Validation <small>Validate easily in the front-end before sending data for process</small></h4>
        </div>
        <!-- END Javascript Validation Title -->

        <!-- Javascript Validation Content, Validation initialized at the bottom of the page -->
        <div class="block-content">
            <form id="form-validation" action="page_forms_validation.php" method="post" class="form-inline">
                <!-- div.row-fluid -->
                <div class="row-fluid">
                    <!-- 1st Column -->
                    <div class="span6">
                        <div class="control-group">
                            <label class="control-label" for="val_username">Username</label>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-user"></i></span>
                                    <input type="text" id="val_username" name="val_username">
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="val_email">Email</label>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-envelope"></i></span>
                                    <input type="text" id="val_email" name="val_email">
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="val_password">Password</label>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-asterisk"></i></span>
                                    <input type="password" id="val_password" name="val_password">
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="val_confirm_password">Retype Password</label>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-asterisk"></i></span>
                                    <input type="password" id="val_confirm_password" name="val_confirm_password">
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="val_website">Website</label>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-globe"></i></span>
                                    <input type="text" id="val_website" name="val_website" value="http://" class="input-large">
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="val_date">Date</label>
                            <div class="controls">
                                <div class="input-prepend date input-datepicker" data-date="04-30-2013" data-date-format="mm-dd-yyyy">
                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                    <input type="text" id="val_date" name="val_date" class="input-small">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END 1st Column -->

                    <!-- 2nd Column -->
                    <div class="span6">
                        <div class="control-group">
                            <label class="control-label" for="val_range">Range [1, 100]</label>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-asterisk"></i></span>
                                    <input type="text" id="val_range" name="val_range" class="input-small">
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="val_number">Number</label>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-asterisk"></i></span>
                                    <input type="text" id="val_number" name="val_number" class="input-small">
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="val_digits">Digits</label>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-asterisk"></i></span>
                                    <input type="text" id="val_digits" name="val_digits" class="input-small">
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="val_credit_card">Credit Card</label>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-credit-card"></i></span>
                                    <input type="text" id="val_credit_card" name="val_credit_card" data-toggle="tooltip" title="Try 446-667-651">
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="val_skill">Best Skill</label>
                            <div class="controls">
                                <select id="val_skill" name="val_skill">
                                    <option value="">Please select</option>
                                    <option value="html">HTML</option>
                                    <option value="css">CSS</option>
                                    <option value="javascript">Javascript</option>
                                    <option value="php">PHP</option>
                                    <option value="mysql">MySQL</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="val_terms">Service Terms</label>
                            <div class="controls">
                                <label class="checkbox" for="val_terms">
                                    <input type="checkbox" id="val_terms" name="val_terms" value="1"> I agree
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
        <!-- END Javascript Validation Content -->
    </div>
    <!-- END Javascript Validation Block -->
</div>
<!-- END Page Content -->

<?php include 'inc/footer.php'; // Footer and scripts ?>

<!-- Javascript code only for this page -->
<script>
    $(function(){
        /* For advanced usage and examples please check out
         *  Jquery Validation   -> https://github.com/jzaefferer/jquery-validation
         */

        /* Initialize Form Validation */
        $('#form-validation').validate({
            errorClass: "help-block", // You can add help-inline instead of help-block if you like validation messages to the right of the inputs
            errorElement: "span",
            errorPlacement: function(error, element) {
                element.parents(".controls").append(error);
            },
            highlight: function(e){
                $(e).closest(".control-group").removeClass("success error").addClass("error");
            },
            success: function(e){
                e.addClass("valid").closest(".control-group").removeClass("success error").addClass("success");
            },
            rules: {
                val_username: {
                    required: true,
                    minlength: 2
                },
                val_password: {
                    required: true,
                    minlength: 5
                },
                val_confirm_password: {
                    required: true,
                    minlength: 5,
                    equalTo: "#val_password"
                },
                val_email: {
                    required: true,
                    email: true
                },
                val_website: {
                    required: true,
                    url: true
                },
                val_date: {
                    required: true,
                    date: true
                },
                val_range: {
                    required: true,
                    range: [1, 100]
                },
                val_number: {
                    required: true,
                    number: true
                },
                val_digits: {
                    required: true,
                    digits: true
                },
                val_skill: {
                    required: true
                },
                val_credit_card: {
                    required: true,
                    creditcard: true
                },
                val_terms: {
                    required: true
                }
            },
            messages: {
                val_username: {
                    required: "Please enter a username",
                    minlength: "Your username must consist of at least 2 characters"
                },
                val_password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                val_confirm_password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long",
                    equalTo: "Please enter the same password as above"
                },
                val_email: "Please enter a valid email address",
                val_website: "Please enter your website!",
                val_date: "Please select a date!",
                val_range: "Please enter a number between 1 and 100!",
                val_number: "Please enter a number!",
                val_digits: "Please enter digits!",
                val_credit_card: "Please enter a valid credit card!",
                val_skill: "Please select a skill!",
                val_terms: "You must agree to the terms!"
            }
        });
    });
</script>

<?php include 'inc/bottom.php'; // Close body and html tags ?>