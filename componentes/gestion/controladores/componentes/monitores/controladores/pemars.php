<?php

class pemarsControlador  extends ControllerBase {
    
    function cargar_vista_listado() {
    	$this->datos['pemarsDatos'] = pemarsModel::todos();  
        $this->vista->mostrar( 'pemars/tabla_pemars', $this->datos );
    }
     
    function cargar_vista_formulario_nuevo() {
        $this->datos['cantones'] = UbicacionesModel::todos_cantones();
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['tiposPoblacion'] = tiposPoblacionModel::todos();
        $this->vista->mostrar( 'pemars/FormularioPermars', $this->datos );
    }
    
    function guardar_nueva_pemar(){
		$idpemar = PemarsModel::insertar( 
				$this->datos['tiposPoblacion'], 
                $this->datos['codigopersona'], 
                $this->datos['mes-nacimiento'], 
                $this->datos['ano-nacimiento'],
                $this->datos['nombre_uno_poblacion'],
                $this->datos['apellido_uno_poblacion'],
                $this->datos['nombre_dos_poblacion'],
                $this->datos['apellido_dos_poblacion'],
                $this->datos['otro_nombre_poblacion'], 
                $this->datos['ci_poblacion'],
                $this->datos['numero_telefono_poblacion'],
                $this->datos['correo_poblacion'],
                $this->datos['sexo-radios'],
                $this->datos['id_canton']
                
        );
        
        if( $idpemar > 0 ){
            echo '{ "resultado":"EXITO", "mensaje":"Nueva Pemar '.$this->datos['nombre_uno_poblacion'].' Guardado Exitosamente"}';
        }else{
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }
    function editar_form_pemar(){
        $this->datos['pemar'] = PemarsModel::datos_pemar($this->datos['id_pemar']);    
        $this->datos['provincias'] = UbicacionesModel::todas_provincias();
        $this->datos['cantones'] = UbicacionesModel::cantones_en_la_provincia( $this->datos['pemar']->ID_PROVINCIA );        
        $this->datos['tiposPoblacion'] = tiposPoblacionModel::todos();
        
        
        $this->vista->mostrar( 'pemars/FormularioPermars', $this->datos );
    }
    function editar_pemar(){
        $idpemar = pemarsModel::update(  
            $this->datos['registro-id'] ,
            $this->datos['tiposPoblacion'], 
            $this->datos['codigopersona'], 
            $this->datos['mes-nacimiento'], 
            $this->datos['ano-nacimiento'],
            $this->datos['nombre_uno_poblacion'],
            $this->datos['apellido_uno_poblacion'],
            $this->datos['nombre_dos_poblacion'],
            $this->datos['apellido_dos_poblacion'],
            $this->datos['otro_nombre_poblacion'], 
            $this->datos['ci_poblacion'],
            $this->datos['numero_telefono_poblacion'],
            $this->datos['correo_poblacion'],
            $this->datos['sexo-radios'],
            $this->datos['id_canton']         
        );      
        if( $idpemar > 0 ){
            echo '{"resultado":"EXITO", "mensaje":"Registro Modificado Exitosamente"}';
        }else{
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }
    function eliminar_pemar(){
        $idpemar = pemarsModel::eliminar(
                $this->datos['id_pemar']
        );        
        if( $idpemar > 0 ){
            echo '{"resultado":"EXITO", "mensaje":"Registro Eliminado Exitosamente"}';
        }else{
            echo '{"resultado":"ERROR", "mensaje":"No se ha podido guardar. intentelo nuevamente y si elproblema persite consulte al administrador del sistema."}';
        }
    }
    
    function cargar_vista_consulta_nuevo(){
        $this->vista->mostrar( 'pemars/consulta_pemars', $this->datos );
    }
    
    function cargar_datos_pemars_id(){
        $this->datos['pemarsDatos'] = PemarsModel::datos_pemar_por_codigoUnicoPersona($this->datos['codigopersona']); 
        
        $this->datos['registrosContactoAnimador'] = ReciboContactoAnimadorModel::datos_por_codPemar($this->datos['codigopersona']);
        $this->datos['registrosContactoSemanal'] = RegistroSemanalContactosModel::datos_por_codPemar($this->datos['codigopersona']);
        $this->datos['registrosConsejeriaPVVS'] = ConsejeriaPvvsModel::datos_por_codPemar($this->datos['codigopersona']);
        $this->datos['registroAtencion'] = registroAtencionSaludModel::datos_por_codPemar($this->datos['codigopersona']);
                
        $this->vista->mostrar( 'pemars/consulta_tabla_permars', $this->datos );     
    }
    
    function cargar_datos_pemars_cedula(){
        $this->datos['pemarsDatos'] = PemarsModel::datos_pemar_por_ciPoblacion($this->datos['ci_poblacion']);     
        
        $this->datos['registrosContactoAnimador'] = ReciboContactoAnimadorModel::datos_por_cedPemar($this->datos['ci_poblacion']);
        $this->datos['registrosContactoSemanal'] = RegistroSemanalContactosModel::datos_por_cedPemar($this->datos['ci_poblacion']);
        $this->datos['registrosConsejeriaPVVS'] = ConsejeriaPvvsModel::datos_por_cedPemar($this->datos['ci_poblacion']);
        $this->datos['registroAtencion'] = registroAtencionSaludModel::datos_por_cedPemar($this->datos['ci_poblacion']);
        
        if($this->datos['pemarsDatos']==0){
            $this->datos['mensaje'] =  'No se encontro el usuario';
        }
        
        $this->vista->mostrar( 'pemars/consulta_tabla_permars', $this->datos );         
    }
}
?>
