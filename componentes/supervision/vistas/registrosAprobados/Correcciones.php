<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//print_r($correcciones);
?>

<?php 
if( !empty($correcciones) ){
foreach ($correcciones as $correccion): ?>

    <table class="tableview" tabindex="1" cellspacing="3" align="center" width="100%" >
        <tbody>       
            <tr>
                <td style="width: 5%;">
                </td>
                <td style="font-weight: bold;width: 20%;">
                    <div>
                        <div style="margin: 10px 5px;">
                            Tipo de Formato:
                        </div>
                    </div>
                </td>
                <td style="width: 25%;" >
                    <div>
                        <div style="margin: 10px 5px;">
                            <?php echo $correccion->TIPO_FORMULARIO ?>
                        </div>
                    </div>
                </td>
                <td style="font-weight: bold; width: 20%;">
                    <div>
                        <div style="margin: 10px 5px;">
                            Fecha Corrección:
                        </div>
                    </div>
                </td>
                <td  style="width: 25%;">
                    <div>
                        <div style="margin: 10px 5px;">
                            <?php echo $correccion->FECHA_MODIFICACION ?>
                        </div>
                    </div>
                </td>
                <td style="width: 5%;">
                </td>
            </tr>
            <tr>
                <td>

                </td>
                <td>
                    <div>
                        <div style="margin: 10px 5px;">
                            Modificado por:
                        </div>
                    </div>
                </td>
                <td style="font-weight: bold;" colspan="3" rowspan="1">
                    <div>
                        <div style="margin: 10px 5px;">
                            <h3><?php echo $correccion->NOMBRE_REAL_PERSONA ?><small><?php echo $correccion->IDENTIFICACION_PERSONA ?></small></h3>
                        </div>
                    </div>
                </td>            
                <td>
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td colspan="2" style="font-weight: bold;">
                    <div>
                        <div style="margin: 10px 5px;">
                            Motivos / Razones de la Corrección:
                        </div>
                    </div>
                </td>
                <td colspan="2" >
                    <div>
                        <div style="margin: 10px 5px;">
                            <?php echo $correccion->RAZONES_MODIFICACION ?>
                        </div>
                    </div>
                </td>           
                <td>
                </td>
            </tr>        

            <tr  valign="top" >
                <td>
                </td>
                <td colspan="2"  style="text-align: center;"  >
                    <div><?php   //print_r( json_decode($correccion->DATOS_ANTIGUOS) ); ?>
                        <button type="button" class="btn btn-large btn-info"  onclick="$('#dts_antes_<?php echo $correccion->ID_AUDITORIA ?>').toggle();" >datos antes de la corrección</button>
                        <div id="dts_antes_<?php echo $correccion->ID_AUDITORIA ?>" style="margin: 10px 5px;display:none;">
                            <?php                                                
                            $datosNuevo = json_decode($correccion->DATOS_ANTIGUOS);
                            foreach ($datosNuevo as $key => $value) {
                                if ($key == 'CONTACTOS') {
                                    continue;
                                }
                                if ($key == 'SOPORTES') {
                                    continue;
                                }
                                if ($key == 'INSUMOS') {
                                    continue;
                                }
                                echo $key . " => " . $value . "<br />";
                            }
                            ?>
                            
                            <?php if (isset($datosNuevo->CONTACTOS)): ?>
                            <h4>CONTACTOS REGISTRADOS</h4>
                            <?php
                            foreach ($datosNuevo->CONTACTOS as $ind => $contacto) {
                                echo " <h5>CONTACTO " . ($ind + 1) . "</h5><div>";
                                foreach ($contacto as $key => $value) {
                                    echo $key . "::" . $value . "<br />";
                                }
                                echo "</div>";
                            }
                            ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </td>           
                <td colspan="2" style="text-align: center; ">
                    <div>
                        <button type="button" class="btn btn-large btn-info" onclick="$('#dts_despues_<?php echo $correccion->ID_AUDITORIA ?>').toggle();" >datos después de la corrección</button>                        
                        <div id="dts_despues_<?php echo $correccion->ID_AUDITORIA ?>" style="margin: 10px 5px;display:none;">    
                            <?php
                            $datosNuevo = json_decode($correccion->DATOS_NUEVOS);
                            foreach ($datosNuevo as $key => $value) {
                                if ($key == 'CONTACTOS') {
                                    continue;
                                }
                                if ($key == 'SOPORTES') {
                                    continue;
                                }
                                if ($key == 'INSUMOS') {
                                    continue;
                                }
                                echo $key . " => " . $value . "<br />";
                            }
                            ?>
                            <?php if (isset($datosNuevo->CONTACTOS)): ?>
                                <h4>CONTACTOS REGISTRADOS</h4>
                                <?php
                                foreach ($datosNuevo->CONTACTOS as $ind => $contacto) {
                                    echo " <h5>CONTACTO " . ($ind + 1) . "</h5><div>";
                                    foreach ($contacto as $key => $value) {
                                        echo $key . "::" . $value . "<br />";
                                    }
                                    echo "</div>";
                                }
                                ?>
                            <?php endif; ?>
                        </div>                        
                    </div>
                </td>
                <td>
                </td>
            </tr>

        </tbody>
    </table>

    <hr style="margin: 10px 0px ;" />
<?php endforeach; 
}else{?>
    <h2>NO HAY NINGUNA CORRECCION REALIZADA A ESTE REGISTRO</h2>
<?php 
}
?>