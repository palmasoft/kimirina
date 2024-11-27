

<!-- General Forms Block -->
<form id="form_cosultar_indicadores_subreceptor" class="form-inline" onsubmit="return false;" >
    <div class="block block-themed ">
        <!-- General Forms Title -->
        <div class="block-title">
            <h4>
                <small> SUBRECEPTOR :</small> <?php echo ($SubReceptor->NOMBRE_SUBRECEPTOR) ?>
                <?php echo ($SubReceptor->SIGLAS_SUBRECEPTOR ) ?>
            </h4>
            <div class="block-options" >
                <a href="javascript:abrir_form_nuevas_metas_subreceptor();" data-toggle="tooltip" title="Modificar los valores de las metas semestrales para el subreceptor elejido" class="btn btn-lg btn-success"><i class="icon-pencil"></i> Actualizar Metas </a>						                
            </div>
        </div>

        <div class="block-content">   

            <div class="row-fluid">
                <div class="span3"><label> Subreceptores</label> </div>
                <div class="span6">
                    <div id="lista-Subreceptores" class="">
                        <select id="subreceptor" name="subreceptor" class="select-chosen" style="width: 100%;" >
                            <?php
                            foreach ($SubReceptores as $subreceptor) {
                                $selected = "";
                                if ($subreceptor->ID_SUBRECEPTOR == $SubReceptor->ID_SUBRECEPTOR) {
                                    $selected = ' selected="" ';
                                }
                                echo '<option value="' . $subreceptor->ID_SUBRECEPTOR . '"  ' . $selected . ' >' . $subreceptor->SIGLAS_SUBRECEPTOR . ' - ' . $subreceptor->NOMBRE_SUBRECEPTOR . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="span3">                    
                    <button id="btn_guardar_registro_semanal_contactos" type="submit" class="btn btn-success"><i class="icon-bar-chart"></i> Consultar</button>                    
                </div>
            </div>

        </div>
    </div>
</form>
