<?php
	session_start();
	if(!isset($_SESSION['id'])){
		header("location: login.php");
		exit;
	}else{
		?>
		<!DOCTYPE html>
		<html>
		<head>
			<title>Notas</title>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link rel="stylesheet" href="../css/notas.css">
			<link rel="stylesheet" href="../css/header-conta.css">
			<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@700&display=swap" rel="stylesheet">
			<link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
			<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
		</head>
		<body>
			
			<header>
				<div class="imagem">
					<a href="notas.php">
						<img class ="logo" src="../img/logo-nome-nova.png"></img>
					</a>
				</div>
				<nav class="navegacao">
					<ul>
						<li><a href="logoff.php">SAIR</a></li>
						<li><a href="conta.php">PERFIL</a></li>
						<li><img src="../img/foto-perfil.jpg"></img></li>
					</ul>
				</nav>
			</header>
			<div class="notas">
				Seja Bem-Vindo ao ambiente das suas notas!
			</div>
		</body>
		</html>
		<?php
	}
?>