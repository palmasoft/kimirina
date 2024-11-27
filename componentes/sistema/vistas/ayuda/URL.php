
<script>    
    $('#btn_ayuda').on( "click", function(){
       $('#player_videotutores').attr(
            'src', "<?php echo $ayuda->URL_AYUDA.'?autoplay=1&autohide=1'; ?>"
        );
    });    
</script>
<iframe id="player_videotutores" width="100%" height="320" 
        src="<?php echo $ayuda->URL_AYUDA; ?>" frameborder="0" allowfullscreen ></iframe>