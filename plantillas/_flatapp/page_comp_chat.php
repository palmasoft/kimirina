<?php include 'inc/config.php';   // Configuration php file ?>
<?php include 'inc/top.php';      // Meta data and header   ?>
<?php include 'inc/side.php';      // Navigation content     ?>

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-comments themed-color"></i>Chat<br><small>The UI is ready, create your functionality!</small></h1>
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
        <li class="active"><a href="">Chat</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <!-- Chat Block -->
    <div class="block block-themed block-last">
        <!-- Chat Title -->
        <div class="block-title">
            <h4>10 People Online</h4>
        </div>
        <!-- END Chat Title -->

        <!-- Chat Content -->
        <div class="block-content block-content-flat">
            <!-- Chat Container -->
            <div class="chat-container clearfix">
                <!-- Chat People -->
                <div class="chat-people">
                    <ul>
                        <li>
                            <a href="javascript:void(0)" class="chat-online">
                                <img src="img/placeholders/image_64x64_dark.png" alt="avatar" class="img-circle">
                                Michael
                            </a>
                        </li>
                        <li class="active">
                            <a href="javascript:void(0)" class="chat-online">
                                <img src="img/placeholders/image_64x64_dark.png" alt="avatar" class="img-circle">
                                John Doe
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="chat-online">
                                <img src="img/placeholders/image_64x64_dark.png" alt="avatar" class="img-circle">
                                Chloe
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="chat-online">
                                <img src="img/placeholders/image_64x64_dark.png" alt="avatar" class="img-circle">
                                Estelle
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="chat-online">
                                <img src="img/placeholders/image_64x64_dark.png" alt="avatar" class="img-circle">
                                Moderator
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="chat-online">
                                <img src="img/placeholders/image_64x64_dark.png" alt="avatar" class="img-circle">
                                Admin1
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="chat-online">
                                <img src="img/placeholders/image_64x64_dark.png" alt="avatar" class="img-circle">
                                Admin2
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="chat-online">
                                <img src="img/placeholders/image_64x64_dark.png" alt="avatar" class="img-circle">
                                Username
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="chat-online">
                                <img src="img/placeholders/image_64x64_dark.png" alt="avatar" class="img-circle">
                                Jonathan
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="chat-online">
                                <img src="img/placeholders/image_64x64_dark.png" alt="avatar" class="img-circle">
                                Username2
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="chat-away">
                                <img src="img/placeholders/image_64x64_dark.png" alt="avatar" class="img-circle">
                                User8
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="chat-away">
                                <img src="img/placeholders/image_64x64_dark.png" alt="avatar" class="img-circle">
                                User11
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="chat-away">
                                <img src="img/placeholders/image_64x64_dark.png" alt="avatar" class="img-circle">
                                User12
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="chat-away">
                                <img src="img/placeholders/image_64x64_dark.png" alt="avatar" class="img-circle">
                                User81
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="chat-away">
                                <img src="img/placeholders/image_64x64_dark.png" alt="avatar" class="img-circle">
                                User4
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="chat-away">
                                <img src="img/placeholders/image_64x64_dark.png" alt="avatar" class="img-circle">
                                Bot Account
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="chat-offline">
                                <img src="img/placeholders/image_64x64_dark.png" alt="avatar" class="img-circle">
                                Moderator2
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="chat-offline">
                                <img src="img/placeholders/image_64x64_dark.png" alt="avatar" class="img-circle">
                                User
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="chat-offline">
                                <img src="img/placeholders/image_64x64_dark.png" alt="avatar" class="img-circle">
                                Username5
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="chat-offline">
                                <img src="img/placeholders/image_64x64_dark.png" alt="avatar" class="img-circle">
                                Username10
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- END Chat People -->

                <!-- Chat Messages -->
                <div class="chat-messages">
                    <ul>
                        <li>
                            <span class="chat-msg-time">4 min ago by <a href="page_ready_user_profile.php">John Doe</a></span>
                            <img src="img/placeholders/image_64x64_dark.png" alt="avatar" class="img-circle">
                            Hi! How are you?
                        </li>
                        <li class="chat-msg-user">
                            <span class="chat-msg-time">3 min ago by <strong>you</strong></span>
                            <img src="img/template/avatar.jpg" alt="avatar" class="img-circle">
                            Hi John, I'm good, you?
                        </li>
                        <li>
                            <span class="chat-msg-time">2 min ago by <a href="page_ready_user_profile.php">John Doe</a></span>
                            <img src="img/placeholders/image_64x64_dark.png" alt="avatar" class="img-circle">
                            Everything is fine, thanks!
                        </li>
                    </ul>
                </div>
                <!-- END Chat Messages -->
            </div>
            <!-- END Chat Container -->

            <!-- Chat Input -->
            <div class="chat-input themed-background">
                <form id="form-chat" action="page_chatui.php" class="remove-margin">
                    <input type="text" id="chat-message" name="chat-message" placeholder="Type a message and hit enter..">
                </form>
            </div>
            <!-- END Chat Input -->
        </div>
        <!-- END Chat Content -->
    </div>
    <!-- END Chat Block -->
</div>
<!-- END Page Content -->

<?php include 'inc/footer.php'; // Footer and scripts ?>

<!-- Javascript code only for this page -->
<script>
    $(function(){
        var peopleList      = $('.chat-people ul');
        var messageListCon  = $('.chat-messages');
        var messageInput    = $('#chat-message');
        var userId, msg;

        // When a user is clicked
        $('a', peopleList).click(function(){
            // Remove .active class from every user
            $('li', peopleList).removeClass('active');

            // Add the class .active to its parent li
            $(this).parent('li').addClass('active');

            // User with id 'userId' was clicked (eg for loading chat messages from backend)
            userId = $(this).attr('id');

            //...
        });

        // On form chat submit
        $('#form-chat').submit(function(e){
            // Get text from message input
            msg = messageInput.val();

            // If the user typed a message
            if (msg) {
                // Add it to the message list (here you could sync with your backend)
                $('ul', messageListCon).append('<li class="chat-msg-user">' +
                                        '<span class="chat-msg-time">just now by you</span>' +
                                        '<img src="img/template/avatar.jpg" alt="avatar" class="img-circle">' + msg +
                                    '</li>');
                // Just a demo answer message
                setTimeout(function(){$('ul', messageListCon).append('<li>' +
                                        '<span class="chat-msg-time">just now by pixelcave</span>' +
                                        '<img src="img/template/pixelcave.png" alt="avatar" class="img-circle">Thanks for trying out <strong>Chat</strong> interface! I hope you like it!' +
                                    '</li>');}, 250);

                // Scroll the message list to the bottom
                messageListCon.animate({ scrollTop: messageListCon[0].scrollHeight}, 500);
            }

            // Reset the message input
            messageInput.val('');

            // Don't submit the message form
            e.preventDefault();
        });
    });
</script>

<?php include 'inc/bottom.php'; // Close body and html tags ?>