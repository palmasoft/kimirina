<?php ?>

<meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">

<form id="form-condultacedula" action="" method="post" onsubmit="return false;" >
    <table align="center">
        <tr>
            <td width="200px" align="LEFT">Número de Cédula:</td>       
            <td >
                <input type="text" id="nroced"  NAME="nroced" size="10" maxlength="10" />
            </td>
            <td  align="CENTER"> 
                <input type="submit" value="Buscar" /> 
            </td>
        </tr>
    </table>
</form>
<div id="loaderImage" style="display:none;width:120px;margin:auto;" ></div>
<div id="consola" style="width:100%; text-align:center;display:none;" >

</div>

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script>

                                  $(document).ready(function() {

                                      $('#form-condultacedula').submit(function(e) {

                                          $('#loaderImage').show();
                                          $('#consola').hide();

                                          $.ajax({
                                              url: "consultar_sitio.php",
                                              dataType: "html",
                                              data: {
                                                  nada: "nada"
                                              },
                                              success: function(response) {
                                                  var cedula = $('#nroced').val();
                                                  var valCodigoAcceso = $(response).find('input');
                                                  var codAcceso = $(valCodigoAcceso[1]).val();
                                                  $('#consola').html('');
                                                  //$('#consola').html( '<p>Codigo de Acceso Obtenido: => ' + codAcceso + '</p>' );

                                                  $.ajax({
                                                      url: "consultar_datos.php",
                                                      dataType: "html",
                                                      data: {
                                                          codAcceso: codAcceso,
                                                          cedula: cedula
                                                      },
                                                      success: function(response) {


                                                          var tblDatos = $(response).find('#container table');
                                                          //$('#consola').append('<p><table>' + $(tblDatos[1]).html() + '</table></p>');

                                                          //$('#consola').append('<hr />');

                                                          var filasTbl = $(tblDatos[1]).find('tr');
                                                          if (filasTbl.length > 1) {
                                                              var datosTbl = $(filasTbl[1]).find('td');

                                                              $('#consola').append('<hr />');
                                                              var cedulaResultado = $(datosTbl[0]).text();
                                                              var nombreResultado = $(datosTbl[1]).html();
                                                              var parte_nombres = $(nombreResultado).text().split(" ");
                                                              var nacimientoResultado = $(datosTbl[2]).text();
                                                              var fecha = $(datosTbl[2]).text().split('/');
                                                              var condicionResultado = $(datosTbl[3]).text();
                                                              var estadoResultado = $(datosTbl[4]).text();
                                                              var conyugeResultado = $(datosTbl[5]).text();


                                                              $('#consola').append('<h3>Nombre: <strong>' + parte_nombres[2] + ' ' + parte_nombres[3] + ' ' + parte_nombres[0] + ' ' + parte_nombres[1] + '</strong></h3>');
                                                              $('#consola').append('<h4>Cedula: <strong>' + cedulaResultado + '</strong> | Nacimiento: <strong>' + fecha[1] + '/' + fecha[0] + '</strong></h3>');
                                                              var codigoUnico = parte_nombres[2].substr(0, 2) + '' + parte_nombres[3].substr(0, 2) + '' + parte_nombres[0].substr(0, 2) + '' + parte_nombres[1].substr(0, 2) + '' + fecha[1].substr(0, 2) + '' + fecha[0].substr(2, 2);
                                                              $('#consola').append('<h1>Codigo <strong>' + codigoUnico + '</strong></h1>');

                                                          } else {
                                                              $('#consola').append('<h1>LA CEDULA NO SE ENCUENTRA</h1>');
                                                          }


                                                          $('#loaderImage').fadeOut();
                                                          $('#consola').slideDown('2000');

                                                      }
                                                  });

                                              }
                                          });

                                      });

                                  });

</script>

<script type="text/javascript" src="canvas.js"></script>
<script type="text/javascript">
                                    var cSpeed = 9;
                                    var cWidth = 104;
                                    var cHeight = 128;
                                    var cTotalFrames = 35;
                                    var cFrameWidth = 104;
                                    var cImageSrc = 'images/sprites.png';

                                    var cImageTimeout = false;

                                    function startAnimation() {

                                        document.getElementById('loaderImage').innerHTML = '<canvas id="canvas" width="' + cWidth + '" height="' + cHeight + '"><p>Your browser does not support the canvas element.</p></canvas>';

                                        //FPS = Math.round(100/(maxSpeed+2-speed));
                                        FPS = Math.round(100 / cSpeed);
                                        SECONDS_BETWEEN_FRAMES = 1 / FPS;
                                        g_GameObjectManager = null;
                                        g_run = genImage;

                                        g_run.width = cTotalFrames * cFrameWidth;
                                        genImage.onload = function() {
                                            cImageTimeout = setTimeout(fun, 0)
                                        };
                                        initCanvas();
                                    }


                                    function imageLoader(s, fun)//Pre-loads the sprites image
                                    {
                                        clearTimeout(cImageTimeout);
                                        cImageTimeout = 0;
                                        genImage = new Image();
                                        genImage.onload = function() {
                                            cImageTimeout = setTimeout(fun, 0)
                                        };
                                        genImage.onerror = new Function('alert(\'Could not load the image\')');
                                        genImage.src = s;
                                    }

                                    //The following code starts the animation
                                    new imageLoader(cImageSrc, 'startAnimation()');
</script>