<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="estilos.css">
	<script type="text/javascript" src="jquery-3.4.1.min.js"></script>
	<script type="text/javascript">
		function fun(val,val2)
		{
			var num1 = $("#txt-num"+val).val();
			var num2 = $("#txt-num"+val+"-2").val();
			if(num1!=""&&num2!="")
			{
				if(!isNaN(num1)&&!isNaN(num2))
				{
					switch(val2)
					{
						case 1:
							if(num1.length==num2.length)
							{
								if(num1%1 == 0 && num2%1 == 0 )
								{
									var pila1=Array.from(num1);
									var pila2=Array.from(num2);
									alert(num1+" + \n"+num2+"\n ------------ \n"+sumar(pila1,pila2));
								}else
								{
									alert("Ambos numeros deben ser enteros");
								}
							}else
							{
								alert("Para el caso 1 ambos numeros deben ser del mismo tamaño");
							}
						break;
						case 2:
							if(num1%1 == 0 && num2%1 == 0 )
							{
								var pila1=Array.from(num1);
								var pila2=Array.from(num2);
								alert(num1+" + "+num2+" = "+sumar2(pila1,pila2,0));
							}else
							{
								alert("Ambos numeros deben ser enteros");
							}
						break;
						case 3:
							if(num1.includes("."))
							{
								var temp1 = num1.split(".");
							}else
							{
								var temp1 = [num1,0]
							}
							if(num2.includes("."))
							{
								var temp2 = num2.split(".");
							}else
							{
								var temp2 =[num2,0]
							}
							var pila1=Array.from(temp1[0]);
							var pila2=Array.from(temp1[1]);
							var pila3=Array.from(temp2[0]);
							var pila4=Array.from(temp2[1]);
							alert(num1+" + "+num2+" = "+sumar3(pila1,pila2,pila3,pila4));
						break;
						case 4:
							genera_tabla(num1,num2);
						break;
						default:
							alert("Algo anda mal");
						break;
					}
				}else
				{
					alert("Debes ingresar un valor numerico");
				}
			}else
			{
				alert("Debes llenar ambos campos");
			}

			//Funcion de sumas para el primer caso
			function sumar(pila1,pila2)
			{
				//variables necesarias para la funcion
				var acarreo=0;
				var temp=0;
				var pila3=[];
				//alert("Pila1: "+pila1+"\nPila2: "+pila2);
				//mientras que la pila uno no este vacia se repite el proceso
				while(pila1.length>0)
				{
					//realizo la suma de los primeros 2 numeros mas el acarreo 
					temp=parseInt(pila1.pop())+parseInt(pila2.pop())+parseInt(acarreo);
					//alert("Temp: "+temp);
					//si el valor es mayor a diez se le quita el sobrante y se pasa como acarreo
					//para la siguiente iteracion
					if(temp>=10)
					{
						pila3.push(temp-10);
						acarreo=1;
						//alert("Pila3: "+pila3);
					//en caso que el resultado no sea mayor a 10 solo se le pasa el resultado y el acarreo se regresa a 0
					}else
					{
						pila3.push(temp);
						acarreo=0;
						//alert("Pila3: "+pila3);
					}
				}
				if(acarreo!=0)
				{
					pila3.push(acarreo);
				}
				//Esto es un plus a la funcion para regresar la pila ya acomodada en el orden que deb ser 
				var res=[];
				var x=0;
				var y=pila3.length;
				//estoy invirtiendo el orden de la pila al pasarla a otra pila
				while(x<=y)
				{
					res.push(pila3.pop());
					x++;
				}
				//devuelvo un string como resultado
				return res.toString().replace(/,/g, '');
			}

			//Funcion de sumas para el primer caso
			function sumar2(pila1,pila2,acarreo)
			{
				//variables necesarias para la funcion
				var temp=0;
				var pila3=[];
				//alert("Pila1: "+pila1+"\nPila2: "+pila2);
				//mientras que alguna pila no este vacia se repite el proceso
				while(pila1.length>0||pila2.length>0)
				{
					//En caso que la pila 1 este vacia y la pila 2 tenga datos
					if(!pila1.length>0&&pila2.length>0)
					{
						//le meto directo los datos de la pila llena mas el acarreo que traiga
						temp = parseInt(pila2.pop())+parseInt(acarreo);
						//si el resultado es mayor a 10 entonces le quito el sobrante y el acarreo se vuelve 1
						if(temp>=10)
						{
							pila3.push(temp-10);
							acarreo=1;
						//en caso contrario solo paso el valor y el acarreo se vuelve 0
						}else
						{
							pila3.push(temp);
							acarreo=0;
						}
					//Para el caso en el que la pila 2 este vacia y la 1 llena
					//El proceso es el mismo que arriba
					}else if(!pila2.length>0&&pila1.length>0)
					{
						temp = parseInt(pila1.pop())+parseInt(acarreo);
						if(temp>=10)
						{
							pila3.push(temp-10);
							acarreo=1;
						}else
						{
							pila3.push(temp);
							acarreo=0;
						}
					//para el caso normal
					}else
					{
						//realizo la suma de los primeros 2 numeros mas el acarreo 
						temp=parseInt(pila1.pop())+parseInt(pila2.pop())+parseInt(acarreo);
						//alert("Temp: "+temp);
						//si el valor es mayor a diez se le quita el sobrante y se pasa como acarreo
						//para la siguiente iteracion
						if(temp>=10)
						{
							pila3.push(temp-10);
							acarreo=1;
							//alert("Pila3: "+pila3);
						//en caso que el resultado no sea mayor a 10 solo se le pasa el resultado y el acarreo se regresa a 0
						}else
						{
							pila3.push(temp);
							acarreo=0;
							//alert("Pila3: "+pila3);
						}
					}
				}
				if(acarreo!=0)
				{
					pila3.push(acarreo);
				}
				//Esto es un plus a la funcion para regresar la pila ya acomodada en el orden que deb ser 
				var res=[];
				var x=0;
				var y=pila3.length;
				//estoy invirtiendo el orden de la pila al pasarla a otra pila
				while(x<=y)
				{
					res.push(pila3.pop());
					x++;
				}
				//devuelvo un string como resultado
				return res.toString().replace(/,/g, '');
			}


			function sumar3(pila1,pila2,pila3,pila4)
			{
				var res =[];
				var acarreo=0;
				while(pila2.length>0||pila4.length>0)
				{
					if(pila2.length>pila4.length)
					{
						res.push(pila2.pop());
					}else if(pila2.length<pila4.length)
					{
						res.push(pila4.pop());
					}else
					{
						temp=parseInt(pila2.pop())+parseInt(pila4.pop())+parseInt(acarreo);
						//alert("Temp: "+temp);
						//si el valor es mayor a diez se le quita el sobrante y se pasa como acarreo
						//para la siguiente iteracion
						if(temp>=10)
						{
							res.push(temp-10);
							acarreo=1;
							//alert("Pila3: "+pila3);
						//en caso que el resultado no sea mayor a 10 solo se le pasa el resultado y el acarreo se regresa a 0
						}else
						{
							res.push(temp);
							acarreo=0;
							//alert("Pila3: "+pila3);
						}
					}
				}
				//Esto es un plus a la funcion para regresar la pila ya acomodada en el orden que deb ser 
				var res2=[];
				var x=0;
				var y=res.length;
				//estoy invirtiendo el orden de la pila al pasarla a otra pila
				while(x<=y)
				{
					res2.push(res.pop());
					x++;
				}


				return sumar2(pila1,pila3,acarreo)+"."+res2.toString().replace(/,/g, '');
			}
		}

		var filas_t=0;
		var columnas_t=0;
		var entrada =0;
		var salida=0;
		function genera_tabla(filas,columnas) {
			entrada=0;
			salida=0;

			filas_t=filas;
			columnas_t=columnas;
		  // Obtener la referencia del elemento body
		  //var body = document.getElementsByTagName("body")[0];
		  	var padre = document.getElementById('padre');
	 		var aqui = document.createElement("div"); 
	 		 aqui.id = 'tabla';

		  // Crea un elemento <table> y un elemento <tbody>
		  var tabla   = document.createElement("table");
		  var tblBody = document.createElement("tbody");
		 
		  // Crea las celdas
		  for (var i = 0; i < filas; i++) {
		    // Crea las hileras de la tabla
		    var hilera = document.createElement("tr");
		 
		    for (var j = 0; j < columnas; j++) {
		      // Crea un elemento <td> y un nodo de texto, haz que el nodo de
		      // texto sea el contenido de <td>, ubica el elemento <td> al final
		      // de la hilera de la tabla
		      var celda = document.createElement("td");
		      var a = document.createElement("a");
		      var input = document.createElement("input");
		      if(i==0)
		      {
				//var textoCelda = document.createTextNode("1");
				input.setAttribute('value',"1");
				input.setAttribute('class', "borde");
				input.setAttribute('onclick', "cambiar(this,3);");
		      }else if(i==filas-1)
		      {
		      	//var textoCelda = document.createTextNode("1");
		      	input.setAttribute('value',"1");
		      	input.setAttribute('class', "borde");
		      	input.setAttribute('onclick', "cambiar(this,3);");
		      }else if(j==0)
		      {
		      	//var textoCelda = document.createTextNode("1");
		      	input.setAttribute('value',"1");
		      	input.setAttribute('class', "borde");
		      	input.setAttribute('onclick', "cambiar(this,3);");
		      }else if(j==columnas-1)
		      {
		      	//var textoCelda = document.createTextNode("1");
		      	input.setAttribute('value',"1");
		      	input.setAttribute('class', "borde");
		      	input.setAttribute('onclick', "cambiar(this,3);");
		      }else{
		      	//var textoCelda = document.createTextNode("0");
		      	input.setAttribute('value',"0");
		      	input.setAttribute('onclick', "cambiar(this,1);");
		      }
		      //input.setAttribute('value',"0");
		      //input.appendChild(textoCelda);
		      //input.setAttribute('disabled', "disabled");
		      a.appendChild(input);
		      input.id=i+"."+j;
		      input.setAttribute('ondblclick', "cambiar(this,2);");
		      celda.appendChild(a);
		      //celda.setAttribute('id', i+"."+j);
		      //celda.onclick = "cambiar()";
		      hilera.appendChild(celda);
		    }
		 
		    // agrega la hilera al final de la tabla (al final del elemento tblbody)
		    tblBody.appendChild(hilera);
		  }
		 
		  // posiciona el <tbody> debajo del elemento <table>
		  tabla.appendChild(tblBody);
		  // appends <table> into <body>
		  aqui.appendChild(tabla);
		  padre.appendChild(aqui);
		  // modifica el atributo "border" de la tabla y lo fija a "2";
		  tabla.setAttribute("border", "0");
		  //En esta parte lo que realizo son los seteos de los botones para no generar mas tablas
		  document.getElementById("btn-borrar").setAttribute('enabled', "enabled");
		  document.getElementById("btn-borrar").removeAttribute("disabled"); 
		  document.getElementById("btn-tabla").setAttribute('disabled', "disabled");
		  document.getElementById("btn-tabla").removeAttribute("enabled"); 
		  document.getElementById("btn-calcular").removeAttribute("disabled");
		  document.getElementById("btn-calcular").setAttribute('enabled', "enabled");  
		  document.getElementById("btn-calcularoptimo").removeAttribute("disabled");
		  document.getElementById("btn-calcularoptimo").setAttribute('enabled', "enabled");   
		  //document.getElementById("btn-borrar").style.textAlign = "center"; 
		  //document.getElementById("btn-tabla").style.display = "none"; 
		}

		$(document).on('click', '.borrar', function (event) {
			
			var padre = document.getElementById("tabla");
			var hijo = document.getElementsByTagName("table");
			//var padre = hijo.parentNode;

			if(padre!=null&&hijo!=null)
			{
				padre.remove(hijo);
				document.getElementById("btn-borrar").removeAttribute("enabled");
			  	document.getElementById("btn-borrar").setAttribute('disabled', "disabled");
			  	document.getElementById("btn-tabla").removeAttribute("disabled");
			  	document.getElementById("btn-tabla").setAttribute('enabled', "enabled");  
			  	document.getElementById("btn-calcular").removeAttribute("enabled");
			  	document.getElementById("btn-calcular").setAttribute('disabled', "disabled");
			  	document.getElementById("btn-calcularoptimo").removeAttribute("enabled");
			  	document.getElementById("btn-calcularoptimo").setAttribute('disabled', "disabled");
			}else
			{
				alert("No hay tabla que borrar");
			}
		});

		function cambiar(element,val)
		{
			//Funcion en la que cambio el valor del input y a su vez cambio el color de fondo
			var ele = element.id;
			var elemento =document.getElementById(ele);
			var valor = elemento.value;

			if(val==1)
			{
				//alert(valor);
				//Aqui verifico el valor del elemento para ver a que se debe cambiar
				if(valor=="1")
				{
					elemento.style.backgroundColor ="";
					elemento.setAttribute('value', "0");
				}else if(valor=="2"||valor=="3")
				{
					if(valor=="2")
					{
						entrada=0;
					}else
					{
						salida=0;
					}
					elemento.style.backgroundColor ="red";
					elemento.setAttribute('value', "1");
				}else
				{
					elemento.style.backgroundColor ="red";
					elemento.setAttribute('value', "1");
				}
			}else if(val==3)
			{
				if(valor=="2"||valor=="3")
				{
					if(valor=="2")
					{
						entrada=0;
					}else
					{
						salida=0;
					}
					elemento.style.backgroundColor ="red";
					elemento.setAttribute('value', "1");
				}
			}else
			{
				//alert(ele);
				if(ele=="0.0"||ele=="0."+(columnas_t-1)||ele==(filas_t-1)+".0"||ele==(filas_t-1)+"."+(columnas_t-1))
				{

				}else
				{
					if(entrada==0)
					{
						llave=1;
						elemento.style.backgroundColor ="blue";
						elemento.setAttribute('value', "2");
						entrada=1;
					}else if(salida==0)
					{
						llave=0;
						elemento.style.backgroundColor ="green";
						elemento.setAttribute('value', "3");
						salida=1;
					}
				}
			}
		}



		var h=0;
		var enviar = [];

		function calcular(valor)
		{
			//esta es la funcion en la que hago todo el calculo de la matriz
			var array=[];
			var temp=[];
			var x=0, y=0;
			var ent_fil=0,ent_col=0;
			var sal_fil=0,sal_col=0;
			var ent=0,sal=0;
			//condicion para el tamaño del arreglo
			if(filas_t>2&&columnas_t>2)
			{
				//2 ciclos anidados para pasar los valores de html a un arreglo bidimensional
				//Tambien busco los valores de entrada y salida
				for(x=0;x<filas_t;x++)
				{
					temp=[];
					for(y=0;y<columnas_t;y++)
					{
						var val = document.getElementById(x+"."+y).value
						//alert(document.getElementById(x+"."+y).value);
						if(val==0||val==1||val==2||val==3)
						{
							temp.push(val);
							if(val==2)
							{
								if(ent==0)
								{
									ent_fil=x;
									ent_col=y;
									ent=1;
								}else{
									alert("Insertaste más de una entrada en la posición: "+x+","+y);
									break;
								}
							}else if(val==3)
							{
								if(sal==0)
								{
									sal_fil=x;
									sal_col=y;
									sal=1;
								}else{
									alert("Insertaste más de una salida en la posición: "+x+","+y);
									break;
								}
							}
						}else
						{
							alert("Ingresaste un valor no valido en la posición: "+x+","+y);
							break;
						}
					}
					array.push(temp);
				}

				if(ent==1&&sal==1)
				{
					if(valor==1)
					{
						rutaoptima(array.slice(),ent_fil,ent_col,sal_fil,sal_col);
					}else
					{
						camino(array.slice(),ent_fil,ent_col,sal_fil,sal_col,0);
					}
					//alert("LISTO!!!!");
				}else{
					alert("Te falto un valor de entrada o salida");
				}

			}else{
				alert("El arreglo es demasiado pequeño");
			}
		}

		//Esta es la funcion donde hay que estar llamando constantemente a la función de camino
		function rutaoptima(array,ent_fil,ent_col,sal_fil,sal_col)
		{
			//Hay que calcular el camino y despues agarrar el primer paso del camino que nos regresa y despues volver a llamarle
			//Pero ahora empezando desde ese primer paso}
			//alert("Hola Mundo");
			var cont =0;
			var caminocorto= null;
			var rutacorta= null;
			var ruta= null;
			var long= null;
			var resultado = [];
			var separacion = null;
			var respaldo = [];
			do
			{
				 caminocorto= null;
				 ruta= null;
				//Aqui obtenemos la ruta más corta de la funcion camino 
				if(cont == 0)
				{
					caminocorto = camino(array.slice(),ent_fil,ent_col,sal_fil,sal_col,1);

					rutacorta = caminocorto[0].reverse().slice();
					ruta = caminocorto[0].slice();
				}else
				{
					mapa = transforma(array.slice(),resultado);
					caminocorto = camino(mapa.slice(),parseInt(separacion[0]),parseInt(separacion[1]),sal_fil,sal_col,1);
					//Guardamos todo en variables separadas
					ruta = caminocorto[0].reverse().slice();
					if(ruta[0][0][0]>=100)
					{
						mapa[ruta[0][0][0]-100][ruta[0][0][1]]="1";
						resultado.pop();

						caminocorto = camino(mapa.slice(),parseInt(resultado[resultado.length-1][0][0]),parseInt(resultado[resultado.length-1][0][1]),sal_fil,sal_col,1);
							trans--;
							ruta = caminocorto[0].reverse().slice();
					}
				}
				//alert(ruta+"    "+ruta[0]+"   "+long);
				if(cont==0)
				{
					resultado.push(ruta.shift());
					resultado.push(ruta.shift());
				}else{
					ruta.shift();
					var insertatemporal = ruta.shift();
					var resultadotemporal = repetido(resultado, insertatemporal);
					if(resultadotemporal)
					{
						resultado.push(insertatemporal);
						var f=0;
						respaldo=[];
						var lom = ruta.length;
						for(f=0;f<lom;f++)
						{
							respaldo.push(ruta.shift());
						}
					}else
					{
						//resultado.pop();
						do
						{
							var respaldotemporal = respaldo.shift();
							resultadotemporal = repetido(resultado, respaldotemporal);
							if(resultadotemporal)
							{
								resultado.push(respaldotemporal);
							}
						}while(resultadotemporal==false)
					}
				}
				cont++;
				separacion = resultado[resultado.length-1][0].toString().split(",");
				//alert("Pasada "+ cont);
			}while(parseInt(separacion[0])!=sal_fil||parseInt(separacion[1])!=sal_col);

			resultadofinal = analisisfinal(resultado);

			alert(resultadofinal);
			alert("Ya terminamos y esta es la ruta optima");
			//Ciclo en el que imprime
			long = resultadofinal.length;
			imprimir(resultadofinal.reverse(),long);
		}


		function analisisfinal(lista)
		{
			var a=0, b=0;
			//var res=null;
			for(a=0;a<lista.length-1;a++)
			{
				for(b=lista.length-1;b>a+1;b--)
				{
					if((lista[a][0][0]+1==lista[b][0][0]&&lista[a][0][1]==lista[b][0][1])||(lista[a][0][1]+1==lista[b][0][1]&&lista[a][0][0]==lista[b][0][0]))
					{
						var temp = simplificar(lista,a,b);
						lista = analisisfinal(temp);
						break;
					}else if((lista[a][0][0]-1==lista[b][0][0]&&lista[a][0][1]==lista[b][0][1])||(lista[a][0][1]-1==lista[b][0][1]&&lista[a][0][0]==lista[b][0][0]))
					{
						var temp = simplificar(lista,a,b);
						lista = analisisfinal(temp);
						break;
					}

				}
			}
			return lista;
			
		}


		function simplificar(lista,v1,v2)
		{
			var nueva = [];
			var c=0,d=0;
			for(c=0;c<lista.length;c++)
			{
				if(c==v1)
				{
					nueva.push(lista[c]);
					c=v2-1;
				}else
				{
					nueva.push(lista[c]);
				}
			}
			return nueva;
		}

		var trans=0;
		function transforma(mapa, ruta)
		{
			var v=0,w=0;
			for(w=trans;w<ruta.length-1;w++)
			{
				mapa[ruta[w][v][0]][ruta[w][v][1]]="1";
			}
			trans++;
			return mapa;
		}

		function repetido(ruta, valor)
		{
			var x=0;
			var temp =null;
			for(x=0;x<ruta.length;x++)
			{
				temp = ruta[x];
				if(temp[0][0]==valor[0][0]&&temp[0][1]==valor[0][1])
				{
					return false;
				}
			}
			return true;
		}


		function camino(array,ent_fil,ent_col,sal_fil,sal_col,condicion)
		{
			//alert("Entrada "+ent_fil+","+ent_col);
			//alert("Salida: "+sal_fil+","+sal_col);
			var arraycopia=[];
			var x=ent_fil, y=ent_col;
			var temp_fil=0, tamp_col=0;
			var movimientos =[];
			var temp=[2];
			//alert(array);
			var pasos_a_seguir=[];
			//Aqui guardo las permutaciones de los numeros del 1 al 4
			//Ej 1234,1342,1432,4321, etc...
			var permutaciones = getAllPermutations("1234");
			var condiciones=[];
			var tmp=[];
			//Aqui inicia el ciclo para sacar todos los caminos cambiando el la prioridad de nuestra rosa de los vientos
			var contadorciclomayor=0;
			//Debido a que haremos pop en permutaciones el tamaño de la pila cambia por lo que hay que guardar su tamaño antes de empezar
			var longitudpermutaciones=permutaciones.length;
			//Arreglo en el cual voy a guardar la lista de pasos de cada una de las permutaciones
			var pilatridimencional=[];
			while(contadorciclomayor<longitudpermutaciones)
			{
				$('#permutaciones').append('<br>'+permutaciones[permutaciones.length-1]);
				//document.getElementById('permutaciones').innerHTML = '<br>'+permutaciones[permutaciones.length-1];
				condiciones=perm(permutaciones.pop());
				tmp=condiciones.toString().split(",");
				//alert("Permutaciones: "+tmp);
				pasos_a_seguir=[];
				x=ent_fil;
				y=ent_col;
				arraycopia=copiar(array);
				movimientos=[];
				//Mientras no este en la salida debo seguir
				while(x!=sal_fil||y!=sal_col)
				{
					//alert("Entre");
					arraycopia[x][y]="8";
					pasos_a_seguir.push([[x,y]]);

					//condiciones=perm(permutaciones.pop());
					
					//imprimir la permutacion con la que se esta evaluando
					//alert(tmp);
					var g=0;
					//Empiezo a comparar con las posiciones que colindan
					//verifico la posicion en el orden que la permutacion lo indique
					//ciclo en el cual evaluo las 4 posiciones
					for(g=0;g<8;g+=2)
					{
						//----------alert("Tmp[g]: "+eval(tmp[g])+" Tmp[g+1]: "+eval(tmp[g+1]));
						//----------alert("Array :"+ array[eval(tmp[g])][eval(tmp[g+1])]);
						//----------alert("array["+eval(tmp[g])+"]["+eval(tmp[g+1])+"]!=null&&(array["+eval(tmp[g])+"]["+eval(tmp[g+1])+"]==0||array["+eval(tmp[g])+"]["+eval(tmp[g+1])+"]==3");

						var negativos=eval(tmp[g]);
						var positivos=eval(tmp[g+1]);
						//alert("Eval: "+eval(tmp[g]));
						//alert("Eval+1: "+eval(tmp[g+1]));
						
						//if para ver que los valores no sean negativos
						if(negativos>-1&&positivos>-1)
						{
							if(negativos<arraycopia.length&&positivos<arraycopia.length)
							{
								//alert("Array: "+arraycopia[eval(tmp[g])][eval(tmp[g+1])]);
								if(arraycopia[eval(tmp[g])][eval(tmp[g+1])]!=null)
								{
									//If en el que verifico con la posicion en la que la permutacion se encuentre y el ciclo se encuentre
									//Opciones posibles: Arriba, abajo, derecha o izquierda
									if(arraycopia[eval(tmp[g])][eval(tmp[g+1])]=="0"||arraycopia[eval(tmp[g])][eval(tmp[g+1])]=="3")
									{
										//Asigno los valores de la posicion (1,0)
										//a una variable temporal
										temp[0]=eval(tmp[g]);
										temp[1]=eval(tmp[g+1]);
										//Esta variable temporal la meto a la pila de donde salen los futuros posibles movimientos
										movimientos.push(temp.slice());
									}
								}
							}
							
						}
					}
					//Veo si la pila tiene elementos a donde irse
					if(movimientos.length==0)
					{
						var nosirveparanada=0;


						//AQUI NOS QUEDAMOS en que HAY QUE VER COMO PONERLE UNA MARCA a los que no se puede


						pasos_a_seguir[0][0][0]+=100;
						//alert("Ya no hay pa donde");
						break;
					}
					//alert("Movimientos: "+movimientos);
					temp=movimientos.pop();
					x=temp[0];
					y=temp[1];
					//alert(temp);
				}
				if(x==sal_fil&&y==sal_col)
				{
					//alert("Sali");
					pasos_a_seguir.push([[x,y]]);
				}else
				{
					//alert("Termine sin Salir");
				}
				pilatridimencional.push(pasos_a_seguir.slice());
				//alert(pilatridimencional[contadorciclomayor]);
				contadorciclomayor++;
			}
			$('#permutaciones').append("<br>-------------------------------------------------------------------------------------------<br>");
			
			var imprime=[];
			var llave=pilatridimencional[0];
			for(x=0;x<pilatridimencional.length;x++)
			{
				//alert(pilatridimencional[x]);
				$('#resultados').append('<br>'+pilatridimencional[x]);
				if(pilatridimencional[x][0][0][0]<=100)
				{
					if(pilatridimencional[x].length<llave.length)
					{
						llave=pilatridimencional[x];
					}
				}
				
			}
			$('#resultados').append("<br>-------------------------------------------------------------------------------------------<br>");

			//alert(pasos_a_seguir);

			//Aqui es donde realizo el proceso para que el camino se imprima por pasos
			var temporal =[];
			//alert(pasos_a_seguir);
			var long = llave.length;
			//Ciclo para voltear la lista en la que guardo los pasos que siguio la lista
			for(x=0;x<long;x++)
			{
				temporal.push(llave.pop());
			}
			//Esta codicion es para evaluar si necesito el valor de retorno o no
			if(condicion==0)
			{
				alert("Ya terminamos y este es el camino mas corto con los puntos cardinales");
				//Ciclo en el que imprime
				imprimir(temporal,long);
				//alert("Listo");
			}else
			{
				return [temporal, long];
			}
			
		}
		
		function imprimir(temp,long) {           //  create a loop function
		   	setTimeout(function () {    //  call a 3s setTimeout when the loop is called         //  your code here
		      	h++;
		      	enviar=temp.pop().toString().split(",");
		      	//alert(enviar[0]);
	     	 	document.getElementById(enviar[0]+"."+enviar[1]).style.backgroundColor="pink";
				document.getElementById(enviar[0]+"."+enviar[1]).setAttribute('value', "8");
				
		      if(h<long)
		      {
		      	imprimir(temp,long);
		      }                     //  increment the counter                       //  ..  setTimeout()
		   	}, 300)
		}

		//Funcion para sacar las permutaciones de un string
		function getAllPermutations(string) {
		  var results = [];

		  if (string.length === 1) {
		    results.push(string);
		    return results;
		  }

		  for (var i = 0; i < string.length; i++) {
		    var firstChar = string[i];
		    var charsLeft = string.substring(0, i) + string.substring(i + 1);
		    var innerPermutations = getAllPermutations(charsLeft);
		    for (var j = 0; j < innerPermutations.length; j++) {
		      results.push(firstChar + innerPermutations[j]);
		    }
		  }
		  return results;
		}

		function perm(permutacion)
		{
			var si1=["x","y-1"];
			var si2=["x+1","y"];
			var si3=["x","y+1"];
			var si4=["x-1","y"];
			var char = permutacion.split("");
			//alert(eval("si"+char[0]));
			var res = [eval("si"+char[0]),eval("si"+char[1]),eval("si"+char[2]),eval("si"+char[3])];
			//var resultado =[eval];
			return res;
		}
		function copiar(array)
		{
			var k=0,l=0;
			var resultado=[];
			var oca=[];
			for(k=0;k<array.length;k++)
			{
				for(l=0;l<array[0].length;l++)
				{
					oca[l]=array[k][l];
				}
				resultado[k]=oca.slice();
			}
			return resultado;
		}

		function borrar()
		{
			document.location="pilasycolas.php";
		}
	</script>
</head>
<body>
	<div id="slide1" class="seccion1">
		<div class="menu">
			<ul class="submenu">
				<li class="nav-item2" href="index.html">
					<a href="index.html">Home</a>
				</li>
				<li class="nav-item2">
					<a href="#slide1">Sumar numeros largos</a>
				</li>
				<li class="nav-item2">
					<a href="#slide2">Laberinto</a>
				</li>
			</ul>
		</div>
		<div class="menu2">
			<img src="imagenes/hamburger_icon.png" alt="hamburger_icon">
			<div class="aparece">
				<a href="index.html">Home</a>
				<a href="#slide1">Sumar numeros largos</a>
				<a href="#slide2">Laberintos</a>
			</div>
		</div>
		<br><br>
	</div>

	<hr width=95% color="#000000" id="slide1">
	<div id="Sumar">
		<h1 class="center">Sumar numeros largos</h1>
		<div class="center">
			<h3>Ingrese un numero</h3>
			<input id="txt-num1" type="text" name="">
			<h3>Ingrese un numero</h3>
			<input id="txt-num1-2" type="text" name="">
			<br><br>
			<input id="btn-factorial" type="button" onclick='fun(1,1);' name="" value="Numeros Iguales">
			<input id="btn-factorial" type="button" onclick='fun(1,2);' name="" value="Numeros NO iguales">
			<input id="btn-factorial" type="button" onclick='fun(1,3);' name="" value="Numeros con decimales">
		</div>
	</div>

	<hr width=95% color="#000000" id="slide2">
	<div id="Sumar">
		<h1 class="center">Laberintos</h1>
		<div class="center">
			<h3>Ingrese un numero de filas</h3>
			<input id="txt-num2" type="text" name="">
			<h3>Ingrese un numero de columnas</h3>
			<input id="txt-num2-2" type="text" name="">
			<br><br>
			<input id="btn-tabla" type="button" onclick='fun(2,4);' enabled="enabled" name="" value="Generar Tabla">
			<br>
			<input id="btn-borrar" type="button" class="borrar" disabled="disabled" value="Eliminar Tabla" onclick="borrar();">
		</div>
	</div>
	<div class="tabla" id="padre"></div>
	<div class="center">
		<input type="button" value="CALCULAR" id="btn-calcular" disabled="disabled" onclick='calcular(0);' name="">
	</div>
	<div class="center">
		<input type="button" value="CALCULAR RUTA OPTIMA" id="btn-calcularoptimo" disabled="disabled" onclick='calcular(1);' name="">
	</div>

	<br><br>
	<div class="center tamanio">
		<img src="imagenes/Imagen1.png">
	</div>
	<br><br>
	<div id="tablaresultados">
		<div id="fila1" class=" fila1 cien flex">
			<div class="grid-row">
				<div class="cell-6">
					<h3>Permutacion</h3>
					<div id="permutaciones">

					</div>
				</div>
				<div class="cell-6">
					<h3>Resultado</h3>
					<div id="resultados">
						
					</div>
				</div>
			</div>
		</div>
	</div>

	<br><br>
	<div class="center">
		<div id="optimo">
			Ruta Optima

		</div>
	</div>

	<br><br><br>
	<div class="footer">
		copyright 2020
	</div>
</body>
</html>