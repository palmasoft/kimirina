<html  lang="es" >
    <!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
    <!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
    <!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
    <!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->
        <head>            
            <meta charset="utf-8">      
            <title><?php echo $template['title'] ?></title>
            <meta name="description" content="<?php echo $template['description'] ?>">
            <meta name="author" content="<?php echo $template['author'] ?>">
            <meta name="robots" content="noindex, nofollow">
            <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1">
            <?php //  $plantilla->meta_head(); ?> 

            <!-- Icons -->
            <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
            <link rel="shortcut icon" href="plantillas/flatapp/img/favicon.ico">
            <link rel="apple-touch-icon" href="plantillas/flatapp/img/apple-touch-icon.png">
            <link rel="apple-touch-icon" sizes="57x57" href="plantillas/flatapp/img/apple-touch-icon-57x57-precomposed.png">
            <link rel="apple-touch-icon" sizes="72x72" href="plantillas/flatapp/img/apple-touch-icon-72x72-precomposed.png">
            <link rel="apple-touch-icon" sizes="114x114" href="plantillas/flatapp/img/apple-touch-icon-114x114-precomposed.png">
            <link rel="apple-touch-icon-precomposed" href="plantillas/flatapp/img/apple-touch-icon-precomposed.png">
            <!-- END Icons -->

            <!-- Stylesheets -->
            <?php $plantilla->min_css(); ?> 

            <!-- The roboto font is included from Google Web Fonts
            <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,400italic,700,700italic">  
            -->
            <link rel="stylesheet" href="plantillas/flatapp/css/main.css">   
            <?php if ($template['theme']) { ?>
                <link id="theme-link" rel="stylesheet" href="plantillas/flatapp/css/themes/<?php echo $template['theme']; ?>.css">
            <?php } ?>        
            <link rel="stylesheet" href="plantillas/flatapp/css/themes.css">    
            <!-- END Stylesheets -->

        </head>

        <?php
        $body_classes = '';

        if ($template['header'] == 'fixed-top')
            $body_classes = 'header-fixed-top';
        else if ($template['header'] == 'fixed-bottom')
            $body_classes = 'header-fixed-bottom';

        if ($template['side_content'])
            $body_classes .= ' ' . $template['side_content'];
        ?>
        <body<?php if ($body_classes) echo ' class="' . $body_classes . '"'; ?> >
            
            <div id="page-container"<?php if ($template['page'] == 'full-width') echo ' class="full-width"'; ?> >
               
                <header class="navbar navbar-inverse<?php
                if ($template['header'] == 'fixed-top')
                    echo ' navbar-fixed-top';
                else if ($template['header'] == 'fixed-bottom')
                    echo ' navbar-fixed-bottom';
                ?>">
                    <!-- Navbar Inner -->
                    <div class="navbar-inner">
                        <!-- div#row-fluid -->
                        <div class="row-fluid">
                            <!-- Sidebar Toggle Buttons (Desktop & Tablet) -->
                            <div class="span1 hidden-phone"  title="mostrar / ocultar menus"   >
                                <ul class="nav pull-left">
                                    <li class="visible-desktop">
                                        <a href="javascript:void(0)" id="toggle-side-content">
                                            <i class="icon-reorder"></i>
                                        </a>
                                    </li>
                                    <li class="visible-tablet">
                                        <a href="javascript:void(0)" data-toggle="collapse" data-target=".nav-collapse">
                                            <i class="icon-reorder"></i>
                                        </a>
                                    </li>
                                    <li class="divider-vertical remove-margin"></li>
                                </ul>
                            </div>
                            <!-- END Sidebar Toggle Buttons -->

                            <!-- Brand and Search Section -->
                            <div class="span8 ">
                                <!-- Logo -->
                                <span id="loading" class="hide" style="float: left" ><i class="icon-spinner icon-spin" ></i></span>
                                <a href="./" class="brand" style="float: left">
                                    <img src="imagenes/logoFondoMundial.jpg" alt="logo" style="height: 40px;">
                                </a>
                                <div style="color: #FFF;font-weight: bold;font-size: 70%; float: left; width: 50%;">
                                    <?php echo ( $params->valor('NOMBREPROYECTO') ); ?>
                                </div>
                                <!-- END Logo -->

                                <!-- Loading Indicator, Used for demostrating how loading of notifications could happen, check main.js - uiDemo() -->
                                <span style="float: right;color: #FFF;font-weight: bold;width: auto; font-stretch: condensed; font-size: 75%;" >
                                    <div class="sigla_subreceptor_usuario"><?php echo $_SESSION['SESION_USUARIO']->SIGLAS_SUBRECEPTOR ?></div>
                                    <div><?php echo $_SESSION['SESION_USUARIO']->NOMBRE_ROL ?></div>
                                </span>

                            </div>
                            <!-- END Brand and Search Section -->

                            <!-- Header Nav Section -->
                            <div id="header-nav-section" class="span3 clearfix" style="" >

                                <!-- Header Nav -->
                                <ul class="nav pull-right">

                                    <?php //if (Usuario::esGestor() or Usuario::puedeVerTodo()): ?>
                                        <li>
                                            <a href="javascript:abrir_control_periodo_subreceptor();" class="loading-on" data-toggle="tooltip" data-placement="bottom" title="Cambiar de Subreceptor y/o Periodo"  >
                                                <i class=" glyphicon-restart "></i>
                                            </a>
                                        </li>
                                    <?php //endif; ?>

                                    <li>
                                        <a href="javascript:recargar_sesion_usuario();" class="loading-on" data-toggle="tooltip" data-placement="bottom" title="Recargar"  >
                                            <i class="icon-refresh"></i>
                                        </a>
                                    </li><li>
                                        <a href="#modal-pemar-datos-cedula" class=" loading-on  enable-tooltip" data-toggle="modal" data-placement="bottom" title="Consulta de Datos por Cédula">
                                            <i class="glyphicon-search"></i>
                                        </a>
                                    </li><li>
                                        <!-- Modal div is at the bottom of the page before including javascript code, we use .enable-tooltip class for the tooltip because data-toggle is used for modal -->
                                        <a href="#modal-user-account" class=" loading-on enable-tooltip" role="button" data-toggle="modal" data-placement="bottom" title="Configuración">
                                            <i class="glyphicon-cogwheel"></i>
                                        </a>
                                    </li><li>
                                        <a href="javascript:cerrar_sesion();" class="loading-on" data-toggle="tooltip" data-placement="bottom" title="Cerrar y salir">
                                            <i class="icon-signout"></i>
                                        </a>
                                    </li>
                                </ul>
                                <!-- END Header Nav -->

                                <!-- Mobile Navigation, Shows up on mobile -->
                                <ul class="nav pull-left visible-phone">
                                    <li>
                                        <!-- It is set to open and close the main navigation on mobiles. The class .nav-collapse was added to aside#page-sidebar -->
                                        <a href="javascript:void(0)" data-toggle="collapse" data-target=".nav-collapse">
                                            <i class="icon-reorder"></i>
                                        </a>
                                    </li>
                                    <li class="divider-vertical remove-margin"></li>
                                </ul>
                                <!-- END Mobile Navigation, Shows up on mobile -->
                            </div>
                            <!-- END Header Nav Section -->
                        </div>
                        <!-- END div#row-fluid -->
                    </div>
                    <!-- END Navbar Inner -->
                </header>
                <!-- END Header -->

                <?php
//print_r($_SESSION["SESION_USUARIO"]) ?>