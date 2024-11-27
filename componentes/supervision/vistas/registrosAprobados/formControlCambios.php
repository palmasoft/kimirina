<form id="frm-control-cambios" onsubmit="return false;" >
<div class="block block-themed block-last"> 
    <div class="block block-themed ">
        <div class="block-title">
            <h4>
                <a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Generales"><i class="icon-arrow-up"></i></a>  
                Supervision y Control
            </h4>
            <div class="block-options">                    
                <div class=" btn-group">         
                    <a href="javascript:no_aprobar_registro_aprobado();" data-toggle="tooltip" title="Cambiar a estado NO APROBADO este registro" class="btn btn-danger"> No Aprobado <i class="glyphicon-thumbs_down"></i></a>
                    <a href="javascript:confirmar_eliminar_registro_aprobado();" data-toggle="tooltip" title="eliminar este registro del sistema." class="btn btn-lg btn-danger"><i class="glyphicon-remove"></i> Eliminar</a>
                </div>
            </div>
        </div>
        <div class="block-content">
            <div class="control-group inline" >
                <label class="control-label" >Razones de Modificacion</label>
                <div class="controls">
                    <textarea id="razones_cambios_registro" name="razones_cambios_registro" class="span12"  rows="4" required=""></textarea>
                </div>     
            </div>
        </div>
    </div>
</div>
</form>