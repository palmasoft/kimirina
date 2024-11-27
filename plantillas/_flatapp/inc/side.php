<?php
/**
 * side.php
 *
 * Author: pixelcave
 *
 * The side content of the page
 *
 */
?>

<!-- Left Sidebar -->
<!-- In the PHP version you can set the following options from the config file -->
<!-- Add the class .sticky for a sticky sidebar -->
<aside id="page-sidebar" class="nav-collapse collapse<?php if ($template['sidebar'] == 'sticky') echo ' sticky'; ?>">
    <!--
    Wrapper for scrolling functionality
    Used only if the .sticky class added above. You can remove it and you will have a sticky sidebar
    without scrolling enabled when you set the sidebar to be sticky
    -->
    <div class="side-scrollable">
        <!-- Mini Profile -->
        <div class="mini-profile">
            <div class="mini-profile-options">
                <a href="javascript:void(0)" class="badge badge-info loading-on" data-toggle="tooltip" data-placement="right" title="Refresh">
                    <i class="icon-refresh"></i>
                </a>
                <a href="page_ready_shopping_cart.php" class="badge badge-warning" data-toggle="tooltip" data-placement="right" title="6 Products">
                    <i class="glyphicon-shopping_cart"></i>
                </a>
                <!-- Modal div is at the bottom of the page before including javascript code, we use .enable-tooltip class for the tooltip because data-toggle is used for modal -->
                <a href="#modal-user-account" class="badge badge-success enable-tooltip" role="button" data-toggle="modal" data-placement="right" title="Settings">
                    <i class="glyphicon-cogwheel"></i>
                </a>
                <a href="page_login.php" class="badge badge-important" data-toggle="tooltip" data-placement="right" title="Log out">
                    <i class="icon-signout"></i>
                </a>
            </div>
            <a href="page_ready_user_profile.php">
                <img src="img/template/avatar2.jpg" alt="Avatar" class="img-circle">
            </a>
        </div>
        <!-- END Mini Profile -->

        <!-- Sidebar Tabs -->
        <div class="sidebar-tabs-con">
            <ul class="sidebar-tabs" data-toggle="tabs">
                <li class="active">
                    <a href="#side-tab-menu"><i class="glyphicon-list"></i></a>
                </li>
                <li>
                    <a href="#side-tab-extra"><i class="glyphicon-user"></i></a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="side-tab-menu">
                    <!-- Primary Navigation -->
                    <nav id="primary-nav">
                        <?php if ($primary_nav) { ?>
                        <ul>
                            <?php foreach ($primary_nav as $key => $link) {
                                $link_class = '';

                                // Get link's vital info
                                $url = (isset($link['url']) && $link['url']) ? $link['url'] : '#';
                                $active = (isset($link['url']) && ($template['active_page'] == $link['url'])) ? ' active' : '';
                                $icon = (isset($link['icon']) && $link['icon']) ? '<i class="' . $link['icon'] . '"></i>' : '';

                                // Check if we need add the class active to the li element (only if a sublink is active)
                                $li_active = '';
                                $menu_link = '';

                                if (isset($link['sub']) && $link['sub']) {
                                    foreach ($link['sub'] as $sub_link) {
                                        if (in_array($template['active_page'], $sub_link)) {
                                            $li_active = ' class="active"';
                                            break;
                                        }

                                        // Check and sublinks for active class if they exist
                                        if (isset($sub_link['sub']) && $sub_link['sub']) {
                                            foreach ($sub_link['sub'] as $sub2_link) {
                                                if (in_array($template['active_page'], $sub2_link)) {
                                                    $li_active = ' class="active"';
                                                    break;
                                                }
                                            }
                                        }
                                    }

                                    $menu_link = 'menu-link';
                                }

                                if ($menu_link || $active)
                                    $link_class = ' class="'. $menu_link . $active .'"';
                            ?>
                            <li<?php echo $li_active; ?>>
                                <a href="<?php echo $url; ?>"<?php echo $link_class; ?>><?php echo $icon . $link['name']; ?></a>
                                <?php if (isset($link['sub']) && $link['sub']) { ?>
                                    <ul>
                                        <?php foreach ($link['sub'] as $sub_link) {
                                            $link_class = '';

                                            // Get sublink's vital info
                                            $url = (isset($sub_link['url']) && $sub_link['url']) ? $sub_link['url'] : '#';
                                            $active = (isset($sub_link['url']) && ($template['active_page'] == $sub_link['url'])) ? ' active' : '';

                                            // Check if we need add the class active to the li element (only if a sublink is active)
                                            $li2_active = '';
                                            $submenu_link = '';

                                            if (isset($sub_link['sub']) && $sub_link['sub']) {
                                                foreach ($sub_link['sub'] as $sub2_link) {
                                                    if (in_array($template['active_page'], $sub2_link)) {
                                                        $li2_active = ' class="active"';
                                                        break;
                                                    }
                                                }

                                                $submenu_link = 'submenu-link';
                                            }

                                            if ($submenu_link || $active)
                                                $link_class = ' class="'. $submenu_link . $active .'"';
                                        ?>
                                        <li<?php echo $li2_active; ?>>
                                            <a href="<?php echo $url; ?>"<?php echo $link_class; ?>><?php echo $sub_link['name']; ?></a>
                                            <?php if (isset($sub_link['sub']) && $sub_link['sub']) { ?>
                                                <ul>
                                                    <?php foreach ($sub_link['sub'] as $sub2_link) {
                                                        // Get vital info of sublinks
                                                        $url = (isset($sub2_link['url']) && $sub2_link['url']) ? $sub2_link['url'] : '#';
                                                        $active = (isset($sub2_link['url']) && ($template['active_page'] == $sub2_link['url'])) ? ' class="active"' : '';
                                                    ?>
                                                    <li>
                                                        <a href="<?php echo $url; ?>"<?php echo $active ?>><?php echo $sub2_link['name']; ?></a>
                                                    </li>
                                                    <?php } ?>
                                                </ul>
                                            <?php } ?>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                            </li>
                            <?php } ?>
                        </ul>
                        <?php } ?>
                    </nav>
                    <!-- END Primary Navigation -->
                </div>
                <div class="tab-pane tab-pane-side" id="side-tab-extra">
                    <h5><i class="icon-briefcase pull-right"></i>Balance</h5>
                    <div class="side-stat text-center text-info"><strong>$25.230,<small>00</small></strong></div>

                    <h5><i class="icon-dollar pull-right"></i>Earnings (today)</h5>
                    <div class="side-stat text-center text-info"><strong>$1.752,<small>00</small></strong></div>

                    <h5><i class="icon-shopping-cart pull-right"></i>Sales (today)</h5>
                    <div class="side-stat text-center text-info"><strong>368</strong></div>

                    <h5><i class="icon-shopping-cart pull-right"></i>Sales (this month)</h5>
                    <div class="side-stat text-center text-success"><strong>+38%</strong></div>

                    <h5><i class="icon-ticket pull-right"></i>Open Tickets</h5>
                    <div class="side-stat text-center text-warning"><strong>23</strong></div>

                    <h5><i class="icon-bug pull-right"></i>Bugs to fix</h5>
                    <div class="side-stat text-center text-error"><strong>1</strong> (important)</div>
                    <div class="side-stat text-center text-warning"><strong>3</strong> (normal)</div>
                </div>
            </div>
        </div>
        <!-- END Sidebar Tabs -->
    </div>
    <!-- END Wrapper for scrolling functionality -->
</aside>
<!-- END Left Sidebar -->