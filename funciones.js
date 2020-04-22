
class estacion
{
	idlinea;
	idestacion;
	nombre;
	tipo;
	estatus;
	puntos_de_interes;


	constructor()
	{
		
	}


	establecer(idl,ide,n,t,e,p)
	{
		this.idlinea=idl;
		this.idestacion=ide;
		this.nombre=n;
		this.tipo=t;
		this.estatus=e;
		this.puntos_de_interes=p;
	}

	set_idlinea(idl)
	{
		this.idlinea=idl;
	}
	set_idestacion(ide)
	{
		this.idestacion=ide;
	}
	set_nombre(n)
	{
		this.nombre=n;
	}
	set_tipo(t)
	{
		this.tipo=t;
	}
	set_estatus(e)
	{
		this.estatus=e;
	}
	set_puntos(p)
	{
		this.puntos_de_interes=p;
	}

	get_array()
	{
		
	}

}

class floyd
{
	array=[]
	arraycruces=[];
	arrayconexiones=[];
	matrizM=[];
	matrizT=[];

	constructor(array)
	{
		this.array=array;
	}

	calcular_matrizM_inicial()
	{
		var x=0;
		var temp=[];
		for(x=0;x<array.length;x++)
		{
			if(array[x].tipo==1)
			{
				this.arraycruces.unshift(array[x]);
				let llave=0;
				let y=0;
				while(y<temp.length)
				{
					if(temp[y].nombre!=array[x].nombre)
					{
						llave++;
					}
					y++;
				}
				if(llave==temp.length)
				{
					temp.unshift(array[x]);
				}
			}
		}
		this.arraycruces=this.arraycruces.reverse();
		temp=temp.reverse();
		this.arrayconexiones=temp;
		var z=0;
		//Ya tengo el arreglo con las paradas con cruce ahora vamos a calcular los cruces
		//Recorro el arreglo con las lineas de cruce
		for(x=0;x<temp.length;x++)
		{
			//saco las paradas que se llamen igual porque necesito los id para las conexiones
			//Guardo las paradas en este arreglo temporal
			var paradas=[];
			while(z<this.arraycruces.length&&this.arraycruces[z].nombre==temp[x].nombre)
			{
				paradas.unshift(this.arraycruces[z]);
				z++;
			}
			var y=0;
			var matriztemporal=[];
			//ciclo para recorrer otra vez el arreglo de conexiones para sacar los pesos de las conexiones
			for(y=0;y<temp.length;y++)
			{
				var h=0;
				var llave=0;
				//Verifico con las diferentes idlinea a los que pertenece la estacion con cruce
				while(h<paradas.length)
				{
					//Ciclo para conseguir el indice en el que se encuentra el valor con el que vamos a comparar 
					var conttemp=0;

					while(conttemp<this.arraycruces.length)
					{
						if(this.arraycruces[conttemp].nombre==temp[y].nombre)
						{
							conttemp=conttemp;
							break;
						}
						conttemp++;
					}
					//ciclo para validar las opciones con las que se va a comparar
					var paradas2=[];
					while(conttemp<this.arraycruces.length&&this.arraycruces[conttemp].nombre==temp[y].nombre)
					{
						paradas2.unshift(this.arraycruces[conttemp]);
						conttemp++;
					}

					conttemp=0;
					for(conttemp=0;conttemp<paradas2.length;conttemp++)
					{
						//alert("IDlinea temp: "+temp[y].idlinea);
						//alert("IDlinea parada: "+paradas[h].idlinea);
						//Si el id de linea de mi estacion de temp[x] comparte linea con alguno de los id de linea de la parada con la que estoy comparando
						if(paradas2[conttemp].idlinea==paradas[h].idlinea)
						{
							//una vez que sabemos que comparten linea ahora hay que verificar si hay estaciones en medio
							//En caso que hubiera una estacion en medio entonces no hay conexion directa
							//Primero vemos si el idestacion es el mismo
							if(paradas2[conttemp].idestacion==paradas[h].idestacion)
							{
								//Si es el mismo entonces el valor que se le asigna a la matriz es 0
								matriztemporal.unshift(0);
								h+=paradas2.length;
								llave++;
								break;
							//Si no es el mismo idestacion entonces hay que verificar si hay paradas en medio
							}else
							{
								//ciclo para verificar si hay paradas en medio de las dos estaciones que tenemos
								//temp[y] y paradas[h]
								var w=0;
								var llave2=0;
								var llave3=0;
								for(w=0;w<this.arraycruces.length;w++)
								{
									//Como vamos a comparar con la lista de cruces
									//Hay que verificar primero que esten en la misma linea que estamo buscando
									if(this.arraycruces[w].idlinea==paradas2[conttemp].idlinea)
									{
										llave3++;
										//variables en las que guardo los id de estacion para que sea mas facil la manipulacion
										var estacion1 = paradas2[conttemp].idestacion;
										var estacion2 = paradas[h].idestacion;
										//Verifico cual es mayor para hacer correctamente la comparacion del rango
										if(estacion1>estacion2)
										{
											//Realizo la comparacion con el idestacion del elemento actual de arraycruces
											//Con esto verifico si esta en medio de los dos idestacion
											if(this.arraycruces[w].idestacion<estacion1&&this.arraycruces[w].idestacion>estacion2)
											{
												//Aqui hago un break porque con una estacion que este en medio se le asigna
												//a la matriz entonces no vale la pena seguir comparando
												h+=paradas2.length;
												break;
											}else{
												//Le sumo valor a la llave
												//Si este valor al final de la comparacion es igual a la longitud del arreglo entonces
												//Significa que no hay estaciones de por medio
												llave2++;
											}
										//Mismo proceso que arriba nomas que cambian los signos en la comparacion del if
										}else
										{
											//Realizo la comparacion con el idestacion del elemento actual de arraycruces
											//Con esto verifico si esta en medio de los dos idestacion
											if(this.arraycruces[w].idestacion>estacion1&&this.arraycruces[w].idestacion<estacion2)
											{
												//Aqui hago un break porque con una estacion que este en medio ya no se le asigna
												//99 a la matriz entonces no vale la pena seguir comparando
												h+=paradas2.length;
												break;
											}else{
												//Le sumo valor a la llave
												//Si este valor al final de la comparacion es igual a la longitud del arreglo entonces
												//Significa que no hay estaciones de por medio
												llave2++;
											}
										}
									}
								}
								//Este if es para ver si hubo algun valor en medio de mis 2 valores
								if(llave2==llave3)
								{
									//variable de la resta
									var resta=0;
									//Para hacer la resta correctamente hay que agarrar el mayo y restarle el menor
									if(paradas[0].estatus==0&&paradas2[0].estatus==0)
									{
										if(estacion1>estacion2)
										{
											//realizo la resta
											resta = paradas2[conttemp].idestacion-paradas[h].idestacion;
											//la meto a mi arreglo temporal que es la fila #x de la matrizM
											matriztemporal.unshift(resta);
											h+=paradas2.length;
											llave++;
											break;
										}else{
											resta = paradas[h].idestacion-paradas2[conttemp].idestacion;
											matriztemporal.unshift(resta);
											llave++;
											h+=paradas2.length;
											break;
										}
									}else{
										matriztemporal.unshift(99);
										llave++;
										break;
									}	
								}else
								{
									matriztemporal.unshift(99);
									llave++;
									break;
								}
							}
							llave++;
						}
					}
					h++
				}
				if(llave==0)
				{
					//Si entra aqui es porque no comparaten linea por lo que no hay conexion directa
					matriztemporal.unshift(99);
				}
				
			}
			this.matrizM.unshift(matriztemporal.reverse());
		}
		this.matrizM=this.matrizM.reverse();
		this.calcular_matrizT_inicial();
	}

	calcular_matrizT_inicial()
	{
		var x=0;
		for(x=0;x<this.matrizM.length;x++)
		{ 
			let y=0;
			let temp =[];
			for(y=0;y<this.matrizM.length;y++)
			{
				temp.push(99);
			}
			this.matrizT.push(temp);
		}
		//alert(this.matrizT);
	}
}

function floy(array,array2)
	{
		var tamano = array.length;
		var x=0, y=0, z=0;
		while(x<tamano)
		{
			y=0;
			while(y<tamano)
			{
				z=0;
				while(z<tamano)
				{
					if(array[y][x]+array[x][z]<array[y][z])
					{
						array[y][z]=array[y][x]+array[x][z];
						array2[y][z]=x;
					}
					z++
				}
				y++;
			}
			x++;
		}
	}

//Esta es la función perrona
//aqui es donde se calculara todos los pasos a seguir
	var transbordostotal = 0;
	var tiempototal = 0;
	
function calcular_ruta(flo, origen, destino, arrayList)
{

	transbordostotal = 0;
	tiempototal = 0;
	//Esta variable es lo que vamos a regresar
	//Sera un string con los pasos a seguir
	var resultado="<h4>Origen: "+origen+"	<br>	Destino:"+destino+"</h4><br>";
	
	//Lo primero que tengo que hacer es obtener los datos de las paradas de origen y destino
	//Para obtener los datos usamos la busqueda binaria que me regresa los indices de donde se encuentra
	var indiceo = busquedaBinariaRecursiva  (arrayList.array, origen, 0, arrayList.array.length-1);
	//Esta funcion lo que hace es que revisa las posiciones cercanas 
	//y devuelve los objetos de todos los que tengan el mismo nombre
	var objetosorigen = buscar(arrayList.array, indiceo);
	var indiced = busquedaBinariaRecursiva  (arrayList.array, destino, 0, arrayList.array.length-1);
	var objetosdestino = buscar(arrayList.array, indiced);

	//si origen y destino son diferentes entonces hacemos el proceso de ruta
	if(origen!=destino)
	{
		//revisamos si estamos en la misma linea
		var linea = compartenlineas(objetosorigen,objetosdestino,1)
		if(linea)
		{
			//Ya sabemos que si estamos en la misma linea
			//Ahora necesitamos saber si hay alguna estacion de cruce entre origen y destino
			//Esto es necesario porque cuando no hay pues entonces hacemos una conexion directa
			var condicioncruce = nohaycruces(objetosorigen,objetosdestino,arrayList.array_list);
			if(condicioncruce)
			{
				//ESTE ES EL CASO 1
				//Esta condicion es porque la funcion "nohaycruce" regresa true o un objeto en caso de que 
				//el valor que se envio es de cruce pero es el más cercano
				if(condicioncruce===true)
				{
					//No hay cruce entre nosotros y estamos en la misa linea
					//camino directo
					var camino = caminodirecto(objetosorigen,objetosdestino,arrayList.array_list[linea-1]);
					//aqui ya tenemos el camino de origen a destino 
					//Ahora hay que pasar el camino a palabras
					 resultado += direcciones(camino,arrayList.array_list[linea-1],0,0,0);
				}else{
					//Aqui condicioncruce es un objeto 
					//Uno de nosotros es cruce pero es el más cercano
					//tenemos que ver cual es
					if(objetosorigen.length>1)
					{
						//camino desde nodo normal a nodo de cruce cercano
						var camino = caminodirecto(condicioncruce,objetosdestino,arrayList.array_list[linea-1]);
					}else{
						//camino desde nodo de cruce cercano a nodo normal
						var camino = caminodirecto(objetosorigen,condicioncruce,arrayList.array_list[linea-1]);
					}
					
					//aqui ya tenemos el camino de origen a destino 
					//Ahora hay que pasar el camino a palabras
					 resultado += direcciones(camino,arrayList.array_list[linea-1],0,0,0);
				}
				
			}else
			{
				//ESTE ES EL CASO 2
				//si hay estacion cruce entre nosotros y estamos en la misma linea
				//encontrar el nodo mas cercano 
				//mandar a llamar una funcion en la que usando la matriz de floyd y 2 puntos
					//te devuelva el camino mas corto usando la matriz T y la matriz M
				//obtengo el idestacion del nodo más cercano
				var nodo_mas_cercanoorigen = nodocercano(objetosorigen, arrayList.array_list[linea-1]);
				//obtengo el idestacion del nodo más cercano|	
				var nodo_mas_cercanodestino = nodocercano(objetosdestino, arrayList.array_list[linea-1]);
				//Condicion para verificar que el nodo más cercano esta habilitado
				if(nodo_mas_cercanoorigen&&nodo_mas_cercanodestino)
				{
					//una vez tengo los idestacion necesito los objetos en variables
					var cruce1 = arrayList.array_list[linea-1].get(nodo_mas_cercanoorigen);
					var cruce2 = arrayList.array_list[linea-1].get(nodo_mas_cercanodestino);
					if(cruce1 ==cruce2)
					{
						//Ese caso no es posible este if es solo para ver que todo este bien
						alert("Lo sentimos pero la estación de cruce más cercana esta deshabilitada");
					}else{
						//necesto calcular las matrizes M y T para seguir con el proceso
						var matrizm = flo.matrizM;
						var matrizt = flo.matrizT;
						floy(matrizm,matrizt);
						//una vez que ya tenemos la matriz de M hay que realizar el analisis recursivo de la matriz T
						//Una vez que ya tengo los 2 objetos en una lista ahora necesito saber sus posiciones dentro de la Matriz
						//Mando a llamar mi funcion que obtiene esos indices
						var indice1 = obtenerindicesmatriz(flo.arrayconexiones,cruce1);
						var indice2 = obtenerindicesmatriz(flo.arrayconexiones,cruce2);
						if(indice1!==false&&indice2!==false)
						{
							//Meto ambos valores a una linked list para el analisis recursivo
							var linked = new LinkedList();
							linked.add(indice1);
							linked.add(indice2);
							//Esta variable tipo mexa consta de un valor numerico y una linked list
							var mex = new mexa(linked);
							//Esta es la fucion que hace el analisis recursivo
							var res = analisis_floyd(matrizt,mex);
							//alert(res);
							resultado += caminocomplejo(res.get_linked(),objetosorigen,objetosdestino,flo.arrayconexiones,arrayList.array,arrayList.array_list);
						}else
						{
							alert("Lo sentimos pero la estación de cruce más cercana esta deshabilitada");
						}
					}
				}else{
					alert("Lo sentimos pero la estación de cruce más cercana esta deshabilitada");
				}
			}
		}else
		{
			//Este es el caso 3
			//No estamos en la misma linea
			//obtengo el idestacion del nodo más cercano
			var nodo_mas_cercanoorigen = nodocercano(objetosorigen, arrayList.array_list[objetosorigen[0].idlinea-1]);
			//obtengo el idestacion del nodo más cercano|	
			var nodo_mas_cercanodestino = nodocercano(objetosdestino, arrayList.array_list[objetosdestino[0].idlinea-1]);
			//una vez tengo los idestacion necesito los objetos en variables
			var cruce1 = arrayList.array_list[objetosorigen[0].idlinea-1].get(nodo_mas_cercanoorigen);
			var cruce2 = arrayList.array_list[objetosdestino[0].idlinea-1].get(nodo_mas_cercanodestino);
			if(cruce1.nombre ==cruce2.nombre)
			{
				//Este es el caso 4
				var indice0 = obtenerindicesmatriz(flo.arrayconexiones,cruce1);
				//Meto ambos valores a una linked list para el analisis recursivo
				var linkedtemp = new LinkedList();
				linkedtemp.add(indice0);
				resultado += caminocomplejo(linkedtemp,objetosorigen,objetosdestino,flo.arrayconexiones,arrayList.array,arrayList.array_list);
			}else{
				//necesto calcular las matrizes M y T para seguir con el proceso
				var matrizm = flo.matrizM;
				var matrizt = flo.matrizT;
				floy(matrizm,matrizt);
				//una vez que ya tenemos la matriz de M hay que realizar el analisis recursivo de la matriz T
				//Una vez que ya tengo los 2 objetos en una lista ahora necesito saber sus posiciones dentro de la Matriz
				//Mando a llamar mi funcion que obtiene esos indices
				var indice1 = obtenerindicesmatriz(flo.arrayconexiones,cruce1);
				var indice2 = obtenerindicesmatriz(flo.arrayconexiones,cruce2);
				if(indice1!==false&&indice2!==false)
				{
					//Meto ambos valores a una linked list para el analisis recursivo
					var linked = new LinkedList();
					linked.add(indice1);
					linked.add(indice2);
					//Esta variable tipo mexa consta de un valor numerico y una linked list
					var mex = new mexa(linked);
					//Esta es la fucion que hace el analisis recursivo
					var res = analisis_floyd(matrizt,mex);
					//alert(res);
					resultado += caminocomplejo(res.get_linked(),objetosorigen,objetosdestino,flo.arrayconexiones,arrayList.array,arrayList.array_list);
				}else
				{
					alert("Lo sentimos pero la estación de cruce más cercana esta deshabilitada");
				}
			}
		}
	}else{
		resultado="Has llegado a tu destino";
	}


	return resultado;
}

//funcion para obtener el camino complejo de 
function caminocomplejo(listamatriz,objetosorigen,objetosdestino,conexiones,arreglo,listaligada)
{
	//Lo primero que hare será calcular las lineas que estaran involucradas por cada parada de cruce
	//De esta forma podre manejar de mejor forma las conexiones
	var condicional=false;
	var arreglodelineas =[];
	if(objetosorigen.length==1)
	{
		//Agrego la primer linea
		arreglodelineas.push(objetosorigen[0]);
	}
	if(objetosdestino.length==1){
		condicional=true;
		//Esto lo tengo que usar al final para ver si al final tengo que agregar al arreglo de lineas
	}
	//aqui obtengo un arreglo con todos los objetos de lineas de cruce
	let x=0;
	for(x=0;x<listamatriz.size;x++)
	{
		arreglodelineas.push(conexiones[listamatriz.get(x)]);
	}
	//Esta condicion es para agregar el valor de destino al final
	if(condicional)
	{
		arreglodelineas.push(objetosdestino[0]);
	}

	//Para este punto solamente tengo un objeto por parada
	//Sin embargo yo necesito todos los objetos de cada parada
	//Esto es necesario para transbordar
	var arreglodeobjetos=[];
	x=0;
	for(x=0;x<arreglodelineas.length;x++)
	{
		var indiceo = busquedaBinariaRecursiva  (arreglo, arreglodelineas[x].nombre, 0, arreglo.length-1);
		var objetosorigen = buscar(arreglo, indiceo);
		arreglodeobjetos.push(objetosorigen);
	}
	
	//Ahora vamos a calcular la ruta correcta
	var ruta_correcta=[];
	x=0;
	//Ciclo para recorrer el arreglo
	for(x=0;x<arreglodeobjetos.length-1;x++)
	{
		let y=0;
		//Ciclo para recorrer los objetos de cada arreglo
		for(y=0;y<arreglodeobjetos[x].length;y++)
		{
			let w=0;
			//Ciclo para recorrer los objetos de una posicion más adelante
			for(w=0;w<arreglodeobjetos[x+1].length;w++)
			{
				//condicion para buscar la linea que tengan en comun 
				if(arreglodeobjetos[x][y].idlinea==arreglodeobjetos[x+1][w].idlinea)
				{
					//Condicion para ver si es la primera pasada
					//Si ese es el caso entonces se agrega directamente
					if(x!=0)
					{
						//Esta es condicional para ver si tienen el mismo nombre
						//Sirve para decidir si hay un transbordo
						if(ruta_correcta[ruta_correcta.length-1].nombre==arreglodeobjetos[x][y].nombre)
						{
							//Esta condicion compara la linea de dos estaciones con el mismo nombre
							//Si las estaciones son la misma entonces no es necesario agregar la primera
							//En caso contrario se deben agregar ambas a la lista ya que significa transbordo
							if(ruta_correcta[ruta_correcta.length-1].idlinea!=arreglodeobjetos[x][y].idlinea)
							{
								//Esto se ejecuta solo cuando SI hay transbordo
								ruta_correcta.push(arreglodeobjetos[x][y]);
								ruta_correcta.push(arreglodeobjetos[x+1][w]);
							}else{
								//Este caso es cuando no hay transbordo 
								ruta_correcta.push(arreglodeobjetos[x+1][w]);
							}
						}else{
							//Este caso solo se ejecuta cuando no hay transbordo
							ruta_correcta.push(arreglodeobjetos[x][y]);
							ruta_correcta.push(arreglodeobjetos[x+1][w]);
							
						}
						
					}else{
						//Esto solo se ejecuta la primera vez
						ruta_correcta.push(arreglodeobjetos[x][y]);
						ruta_correcta.push(arreglodeobjetos[x+1][w]);
						
					}
				}
			}
		}
	}
	//AQUI ya tenemos un arreglo con todos los conjuntos de caminos que hay que tomar
	//Aqui ya podemos trabajar con pares dentro del arreglo para imprimir la ruta
	//Hay que hacer un ciclo que recorra todo el arreglo y lo mande a una función que me regrese el texto que necesito 
	var resultado="";

	/*//Aqui verifico cual es la linea que comparte la estacion 0 con la 1
	var lineacompartida = compartenlineas([ruta_correcta[0]], [ruta_correcta[1]], 1)
	//Aqui trazo el camino de 0 a 1
	var camino = caminodirecto([ruta_correcta[0]],[ruta_correcta[1]],listaligada[lineacompartida-1]);
	//Aqui transformo ese camino en texto
	resultado += direcciones(camino,listaligada[lineacompartida-1],0,1,0);*/

	//El proceso que acabamos de hacer tiene que repetirse para cada par en el arreglo
	x=0;
	for(x=0;x<ruta_correcta.length-1;x++)
	{
		var inicio=1;
		if(x==0)
		{
			inicio =0;
		}


		var orig=x;
		var dest=x+1
		
		while(dest<ruta_correcta.length&&compartenlineas([ruta_correcta[orig]], [ruta_correcta[dest]], 1))
		{
			dest++;
			x++;
		}
		if(dest!=orig+1)
		{
			dest--;
			x--;
		}
		//Verifico cual es la linea compartida
		lineacompartida = compartenlineas([ruta_correcta[orig]], [ruta_correcta[dest]], 1)
		//Esta validacion existe porque si no comparten linea significa que hay un transbordo
		if(lineacompartida)
		{
			//Calculo el camino de punto A a punto B
			camino = caminodirecto([ruta_correcta[orig]],[ruta_correcta[dest]],listaligada[lineacompartida-1]);
			//Condicion para saber si ya acabe
			if(x==ruta_correcta.length-2)
			{
				//Transformo las direcciones a texto
				resultado += direcciones(camino,listaligada[lineacompartida-1],inicio,0,0);
			}else{
				//Transformo las direcciones a texto
				resultado += direcciones(camino,listaligada[lineacompartida-1],inicio,1,0);
			}
		}else{
			//Este escenario es para un transbordo
			//Creo una lista ligada temporal para enviarla a transformarse en texto
			var temp = new LinkedList();
			//Agrego los valores
			temp.add(ruta_correcta[x]);
			temp.add(ruta_correcta[x+1]);
			//Esto de aqui es para calcular la direccion
			var direccion0 = ruta_correcta[x+1].idestacion;
			var direccion1 = ruta_correcta[x+2].idestacion;
			var lineacomun = ruta_correcta[x+1].idlinea;
			var direccion2 =null;
			if(direccion0<direccion1)
			{
				direccion2 = listaligada[lineacomun-1].get(listaligada[lineacomun-1].size-1);
			}else{
				direccion2 = listaligada[lineacomun-1].get(0);
			}
			
			resultado += direcciones(temp,direccion2,inicio,1,1);
		}
	}


	return resultado;
	//alert("Yo mero caguamero");
}

//funcion para revisar las 2 listas de objetos y ver si compraten linea
function compartenlineas(lista1, lista2, tipo)
{
	var x=0,y=0;
	for(x=0;x<lista1.length;x++)
	{
		for(y=0;y<lista2.length;y++)
		{
			if(lista1[x].idlinea==lista2[y].idlinea)
			{
				if(tipo==1)
				{
					return lista1[x].idlinea;
				}else{
					return true;
				}
			}
		}
	}
	return false;
}

//funcion para ver si hay nodos de cruce entre dos estaciones
function nohaycruces(lista1,lista2,arrayList)
{
	var res = false;
	if(lista1.length==1&&lista2.length==1)
	{
		var linea = lista1[0].idlinea;
		var estacion1 = lista1[0].idestacion;
		var estacion2 = lista2[0].idestacion;
		var cont=0;
		var pequeño=0;
		var grande=0;
		//Necesitamos saber cual es el mas pequeño para las comparaciones de más adelante
		if(estacion1>estacion2)
		{
			//asignamos el más pequeño y el más grande a una variable
			pequeño=estacion2;
			grande=estacion1;
		}else
		{
			pequeño=estacion1;
			grande=estacion2;
		}

		//hay que recorrer el array list para ver si hay nodos de cruce entre nosotros
		for(cont=pequeño+1;cont<grande-1;cont++)
			{
				let objetotemporal =arrayList[linea-1].get(cont);
				if(objetotemporal.tipo==1)
				{
					return false;
				}
			}
			//Si llego a este punto es porque ya recorrio todos los nodos desde destino a origen 
			//y no encontro ninguna estacion de cruce
			return true;
	}else{
		//Este codigo sera para los casos en el que el nodo que estamos evaluando es una estacion de cruce
		var lineacompartida = compartenlineas(lista1, lista2, 1);
		if(lineacompartida)
		{
			//Esta condicion es para saber cual de las dos listas es la que es de cruce
			//Las listas tienen los objetos de las diferentes lineas
			//Entonces una lista si su tamaño es mayor a uno forma parte de varias lineas
			//las unicas estaciones que forman parte de diferentes lineas son las de cruce
			let key = false;
			var tam =0;
			if(lista1.length>1)
			{
				tam = lista1.length;
				key=true;
			}else{
				tam = lista2.length;
			}
			
			//Una vez que tengo identificada la linea busco en la lista el objeto para regresarlo
			let a=0;
			let objetotemporal = [];
			//Ciclo para recorrer la lista
			for(a=0;a<tam;a++)
			{
				//Condicion para saber con cual de las 2 lineas comparar
				if(key)
				{
					//Condicion para buscar el objeto que sea de la linea que necesitamos
					if(lista1[a].idlinea==lista2[0].idlinea)
					{
						//Regreso el objeto
						objetotemporal[0] = lista1[a];
						//calclo el indice del nodo de cruce mas cercano con la que no es nodo de cruce
						let nodocer = nodocercano(lista2,arrayList[lineacompartida-1]);
						//Obtengo el objeto y lo guardo en la siguiente variable
						var cruce1 = arrayList[lineacompartida-1].get(nodocer);
						//Se el nodo de cruce que yo obtuve y el nodo de cruce más cercano son iguales entonces regreo el objeto
						//Si no regreso un falso
						if(objetotemporal[0].nombre==cruce1.nombre)
						{
							return objetotemporal;
						}else{
							return false;
						}
					}
				}else{
					//Condicion para buscar el objeto que sea de la linea que necesitamos
					if(lista2[a].idlinea==lista1[0].idlinea)
					{
						//Regreso el objeto
						objetotemporal[0] = lista2[a];
						//calclo el indice del nodo de cruce mas cercano con la que no es nodo de cruce
						let nodocer = nodocercano(lista1,arrayList[lineacompartida-1]);
						//Obtengo el objeto y lo guardo en la siguiente variable
						var cruce1 = arrayList[lineacompartida-1].get(nodocer);
						//Se el nodo de cruce que yo obtuve y el nodo de cruce más cercano son iguales entonces regreo el objeto
						//Si no regreso un falso	
						if(objetotemporal[0].nombre==cruce1.nombre)
						{
							return objetotemporal;
						}else{
							return false;
						}
					}
				}
			}
		}
	}

	return false;
}

//funcion que calcula el camino directo de un punto a otro pero sin usar floyd
function caminodirecto(lista1, lista2, listaligada)
{
	var lista_resultado = new LinkedList();
	if(lista1.length==1&&lista2.length==1)
	{
		var linea = lista1[0].idlinea;
		var estacion1 = lista1[0].idestacion;
		var estacion2 = lista2[0].idestacion;
		lista_resultado.add(lista1[0]);
		var operacion;
		if(estacion1>estacion2)
		{
			operacion=1;
		}else{
			operacion=0;
		}

		do
		{
			if(operacion==1)
			{
				estacion1--;
			}else{
				estacion1++;
			}
			if(listaligada.get(estacion1).idestacion!=estacion2)
			{
				lista_resultado.add(listaligada.get(estacion1));
			}else{
				lista_resultado.add(listaligada.get(estacion2));
				return lista_resultado;
			}
			
		}while(estacion1!=estacion2);
	}else
	{
		//Este caso sera para los casos en el que el nodo que estamos evaluando es una estacion de cruce
		var lineacompartida = compartenlineas(lista1, lista2, 1);
		if(lineacompartida)
		{
			//Existen 2 casos
			//Que ambos puntos sean estacion de cruce
			if(lista1.length>1&&lista2.length>1)
			{
				//si ambos son nodos de cruce entonces necesito los 2 objetos que compartan linea
				let a=0;
				//realizamos 2 ciclos para recorrer las listas en busca de la linea que tengan en comun
				for(a=0;a<lista1.length;a++)
				{
					let b=0;
					for(b=0;b<lista2.length;b++)
					{
						if(lista1[a].idlinea==lista2[b].idlinea)
						{
							var envio1=[lista1[a]];
							var envio2=[lista2[b]];
							caminodirecto(envio1, envio2, listaligada)

						}
					}
				}
			}else
			{
				//El segundo caso es que solo 1 de los dos sea estacion de cruce
				let a=0;
				//realizamos 1 ciclo para recorrer la lista en busca de la linea que tengan en comun
				for(a=0;a<lista1.length;a++)
				{
					let b=0;
					for(b=0;b<lista2.length;b++)
					{
						if(lista1[a].idlinea==lista2[b].idlinea)
						{
							var envio1=[lista1[a]];
							var envio2=[lista2[b]];
							//Aqui tenemos un poco de recursividad ya que ahora volvemos a enviar los valores a la funcion 
							//pero ahora solo enviamos el valor de la linea por lo que deberia regresar la lista entre esos 2 puntos
							caminodirecto(envio1, envio2, listaligada)

						}
					}
				}
			}
		}
		//alert("Aqui iria el codigo para cuando alguno de los puntos es esacion de cruce");
	}
	return lista_resultado;
}

function direcciones(List, arrayList,tipo,tipo2,tipo3)
{
	//Las variables "tipo" sirven para controlar que imprimir
	//INICIO PASOS FIN
	//Tipo  tipo2  tipo3
	var res = "";
	if(tipo==0||tipo2==0||tipo3==0)
	{
		//CASO 1
		//Te subes a la linea del nodo1 en la estacion nodo1 en direccion final o inicio de la linea
		//Pasas por las paradas .....
		//En esta parada los puntos de interes son:
		//Bajar en el ultimo nodo
		//Has llegado a tu destino
		var direccion =null;
		if(List.get(0).idestacion>List.get_last().idestacion)
		{
			direccion=arrayList.get(0).nombre;
		}else{
			direccion=arrayList.get_last().nombre;
		}
		//Condicion para obtener el inicio
		if(tipo==0)
		{
			//Ingreso el primer nodo
			tiempototal+=2;
			res="<br>-Te subes a la linea "+List.get(0).idlinea+" en la estacion "+List.get(0).nombre+" con direccion "+ direccion +"<br>";
			//Si tienen puntos de interes los muestro abajo
			if(List.get(0).puntos_de_interes!="")
			{
				res+="<ul><li> Puntos de interes: "+List.get(0).puntos_de_interes+"</li></ul>";
			}
			res+="<br><br>Pasas por las estaciones: <ul>";
		}
		
		//Ciclo para revisar las paradas
		var cont =1;
		
		while(List.get(cont)!=null)
		{
			//If para revisar si llegaste al ultimo de nodo
			if(List.get(cont+1)==null)
			{
				//Condicion para obtener el final
				if(tipo2==0)
				{
					tiempototal++;
					//Agrego al string donde debes bajasrte
					res+="</ul><br><br> Y te bajas en la estacion "+List.get_last().nombre;
					if(List.get_last().puntos_de_interes!="")
					{
						res+="<ul><li> Puntos de interes: "+List.get_last().puntos_de_interes+"</li></ul>";
					}
					res+="<br>Has llegado a tu destino";
					res+="<br><br>Numero de transbordos: "+transbordostotal;
					res+="<br>Tiempo Estimado: "+tiempototal+ "min";
					res+="</ul>"
				}
			}else{
				if(tipo3==0)
				{
					tiempototal++;
					//Si no es el punto final entonces agregamos el nodo
					var temp =List.get(cont);
					res+="<br><li>"+temp.nombre;
					var puntosdi = temp.puntos_de_interes;
					//Si existen puntos de interes los pongo en el string
					if(puntosdi!="")
					{
						res+="<br><ul><li>Con los puntos de interes: "+puntosdi+"</li></ul>";
					}
					res+="</li>";
				}
			}
			
			cont++;
		}
	}else
	{
		res+="<br><li>";
		res+= "Llegas a "+List.get(0).nombre;
		var puntosdi = List.get(0).puntos_de_interes;
		//Si existen puntos de interes los pongo en el string
		if(puntosdi!="")
		{
			res+="<br><ul><li>Con los puntos de interes: "+puntosdi+"</li></ul>";
		}
		res+="<br><li>Y te bajas de la linea "+List.get(0).idlinea+" y te subes a la linea "+List.get(1).idlinea+" con direccion "+ arrayList.nombre +"</li><br>";
		res+="</li>";
		res+="A continuación: ";
		tiempototal+=4;
		transbordostotal++;
	}
	return res;
}

//Funcion para encontrar el nodo de cruce mas cercano
function  nodocercano(lista1,linked)
{
	//Necesito saber si es una estacion de cruce
	//Si el tamaño de la lista es mayor a 1 entonces el nodo es un nodo de cruce
	if(lista1.length==1)
	{
		//guardo el objeto para facil manipulacion
		var estacion = lista1[0];
		//guardo el valor de la estacion para usarlo como contador
		var cont = estacion.idestacion;


		var cont2 = cont-1;
		cont++;
		//ciclo para empezar en la estacion a buscar y de ahi buscar adelante y atras
		while(cont2>=0||cont<=linked.get_last().idestacion)
		{
			if(cont<=linked.get_last().idestacion&&linked.get(cont).tipo==1)
			{
				if(linked.get(cont).estatus==1)
				{
					return false;
				}else{
					//Regreso el indice en el que se encuentra cuando se busco para adelante
					return cont;
				}
			}else if(cont2>0 && linked.get(cont2).tipo==1)
			{
				if(linked.get(cont2).estatus==1)
				{
					return false;
				}else{
					//Regreso el indice en el que se encuentra cuando se busco para atras
					return cont2;
				}
			}else{
				cont++;
				cont2--;
			}
			//aqui me quede 27/02/2020
		}
	}else
	{
		//Esta seccion para cuando ya estamos en un punto de cruce entonce smplente hay que buscar la linea que coincide y
		//regresar el id de estacion
		let a =0;
		for(a=0;a<lista1.length;a++)
		{
			if(lista1[a].idlinea==linked.get(0).idlinea&&lista1[a].estatus!=1)
			{
				return lista1[a].idestacion;
			}
		}
		return false;
	}
	return false;
}




function busquedaBinariaRecursiva  (arreglo, busqueda, izquierda, derecha)  {
    if (izquierda > derecha) return -1;
    
    let indiceDelElementoQueEstaEnLaMitad = Math.floor((derecha + izquierda) / 2);
    let valorQueEstaEnLaMitad = arreglo[indiceDelElementoQueEstaEnLaMitad].nombre;
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

//funcion para obtener una lista de los objetos de una parada
function buscar( array, posicion)
	{
		//variables para el ciclo
		var x=parseInt(posicion)+1;
		var z=parseInt(posicion)-1;
		var resultado = [array[posicion]];
		var y=1;
		//ciclo para buscar en el arreglo valores iguales
		while(x<array.length&&array[posicion].nombre==array[x].nombre)
		{
			//alert("Comparacion: "+ listanombre[posicion]+"=="+listanombre[x]+"||"+listanombre[posicion]+"=="+listanombre[z]);
			if(array[posicion].nombre==array[x].nombre)
			{
				resultado[y]=array[x]
				x++;
			}else
			{
				break;
			}
			y++;
		}
		while(z>=0&&array[posicion].nombre==array[z].nombre)
		{
			//alert("Comparacion: "+ listanombre[posicion]+"=="+listanombre[x]+"||"+listanombre[posicion]+"=="+listanombre[z]);
			if(array[posicion].nombre==array[z].nombre)
			{
				resultado[y]=array[z]
				z--;
			}else
			{
				break;
			}
			y++;
		}

		return resultado;
	}

//funcion para obtener los indices de una matriz
function obtenerindicesmatriz(array, valor)
{
	let x=0;
	for(x=0;x<array.length;x++)
	{
		if(array[x].nombre==valor.nombre)
		{
			return x;
		}
	}
	return false;
}





//Esta es la funcion de analisis recursivo de la matris de floyd
function analisis_floyd(matrizt, mex)
{
	//aqui es una funcion recursiva para regresar una lista con los nodos a visitar en mi objeto
	//seteo el valor que esta en el cruce de las dos posiciones de la linked list que viene dentro de mex
	//este valor se obtiene de la matrizT[origen][destino] 
	mex.set_valor(matrizt[mex.get_linked().get(0)][mex.get_linked().get(1)]);
	//Condicion base si la distancia entre origen y destino es 99 osea conexion directa
	if(mex.get_valor()==99)
	{
		mex.set_valor("");
		return mex;
	}else
	{
	//En caso que la condicion fuera falso entonces no es conexion directa entre los puntos que se estan evaluando
		//Aqui le agrego el nuevo valor a la linked list
		mex.linked.insertAt(mex.valor,1)
		var tam = mex.linked.size;

		//EJ: 6->13->8      SECCION1 = 6->13        SECION2 = 13->8

		//SECCION1
		//Esta es una variable temporal para generar una linked list temporal
		var temp = new LinkedList();
		temp.add(mex.get_linked().get(0));
		//Aqui le agrego el segundo valor a la linked list temporal
		temp.add(mex.get_linked().get(1));
		//Aqui defino un objeto de tipo mexa y le inserto la linked list temporal
		var mex1 = new mexa(temp);
		//Aqui hago la recursividad
		var analisis = analisis_floyd(matrizt,mex1);
		//Reviso si existen mas de 3 valores
		//Esto debido a que se debe hacer un proceso diferente si solamente se va a agregar un valor
		if(analisis.get_linked().size>3)
		{ 
			//EJ	 13->12
			//EJ     13->2->3->11->12
			//Variables temporales para este proceso
			let valtemp;
			let key = false;
			//la variable mex es donde tengo mi comparativa actual y analisis es el resultado arrojado 
			//Esta como es la seccion 1 el valor que falta sera el ultimo ya que aqui estoy comparando la primer mitad siempre
			if(mex.get_linked().get(0)==analisis.get_linked().get(0))
			{
				//valtemp es el valor que faltara de agregar
				valtemp = mex.get_linked().get(mex.get_linked().size-1);
				key=true;
			}else{
				//Este caso en teoria nunca deberia pasar pero de momento ahi esta para respetar la logica
				valtemp = mex.get_linked().get(0);
			}
			//Aqui le asigno la nueva linked list 
			mex.set_linked(analisis.get_linked());

			//Esta condicion se basa en la anterior entonces en teoria la segunda opcion no deberia pasar nunca en la seccion 1
			if(key)
			{
				mex.get_linked().add(valtemp);
			}else{
				mex.get_linked().insertAt(valtemp,0);
			}
		}else{
			//Este es para el caso normal en el que solo se agrega un valor
			//EJ	 13->12
			//EJ     13->2->12
			mex.linked.insertAt(analisis.valor,1);
		}
		//vuelvo a llamar la funcion pero el destino es el valor que se encuentra en el cruce de origen y destino actual
		

		var pos = mex.get_linked().size-1;
	




		//SECCION2 
		//Esto es lo mismo que la parte de arriba pero con la segunda mitad
		var temp2 = new LinkedList();
		temp2.add(mex.get_linked().get(pos-1));
		temp2.add(mex.get_linked().get(pos));
		var mex2 = new mexa(temp2);
		var analisis2 = analisis_floyd(matrizt,mex2);
		if(analisis2.get_linked().size>3)
		{ 
			let key = false;
			let key2 = false;
			var listatemporal = [];
			let valtemp;
			if(mex.get_linked().size>1)
			{
				let x=0;
				while(mex.get_linked().get(x)!=analisis2.get_linked().get(0))
				{
					listatemporal.push(mex.get_linked().get(x));
					x++;
				}
				key=true;
				key2=true;
			}else{
				
				if(mex.get_linked().get(mex.get_linked().size-1)==analisis2.get_linked().get(analisis2.get_linked().size-1))
				{
					valtemp = mex.get_linked().get(0);
					key=true;
				}else{
					valtemp = mex.get_linked().get(mex.get_linked().size-1);
				}
			}
			
			mex.set_linked(analisis2.get_linked());
			if(key)
			{
				if(key2)
				{
					while(listatemporal.length>0)
					{
						mex.get_linked().insertAt(listatemporal.pop(),0);
					}
				}else{
					mex.get_linked().insertAt(valtemp,0);
				}
			}else{
				mex.get_linked().add(valtemp);
			}
		}else{
			//Este es para el caso normal en el que solo se agrega un valor
			//EJ	 13->12
			//EJ     13->2->12
			mex.linked.insertAt(analisis2.valor,pos);
		}
		return mex;
	}
	

}

//Esta clase es para guardar una linked list y un valo, es utilizada en la funcion recursiva de analisis:floyd
class mexa
{
	valor=null;
	linked=null;

	constructor(l)
	{
		this.linked=l;
	}

	set_valor(v)
	{
		this.valor=v;
	}
	get_valor()
	{
		return this.valor;
	}
	set_linked(l)
	{
		this.linked=l;
	}
	get_linked()
	{
		return this.linked;
	}
}