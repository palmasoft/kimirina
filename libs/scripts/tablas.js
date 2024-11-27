var tabla = null;



function agregar_fila(oTableLocal, datos) {
    oTableLocal.fnAddData(datos);
}


function cantidad_filas(oTable) {
    var nFilas = 0;
    $('#' + oTable + ' tbody tr').each(function() {
        nFilas++;
    });

    return nFilas;
}









function fnShowHide(iCol)
{
    var bVis = tabla.fnSettings().aoColumns[iCol].bVisible;
    tabla.fnSetColumnVis(iCol, bVis ? false : true);
}

function filaId(oTableLocal)
{
    return oTableLocal.$('tr.row_selected').attr('fila-id');
    /*
     var aTrs = oTableLocal.fnGetNodes();
     var aReturn = new Array();
     for ( var i=0 ; i<aTrs.length ; i++ )
     {
     if ( $(aTrs[i]).hasClass('row_selected') )
     {
     aReturn.push( $(aTrs[i]).attr('fila-id') );
     }
     }
     return aReturn;
     */
}

function filaSeleccionada(oTableLocal, atributo)
{
    return oTableLocal.$('tr.row_selected').attr(atributo);
    /*      
     if ( !isVacio(oTableLocal.$('tr.row_selected').attr( atributo )) ){   
     return oTableLocal.$('tr.row_selected').attr(atributo);     
     } 
     return false;       
     */
}

function seleccionar_fila(obj) {

    if ($(obj).hasClass('row_selected')) {
        $(obj).removeClass('row_selected');
    } else {
        $(obj).closest('.datatable').find('tr.row_selected').removeClass('row_selected');
        $(obj).addClass('row_selected');
    }

}

function eliminarFilas(oTableLocal)
{
    var aTrs = oTableLocal.fnGetNodes();
    for (var i = 0; i < aTrs.length; i++)
    {
        if ($(aTrs[i]).hasClass('row_selected'))
        {
            oTableLocal.fnDeleteRow(aTrs[i]);
        }
    }
    return true;
}






function iniciar_tablas() {

    $(".dataTables tbody tr").click(function(e) {
        if ($(this).hasClass('row_selected')) {
            $(this).removeClass('row_selected');
        }
        else {
            tabla.$('tr.row_selected').removeClass('row_selected');
            $(this).addClass('row_selected');
        }
    });

    tabla = $('.dataTables').dataTable({
        "iDisplayLength": 20
    });
}