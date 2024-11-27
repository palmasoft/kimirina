<style>
    .btn_ayuda {
        width: 64px;
        position: absolute;
        right: 6px;        
        opacity: 0.3;        
        transition:All 2s ease;        
        -webkit-transform: rotate(0deg) scale(1) skew(0deg) translate(0px);

        animation: brillo_ayuda ease 3s;
        animation-iteration-count: infinite;
        -webkit-animation: brillo_ayuda ease 3s;
        -webkit-animation-iteration-count: infinite;

    }
    .btn_ayuda:hover {        
        -webkit-transform: rotate(0deg) scale(1.5) skew(0deg) translate(0px);
        opacity: 1;
        animation: none;
        -webkit-animation: none;

    }


@keyframes brillo_ayuda{
  0% {
    opacity:1;
   
  }
  60% {
    opacity:0.37; 
  }
  80% {
    opacity:1;
        -webkit-transform: rotate(0deg) scale(1.1) skew(0deg) translate(0px);
  }
  100% {    
    opacity:0.37;    
  }
}

@-webkit-keyframes brillo_ayuda {
   0% {
    opacity:1;
   
  }
  60% {
    opacity:0.37; 
  }
  80% {
    opacity:1;
        -webkit-transform: rotate(0deg) scale(1.1) skew(0deg) translate(0px);
  }
  100% {    
    opacity:0.37;    
  }
}


    
    
</style>
<a href="#modal-videotutor" id="btn_ayuda"  class="btn_ayuda" data-toggle="modal" title="<?php if(!empty($ayuda->DESCRIPCION_AYUDA)) echo $ayuda->DESCRIPCION_AYUDA; ?>" >
    <img class="" src="imagenes/btn_ayuda_mini.png" />
</a>   
<div id="modal-videotutor" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close btn_ayuda_cerrar" data-dismiss="modal">×</button>
        <h4><?php echo $ayuda->TITULO_AYUDA; ?></h4>
    </div>
    <div class="modal-body">
        <?php  $this->mostrar('ayuda/' . $ayuda->TIPO_AYUDA, $this->datos, 'sistema'); ?>
    </div>
    <div class="modal-footer">
        <style style="width: 80%;float:left;" ><?php echo $ayuda->DESCRIPCION_AYUDA; ?></style>
        <button id="btn_ayuda_cerrar" class="btn btn-danger btn_ayuda_cerrar" data-dismiss="modal">Cerrar</button>            
    </div>
</div>   
<script>
    $('.btn_ayuda_cerrar').on("click", function() {
        $('#player_videotutores').attr(
                'src', "<?php echo $ayuda->URL_AYUDA . '?autoplay=0&autohide=1'; ?>"
                );
    });
</script> 