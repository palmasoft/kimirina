/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function abrir_listado_centro_salud(){
    mostrar_contenidos( 
            'sistema', 'directorio_centro_salud', 'cargar_vista_listado_centro_salud', ''
    );
}
function agregar_nuevo_centro_salud(){
    mostrar_contenidos( 
            'sistema', 'directorio_centro_salud', 'cargar_vista_formulario_listado_centro_salud', ''
    );
}