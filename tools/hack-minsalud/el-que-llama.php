
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.js" ></script>
<script type="text/javascript">
			function inicializarCombo(obj,valor,bandera)
			{
				while(obj.length > 0)
				{
					obj.remove(obj.length-1);
				}
				$("#Provincia").attr("disabled",true);
				$("#Canton").attr("disabled",true);
				$("#Parroquia").attr("disabled",true);
				if (bandera=="parroquia")
				{
					sql="SELECT DISTINCT(parroquia) as item FROM unidades WHERE provincia='" + document.getElementById('Provincia').value + "' AND canton='"+ valor+"' ORDER BY item;";
					aux="a Parroquia";
				}
				else
				{
					sql="SELECT DISTINCT(canton) as item FROM unidades WHERE provincia='" + valor + "' ORDER BY item;";
					aux=" Canton";	
				}

				alert( sql );

				$.ajax({
					type:'POST',
					dataType: 'html',
					url:"leer-db-mapas.php",
	crossDomain: true, 
				data:{valor:sql},
					success: function(json)
					{
						alert( json );
						$("#Provincia").attr("disabled",false);
						$("#Canton").attr("disabled",false);
						$("#Parroquia").attr("disabled",false);
						var combo = obj;
						combo.options[0] = new Option('Selecciona un' + aux + '.', '');
						for(var i=0;i<json.length;i++)
						{
							combo.options[combo.length] = new Option(json[i], json[i]);
						}
					}
				});
			}
		</script>








		<select name="Provincia" id="Provincia" onchange="inicializarCombo(document.getElementById(&#39;Canton&#39;),this.value,&#39;canton&#39;);"><option value="S">--Seleccione Provincia--</option><option value="AZUAY">AZUAY</option><option value="BOLIVAR">BOLIVAR</option><option value="CANAR">CANAR</option><option value="CARCHI">CARCHI</option><option value="CHIMBORAZO">CHIMBORAZO</option><option value="COTOPAXI">COTOPAXI</option><option value="EL ORO">EL ORO</option><option value="ESMERALDAS">ESMERALDAS</option><option value="GALAPAGOS">GALAPAGOS</option><option value="GUAYAS">GUAYAS</option><option value="IMBABURA">IMBABURA</option><option value="LOJA">LOJA</option><option value="LOS RIOS">LOS RIOS</option><option value="MANABI">MANABI</option><option value="MORONA SANTIAGO">MORONA SANTIAGO</option><option value="NAPO">NAPO</option><option value="ORELLANA">ORELLANA</option><option value="PASTAZA">PASTAZA</option><option value="PICHINCHA">PICHINCHA</option><option value="SANTA ELENA">SANTA ELENA</option><option value="SANTO DOMINGO DE LOS TSACHILAS">SANTO DOMINGO DE LOS TSACHILAS</option><option value="SUCUMBIOS">SUCUMBIOS</option><option value="TUNGURAHUA">TUNGURAHUA</option><option value="ZAMORA CHINCHIPE">ZAMORA CHINCHIPE</option><option value="ZONA NO DELIMITADA">ZONA NO DELIMITADA</option></select>
		<select id="Canton" name="Canton" onchange="inicializarCombo(document.getElementById(&#39;Parroquia&#39;),this.value,&#39;parroquia&#39;);"></select>
		<select id="Parroquia" name="Parroquia"></select>   



		<div id="listado"></div>
										