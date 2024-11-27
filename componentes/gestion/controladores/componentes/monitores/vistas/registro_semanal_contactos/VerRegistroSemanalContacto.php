<style>
    .controls, .control-label {        
    }
</style>

<div id="pre-page-content">
    <h1><i class="glyphicon-table themed-color"></i>Hoja de Registro Semanal de Alcances <?php echo ( $tipoPoblacion ); ?><br />
        <small><?php echo ( $mensaje); ?></small></h1>
</div>

<div id="page-content">
    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="250">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="javascript:mostrar_registros_semanales_contacto();">Hojas de Registro Semanal</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Hoja de Registro Semanal de Alcances <?php echo ( $tipoPoblacion); ?></a></li>
    </ul>
    <?php $this->mostrar('registro_semanal_contactos/datosFormatoContactos', $this->datos); ?>
</div>

<script>
</script>

