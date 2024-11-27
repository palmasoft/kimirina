<style>
    .controls, .control-label {        
    }
</style>
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-notes_2 themed-color"></i>Registro Semanal de Alcances <?php echo ( $tipoPoblacion ); ?> APROBADO<br><small><?php echo ( $mensaje); ?></small></h1>
</div>
<!-- END Pre Page Content -->

<!-- Page Content -->
<div id="page-content">
    <!-- Breadcrumb -->
    <!-- You can have the breadcrumb stick on scrolling just by adding the following attributes with their values (data-spy="affix" data-offset-top="250") -->
    <!-- You can try it on other elements too :-), the sticky position and style can be adjusted in the css/main.css with .affix class -->
    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="250">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="javascript:mostrar_lista_aprobados_registro_semanal();">Listado Registro</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Registro Semanal de Alcances <?php echo ( $tipoPoblacion); ?> Aprobado</a></li>
    </ul>
    
        <?php $this->mostrar('registro_semanal_contactos/datosFormatoContactos', $this->datos, 'monitores'); ?>
    

</div>

<script>

</script>

