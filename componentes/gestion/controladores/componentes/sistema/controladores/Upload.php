<?php



class UploadControlador extends ControllerBase {

    public function subirFotoHabitacion() {
		
		$this->model->cargar("HabitacionesModel.php","hoteleria");
        $HabitacionesModel = new HabitacionesModel();
        $dataHabitacion = $HabitacionesModel->getDatosHabitacion($_POST['idHabitacion']);
		
		if (!empty($_FILES)) {
			
			$dirFile = 'archivos/'.$this->params->valor('USUARIOEMPRESA').'/'.$_POST['dirFotos'];	
						
			$tempFile = $_FILES['Filedata']['tmp_name'];
			$datosFile = explode( '.', $_FILES['Filedata']['name']);
			
			$targetFile =  str_replace('//','/',$dirFile) . $dataHabitacion['CODIGO_HABITACION'] . date('Ymdhis').'.'.$_FILES[''].$datosFile[1];
					
			
			// $fileTypes  = str_replace('*.','',$_REQUEST['fileext']);
			// $fileTypes  = str_replace(';','|',$fileTypes);
			// $typesArray = split('\|',$fileTypes);
			// $fileParts  = pathinfo($_FILES['Filedata']['name']);
			
			// if (in_array($fileParts['extension'],$typesArray)) {
				// Uncomment the following line if you want to make the directory if it doesn't exist
				// mkdir(str_replace('//','/',$targetPath), 0755, true);
				
				move_uploaded_file($tempFile,$targetFile);
				echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
			// } else {
			// 	echo 'Invalid file type.';
			// }
		}
    }

}


?>