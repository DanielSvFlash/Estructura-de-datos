<?php
	session_start();
	include("principal.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title></title>
	<link rel="stylesheet" type="text/css" href="estilos2.css">
	<script type="text/javascript" src="jquery-3.4.1.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script type="text/javascript" src="funciones.js"></script>
	<script type="text/javascript" src="arraylistparadas.js"></script>
</head>
<body>
<div id="slide1" class="seccion1">
		<div class="menu">
			<ul class="submenu">
				<li class="nav-item">
					<a href="index.html">Home</a>
				</li>
				<li class="nav-item">
					<a href="user.php">Usuario</a>
				</li>
				<li class="nav-item">
					<a href="admin.php">Admin</a>
				</li>
				<li class="nav-item">
					<a href="tren.php">Tren</a>
				</li>
			</ul>
		</div>
		<div class="menu2">
			<img src="imagenes/hamburger_icon.png" alt="hamburger_icon">
			<div class="aparece">
				<a href="index.html">Home</a>
				<a href="user.php">Usuario</a>
				<a href="admin.php">Admin</a>
				<a href="tren.php">Tren</a>
			</div>
		</div>
		<br><br>
	</div>
