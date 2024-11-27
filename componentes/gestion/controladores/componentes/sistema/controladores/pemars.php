<?php

class pemarsControlador extends ControllerBase {

    public function cantidad_de_abordajes_periodo_activo() {
        $idPemar = PemarsModel::validar_codigo($this->datos['CUP']);
        if ($idPemar > 0) {
            $array = array();
            $objAbordajeAno = AbordajesModel::abordajes_por_ano($this->datos['CUP'], PeriodosModel::activo()->ANO_PERIODO);
            array_push($array, $objAbordajeAno);
            $objAbordajeMes = AbordajesModel::abordajes_por_mes($this->datos['CUP'], PeriodosModel::activo());
            array_push($array, $objAbordajeMes);

            echo json_encode($array);
        }
    }

    public function cantidad_de_abordajes_periodo() {

        if (empty($this->datos['dia'])) {
            $periodo = PeriodosModel::activo();
            $dia = date("Y-m-d", strtotime($periodo->FECHA_MIN_PERIODO));
            $hora = "00:00";
        } else {
            $periodo = PeriodosModel::por_fecha($this->datos['dia']);
            $dia = $this->datos['dia'];
            $hora = $this->datos['hora'];
        }

        $Pemar = PemarsModel::datos_pemar_por_codigoUnicoPersona($this->datos['CUP']);
        if (!empty($Pemar)) {
            $array = array();
            $objAbordajeAno = AbordajesModel::abordajes_por_ano_por_subreceptor($this->datos['CUP'], $periodo->ANO_PERIODO);
            array_push($array, $objAbordajeAno);

            $objAbordajeMes = AbordajesModel::abordajes_por_mes_por_subreceptor($this->datos['CUP'], $periodo);
            array_push($array, $objAbordajeMes);

            $objAbordajeAno = AbordajesModel::abordajes_por_ano($this->datos['CUP'], $periodo->ANO_PERIODO);
            array_push($array, $objAbordajeAno);

            $objAbordajeMes = AbordajesModel::abordajes_por_mes($this->datos['CUP'], $periodo);
            array_push($array, $objAbordajeMes);

            $objRecurrencia['POR_PROMOTOR_POR_SUBRECEPTOR'] = AbordajesModel::recurrencia_por_promotor_subreceptor(
                            $Pemar->ID_POBLACION, $dia, $hora);
            $objRecurrencia['POR_ANIMADOR_POR_SUBRECEPTOR'] = AbordajesModel::recurrencia_por_animador_subreceptor(
                            $Pemar->ID_POBLACION, $dia, $hora);
            $objRecurrencia['POR_CONSEJERO_POR_SUBRECEPTOR'] = AbordajesModel::recurrencia_por_consejero_subreceptor(
                            $Pemar->ID_POBLACION, $dia, $hora);

            $objRecurrencia['POR_PROMOTOR'] = AbordajesModel::recurrencia_por_promotor(
                            $Pemar->ID_POBLACION, $dia, $hora);
            $objRecurrencia['POR_ANIMADOR'] = AbordajesModel::recurrencia_por_animador(
                            $Pemar->ID_POBLACION, $dia, $hora);
            $objRecurrencia['POR_CONSEJERO'] = AbordajesModel::recurrencia_por_consejero(
                            $Pemar->ID_POBLACION, $dia, $hora);

            $objRecurrencia['POR_PROMOTOR_POR_SUBRECEPTOR_POR_PERIODO'] = AbordajesModel::recurrencia_por_promotor_subreceptor_periodo(
                            $Pemar->ID_POBLACION, $dia, $hora);
            $objRecurrencia['POR_ANIMADOR_POR_SUBRECEPTOR_POR_PERIODO'] = AbordajesModel::recurrencia_por_animador_subreceptor_periodo(
                            $Pemar->ID_POBLACION, $dia, $hora);
            $objRecurrencia['POR_CONSEJERO_POR_SUBRECEPTOR_POR_PERIODO'] = AbordajesModel::recurrencia_por_consejero_subreceptor_periodo(
                            $Pemar->ID_POBLACION, $dia, $hora);

            array_push($array, $objRecurrencia);

            echo json_encode($array);
        }
    }

    public function validar_tipo_alcance_codigo() {
        $idPemar = PemarsModel::validar_codigo($this->datos['CUP']);
        echo ($idPemar == 0) ? 'NUEVO' : 'RECURRENTE';
    }

    public function __validar_tipo_recurrencia_codigo() {
        $idPemar = PemarsModel::validar_codigo($this->datos['CUP']);
        if ($idPemar > 0) {
            $objAbordaje = AbordajesModel::validos_actuales($this->datos['CUP']);
            echo json_encode($objAbordaje);
        }
    }

    public function es_valida_relacion_codigo_cedula_pemar() {
        if (empty($this->datos['CUP'])) {
            echo 'false';
            return false;
        }
        $idPemarCod = PemarsModel::validar_codigo($this->datos['CUP']);
        if ($idPemarCod > 0) {
            if (empty($this->datos['CEDULA'])) {
                echo 'true';
                return true;
            } else {
                $idPemarCedCod = PemarsModel::validar_cedula_codigo($this->datos['CEDULA'], $this->datos['CUP']);
                if( $idPemarCedCod > 0){
                    echo 'true';
                    return true;
                } else {
                    echo 'false';
                    return false;
                }
            }
        } else {
            if (empty($this->datos['CEDULA'])) {
                echo 'true';
                return true;
            } else {
                $idPemar = PemarsModel::validar_cedula($this->datos['CEDULA']);
                if ($idPemar > 0) {
                    echo 'false';
                    return false;
                } else {
                    echo 'true';
                    return true;
                }
            }
        }

        return true;
    }

    public function validar_relacion_codigo_cedula_pemar() {

        //return false;
        $idPemar = PemarsModel::validar_cedula($this->datos['CEDULA']);
        if ($idPemar > 0) {
            $idPemarCedCod = PemarsModel::validar_cedula_codigo($this->datos['CEDULA'], $this->datos['CUP']);
            if ($idPemarCedCod > 0) {
                echo AlertasHTML5::exito("La Cedula y Codigo son Correctos!");
            } else {
                $idPemarCod = PemarsModel::validar_codigo($this->datos['CUP']);
                $objPemar = NULL;
                if ($idPemarCod > 0 && $idPemar > 0) {
                    $objPemar1 = PemarsModel::datos_pemar(PemarsModel::validar_codigo($this->datos['CUP']));
                    $objPemar2 = PemarsModel::datos_pemar(PemarsModel::validar_cedula($this->datos['CEDULA']));

                    echo AlertasHTML5::error("La Cedula y el codigo ya estan el sistema, PERO CORRENPONDEN A PERSONAS DIFERENTES!. Si deseas cambiar la informacion registrada debe dirigirte al menu PERSONAS EN MAYOR RIESGO. <br /> Los datos relacionados son :<br />"
                            . "<strong><em>Al Codigo</em></strong>"
                            . "<div>" . ($objPemar1->NOMBRE_UNO_POBLACION) . " " . ($objPemar1->NOMBRE_DOS_POBLACION) . " " . ($objPemar1->APELLIDO_UNO_POBLACION) . " " . ($objPemar1->APELLIDO_DOS_POBLACION) . "</div>"
                            . "<div>cedula :<strong>" . ($objPemar1->CI_POBLACION) . "</strong></div>"
                            . "<div>nacimiento :" . ($objPemar1->MES_NACIMIENTO_POBLACION) . "/" . ($objPemar1->ANO_NACIMIENTO_POBLACION) . "</div>"
                            . "<strong><em>A la Cedula</em></strong>"
                            . "<div>" . ($objPemar2->NOMBRE_UNO_POBLACION) . " " . ($objPemar2->NOMBRE_DOS_POBLACION) . " " . ($objPemar2->APELLIDO_UNO_POBLACION) . " " . ($objPemar2->APELLIDO_DOS_POBLACION) . "</div>"
                            . "<div>codigo :<strong>" . ($objPemar2->CODIGO_UNICO_PERSONA) . "</strong></div>"
                            . "<div>nacimiento :" . ($objPemar2->MES_NACIMIENTO_POBLACION) . "/" . ($objPemar2->ANO_NACIMIENTO_POBLACION) . "</div>"
                            . "");
                } else {
                    $objPemar = PemarsModel::datos_pemar(PemarsModel::validar_cedula($this->datos['CEDULA']));
                    echo AlertasHTML5::advertencia("La Cédula ya está en la base de datos por lo que el Código deberá corresponder al guardado en SIMON!. <br /> Los datos relacionados son :"
                            . "<div>" . ($objPemar->NOMBRE_UNO_POBLACION) . " " . ($objPemar->NOMBRE_DOS_POBLACION) . " " . ($objPemar->APELLIDO_UNO_POBLACION) . " " . ($objPemar->APELLIDO_DOS_POBLACION) . "</div>"
                            . "<div>codigo :<strong>" . ($objPemar->CODIGO_UNICO_PERSONA) . "</strong></div>"
                            . "<div>nacimineto :" . ($objPemar->MES_NACIMIENTO_POBLACION) . "/" . ($objPemar->ANO_NACIMIENTO_POBLACION) . "</div>");
                }
            }
        } else {
            $idPemar = PemarsModel::validar_codigo($this->datos['CUP']);
            $objPemar = NULL;
            if ($idPemar > 0) {
                $objPemar = PemarsModel::datos_pemar(PemarsModel::validar_codigo($this->datos['CUP']));
                echo AlertasHTML5::advertencia($this->datos['CUP'] . ". La Cedula NO exite, pero el codigo tiene otra cedula asociada! . <br /> Los datos relacionados son :"
                        . "<div>" . ($objPemar->NOMBRE_UNO_POBLACION) . " " . ($objPemar->NOMBRE_DOS_POBLACION) . " " . ($objPemar->APELLIDO_UNO_POBLACION) . " " . ($objPemar->APELLIDO_DOS_POBLACION) . "</div>"
                        . "<div>cedula :<strong>" . ($objPemar->CI_POBLACION) . "</strong></div>"
                        . "<div>nacimiento :" . ($objPemar->MES_NACIMIENTO_POBLACION) . "/" . ($objPemar->ANO_NACIMIENTO_POBLACION) . "</div>");
            } else {
                echo AlertasHTML5::informacion("la CEDULA y CODIGO no existen en la base de datos!");
            }
        }
    }

    public function validar_relacion_codigo_pemar() {
        $idPemar = PemarsModel::validar_codigo($this->datos['CUP']);
        $objPemar = NULL;
        if ($idPemar > 0) {
            $objPemar = PemarsModel::datos_pemar(PemarsModel::validar_codigo($this->datos['CUP']));
            echo AlertasHTML5::advertencia("el CODIGO esta registrado en el sistema! <br /> Los datos relacionados son :"
                    . "<div>" . ($objPemar->NOMBRE_UNO_POBLACION) . " " . ($objPemar->NOMBRE_DOS_POBLACION) . " " . ($objPemar->APELLIDO_UNO_POBLACION) . " " . ($objPemar->APELLIDO_DOS_POBLACION) . "</div>"
                    . "<div>cedula :<strong>" . ($objPemar->CI_POBLACION) . "</strong></div>"
                    . "<div>nacimiento :" . ($objPemar->MES_NACIMIENTO_POBLACION) . "/" . ($objPemar->ANO_NACIMIENTO_POBLACION) . "</div>");
        } else {
            echo AlertasHTML5::informacion("el CODIGO no existe en la base de datos!");
        }
    }

    public function validar_relacion_cedula_pemar() {

        return false;

        $idPemar = PemarsModel::validar_cedula($this->datos['CEDULA']);
        if ($idPemar > 0) {
            $objPemar = PemarsModel::datos_pemar(PemarsModel::validar_cedula($this->datos['CEDULA']));
            echo AlertasHTML5::advertencia("La Cedula ya esta registrada y tiene asignado un codigo!. <br /> Los datos relacionados son :"
                    . "<div>" . ($objPemar->NOMBRE_UNO_POBLACION) . " " . ($objPemar->NOMBRE_DOS_POBLACION) . " " . ($objPemar->APELLIDO_UNO_POBLACION) . " " . ($objPemar->APELLIDO_DOS_POBLACION) . "</div>"
                    . "<div>codigo :<strong>" . ($objPemar->CODIGO_UNICO_PERSONA) . "</strong></div>"
                    . "<div>nacimiento :" . ($objPemar->MES_NACIMIENTO_POBLACION) . "/" . ($objPemar->ANO_NACIMIENTO_POBLACION) . "</div>");
        } else {
            echo AlertasHTML5::informacion("la CEDULA no existe en la base de datos!");
        }
    }

    public function datos_pemar_codigo_json() {
        $Pemar = PemarsModel::datos_pemar_por_codigoUnicoPersona($this->datos['codido_pemar']);
        echo json_encode($Pemar);
    }

    public function datos_pemar_cedula_json() {
        $Pemar = PemarsModel::datos_pemar_por_ciPoblacion($this->datos['cedula_pemar']);
        echo json_encode($Pemar);
    }

}
