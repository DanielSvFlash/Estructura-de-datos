<?php
	include("arriba.php");
?>
<?php
	
	//AQUI es donde mando a llamar a la base de datos con la siguiente instrucción y me retorna un arreglo con los datos de cada parada
	$var = select("select * from paradas  order by nombre");
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

	<script type="text/javascript">
		//mando los valores a la clase donde se hacen las transformaciones
		var lista = new arraylistparadas();
		//Mando el arreglo de estaciones
		lista.set_array(array);
		//alert(JSON.stringify(lista.get_array()));

		//Creo la ArrayList separado por lineas y en orden de estaciones
		lista.set_array_list();
		//alert(JSON.stringify(lista.get_array_list()));

		var flo = new floyd(array);
		flo.calcular_matrizM_inicial();
		//Con los valores de arriba estamos listos para buscar la lista



	</script>


	<div class="center"><br>
		<h1>Kiosko</h1>
		<br>
		<h3>¿Donde te encuentras?</h3>
		<div>
			<input type="text" id="myInput1" onkeyup="myFunction(1)" placeholder="Busca una parada..">
			<input type="button" name="" value="Buscar" onclick="myFunction(1)">
			<nav>
				<ul id="myUL1">
				  	
				</ul> 
			</nav>
		</div>

		<br>
		<h3>¿A donde vas?</h3>
		<div>
			<input type="text" id="myInput2" onkeyup="myFunction(2)" placeholder="Busca una parada..">
			<input type="button" name="" value="Buscar" onclick="myFunction(2)">
			<nav>
				<ul id="myUL2">
				  	
				</ul> 
			</nav>
		</div>
	</div>

	<script type="text/javascript">
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
					if(nombre.indexOf(elemento)!== -1&& array[x].estatus!=1)
					{
						resultado.innerHTML+='<div onclick="fun('+x+','+num+');">'+array[x].nombre+'</div>';
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
			document.getElementById("myInput"+num).value=array[valor].nombre;
			document.getElementById("myUL"+num).innerHTML="";
		}
	</script>

	<br><br>
	<div class="center">
		<input type="button" id="ruta" name="ruta" value="Ver ruta" onclick="ruta();">
	</div>
	<div id="pasos" class="auto"></div>
	<script type="text/javascript">
		function ruta()
		{
			var origen = document.getElementById("myInput1").value;
			var destino = document.getElementById("myInput2").value;
			if(origen!=""&&destino!="")
			{
				var pasos = calcular_ruta(flo,origen,destino,lista);
				$('#pasos').append('<br><br><h1>Pasos</h1><br>'+pasos);
				document.getElementById("pasos").focus();
				alert("Tu resultado esta listo");
			}else
			{
				alert("Debes llenar ambos campos");
			}
			
		}
	</script>

<?php
	include("abajo.php");
?>