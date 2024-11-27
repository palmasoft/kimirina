
<!-- Page Content -->
<div id="page-content">
    <!-- Breadcrumb -->
    <!-- You can have the breadcrumb stick on scrolling just by adding the following attributes with their values (data-spy="affix" data-offset-top="250") -->
    <!-- You can try it on other elements too :-), the sticky position and style can be adjusted in the css/main.css with .affix class -->
    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="250">
        <li>
            <a href="index.php"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="#">Visores</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="">Documentos en formato portátil | PDF </a></li>
    </ul>

    <?php if (isset($RUTA)) { ?>        
        <div class="block block-themed block-last">  
            <div class="block-title">
                <h4>&nbsp;</h4>
                <div class="block-options">                    
                    <div class="btn-group">
                        <a class="btn btn-inverse  " href="<?php echo $RUTA ?>" target="_blank" >
                            <i class="glyphicon-download_alt"></i> Descargar
                        </a>
                        <a class="btn btn-inverse  " href="javascript:popup('<?php echo str_replace(DS, '/', $RUTA) ?>')" target="_blank" >
                            <i class="glyphicon-file_export"></i> Abrir en otra Ventana
                        </a>
                    </div>
                </div>
            </div>

            <div class="block-content text-center" style="padding: 0px;">                
                <iframe id="visor_pdf" style="width: 100%; height: 460px" src="<?php echo $RUTA ?>"></iframe>               
            </div>
        </div>
    <?php } ?>
</div>


<script>
    $(document).ready(function() {
        var hVen = screen.availHeight * 0.7;
        $('#visor_pdf').height(hVen);
    });

    function popup(url) {
        var ancho = screen.availWidth * 0.98;
        var alto = screen.availHeight * 0.9;
        var posicion_x;
        var posicion_y;

        posicion_x = (screen.width / 2) - (ancho / 2);
        posicion_y = (screen.height / 2) - (alto / 2);
        window.open(url, "SIMON.KIMIRINA.ORG", "width=" + ancho + ",height=" + alto + ",menubar=0,toolbar=0,directories=0,scrollbars=no,resizable=no,left=" + posicion_x + ",top=" + posicion_y + "");
    }

</script>


