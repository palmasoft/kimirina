<?php include 'inc/config.php';   // Configuration php file            ?>

<html lang="es" >
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
            <!-- The roboto font is included from Google Web Fonts -->
            <?php $plantilla->min_css(); ?> 

            <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,400italic,700,700italic">        
            <link rel="stylesheet" href="plantillas/flatapp/css/main.css">   
            <link rel="stylesheet" href="plantillas/flatapp/css/themes.css">     
            <?php if ($template['theme']) { ?>
                <link id="theme-link" rel="stylesheet" href="plantillas/flatapp/css/themes/<?php echo $template['theme']; ?>.css">
            <?php } ?>        
            <!-- END Stylesheets -->

        </head>

        <body class="login" onload=" " >

            <a id="login-marco" href="#" target="_blank" class="login-btn themed-background-default brillo-login" >
                <span class="login-logo">
                    <span class="square1 themed-border-default"></span>
                    <span class="square2"></span>
                    <img src="archivos/<?php echo $params->valor('LOGOMINI') ?>" style="">
                    <span class="name"></span>
                </span>
            </a>
            <div class="left-door"></div>
            <div class="right-door"></div>


            <div id="login-container" class="hide">
                <!-- Login Block -->
                <div class="block-tabs block-themed themed-border-night">

                    <style>
                        #aviso-navegador {
                            width: 100%;
                            background-color:#FFFFCC;
                            border:5px solid #EE5113;
                            color:#333333;
                            font-size:9pt;
                            height:auto;
                            line-height:12pt;
                            padding:15px;
                            z-index:999;
                            text-align: center;
                            visibility:visible !important;
                        }
                    </style>
                    <div id="aviso-navegador" style="display: none;" >
                        <p><strong>AVISO Y RECOMENDACIÓN</strong></p>
                        <p>Su navegador web <strong>está obsoleto</strong> o <strong>no es compatible</strong> con el sistema, lo cual puede provocar que <strong>ciertos elementos se muestren descolocados o no se carguen correctamente</strong>. 
                            Además, <strong>tampoco se verán bien</strong>, otras webs como <strong>Youtube o Facebook, entre otras muchas.</strong></p>
                        <p><strong>Es necesario actualizar o instalar el navegador web <a href="http://www.google.com/chrome" target="_blank">Google Chrome</a>.</p>
                        <p>Ah, y no olvides guardarla en favoritos! <strong>Muchas gracias :)</strong></p>
                    </div>

                    <div id="login-block" >

                        <ul id="login-tabs" class="nav nav-tabs themed-background-deepsea" data-toggle="tabs">
                            <li class="active text-center">
                                <a href="#login-form-tab">
                                    <i class="icon-user"></i> Ingresar
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="login-form-tab">
                                <!-- Login Buttons
                                <div id="login-buttons">
                                    <button id="login-btn-facebook" class="btn btn-large btn-primary"><i class="icon-facebook"></i> Facebook</button>
                                    <button id="login-btn-twitter" class="btn btn-large btn-info"><i class="icon-twitter"></i> Twitter</button>
                                </div> -->
                                <!-- END Login Buttons -->
                                <img src="imagenes/simonFondoBlancoMini.jpg" style="width: 100%;" />
                                <!-- Login Form -->
                                <form id="login-form" class="form-inline">
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="input-prepend">
                                                <span class="add-on"><i class="icon-envelope-alt"></i></span>
                                                <input type="text" id="login-user" name="login-user" placeholder="tu usuario.." required >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="input-prepend">
                                                <span class="add-on"><i class="icon-asterisk"></i></span>
                                                <input type="password" id="login-password" name="login-password" placeholder="la clave.." required  >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="controls clearfix">
                                            <div class="pull-right">
                                                <button type="submit" class="btn btn-success remove-margin">ir al panel de control</button>
                                            </div>
                                            <div class="pull-left login-extra-check" style="display: none;">
                                                <label for="login-remember-me">
                                                    <input type="checkbox" id="login-remember-me" name="login-remember-me" class="input-themed">
                                                    permanecer conectado
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- END Login Form -->
                            </div>
                            <div class="tab-pane" id="register-form-tab">
                                <!-- Register Form -->

                                <!-- END Register Form -->
                            </div>
                        </div>

                    </div>    
                </div>
                <!-- END Login Block -->
            </div>
            <!-- END Login Container -->

            <audio autoplay="" controls style="display:none;" >
                <source src="archivos/audios/sweet-bouncy-and-bright.ogg" type="audio/ogg">
                <source src="archivos/audios/sweet-bouncy-and-bright.mp3" type="audio/mpeg">                
            </audio>

            <div id="cargando"> </div>
            <?php $plantilla->min_js(); ?>

            <script src="plantillas/flatapp/js/main.js"></script>
            <script src="plantillas/flatapp/js/login.js"></script>
            <script> _RECARGAR_SALIR  = true; </script>            
            <?php
            include 'inc/bottom.php';

            