
<div id="pre-page-content">
    <h1><i class="glyphicon-dashboard themed-color"></i>Panel de Control<br>
        <small>Bienvenido <strong><?php echo $_SESSION["SESION_USUARIO"]->NICK ?></strong>. Listos para empezar trabajar!</small></h1>
</div>

<div id="page-content">
    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="205">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="javascript:panel_control();">Panel de Control</a> 
        </li>
    </ul>

    <?php //print_r( $_SESSION['SESION_USUARIO'] ); ?>

    <div style="text-align: center;" >

        <ul id="js-news" class="js-hidden">
            <?php foreach ($mensajes as $Mensaje) : ?>
                <li class="news-item "><?php echo $Mensaje->CONTENIDO_MENSAJESISTEMA ?></li>
            <?php endforeach; ?>
        </ul>

        <img src="imagenes/simonFondoBlanco.jpg" style="width: 100%;" />
    </div>
    <script>
    $(document).ready(function() {
        $('#js-news').ticker({
            titleText: 'Mensajes'
            , displayType: 'reveal'
            , speed: 1
            , fadeInSpeed: 300
            , pauseOnItems: 2000
        });


        informacion(
            "<h2>DIGITADOR!!!!</h2> <strong>¿Ya terminaste de digitar del periodo activo?</strong> Puedes adelantar del periodo siguiente.<br /> "+
            "Primero debes hacer clic en el icono </h2><i class='glyphicon-restart' ></i></h2> que se encuentra en la parte superior derecha de la ventana. " +
            "Luego, aparecerá una pequeña ventana donde debes seleccionar el periodo siguiente del lista de periodos y luego debe dar clic al botón <strong>CAMBIAR</strong> "
            );

        alert(
            "<strong>ATENCIÓN:</strong> Es necesario realizar una <strong>revision de todos los registros digitados y verificar que no se encuentrén repetidos</strong>. En caso tal, se debe eliminar el duplicado.<br />"+
            "Recuerden que una vez se ha aprobado un registro, solo puede ser consultado por el COORDINADOR desde la función \"registros aprobados\". "
            );


    });
    </script>

    <?php //include 'inc/accesos-directos.php' ?>
    <div class="row-fluid">
        <div class="span6"><?php //include 'inc/notificaciones.php'      ?></div>
        <div class="span6"><?php //include 'inc/quick-stats.php'      ?></div>
    </div>        

</div>