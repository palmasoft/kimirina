
<div class="block block-themed ">
    <div class="block-title"><h4>Datos de la Atención del PEMAR</h4></div>
    <div class="block-content">

        <div class="control-group form-horizontal">
            <label for="fechaAtencion" class="control-label  "  >Fecha Atención: </label>
            <div class="controls"> 
                <h4><?php echo ($registrosAtencion->FECHA_ATENCION); ?></h4>
            </div>     
        </div>

        <div class="control-group form-horizontal">
            <label class="control-label" for="horizontal-select">Unidad de Salud:</label>
            <div class="controls"> 

                <h3><?php echo ($registrosAtencion->NOMBRE_CENTROSERVICIO); ?></h3>
            </div>
        </div>
        <!-- TIPO DE SERVICIO -->
        <div class="control-group form-horizontal">
            <label class="control-label" for="horizontal-select">Tipo de Atención:</label>
            <div class="controls"> 
               <h4> <?php echo $registrosAtencion->NOMBRE_SERVICIO ?></h4>
            </div>
        </div>

        <div class="control-group form-horizontal">
            <label class="control-label" for="cedula">Cédula:</label>
            <div class="controls">
                <?php echo isset($registrosAtencion) ? ($registrosAtencion->CEDULA_PEMAR) : ''; ?>
            </div>
        </div>

        <div class="control-group form-horizontal">
            <label class="control-label" for="codigoUnico">Código Único:</label>
            <div class="controls">
                <h3><?php echo isset($registrosAtencion) ? ($registrosAtencion->CODIGO_UNICO_PERSONA) : ''; ?></h3>
            </div>
        </div>

        <!-- NOMBRES y APELLIDOS -->
        <div class="control-group form-horizontal">
            <label class="control-label" for="nombreUno">Nombre(s) y Apellido(s):</label>
            <div class="controls">
                <?php echo isset($registrosAtencion) ? ($registrosAtencion->PRIMER_NOMBRE_PEMAR) : ''; ?>
                <?php echo isset($registrosAtencion) ? ($registrosAtencion->SEGUNDO_NOMBRE_PEMAR) : ''; ?>
                <?php echo isset($registrosAtencion) ? ($registrosAtencion->PRIMER_APELLIDO_PEMAR) : ''; ?>
                <?php echo isset($registrosAtencion) ? ($registrosAtencion->SEGUNDO_APELLIDO_PEMAR) : ''; ?>
            </div>
        </div>

        <div class="control-group form-horizontal">
            <label class="control-label">Fecha de Nacimiento:</label>
            <div class="controls ">
                <?php
                $valor = 0;
                if (isset($registrosAtencion)) {
                    echo $registrosAtencion->MES_NACIMIENTO_POBLACION;
                }
                ?>-<?php
                $valor = 0;
                if (isset($registrosAtencion)) {
                    echo $registrosAtencion->ANO_NACIMIENTO_POBLACION;
                }
                ?>                
            </div>
        </div>

        <!-- SUBRECEPTOR -->
        <div class="control-group form-horizontal">
            <label class="control-label" for="subreceptor">Subreceptor:</label>
            <div class="controls">
                <?php
                echo $_SESSION['SESION_USUARIO']->NOMBRE_SUBRECEPTOR;
                ?>
            </div>
        </div>
        <!-- TIPO PEMAR -->
        <div class="control-group form-horizontal">
            <label class="control-label" for="tiposPemars">Tipo Pemar:</label>
            <div class="controls"><strong>[<?php echo ($registrosAtencion->TIPO_FORMATO_ATENCION); ?>] </strong> <?php echo ($registrosAtencion->NOMBRE_TIPOPOBLACION); ?>
            </div>
        </div>
    </div>
</div>
