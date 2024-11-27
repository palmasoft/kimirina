
function validarLetras(e) {    
              tecla = (document.all) ? e.keyCode : e.which;
              if (tecla==8) return true; // space
              if (tecla==9) return true; // space
              if (tecla > 30 && tecla < 47) return true; // espeiales
              if (tecla==192) return true; // Ñ
              if (tecla==32) return true; // space
            
              patron = /[a-zA-Z]/; //patron
              te = String.fromCharCode(tecla);
              return patron.test(te); // prueba de patron
            }
 
function validarEspacio(e) {    
              tecla = (document.all) ? e.keyCode : e.which;
              
              if (tecla==32) return false; // space              
              return true; // prueba de patron
            }
 