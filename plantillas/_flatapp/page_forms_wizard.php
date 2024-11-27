<?php include 'inc/config.php';   // Configuration php file ?>
<?php include 'inc/top.php';      // Meta data and header   ?>
<?php include 'inc/side.php';      // Navigation content     ?>

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-magic themed-color"></i> Wizard<br><small>Step by step!</small></h1>
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
        <li class="active"><a href="">Wizard</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <!-- Basic Wizard Block -->
    <div class="block block-themed">
        <!-- Basic Wizard Title -->
        <div class="block-title">
            <h4><i class="icon-magic"></i> Basic Wizard <small>No animation and default submission</small></h4>
        </div>
        <!-- END Basic Wizard Title -->

        <!-- Basic Wizard Content -->
        <div class="block-content">
            <form id="basic-wizard" action="page_forms_wizard.php" method="post" class="form-horizontal">
                <!-- First Step -->
                <div id="first" class="step">
                    <!-- Step Info -->
                    <div class="wizard-steps">
                        <div class="row-fluid">
                            <div class="wizard-step span4 active">Personal</div>
                            <div class="wizard-step span4">Account</div>
                            <div class="wizard-step span4">Extra</div>
                        </div>
                        <div class="progress progress-success progress-striped active">
                            <div class="bar" style="width: 33%"></div>
                        </div>
                    </div>
                    <!-- END Step Info -->
                    <div class="control-group">
                        <label class="control-label" for="example-firstname">Firstname</label>
                        <div class="controls">
                            <input type="text" id="example-firstname" name="example-firstname">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="example-lastname">Lastname</label>
                        <div class="controls">
                            <input type="text" id="example-lastname" name="example-lastname">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="example-address">Address</label>
                        <div class="controls">
                            <input type="text" id="example-address" name="example-address">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="example-city">City</label>
                        <div class="controls">
                            <input type="text" id="example-city" name="example-city">
                        </div>
                    </div>
                </div>
                <!-- END First Step -->

                <!-- Second Step -->
                <div id="second" class="step">
                    <!-- Step Info -->
                    <div class="wizard-steps">
                        <div class="row-fluid">
                            <div class="wizard-step span4 done"><i class="icon-ok"></i> Personal</div>
                            <div class="wizard-step span4 active">Account</div>
                            <div class="wizard-step span4">Extra</div>
                        </div>
                        <div class="progress progress-success progress-striped active">
                            <div class="bar" style="width: 66%"></div>
                        </div>
                    </div>
                    <!-- END Step Info -->
                    <div class="control-group">
                        <label class="control-label" for="example-username">Username</label>
                        <div class="controls">
                            <div class="input-append">
                                <input type="text" id="example-username" name="example-username">
                                <span class="add-on"><i class="icon-user"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="example-email">Email</label>
                        <div class="controls">
                            <div class="input-append">
                                <input type="text" id="example-email" name="example-email">
                                <span class="add-on"><i class="icon-envelope"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="example-password">Password</label>
                        <div class="controls">
                            <div class="input-append">
                                <input type="password" id="example-password" name="example-password">
                                <span class="add-on"><i class="icon-asterisk"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="example-password2">Retype Password</label>
                        <div class="controls">
                            <div class="input-append">
                                <input type="password" id="example-password2" name="example-password2">
                                <span class="add-on"><i class="icon-asterisk"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Second Step -->

                <!-- Third Step -->
                <div id="third" class="step">
                    <!-- Step Info -->
                    <div class="wizard-steps">
                        <div class="row-fluid">
                            <div class="wizard-step span4 done"><i class="icon-ok"></i> Personal</div>
                            <div class="wizard-step span4 done"><i class="icon-ok"></i> Account</div>
                            <div class="wizard-step span4 active">Extra</div>
                        </div>
                        <div class="progress progress-success progress-striped active">
                            <div class="bar" style="width: 100%"></div>
                        </div>
                    </div>
                    <!-- END Step Info -->
                    <div class="control-group">
                        <label class="control-label" for="example-bio">Bio</label>
                        <div class="controls">
                            <textarea id="example-bio" name="example-bio" rows="4" class="textarea-medium textarea-elastic"></textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="example-newsletter">Newsletter</label>
                        <div class="controls">
                            <input type="checkbox" id="example-newsletter" name="example-newsletter">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Terms and Conditions</label>
                        <div class="controls">
                            <label class="checkbox" for="example-terms">
                                <input type="checkbox" id="example-terms" name="example-terms" value="1">
                                Accept
                            </label>
                        </div>
                    </div>
                </div>
                <!-- END Third Step -->

                <!-- Form Buttons -->
                <div class="form-actions">
                    <input type="reset" class="btn btn-danger" id="back" value="Back">
                    <input type="submit" class="btn btn-success" id="next" value="Next">
                </div>
                <!-- END Form Buttons -->
            </form>
        </div>
        <!-- END Basic Wizard Content -->
    </div>
    <!-- END Basic Wizard Block -->

    <!-- Advanced Wizard Block -->
    <div class="block block-themed block-last">
        <!-- Advanced Wizard Title -->
        <div class="block-title">
            <h4><i class="icon-magic"></i> Advanced Wizard <small>Javascript validation, Ajax submission and custom animation</small></h4>
        </div>
        <!-- END Advanced Wizard Title -->

        <!-- Advanced Wizard Content -->
        <div class="block-content">
            <form id="advanced-wizard" action="page_forms_wizard.php" method="post" class="form-horizontal">
                <!-- First Step -->
                <div id="advanced-first" class="step">
                    <!-- Step Info -->
                    <div class="wizard-steps">
                        <div class="row-fluid">
                            <div class="wizard-step span4 active">Personal</div>
                            <div class="wizard-step span4">Account</div>
                            <div class="wizard-step span4">Extra</div>
                        </div>
                        <div class="progress progress-success progress-striped active">
                            <div class="bar" style="width: 33%"></div>
                        </div>
                    </div>
                    <!-- END Step Info -->
                    <div class="control-group">
                        <label class="control-label" for="example-advanced-firstname">Firstname</label>
                        <div class="controls">
                            <input type="text" id="example-advanced-firstname" name="example-advanced-firstname">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="example-advanced-lastname">Lastname</label>
                        <div class="controls">
                            <input type="text" id="example-advanced-lastname" name="example-advanced-lastname">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="example-advanced-address">Address</label>
                        <div class="controls">
                            <input type="text" id="example-advanced-address" name="example-advanced-address">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="example-advanced-city">City</label>
                        <div class="controls">
                            <input type="text" id="example-advanced-city" name="example-advanced-city">
                        </div>
                    </div>
                </div>
                <!-- END First Step -->

                <!-- Second Step -->
                <div id="advanced-second" class="step">
                    <!-- Step Info -->
                    <div class="wizard-steps">
                        <div class="row-fluid">
                            <div class="wizard-step span4 done"><i class="icon-ok"></i> Personal</div>
                            <div class="wizard-step span4 active">Account</div>
                            <div class="wizard-step span4">Extra</div>
                        </div>
                        <div class="progress progress-success progress-striped active">
                            <div class="bar" style="width: 66%"></div>
                        </div>
                    </div>
                    <!-- END Step Info -->
                    <div class="control-group">
                        <label class="control-label" for="val_username">Username *</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-user"></i></span>
                                <input type="text" id="val_username" name="val_username" required>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="val_email">Email *</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-envelope"></i></span>
                                <input type="text" id="val_email" name="val_email" required>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="val_password">Password *</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-asterisk"></i></span>
                                <input type="password" id="val_password" name="val_password" required>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="val_confirm_password">Retype Password *</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-asterisk"></i></span>
                                <input type="password" id="val_confirm_password" name="val_confirm_password" required>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Second Step -->

                <!-- Third Step -->
                <div id="advanced-third" class="step">
                    <!-- Step Info -->
                    <div class="wizard-steps">
                        <div class="row-fluid">
                            <div class="wizard-step span4 done"><i class="icon-ok"></i> Personal</div>
                            <div class="wizard-step span4 done"><i class="icon-ok"></i> Account</div>
                            <div class="wizard-step span4 active">Extra</div>
                        </div>
                        <div class="progress progress-success progress-striped active">
                            <div class="bar" style="width: 100%"></div>
                        </div>
                    </div>
                    <!-- END Step Info -->
                    <div class="control-group">
                        <label class="control-label" for="example-advanced-bio">Bio</label>
                        <div class="controls">
                            <textarea id="example-advanced-bio" name="example-advanced-bio" rows="4" class="textarea-medium textarea-elastic"></textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="example-advanced-newsletter">Newsletter</label>
                        <div class="controls">
                            <input type="checkbox" id="example-advanced-newsletter" name="example-advanced-newsletter">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">
                            <a href="#modal-terms" data-toggle="modal">Terms and Conditions</a>
                        </label>
                        <div class="controls">
                            <label class="checkbox" for="val_terms">
                                <input type="checkbox" id="val_terms" name="val_terms" value="1">
                                Accept
                            </label>
                        </div>
                        <!-- Terms Modal -->
                        <div id="modal-terms" class="modal hide fade">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">×</button>
                                <h4>Terms and Conditions</h4>
                            </div>
                            <div class="modal-body text-left">
                                <h5>1. Heading</h5>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida, urna ligula hendrerit nibh, ac cursus nibh sapien in purus. Mauris tincidunt tincidunt turpis in porta. Integer fermentum tincidunt auctor. Vestibulum ullamcorper, odio sed rhoncus imperdiet, enim elit sollicitudin orci, eget dictum leo mi nec lectus. Nam commodo turpis id lectus scelerisque vulputate. Integer sed dolor erat. Fusce erat ipsum, varius vel euismod sed, tristique et lectus? Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque? Proin rhoncus dui at ligula vestibulum ut facilisis ante sodales! Suspendisse potenti. Aliquam tincidunt sollicitudin sem nec ultrices. Sed at mi velit. Ut egestas tempor est, in cursus enim venenatis eget! Nulla quis ligula ipsum. Donec vitae ultrices dolor?</p>
                                <h5>2. Heading</h5>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida, urna ligula hendrerit nibh, ac cursus nibh sapien in purus. Mauris tincidunt tincidunt turpis in porta. Integer fermentum tincidunt auctor. Vestibulum ullamcorper, odio sed rhoncus imperdiet, enim elit sollicitudin orci, eget dictum leo mi nec lectus. Nam commodo turpis id lectus scelerisque vulputate. Integer sed dolor erat. Fusce erat ipsum, varius vel euismod sed, tristique et lectus? Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque? Proin rhoncus dui at ligula vestibulum ut facilisis ante sodales! Suspendisse potenti. Aliquam tincidunt sollicitudin sem nec ultrices. Sed at mi velit. Ut egestas tempor est, in cursus enim venenatis eget! Nulla quis ligula ipsum. Donec vitae ultrices dolor?</p>
                                <h5>3. Heading</h5>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida, urna ligula hendrerit nibh, ac cursus nibh sapien in purus. Mauris tincidunt tincidunt turpis in porta. Integer fermentum tincidunt auctor. Vestibulum ullamcorper, odio sed rhoncus imperdiet, enim elit sollicitudin orci, eget dictum leo mi nec lectus. Nam commodo turpis id lectus scelerisque vulputate. Integer sed dolor erat. Fusce erat ipsum, varius vel euismod sed, tristique et lectus? Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque? Proin rhoncus dui at ligula vestibulum ut facilisis ante sodales! Suspendisse potenti. Aliquam tincidunt sollicitudin sem nec ultrices. Sed at mi velit. Ut egestas tempor est, in cursus enim venenatis eget! Nulla quis ligula ipsum. Donec vitae ultrices dolor?</p>
                                <h5>4. Heading</h5>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida, urna ligula hendrerit nibh, ac cursus nibh sapien in purus. Mauris tincidunt tincidunt turpis in porta. Integer fermentum tincidunt auctor. Vestibulum ullamcorper, odio sed rhoncus imperdiet, enim elit sollicitudin orci, eget dictum leo mi nec lectus. Nam commodo turpis id lectus scelerisque vulputate. Integer sed dolor erat. Fusce erat ipsum, varius vel euismod sed, tristique et lectus? Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque? Proin rhoncus dui at ligula vestibulum ut facilisis ante sodales! Suspendisse potenti. Aliquam tincidunt sollicitudin sem nec ultrices. Sed at mi velit. Ut egestas tempor est, in cursus enim venenatis eget! Nulla quis ligula ipsum. Donec vitae ultrices dolor?</p>
                                <h5>5. Heading</h5>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida, urna ligula hendrerit nibh, ac cursus nibh sapien in purus. Mauris tincidunt tincidunt turpis in porta. Integer fermentum tincidunt auctor. Vestibulum ullamcorper, odio sed rhoncus imperdiet, enim elit sollicitudin orci, eget dictum leo mi nec lectus. Nam commodo turpis id lectus scelerisque vulputate. Integer sed dolor erat. Fusce erat ipsum, varius vel euismod sed, tristique et lectus? Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque? Proin rhoncus dui at ligula vestibulum ut facilisis ante sodales! Suspendisse potenti. Aliquam tincidunt sollicitudin sem nec ultrices. Sed at mi velit. Ut egestas tempor est, in cursus enim venenatis eget! Nulla quis ligula ipsum. Donec vitae ultrices dolor?</p>
                            </div>
                        </div>
                        <!-- END Terms Modal -->
                    </div>
                </div>
                <!-- END Third Step -->

                <!-- Form Buttons -->
                <div class="form-actions">
                    <input type="reset" class="btn btn-danger" id="back2" value="Back">
                    <input type="submit" class="btn btn-success" id="next2" value="Next">
                </div>
                <!-- END Form Buttons -->
            </form>
        </div>
        <!-- END Advanced Wizard Content -->
    </div>
    <!-- END Advanced Wizard Block -->
</div>
<!-- END Page Content -->

<?php include 'inc/footer.php'; // Footer and scripts ?>

<!-- Javascript code only for this page -->
<script>
    $(function(){
        /* For advanced usage and examples please check out
         *  Jquery Wizard       -> http://www.thecodemine.org
         *  Jquery Form         -> http://malsup.com/jquery/form/
         *  Jquery Validation   -> https://github.com/jzaefferer/jquery-validation
         */

        /* Initialize Basic Wizard */
        $('#basic-wizard').formwizard({
            focusFirstInput : true,
            disableUIStyles : true,
            inDuration: 0,
            outDuration: 0
        });

        /* Initialize Advanced Wizard */
        $('#advanced-wizard').formwizard({
            disableUIStyles : true,
            formPluginEnabled: true,
            validationEnabled: true,
            validationOptions: {
                errorClass: "help-inline text-error",
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
                    val_terms: "Please accept the terms to continue"
		}
            },
            formOptions :{
                success: function(data){
                    // On success status returned
                },
                beforeSubmit: function(data){
                    alert('Form Submitted!');
                },
                dataType: 'json',
                resetForm: true
            },
            inAnimation : {height: 'show'},
            outAnimation: {height: 'hide'}
        });
    });
</script>

<?php include 'inc/bottom.php'; // Close body and html tags ?>