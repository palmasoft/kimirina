<?php

class menusModel extends ModelBase {

    function getAllMenus(){
        $query = "SELECT 
					tbMenu1.ID_MENU, tbMenu1.NOMBRE_MENU, tbMenu1.TITULO_MENU, tbMenu1.ACCION_SCRIPT_MENU, 
					tbMenu1.ACCION_MENU, tbMenu1.ID_MODELO_MENU , tbMenu1.IMAGEN_PRINCIPAL_MENU, 
					tbMenu1.ID_MENU_PADRE, tbMenu2.TITULO_MENU AS nombrepadre, tbMenu1.SEPARADOR_MENU,
					tbModulo.NOMBRE_MODULO  AS nombremodulo, tbModulo.TITULO_MODULO  AS titulomodulo 
				FROM tbl_menus AS tbMenu1
				LEFT JOIN tbl_menus AS tbMenu2 ON
					tbMenu2.ID_MENU = tbMenu1.ID_MENU_PADRE
				 LEFT JOIN tbl_modulos AS tbModulo ON
					tbModulo.ACCION_MODULO = tbMenu1.ID_MODELO_MENU
				ORDER BY tbModulo.ORDEN ASC ";
        $consulta = $this->consulta_basico($query);
        return $consulta;
    }

    function  getMenu($id) {
        $query = 'SELECT 
					tbMenu1.ID_MENU, tbMenu1.NOMBRE_MENU, tbMenu1.TITULO_MENU, tbMenu1.ACCION_SCRIPT_MENU, 
					tbMenu1.ACCION_MENU, tbMenu1.ID_MODELO_MENU , tbMenu1.IMAGEN_PRINCIPAL_MENU, 
					tbMenu1.ID_MENU_PADRE, tbMenu2.TITULO_MENU AS nombrepadre,  tbMenu1.SEPARADOR_MENU,
					tbModulo.NOMBRE_MODULO  AS nombremodulo, tbModulo.TITULO_MODULO  AS titulomodulo 
				FROM tbl_menus AS tbMenu1
				LEFT JOIN tbl_menus AS tbMenu2 ON
					tbMenu2.ID_MENU = tbMenu1.ID_MENU_PADRE
				LEFT JOIN tbl_modulos AS tbModulo ON
					tbModulo.ACCION_MODULO = tbMenu1.ID_MODELO_MENU 
				WHERE tbMenu1.ID_MENU = "' . $id . '" ';
        $consulta = $this->consulta_basico($query);
        return $consulta;
    }
    
    function getNombreMenu($id) {
        $query = 'SELECT NOMBRE_MENU, TITULO_MENU FROM tbl_menus WHERE ID_MENU="' . $id . '"';
        $consulta = $this->consulta_basico($query);
        return $consulta;
    }
    
    function getNombresMenus() {
        $query = 'SELECT ID_MENU, NOMBRE_MENU, TITULO_MENU FROM tbl_menus';
        $consulta = $this->consulta_basico($query);
        return $consulta;
    }
    
    function getPadreMenu($id) {
        $query = "SELECT ID_MENU_PADRE FROM tbl_menus WHERE ID_MENU='".$id."'";
        $consulta = $this->consulta_basico($query);
        return $consulta;
    }    
    
    function getModMenu() {
        $query = 'SELECT * FROM tbl_modulos';
        $consulta = $this->consulta_basico($query);
        return $consulta;
    }    
    
    function getModulosMenu() {
        $query = 'SELECT * FROM tbl_modulos';
        $consulta = $this->consulta_basico($query);
        return $consulta;
    }     
    
    function nuevo($nombre, $titulo, $accionscript, $accionmenu, $padre, $modulo, $foto, $separador) {
        //$config = Config::singleton();
        $modulo = trim($modulo);
        $query = "INSERT INTO tbl_menus ( ID_MENU ,NOMBRE_MENU, TITULO_MENU, ACCION_SCRIPT_MENU, ACCION_MENU, ID_MENU_PADRE, ID_MODELO_MENU, IMAGEN_PRINCIPAL_MENU, SEPARADOR_MENU ) VALUES(NULL, '" 
       .$nombre."', '".  $titulo . "','" . $accionscript . "' ,'".$accionmenu."', '". $padre ."', '".$modulo."', '". $foto ."', '". $separador ."' )";       
        return $this->crear_ultimo_id_basico($query);       
    }    

    function editar($id, $nombre, $titulo, $accionscript, $accionmenu, $padre, $modulo, $foto, $separador) {
       /*$config = Config::singleton();
       $accionscript = trim($accionscript);
       $accionmenu = trim($accionmenu); 
       $padre = trim($padre);
       if($accionscript==""){
           $accionscript = "NULL";
       } 
       if($accionmenu==""){
           $accionmenu = "NULL";       
       } 
       if($foto==""){
           $foto = "NULL";           
       } 
       $query = "UPDATE tbl_menus SET  s_nombre = '".$nombre."', s_titulo = '".$titulo."', s_accionscript = ".$accionscript.", s_accionmenu = ".$accionmenu.", k_idpadre = ".$padre.", fk_s_modulomenu = '".$modulo."', s_imagenfondo = ".$foto." WHERE pk_k_id = " . $id . " LIMIT 1";
       */
       if($padre==""){
        $padre = "NULL";
        $query = "UPDATE tbl_menus SET  NOMBRE_MENU = '".$nombre."', TITULO_MENU = '".$titulo."', ACCION_SCRIPT_MENU = '".$accionscript."', ACCION_MENU = '".$accionmenu."', ID_MENU_PADRE = ".$padre.", ID_MODELO_MENU = '".$modulo."', IMAGEN_PRINCIPAL_MENU = '".$foto."', SEPARADOR_MENU = '". $separador ."' WHERE ID_MENU = " . $id . " LIMIT 1";    
		       
       }else{
       	
           $query = "UPDATE tbl_menus SET  NOMBRE_MENU = '".$nombre."', TITULO_MENU = '".$titulo."', ACCION_SCRIPT_MENU = '".$accionscript."', ACCION_MENU = '".$accionmenu."', ID_MENU_PADRE = '".$padre."', ID_MODELO_MENU = '".$modulo."', IMAGEN_PRINCIPAL_MENU = '".$foto."', SEPARADOR_MENU = '". $separador ."'  WHERE ID_MENU = " . $id . " LIMIT 1";  
		       
       }        
       return $this->modificarRegistros_basico($query);
    }

    function borrar($id) {
        $query = "DELETE FROM tbl_menus WHERE ID_MENU = " . $id;
        $this->modificarRegistros_basico($query);
    }   
	
	
	
	
	function getTodosMenuSuperior(){
        $query = '
			SELECT * FROM tbl_menus 
			WHERE ISNULL(tbl_menus.ID_MENU_PADRE)  
			ORDER BY tbl_menus.ID_MENU ASC';
        $consulta = $this->consulta_basico($query);
        return $consulta;
    }

    function getTodosMenusPadres(){
        $query = '
			SELECT * FROM tbl_menus 
			WHERE ISNULL(tbl_menus.ID_MENU_PADRE) OR tbl_menus.ACC IS NOT NULL  
			ORDER BY tbl_menus.ID_MENU ASC';
        $consulta = $this->consulta_basico($query);
        return $consulta;
    }	

    function getTodosMenusPadresModulo( $CODIGO_MENU_PADRE){
      $query = '
      SELECT * FROM tbl_menus 
      WHERE ( ISNULL(tbl_menus.ID_MENU_PADRE) OR tbl_menus.ID_MENU_PADRE = "" )
      AND  tbl_menus.CODIGO_MODULO_MENU = "'.$CODIGO_MENU_PADRE.'"
      ORDER BY tbl_menus.ID_MENU ASC';
        $consulta = $this->consulta_basico($query);
        return $consulta;
    } 	


	function getTodosSubmenus(){
        $query = '
          SELECT * FROM  tbl_menus
					WHERE  tbl_menus.ID_MENU_PADRE IS NOT NULL 
					ORDER BY tbl_menus.ID_MENU ASC';
        $consulta = $this->consulta_basico($query);
        return $consulta;
    }	
	
	//****
    function  getMenusHijos($ID_MENU_PADRE) {
        $query = '
          SELECT * FROM tbl_menus 
          WHERE  tbl_menus.ID_MENU_PADRE = ' . $ID_MENU_PADRE . '
          ORDER BY tbl_menus.ID_MENU ASC';
        $consulta = $this->consulta_basico($query);
        return $consulta;
    }

	 
}

?>