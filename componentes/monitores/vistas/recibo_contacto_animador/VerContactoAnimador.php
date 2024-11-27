
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-barcode themed-color"></i> Recibo de Contacto por Animador<br>
        <small>Datos registrados del recibo de contacto por animador.</small>
    </h1>
</div>


<!-- Page Content -->
<div id="page-content">
    <!-- Breadcrumb -->
    <!-- You can have the breadcrumb stick on scrolling just by adding the following attributes with their values (data-spy="affix" data-offset-top="250") -->
    <!-- You can try it on other elements too :-), the sticky position and style can be adjusted in the css/main.css with .affix class -->
    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="205">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="javascript:abrir_tabla_recibo_contacto_animador();">Recibos de Contacto por Animador</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Recibo PEMAR</a></li>
    </ul>
    <!-- END Breadcrumb -->
    
    <?php $this->mostrar('recibo_contacto_animador/datosReciboContacto', $this->datos, 'monitores'); ?>

    </div>

</div>



<script>
    $(document).ready(function() {

    agregar_boton_ayuda('VERRECIBOSCONTACTO');

    });


</script>


