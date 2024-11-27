
function inciar_plugins_graficos() {
    iniciar_tablas();


    $('.soloLetras').on('keydown', function(event) {
        return validarLetras(event);
    });

    $('.mayusculas').on('keyup', function(event) {
        tecla = (document.all) ? event.keyCode : event.which;
        if (tecla > 30 && tecla < 47)
            return true; // espeiales
        this.value = this.value.toUpperCase();
    });

    $('.sinEspacio').on('keydown', function(event) {
        return validarEspacio(event);
    });

    $('thead input:checkbox').click(function() {
        var checkedStatus = $(this).prop('checked');
        var table = $(this).closest('table');

        $('tbody input:checkbox', table).each(function() {
            $(this).prop('checked', checkedStatus);
        });
    });

    // Initialize tabs
    $('[data-toggle="tabs"] a').click(function(e) {
        e.preventDefault();
        $(this).tab('show');
    });

    // Initialize Image Gallery/Popups
    $('[data-toggle="lightbox-gallery"]').magnificPopup({
        delegate: 'a.gallery-link',
        type: 'image',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',
            tPrev: 'Previous',
            tNext: 'Next',
            tCounter: '<span class="mfp-counter">%curr% of %total%</span>'
        }
    });

    // Initialize Image Popup
    $('[data-toggle="lightbox-image"]').magnificPopup({type: 'image'});

   
    $('[data-toggle="tooltip"], .enable-tooltip').tooltip({
        container: 'body',
        animation: true
    });

    // Initialize Popovers
    $('[data-toggle="popover"]').popover({container: 'body', animation: false});

    // Initialize Chosen
    $(".select-chosen").chosen({width: "98%"});

    // Initialize elastic
    $('textarea.textarea-elastic').elastic();

    // Initialize wysihtml5
    $('textarea.textarea-editor').wysihtml5();

    // Initialize Colorpicker
    $('.input-colorpicker').colorpicker();

    // Initialize TimePicker
    $('.input-timepicker').timepicker({
        showMeridian: false,
        minuteStep: 10,
        defaultTime: false
    });

    var t = "2014-01-01 00:00:00".split(/[- :]/);
    var iniDate = new Date(t[0], t[1] - 1, t[2]);
    iniDate.setDate(iniDate.getDate());

    t = "2015-12-31 23:59:59".split(/[- :]/);
    var finDate = new Date(t[0], t[1] - 1, t[2]);
    finDate.setDate(finDate.getDate());
    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
        weekHeader: 'Sm',
        dateFormat: 'yy-mm-dd',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);
    $('.input-datepicker').datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        minDate: iniDate,
        maxDate: finDate

    });


    // iCheck (Checkbox & Radio themed)
    $('.input-themed').iCheck({
        checkboxClass: 'icheckbox_square-grey',
        radioClass: 'iradio_square-grey'
    });

    // Form Sliders
    $('.slider').slider();


    $('[data-toggle="block-collapse"]').click(function() {

        if ($(this).hasClass("active")) {
            $(this).parents(".block").find(".block-content").slideDown(250);
            $(this).removeClass("active").html('<i class="icon-arrow-up"></i>');
        } else {
            $(this).parents(".block").find(".block-content").slideUp(250)
            $(this).addClass("active").html('<i class="icon-arrow-down"></i>')
        }
        ;
    });



    // Initialize DateRangePicker Advanced Demo Example
    var exampleAdvancedDateRange = $('.advanced-daterangepicker');
    var exampleAdvancedDateRangeSpan = $('.advanced-daterangepicker span');

    exampleAdvancedDateRange.daterangepicker({
        ranges: {
            'Hoy': ['hoy', 'hoy mismo'],
            'Desde ayer': ['ayer', 'hoy'],
            'Ultimos 7 Dias': [Date.today().add({days: -6}), 'hoy'],
            'Ultimos 30 Dias': [Date.today().add({days: -29}), 'hoy'],
            'Este Mes': [Date.today().moveToFirstDayOfMonth(), Date.today().moveToLastDayOfMonth()],
            'Mes Pasado': [Date.today().moveToFirstDayOfMonth().add({months: -1}), Date.today().moveToFirstDayOfMonth().add({days: -1})]
        }
    },
    function(start, end) {
        exampleAdvancedDateRangeSpan.html(start.toString('MMMM d, yy') + ' - ' + end.toString('MMMM d, yy'));
    });

    // Set the default content when page loads
    exampleAdvancedDateRangeSpan.html(Date.today().toString('MMMM d, yy') + ' - ' + Date.today().toString('MMMM d, yy'));

}



var _puede_salir_formulario = true;
function mostrar_contenidos(modulo, controlador, accion, datos) {
    if (!_puede_salir_formulario) {
        confirm(
                '<strong>¿Seguro que desea salir sin guardar los datos del formulario?</strong> ' +
                'Recuerde que para guardar debe hacer clic en el Boton <a class="btn btn-success" ><i class="icon-save" ></i> Guardar </a>.',
                'ejecutarAccionMuestraAreaTrabajo("' + modulo + '", "' + controlador + '", "' + accion + '", "' + datos + '");  '
                );
    } else {
        ejecutarAccionMuestraAreaTrabajo(modulo, controlador, accion, datos);
    }
}

function ejecutarAccionMuestraAreaTrabajo(modulo, controlador, accion, datos) {
    _puede_salir_formulario = true;
    bloqueoCargando();
    ajax(
            "&modulo=" + modulo + "&accion=" + accion + "&controlador=" + controlador + "&" + datos,
            "actualizar_area_contenido( data );  inciar_plugins_graficos(); ir_arriba(); desbloqueoCargando();  "
            );
}


function ejecutarAccion(modulo, controlador, accion, datos, script) {
    bloqueoCargando();
    ajax(
            "&modulo=" + modulo + "&accion=" + accion + "&controlador=" + controlador + "&" + datos,
            "desbloqueoCargando(); " + script + " "
            );
}
function ejecutarAccionSinBloqueo(modulo, controlador, accion, datos, script) {
    ajax(
            "&modulo=" + modulo + "&accion=" + accion + "&controlador=" + controlador + "&" + datos,
            " " + script
            );
}
function ejecutarAccionJson(modulo, controlador, accion, datos, script) {
    bloqueoCargando();
    json(
            "&modulo=" + modulo + "&accion=" + accion + "&controlador=" + controlador + "&" + datos,
            "desbloqueoCargando();  " + script
            );
}
function ejecutarAccionJsonSinBloqueo(modulo, controlador, accion, datos, script) {
    json(
            "&modulo=" + modulo + "&accion=" + accion + "&controlador=" + controlador + "&" + datos,
            " " + script
            );
}
function ejecutarAccionArchivos(modulo, controlador, accion, datos, script) {
    bloqueoCargando();
    datos.append('modulo', modulo);
    datos.append('accion', accion);
    datos.append('controlador', controlador);
    ajaxArchivos(
            datos,
            "desbloqueoCargando();  " + script
            );
}
function ejecutarAccionJsonArchivos(modulo, controlador, accion, datos, script) {
    bloqueoCargando();
    datos.append('modulo', modulo);
    datos.append('accion', accion);
    datos.append('controlador', controlador);
    jsonArchivos(
            datos,
            "desbloqueoCargando();  " + script
            );
}


function jsonArchivos(datos, script) {

    $.ajax({
        url: 'controlador.php', //Url a donde la enviaremos
        type: 'POST', //Metodo que usaremos
        dataType: 'json',
        contentType: false, //Debe estar en false para que pase el objeto sin procesar
        data: datos, //Le pasamos el objeto que creamos con los archivos
        processData: false, //Debe estar en false para que JQuery no procese los datos a enviar
        cache: false //Para que el formulario no guarde cache
    }).done(function(data) {
        eval(script);

    });
}
function ajaxArchivos(datos, script) {

    $.ajax({
        url: 'controlador.php', //Url a donde la enviaremos
        type: 'POST', //Metodo que usaremos
        //dataType:"html",
        contentType: false, //Debe estar en false para que pase el objeto sin procesar
        data: datos, //Le pasamos el objeto que creamos con los archivos
        processData: false, //Debe estar en false para que JQuery no procese los datos a enviar
        cache: false //Para que el formulario no guarde cache
    }).done(function(data) {
        eval(script);
        //ir_arriba();
    });
}
function ajax(datos, script) {

    /* Send the data using post */
    var posting = $.post('controlador.php', datos);
    posting.done(function(data) {
        eval(script);
        //ir_arriba();
    });
    posting.fail(function() {
        alert("ATENCIÓN: <strong>Verifique que su conexion a internet este activa</strong> e intente nuevamente realizar la operacion. Parece que no se puede realizar en la transmision de los datos. \r\nSi el problema persiste, por favor contacte al administrador del sistema.");
        desbloqueoCargando();
    })
    posting.always(function(data) {
        //alert('Termino la ejecucion:' + data);     
    });
}
function json(datos, script) {

    /* Send the data using post */
    var posting = $.post('controlador.php', datos, function() {
    }, "json");

    posting.done(function(data) {
        eval(script);
        //ir_arriba();
    });

    posting.fail(function() {
        alert("ATENCIÓN: <strong>Verifique que su conexion a internet este activa</strong> e intente nuevamente realizar la operacion.  Parece que no se puede realizar en la transmision de los datos. \r\nSi el problema persiste, por favor contacte al administrador del sistema.");
        desbloqueoCargando();
    })

    posting.always(function(data) {
    });
}

function mostrar_resultado_guardar(resp, funcExito, funcError) {

    switch (resp.resultado) {
        case 'ERROR':
            error(resp.mensaje);
            eval(funcError);
            break;
        case 'EXITO':
            informacion(resp.mensaje);
            eval(funcExito);
            break;
        case 'ALERTA':
            alert(resp.mensaje);
            eval(funcExito);
            break;
    }
}

function ir_arriba() {
    $('html, body').animate({scrollTop: 0}, 179);
}