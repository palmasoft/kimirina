
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-notes_2 themed-color"></i>Desempeño Mensual Monitor<br>
        <small>Desempeño Mensual Monitor</small></h1>
</div>
<!-- END Pre Page Content -->
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
            <a href="#">Coordinadores</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="#">Informes de Monitores</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Desempeño Mensual Monitor</a></li>
    </ul>

    <?php if (!$tieneRestricciones ): ?>            
        <?php $this->mostrar('formulariosGestion/formSubreceptorPeriodo', $this->datos, 'gestion'); ?>
    <?php endif; ?>
        
    <?php $this->mostrar("coordinadores/encabezadoFiltros", $this->datos); ?>    
    

    <div class="block block-themed block-last">
        <div class="block-title">
            <h4><a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Registro de Contactos"><i class="icon-arrow-up"></i></a>  Desempeño Mensual Monitores<small></small></h4>
        </div>
        <div class="block-content text-center" style="padding: 0px;">    
            <?php $this->mostrar("coordinadores/tablaDesempenoMonitores", $this->datos); ?>
        </div>
    </div>

    <?php //$this->mostrar( "formularios/modal", array() ); ?>
</div>

<script>
$(document).ready(function() {
    
    
        
        $('#form-control-subreceptor-periodo').submit(function(e) {            
            setTimeout(function(){ abrir_hoja_desempeno_monitor(); }, 1000);            
        });
    
    $('#form-encabezado-filtros').submit(function() {
       
        mostrar_contenidos( "supervision", "desempenoMonitores", 
                        "busqueda_desempeno_monitores", $(this).serialize()
        );
        
        
    });
    
});

function generarPDF(){
       
    mostrar_contenidos( 
        'supervision', 'desempenoMonitores', 'accion_generar_pdf',$('#form-encabezado-filtros').serialize()       
    ); 
}
function generarXLS(){
       
    mostrar_contenidos( 
        'supervision', 'desempenoMonitores', 'accion_generar_xls',$('#form-encabezado-filtros').serialize()       
    ); 
}
</script>
<script>
    agregar_boton_ayuda('BIENVENIDA');
</script>