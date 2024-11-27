<?php
class CiudadesControlador extends ControllerBase{

    public function getCiudades(){
        $dato = isset($_POST['idPais']) ?  $_POST['idPais'] : '0' ; 
        $nombreLista = isset($_POST['nombreListaCiudades']) ?  $_POST['nombreListaCiudades'] : 'hoteleria_huespedes_lista_ciudades' ;
        
        if( $dato == '' ){
        
            $this->model->cargar("AgenciasModel.php");
            $AgenciasModel = new AgenciasModel();
            $data['datosAgencia'] = $AgenciasModel->getDatosAgencia( $_POST['idAgencia'] ) ;    
            
            $this->model->cargar("CiudadesModel.php");
            $CiudadesModel = new CiudadesModel();
            $data['Ciudades'] = $CiudadesModel->getCiudadesPais($data['datosAgencia']["pais"]);   
            
        }else{
            $this->model->cargar("CiudadesModel.php");
            $CiudadesModel = new CiudadesModel();
            $data['Ciudades'] = $CiudadesModel->getCiudadesPais($dato);
            
        }  
        
        $froms = new Formularios();
        echo $froms->Lista_Desplegable(
               $data['Ciudades'], array('NOMBRE_CIUDAD','DEPARTAMENTO_CIUDAD'), 'ID_CIUDAD', $nombreLista,'','','formulario_otraciudad_'.$nombreLista.'();','','','SEL. OTRA CIUDAD'
         );            
    }
      

}

?>