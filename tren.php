<?php
	include("arriba.php");
	include("principal.php");
?>
<br><br><br><br>



	<h1>Ingrese la parada a buscar</h1>
	<input type="text" name="" id="parada">
	<input type="button" name="" value="Busqueda Binaria" onclick="f1(1);">
	<input type="button" name="" value="Busqueda Secuencial" onclick="f1(2);">
	<br><br>
	

<?php
	
	//AQUI es donde mando a llamar a la base de datos con la siguiente instrucción y me retorna un arreglo con los datos de cada parada
	$var = select("select * from paradas order by nombre");
	$x=0;
	$arreglonombres = array();
	$arreglolineas = array();
	?>
	<script type="text/javascript">
		//Aqui creo el objeto temporal que usare 
		var objeto = new estacion();
		//Este es el arreglo en el que voy a guardar los objetos
		var array = [];
	</script>
	<?php
	while($x<sizeof($var))
	{
		//Aqui guardo un arreglo con los puros nombres
		array_push($arreglonombres, $var[$x]->nombre);
		array_push($arreglolineas, $var[$x]->idlinea);
		echo ("<br>".$x."--".$var[$x]->nombre );
		

		?>
		<script type="text/javascript">
			
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

	
	//echo "Segun esto todo bien";
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


<script type="text/javascript">

	function f1(val)
	{
		var parada = $('#parada').val();
		if(isNaN(parada))
		{
			//Aqui es donde convierto la lista de php a un string separando las palabras con comas
			var listaparadas = "<?php echo implode(",",$arreglonombres);?> ";
			//Aqui separo ese string por las comas que se colocaron para ponerlo en un arreglo de javascript
			var listanombre = listaparadas.split(",");
			//alert(listanombre);
			//Aqui es donde hago un switch para ver si la busqueda es binaria o secuencial
			switch (val)
			{
				//El caso uno es cuando la busqueda es binaria
				case 1:
					//Mando a llamar la funcion
					var res = busquedaBinariaRecursiva(listanombre, parada,0,listanombre.length-1);
					//Si encontro el valor el resultado sera la posicion de la lista en la que se encuentra
					if(res!=-1)
					{
						//imprime la posicion del arreglo en la que se encuentra
						alert("La parada se encuentra en la posición: "+ res +" de la lista");
						alert("La parada forma parte de las lineas: "+buscar(res));
					}else
					{
						alert("No se encontro esa parada");
					}
				break;
				//El caso 2 es cuando la busqueda es secuencial
				case 2:
					//Mando a llamar la funcion 
					var res2 = sequentialSearch(parada,listanombre);
					//alert(res);
					if(res2!=-1)
					{
						alert("La parada se encuentra en la posición: "+ res2 +" de la lista");
						alert("La parada forma parte de las lineas: "+buscar(res2));
					}else
					{
						alert("No se encontro esa parada");
					}
				break;
				//Caso default
				default:
					alert("Algo anda mal");
				break;

			}
			
		}else
		{
			alert("Ingresa una parada valida");
		}
	}

/*	function binarySearch(value, list) {
	    var first = 0;    //Punto de la izquierda
	    var last = list.length - 1;   //Punto de la derecha
	    var position = -1;
	    var found = false;
	    var middle;
	    if (found === false && first <= last) {
	        middle = Math.floor((parseInt(first) + parseInt(last))/2);
	        //alert("Valor central: "+list[middle]);
	        //alert(list[middle].toLowerCase() +"   "+ value.toLowerCase());
	        if (list[middle].toLowerCase() == value.toLowerCase()) {
	            found = true;
	            position =  middle;
	        } else if (list[middle].toLowerCase() > value.toLowerCase()) {  //Si en la mitad baja
	        	last = middle - 1;
	        } else {  //Si no en la mitad alta
	            first = middle + 1;
	        }
	    }
	    return position;
	}
*/

	function busquedaBinariaRecursiva  (arreglo, busqueda, izquierda, derecha)  {
	    if (izquierda > derecha) return -1;
	    
	    let indiceDelElementoQueEstaEnLaMitad = Math.floor((derecha + izquierda) / 2);
	    let valorQueEstaEnLaMitad = arreglo[indiceDelElementoQueEstaEnLaMitad];
	    if (busqueda.toLowerCase() === valorQueEstaEnLaMitad.toLowerCase()) {
	        return indiceDelElementoQueEstaEnLaMitad;
	    } else {
	        if (busqueda.toLowerCase() > valorQueEstaEnLaMitad.toLowerCase()) {
	            izquierda = indiceDelElementoQueEstaEnLaMitad + 1
	            return busquedaBinariaRecursiva(arreglo, busqueda, izquierda, derecha);
	        } else {
	            
	            derecha = indiceDelElementoQueEstaEnLaMitad - 1
	            return busquedaBinariaRecursiva(arreglo, busqueda, izquierda, derecha);
	        }
	    }
	}

	function sequentialSearch(element, array){
	  for (var i in array){
	    if (array[i].toLowerCase() == element.toLowerCase()) return i; 
	  }
	  return -1;
	}	

	function buscar(posicion)
	{
		//Funcion para pasar variable de php a javascript
		var listalineas = "<?php echo implode(",",$arreglolineas);?> ";
		var listaparadas = "<?php echo implode(",",$arreglonombres);?> ";
		//Aqui separo ese string por las comas que se colocaron para ponerlo en un arreglo de javascript
		var lineas = listalineas.split(",");
		var listanombre = listaparadas.split(",");
		//variables para el ciclo
		var x=parseInt(posicion)+1;
		var z=parseInt(posicion)-1;
		var resultado = [lineas[posicion]];
		var y=1;
		//ciclo para buscar en el arreglo valores iguales
		while(listanombre[posicion]==listanombre[x]||listanombre[posicion]==listanombre[z])
		{
			//alert("Comparacion: "+ listanombre[posicion]+"=="+listanombre[x]+"||"+listanombre[posicion]+"=="+listanombre[z]);
			if(listanombre[posicion]==listanombre[x])
			{
				resultado[y]=lineas[x]
				x++;
			}else
			{
				resultado[y]=lineas[z]
				z--;
			}
			y++;
		}
		return resultado;
	}

	function fun()
	{



		var matriz =[[0,1,99,2,99,99,99,99,99,99,99,99,99,99,99,99,99,99],
					[1,0,2,2,99,99,7,99,99,99,99,99,99,99,99,99,99,99],
					[99,2,0,3,2,99,99,5,99,99,99,99,99,99,99,99,99,99],
					[2,2,3,0,2,99,99,99,99,3,99,99,99,99,99,99,99,99],
					[99,99,2,2,0,3,99,99,2,99,99,99,99,99,99,99,99,99],
					[99,99,99,99,3,0,99,99,99,3,99,99,99,99,99,99,99,99],
					[99,7,99,99,99,99,0,4,99,99,3,99,99,99,99,99,99,99],
					[99,99,5,99,99,99,4,0,3,99,99,2,99,99,99,99,99,99],
					[99,99,99,99,2,99,99,3,0,2,99,99,2,99,99,99,99,99],
					[99,99,99,3,99,3,99,99,2,0,99,99,99,4,3,99,99,99],
					[99,99,99,99,99,99,3,99,99,99,0,3,99,99,99,2,99,99],
					[99,99,99,99,99,99,99,2,99,99,3,0,2,99,99,3,99,99],
					[99,99,99,99,99,99,99,99,2,99,99,2,0,1,99,99,2,99],
					[99,99,99,99,99,99,99,99,99,4,99,99,1,0,2,99,99,4],
					[99,99,99,99,99,99,99,99,99,3,99,99,99,2,0,99,99,99],
					[99,99,99,99,99,99,99,99,99,99,2,3,99,99,99,0,3,99],
					[99,99,99,99,99,99,99,99,99,99,99,99,2,99,99,3,0,2],
					[99,99,99,99,99,99,99,99,99,99,99,99,99,4,99,99,2,0]
				   ]
	  	var matriz2=[[99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99],
				  	[99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99],
				  	[99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99],
				  	[99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99],
				  	[99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99],
				  	[99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99],
				  	[99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99],
				  	[99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99],
				  	[99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99],
				  	[99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99],
				  	[99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99],
				  	[99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99],
				  	[99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99],
				  	[99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99],
				  	[99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99],
				  	[99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99],
				  	[99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99],
				  	[99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99]
	  				]


	  	floy(matriz,matriz2);
	  	var x=0,y=0;
	  	var temp ="";
	  	var temp2="";
	  	/*while(x<matriz.length)
	  	{
	  		y=0;
	  		while(y<matriz.length)
	  		{
	  			temp += matriz[x][y]+"  ";
	  			temp2 +=matriz2[x][y]+"  ";	
	  			y++
	  		}
	  		x++;
	  		temp+="<br>";
	  		temp2+="<br>";
	  	}*/
	  	imprime(matriz);
	  	imprime(matriz2);
	  	imprime(flo.matrizM);
	  	imprime(flo.matrizT);

	  	floy(flo.matrizM,flo.matrizT);

	  	imprime(flo.matrizM);
	  	imprime(flo.matrizT);



		
		//$('#floy').append('<br>'+temp);
		//$('#floy').append('<br>---------------------------------------------------<br>');
		//$('#floy').append('<br>'+temp2);
	}

	function imprime(matriz)
	{
		var x=0;
	  	$('#floy').append('<br><br>Matriz<br>');
	  	while(x<matriz.length)	
	  	{
	  		y=0;
	  		$('#floy').append('<tbody>');
	  		$('#floy').append('<tr>');
	  		while(y<matriz.length)
	  		{
	  			$('#floy').append('<td>'+matriz[x][y]+'</td>');
	  			//temp += matriz[x][y]+"  ";s
	  			//temp2 +=matriz2[x][y]+"  ";	
	  			y++
	  		}
	  		$('#floy').append('</tr>');
	  		$('#floy').append('</tbody>');
	  		x++;
	  		//temp+="<br>";
	  		//temp2+="<br>";
	  	}
	}
	
</script>

	<div class="center">
		<h2>Calcular floy</h2>
		<div>Hola</div>
		<input type="button" name="floy" value="floy" onclick="fun();">
		<table class="tabla" id="floy">
			
		</table>
	</div>





<?php
	include("abajo.php");
?>