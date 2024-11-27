<?php // print_r($Informe->filas) ?>  
<form id="form-datos-contacto-alcanzados" onsubmit="return false;" >
    <table id="tabla-contactos-registrados-semana" class="table table-bordered table-hover dataTables">
        <thead>
            <tr>
                <th>Nombres y Apellidos</th>
                <th>PMR</th>
                <th>Unidad de Salud con la que Trabaja </th>
                <th>Nro. Pares Contactados</th>
                <th>Nro. Pares Referidos Efectivos</th>
            </tr>
        </thead>
        <tbody>
             <?php if (isset($Informe->filas)) {
                foreach ($Informe->filas as $informe) :
                    ?>   
                    <tr>
                        <td rowspan="3">
                            <?php echo ($informe->NOMBRE_PROMOTOR) ?>
                        </td>
                        
                        <td>
                             TS
                         </td>
                          <td>
                            <?php 
                              if(!empty($informe->CENTRO_SERVICIO_TS)){
                                  echo "<table style='width:100%;'>";
                                  foreach ($informe->CENTRO_SERVICIO_TS as $centrosalud){
                                        //$columna = explode("-", $centrosalud);
                                         echo "<tr>
                                                <td>".$centrosalud->NOMBRE_CENTROSERVICIO."</td>
                                                <td>".$centrosalud->NUMERO_EFECTIVOS."</td>
                                              </tr>";
                                   }
                                   echo "</table>";
                              }else{
                                  echo "Ninguno";
                              }
                               
                            ?>
                        </td>
                        <td>
                            <?php echo ($informe->PARES_CONTACTADOS_TS) ?>
                        </td>
                        <td>
                            <?php 
                              if(!empty($informe->CENTRO_SERVICIO_TS)){
                                  echo "<table style='width:100%;'>";
                                  foreach ($informe->CENTRO_SERVICIO_TS as $centrosalud){
                                        //$columna = explode("-", $centrosalud);
                                         echo "<tr>
                                                <td>".$centrosalud->NUMERO_EFECTIVOS."</td>
                                              </tr>";
                                   }
                                   echo "</table>";
                              }else{
                                  echo "0";
                              }
                               
                            ?>
                        </td>
                    </tr>
                    <!-- -->
                    <!-- -->
                      <tr>
                          <td>
                              HSH
                          </td>
                        <td>
                            <?php 
                              if(!empty($informe->CENTRO_SERVICIO_HSH)){
                                  echo "<table style='width:100%;'>";
                                  foreach ($informe->CENTRO_SERVICIO_HSH as $centrosalud){
                                        //$columna = explode("-", $centrosalud);
                                         echo "<tr>
                                                <td>".$centrosalud->NOMBRE_CENTROSERVICIO."</td>
                                                <td>".$centrosalud->NUMERO_REFERIDOS."</td>
                                              </tr>";
                                   }
                                   echo "</table>";
                              }else{
                                  echo "Ninguno";
                              }
                               
                            ?>
                        </td>
                        <td>
                            <?php echo ($informe->PARES_CONTACTADOS_HSH) ?>
                        </td>
                        <td>
                            <?php 
                              if(!empty($informe->CENTRO_SERVICIO_HSH)){
                                  echo "<table style='width:100%;'>";
                                  foreach ($informe->CENTRO_SERVICIO_HSH as $centrosalud){
                                        //$columna = explode("-", $centrosalud);
                                         echo "<tr>
                                                <td>".$centrosalud->NUMERO_EFECTIVOS."</td>
                                              </tr>";
                                   }
                                   echo "</table>";
                              }else{
                                  echo "0";
                              }
                               
                            ?>
                        </td>
                      </tr>
                       <!-- -->
                      <tr>
                          <td>
                              TRANS
                          </td>
                        <td>
                             <?php 
                              if(!empty($informe->CENTRO_SERVICIO_TRANS)){
                                  echo "<table style='width:100%;'>";
                                  foreach ($informe->CENTRO_SERVICIO_TRANS as $centrosalud){
                                        //$columna = explode("-", $centrosalud);
                                         echo "<tr>
                                                <td>".$centrosalud->NOMBRE_CENTROSERVICIO."</td>
                                                <td>".$centrosalud->NUMERO_EFECTIVOS."</td>
                                              </tr>";
                                   }
                                   echo "</table>";
                              }else{
                                  echo "Ninguno";
                              }
                               
                            ?>
                        </td>
                        <td>
                            <?php echo ($informe->PARES_CONTACTADOS_TRANS) ?>
                        </td>
                        <td>
                            <?php 
                              if(!empty($informe->CENTRO_SERVICIO_TRANS)){
                                  echo "<table style='width:100%;'>";
                                  foreach ($informe->CENTRO_SERVICIO_TRANS as $centrosalud){
                                        //$columna = explode("-", $centrosalud);
                                         echo "<tr>
                                                <td>".$centrosalud->NUMERO_EFECTIVOS."</td>
                                              </tr>";
                                   }
                                   echo "</table>";
                              }else{
                                  echo "0";
                              }
                               
                            ?>
                        </td>
                       
                      </tr>
                <?php endforeach;
            }
            ?>
        </tbody>
    </table>
</form>
