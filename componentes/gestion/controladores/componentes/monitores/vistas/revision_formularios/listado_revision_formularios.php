
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-ok themed-color"></i> Revision de Registros<br>
        <small>Listado de los abordajes, contactos, consejerias y de los registro de atencion en salud</small>
    </h1>
</div>
<!-- END Pre Page Content -->


<!-- Page Content -->
<div id="page-content">

    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="205">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="#">Monitores</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Revision de Registros</a></li>
    </ul>

    <?php if (!$tieneRestricciones): ?>            
        <?php $this->mostrar('formulariosGestion/formSubreceptorPeriodo', $this->datos, 'gestion'); ?>
    <?php endif; ?>


    <!-- END Breadcrumb -->
    <?php $this->mostrar("revision_formularios/encabezadoGenerar", $this->datos); ?>

    <!-- TABLA DE CONTACTOS -->
    <?php if ($HSHTSTRANS) : ?>
        <div class="block  block-themed" >
            <div class="block-title">
                <h4><a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="Cerrar / Abrir Seccion de revision de Hojas de Registro Semanal"><i class="icon-arrow-up"></i></a>  
                    Hojas de Registro Semanal Alcances
                </h4>
                <div class="block-options">                    
                    <span class="text-center"><i class="icon-bolt"></i> <span id="registro-seleccionado-registro-semanal">clic sobre un registro</span></span>
                    <div class=" btn-group">
                        <a href="javascript:abrir_modal_registro_semanal();" data-toggle="tooltip" title="ver datos registrados de la Hoja de Registro Semanal seleccionada" 
                           class="btn btn-info"><i class="fa-search-plus"></i> Ver</a>                            
                        <a href="javascript:revisar_registro_registro_semanal();" data-toggle="tooltip" title="cambiar a estado REVISADO este registro" 
                           class="btn btn-inverse"> Revisar <i class="glyphicon-circle_ok"></i></a>
                        <a href="javascript:generar_reporte_revision_registro_semanal();" data-toggle="tooltip" title="generar reporte del ESTADO de la revision" 
                           class="btn btn-warning"><i class="fa-file-pdf-o"></i> Reporte</a> 						
                    </div>
                </div>   
            </div>
            <div class="block-content">
                <?php $this->mostrar("revision_formularios/tabla_registro_semanal_contactos", $this->datos); ?>
            </div>
        </div>
    <?php endif; ?>     
    
    

        <div class="block  block-themed" >
            <div class="block-title">
                <h4>
                    <a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="Cerrar / Abrir Seccion de revision de Recibos de Contactos por Animador"><i class="icon-arrow-up"></i></a>  
                    Recibo de Contacto por Animadores
                </h4>
                <div class="block-options">
                    <span class="text-center"><i class="icon-bolt"></i> <span id="registro-seleccionado-animadores">clic sobre un registro</span> </span>                                  
                    <div class=" btn-group">
                        <a href="javascript:abrir_modal_registro_animadores();" data-toggle="tooltip" title="ver datos registrados del Recibo de Contacto por Animador seleccionado" 
                           class="btn btn-info"><i class="fa-search-plus"></i> Ver</a>                            
                        <a href="javascript:revisar_registro_animadores();" data-toggle="tooltip" title="cambiar a estado REVISADO este registro" 
                           class="btn btn-inverse"> Revisar <i class="glyphicon-circle_ok"></i></a>	
                        <a href="javascript:generar_reporte_revision_recibos_animadores();" data-toggle="tooltip" title="generar reporte del ESTADO de la revision" 
                           class="btn btn-warning"><i class="fa-file-pdf-o"></i> Reporte</a> 	
                    </div>                
                </div> 
            </div>
            <div class="block-content">
                <?php $this->mostrar("revision_formularios/tabla_registros_animadores", $this->datos); ?>
            </div>  
        </div> 

    <!-- TABLA DE CONSEJERIAS -->
    <?php if ($PVVS) : ?>
        <div class="block  block-themed" >
            <div class="block-title">
                <h4>
                    <a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="Cerrar / Abrir Seccion de revision de Consejerias a PVVS"><i class="icon-arrow-up"></i></a>  
                    Registros de Consejerias a PVVS
                </h4>
                <div class="block-options">
                    <span class="text-center"><i class="icon-bolt"></i> <span id="registro-seleccionado-consejeria">clic sobre un registro</span> </span>                                  
                    <div class=" btn-group">
                        <a href="javascript:abrir_modal_registro_consejerias();" data-toggle="tooltip" title="ver datos registrados de la Consejeria a PVVS seleccionado" 
                           class="btn btn-info"><i class="fa-search-plus"></i> Ver</a>                            
                        <a href="javascript:revisar_registro_consejeria();" data-toggle="tooltip" title="cambiar a estado REVISADO este registro" 
                           class="btn btn-inverse"> Revisar <i class="glyphicon-circle_ok"></i></a>		
                        <a href="javascript:generar_reporte_revision_consejerias();" data-toggle="tooltip" title="generar reporte del ESTADO de la revision" 
                           class="btn btn-warning"><i class="fa-file-pdf-o"></i> Reporte</a> 	                           
                    </div>
                </div>  
            </div>
            <div class="block-content">
                <?php $this->mostrar("revision_formularios/tabla_registros_consejeria", $this->datos); ?>
            </div>
        </div>
    <?php endif; ?>       

    <div class="block  block-themed" >
        <div class="block-title">
            <h4>
                <a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="Cerrar / Abrir Seccion de revision de registros de Atencion en Salud"><i class="icon-arrow-up"></i></a>  
                Registros de Atencion en Salud
            </h4>
            <div class="block-options">
                <span class="text-center"><i class="icon-bolt"></i> <span id="registro-seleccionado-atencion_salud">clic sobre un registro</span> </span>                                  
                <div class=" btn-group">
                    <a href="javascript:abrir_modal_registro_atencion_salud();" data-toggle="tooltip" title="ver datos registrados de la Atencion en Unidad de Salud seleccionado" 
                       class="btn btn-info"><i class="fa-search-plus"></i> Ver</a>                            
                    <a href="javascript:revisar_registro_atencion_salud();" data-toggle="tooltip" title="cambiar a estado REVISADO este registro" 
                       class="btn btn-inverse"> Revisar <i class="glyphicon-circle_ok"></i></a>						
                    <a href="javascript:generar_reporte_revision_atencion_salud();" data-toggle="tooltip" title="generar reporte del ESTADO de la revision" 
                       class="btn btn-warning"><i class="fa-file-pdf-o"></i> Reporte</a> 	                       
                </div>
            </div>  
        </div>
        <div class="block-content">
            <?php
            $this->mostrar("revision_formularios/tabla_registros_salud", $this->datos);
            ?>     
        </div>
    </div>

    <!-- MODAL -->
    <?php $this->mostrar("revision_formularios/modal", array()); ?>   
</div>



<script>
    $(document).ready(function() {

        $('#form-control-subreceptor-periodo').submit(function(e) {
            if (estaVacio($('#subreceptor-form-control').val())) {
                alert('Seleccione un Subreceptor.');
                return false;
            }
            mostrar_listado_revision_formularios($(this).serialize());

        });

    });
</script>


