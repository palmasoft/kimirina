<?php

class pemarControlador extends ControllerBase {

    public function guardar_navegacion_web() {
        PemarsModel::guardar_navegacion_web(
                $this->datos['id_pemar'], $this->datos['sesion_id'], $this->datos['pemar'], $this->datos['urlAntes'], $this->datos['urlActual'], $this->datos['dominio'], $this->datos['titulo'], $this->datos['fecha'], $this->datos['direccion_ip']
        );
    }

    public function guardar_nuevo_pemar_web() {
        
        

        $idPemarCod = PemarsModel::validar_codigo($this->datos['codigo_pemar']);
        if ($idPemarCod == 0) {
            $idPemarCod = PemarsModel::guardar_pemar(
                    $this->datos['tipo_pemar'], 
                    $this->datos['codigo_pemar'], 
                    $this->datos['mes_nacimiento'],
                    $this->datos['ano_nacimiento'],
                    TiposPoblacionModel::datos($this->datos['tipo_pemar'])->SEXO_TIPOPOBLACION, 
                    $this->datos['primer_nombre'], 
                    $this->datos['primer_apellido'], 
                    $this->datos['segundo_nombre'], 
                    $this->datos['segundo_apellido'], 
                    $this->datos['canton']
            );
        }
        $objPemar = PemarsModel::datos_pemar( $idPemarCod );
        echo json_encode($objPemar);
    }

}

?>