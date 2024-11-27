
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-user themed-color"></i> PEMAR (Población en Mayor Riesgo)<br>
        <small>Registro de las Personas de Mayor Riesgo en el sistema</small>
    </h1>
</div>

<div id="page-content">

    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="205">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="javascript:abrir_listado_pemars();">Listado PEMARS</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Recibo PEMARS</a></li>
    </ul>

    <div class="block  block-themed" >
        <div class="block-title">
            <h4>
                <a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Generales"><i class="icon-arrow-up"></i></a>  
                Datos 
            </h4>
            <div class="block-options">            
            </div>  
        </div>
        <div class="block-content"> 

            <form id="form-pemars-arv" class="form-horizontal" onsubmit="return false;" >                
                <input type="hidden" id="registro-id" name="registro-id" value="<?php echo isset($pemar) ? ($pemar->ID_POBLACION) : ''; ?>" />         
                <div class="control-group">
                    <label class="control-label" for="id_tipo_poblacion">Tipo de Población</label>
                    <div class="controls">
                        <select id="tipoPoblacion" name="tiposPoblacion" class="select-chosen" >
                            <option value >Seleccione una</option>
                            <?php
                            foreach ($tiposPoblacion as $tipo) {
                                $selected = "";
                                if (isset($pemar))
                                    if ($pemar->ID_TIPOPOBLACION == $tipo->ID_TIPOPOBLACION)
                                        $selected = "selected";

                                echo ('<option value="' . $tipo->ID_TIPOPOBLACION . '" ' . $selected . ' >' . $tipo->NOMBRE_TIPOPOBLACION . '</option>');
                            }
                            ?>
                        </select>

                    </div>
                </div>
                <!-- NOMBRES y APELLIDOS -->
                <div class="control-group form-horizontal">
                    <label class="control-label" for="nombreUno">Nombre(s) y Apellido(s) </label>
                    <div class="controls">
                        <input type="text" id="primer-nombre" name="nombre_uno_poblacion" class="soloLetras generadores-codigo validar_cedula_codigo" value="<?php echo isset($pemar) ? ($pemar->NOMBRE_UNO_POBLACION) : ''; ?>" placeholder="Primer nombre"  />
                        <input type="text" id="segundo-nombre" name="nombre_dos_poblacion" class="soloLetras generadores-codigo validar_cedula_codigo" value="<?php echo isset($pemar) ? ($pemar->NOMBRE_DOS_POBLACION) : ''; ?>" placeholder="Segundo nombre"  />
                        <input type="text" id="primer-apellido" name="apellido_uno_poblacion" class="soloLetras generadores-codigo validar_cedula_codigo" value="<?php echo isset($pemar) ? ($pemar->APELLIDO_UNO_POBLACION) : ''; ?>" placeholder="Primer Apellido"  />
                        <input type="text" id="segundo-apellido" name="apellido_dos_poblacion" class="soloLetras generadores-codigo validar_cedula_codigo" value="<?php echo isset($pemar) ? ($pemar->APELLIDO_DOS_POBLACION) : ''; ?>" placeholder="Segundo Apellido"  />
                    </div>

                </div>
                <div class="control-group form-horizontal">
                    <label class="control-label">Fecha Nacimiento</label>
                    <div class="controls "> 
                        <style>
                            .cambiar_tamaño1{
                                width: 15%!important;
                            }
                            .cambiar_tamaño2{
                                width: 10%!important;
                            }
                        </style>
                        <?php
                        $valor = 0;
                        if (isset($pemar)) {
                            $valor = $pemar->ANO_NACIMIENTO_POBLACION;
                        }
                        $this->formularios->lista_ano('nacimiento', 'generadores-codigo cambiar_tamaño1 ', $valor, $_SESSION['SESION_USUARIO']->EDAD_MINIMA);
                        ?>
                        <?php
                        $valor = 0;
                        if (isset($pemar)) {
                            $valor = $pemar->MES_NACIMIENTO_POBLACION;
                        }
                        $this->formularios->lista_mes('nacimiento', 'generadores-codigo cambiar_tamaño1 ', $valor);
                        ?>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="codigopersona">Código unico de Persona</label>
                    <div class="controls">
                        <input type="text" id="codigo-pemar-generado"name="codigopersona" placeholder="Codigo Sin Espacio" value="<?php echo isset($pemar) ? ($pemar->CODIGO_UNICO_PERSONA) : ''; ?>" class="required sinEspacio mayusculas" required="required" readonly/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="otro_nombre_poblacion">Otro nombre</label>
                    <div class="controls">
                        <input type="text" name="otro_nombre_poblacion" class="soloLetras" placeholder="opcional"  value="<?php echo isset($pemar) ? ($pemar->OTRO_NOMBRE_POBLACION) : ''; ?>"/>

                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="ci_poblacion">Cédula</label>
                    <div class="controls">
                        <input type="text" id="cedula-atendido" name="ci_poblacion" placeholder="cedula"  value="<?php echo isset($pemar) ? ($pemar->CI_POBLACION) : ''; ?>" class=" sinEspacio" />

                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="numero_telefono_poblacion">Numero de telefono</label>
                    <div class="controls">
                        <input type="tel" class="sinEspacio" name="numero_telefono_poblacion" placeholder="Numero de telefono"  value="<?php echo isset($pemar) ? ($pemar->NUMERO_TELEFONO_POBLACION) : ''; ?>" />

                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="correo_poblacion">Correo</label>
                    <div class="controls">
                        <input type="email" class="sinEspacio" name="correo_poblacion" placeholder="Correo"  value="<?php echo isset($pemar) ? ($pemar->CORREO_POBLACION) : ''; ?>" />

                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Provincia</label>
                    <div id="lista-provincia" class="controls">
                        <select id="provincia-chosen" name="provincia-chosen" class="select-chosen" size="1">
                            <option value >seleccione la provincia</option>
                            <?php
                            foreach ($provincias as $provincia) {
                                $selected = "";
                                if (isset($pemar)) {
                                    if ($pemar->ID_PROVINCIA == $provincia->ID_PROVINCIA) {
                                        $selected = "selected";
                                    }
                                }
                                ?>
                                <option value="<?php echo $provincia->ID_PROVINCIA ?>" <?php echo $selected; ?> ><?php echo ($provincia->NOMBRE_PROVINCIA) ?></option>
                            <?php } ?>
                        </select>
                    </div>

                </div>
                <div class="control-group">
                    <label class="control-label">Cantón</label>
                    <div id="listado-cantones" class="controls">
                        <select id="id_canton" name="id_canton" class="select-chosen"  size="1">
                            <option value >seleccione el canton</option>
                            <?php
                            foreach ($cantones as $canton) {
                                $selected = "";
                                if (isset($pemar)) {
                                    if ($pemar->ID_CANTON == $canton->ID_CANTON) {
                                        $selected = "selected";
                                    }
                                }
                                ?>
                                <option value="<?php echo $canton->ID_CANTON ?>" <?php echo $selected; ?> ><?php echo ($canton->NOMBRE_CANTON) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div> 

                <div class="control-group">
                    <label class="control-label">Sexo</label>
                    <div class="controls">


                        <label class="radio" for="radio_masculino">
                            <input type="radio" id="radio_masculino" name="sexo-radios" value="HOMBRE" class="input-themed"  <?php if (isset($pemar)) echo $pemar->SEXO == 'HOMBRE' ? 'checked="checked"' : ''; ?> required >Masculino
                        </label>
                        <label class="radio" for="radio_femenino">
                            <input type="radio" id="radio_femenino" name="sexo-radios" value="MUJER" class="input-themed"  <?php if (isset($pemar)) echo $pemar->SEXO == 'MUJER' ? 'checked="checked"' : ''; ?> required> Femenino
                        </label>
                        <label class="radio" for="radio_transexual">
                            <input type="radio" id="radio_transexual" name="sexo-radios" value="TRANS" class="input-themed"  <?php if (isset($pemar)) echo $pemar->SEXO == 'TRANS' ? 'checked="checked"' : ''; ?> required > Transexual
                        </label>
                    </div>
                </div>

                <!-- Form Buttons -->
                <div class="form-actions" align="center">
                    <button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Limpiar</button>
                    <button type="submit" class="btn btn-success"><i class="icon-save"></i> Guardar</button>
                </div>
                <!-- END Form Buttons -->
            </form>

        </div>        
    </div>   

</div>

<script>
    $(document).ready(function() {
        $(".validar_cedula_codigo").on('change', function(e) {
            var codP = generarCodigoUnicoPemar(
                    $('#primer-nombre').val(), $('#segundo-nombre').val(),
                    $('#primer-apellido').val(), $('#segundo-apellido').val(),
                    $('#mes-nacimiento').val(), $('#ano-nacimiento').val()
                    );

            if (estaVacio($('#cedula-atendido').val()))
                return false;
            if (estaVacio(codP))
                return false;
            validar_relacion_codigo_cedula_pemar($('#cedula-atendido').val(), codP, 'resp_validar_cedula');

        });

        $('#form-pemars-arv').submit(function() {

            if (estaVacio($('#tipoPoblacion').val())) {
                alert('Escoja un tipo de poblacion');
                return false;
            }
            if (estaVacio($('#ano-nacimiento').val()) || estaVacio($('#mes-nacimiento').val())) {
                alert('Escoja el mes y el año');
                return false;
            }
            if (estaVacio($('#id_canton').val())) {
                alert('Escoja un canton');
                return false;
            }

            var datosForm = $(this).serialize();

            if (estaVacio($('#registro-id').val())) {

                ejecutarAccionJson(
                        'monitores', 'pemars', 'guardar_nueva_pemar', 
                        datosForm, 'mostrar_resultado_guardar( data, "abrir_listado_pemars();", "" );'
                        );
            } else {
                ejecutarAccionJson(
                        'monitores', 'pemars', 'editar_pemar',
                        datosForm, 'mostrar_resultado_guardar( data, "abrir_listado_pemars();", "" );'
                        );
            }
        });

        $('#provincia-chosen').on('change', function(evt, params) {
            cargar_cantones('listado-cantones', 'id_canton', $(this).val());
        });

        $('.generadores-codigo').on('keyup', function(e) {
            generarCodigo();
        });
        $('.generadores-codigo').on('change', function(e) {
            generarCodigo();
        });
    });

    function generarCodigo() {
        var CUP = generarCodigoUnicoPemar(
                $('#primer-nombre').val(), $('#segundo-nombre').val(),
                $('#primer-apellido').val(), $('#segundo-apellido').val(),
                $('#mes-nacimiento').val(), $('#ano-nacimiento').val()
                );
        $('#codigo-pemar-generado').attr('value', CUP.toString());
    }
</script>


<script>
<?php if (isset($pemar)): ?>
    agregar_boton_ayuda('EDITARPEMAR');
<?php else: ?>
    agregar_boton_ayuda('NUEVOPEMAR');
<?php endif; ?>
</script>