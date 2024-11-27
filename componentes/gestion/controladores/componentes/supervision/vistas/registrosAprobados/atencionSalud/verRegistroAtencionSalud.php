<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="fa-user-md themed-color"></i> Registro de Atencion en el Servicio de Salud Aprobado<br>
        <small>Todos los registros de atencion en salud</small>
    </h1>
</div>
<!-- END Pre Page Content -->
<div id="page-content">
    <!-- Breadcrumb -->
    <!-- You can have the breadcrumb stick on scrolling just by adding the following attributes with their values (data-spy="affix" data-offset-top="250") -->
    <!-- You can try it on other elements too :-), the sticky position and style can be adjusted in the css/main.css with .affix class -->
    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="205">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="javascript:abrir_listado_registro_atencion_salud();">Registros de Atencion en Salud</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Datos de la Atencion en Salud</a></li>
    </ul>
    <!-- END Breadcrumb -->
  

    
    
    <?php $this->mostrar("registro_atencion_salud/datosRegistroAtencionSalud", $this->datos, "monitores"); ?>
    
</div>



<script>
    $(document).ready(function() {


    });

</script>


