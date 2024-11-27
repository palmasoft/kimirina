<?php
/**
 * footer.php
 *
 * Author: pixelcave
 *
 * The footer of the page
 * Jquery library as well as all other scripts are included here
 *
 */
?>
    <!-- Footer -->
    <footer>
        <div class="pull-right">
            Crafted with <i class="icon-heart"></i> by <strong><a href="http://goo.gl/vNS3I" target="_blank">pixelcave</a></strong>
        </div>
        <div class="pull-left">
            <span id="year-copy"></span> &copy; <strong><a href="http://goo.gl/mssAH" target="_blank"><?php echo $template['name'] . ' ' . $template['version']; ?></a></strong>
        </div>
    </footer>
    <!-- END Footer -->
</div>
<!-- END Page Container -->

<!-- Scroll to top link, check main.js - scrollToTop() -->
<a href="#" id="to-top"><i class="icon-chevron-up"></i></a>

<!-- User Modal Account, appears when clicking on 'User Settings' link found on user dropdown menu (header, top right) -->
<div id="modal-user-account" class="modal hide fade">
    <!-- Modal Body -->
    <div class="modal-body remove-padding">
        <!-- Modal Tabs -->
        <div class="block-tabs">
            <div class="block-options">
                <a href="javascript:void(0)" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i></a>
            </div>
            <ul class="nav nav-tabs" data-toggle="tabs">
                <li class="active"><a href="#modal-user-account-account"><i class="icon-cog"></i> Account</a></li>
                <li><a href="#modal-user-account-profile"><i class="icon-user"></i> Profile</a></li>
            </ul>
            <div class="tab-content">
                <!-- Account Tab Content -->
                <div class="tab-pane active" id="modal-user-account-account">
                    <form action="index.php" method="post" class="form-horizontal" onsubmit="return false;">
                        <div class="control-group">
                            <label class="control-label" for="modal-account-username">Username</label>
                            <div class="controls">
                                <input type="text" id="modal-account-username" name="modal-account-username" value="admin" class="disabled" disabled>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="modal-account-email">Email</label>
                            <div class="controls">
                                <input type="text" id="modal-account-email" name="modal-account-email" value="admin@exampleapp.com">
                            </div>
                        </div>
                        <h4 class="sub-header">Change Password</h4>
                        <div class="control-group">
                            <label class="control-label" for="modal-account-pass">Current Password</label>
                            <div class="controls">
                                <input type="password" id="modal-account-pass" name="modal-account-pass">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="modal-account-newpass">New Password</label>
                            <div class="controls">
                                <input type="password" id="modal-account-newpass" name="modal-account-newpass">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="modal-account-newrepass">Retype New Password</label>
                            <div class="controls">
                                <input type="password" id="modal-account-newrepass" name="modal-account-newrepass">
                            </div>
                        </div>
                    </form>
                </div>
                <!-- END Account Tab Content -->

                <!-- Profile Tab Content -->
                <div class="tab-pane" id="modal-user-account-profile">
                    <form action="index.php" method="post" class="form-horizontal" onsubmit="return false;">
                        <div class="control-group">
                            <label class="control-label" for="modal-profile-name">Name</label>
                            <div class="controls">
                                <input type="text" id="modal-profile-name" name="modal-profile-name" value="John Doe">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="modal-profile-gender">Gender</label>
                            <div class="controls">
                                <select id="modal-profile-gender" name="modal-profile-name">
                                    <option value="m">Male</option>
                                    <option value="f">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="modal-profile-birthdate">Birthdate</label>
                            <div class="controls">
                                <div class="input-append">
                                    <input type="text" id="modal-profile-birthdate" name="modal-profile-birthdate" class="input-small input-datepicker">
                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="modal-profile-skills">Skills</label>
                            <div class="controls">
                                <select id="modal-profile-skills" name="modal-profile-skills" class="select-chosen" multiple>
                                    <option value="html" selected>html</option>
                                    <option value="css" selected>css</option>
                                    <option value="javascript">javascript</option>
                                    <option value="php">php</option>
                                    <option value="mysql">mysql</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="modal-profile-bio">Bio</label>
                            <div class="controls">
                                <textarea id="modal-profile-bio" name="modal-profile-bio" class="textarea-elastic" rows="3">Bio Information..</textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- END Profile Tab Content -->
            </div>
        </div>
        <!-- END Modal Tabs -->
    </div>
    <!-- END Modal Body -->

    <!-- Modal footer -->
    <div class="modal-footer">
        <button class="btn btn-success" data-dismiss="modal"><i class="icon-save"></i> Save</button>
    </div>
    <!-- END Modal footer -->
</div>
<!-- END User Modal Settings -->

<!-- Excanvas for Flot (Charts plugin) support on IE8 -->
<!--[if lte IE 8]><script src="js/helpers/excanvas.min.js"></script><![endif]-->

<!-- Get Jquery library from Google ... -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<!-- ... but if something goes wrong get Jquery from local file -->
<script>!window.jQuery && document.write(unescape('%3Cscript src="js/vendor/jquery-1.9.1.min.js"%3E%3C/script%3E'));</script>

<!-- Bootstrap.js -->
<script src="js/vendor/bootstrap.min.js"></script>

<!--
Include Google Maps API for global use.
If you don't want to use  Google Maps API globally, just remove this line and the gmaps.js plugin from js/plugins.js (you can put it in a seperate file)
Then iclude them both in the pages you would like to use the google maps functionality
-->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>

<!-- Jquery plugins and custom javascript code -->
<script src="js/plugins.js"></script>
<script src="js/main.js"></script>