
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1><i class="glyphicon-notes_2 themed-color"></i>Desempeño de Promotores<br>
        <small>Desempeño Mensual de promotores</small></h1>
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
            <a href="#">Monitores</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Desempeño Mensual Promotores</a></li>
    </ul>
    
    <?php if (!$tieneRestricciones ): ?>            
        <?php $this->mostrar('formulariosGestion/formSubreceptorPeriodo', $this->datos, 'gestion'); ?>
    <?php endif; ?>
    

    <?php $this->mostrar("monitores/encabezadoFiltros", $this->datos); ?>
    

    <div class="block block-themed block-last">
        <div class="block-title">
            <h4><a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Registro de Contactos"><i class="icon-arrow-up"></i></a>  Desempeño Mensual Promotores<small></small></h4>
        </div>
        <div class="block-content text-center" style="padding: 0px;">    
            <?php $this->mostrar("monitores/tablaDesempenoPromotores", $this->datos); ?>
        </div>
    </div>

    <?php //$this->mostrar( "formularios/modal", array() ); ?>
</div>

<script>
$(document).ready(function() {
    
    
        $('#form-control-subreceptor-periodo').submit(function(e) {            
            setTimeout(function(){ abrir_hoja_desempeno_promotor(); }, 1000);            
        });

    $('#provincia-chosen').on('change', function(evt, params) {
        cargar_cantones('listado-cantones', 'sel-lista-cantones', $(this).val());
    });

    $('#monitor-formulario').on('change', function(evt, params) {
        cargar_promotores('lista-promotores', 'promotor-formulario', $(this).val());
    });

     $('#form-encabezado-filtros').submit(function() {
       
        mostrar_contenidos( "supervision", "desempenoPromotores", 
                        "cargar_vista_desempeno_promotores_filtro", $(this).serialize()
        );
    });
});

function generarPDF(){
    
    mostrar_contenidos( 
        'supervision', 'desempenoPromotores', 'accion_generar_pdf',$('#form-encabezado-filtros').serialize()       
    ); 
}

function generarXLS(){
    mostrar_contenidos( 
        'supervision', 'desempenoPromotores', 'accion_generar_xls',$('#form-encabezado-filtros').serialize()       
    );  
}
</script>
<script>
    agregar_boton_ayuda('BIENVENIDA');
</script>

