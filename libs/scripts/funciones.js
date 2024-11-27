// JavaScript Document


function esValidaCedulaCodigo(cedPemar, codPemar, idBtnFormulario) {
    ejecutarAccion(
            'sistema', 'pemars', 'es_valida_relacion_codigo_cedula_pemar',
            'CUP=' + codPemar + '&CEDULA=' + cedPemar,
            " " + idBtnFormulario + " ");
}

function activar_boton_formatos(idBoton, activar) {
    if (activar === 'false') {
        $("#" + idBoton).attr("disabled", "disabled");
    } else {
        $("#" + idBoton).removeAttr("disabled");
    }
}




function avisos_valida_cedula_codigo(cedPemar, codPemar, idResultado) {

    if (estaVacio(cedPemar) && estaVacio(codPemar))
        return false;

    if (!estaVacio(cedPemar) && !estaVacio(codPemar)) {
        validar_relacion_codigo_cedula_pemar(cedPemar, codPemar, idResultado);
    }

    if (estaVacio(cedPemar) && !estaVacio(codPemar)) {
        validar_relacion_codigo_pemar(codPemar, idResultado);
    }

    if (!estaVacio(cedPemar) && estaVacio(codPemar)) {
        validar_relacion_cedula_pemar(cedPemar, idResultado);
    }

    return true;
}

function validar_relacion_codigo_cedula_pemar(cedula_pemar, codigo_pemar, idDivRespuesta) {
    ejecutarAccion('sistema', 'pemars', 'validar_relacion_codigo_cedula_pemar', 'CUP=' + codigo_pemar + '&CEDULA=' + cedula_pemar,
            "$('#" + idDivRespuesta + " span').html( data );$('#" + idDivRespuesta + "').slideDown();");
}


function validar_relacion_codigo_pemar(codigo_pemar, idDivRespuesta) {
    ejecutarAccion('sistema', 'pemars', 'validar_relacion_codigo_pemar', 'CUP=' + codigo_pemar,
            "$('#" + idDivRespuesta + " span').html( data );$('#" + idDivRespuesta + "').slideDown();");
}


function validar_relacion_cedula_pemar(cedula_pemar, idDivRespuesta) {
    ejecutarAccion('sistema', 'pemars', 'validar_relacion_cedula_pemar', 'CEDULA=' + cedula_pemar,
            "$('#" + idDivRespuesta + " span').html( data );$('#" + idDivRespuesta + "').slideDown();");
}


function validar_tipo_alcance(codigoPemar, idDivResultado) {
    ejecutarAccion('sistema', 'pemars', 'validar_tipo_alcance_codigo', 'CUP=' + codigoPemar,
            "$('#" + idDivResultado + "').attr('value', data );");
}

function cantidad_de_abordajes(codigoPemar, dia, hora, funcRecibedatos) {
    ejecutarAccionJson('sistema', 'pemars', 'cantidad_de_abordajes_periodo',
            'CUP=' + codigoPemar + '&dia=' + dia + '&hora=' + hora,
            '' + funcRecibedatos);
}

function generarCodigoUnicoPemar(primerNombre, segundoNombre, primerApellido, segundoApellido, mesNacimiento, anoNacimiento) {
    var iniPriName = '00', iniSegName = '00', iniPriLast = '00', iniSegLast = '00', mes = '00', agnio = '00';
    if (!estaVacio(primerNombre)) {
        iniPriName = (primerNombre.replace(/\s/g, '') + '0').substr(0, 2);
    }

    if (!estaVacio(segundoNombre)) {
        iniSegName = (segundoNombre.replace(/\s/g, '') + '0').substr(0, 2);
    }

    if (!estaVacio(primerApellido)) {
        iniPriLast = (primerApellido.replace(/\s/g, '') + '0').substr(0, 2);
    }

    if (!estaVacio(segundoApellido)) {
        iniSegLast = (segundoApellido.replace(/\s/g, '') + '0').substr(0, 2);
    }

    if (!estaVacio(mesNacimiento)) {
        mes = mesNacimiento;
    }
    if (!estaVacio(anoNacimiento)) {
        agnio = anoNacimiento.substr(2, 4);
    }

    var codigoFinal = iniPriLast + "" + iniSegLast + "" + iniPriName + "" + iniSegName + "" + mes + "" + agnio;
    return codigoFinal.toUpperCase();
}



function generarCodigoUnicoPemarDNI(primerNombre, segundoNombre, primerApellido, segundoApellido, mesNacimiento, anoNacimiento) {
    var iniPriName = '00', iniSegName = '00', iniPriLast = '00', iniSegLast = '00', mes = '00', agnio = '00';
    if (!estaVacio(primerNombre)) {
        iniPriName = (primerNombre.replace(/\s/g, '') + '0').substr(0, 2);
    }

    if (!estaVacio(segundoNombre)) {
        iniSegName = (segundoNombre.replace(/\s/g, '') + '0').substr(0, 2);
    }

    if (!estaVacio(primerApellido)) {
        iniPriLast = (primerApellido.replace(/\s/g, '') + '0').substr(0, 2);
    }

    if (!estaVacio(segundoApellido)) {
        iniSegLast = (segundoApellido.replace(/\s/g, '') + '0').substr(0, 2);
    }

    mes = generarMesPrimerNmbre(mesNacimiento, primerNombre);
    agnio = generarAgnioPrimerApellido(anoNacimiento, primerApellido);
    agnio = agnio.substr(2, 4);

    var codigoFinal = iniPriLast + "" + iniSegLast + "" + iniPriName + "" + iniSegName + "" + mes + "" + agnio;
    return codigoFinal.toUpperCase();
}

function generarMesPrimerNmbre(mesNacimiento, primerNombre) {
    var mes = "00";
    if (!estaVacio(mesNacimiento)) {
        mes = mesNacimiento;
    } else {
        var mesGen = ((primerNombre.substr(0, 1).charCodeAt(0)) % 12) + 1;
        mes = mesGen;
        if (mesGen < 10) {
            mes = "0" + mesGen;
        }
    }
    return mes;

}

function generarAgnioPrimerApellido(anoNacimiento, primerApellido) {
    var agnio = '00';
    if (!estaVacio(anoNacimiento)) {
        agnio = anoNacimiento;
    } else {
        var f = new Date();
        var anoGen = (parseInt(f.getFullYear()) - 11) - (((primerApellido.substr(0, 1).charCodeAt(0)) % 14) + 1);
        agnio = anoGen.toString();
    }
    return agnio;
}


function calcularEdad_AnoMes(objIdAnos, objIdMes) {
    var an = $('#' + objIdAnos).val();
    var me = $('#' + objIdMes).val();
    var tAn = parseInt(an) + (parseInt(me) / 12);
    var dt = new Date();
    var tAc = dt.getFullYear() + ((dt.getMonth() + 1) / 12)
    var elapsed = (tAc - tAn);
    return Math.abs(elapsed);
}



function comprobar_relacion_3_1(item3, item1) {
    item3 = parseInt(item3);
    item1 = parseInt(item1);

    if (item1 > item3)
        return false;

    if (estaVacio(item3)) {
        return true;
    }

    if (estaVacio(item1)) {
        return true;
    }

    if (item3 >= 1 && item3 <= 4) {
        if (item1 === 1)
            return true;
        else
            return false;
    }

    if (item3 === 5) {
        if (item1 <= 2)
            return true;
        else
            return false;
    }


    var mod = item3 / item1;
    if ((mod) >= 2.6) {
        return true;
    }
    return false;
}


function validacion_formulario(form, errors) {
    if (errors) {
        var message = errores_validacion(errors);
        $(formulario).removeAlertBoxes();
        $(formulario).alertBox(message, {type: 'error'});
    } else {
        $(formulario).removeAlertBoxes();
    }
}

function errores_validacion(errors) {
    return errors == 1
            ? 'Falta 1 Campo por llenar.'
            : 'Faltan ' + errors + ' campos. Debes completarlos todos.';
}


function selectorColor() {
    $('.psl_colorpicker').miniColors({
        value: '#' + Math.floor(Math.random() * 16777215).toString(16),
        opacity: true,
        change: function(hex, rgb) {
        },
        open: function(hex, rgb) {
        },
        close: function(hex, rgb) {
        }
    });
}

function zIndex() {
    var allElems = document.getElementsByTagName ? document.getElementsByTagName("*") : document.all; // or test for that too
    var maxZIndex = 0;
    for (var i = 0; i < allElems.length; i++) {
        var elem = allElems[i];
        var cStyle = null;
        if (elem.currentStyle) {
            cStyle = elem.currentStyle;
        }
        else if (document.defaultView && document.defaultView.getComputedStyle) {
            cStyle = document.defaultView.getComputedStyle(elem, "");
        }
        var sNum;
        if (cStyle) {
            sNum = Number(cStyle.zIndex);
        } else {
            sNum = Number(elem.style.zIndex);
        }
        if (!isNaN(sNum)) {
            maxZIndex = Math.max(maxZIndex, sNum);
        }
    }
    return maxZIndex + 1;
}


// Cadenas
function comparaCampos(idCampoA, idCampoB) {
    var A = $('#' + idCampoA).attr('value');
    var B = $('#' + idCampoB).attr('value');

    if (A == B)
        return true;
    return false;
}

function calculaAltoPantalla() {
    if (document.layers) {
        alto = window.innerHeight;
    } else {
        alto = document.body.clientHeight;
    }
    return alto;
}

function calculaAnchoPantalla() {
    var ancho;
    if (document.layers) {
        ancho = window.innerWidth;
    } else {
        ancho = document.body.clientWidth;
    }
    return ancho;
}

function agregar_zona_modal(html) {
    $('#zona-modal').html(html);
}


function bloqueoCargando() {
    var cargando = '<div style=" z-index:ZINDEXMASALTO; position:fixed; top:0; left:0px; width:110%; height:110%; background-color:transparent; background-image:url(imagenes/fondo_kimirina.png); background-position:center center; background-repeat:repeat; overflow:hidden;" ><div style="width:350px; margin: 20% auto; text-align: center;"><img src="imagenes/cargando.GIF" width="64px"  alt="Cargando / Loading"  /><h4>ESPERE MIENTRAS REALIZAMOS LA OPERACION</h4></div>  </div>';
    var posicion = zIndex();
    cargandoHtml = cargando.replace('ZINDEXMASALTO', posicion);
    $('#cargando').html(cargandoHtml);
}

function desbloqueoCargando() {

    $('#cargando').html('');
}

function bloquearEscritorio() {
    var hg = screen.height;
    var wd = calculaAncho();
    $("#zona-modal").append("<div id='divFondoBloquearEscritorio' class='cssFondoBloquearEscritorio' style='width:" + wd + "px;height:" + hg + "px;background-color:black;opacity:0.4;filter:alpha(opacity=40);position:absolute;top:0;left:0;z-index:" + zIndex() + ";' ></div>");
}

function desBloquearEscritorio() {

    $("#divFondoBloquearEscritorio").remove();
}


function seleccionarTodosCheckbox(grupo, idCheck) {
    alert(idCheck + '____________________' + $('#' + idCheck).is(':checked'));
    $("input[name=" + idCheck + "]").change(function() {
        $("input[class=" + grupo + "]").each(function() {
            if ($("input[name=" + idCheck + "]:checked").length == 1) {
                this.checked = true;
            } else {
                this.checked = false;
            }
        });
    });

}

function traer_ruta_navegacion() {

}

function actualizar_area_contenido(data) {
    $('#area_trabajo').html(data);
}

function cargar_plugins() {

}



function estaVacio(val) {
    var res = (val === undefined || val === "" || val === 0 || val === null || val.length <= 0) ? true : false;
    return res;
}

function rellenarCeros(num, totalChars, padWith) {
    num = num + "";
    padWith = (padWith) ? padWith : "0";
    if (num.length < totalChars) {
        while (num.length < totalChars) {
            num = padWith + num;
        }
    } else {
    }

    if (num.length > totalChars) { //if padWith was a multiple character string and num was overpadded
        num = num.substring((num.length - totalChars), totalChars);
    } else {
    }

    return num;
}

function esFechaValida(aho, mes, dia) {
    var plantilla = new Date(aho, mes - 1, dia);//mes empieza de cero Enero = 0
    if (!plantilla || plantilla.getFullYear() == aho && plantilla.getMonth() == mes - 1 && plantilla.getDate() == dia) {
        return true;
    } else {
        return false;
    }
}





function abrir_soportes(url, title) {
    var left = (screen.width / 2) - (600 / 2);
    var top = (screen.height / 2) - (400 / 2);
    return window.open('tools/visor/main.php?soporte_url=' + url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=600, height=400, top=' + top + ', left=' + left);
}




function validar_fechaMayorQue(fechaInicial, fechaFinal)
{
    if ( fechaFinal >= fechaInicial)
    {
        return false;
    }
    return true;
}
        