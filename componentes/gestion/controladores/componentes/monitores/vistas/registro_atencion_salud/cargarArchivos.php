<form action="archivosAnimadores.php" class="dropzone" type="post" > 
    <input type="hidden" id="subreceptor"  name="subreceptor" value="<?php echo  $_SESSION['SESION_USUARIO']->CODIGO_SUBRECEPTOR ?>" />
    <input type="hidden" id="usuario"  name="usuario" value="<?php echo  $_SESSION['SESION_USUARIO']->ID_PERSONA ?>" />
    <input type="hidden" id="fecha"  name="fecha" value="<?php echo date('usihdmY'); ?>" />
    <div class="fallback">
        <input type="file" id="archivo_registro_atencion" name="archivo_registro_atencion"  />
    </div>
</form>


<script>
$(document).ready(function() {
   // $(".dropzone").dropzone();
    
  var myDropzone = new Dropzone(".dropzone");

  myDropzone.on("addedfile", function(file) {
    /* Maybe display some more file information on your page */
    //alert('cargado'+file.name);
    var nombreArchivo = $('#subreceptor').val() + "_" + $('#usuario').val() + "_" + $('#fecha').val()+'_' ;
    $('#dir_archivo_soporte').attr('value', nombreArchivo + file.name);
  });
});
</script>
