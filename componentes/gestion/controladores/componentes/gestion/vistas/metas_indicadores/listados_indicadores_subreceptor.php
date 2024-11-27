
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-stats themed-color"></i> Metas e Indicadores<br>
        <small>Listado de Indicadores de Desempeño por Subreceptor.</small>
    </h1>
</div>
<!-- END Pre Page Content -->


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
            <a href="#">Gestion</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Metas e Indicadores del Subreceptor</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <?php if (!$tieneRestricciones): ?>         
        <?php $this->mostrar("metas_indicadores/formIndicadoresSubreceptor", $this->datos); ?>  
    <?php endif; ?>
    
        <?php $this->mostrar("metas_indicadores/tablaMetasIndicadores", $this->datos); ?>  

</div>



<script>
    $(document).ready(function() {


        $('#form_cosultar_indicadores_subreceptor').submit(function(e) {
            cambiar_listado_indicadores_proyecto_subreceptor($(this).serialize());
        });


    });


    function abrir_form_nuevas_metas_subreceptor() {
        var idFila = $('#subreceptor').val();
        if (idFila != '') {
            agregar_nuevas_metas_por_subreceptor(idFila);
        } else {
            alert('Seleccione un subreceptor');
        }
    }

</script>


