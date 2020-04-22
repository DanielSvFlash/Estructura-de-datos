<?php
if(!function_exists('select')){ 
	if(!function_exists('conectar')){ 
		function conectar()
		{
			$user="root";
			$pass="";
			$server="localhost";
			$db="tren";
			$con = mysqli_connect($server,$user,$pass) or die ("Error al conectarte a la base de datos".mysql_error());

			mysqli_select_db($con,$db);
			return $con;
		}
	}
}
?>