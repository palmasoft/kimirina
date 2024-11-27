/**
 * @author Juan Pablo Llinás Ramírez
 */


function validar_usuario() {
    ejecutarAccion(
            "sistema", "sesion", "validar_usuario",
            $("#login-form").serialize(),
            "repuesta_validar(data);"
            );
    return false;
}


function recargar_sesion_usuario() {
    ejecutarAccion(
            "sistema", "sesion", "reinciar_usuario", '',
            "repuesta_validar(data);"
            );
    return false;
}

function repuesta_validar(resp) {

    switch (resp) {
        case 'CORRECTO':
            ejecutarAccionSinBloqueo(
                    "sistema", "sesion", "iniciar_sesion",
                    $("#login-form").serialize(),
                    "window.location.reload();"
                    );
            informacion('Estamos entrando al sistema');            
            window.location.reload();
            break;
            
        case 'RECARGADO':
            setTimeout('window.location.reload();', 10);
            break;
        default:
            ejecutarAccionSinBloqueo(
                    "sistema", "sesion", "error_sesion",
                    $("#login-form").serialize() + '&login-error=' + resp,
                    "error(data);"
                    );
            break;
    }
}


function cerrar_sesion() {

    ejecutarAccionSinBloqueo(
            "sistema", "sesion", "cerrar_sesion",
            "", "setTimeout( 'window.location.reload();' , 10);  _RECARGAR_SALIR =  true;"
            );

}
