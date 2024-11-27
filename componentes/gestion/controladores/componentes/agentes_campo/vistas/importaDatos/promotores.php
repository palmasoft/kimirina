<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>




<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon glyphicon-cloud-upload themed-color"></i> IMPORTACION DE DATOS DESDE ARCHIVOS<br>
        <small>Desde esta funcionalidad usted podrá cargar desde un archivo CVS, de los abordajes o alcances de promotores</small>
    </h1>
</div>
<!-- END Pre Page Content -->


<!-- Page Content -->
<div id="page-content">
    <!-- Breadcrumb -->
    <!-- You can have the breadcrumb stick on scrolling just by adding the following attributes with their values (data-spy="affix" data-offset-top="250") -->
    <!-- You can try it on other elements too :-), the sticky position and style can be adjusted in the css/main.css with .affix class -->
    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="205">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="#">Importar</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Abordajes de Promotores</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <div class="block  block-themed" >
        <div class="block-title">
            <h4>
                <a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Generales"><i class="icon-arrow-up"></i></a>  
                Datos 
            </h4>
            <div class="block-options">    



            </div>  
        </div>
        <div class="block-content"> 


            <form id="frmImportar" method="post" action="" enctype="multipart/form-data" onsubmit="return false;" >

                <input type="file" name="excel" id="archivo" file-upload multiple/>

                <input type="submit" name="enviar" id="enviar" value="Importar"  />

                <input type="hidden" value="upload" name="action" />
                
                
<br>El documento a subir es en formato delimitado por punto y coma (cvs) y debe constar de 25 datos

<br>La primera fila debe contener el nombre de los encabezados de los registros

<br>Las columnas marcadas con * son obligatorias, las demas son opcionales

<br>*Columna 1: Codigo del Subreceptor: Es llenado con las siglas usadas para el subreceptor elegido, si no las conoce.
<br>*Columna 2: Codigo del Tipo de Poblacion: Es llenado con las siglas usadas para definir el tipo de poblacion abordada.
<br>*Columna 3: Nombre del Promotor que realiza el abordaj: Nombre completo de la persona que realiza el abordaje, se llena de la siguiente manera: Primer Apellido, Segundo Apellido, Primer Nombre, Segundo Nombre
<br>*Columna 4: Nombre del Canton donde se realiza el abordaje: Es llenado nombre del canton donde se realizo el abordaje
<br>*Columna 5: Tipo de Lugar donde se realiza el abordaje: Es llenado con el tipo de lugar previamente definido donde se realizo el abordaje
<br>Columna 6: Lugar de abordaje: El nombre del lugar donde fue abordada la persona
<br>Columna 7: Primer Apellido de la persona: Se llena con el primer apellido de la persona abordada.
<br>Columna 8: Segundo Apellido de la persona: Se llena con el segundo apellido de la persona abordada.
<br>Columna 9: Primer Nombre de la persona: Se llena con el primer nombre de la persona abordada.
<br>Columna 10: Segundo Nombre de la persona: Se llena con el segundo nombre de la persona abordada.
<br>Columna 11: Otro nombre de la persona: Se llena con otro nombre suministrado por la persona abordada si fue dado
<br>Columna 12: Cedula de la persona: Es llenada con el numero de documento de identidad de la persona abordada
<br>Columna 13: Numero telefonico de la persona: Es llenada con el numero telefonico de la persona abordada
<br>Columna 14: Sexo de la persona: Siglas que definen el sexo de la persona, debe ser llenado con su edad en numeros
<br>*Columna 15: Edad de la persona: Edad en numeros de la persona
<br>Columna 16: Realiza trabajo sexual: Indica si la persona realiza trabajo sexual, debe llenarse de la siguiente manera SI/NO
<br>Columna 17: Fecha de realizacion del abordaje: Dia de realizacion de abordaje, debe ser llenado en formato dd/mm/yyyy
<br>Columna 18: Hora de realizacion del abordaje: Hora de realizacion del abordaje, debe ser llenado en formato de hora militar HH:MM
<br>Columna 19: Tipo de alcance: Indica si la persona abordada es nueva o recurrente, debe llenarase de la siguiente manera  N/R
<br>Columna 20: Tema: Es el tipo de informacion tratada a la persona que se abordo
<br>Columna 21: Cantidad de folletos entregados: Es la cantidad de folletos entregados, debe llenarse con numeros y si no fueron entregados entonces debe llenarse con cero (0)
<br>Columna 22: Numero de condones entregados: Es la cantidad de condones entregados, debe llenarse con numeros y si no fueron entregados entonces debe llenarse con cero (0)
<br>Columna 23: Numero de lubricantes entregados: Es la cantidad de lubricantes entregados, debe llenarse con numeros y si no fueron entregados entonces debe llenarse con cero (0)
<br>Columna 24: Fue atendido en un centro de salud: Indica si fue atendido o no en un centro de salud, debe llenarse de la siguiente manera SI/NO
<br>Columna 25: Fecha de atencion: Dia de atencion en el centro de salud si hubo, debe ser llenado en formato dd/mm/yyyy
<br>Columna 26: Hora de atencion: Hora de la atencion en el centro de salud si hubo, debe ser llenado en formato de hora militar HH:MM
<br>Columna 27: Nombre de centro de salud: Es el nombre del centro de salud donde fue atendido
<br>Columna 28: Observaciones: Anotaciones extras para el registro, es opcional llenarla

<br>Recuerde que no puede existir ninguna fila despues de la ultima, aunque esta se encuentre vacía

            </form>
            
            
            <div id="respúesta_validacion" ></div>



        </div>        
    </div>   

</div>



<script>
    $(document).ready(function() {

        $('#frmImportar').submit(function(e) {
            $(this).slideUp();

            var datos = new FormData();
            datos.append('modulo', 'agentes_campo' );
            datos.append('controlador', 'importarDatosAbordajes' );
            datos.append('accion', 'importar_datos_promotor' );
            datos.append('archivo', $('#archivo')[0].files[0]);

            $.ajax({
                type: "post",
                dataType: "html",
                url: "controlador.php",
                contentType: false,
                data: datos,
                processData: false,
            }).done(function(respuesta) {
                 $('#respúesta_validacion').html( respuesta );
                 $('#respúesta_validacion').slideDown();
            });
                        
        });
    });

</script>