<?php
	session_start();
	if(!isset($_SESSION['id'])){
		header("Location: ../login.php");
		exit;
	}else{
		require_once '../php/usuarios.php';
    	$u = new Usuario;
?>
<!DOCTYPE html>
<html lang="pt-br">
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
		<div class="marcador-nota">
			<img src="../img/close.svg" alt="" class="close-marcador">
			<div class="adicionar-marcador">
				<form action="" method="POST">
					<input type="text" placeholder="insira o nome do marcador" name="nomeMarcador" id ="nomeMarcador" value="">
					<input type="submit" value="ADICIONAR" name="addMarcador" id = "addMarcador">
				</form>
			</div>
		</div>
		<?php
			if(isset($_POST['addMarcador']) and isset($_POST['addMarcador'])){
				$nomeMarcador = addslashes($_POST['nomeMarcador']);
				if(!empty($nomeMarcador)){
					?>
					<script>console.log('cu')</script>
					<?php
					$u->conectar("usuario","localhost","root","");
					if($u->msgErro == ""){
						if(!$u->criarMarcador($nomeMarcador, $_SESSION['id'])){
							?>
							<script>
								alert("Não foi possível criar o marcador!");
							</script>
							<?php
						}else{
							header('Location: notas.php');
							die();
						}
					}else{
						?>
						<script>
							alert("<?php echo $u->msgErro; ?>");
						</script>
						<?php
					}
				}else{
					?>
					<script>
						alert("Digite um nome para o marcador!");
					</script>
					<?php
				}
			}
		?>
		<div class="conteudo">
			<header class="conteudo-header">
				<div class="imagem">
					<a href="../">
						<img class ="logo" src="../img/logo-branca.png"></img>
					</a>
				</div>
				<div class="pesquisa">
					<form method="GET">
						<label>
							<input type="text" name="textoPesquisa" maxlength="100" placeholder="Pesquisar notas">
							<button type="submit"><i class="fas fa-search fa-2x"></i></button>
						</label>
					</form>
				</div>
				<nav class="navegacao">
					<ul>
						<li><a href="../php/logoff.php">SAIR</a></li>
						<li><a href="configuracoes/conta.php">CONFIGURAÇÕES</a></li>
					</ul>
				</nav>
			</header>
			<div class="menu">
				<ul class ="botoes-menu">
					<a href="" id="plus"><li><i class="fas fa-plus"></i></li></a>
					<a href="" id="sync"><li><i class="fas fa-sync-alt"></i></li></a>
					<a href="" id="slider"><li><i class="fas fa-sliders-h"></i></li></a>
				</ul>
				<ul class="classificador">
					<li>Calendário</li>
					<li>Marcadores</li>
				</ul>
			</div>
			<div class="notas">
				<?php
				$u->conectar("usuario","localhost","root","");
				if($u->msgErro == ""){
					if(isset($_GET['textoPesquisa']) && !empty($_GET['textoPesquisa'])){
						if($u->listarMarcador($_SESSION['id'])){
							$marc = $u->listarMarcador($_SESSION['id']);
							for($i = 0; $i < count($marc); $i++){
								if($u->listarNotas($marc[$i][0])){
									$nota = $u->listarNotas($marc[$i][0]);
									?>
									<div class="resultado-pesquisa">
									<?php
										for($j = 0; $j < count($nota); $j++){
											if($u->pesquisarNota($nota[$j][0], $nota[$j][3], $_GET['textoPesquisa'])){
												?>
												<div class="nota example">
													<div class="titulo">
														<p>
															<?php echo $nota[$j][1]; ?>
														</p>
													</div>
													<div class="descricao">
														<i class="descricao"></i>
														<p>
															<?php echo $nota[$j][2]; ?>
														</p>
													</div>
												</div>
												<?php
												if($u->listarArquivos($nota[$j][2])){
													$arq = $u->listarArquivos($nota[$j][2]);
													var_dump($arq);
													for($k = 0; $k < count($arq); $k++){
														?>
														<div class="arquivo">
															<p>
																<?php echo $arq[$k][2]; ?>
															</p>
														</div>
														<?php
													}
												}
											}
										}
									?>
									</div>
									<?php
								}
							}
						}
					}else{
						if($u->listarMarcador($_SESSION['id']) == false){
							?>
							<p>Seja Bem-Vindo ao ambiente das suas notas!</p>
							<?php
						}else{
							$marc = $u->listarMarcador($_SESSION['id']);
							for($i = 0; $i < count($marc); $i++){
								?>
								<fieldset>
									<legend><?php echo $marc[$i][1]; ?></legend>
									<div class="orgNotas">
									<?php
										if($u->listarNotas($marc[$i][0])){
											$nota = $u->listarNotas($marc[$i][0]);
											for($j = 0; $j < count($nota); $j++){
												?>
												<div class="nota example">
													<div class="titulo">
														<p>
															<?php echo $nota[$j][1]; ?>
														</p>
													</div>
													<!-- <div class="descricao">
														<i class="descricao"></i>
														<p>
															<?php //echo $nota[$j][2]; ?>
														</p>
													</div> -->
												</div>
												<?php
												if($u->listarArquivos($nota[$j][2])){
													$arq = $u->listarArquivos($nota[$j][2]);
													var_dump($arq);
													for($k = 0; $k < count($arq); $k++){
														?>
														<!-- <div class="arquivo">
															<p>
																<?php //echo $arq[$k][2]; ?>
															</p>
														</div> -->
														<?php
													}
												}
											}
										}
									?>
									<div class="adicionar_nota example">
										<i class="fas fa-plus-circle fa-3x" id="<?php echo $marc[$i][0];?>"></i>
										<?php
											if(isset($_POST['addNota'])){
												$titulo = addslashes($_POST['titulo']);
												$conteudoNota = addslashes($_POST['conteudoNota']);
												$cor = $_POST['cor'];
												$idMarc = $_POST['idMarc'];
												$arquivo = $_POST['arquivo'];
												if(!empty($_POST['titulo'])){
													if(!$u->adicionarNota($idMarc, $titulo, $conteudoNota)){
														?>
														<script>
															alert("O campo não pode ficar vazio!");
														</script>
														<?php
													}else{
														header('Location: notas.php');
														die();
													}
												}
											}
										?>
									</div>
									</div>
								</fieldset>
								<?php
							}
						}
					}
				}else{
					?>
					<div class="msg-erro">
						<?php
							echo $u->msgErro;
						?>
					</div>
					<?php
				}
				?>	
			</div>
		</div>
		<div class="janelaAddNota">
			<img src="../img/close.svg" alt="" class="janelaAddNotaFalse">
			<form action="" method="POST">
				<input type="text" name="idMarc" value=""  id="idMarc" required>
				<input type="text" placeholder="insira o título" name="titulo" id ="titulo">
				<input type="textarea" placeholder="insira sua descrição" name="conteudoNota" id="descricao">
				<input type="color" name="cor">
				<input type="file" name="arquivo">
				<input type="submit" name="addNota" value ="SALVAR">
			</form>
		</div>
		<div class="janelaNotaExpandir">
				<img src="../img/close.svg" alt="" class="notaExpandirFalse">
				<form action="" method="POST">
					<input type="text" name="idMarc" value=""  id="idMarc" required>
					<input type="text" placeholder="insira o título" name="titulo" id ="titulo">
					<input type="textarea" placeholder="insira sua descrição" name="conteudoNota" id="descricao">
					<input type="color" name="cor">
					<input type="file" name="arquivo">
					<input type="submit" name="addNota" value ="SALVAR">
				</form>
			</div>
		<script src="<?php echo '../js/configs.js' ?>"></script>
	</body>
</html>
<?php
	}
?>