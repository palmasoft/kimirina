

<div id="pre-page-content">
    <h1><i class="glyphicon-notes_2 themed-color"></i>Consolidado Mensual Derivados Efectivos por Promotor<br>
        <small>Informe de consolidado mensual de promotores</small></h1>
</div>

<div id="page-content">
   <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="250">
        <li>
            <a href="index.php"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="#">Monitores</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="#">Informes de Promotores</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Consolidado Mensual de Promotores</a></li>
    </ul>
    
    

    <?php if (!$tieneRestricciones ): ?>            
        <?php $this->mostrar('formulariosGestion/formSubreceptorPeriodo', $this->datos, 'gestion'); ?>
    <?php endif; ?>
    
    <?php $this->mostrar("monitores/encabezadoFiltros", $this->datos); ?>

    <div class="block block-themed block-last">
        <div class="block-title">
            <h4><a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Registro de Contactos"><i class="icon-arrow-up"></i></a>  Informe Consolidado Mensual Promotores<small></small></h4>
        </div>
        <div class="block-content text-center" style="padding: 0px;">    
            <?php $this->mostrar("monitores/tablaConsolidadoPromotores", $this->datos); ?>
        </div>
    </div>

</div>

<script>
    $(document).ready(function() {
        
        
        
        $('#form-control-subreceptor-periodo').submit(function(e) {            
            setTimeout(function(){ abrir_consolidado_mensual_promotores(); }, 1000);            
        });
        
        $('#form-encabezado-filtros').submit(function() {
        mostrar_contenidos("supervision", "consolidadopromotores", 
                        "busqueda_vista_consolidado_promotores", $(this).serialize());

        });
       
    }); 
    
    
    
function generarPDF(){      
    mostrar_contenidos( 
        'supervision', 'consolidadopromotores', 'accion_generar_pdf',$('#form-encabezado-filtros').serialize()       
    );  
}
function generarXLS(){
    mostrar_contenidos( 
        'supervision', 'consolidadopromotores', 'accion_generar_xls',$('#form-encabezado-filtros').serialize()       
    );  
}
        
</script>

<script>
    agregar_boton_ayuda('BIENVENIDA');
</script>