
<div id="pre-page-content">
    <h1>
        <i class="fa-user-md themed-color"></i> Registro de Atención en Unidades de Salud<br>
        <small>Listado de registros de atención en salud</small>
    </h1>
</div>

<div id="page-content">
    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="205">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="javascript:abrir_listado_registro_atencion_salud();">Registros de Atención en Salud</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Datos de la Atención en Salud</a></li>
    </ul>
    
    <?php $this->mostrar("registro_atencion_salud/datosRegistroAtencionSalud", $this->datos); ?>
    
</div>



<script>
    $(document).ready(function() {


    agregar_boton_ayuda('VERATENCIONSALUD');
    });

</script>


<script>
</script>