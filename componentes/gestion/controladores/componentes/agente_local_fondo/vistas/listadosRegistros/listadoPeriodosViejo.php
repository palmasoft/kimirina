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
        <i class="glyphicon glyphicon-calendar themed-color"></i> Gestion de Periodos<br>
        <small>Desde esta funcionalidad usted podrá habilitar en el sistema el periodo deseado</small>
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
        <li class="active"><a href="#">Gestion de Periodos</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <div class="block  block-themed" >
        
        <div class="block-title">
                <h4><a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Generales"><i class="icon-arrow-up"></i></a>  
                    Periodos
                </h4>
                <div class="block-options">                    
                    <span class="text-center"><i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span></span>
                    <div class=" btn-group">
                        <a href="javascript:$('#frmPeriodos').submit();" data-toggle="tooltip" title="Habilitar periodo" class="btn btn-success"><i class="icon-save"></i>Habilitar</a>
                    </div>
                </div>   
            </div>
<!--        <table class="botones_arriba" align="center" ><tr><td>
		<div class=" span1 btn-group">
						
		</div>
                <span class="span3 text-center">
                    <i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span>
                </span>
		<div class="btn-group">			
			<button type="submit" id="btn_habilitar_periodo" class="btn btn-success"><i class="icon-save"></i> Habilitar</button>
                        <a href="javascript:$('#frmPeriodos').submit();" data-toggle="tooltip" title="Habilitar periodo" class="btn btn-success"><i class="icon-save"></i>Habilitar</a>
		</div>
    </td></tr></table>-->
<!--        <div class="block-title">
            <h4>
                <a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="" data-original-title="Cerrar / Abrir Generales"><i class="icon-arrow-up"></i></a>  
                Periodos 
            </h4>
            <div class="block-options">    
                
            </div>  
        </div>-->
        
        <div class="block-content"> 
            <?php $this->mostrar("formulariosGestion/tablaPeriodos", $this->datos); ?>
            <!--<div id="respúesta_validacion" ></div>-->
        </div>        
    </div>   

</div>



<script>
    $(document).ready(function() {
    
        $('#frmPeriodos').submit(function(e) {
            
            $(this).slideUp();

            var datos = new FormData();
            datos.append('modulo', 'gestion' );
            datos.append('controlador', 'gestionarPeriodos' );
            datos.append('accion', 'habilitar_periodos' );
            datos.append('periodo-activo', $('#periodo-activo').val());
            

            var checked = $('#periodo-a-activar:checked').val();
            datos.append('periodo-a-activar', checked);

            $.ajax({
                type: "post",
                dataType: "html",
                url: "controlador.php",
                contentType: false,
                data: datos,
                processData: false,
            }).done(function(respuesta) {
                
                alert(respuesta);
                ejecutarAccionJson(
                   'gestion', 'gestionPeriodos', '', '', 'mostrar_lista_periodos();' 
               );
//                 $('#respúesta_validacion').html( respuesta );
//                 $('#respúesta_validacion').slideDown();
            });
             
        });
    });
    
    $('.check-periodos').click(function(){

      $('.check-periodos').attr('checked', false);
      $(this).attr('checked', true);

    });
    
    $('#periodos-datatables tr').click(function(event) {
    if (event.target.type !== 'checkbox') {
      $(':checkbox', this).trigger('click');
    }
  });
  
//  $("tr").click(function() {
//    var checkbox = $(this).find("input[type='checkbox']");
//    checkbox.attr('checked', !checkbox.attr('checked'));
//});

</script>