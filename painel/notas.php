<?php
	session_start();
	if(!isset($_SESSION['id'])){
		header("location: ../login.php");
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
			<link rel="stylesheet" href="../css/header.css">
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
			<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@700&display=swap" rel="stylesheet">
			<link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
			<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
		</head>
		<body>
			<div class="conteudo">
				<header class="conteudo-header">
					<div class="imagem">
						<a href="../index.html">
							<img class ="logo" src="../img/logo-branca.png"></img>
						</a>
					</div>
					<div class="pesquisa">
						<form method="POST">
							<label>
								<input type="text" name="pesquisa" maxlength="100" placeholder="Pesquisar notas">
								<button type="submit" name="pequisa"><i class="fas fa-search fa-2x"></i></button>
							</label>
							
						</form>
					</div>
					<nav class="navegacao">
						<ul>
							<li><a href="../php/logoff.php">SAIR</a></li>
							<li><a href="configuracoes/conta.php">PERFIL</a></li>
							<!-- <li><img src="../img/foto-perfil.jpg"></img></li> -->
						</ul>
					</nav>
				</header>
				<div class="menu">
					<ul>
						<li>Calendário</li>
						<li>Pastas</li>
					</ul>
				</div>
				<div class="notas">
					<p>Seja Bem-Vindo ao ambiente das suas notas!</p>
				</div>
			</div>
		</body>
		</html>
		<?php
	}
?>