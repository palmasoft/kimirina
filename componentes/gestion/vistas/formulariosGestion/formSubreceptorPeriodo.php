<style>
    #form-control-subreceptor-periodo label{
        width:auto;
    }
    #form-control-subreceptor-periodo .controls {
        margin-left: 20px;
    }
</style>

<form id="form-control-subreceptor-periodo" class="form-horizontal" onsubmit="return false;" style=" <?php if($_SESSION['SESION_USUARIO']->CONTROL_SR_PERIODO == "NO" ){ echo "display: none;"; }?> "  >
    <div class="block block-themed block-tiles-animated ">
        <div class="block-title">
            <h4>
                <a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Generales"><i class="icon-arrow-up"></i></a>
                Control de Subreceptor y Periodo
            </h4>
            <div class="block-options">
                <button id="btn_cambiar_subreceptor_periodo" type="submit" class="btn btn-warning"><i class="icon-refresh"></i> Cambiar</button>
            </div>
        </div>
        <div class="block-content ">
            <div class="row-fluid ">
                <div class="span7 text-center">
                    <label class="control-label">Subreceptor</label>
                    <div class="controls" >
                        <?php //print_r($SubReceptor); ?>
                        <select id="subreceptor-form-control" name="subreceptor-form-control" class="select-chosen  span10"  >                                                
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

                <div class="span5 text-center">
                    <label class="control-label" for="periodos-form-control">Periodo:</label>
                    <div class="controls">
                        <?php $this->formularios->lista_periodos('form-control', ' periodos select-chosen  ', $Periodo); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


<script>
    $(document).ready(function() {
        //$('#btn_cambiar_subreceptor_periodo').on('click', function(e) {
         $('#form-control-subreceptor-periodo').submit(function(e) {             
            if ($(this).valid()) {
                 cambiar_datos_subreceptor($("#subreceptor-form-control").val(),  $("#periodo-form-control").val());
            }
           
        });
    });

</script>