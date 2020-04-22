<?php
	include("conexion.php");
if(!class_exists("parada"))
{
	class parada
	{
		public $idlinea;
		public $idestacion;
		public $nombre;
		public $tipo;
		public $estatus;
		public $puntosdi;

		function __construct($il,$ie,$n,$t,$e,$p)
		{
			$this->idlinea = $il;
			$this->idestacion = $ie;
			$this->nombre = $n;
			$this->tipo = $t;
			$this->estatus = $e;
			$this->puntosdi = $p;
		}
	}
}

if(!function_exists('select')){ 
	function select($val)
	{
		$array= array();
		$con=conectar();
		$res = mysqli_query($con, $val);
		$x=0;
		while($fila = mysqli_fetch_array($res))
		{
			
			$parada = new parada($fila['idlinea'],$fila['idestacion'],$fila['nombre'],$fila['tipo'],$fila['estatus'],$fila['puntosdi']);
			//echo serialize($parada->nombre);
			array_push($array, $parada);

			/*echo "<br>Idlinea: ".$fila['idlinea'].
					"<br> Idestacion: ".$fila['idestacion'].
					"<br> Nombre: ".$fila['nombre'].
					"<br> Tipo: ".$fila['tipo'].
					"<br> Estatus: ".$fila['estatus'].
					"<br> Puntos de Interes: ".$fila['puntosdi'].
					"<hr>";*/
			//$array[$x] = $fila['nombre']."<br>";
			//echo $array[$x];
			$x++;
		}

		mysqli_close($con);
		return $array;
		//echo("Conexion exitosa");
	}

}

if(!function_exists('updateestatus')){ 
	function updateestatus($val)
	{
		$con=conectar();
		$res = mysqli_query($con, "update paradas set estatus = 1 where nombre ='".$val."'");

	}
}
if(!function_exists('updateestatus2')){ 
	function updateestatus2($val)
	{
		$con=conectar();
		$res = mysqli_query($con, "update paradas set estatus = 0 where nombre ='".$val."'");

	}
}

if(!function_exists('update')){ 
	function update($nombreoriginal, $nombrenuevo, $puntosnuevos)
	{
		//echo "update paradas set nombre = '".$nombrenuevo."', puntosdi = '".$puntosnuevos."' where nombre ='".$nombreoriginal."'";
		$con=conectar();
		$res = mysqli_query($con, "update paradas set nombre = '".$nombrenuevo."', puntosdi = '".$puntosnuevos."' where nombre ='".$nombreoriginal."'");

	}
}

?>