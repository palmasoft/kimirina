
<div id="pre-page-content">
    <h1>
        <i class="icon-thumbs-up-alt themed-color"></i> Aprobación de Registros de Abordaje<br>
        <small>Listado de registros EN REVISION</small>
    </h1>
</div>

<div id="page-content">

    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="205">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="#">Coordinadores</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Aprobación de Registros de Abordaje</a></li>
    </ul>


    <?php if (!$tieneRestricciones or Usuario::esDNI() ): ?>            
        <?php $this->mostrar('formulariosGestion/formSubreceptorPeriodo', $this->datos, 'gestion'); ?>
    <?php endif; ?>

    <?php $this->mostrar("aprobacion_formularios/encabezadoGenerar", $this->datos); ?>

    <!-- TABLA DE CONTACTOS -->
    <?php if ($HSHTSTRANS or ! $tieneRestricciones) : ?>
        <div class="block  block-themed" >
            <div class="block-title">
                <h4><a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Generales"><i class="icon-arrow-up"></i></a>  
                    Hojas de Registro Semanal Alcances
                </h4>
                <div class="block-options">                    
                    <span class="text-center"><i class="icon-bolt"></i> <span id="registro-seleccionado-registro-semanal">clic sobre un registro</span></span>
                    <div class=" btn-group">
                        <a href="javascript:abrir_modal_registro_semanal();" data-toggle="tooltip" title="ver datos registrados del registro" 
                           class="btn btn-info"><i class="fa-search-plus"></i> Ver</a>                            
                        <a href="javascript:aprobar_registro_registro_semanal();" data-toggle="tooltip" title="cambiar a estado APROBADO este registro" 
                           class="btn btn-success"> Aprobar <i class="fa-thumbs-up"></i></a>
                        <a href="javascript:generar_reporte_revision_registro_semanal();" data-toggle="tooltip" title="generar reporte del ESTADO de la revision" 
                           class="btn btn-warning"><i class="fa-file-pdf-o"></i> Reporte</a> 						
                    </div>
                </div>   
            </div>
            <div class="block-content">
                <?php $this->mostrar("revision_formularios/tabla_registro_semanal_contactos", $this->datos); ?>
            </div>
        </div>




        <div class="block  block-themed" >
            <div class="block-title">
                <h4>
                    <a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Generales"><i class="icon-arrow-up"></i></a>  
                    Recibo de Contacto por Animadores
                </h4>
                <div class="block-options">
                    <span class="text-center"><i class="icon-bolt"></i> <span id="registro-seleccionado-animadores">clic sobre un registro</span> </span>                                  
                    <div class=" btn-group">
                        <a href="javascript:abrir_modal_registro_animadores();" data-toggle="tooltip" title="ver datos registrados del registro" 
                           class="btn btn-info"><i class="fa-search-plus"></i> Ver</a>                            
                        <a href="javascript:aprobar_registro_animadores();" data-toggle="tooltip" title="cambiar a estado APROBADO este registro" 
                           class="btn btn-success">Aprobar <i class="fa-thumbs-up"></i></a>	
                        <a href="javascript:generar_reporte_revision_recibos_animadores();" data-toggle="tooltip" title="generar reporte del ESTADO de la revision" 
                           class="btn btn-warning"><i class="fa-file-pdf-o"></i> Reporte</a> 	
                    </div>                
                </div> 
            </div>
            <div class="block-content">
                <?php $this->mostrar("revision_formularios/tabla_registros_animadores", $this->datos); ?>
            </div>  
        </div> 

    <?php endif; ?>    



    
    <?php if (!$PVVS or ! $tieneRestricciones) : ?>
    <div class="block  block-themed" >
        <div class="block-title">
            <h4>
                <a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Generales"><i class="icon-arrow-up"></i></a>  
                Registros de Atencion en Salud
            </h4>
            <div class="block-options">
                <span class="text-center"><i class="icon-bolt"></i> <span id="registro-seleccionado-atencion_salud">clic sobre un registro</span> </span>                                  
                <div class=" btn-group">
                    <a href="javascript:abrir_modal_registro_atencion_salud();" data-toggle="tooltip" title="ver datos registrados del registro" 
                       class="btn btn-info"><i class="fa-search-plus"></i> Ver</a>                            
                    <a href="javascript:aprobar_registro_atencion_salud();" data-toggle="tooltip" title="cambiar a estado APROBADO este registro" 
                       class="btn btn-success">Aprobar <i class="fa-thumbs-up"></i></a>                     
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
    <?php endif; ?>       


    <!-- TABLA DE CONSEJERIAS -->
    <?php if ($PVVS or ! $tieneRestricciones) : ?>
        <div class="block  block-themed" >
            <div class="block-title">
                <h4>
                    <a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Generales"><i class="icon-arrow-up"></i></a>  
                    Registros de Consejerias a PVVS
                </h4>
                <div class="block-options">
                    <span class="text-center"><i class="icon-bolt"></i> <span id="registro-seleccionado-consejeria">clic sobre un registro</span> </span>                                  
                    <div class=" btn-group">
                        <a href="javascript:abrir_modal_registro_consejerias();" data-toggle="tooltip" title="ver datos registrados del registro" 
                           class="btn btn-info"><i class="fa-search-plus"></i> Ver</a>                            
                        <a href="javascript:aprobar_registro_consejeria();" data-toggle="tooltip" title="cambiar a estado APROBADO este registro" 
                           class="btn btn-success">Aprobar <i class="fa-thumbs-up"></i></a>		
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
            mostrar_listado_aprobacion_formularios($(this).serialize());

        });


    });
</script>



<script>
    agregar_boton_ayuda('APROBACOORDINAMANUAL');
</script>