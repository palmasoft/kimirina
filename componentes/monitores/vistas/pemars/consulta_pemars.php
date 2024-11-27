
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-search themed-color"></i>Consulta Datos PEMAR (Población en Mayor Riesgo)<br>
        <small>Consulta de datos de las Personas de Mayor Riesgo en el sistema</small>
    </h1>
</div>
<!-- END Pre Page Content -->


<!-- Page Content -->
<div id="page-content">
    <!-- Breadcrumb -->
    <!-- You can have the breadcrumb stick on scrolling just by adding the following attributes with their values (data-spy="affix" data-offset-top="250") -->
    <!-- You can try it on other elements too :-), the sticky position and style can be adjusted in the css/main.css with .affix class -->
    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="205">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="#">Receptor</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Consultar Datos PEMAR</a></li>
    </ul>
    <!-- END Breadcrumb -->




    <div class="block  block-themed" >
        <div class="block-title">
            <h4>
                <a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Generales"><i class="icon-arrow-up"></i></a>  
                Resultados
            </h4>
            <div class="block-options">            
            </div>  
        </div>
        <div id="resultado_busqueda" class="block-content" >
        </div>    
    </div>




    <div class="block  block-themed" >
        <div class="block-title">
            <h4>
                <a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Generales"><i class="icon-arrow-up"></i></a>  
                Contacto 
            </h4>
            <div class="block-options">            
            </div>  
        </div>
        <div class="block-content"> 

            <form id="form-pemars-arv" class="form-horizontal" onsubmit="return false;" >                
                <input type="hidden" id="registro-id" name="registro-id" value="<?php echo isset($pemar) ? ($pemar->ID_POBLACION) : ''; ?>" />         

                <!-- NOMBRES y APELLIDOS -->
                <div class="control-group form-horizontal">
                    <label class="control-label" for="nombreUno">Nombre(s) y Apellido(s) </label>
                    <div class="controls">
                        <input type="text" id="primer-nombre" name="nombre_uno_poblacion" class="sinEspacio generadores-codigo validar_cedula_codigo" value="<?php echo isset($pemar) ? ($pemar->NOMBRE_UNO_POBLACION) : ''; ?>" placeholder="Primer nombre"  />
                        <input type="text" id="segundo-nombre" name="nombre_dos_poblacion" class="sinEspacio generadores-codigo validar_cedula_codigo" value="<?php echo isset($pemar) ? ($pemar->NOMBRE_DOS_POBLACION) : ''; ?>" placeholder="Segundo nombre"  />
                        <input type="text" id="primer-apellido" name="apellido_uno_poblacion" class="sinEspacio generadores-codigo validar_cedula_codigo" value="<?php echo isset($pemar) ? ($pemar->APELLIDO_UNO_POBLACION) : ''; ?>" placeholder="Primer Apellido"  />
                        <input type="text" id="segundo-apellido" name="apellido_dos_poblacion" class="sinEspacio generadores-codigo validar_cedula_codigo" value="<?php echo isset($pemar) ? ($pemar->APELLIDO_DOS_POBLACION) : ''; ?>" placeholder="Segundo Apellido"  />
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
                        <input type="text" maxlength="12" id="codigo-pemar-generado" name="codigopersona" placeholder="Código Sin Espacio" value="<?php echo isset($pemar) ? ($pemar->CODIGO_UNICO_PERSONA) : ''; ?>" class="required sinEspacio" required="required"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="ci_poblacion">Cédula</label>
                    <div class="controls">
                        <input type="text" maxlength="10" id="cedula-atendido" name="ci_poblacion" placeholder="Cédula" 
                               value="<?php echo isset($pemar) ? ($pemar->CI_POBLACION) : ''; ?>" class="required sinEspacio"
                               required="required"/>

                    </div>
                </div>

                <!-- Form Buttons -->
                <div class="form-actions" align="center">
                    <button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Limpiar</button>
                    <a href="javascript:buscar_pemar();"><button type="button" class="btn btn-success"><i class="icon-ok"></i> Buscar</button></a>
                </div>
                <!-- END Form Buttons -->
            </form>

        </div>        
    </div>

    
</div>



<script>

    function buscar_pemar() {
        var id_pemars = $('#codigo-pemar-generado').val();
        var id_cedula = $('#cedula-atendido').val();

        if (estaVacio(id_pemars) && estaVacio(id_cedula)) {
            alert("Llene algun campo");
        } else {
            var datosPemar = $('#form-pemars-arv').serialize();
            if (!estaVacio(id_pemars)) {

                ejecutarAccion(
                        'monitores', 'pemars', 'cargar_datos_pemars_id',
                        datosPemar, '$("#resultado_busqueda").html(data);$("#resultados").html("");'
                        );
            } else {

                ejecutarAccion(
                        'monitores', 'pemars', 'cargar_datos_pemars_cedula',
                        datosPemar, '$("#resultado_busqueda").html(data);$("#resultados").html("");'
                        );
            }

        }
    }


    $(document).ready(function() {

        $('#form-pemars-arv').submit(function() {
            var datosForm = $(this).serialize();
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
    agregar_boton_ayuda('CONSULARPEMAR');
</script>