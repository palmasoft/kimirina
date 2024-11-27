
<aside id="page-sidebar" class="nav-collapse collapse<?php if ($template['sidebar'] == 'sticky') echo ' sticky'; ?>">
    <!--
    Wrapper for scrolling functionality
    Used only if the .sticky class added above. You can remove it and you will have a sticky sidebar
    without scrolling enabled when you set the sidebar to be sticky
    -->
    <div class="side-scrollable">
        <!-- Sidebar Tabs -->
        <div class="sidebar-tabs-con">
            <ul class="sidebar-tabs" data-toggle="tabs">
                <li title="permisos asignados al usuario" class="active">
                    <a href="#side-tab-menu"><i class="glyphicon-list"></i></a>
                </li>
                <li title="parámetros asociados al usuario" >
                    <a href="#side-tab-extra"><i class="glyphicon-user"></i></a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="side-tab-menu">



                    <!-- Primary Navigation -->
                    <nav id="primary-nav">
                        <?php
                        // print_r( $_SESSION["SESSION_FUNCIONES_USUARIO"] );

                        if (isset($_SESSION["SESSION_FUNCIONES_USUARIO"])) {
                            ?>
                            <ul>
                                <li class="">
                                    <a href="./" class="" >
                                        <i class="glyphicon-dashboard"></i>
                                        Panel de Control
                                    </a>
                                </li>
                                <?php
                                foreach ($_SESSION["SESSION_FUNCIONES_USUARIO"] as $MODULOS) {
                                    $link_class = '';

                                    // Get link's vital info
                                    $funJavascript = (isset($MODULOS->SCRIPT_MENU) && $MODULOS->SCRIPT_MENU) ? $MODULOS->SCRIPT_MENU : '#';
                                    $funActiva = (isset($MODULOS->NOMBRE_MODULO) && ($_SESSION['FUNCION_ACTIVA'] == $MODULOS->NOMBRE_MODULO )) ? ' active' : '';
                                    $funIcono = (isset($MODULOS->IMAGEN_PRINCIPAL_MODULO) && $MODULOS->IMAGEN_PRINCIPAL_MODULO) ? '<i class="' . $MODULOS->IMAGEN_PRINCIPAL_MODULO . '"></i>' : '';

                                    // Check if we need add the class active to the li element (only if a sublink is active)
                                    $li_active = '';
                                    $menu_link = '';

                                    if (isset($MODULOS->MENUS) && $MODULOS->MENUS) {
                                        foreach ($MODULOS->MENUS as $MENUS) {
                                            if ($_SESSION['FUNCION_ACTIVA'] == $MENUS->NOMBRE_MENU) {
                                                $li_active = ' class="active"';
                                                break;
                                            }
                                            // Check and sublinks for active class if they exist
                                            if (isset($MENUS->SUBMENU) && $MENUS->SUBMENU) {

                                            }
                                        }

                                        $menu_link = 'menu-link';
                                    }

                                    $link_class = ' class=" ';
                                    if ($menu_link || $funActiva)
                                        $link_class .= $menu_link . $funActiva;
                                    $link_class .= '"';
                                    ?>
                                    <li <?php echo $li_active; ?> >
                                        <a href="javascript:<?php echo $funJavascript; ?>"<?php echo $link_class; ?>><?php echo $funIcono . ($MODULOS->TITULO_MODULO); ?></a>
                                        <?php if (isset($MODULOS->MENUS) && $MODULOS->MENUS) { ?>
                                            <ul>
                                                <?php
                                                foreach ($MODULOS->MENUS as $MENU) {
                                                    $link_class = ' class="loading-on ';

                                                    // Get sublink's vital info
                                                    $url = (isset($MENU->SCRIPT_MENU) && $MENU->SCRIPT_MENU) ? $MENU->SCRIPT_MENU : '#';
                                                    $active = (isset($MENU->NOMBRE_MENU) && ($_SESSION['FUNCION_ACTIVA'] == $MENU->NOMBRE_MENU)) ? ' active' : '';
                                                    $icono = (isset($MENU->IMAGEN_PRINCIPAL_MENU) && $MENU->IMAGEN_PRINCIPAL_MENU) ? '<i class="' . $MENU->IMAGEN_PRINCIPAL_MENU . '"></i>' : '';


                                                    // Check if we need add the class active to the li element (only if a sublink is active)                                            
                                                    $li2_active = '';

                                                    $submenu_link = ' menu-item ';
                                                    if (isset($MENU->SUBMENU) && count($MENU->SUBMENU)) {
                                                        $submenu_link = 'submenu-link';
                                                    }



                                                    if ($submenu_link || $active)
                                                        $link_class .= '  ' . $submenu_link . $active . '"';
                                                    $link_class .= '"';
                                                    ?>
                                                    <li <?php echo $li2_active; ?>>
                                                        <a href="javascript:<?php echo htmlspecialchars($MENU->SCRIPT_MENU); ?>"<?php echo $link_class; ?>><?php echo $icono; ?><?php echo ($MENU->TITULO_MENU); ?></a>
                                                        <?php if (isset($MENU->SUBMENU) && $MENU->SUBMENU) { ?>
                                                            <ul style="background-color: #333;" >
                                                                <?php
                                                                foreach ($MENU->SUBMENU as $SUBMENU) {
                                                                    // Get vital info of sublinks
                                                                    $url = (isset($SUBMENU->SCRIPT_MENU) && $SUBMENU->SCRIPT_MENU) ? $SUBMENU->SCRIPT_MENU : '#';
                                                                    $active = (isset($SUBMENU->NOMBRE_MENU) && ( $_SESSION['FUNCION_ACTIVA'] == $SUBMENU->NOMBRE_MENU)) ? ' class="active"' : '';
                                                                    $icono = (isset($SUBMENU->IMAGEN_PRINCIPAL_MENU) && $SUBMENU->IMAGEN_PRINCIPAL_MENU) ? '<i class="' . $SUBMENU->IMAGEN_PRINCIPAL_MENU . '"></i>' : '';
                                                                    ?>
                                                                    <li class=""  >
                                                                        <a href="javascript:<?php echo htmlspecialchars($SUBMENU->SCRIPT_MENU); ?>" class="loading-on  menu-item  <?php echo $active ?>" ><?php echo $icono; ?><?php echo ($SUBMENU->TITULO_MENU); ?></a>
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

                                <li >
                                    <a href="javascript:cerrar_sesion();" class="loading-on" >
                                        <i class="glyphicon-power"></i>
                                        Salir
                                    </a>
                                </li>

                            </ul>
                        <?php } ?>
                    </nav>
                    <!-- END Primary Navigation -->











                </div>
                <div class="tab-pane tab-pane-side" id="side-tab-extra">

                    <h5><i class="icon-briefcase pull-right"></i>Subreceptor</h5>
                    <div class="side-stat text-center text-info"  >
                        <strong>
                            <span class="sigla_subreceptor_usuario" ><?php echo $_SESSION['SESION_USUARIO']->SIGLAS_SUBRECEPTOR ?></span>
                        </strong>
                        <small><span class="nombre_subreceptor_usuario"><?php echo $_SESSION['SESION_USUARIO']->NOMBRE_SUBRECEPTOR ?></span></small>
                    </div>

                    <h5><i class="glyphicon-Clock pull-right"></i>Periodo Sistema</h5>
                    <div class="side-stat text-center text-info">
                        <strong>
                            <span class="periodo_actual_usuario" ><?php echo $_SESSION['SESION_PERIODO_ACTUAL']->CODIGO_PERIODO ?></span>
                        </strong>
                    </div>

                    <?php //if (Usuario::esGestor() or Usuario::puedeVerTodo() or Usuario::esDNI() ): ?>
                        <h5><i class="fa-calendar pull-right"></i>Periodo del Usuario</h5>
                        <div class="side-stat text-center text-info"   >
                            <strong>
                                <span class="periodo_activo_usuario" ><?php echo $_SESSION['SESION_PERIODO_ACTIVO']->CODIGO_PERIODO ?></span>
                            </strong>
                        </div>
                    <?php //endif; ?>

                    <h5><i class="icon-user-md pull-right"></i>Cargo en el Proyecto</h5>
                    <div class="side-stat text-center text-info"   style="font-size: 16px;"><strong><?php echo $_SESSION['SESION_USUARIO']->NOMBRE_ROL ?></strong></div>
                    <!--
                    <h5><i class="icon-shopping-cart pull-right"></i>Sales (this month)</h5>
                    <div class="side-stat text-center text-success"><strong>+38%</strong></div>-->

                    <h5><i class="icon-key pull-right"></i>Ultima entrada a SIMON</h5>
                    <div class="side-stat text-center text-warning"><strong><?php echo $_SESSION['SESION_USUARIO']->ULTIMA_VISITA ?></strong><br /><?php echo $_SESSION['SESION_USUARIO']->ULTIMA_DIRECCION_IP ?></div>

<!--                    <h5><i class="icon-bug pull-right"></i>Registros</h5>
                    <div class="side-stat text-center"  style="font-size: 14px;" >
                    <div class=" text-error"><strong>XX</strong> (Promotores)</div>
                    <div class="text-warning"><strong>XX</strong> (Animadores)</div>
                    <div class="text-info"><strong>XX</strong> (Consejeria)</div>
                    <div class="text-success"><strong>XX</strong> (Atencion Salud)</div>
                    </div>-->
                </div>
            </div>
        </div>
        <!-- END Sidebar Tabs -->
    </div>
</aside>









