<?php
	include("arriba.php");
?>
<?php
	
	//AQUI es donde mando a llamar a la base de datos con la siguiente instrucción y me retorna un arreglo con los datos de cada parada
	$var = select("select * from paradas order by nombre");
	$x=0;
	$arregloparadas = array();
	?>
	<script type="text/javascript">
		//Aqui creo el objeto temporal que usare 
		var objeto = new estacion();
		//Este es el arreglo en el que voy a guardar los objetos
		var array = [];
	</script>
	<?php
	while($x<count($var))
	{
		//Aqui guardo un arreglo con los valores
		/*array_push($arregloparadas, $var[$x]->idlinea, $var[$x]->idestacion, $var[$x]->nombre, $var[$x]->tipo, $var[$x]->estatus, $var[$x]->puntosdi);*/
		?>
		<script type="text/javascript">
			/*var hola = <?php echo $var[$x]->idlinea; ?>;
			objeto.set_idlinea(<?php echo $var[$x]->idlinea; ?>);
			alert(hola);*/
			//Guardo los balores en el objeto
			objeto.set_idlinea(<?php echo $var[$x]->idlinea; ?>);
			objeto.set_idestacion(<?php echo $var[$x]->idestacion; ?>);
			objeto.set_nombre("<?php echo $var[$x]->nombre; ?>");
			objeto.set_tipo(<?php echo $var[$x]->tipo; ?>);
			objeto.set_estatus(<?php echo $var[$x]->estatus; ?>);
			objeto.set_puntos("<?php echo $var[$x]->puntosdi; ?>");
			//meto el objeto en un arreglo
			array.push(Object.assign({}, objeto));
			//alert(JSON.stringify(objeto));
		</script>
		<?php
		
		$x++;
	}
	//echo ("<br>".$x."--".implode(",", $arregloparadas) );
?>


	<div class="center"><br>
		<h1>Admin</h1>
		<br>
		<h3>¿Selecciona la estación a deshabilitar?</h3>
		<div>
			<input type="text" id="myInput1" onkeyup="myFunction(1)" placeholder="Busca una parada..">
			<input type="button" name="" value="Buscar" onclick="myFunction(1)">
			<nav>
				<ul id="myUL1">
				  	
				</ul> 
			</nav>
		</div>
		<br><br>
		<div class="center">
			<input type="button" id="ruta" name="ruta" value="Deshabilitar estación" onclick="deshabilitar();">
		</div>
	</div>


	<script type="text/javascript">
		function deshabilitar()
		{
			var elemento =document.getElementById("myInput1").value.toLowerCase();
			var resultado=document.getElementById("myUL1");
			if(elemento!="")
			{
				var x=0;
				//Ciclo para recorrer el arreglo de objetos para buscar
				for(x=0;x<array.length;x++)
				{
					var nombre = array[x].nombre.toLowerCase();
					if(nombre.indexOf(elemento)!== -1)
					{
						window.location.href="admin.php?variable="+array[x].nombre;
					}
				}
			}else
			{
				alert("Debes ingresar un valor");
			}
		}

		var objeto = null;
		//Funcion para mostrar las opciones de busqueda
		function myFunction(num)
		{
			//Recibo lo que el usuario esta escribiendo
			var elemento =document.getElementById("myInput"+num).value.toLowerCase();
			var resultado=document.getElementById("myUL"+num);
			//alert(elemento);
			//si no esta vacio muestro las opciones
			resultado.innerHTML="";
			if(elemento!="")
			{
				var x=0;
				//Ciclo para recorrer el arreglo de objetos para buscar
				for(x=0;x<array.length;x++)
				{
					var nombre = array[x].nombre.toLowerCase();
					if(num==2)
					{
						if(nombre.indexOf(elemento)!== -1)
						{
							resultado.innerHTML+='<div onclick="fun('+x+','+num+');">'+array[x].nombre+'</div>';
						}
					}else
					{
						if(array[x].tipo==1)
						{
							if(nombre.indexOf(elemento)!== -1)
							{
								resultado.innerHTML+='<div onclick="fun('+x+','+num+');">'+array[x].nombre+'</div>';
							}
						}
					}
					
				}
				//$('#myUL').append('<br> Hola');
			//Si esta vacio entonces borro la lista
			}else
			{
				document.getElementById("myUL"+num).innerHTML="";
			}
			//alert("Hola");
			
		}

		function fun(valor,num)
		{
			objeto=array[valor];
			document.getElementById("myInput"+num).value=array[valor].nombre;
			document.getElementById("myUL"+num).innerHTML="";
		}
	</script>


<?php
	
	$var = select("select * from paradas where estatus = 1 order by nombre");
	$x=0;
	while($x<count($var))
	{
		?>
		<br><br>
		<div class="center">
			<div class="linea1 ">
				<div>
					<?php echo $var[$x]->nombre; ?>
				</div>
				<a href="admin.php?variable2=<?php echo $var[$x]->nombre; ?>">Habilitar</a>
			</div>
		</div>
		<?php
		$x++;
	}


	if(isset($_GET['variable']))
	{
		updateestatus($_GET['variable']);
		?>
		<script type="text/javascript">
			
			document.location="admin.php";
		</script>
		<?php
	}
	if(isset($_GET['variable2']))
	{
		updateestatus2($_GET['variable2']);
		?>
		<script type="text/javascript">
			
			document.location="admin.php";
		</script>
		<?php
	}
?>

	<div class="center">
		<h3>¿Selecciona la estación a modificar?</h3>
		<div>
			<input type="text" id="myInput2" onkeyup="myFunction(2)" placeholder="Busca una parada..">
			<input type="button" name="" value="Buscar" onclick="myFunction(2)">
			<nav>
				<ul id="myUL2">
				  	
				</ul> 
			</nav>
		</div>
	</div>
	<br><br>
	<div class="center">
		<input type="button" id="ruta" name="ruta" value="Modificar estación" onclick="modificar();">
	<br><br>
		<div id="mychanges">
			<div>Datos actuales:</div>
			<br><br>
			<div class="formulario" id="formulario">
				<input type="text" name="name" id="name" class="hide">
				Nombre:<br><input type="text" name="nombre" id="nombre">
				<br>
				Puntos de interes(Separados por comas):<br><textarea id="puntosdi">
				</textarea>
				<br>
				<input type="button" name="guardar" id="guardar" value="Guardar Cambios">
			</div>
		</div>
	</div>
	<script type="text/javascript">
		
		function modificar()
		{	
			var nombre = document.getElementById("myInput2");
			if(objeto!=null)
			{
				//alert(objeto.nombre);
				document.getElementById("name").value=objeto.nombre;
				document.getElementById("nombre").value=objeto.nombre;
				document.getElementById("puntosdi").value=objeto.puntos_de_interes;
				document.getElementById("formulario").style.display = "block";
			}else
			{
				alert("Debes llenar el campo de estacion ");
			}
		}

		jQuery(document).ready(function()
		{
			$("#guardar").click(function()
			{
				if($("#nombre").val()!=""&&$("#puntosdi").val()!="")
				{
					$.ajax({
						method: "POST",
						url: "update.php",
						data: 
						{
							nombrev:$("#name").val(),
							nombren:$("#nombre").val(),
							puntosdi:$("#puntosdi").val()
						}
					}).done(function(respuesta)
					{
						if(respuesta == "si")
						{
							alert("Estación actualizada exitosamente");
							document.location="admin.php";
						}else
						{
							alert(respuesta);
						}
			
					});
				}
				
			});
		});
	</script>

<?php

	include("abajo.php");
?>