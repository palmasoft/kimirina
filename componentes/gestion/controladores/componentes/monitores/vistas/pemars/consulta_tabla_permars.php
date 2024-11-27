<div id="resultados" class="block-title"></div>

<table id="tblPemars" class="table table-striped bordered" >
    <thead>
        <tr>
            <th colspan="2">DATOS DEL PEMAR</th>
        </tr>
    </thead>
    <tbody>
        <?php if (isset($pemarsDatos) && !empty($pemarsDatos)) { ?>                
            <tr>
                <th>Codigo</th>
                <td><?php echo ($pemarsDatos->CODIGO_UNICO_PERSONA) ?></td>
            </tr>
            <tr>
                <th>Tipo</th>
                <td><?php echo ($pemarsDatos->CODIGO_TIPOPOBLACION) ?></td>
            </tr>
            <tr>
                <th>Provincia</th>
                <td><?php echo ($pemarsDatos->NOMBRE_PROVINCIA) ?></td>
            </tr>
            <tr>
                <th>Canton</th>
                <td><?php echo ($pemarsDatos->NOMBRE_CANTON) ?></td>
            </tr>
            <tr>
                <th>Nombre Completo</th>
                <td><?php echo ($pemarsDatos->NOMBRE_UNO_POBLACION) ?> <?php echo ($pemarsDatos->NOMBRE_DOS_POBLACION) ?> <?php echo ($pemarsDatos->APELLIDO_UNO_POBLACION) ?> <?php echo ($pemarsDatos->APELLIDO_DOS_POBLACION) ?></td>
            </tr>
            <tr>
                <th>Nacimiento</th>
                <td><?php echo ($pemarsDatos->MES_NACIMIENTO_POBLACION) ?> - <?php echo ($pemarsDatos->ANO_NACIMIENTO_POBLACION) ?></td>
            </tr>
            <tr>
                <th>Otro Nombre</th>
                <td><?php echo ($pemarsDatos->OTRO_NOMBRE_POBLACION) ?></td>
            </tr>
            <tr>
                <th>Cedula</th>
                <td><?php echo ($pemarsDatos->CI_POBLACION) ?></td>
            </tr>
            <tr>
                <th>Numero de telefono</th>
                <td><?php echo ($pemarsDatos->NUMERO_TELEFONO_POBLACION) ?></td>
            </tr>
            <tr>
                <th>Correo</th>
                <td><?php echo ($pemarsDatos->CORREO_POBLACION) ?></td>
            </tr>
        </tbody>
    </table>

    <hr />    
    <table id="tbl-abordajes-pemars" class="table table-striped " >
        <thead>
            <tr> <th colspan="5">Abodajes</th></tr>
            <tr>
                <th>Subreceptor</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Tipo de Agente</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($registrosContactoAnimador)) {
                foreach ($registrosContactoAnimador as $contactoAnimador) {
                    ?>
                    <tr>
                        <td><?php echo ($contactoAnimador->NOMBRE_SUBRECEPTOR) ?> [<?php echo ($contactoAnimador->SIGLAS_SUBRECEPTOR) ?>]</td>
                        <td><?php echo $contactoAnimador->ANO_CONTACTOANIMADOR . "-" . $contactoAnimador->MES_CONTACTOANIMADOR . "-" . $contactoAnimador->DIA_CONTACTOANIMADOR; ?></td>
                        <td><?php echo ($contactoAnimador->HORA_CONTACTOANIMADOR) ?></td>
                        <td>Animador</td>                        
                        <td><?php echo ($contactoAnimador->NOMBRE_REAL_PERSONA) ?></td>
                    </tr>
                    <?php
                }
            }

            if (!empty($registrosContactoSemanal)) {
                foreach ($registrosContactoSemanal as $contactoSemanal) {
                    ?>
                    <tr>
                        <td><?php echo ($contactoSemanal->NOMBRE_SUBRECEPTOR) ?> [<?php echo ($contactoSemanal->SIGLAS_SUBRECEPTOR) ?>]</td>
                        <td><?php echo $contactoSemanal->FECHA_CONTACTO ?></td>
                        <td><?php echo ($contactoSemanal->HORA_CONTACTO) ?></td>
                        <td>Promotor</td>
                        <td><?php echo ($contactoSemanal->NOMBRE_REAL_PERSONA) ?></td>
                    </tr>
                    <?php
                }
            }

            if (!empty($registrosConsejeriaPVVS)) {
                foreach ($registrosConsejeriaPVVS as $registroConsejeria) {
                    ?>
                    <tr>
                        <td><?php echo ($registroConsejeria->NOMBRE_SUBRECEPTOR) ?> [<?php echo ($registroConsejeria->SIGLAS_SUBRECEPTOR) ?>]</td>
                        <td><?php echo $registroConsejeria->FECHA_CONSEJERIA ?></td>
                        <td><?php echo ($registroConsejeria->HORA_INICIO) ?></td>
                        <td>Consejero</td>
                        <td><?php echo ($registroConsejeria->NOMBRE_REAL_PERSONA) ?></td>
                    </tr>
                    <?php
                }
            }
        }
        ?>
    </tbody>
</table>
<hr />
<table id="tbl-atencion-salud-pemars" class="table table-striped "  >
    <thead>
        <tr>
            <th colspan="5" >Registros de Atención en Salud</th>
        </tr>
        <tr>
            <th>Subreceptor</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Centro Salud</th>
            <th>Servicio</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($registroAtencion)) {
            foreach ($registroAtencion as $regAtencion) {
                ?>
                <tr>
                    <td><?php echo ($regAtencion->NOMBRE_SUBRECEPTOR) ?></td>
                    <td><?php echo $regAtencion->FECHA_ATENCION ?></td>
                    <td><?php echo ($regAtencion->HORA_ATENCION) ?></td>
                    <td><?php echo ($regAtencion->NOMBRE_CENTROSERVICIO) ?></td>
                    <td><?php echo ($regAtencion->NOMBRE_SERVICIO) ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#tbl-abordajes-pemars').dataTable();
        $('#tbl-atencion-salud-pemars').dataTable();
    });
</script>