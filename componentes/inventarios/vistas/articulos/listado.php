
<?php
/*
echo '<table>';

foreach($productos as $arrs)
    {
    echo '<tr>';
    foreach($arrs as $name => $item)
    {
        if ($name=='ID_ARTICULO' || $name=='NOMBRE_ARTICULO' || $name=='DESCRIPCION_ARTICULO') {
            echo "<th>$name</th>";
        }
        //echo "<th>$name</th>";
    }
    echo '</tr>';
        break;
    }


foreach($productos as $arrs)
    {
    echo '<tr>';
    foreach($arrs as $item)
    {
        //echo "<td>$item</td>";
        echo "<td>".$arrs->ID_ARTICULO."</td>";
        echo "<td>".$arrs->NOMBRE_ARTICULO."</td>";
        echo "<td>".$arrs->DESCRIPCION_ARTICULO."</td>";
        break;
    }
    echo '</tr>';
    }

echo '</table>';
*/

?>
<!--<a href="javascript:void(0);" onclick="fnShowHide(0);">ID_ARTICULO<br></a>
<a href="javascript:void(0);" onclick="fnShowHide(1);">NOMBRE_ARTICULO<br></a>
<a href="javascript:void(0);" onclick="fnShowHide(2);">DESCRIPCION_ARTICULO<br></a>
<a href="javascript:void(0);" onclick="fnShowHide(2);">NOMBRE_CATEGORIA_ARTICULO<br></a>
<a href="javascript:void(0);" onclick="fnShowHide(3);">VALOR_PRECIO_VENTA<br></a>-->
<script type="text/javascript" src="libs/js/jeditable.js"></script>
<div class="block-border">
    <div class="block-header">
        <h1>Informacion Articulos</h1><span></span>
    </div>
    <div class="block-content">
        <table id="tbl_productos_domicilios" class="table">
            <thead>
            	<tr>
            		<td>CATEGORIA</td>
	            	<td>PROVEEDOR</td>
	            	<td>NOMBRE</td>
	            	<td>EXISTENCIA</td>
	            	<td>PRECIO VENTA</td>
	            	<td>PRECIO COMPRA</td>
            	</tr>
            </thead>
            <tbody>
                <?php
                    foreach($productos as $arrs)
                    {
                    echo '<tr class="gradeX">';
                        echo "<td>".$arrs->NOMBRE_CATEGORIA_ARTICULO."</td>";
                        echo "<td>".$arrs->NOMBRE_PROVEEDOR."</td>";
                        echo "<td>".$arrs->NOMBRE_ARTICULO."</td>";
                       	echo "<td>".$arrs->EXISTENCIA_ARTICULO/*." ".$arrs->SIMBOLO_UNIDAD_ARTICULO*/."</td>";
                    	echo "<td>$ ".number_format( $arrs->VALOR_PRECIO_VENTA )."</td>";
                    	echo "<td>$ ".number_format( $arrs->VALOR_PRECIO_COMPRA )."</td>";
                    echo '</tr>';
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">


    var tabla ;

    $().ready(function() {

        //Inicializa la tabla
        tabla = $('#tbl_productos_domicilios').dataTable();

        //Oculta la columna donde se encuentran los id's de los articulos
        tabla.fnSetColumnVis( 0, false );

        // Add a click handler to the rows - this could be used as a callback
        // Añadir evento en click para borrar fila
        $('#borrar').click( function() {
            var anSelected = FilaBorrar( tabla );
            tabla.fnDeleteRow( anSelected[0] );
            //enviar_producto_nuevo_domicilios(datos);
        });
        // Añadir evento en click para editar fila
        $('#editar').click( function() {
            var anSelected = FilaEditar( tabla );
            tabla.fnDeleteRow( anSelected[0] );
            //enviar_producto_nuevo_domicilios(datos);
        });
    });


        function fnShowHide( iCol )
        {
            var bVis = tabla.fnSettings().aoColumns[iCol].bVisible;
            tabla.fnSetColumnVis( iCol, bVis ? false : true );
        }

        function FilaBorrar( oTableLocal )
        {
            var aReturn = new Array();
            var aTrs = oTableLocal.fnGetNodes();
            var aData
            for ( var i=0 ; i<aTrs.length ; i++ )
            {
                if ( $(aTrs[i]).hasClass('row_selected') )
                {
                    aReturn.push( aTrs[i] );
                    aData = oTableLocal.fnGetData( i );
                    eliminar_producto_seleccionado_domicilios(aData);
                    //alert(aData[0]);
                }
            }
            return aReturn;
        }
        function FilaEditar( oTableLocal )
        {
            var aReturn = new Array();
            var aTrs = oTableLocal.fnGetNodes();
            var aData
            for ( var i=0 ; i<aTrs.length ; i++ )
            {
                if ( $(aTrs[i]).hasClass('row_selected') )
                {
                    aReturn.push( aTrs[i] );
                    aData = oTableLocal.fnGetData( i );
                    //alert(aData[0]);
                    ver_formulario_productos_domicilios(aData[0]);
                }
            }
            return aReturn;
        }
</script>