<style>
    #form-control-subreceptor-periodo label{
        width:auto;
    }
    #form-control-subreceptor-periodo .controls {
        margin-left: 20px;
    }
</style>
<form id="form-control-subreceptor-periodo-modal" class="form-horizontal" onsubmit="return false;" >



    <!-- Regular Modal -->
    <div id="modal-controlsrperiodo" class="modal hide fade" >
        <div class="modal-header">            
            <h4>Cambiar de Subreceptor y Periodo</h4>
        </div>
        <div class="modal-body" style="height: 200px;" >
            <div class=" ">
                <label class="label" for="periodos-form-control-modal">Subrecetor:</label>
                <div class="controls">
                    <select id="subreceptor-form-control-modal" name="subreceptor-form-control-modal" class="select-chosen "  >                                                
                        <?php
                        foreach ($SubReceptores as $subreceptor) {
                            $selected = "";
                            if (isset($SubReceptor)) {
                                if ($subreceptor->ID_SUBRECEPTOR == $SubReceptor->ID_SUBRECEPTOR) {
                                    $selected = " selected ";
                                }
                            }
                            ?>
                            <option value="<?php echo $subreceptor->ID_SUBRECEPTOR ?>"   data-siglas="<?php echo $subreceptor->SIGLAS_SUBRECEPTOR ?>"   <?php echo $selected; ?> ><?php echo ($subreceptor->SIGLAS_SUBRECEPTOR) ?> - <?php echo ($subreceptor->NOMBRE_SUBRECEPTOR) ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class=" ">
                <label class="label" for="periodos-form-control-modal">Periodo:</label>
                <div class="controls">
                    <?php $this->formularios->lista_periodos('form-control-modal', ' periodos select-chosen  ', $Periodo); ?>
                </div>
            </div>
            <div style="clear: both;" ></div>
            <br />
            <div class=" ">                    
                <div class="controls"> 
                    ¿Mostrar el Control de Subreceptor y Periodo?
                        <label for="chk_se_muestra1">
                            <input type="radio" id="chk_se_muestra1" name="chk_se_muestra" class="input-themed" value="SI" <?php if($_SESSION['SESION_USUARIO']->CONTROL_SR_PERIODO == "SI" ){ echo ' checked="" '; }?> > Mostrar
                        </label>
                        <label for="chk_se_muestra2">
                            <input type="radio" id="chk_se_muestra2" name="chk_se_muestra" class="input-themed" value="NO" <?php if($_SESSION['SESION_USUARIO']->CONTROL_SR_PERIODO == "NO" ){ echo ' checked="" '; }?> > Ocultar
                        </label>                    
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button id="btn_cerrar_cambiar_subreceptor_periodo" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            <button id="btn_cambiar_subreceptor_periodo" type="submit" class="btn btn-warning"><i class="icon-refresh"></i> Cambiar</button>
        </div>
    </div>
    <!-- END Regular Modal -->


</form>


<script>
    $(document).ready(function() {

        //$(".select-chosen").chosen();        
        //$('.input-themed').iCheck();  

        $('#btn_cerrar_cambiar_subreceptor_periodo').on('click', function(e) {
            $('#modal-controlsrperiodo').modal('close');
            $("#modal-sp").html('');
        });

        $('#form-control-subreceptor-periodo-modal').submit(function(e) {
            if ($(this).valid()) {                
                cambiar_datos_subreceptor_modal(
                    $("#subreceptor-form-control-modal").val(), $("#periodo-form-control-modal").val(),
                    $('input[name=chk_se_muestra]:checked').val()
                );
            }

        });
    });

</script>
<script>
    agregar_boton_ayuda('BIENVENIDA');
</script>