<?php include 'inc/config.php';   // Configuration php file ?>
<?php include 'inc/top.php';      // Meta data and header   ?>
<?php include 'inc/side.php';      // Navigation content     ?>

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-inbox themed-color"></i>Inbox<br><small>Clean UI for your message center!</small></h1>
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
            <a href="#">Components</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="">Inbox</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <!-- Message Center Block -->
    <div class="block block-themed block-last">
        <!-- Message Center Title -->
        <div class="block-title">
            <h4>Message Center</h4>
        </div>
        <!-- END Message Center Title -->

        <!-- Message Center Content -->
        <div class="block-content block-content-flat">
            <!-- Inbox Container -->
            <div class="inbox-container">
                <!-- Inbox Container Row -->
                <div class="inbox-container-row">
                    <!-- Inbox Menu -->
                    <div class="inbox-menu">
                        <ul class="nav nav-pills nav-stacked">
                            <li>
                                <!-- Modal is under the Inbox Container div -->
                                <a href="#inbox-compose-modal" data-toggle="modal"><i class="glyphicon-pencil"></i> Compose</a>
                            </li>
                        </ul>
                        <ul class="nav nav-pills nav-stacked">
                            <li class="active">
                                <a href="javascript:void(0)"><i class="glyphicon-inbox_in"></i> Inbox <span id="count-inbox" class="inbox-menu-count"></span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><i class="glyphicon-inbox_out"></i> Sent</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><i class="glyphicon-star"></i> Favorites <span class="inbox-menu-count">15</span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><i class="glyphicon-briefcase"></i> Archive</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><i class="glyphicon-bin"></i> Trash</a>
                            </li>
                        </ul>
                        <ul class="nav nav-pills nav-stacked remove-margin">
                            <li>
                                <a href="javascript:void(0)"><i class="icon-circle themed-color-cherry"></i> Important <span class="inbox-menu-count">2</span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><i class="icon-circle themed-color-leaf"></i> Personal <span class="inbox-menu-count">98</span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><i class="icon-circle themed-color-wood"></i> Work <span class="inbox-menu-count">65</span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><i class="icon-circle themed-color-sun"></i> e-Shopping <span class="inbox-menu-count">25</span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><i class="icon-circle themed-color-ocean"></i> Vacation <span class="inbox-menu-count">8</span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><i class="icon-circle themed-color-amethyst"></i> Inspiration<span class="inbox-menu-count">32</span></a>
                            </li>
                        </ul>
                    </div>
                    <!-- END Inbox Menu -->

                    <!-- Inbox List -->
                    <div class="inbox-list">
                        <!-- Search Box -->
                        <input type="text" id="inbox-search" name="inbox-search" class="inbox-search" placeholder="Search Inbox..">
                        <!-- END Search Box -->

                        <!-- Messages List -->
                        <ul class="nav nav-pills nav-stacked">
                            <li class="active">
                                <a href="javascript:void(0)" id="msg1">
                                    <span class="inbox-list-username">John Doe</span> <span class="inbox-list-meta">Just now</span><br>
                                    <span class="inbox-list-title">Just a reminder!</span><br>
                                    <span class="inbox-list-preview">Dear Admin, Suspendisse potenti. Aliquam quis ligula elit..</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" id="msg2" class="unread">
                                    <span class="inbox-list-username">Chloe</span> <span class="inbox-list-meta">50 min ago</span><br>
                                    <span class="inbox-list-title">Project Updates</span><br>
                                    <span class="inbox-list-preview">Hi! I just got your message! I agree and I think that everything..</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" id="msg3" class="unread">
                                    <span class="inbox-list-username">Estelle</span> <span class="inbox-list-meta">1 hour ago</span><br>
                                    <span class="inbox-list-title">New Company</span><br>
                                    <span class="inbox-list-preview">Hey, how are you? I would like to let you know that whatever..</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" id="msg4" class="unread">
                                    <span class="inbox-list-username">Michael</span> <span class="inbox-list-meta">10 hours ago</span><br>
                                    <span class="inbox-list-title">Support Ticket #21525</span><br>
                                    <span class="inbox-list-preview">Dear customer, thank you very much for contacting us. About your issue..</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" id="msg5" class="unread">
                                    <span class="inbox-list-username">System</span> <span class="inbox-list-meta">Yesterday</span><br>
                                    <span class="inbox-list-title">Component Update</span><br>
                                    <span class="inbox-list-preview">This is an automated message. The component #5 was successfully..</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" id="msg6">
                                    <span class="inbox-list-username">John Doe</span> <span class="inbox-list-meta">a week ago</span><br>
                                    <span class="inbox-list-title">Trip</span><br>
                                    <span class="inbox-list-preview">Hey, what are we going to do with the trip? Will we..</span>
                                </a>
                            </li>
                        </ul>
                        <!-- END Messages List -->
                    </div>
                    <!-- END Inbox List -->

                    <!-- Inbox Message -->
                    <div class="inbox-msg">
                        <!-- Message Actions -->
                        <div class="inbox-msg-actions btn-toolbar">
                            <div class="btn-group">
                                <button class="btn btn-info" data-toggle="tooltip" title="Reply"><i class="icon-mail-reply"></i></button>
                                <button class="btn btn-info" data-toggle="tooltip" title="Reply to all"><i class="icon-mail-reply-all"></i></button>
                                <button class="btn btn-info" data-toggle="tooltip" title="Forward"><i class="icon-mail-forward"></i></button>
                            </div>
                            <div class="btn-group">
                                <button class="btn btn-success" data-toggle="tooltip" title="Archive"><i class="icon-briefcase"></i></button>
                                <button class="btn btn-success" data-toggle="tooltip" title="Print"><i class="icon-print"></i></button>
                            </div>
                            <div class="btn-group">
                                <button class="btn btn-danger" data-toggle="tooltip" title="Delete"><i class="icon-remove"></i></button>
                            </div>
                        </div>
                        <!-- END Message Actions -->

                        <!-- Message Content -->
                        <div class="inbox-msg-content">
                            <!-- Header -->
                            <div class="content-text clearfix push">
                                <img src="img/template/avatar.jpg" class="img-circle pull-left" alt="avatar" width="72" height="72">
                                <a href="page_ready_user_profile.php" class="badge badge-inverse"><strong>John Doe</strong></a>
                                <span class="label label-success">May 29, 2013 - 22:20</span>
                                <h3>Just a reminder!</h3>
                            </div>
                            <!-- END Header -->

                            <!-- Message -->
                            <p>Dear <strong>Admin</strong>,</p>
                            <p>Suspendisse potenti. Aliquam quis ligula <a href="javascript:void(0)">elit</a>. Aliquam at orci ac neque semper dictum. Sed tincidunt scelerisque ligula, et facilisis nulla hendrerit non. Suspendisse potenti. Pellentesque non accumsan orci. Praesent at lacinia dolor. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <p>Donec lacinia venenatis metus at bibendum? In hac <a href="javascript:void(0)">habitasse</a> platea dictumst. Proin ac nibh rutrum lectus rhoncus eleifend. Sed porttitor pretium venenatis. Suspendisse potenti. Aliquam quis ligula elit. Aliquam at orci ac neque semper dictum. Sed tincidunt scelerisque ligula, et facilisis nulla hendrerit non. Suspendisse potenti. Pellentesque non accumsan orci. Praesent at lacinia dolor. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida, urna ligula hendrerit nibh, ac cursus nibh sapien in purus. Mauris tincidunt tincidunt turpis in porta. Integer fermentum tincidunt auctor. Vestibulum ullamcorper, odio sed rhoncus imperdiet, enim elit sollicitudin orci, eget dictum leo mi nec lectus. Nam commodo turpis id lectus scelerisque vulputate. Integer sed dolor erat. Fusce erat ipsum, varius vel euismod sed, tristique et lectus? Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque? Proin rhoncus dui at ligula vestibulum ut facilisis ante sodales! Suspendisse potenti. Aliquam tincidunt sollicitudin sem nec ultrices. Sed at mi velit. Ut egestas tempor est, in cursus enim venenatis eget! Nulla quis ligula ipsum. Donec vitae ultrices dolor?</p>
                            <p>Suspendisse potenti. Aliquam quis ligula elit. Aliquam at orci ac neque <a href="javascript:void(0)">semper</a> dictum. Sed tincidunt scelerisque ligula, et facilisis nulla hendrerit non. Suspendisse potenti. Pellentesque non accumsan orci. Praesent at lacinia dolor. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <p>Best Regards,<br>John</p>
                            <!-- END Message -->
                        </div>
                        <!-- END Message Content -->
                    </div>
                    <!-- END Inbox Message -->
                </div>
                <!-- END Inbox Container Row -->
            </div>
            <!-- END Inbox Container -->

            <!-- New Message Modal -->
            <div id="inbox-compose-modal" class="modal fade hide">
                <div class="modal-header">
                    <h4><i class="glyphicon-pencil"></i> Compose</h4>
                </div>
                <div class="modal-body">
                    <form action="page_inbox.php" class="form-horizontal remove-margin" onsubmit="return false;">
                        <div class="control-group">
                            <select id="inbox-recipients" name="inbox-recipients" class="select-chosen" data-placeholder="Choose Recipients" multiple>
                                <option value="id1">Choe</option>
                                <option value="id2">John Doe</option>
                                <option value="id3">Estelle</option>
                                <option value="id4">Michael</option>
                                <option value="id5">Group: Moderators</option>
                                <option value="id6">Group: Administrators</option>
                            </select>
                        </div>
                        <div class="control-group remove-margin">
                            <textarea id="inbox-new-message" name="inbox-new-message" class="textarea-large" rows="6">Your message..</textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-success" data-dismiss="modal">Sent</button>
                </div>
            </div>
            <!-- END New Message Modal -->
        </div>
        <!-- END Message Center Content -->
    </div>
    <!-- END Message Center Block -->
</div>
<!-- END Page Content -->

<?php include 'inc/footer.php'; // Footer and scripts ?>

<!-- Javascript code only for this page -->
<script>
    $(function(){
        var msgList     = $('.inbox-list');
        var countInbox  = $('#count-inbox');
        var linkId, num;

        // Count unread messages and add the number to the inbox
        countInbox.text($('.unread', msgList).length);

        // When a message is clicked
        $('a', msgList).click(function(){
            // Message with id 'linkId' was clicked (for loading the message or marking it as read in your backend)
            linkId = $(this).attr('id');

            // Remove .active class from every message
            $('li', msgList).removeClass('active');

            // Add the class .active to its parent li
            $(this).parent('li').addClass('active');

            // Remove class .unread if there is one and update the inbox unread number
            if ($(this).hasClass('unread')) {
                // Remove .unread class
                $(this).removeClass('unread');

                // Get the unread messages number
                num = parseInt(countInbox.text());

                // Hide the number if all the messages are read else the number goes minus 1!
                if (num === 1) {
                    countInbox.hide(50, function(){
                        $(this).html('<i class="icon-ok"></i>').show(50, function(){
                            $(this).fadeOut(500);
                        });
                    });
                } else {
                    countInbox.hide(50, function(){
                        $(this).text(num - 1).show(50);
                    });
                }
            }
        });
    });
</script>

<?php include 'inc/bottom.php'; // Close body and html tags ?>